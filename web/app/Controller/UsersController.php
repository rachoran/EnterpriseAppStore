<?php

class UsersController extends AppController {
	
	var $uses = array('User');
	
	public function index() {
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('users', $this->User->getAll());
	}
	
	public function edit($id=0) {
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('user', $this->User->getOne($id));
		
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
		$this->set('user', $this->User->getOne($id));
	}
	
	public function delete($id) {
		$this->User->delete((int)$id);
		return $this->redirect(array('action' => 'index'));
	}
	
}
