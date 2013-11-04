<?php

class ApplicationsController extends AppController {
	
	var $uses = array('Application', 'Category', 'Group');
	
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
	
	public function edit() {
		$this->setPageIcon('puzzle-piece');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		$this->set('categoriesList', $this->Category->getAll());
		$this->set('groupsList', $this->Group->getAll());
	}
	
}
