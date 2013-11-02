<?php

class UsersGroup extends AppModel {
	
	public function deleteAllWithGroup($groupId) {
		$id = (int)$groupId;
		return $this->deleteAll(array('UsersGroup.group_id' => $id), false);
	}
	
	public function saveUsersForGroup($users, $groupId=0) {
		$this->deleteAllWithGroup($groupId);
		$data = array();
		foreach ($users as $id=>$user) {
			$data[] = array('user_id'=>(int)$id, 'group_id'=>$groupId);
		}
		$this->saveMany($data);
	}
	
}
