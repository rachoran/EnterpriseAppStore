<?php

class Signing extends AppModel {
	
	public function getAll() {
		return $this->find('all', array('order' => array('Signing.name' => 'ASC')));
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Signing.id' => $id)));
	}
		
	public function countAll($options=array()) {
		return $this->find('count', $options);
	}

	
}