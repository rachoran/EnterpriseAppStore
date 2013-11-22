<?php

App::uses('Extract', 'Lib/AppExtraction');
App::uses('Platforms', 'Lib/Platform');


class PngOnlyFilter extends RecursiveFilterIterator {
	
    public function __construct($iterator) {
    	parent::__construct($iterator);
    }
	
    public function accept() {
    	return $this->current()->isFile() && preg_match("/\.png?g$/ui", $this->getFilename());
    }
	
    public function __toString() {
    	return $this->current()->getFilename();
    }
    
}


class ExtractAndroid extends Extract {
	
	protected function isMyFile($fileExtension) {
		return ($fileExtension == 'apk');
	}
	
	public function xml2array($xml){ 
	    $opened = array(); 
	    $opened[1] = 0; 
	    $xml_parser = xml_parser_create(); 
	    xml_parse_into_struct($xml_parser, $xml, $xmlarray); 
	    $array = array_shift($xmlarray); 
	    unset($array["level"]); 
	    unset($array["type"]); 
	    $arrsize = sizeof($xmlarray); 
	    for($j=0;$j<$arrsize;$j++){ 
	        $val = $xmlarray[$j]; 
	        switch($val["type"]){ 
	            case "open": 
	                $opened[$val["level"]]=0; 
	            case "complete": 
	                $index = ""; 
	                for($i = 1; $i < ($val["level"]); $i++) 
	                    $index .= "[" . $opened[$i] . "]"; 
	                $path = explode('][', substr($index, 1, -1)); 
	                $value = &$array; 
	                foreach($path as $segment) 
	                    $value = &$value[$segment]; 
	                $value = $val; 
	                unset($value["level"]); 
	                unset($value["type"]); 
	                if($val["type"] == "complete") 
	                    $opened[$val["level"]-1]++; 
	            break; 
	            case "close": 
	                if (isset($opened[$val["level"]-1])) $opened[$val["level"]-1]++; 
	                unset($opened[$val["level"]]); 
	            break; 
	        } 
	    } 
	    return $array; 
	}
	
	public function getTag($tab, $xml) {
		foreach ($xml as $item) {
			if (isset($item['tag']) && $item['tag'] == $tab) {
				return $item;
			}
		}
		return false;
	}
	
	public function getAllTags($tab, $xml) {
		$arr = array();
		foreach ($xml as $item) {
			if (isset($item['tag']) && $item['tag'] == $tab) {
				$arr[] = $item;
			}
		}
		return $arr;
	}
	
	public function process() {
		$arr = array();
		$arr['sort'] = 1000;
		$tempPath = $this->tempPath();
		$archiveFile = $tempPath.'app.apk';
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
		$appContentPath = $tempPath.'app'.DS;
		// TODO: Put apktool or other tool back to the game
		//$shellOut = passthru('../bin/apktool d -f '.$archiveFile.' '.$appContentPath);
		//$shellOut = passthru('python ../bin/unpackapk.py');
		//die($shellOut);
		
		$resContentPath = $appContentPath.'res'.DS;		
		shell_exec('unzip '.$archiveFile.' -d '.$appContentPath.'');
		
		// Getting manifest file
		// TODO: Stop using AXMLPrinter2 as the manifest file should be already decompiled
		//$manifest = file_get_contents($appContentPath.'AndroidManifest.xml');
		$manifest = passthru('java -jar ../bin/AXMLPrinter2.jar "'.$appContentPath.'AndroidManifest.xml" > "'.$appContentPath.'manifest.xml"');
		//$manifest = passthru('which java');
		//file_put_contents('./manifest.xml', $manifest);
		$manifest = file_get_contents($appContentPath.'manifest.xml');
		
		if (empty($manifest)) {
			$this->raiseError('Unable to process '.$this->file['name'].' due to a missing or corrupted application manifest file.');
			return false;
		}
		$xml = $this->xml2array($manifest);
		
		// Getting bundle Id
		$arr['identifier'] = $xml['attributes']['PACKAGE'];
		
		// Getting other info
		if (isset($xml['attributes']['ANDROID:VERSIONNAME'])) {
			$arr['version'] = $xml['attributes']['ANDROID:VERSIONNAME'];
		}
		if (isset($xml['attributes']['ANDROID:VERSIONCODE'])) {
			$arr['version-code'] = $xml['attributes']['ANDROID:VERSIONCODE'];
		}
		if (isset($xml['attributes']['ANDROID:INSTALLLOCATION'])) {
			$arr['install-location'] = $xml['attributes']['ANDROID:INSTALLLOCATION'];
		}
		
		// Application info
		$temp = $this->getTag('APPLICATION', $xml);
		
		// Digging out icons
		if (isset($temp['attributes']['ANDROID:ICON'])) {
			// TODO: When decompiled, get the icon name from the strings file
			//$iconCode = array_pop(explode('/', $temp['attributes']['ANDROID:ICON']));
			$iconCode = 'ic_launcher';
			$file = $resContentPath.'drawable-xhdpi'.DS.$iconCode.'.png';
			$icon = null;
			if (file_exists($file)) {
				$icon = $file;
			}
			else {
				$file = $resContentPath.'drawable-hdpi'.DS.$iconCode.'.png';
				if (file_exists($file)) {
					$icon = $file;
				}
				else {
					$file = $resContentPath.'drawable-mdpi'.DS.$iconCode.'.png';
					if (file_exists($file)) {
						$icon = $file;
					}
					else {
						$file = $resContentPath.'drawable-ldpi'.DS.$iconCode.'.png';
						if (file_exists($file)) {
							$icon = $file;
						}
					}
				}
			}
			if ($icon) {
				if (copy($icon, $tempPath.'icon')) {
					$this->icon = $tempPath.'icon';
				}
			}
		}
			
		if (isset($temp['attributes']['ANDROID:HARDWAREACCELERATED'])) {
			$arr['hw-accelerated'] = $temp['attributes']['ANDROID:HARDWAREACCELERATED'];
		}
		if (isset($temp['attributes']['ANDROID:LARGEHEAP'])) {
			$arr['large-heap'] = $temp['attributes']['ANDROID:LARGEHEAP'];
		}
		
		// SDK info
		$temp = $this->getTag('USES-SDK', $xml);
		if (!empty($temp)) {
			if ($temp['attributes']['ANDROID:MINSDKVERSION']) {
				$arr['min-sdk-version'] = $temp['attributes']['ANDROID:MINSDKVERSION'];
			}
			if (isset($temp['attributes']['ANDROID:TARGETSDKVERSION'])) {
				$arr['target-sdk-version'] = $temp['attributes']['ANDROID:TARGETSDKVERSION'];
			}
		}
		
		// Screen sizes
		$temp = $this->getTag('SUPPORTS-SCREENS', $xml);
		$arr['screen-sizes'] = array();
		foreach ($temp['attributes'] as $key=>$value) {
			$screen = strtolower(preg_replace('/ANDROID\:/si', '', $key));
			$arr['screen-sizes'][$screen] = $value;
		}
		
		// TODO: Check for platform properly
		$arr['platform'] = 3;
		
		// Permissions
		$temp = $this->getAllTags('USES-PERMISSION', $xml);
		$arr['permissions'] = array();
		foreach ($temp as $key=>$value) {
			//print_r($value);
			$permission = strtolower(preg_replace('/android\.permission\./si', '', $value['attributes']['ANDROID:NAME']));
			$arr['permissions'][] = $permission;
		}
		
		// Getting application name
		// TODO: Get application name from the strings file + get all other app names for other languages into $arr['localized'] = array('it'=>'AppName', 'es'=>'AppName', 'cz'=>'AppName', 'ch'=>'AppName'); where the AppName is a localized app name and the key is the country code. When decompiled, the localized files are in res/values-xxx, the one from values without the country code will be always the main one
		/*
		$stringsFile = $resContentPath.'values'.DS.'strings.xml';
		$strings = file_get_contents($stringsFile);
		if (empty($strings)) {
			$this->raiseError('Unable to process '.$this->file['name'].' due to a missing file.');
			return false;
		}
		$stringsXml = $this->xml2array($strings);
		
		// Looking for an app name
		foreach ($stringsXml as $item) {
			if (isset($item['attributes']['NAME']) && $item['attributes']['NAME'] == 'app_name') {
				$arr['name'] = $item['value'];
				break;
			}
		}
		//*/
		
		// If there is no app name
		if (!isset($arr['name']) || empty($arr['name'])) {
			$arr['name'] = (string)pathinfo($this->file['name'], PATHINFO_FILENAME);
		}
				
		// Adding the entire Manifest xml
		//$arr['manifest'] = $xml;
		
		// Processing values
		$this->data = $arr;
		$this->app = $archiveFile;
		
		return true;
	}

}