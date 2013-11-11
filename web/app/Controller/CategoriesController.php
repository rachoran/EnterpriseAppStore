<?php

App::uses('Platforms', 'Lib/Platform');

class CategoriesController extends AppController {

	var $uses = array('Category', 'Application');
	
	public function index() {
		$this->setPageIcon('list-ul');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('categories', $this->Category->getAllWithInfo());
	}
	
	public function edit($id=0) {
		$this->setPageIcon('list-ul');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('category', $this->Category->getOne($id));
		
		// Checking for Id
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		// Applications for the join subset
		$list = $this->Category->Application->find('list');
		$this->set('applications', $list);
		
		// Applications for the join subset
		$list = $this->Category->Application->getAllApplications();
		$this->set('applicationsList', $list);
		
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->Category->findById($id);
		}
		else {
			// Saving data
			if (!$id) {
				$this->Category->create();
				$this->Category->save($this->request->data);
			}
			else {
				$this->Category->id = $id;
				$this->Category->save($this->request->data);
			}
			if (isset($this->request->data['apply'])) {
				// Redirecting for the same page (Apply)
				$this->redirect(array("controller" => "categories", "action" => "edit", $this->Category->id, $this->request->data['name']));
			}
			else {
				// Redirecting to the index
				$this->redirect(array('action' => 'index'));
			}
		}
		
		// Selected applications
		$arr = array();
		foreach ($this->request->data['Application'] as $app) {
			$arr[$app['id']] = 1;
		}
		$this->set('selectedApplications', $arr);
	}
	
	public function view($id) {
		$cat = $this->Category->getOne($id);
		$this->set('category', $cat);
		$this->setPageIcon(eregi_replace('icon-', '', $cat['Category']['icon']));
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		$this->set('category', $cat);
		
		$apps = $this->Application->getAllForCategory($id);
		$this->set('apps', $apps);
	}
	
	public function delete($id) {
		$this->Category->delete((int)$id);
		return $this->redirect(array('action' => 'index'));
	}
	
}
