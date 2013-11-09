<?php

class ApplicationsCategory extends AppModel {

	//var $uses = array('Application', 'Group');
	
	public $hasAndBelongsToMany = array(
        'MemberOf' => array(
            'className' => 'Category',
            'className' => 'Application',
        )
    );
	
	public function deleteAllWithCategory($groupId) {
		$id = (int)$groupId;
		return $this->deleteAll(array('ApplicationsCategory.category_id' => $id), false);
	}
	
	public function deleteAllWithApp($appId) {
		$id = (int)$appId;
		return $this->deleteAll(array('ApplicationsCategory.application_id' => $id), false);
	}
	
	public function saveAppsForCategory($apps, $groupId=0) {
		$this->deleteAllWithGroup($groupId);
		$data = array();
		foreach ($apps as $id=>$app) {
			$data[] = array('application_id'=>(int)$id, 'category_id'=>(int)$groupId);
		}
		$this->saveMany($data);
	}
	
	public function getAllForApp($appId) {
		$id = (int)$appId;
		return $this->find('all', array('conditions' => array('category_id' => $id)));
	}
	
	public function saveAppToCategories($appId, $categories) {
		$this->deleteAllWithApp($appId);
		$data = array();
		foreach ($categories as $id=>$app) {
			$data[] = array('application_id'=>(int)$appId, 'category_id'=>(int)$id);
		}
		$this->saveMany($data);
	}
	
}
