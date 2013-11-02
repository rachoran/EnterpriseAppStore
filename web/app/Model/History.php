<?php

class History extends AppModel {
	
	public function saveHistory($appId, $action) {
		$this->create();
		$this->set('application_id', (int)$appId);
		$this->set('action', strtolower(substr($action, 0, 3)));
		$this->set('user_id', (int)1);
		$this->save();
		return $this;
	}
		
}
