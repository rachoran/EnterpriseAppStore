<?php

class GroupsController extends AppController {
	
	var $uses = array('Group', 'ApplicationsGroup', 'User', 'UsersGroup', 'Application');
	
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
		$this->set('group', $this->Group->getOne($id));
		
		$this->set('usersList', $this->User->getAllWithGroupInfo($id));
		$this->set('applicationsList', $this->Application->getAllWithGroupInfo($id));
		
		$isEdit = true;
		if ($this->request->is('post')) {
			$group = $this->Group->saveGroup($this->request->data['id'], $this->request->data['name'], $this->request->data['description']);
			
			// Saving users
			if (!isset($this->request->data['user']) || empty($this->request->data['user'])) {
				$this->UsersGroup->deleteAllWithGroup($group->id);
			}
			else $this->UsersGroup->saveUsersForGroup($this->request->data['user'], $group->id);
			
			// Saving applications
			if (!isset($this->request->data['application']) || empty($this->request->data['application'])) {
				$this->ApplicationsGroup->deleteAllWithGroup($group->id);
			}
			else $this->ApplicationsGroup->saveAppsForGroup($this->request->data['application'], $group->id);
		}
		else $isEdit = false;
		
		if ($isEdit) {
			if (isset($this->request->data['apply'])) {
				$this->redirect(array("controller" => "groups", "action" => "edit", $this->Group->id, $this->request->data['name']));
			}
			else {
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function view($id) {
		$this->setPageIcon('group');
		$this->set('group', $this->Group->getOne($id));
	}
	
	public function delete($id) {
		$this->Group->delete((int)$id);
		return $this->redirect(array('action' => 'index'));
	}
	
}
