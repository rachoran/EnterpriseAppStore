<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('Settings', 'Model');


class User extends AppModel {
	
	public $dontEncodePassword = false;
    
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
            ),
            'unique' => array(
		        'rule' => 'isUnique',
		        'message' => 'Username is already registered'
		    ),
    
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
			'required' => array(
                'rule'    => array('email'),
				'message' => 'Please supply a valid email address.',
            ),
            'unique' => array(
		        'rule' => 'isUnique',
		        'message' => 'Email is already registered'
		    ),
		    'isEmailAllowed' => array(
				'rule' => array('isEmailAllowed'), 
				'message' => 'Email is not registered with an allowed domain.' 
			)
        ),
        'password' => array(
            'required' => array(
                'rule'    => array('minLength', '8'),
				'message' => 'Minimum 8 characters long',
            ),
		    'identicalFieldValues' => array(
				'rule' => array('identicalFieldValues', 'password2'), 
				'message' => 'Passwords don\'t match' 
			)
        )
    );
    
    public function isEmailAllowed($field=array()) {
    	$settings = new Settings();
    	$emails = $settings->get('sefRegDomains');
    	if (!empty($emails)) {
	    	foreach(preg_split("/((\r?\n)|(\r\n?))/", $emails) as $line) {
		    	$domain = trim($line);
		    	$domain = preg_replace('/\./si', '\.', $domain);
		    	if (preg_match('/'.$domain.'/si', $field['email'])) {
			    	return true;
		    	}
	    	}
	    	return false;
    	}
    	else return true;
    }
    
    public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password']) && !$this->dontEncodePassword) {
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
		if (!Me::minAdmin()) return false;
		$this->unbindModel(array('hasAndBelongsToMany' => array('Group')));
		$data =  $this->find('all', array('order' => array('User.lastname' => 'ASC', 'User.firstname' => 'ASC')));
		$data = $this->addGravatars($data);
		return $data;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
	public function checkForDefaultUser() {
		return (bool)$this->find('count', array('conditions' => array('User.username' => 'admin', 'User.password' => '3a37e68dd29ea23ff7fc9cf009da7bef9a13a5f4')));
	}
	
	public function isUsername($username) {
		return (bool)$this->find('count', array('conditions' => array('User.username' => $username)));
	}
	
	public function isEmail($email) {
		return (bool)$this->find('count', array('conditions' => array('User.email' => $email)));
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
	
	public function saveUser($data) {
		if (!Me::minAdmin()) return false;
		return $this->save($data, true);
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
	
	public function deleteUser($id) {
		if (!Me::minAdmin()) return false;
		$user = $this->getOne($id);
		if (isset($user['User']['role']) && $user['User']['role'] != 'owner' && $user['User']['id'] != Me::id()) {
			return $this->delete((int)$id);
		}
		return false;
	}
	
}
