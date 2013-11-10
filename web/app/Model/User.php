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
            )
        )
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
		$data =  $this->find('all', array('order' => array('User.fullname' => 'ASC')));
		$data = $this->addGravatars($data);
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function getAllWithGroupInfo($groupId) {
		$options = array();
		$options['fields'] = array('User.id', 'GroupJoin.group_id', 'User.email', 'User.role', 'User.fullname', 'User.username');
        
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
		$options['order'] = array('User.fullname' => 'ASC');
		$data = $this->find('all', $options);
		$data = $this->addGravatars($data);
		return $data;
	}
	
}
