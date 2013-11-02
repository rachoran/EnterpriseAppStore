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
	
	public function getAll() {
		$data =  $this->find('all', array('order' => array('Application.name' => 'ASC')));
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function countAppsForPlatforms($platforms) {
		$options = array();
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
	
	public function numberOfAppsForPlatforms($platforms=array()) {
		
	}

	
}
