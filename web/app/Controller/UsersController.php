<?php

class UsersController extends AppController {
	
	var $uses = array('User', 'Group', 'Application');
	
	public function index() {
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('users', $this->User->getAllUsers());
	}
	
	public function edit($id=0) {
		// Setting up the page
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		// Checking for Id
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		// Groups for the join subset
		$list = $this->User->Group->find('list');
		$this->set('groups', $list);
		
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->User->findById($id);
		}
		else {
			// Saving data
			if (!$id) {
				$this->User->create();
				$this->User->save($this->request->data);
			}
			else {
				$this->User->id = $id;
				$this->User->save($this->request->data);
			}
			if (isset($this->request->data['apply'])) {
				// Redirecting for the same page (Apply)
				$this->redirect(array('controller' => 'users', 'action' => 'edit', $this->User->id, TextHelper::safeText($this->request->data['User']['username'])));
			}
			else {
				// Redirecting to the index
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		}
		
		// Selected groups
		$arr = array();
		if (isset($this->request->data['Group'])) foreach ($this->request->data['Group'] as $group) {
			$arr[$group['id']] = 1;
		}
		$this->set('selectedGroups', $arr);
	}
	
	public function view($id) {
		App::uses('Platforms', 'Lib/Platform');
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		// Getting basic user info data
		$user = $this->User->getOne($id);
		$basicInfo = array();
		$basicInfo[__('First name')] = $user['User']['firstname'];
		$basicInfo[__('Last name')] = $user['User']['lastname'];
		$basicInfo[__('Username')] = $user['User']['username'];
		$basicInfo[__('Email')] = '<a href="mailto:'.$user['User']['email'].'" title="Email '.$user['User']['firstname'].'">'.$user['User']['email'].'</a>';
		$basicInfo[__('Company')] = $user['User']['company'];
		$basicInfo[__('Registration date')] = $user['User']['created'];
		$basicInfo[__('Last online')] = 'n/a';
		$basicInfo[__('Role')] = '<strong>'.strtoupper($user['User']['role']).'</strong>';
		$this->set('basicInfo', $basicInfo);
		
		// Filling apps available through groups assigned
		$this->set('user', $user);
		$ids = array();
		$groups = $this->Group->getGroupsForUser($id, false);
		foreach ($groups as $group) {
			$ids[] = $group['Group']['id'];
		}
		$this->set('apps', $this->Application->getApplicationsWithGroupIds($ids));
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
