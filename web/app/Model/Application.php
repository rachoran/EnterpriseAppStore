<?php

class Application extends AppModel {

	static public $iOSApp = array(0, 1);
	static public $iPhoneApp = array(0);
	static public $iPadApp = array(1);
	static public $AndroidApp = array(2, 3);
	static public $AndroidPhoneApp = array(2);
	static public $AndroidTabletApp = array(3);
	static public $Windows8App = array(4);
	static public $WebApp = array(5);

	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Application name is required'
            )
        )
    );
    
    public function getOne($id) {
		$this->id = $id;
        $data = $this->read(null, $id);
        return $data;
	}
	
	public function basicOptions() {
		$options = array();
		$whereAndOrder = 'WHERE identifier = Application.identifier AND platform = Application.platform ORDER BY created DESC LIMIT 1';
		$latestName = '(SELECT name FROM applications '.$whereAndOrder.') AS name';
		$latestVersion = '(SELECT version FROM applications '.$whereAndOrder.') AS version';
		$latestCreated = '(SELECT created FROM applications '.$whereAndOrder.') AS created';
		$options['fields'] = array('*', 'COUNT(Application.id) AS count', $latestName, $latestVersion, $latestCreated);
		$options['order'] = array('Application.name' => 'ASC', 'Application.created');
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $options;
	}
	
	public function getAll() {
		$options = $this->basicOptions();
		$data =  $this->find('all', $options);
		//die(json_encode($data));
		return $data;
	}
	
	public function searchFor($term) {
		$options = $this->basicOptions();
		$options['conditions'] = array('Application.name LIKE \'%'.$term.'%\'');
		$data =  $this->find('all', $options);
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function countAppsForPlatforms($platforms) {
		$options = $this->basicOptions();
		$options['conditions'] = array();
		$options['conditions']['Application.platform'] = $platforms;
		return $this->find('count', $options);
	}
	
	public function getAllWithGroupInfo($groupId) {
		$options = array();
		$options['fields'] = array('*', 'GroupJoin.group_id');
        
		$options['joins'] = array(
		    array('table' => 'applications_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Application.id = GroupJoin.application_id',
		            'GroupJoin.group_id = '.(int)$groupId
		        )
		    )
		);
		$options['order'] = array('Application.name' => 'ASC');
		return $this->find('all', $options);
	}
		
	public function getApplicationsWithGroupId($groupId) {
		$options = array();
		$options['joins'] = array(
		    array('table' => 'applications_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'INNER',
		        'conditions' => array(
		            'Application.id = GroupJoin.application_id'
		        )
		    )
		);
		$options['conditions'] = array(
		    'GroupJoin.group_id' => (int)$groupId
		);
		$options['order'] = array('Application.name' => 'ASC');
		return $this->find('all', $options);
	}
	
	public function saveApp($appData, $confData, $files) {
		$id = isset($appData['id']) ? (int)$appData['id'] : 0;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		$this->set('name', $appData['name']);
		$this->set('identifier', $appData['identifier']);
		$this->set('version', $appData['version']);
		$this->set('sort', $appData['sort']);
		$this->set('config', json_encode($confData));
		$this->save();
		
		$appData['id'] = $this->id;
		
		return $this;
	}

	
}
