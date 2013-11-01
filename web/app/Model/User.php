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
	
	public function getUserWithId($id) {
		$this->id = $id;
        $data = $this->read(null, $id);
        unset($data['User']['password']);	
        unset($data['User']['password_token']);
        $data['User']['gravatar_url'] = 'http://www.gravatar.com/avatar/'.md5($data['User']['email']).'.jpg';
        return $data;
	}
	
}
