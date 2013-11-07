<?php

App::uses('AbstractExtract', 'Lib/AppExtraction');
App::uses('CFPropertyList', 'Vendor/PlistReader');


class ExtractApple extends AbstractExtract {
	
	protected function isMyFile($fileExtension) {
		return ($fileExtension == 'ipa');
	}
	
	protected function isIcon($filePath, $icons) {
		$fileInfo = pathinfo($filePath);
		if (isset($fileInfo['extension'])) {
			$fileExtension = strtolower($fileInfo['extension']);
			if ($fileExtension == 'png') {
				if (preg_match('/icon/i', $fileInfo['filename'])) {
					//return true;
				}
				if (isset($icons['app'])) foreach ($icons['app'] as $icon) {
					if (preg_match('/'.$icon.'/i', $fileInfo['filename'])) {
						return true;
					}
				}
				if (isset($icons['newsstand']['CFBundleIconFiles'])) foreach ($icons['newsstand']['CFBundleIconFiles'] as $icon) {
					if (preg_match('/'.$icon.'/i', $fileInfo['filename'])) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	public function process() {
		$arr = array();
		$arr['sort'] = 1000;
		$tempPath = $this->tempPath();
		$archiveFile = $tempPath.'app.ipa';
		$debug = false;
		
		if (isset($this->file['path'])) { 
			// Debug mode
			copy($this->file['path'], $archiveFile);
			$debug = true;
		}
		else { 
			// Upload mode
			move_uploaded_file($this->file['tmp_name'], $archiveFile);
		}
		
		// Getting size of the app
		$arr['size'] = filesize($archiveFile);
		
		// Un-archiving app
		$shellOut = shell_exec('unzip '.$archiveFile.' -d '.$tempPath.'');
		if (empty($shellOut)) {
			$this->raiseError('Unable to process '.$this->file['name']);
			return false;
		}
		
		// Looking for the app folder
		$appRoot = $tempPath.'Payload'.DS;
		$dirs = array_filter(glob($appRoot.'*'), 'is_dir');
		if (empty($dirs)) {
			$this->raiseError('Unable to process '.$this->file['name']);
			return false;
		}
		
		// Extracting plist
		$appRoot = $dirs[0].DS;
		$plistFile = $appRoot.'Info.plist';
		if (file_exists($plistFile)) {
			$plist = new CFPropertyList();
			$plist->parseBinary(file_get_contents($plistFile));
			$data =  $plist->toArray();
			unset($plist);
			$arr['plist'] = $data;
			
			// Getting basic info
			$arr['version'] = isset($data['CFBundleShortVersionString']) ? $data['CFBundleShortVersionString'] : '';
			if (empty($arr['version'])) $arr['version']	= isset($data['CFBundleVersion']) ? $data['CFBundleVersion'] : '';
			$arr['identifier'] = isset($data['CFBundleIdentifier']) ? $data['CFBundleIdentifier'] : '';
			$arr['name'] = isset($data['CFBundleDisplayName']) ? $data['CFBundleDisplayName'] : '';
			
			// Getting info about icons
			$icons = array();
			if (isset($data['CFBundleIconFiles'])) {
				$icons = $data['CFBundleIconFiles'];
			}
			else $icons = array();
			if (isset($data['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles'])) {
				$icons = array_merge($icons, $data['CFBundleIcons']['CFBundlePrimaryIcon']['CFBundleIconFiles']);
			}
			if (isset($data['CFBundleIconFile'])) {
				$icons[] = $data['CFBundleIconFile'];
			}
			
			$arr['icons'] = array();
			
			if (!empty($icons)) {
				$arr['icons']['app'] = array_unique($icons);
				unset($icons);
			}
			
			if (isset($data['CFBundleIcons']['UINewsstandIcon'])) {
				$arr['icons']['newsstand'] = $data['UINewsstandIcon'];
			}
		}
		
		// Searching for the rest of the icons & deleting other stuff & checking provisioning
		$dir = new Folder($appRoot);
		$files = $dir->findRecursive();
		$icons = array();
		$iconPaths = array();
		foreach ($files as $path) {
			// Checking for provisioning profile type
			if (preg_match('/embedded\.mobileprovision/i', $path)) {
				$file = new File($path);
				$content = $file->read();
				unset($file);
				if (preg_match('/ProvisionsAllDevices/i', $content)) {
					$arr['provisioning'] = 'enterprise';
				}
				elseif (preg_match('/ProvisionedDevices/i', $content)) {
					$arr['provisioning'] = 'adhoc';
				}
				else {
					$arr['provisioning'] = 'appstore';
				}
			}
			// Hunting for icons & deleting other files
			if (!isset($arr['icons']) || !$this->isIcon($path, $arr['icons'])) {
				$file = new File($path);
				$file->delete();
				unset($file);
			}
			else {
				$icons[] = pathinfo($path, PATHINFO_BASENAME);
				$iconPaths[] = $path;
			}
		}
		$arr['icons'] = $icons;
		unset($files);
		unset($icons);
		
		// Normalizing images
		copy(APP.'bin/normalize', $appRoot.'normalize');
		$origPath = getcwd();
		chdir($appRoot);
		$output = shell_exec('chmod -x ./normalize');
		$output = shell_exec('python ./normalize');
		chdir($origPath);
		
		$largestIcon = array();
		foreach ($iconPaths as $icon) {
			$size = getimagesize($icon);
			if (!$largestIcon || $largestIcon['w'] < $size[0]) {
				$largestIcon['w'] = $size[0];
				$largestIcon['file'] = $icon;
			}
		}
		
		// Processing values
		$this->data = $arr;
		$this->app = $archiveFile;
		if (isset($largestIcon['file'])) {
			copy($largestIcon['file'], $tempPath.'icon.png');
		}
		$this->icon = $tempPath.'icon.png';
		
		return true;
	}
	
}