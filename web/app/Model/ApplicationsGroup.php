<?php

class ApplicationsGroup extends AppModel {

	//var $uses = array('Application', 'Group');
	
	public $hasAndBelongsToMany = array(
        'MemberOf' => array(
            'className' => 'Group',
            'className' => 'Application',
        )
    );
	
	public function deleteAllWithGroup($groupId) {
		$id = (int)$groupId;
		return $this->deleteAll(array('ApplicationsGroup.group_id' => $id), false);
	}
	
	public function deleteAllWithApp($appId) {
		$id = (int)$appId;
		return $this->deleteAll(array('ApplicationsGroup.application_id' => $id), false);
	}
	
	public function saveAppsForGroup($apps, $groupId=0) {
		$this->deleteAllWithGroup($groupId);
		$data = array();
		foreach ($apps as $id=>$app) {
			$data[] = array('application_id'=>(int)$id, 'group_id'=>(int)$groupId);
		}
		$this->saveMany($data);
	}
	
	public function getAllForApp($appId) {
		$id = (int)$appId;
		return $this->find('all', array('conditions' => array('group_id' => $id)));
	}
	
	public function saveAppToGroups($appId, $groups) {
		$this->deleteAllWithApp($appId);
		$data = array();
		foreach ($groups as $id=>$app) {
			$data[] = array('application_id'=>(int)$appId, 'group_id'=>(int)$id);
		}
		$this->saveMany($data);
	}
	
}
