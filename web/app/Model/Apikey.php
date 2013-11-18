<?php

class Apikey extends AppModel {
	
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Key name is required'
            )
        )
    );
	
	public function getAll() {
		return $this->find('all', array('order' => array('Apikey.name' => 'ASC')));
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Apikey.id' => $id)));
	}
	
	public function saveKey($key) {
		$id = isset($key['id']) ? (int)$key['id'] : 0;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
			$this->set('key', sha1(time()));
		}
		$this->set('name', $key['name']);
		return (bool)$this->save();
	}
	
	public function deleteOne($id) {
		$id = (int)$id;
		return $this->delete($id);
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
}
