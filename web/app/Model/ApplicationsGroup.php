<?php

class ApplicationsGroup extends AppModel {
	
	public function deleteAllWithGroup($groupId) {
		$id = (int)$groupId;
		return $this->deleteAll(array('ApplicationsGroup.group_id' => $id), false);
	}
	
	public function saveAppsForGroup($apps, $groupId=0) {
		$this->deleteAllWithGroup($groupId);
		$data = array();
		foreach ($apps as $id=>$app) {
			$data[] = array('application_id'=>(int)$id, 'group_id'=>$groupId);
		}
		$this->saveMany($data);
	}
	
}
