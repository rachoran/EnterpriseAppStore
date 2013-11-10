<?php

App::uses('Platforms', 'Lib/Platform');

class ApplicationsController extends AppController {
	
	var $uses = array('Application', 'ApplicationsGroup', 'Category', 'ApplicationsCategory', 'Group', 'Attachment');
	
	public function index() {
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		if ($this->request->is('post')) {
			$this->set('searchTerm', $this->request->data['search']);
			$this->set('data', $this->Application->searchFor($this->request->data['search']));
		}
		else {
			$this->set('data', $this->Application->getAll());
		}
	}
	
	public function view($id) {
		// Basic template settings
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		// Application detail
		$app = $this->Application->getOne($id);
		$this->set('data', $app);
		
		// Starting basic info
		$basicInfo = array();
		$basicInfo[__('Application identifier')] = $app['Application']['identifier'];
		$basicInfo[__('Version')] = $app['Application']['version'];
		$basicInfo[__('Created')] = date('M. jS Y, H:i', strtotime($app['Application']['created']));
		if ($app['Application']['created'] != $app['Application']['modified']) {
			$basicInfo[__('Last modified')] = date('M. jS Y, H:i', strtotime($app['Application']['modified']));
		}
		$basicInfo[__('Platform')] = $app['Application']['platform'];
		$basicInfo[__('Filesize')] = $app['Application']['size'];
		
		// Parsing system files
		$platform = $app['Application']['platform'];
		if ($platform <= Platforms::iOSUniversal) {
			// iOS
			App::uses('InfoPlistTemplateParser', 'Lib/Parsing');
			$parser = new InfoPlistTemplateParser();
			$data = json_decode($app['Application']['config'], true);
			$parsed = $parser->processArray($data['plist']);
			$this->set('appSystemInfo', $parsed);
			
			$basicInfo[__('Provisioning')] = '<strong>'.strtoupper($data['provisioning']).'</strong>';
			$basicInfo[__('Minimum OS version')] = 'iOS '.$data['plist']['MinimumOSVersion'];
			
			if (($platform == 0 || $platform == 2) && isset($data['plist']['UISupportedInterfaceOrientations'])) {
				$orientations = $data['plist']['UISupportedInterfaceOrientations'];
				$orientation = '<span style="font-size:33px;">';
				foreach ($orientations as $o) {
					if ($o == 'UIInterfaceOrientationPortrait') $rotation = 0;
					else if ($o == 'UIInterfaceOrientationPortraitUpsideDown') $rotation = 180;
					else if ($o == 'UIInterfaceOrientationLandscapeLeft') $rotation = 270;
					else if ($o == 'UIInterfaceOrientationLandscapeRight') $rotation = 90;
					$orientation .= '<i class="icon-mobile-phone icon-rotate-'.$rotation.' rounded-border" style="margin-left:12px; background:#FFF; display:block; float:left; width:40px; height:40px; text-align:center; line-height:40px;"></i>';
				}
				$basicInfo[__('iPhone orientations')] = $orientation.'</span>';
			}
			if (($platform == 1 || $platform == 2) && isset($data['plist']['UISupportedInterfaceOrientations~ipad'])) {
				$orientations = $data['plist']['UISupportedInterfaceOrientations~ipad'];
				$orientation = '<span style="font-size:33px;">';
				foreach ($orientations as $o) {
					if ($o == 'UIInterfaceOrientationPortrait') $rotation = 0;
					else if ($o == 'UIInterfaceOrientationPortraitUpsideDown') $rotation = 180;
					else if ($o == 'UIInterfaceOrientationLandscapeLeft') $rotation = 270;
					else if ($o == 'UIInterfaceOrientationLandscapeRight') $rotation = 90;
					$orientation .= '<i class="icon-mobile-phone icon-rotate-'.$rotation.' rounded-border" style="margin-left:12px; background:#FFF; display:block; float:left; width:40px; height:40px; text-align:center; line-height:40px;"></i>';
				}
				$basicInfo[__('iPad orientations')] = $orientation.'</span>';
			}
			
			$v = (string)(int)$data['plist']['DTXcode'];
			$basicInfo[__('Built with XCode')] = $v[0].'.'.$v[1].'.'.$v[2];
			
			if (isset($data['plist']['Unity_LoadingActivityIndicatorStyle'])) {
				$basicInfo[__('Thirdparty')] = 'Unity3D build';
			}
		}
		else {
			// Android
		}
		
		// Setting basic info
		$this->set('basicInfo', $basicInfo);
		
		// History
		$apps = $this->Application->getAllHistoryForApp($app['Application']['identifier'], $app['Application']['platform']);
		$this->set('appsList', $apps);
		
		// Attachments
		$this->set('attachmentsList', $this->Attachment->getAllForApp($app));
	}
	
	public function edit($id=0) {
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('applications-edit'));
		
		$this->enableAjaxFileUpload();
		
		// Groups for the join subset
		$list = $this->User->Group->find('list');
		$this->set('groups', $list);
		
		if ($this->request->is('post')) {
			$app = $this->Application->saveApp($this->request->data['appData'], $this->request->data['formData'], null, null);
			$groups = isset($this->request->data['group']) ? $this->request->data['group'] : array();
			$this->ApplicationsGroup->saveAppToGroups($app->id, $groups);
			$categories = isset($this->request->data['category']) ? $this->request->data['category'] : array();
			$this->ApplicationsCategory->saveAppToCategories($app->id, $categories);
			return $this->redirect(array('action' => 'edit', $app->id));
		}	
		$app = $this->Application->getOne($id);
		$this->set('data', $app);
		
		$this->set('categoriesList', $this->Category->getAllForApp($id));
		$this->set('groupsList', $this->Group->getAllForApp($id));
		$this->set('attachmentsList', $this->Attachment->getAllForApp($app));
	}
	
	public function uploadApp() {
		App::uses('ExtractAndroid', 'Lib/AppExtraction');
		App::uses('ExtractApple', 'Lib/AppExtraction');
		
		$file = $this->request->form['appFile'];
		
		$extract = null;
		$errors = null;
		
		$debug = 'g'; // 'i' for iPhone & 'a' for Android or false to disable
		
		if ($debug) {
			if ($debug == 'i') {
				$file['name'] = 'iJenkins_Enterprise.ipa';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'iJenkins_Enterprise.ipa';
				$file['size'] = 1234124;
				$file['error'] = null;
			}
			elseif ($debug == 'i2') {
				$file['name'] = 'iDeviant_Enterprise.ipa';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'iDeviant_Enterprise.ipa';
				$file['size'] = 1234124;
				$file['error'] = null;
			}
			elseif ($debug == 'g') {
				$file['name'] = 'Garden.ipa';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'Garden.ipa';
				$file['size'] = 1234124;
				$file['error'] = null;
			}
		}
		
		if ($file) {
			$extract = new ExtractApple($file);
			if ($extract->is()) {
				
			}
			else {
				$extract = new ExtractAndroid($file);
				if ($extract->is()) {
					
				}
				else {
					die($extract);
					$extract = null;
					// TODO: Error message goes here!
				}
			}
			if ($extract) {
				if ($extract->process()) {
					$app = $this->Application->saveApp($extract->data, $extract->data, $extract->app, $extract->icon);
					$extract->data['id'] = $app->id;
					//debug($extract->data);
					$extract->clean();
				}
				$errors = $extract->errors;
			}
			else {
				$errors = array('Unable to process the app');
			}
		}
		else {
			$errors = array('No file has been processed');
		}
		
		$data = null;
		if ($extract != null) {
			$data = $extract->data;
		}
		if (!$data) {
			if (!$errors) {
				$errors = array('No file has been processed');
			}
		}
		
		$this->outputApi($data, false, $errors);
	}
	
}
