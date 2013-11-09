<?php

class UsersController extends AppController {
	
	var $uses = array('User', 'Group', 'Application');
	
	public function index() {
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('users', $this->User->getAll());
	}
	
	public function edit($id=0) {
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('user', $this->User->getOne($id));
		$this->set('groupsList', $this->Group->getGroupsForUser($id));
		
		$isEdit = true;
		if ($this->request->is('post')) {
			$this->User->saveGroup($this->request->data['userData']);
		}
		else $isEdit = false;
		
		if ($isEdit) {
			if (isset($this->request->data['apply'])) {
				$this->redirect(array("controller" => "groups", "action" => "edit", $this->User->id, $this->request->data['fullname']));
			}
			else {
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function view($id) {
		App::uses('Platforms', 'Lib/Platform');
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		$this->set('user', $this->User->getOne($id));
		$ids = array();
		$groups = $this->Group->getGroupsForUser($id, false);
		foreach ($groups as $group) {
			$ids[] = $group['Group']['id'];
		}
		$this->set('data', $this->Application->getApplicationsWithGroupIds($ids));
	}
	
	public function delete($id) {
		$this->setPageIcon('user');
		$user = $this->User->getOne($id);
		if ($user['User']['role'] != 'owner') {
			$this->User->delete((int)$id);
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}
