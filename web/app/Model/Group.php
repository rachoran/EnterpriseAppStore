<?php

class Group extends AppModel {
	
	public $hasAndBelongsToMany = array(
        'Application' => array(
			'className' => 'Application',
			'joinTable' => 'applications_groups',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'application_id',
			'unique' => 'keepExisting',
	    ),
        'User' => array(
			'className' => 'User',
			'joinTable' => 'groups_users',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
	    )
    );
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Group name is required'
            )
        )
    );
	
	public function saveGroup($id, $name, $description) {
		$id = (int)$id;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		$this->set('name', $name);
		$this->set('description', $description);
		$this->save();
		return $this;
	}
	
	public function getAll() {
		$options = array('order' => array('Group.name' => 'ASC'));
		$data = $this->find('all', $options);
		return $data;
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Group.id' => $id)));
	}
	
	public function countAll($options=array()) {
		return $this->find('count', $options);
	}
	
	public function getAllWithInfo() {
		$options = array();
		$options['fields'] = array('*');
		$options['group'] = array('Group.id');
		$options['order'] = array('Group.name' => 'ASC');
		$data = $this->find('all', $options);
		return $data;
	}

	public function getGroupsForUser($userId, $fullData=true) {
		$options = array();
		if (!$fullData) {
			$this->unbindModel(
				array('hasAndBelongsToMany' => array('User', 'Application'))
			);
		}
		$options['fields'] = array('id');
		$options['joins'] = array(
			array(
				'table' => 'groups_users',
				'alias' => 'UsersJoin',
				'type' => 'INNER',
				'conditions' => array(
					'Group.id = UsersJoin.group_id',
					'UsersJoin.user_id' => (int)$userId
				)
			) 
		);
		$options['group'] = array('Group.id');
		$options['order'] = array('Group.name' => 'ASC');
		$data = $this->find('all', $options);
		return $data;
	}
	
	public function getAllForApp($appId) {
		$options = array();
		$options['fields'] = array('*');
		$options['joins'] = array(
			array(
				'table' => 'applications_groups',
				'alias' => 'ApplicationsJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Group.id = ApplicationsJoin.group_id',
					'ApplicationsJoin.application_id' => (int)$appId
				)
			) 
		);
		$options['group'] = array('Group.id');
		$options['order'] = array('Group.name' => 'ASC');
		return $this->find('all', $options);
	}

}
