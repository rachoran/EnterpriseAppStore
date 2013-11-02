<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        /*
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        //*/
	/*
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
	*/  
      /*
        'fullname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A full name is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'editor', 'publisher')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
        //*/
    );
    
    public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	
	public function getOne($id) {
		$this->id = $id;
        $data = $this->read(null, $id);
        unset($data['User']['password']);	
        unset($data['User']['password_token']);
        if (isset($data['User'])) $data['User']['gravatar_url'] = 'http://www.gravatar.com/avatar/'.md5($data['User']['email']).'.jpg';
        return $data;
	}
	
	public function getAll() {
		$data =  $this->find('all', array('order' => array('User.fullname' => 'ASC')));
		foreach ($data as $key=>$user) {
			$data[$key]['User']['gravatar_url'] = 'http://www.gravatar.com/avatar/'.md5($user['User']['email']).'.jpg';
		}
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function getAllWithGroupInfo($groupId) {
		$options = array();
		$options['fields'] = array('User.id', 'GroupJoin.group_id', 'User.email', 'User.role', 'User.fullname');
        
		$options['joins'] = array(
		    array('table' => 'users_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'User.id = GroupJoin.user_id',
		            'GroupJoin.group_id = '.(int)$groupId
		        )
		    )
		);
		$options['order'] = array('User.fullname' => 'ASC');
		return $this->find('all', $options);
	}
		
	public function getUsersWithGroupId($groupId) {
		$options['joins'] = array(
		    array('table' => 'users_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'INNER',
		        'conditions' => array(
		            'User.id = GroupJoin.user_id',
		        )
		    )
		);
		$options['conditions'] = array(
		    'GroupJoin.group_id' => (int)$groupId
		);
		$options['order'] = array('User.fullname' => 'ASC');
		return $this->find('all', $options);
	}
	
}
