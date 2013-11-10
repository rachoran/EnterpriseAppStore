<?php

class GroupsController extends AppController {
	
	var $uses = array('Group', 'User', 'UsersGroup', 'Application');
	
	public function index() {
		$this->setPageIcon('group');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('labelType', 'warning');
		$this->set('groups', $this->Group->getAllWithInfo());
	}
	
	public function edit($id=0) {
		$this->setPageIcon('group');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		// Checking for Id
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		// Users for the join subset
		$list = $this->Group->User->find('list');
		$this->set('users', $list);
		
		// Users for the join subset
		$list = $this->Group->User->getAllUsers();
		$this->set('usersList', $list);
		
		// Applications for the join subset
		$list = $this->Group->Application->find('list');
		$this->set('applications', $list);
		
		// Applications for the join subset
		$list = $this->Group->Application->getAllApplications();
		debug($list);
		$this->set('applicationsList', $list);
		
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->Group->findById($id);
		}
		else {
			// Saving data
			if (!$id) {
				$this->Group->create();
				$this->Group->save($this->request->data);
			}
			else {
				$this->Group->id = $id;
				$this->Group->save($this->request->data);
			}
			if (isset($this->request->data['apply'])) {
				// Redirecting for the same page (Apply)
				$this->redirect(array('controller' => 'groups', 'action' => 'edit', $this->Group->id, $this->request->data['Group']['name']));
			}
			else {
				// Redirecting to the index
				$this->redirect(array('controller' => 'groups', 'action' => 'index'));
			}
		}
		
		// Selected users
		$arr = array();
		foreach ($this->request->data['User'] as $user) {
			$arr[$user['id']] = 1;
		}
		$this->set('selectedUsers', $arr);
		
		// Selected applications
		$arr = array();
		foreach ($this->request->data['Application'] as $app) {
			$arr[$app['id']] = 1;
		}
		$this->set('selectedApplications', $arr);
	}
	
	public function view($id) {
		App::uses('Platforms', 'Lib/Platform');
		$this->setPageIcon('group');
		$this->set('group', $this->Group->getOne($id));
	}
	
	public function delete($id) {
		$this->Group->delete((int)$id);
		return $this->redirect(array('action' => 'index'));
	}
	
}
