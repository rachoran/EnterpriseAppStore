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
	
	public function view() {
		$this->setPageIcon('puzzle-piece');
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
		
		$file = $this->request->form['formFile'];
		
		$extract = null;
		$errors = null;
		
		if (true) {
			$file['name'] = 'iJenkins_Enterprise.ipa';
			$file['type'] = 'application/octet-stream';
			$file['tmp_name'] = null;
			$file['size'] = 1234124;
			$file['error'] = null;
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
				$extract->process();
				$errors = $extract->errors;
			}
		}
		
		$data = ($extract != null) ? $extract->data() : null;
		
		$this->outputApi($data, false);
	}
	
}
