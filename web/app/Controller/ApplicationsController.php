<?php

App::uses('Platforms', 'Lib/Platform');
App::uses('ApplicationsDataHelper', 'Lib/Data/Helpers');

class ApplicationsController extends AppController {
	
	var $uses = array('Application', 'Category', 'Group', 'Attachment', 'History');
	
	public function index() {
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		if ($this->request->is('post')) {
			$this->set('searchTerm', $this->request->data['search']);
			$data = $this->Application->searchFor($this->request->data['search']);
		}
		else {
			$data = $this->Application->getAll();
		}
		$this->set('apps', $data);
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
		$basicInfo = ApplicationsDataHelper::prepareBasicInfoForApp($app);
		
		// Saving view to the history
		$this->History->saveHistory($id, 'VEW');
		
		// Parsing system files
		$platform = $app['Application']['platform'];
		if ($platform <= Platforms::iOSUniversal) {
			// iOS
			App::uses('InfoPlistTemplateParser', 'Lib/Parsing');
			$parser = new InfoPlistTemplateParser();
			$data = json_decode($app['Application']['config'], true);
			$parsed = $parser->processArray($data['plist']);
			$this->set('appSystemInfo', $parsed);
			
			$basicInfo = ApplicationsDataHelper::prepareBasicInfoForApple($data, $platform, $basicInfo);
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
		
		// Checking for Id
		if (isset($this->request->data['appId'])) $ajaxId = (int)$this->request->data['appId'];
		if (isset($ajaxId) && (bool)$ajaxId) $id = $ajaxId;
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		// Groups for the join subset
		$list = $this->Application->Group->find('list');
		$this->set('groups', $list);
		
		// Users for the join subset
		$list = $this->Application->Group->find('all');
		$this->set('groupsList', $list);
		
		// Applications for the join subset
		$list = $this->Application->Category->find('list');
		$this->set('categories', $list);
		
		// Applications for the join subset
		$list = $this->Application->Category->find('all');
		$this->set('categoriesList', $list);
		
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->Application->findById($id);
		}
		else {
			// Saving data
			if (!$id) {
				$this->Application->create();
			}
			else {
				$this->Application->id = $id;
			}
			$appData = $this->request->data;
			$appData['form'] = $this->request->form;
			$ok = $this->Application->saveApp($appData, $this->request->data['formData'], null, null);
			if ($ok) Error::add('App has been successfully saved.');
			else {
				Error::add('Unable to save this app.', Error::TypeError);
				return false;
			}
			
			if (isset($this->request->data['apply'])) {
				// Redirecting for the same page (Apply)
				$this->redirect(array('controller' => 'applications', 'action' => 'edit', $this->Application->id, TextHelper::safeText($this->request->data['Application']['name'])));
			}
			else {
				// Redirecting to the index
				$this->redirect(array('action' => 'index'));
			}
		}
		
		if (isset($this->request->data['Application']['platform'])) {
			if ($this->request->data['Application']['platform'] <= 7) {
				$appType = 0;
			}
			else if ($this->request->data['Application']['platform'] == 8) {
				$appType = 1;
			}
			else if ($this->request->data['Application']['platform'] == 9) {
				$appType = 2;
			}
		}
		else $appType = 0;
		$this->set('appType', $appType);
		
		// Selected groups
		$arr = array();
		if (isset($this->request->data['Group'])) foreach ($this->request->data['Group'] as $group) {
			$arr[$group['id']] = 1;
		}
		$this->set('selectedGroups', $arr);
		
		// Selected categories
		$arr = array();
		if (isset($this->request->data['Category'])) foreach ($this->request->data['Category'] as $category) {
			$arr[$category['id']] = 1;
		}
		$this->set('selectedCategories', $arr);
		
		$app = $this->Application->getOne($id);
		$this->set('attachmentsList', $this->Attachment->getAllForApp($app));
	}
	
	public function uploadApp() {
		App::uses('ExtractAndroid', 'Lib/AppExtraction');
		App::uses('ExtractApple', 'Lib/AppExtraction');
		
		$file = $this->request->form['appFile'];
		
		$extract = null;
		$errors = null;
		
		$debug = 'a2'; // 'i' for iPhone & 'a' for Android or false to disable
		
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
			elseif ($debug == 'a') {
				$file['name'] = '60.apk';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'60.apk';
				$file['size'] = 1234124;
				$file['error'] = null;
			}
			elseif ($debug == 'a2') {
				$file['name'] = 'RemoveYa-debug.apk';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'RemoveYa-debug.apk';
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
					$app = $this->Application->saveApp(array('Application'=>$extract->data), $extract->data, $extract->app, $extract->icon);
					$extract->data['id'] = (int)$this->Application->getLastInsertId();
					if ((bool)$extract->data['id']) {
						$this->History->saveHistory($extract->data['id'], 'UPL');
					}
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
