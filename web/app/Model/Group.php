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
	
	public function countAll() {
		return $this->find('count');
	}
	
}
