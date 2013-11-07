<?php

class ApplicationsController extends AppController {
	
	var $uses = array('Application', 'Category', 'Group', 'Attachment');
	
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
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		$app = $this->Application->getOne($id);
		$this->set('data', $app);
		
		if ($app['Application']['platform'] <= 2) {
			App::uses('InfoPlistTemplateParser', 'Lib/Parsing');
			$parser = new InfoPlistTemplateParser();
			$data = json_decode($app['Application']['config'], true);
			$parsed = $parser->processArray($data['plist']);
			$this->set('appSystemInfo', $parsed);
		}
		
		$apps = $this->Application->getAllHistoryForApp($app['Application']['identifier'], $app['Application']['platform']);
		$this->set('appsList', $apps);
		
		$this->set('categoriesList', $this->Category->getAll());
		$this->set('groupsList', $this->Group->getAll());
		$this->set('attachmentsList', $this->Attachment->getAllForApp($app));
	}
	
	public function edit($id=0) {
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('applications-edit'));
		
		$this->enableAjaxFileUpload();
		
		if ($this->request->is('post')) {
			$app = $this->Application->saveApp($this->request->data['appData'], $this->request->data['formData'], null);
			return $this->redirect(array('action' => 'edit', $app->id));
		}	
		$app = $this->Application->getOne($id);
		$this->set('data', $app);
		
		$this->set('categoriesList', $this->Category->getAll());
		$this->set('groupsList', $this->Group->getAll());
		$this->set('attachmentsList', $this->Attachment->getAllForApp($app));
	}
	
	public function uploadApp() {
		App::uses('ExtractAndroid', 'Lib/AppExtraction');
		App::uses('ExtractApple', 'Lib/AppExtraction');
		
		$file = $this->request->form['appFile'];
		
		$extract = null;
		$errors = null;
		
		$debug = false; // 'i' for iPhone & 'a' for Android or false to disable
		
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
			elseif ($debug == 'a') {
				$file['name'] = 'iDeviant_Enterprise.apk';
				$file['type'] = 'application/octet-stream';
				$file['tmp_name'] = 'debug';
				$file['path'] = APP.DS.'Dummy'.DS.'iJenkins_Enterprise.ipa';
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
					debug($extract->data['plist']);
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
