<?php

class Idea extends AppModel {
	
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'User name is required'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Email is required'
            )
        ),
        'message' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Message is required'
            )
        )
    );
	
	public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Idea.created' => 'ASC'
        )
    );
	
	public function getAll() {
		return $this->find('all', array('order' => array('Idea.created' => 'DESC')));
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Idea.id' => $id)));
	}
	
	public function saveIdea($idea) {
		$id = isset($idea['id']) ? (int)$idea['id'] : 0;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		$this->set('name', $idea['name']);
		$this->set('email', $idea['email']);
		$this->set('area', $idea['area']);
		$this->set('message', $idea['message']);
		$this->save();
		
		$idea['id'] = $this->id;
		return $idea;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
}
