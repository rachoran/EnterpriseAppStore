<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
	public $hasAndBelongsToMany = array(
        'Group' => array(
			'className' => 'Group',
			'joinTable' => 'groups_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'group_id',
			'unique' => 'keepExisting',
	    )
    );
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 4, 40),
                'message' => 'Between 4 to 40 characters'
            )
        ),
        'firstname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Firstname is required'
            ),
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 2, 40),
                'message' => 'Between 2 to 40 characters'
            )
        ),
        'lastname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Lastname is required'
            ),
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 2, 40),
                'message' => 'Between 2 to 40 characters'
            )
        ),
        'email' => array(
        	'rule'    => array('email', true),
			'message' => 'Please supply a valid email address.'
        ),
        'password' => array(
            'rule'    => array('minLength', '8'),
            'message' => 'Minimum 8 characters long'
        ),
    );
    
    public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	
	public static function roles() {
		$arr = array();
		$arr['user'] = __('User');
		$arr['developer'] = __('Developer');
		$arr['admin'] = __('Admin');
		return $arr;
	}
	
	public function getOne($id) {
		$this->id = $id;
        $data = $this->read(null, $id);
        unset($data['User']['password']);	
        unset($data['User']['password_token']);
        if (isset($data['User'])) $data['User']['gravatar_url'] = 'http://www.gravatar.com/avatar/'.md5($data['User']['email']).'.jpg';
        return $data;
	}
	
	private function addGravatars($data) {
		foreach ($data as $key=>$user) {
			$data[$key]['User']['gravatar_url'] = 'http://www.gravatar.com/avatar/'.md5($user['User']['email']).'.jpg';
		}
		return $data;
	}
	
	public function getAllUsers() {
		$this->unbindModel(array('hasAndBelongsToMany' => array('Group')));
		$data =  $this->find('all', array('order' => array('User.lastname' => 'ASC', 'User.firstname' => 'ASC')));
		$data = $this->addGravatars($data);
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function getAllWithGroupInfo($groupId) {
		$options = array();
		$options['fields'] = array('User.id', 'GroupJoin.group_id', 'User.email', 'User.role', 'User.firstname', 'User.lastname', 'User.username', 'User.company');
        
		$options['joins'] = array(
		    array('table' => 'groups_users',
		        'alias' => 'GroupJoin',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'User.id = GroupJoin.user_id',
		            'GroupJoin.group_id = '.(int)$groupId
		        )
		    )
		);
		$options['order'] = array('User.fullname' => 'ASC');
		$data = $this->find('all', $options);
		$data = $this->addGravatars($data);
		return $data;
	}
		
	public function getUsersWithGroupId($groupId) {
		$options['joins'] = array(
		    array('table' => 'groups_users',
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
		$options['order'] = array('User.lastname' => 'ASC', 'User.firstname' => 'ASC');
		$data = $this->find('all', $options);
		$data = $this->addGravatars($data);
		return $data;
	}
	
}
