<?php

class UsersController extends AppController {
	
	var $uses = array('User', 'Group');
	
	public function index() {
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('users', $this->User->getAll());
	}
	
	public function edit($id=0) {
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('user', $this->User->getOne($id));
		$this->set('groupsList', $this->Group->getAll());
		
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
		$this->setPageIcon('user');
		$this->set('user', $this->User->getOne($id));
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
