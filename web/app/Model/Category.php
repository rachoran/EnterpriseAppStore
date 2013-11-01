<?php

class Category extends AppModel {
	
	public function getAll() {
		return $this->find('all', array('order' => array('Category.name' => 'asc')));
	}
	
}
