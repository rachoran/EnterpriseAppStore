<?php

class Group extends AppModel {
	
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Group name is required'
            )
        )
    );
	
	public function getAll() {
		return $this->find('all', array('order' => array('Group.name' => 'ASC')));
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Group.id' => $id)));
	}
	
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
	
	public function countAll($options=array()) {
		return $this->find('count', $options);
	}
	
	public function getAllWithInfo() {
		$options = array();
		$options['fields'] = array('*', 'count(UsersJoin.group_id) AS userCount', 'count(ApplicationsJoin.group_id) AS appsCount');
		$options['joins'] = array(
			array(
				'table' => 'users_groups',
				'alias' => 'UsersJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Group.id = UsersJoin.group_id'
				)
			),
			array(
				'table' => 'applications_groups',
				'alias' => 'ApplicationsJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Group.id = ApplicationsJoin.group_id'
				)
			) 
		);
		$options['group'] = array('Group.id');
		return $this->find('all', $options);
	}
}
