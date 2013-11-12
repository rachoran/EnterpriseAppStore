<?php

class History extends AppModel {
	
	public $useTable = 'history';

	public $hasOne = array(
        'Application' => array(
            'className' => 'Application',
            'unique' => 'keepExisting'
        ),
        'User' => array(
            'className' => 'User',
            'unique' => 'keepExisting'
        )
    );
	
	public function saveHistory($appId, $action) {
		$this->create();
		$this->set('application_id', (int)$appId);
		$this->set('action', strtoupper(substr($action, 0, 3)));
		// TODO: Use proper user id
		$this->set('user_id', (int)1);
		$this->save();
		return $this;
	}
		
}
