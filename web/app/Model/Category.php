<?php

class Category extends AppModel {
	
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Category name is required'
            )
        ),
        'icon' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Icon code is required'
            )
        )
    );
	
	public function getAll() {
		return $this->find('all', array('order' => array('Category.name' => 'asc')));
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Category.id' => $id)));
	}
	
	public function saveCategory($id, $name, $description, $icon) {
		$id = (int)$id;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		$this->set('name', $name);
		$this->set('description', $description);
		$this->set('icon', $icon);
		$this->save();
		return $this;
	}
	
	public function countAll() {
		return $this->find('count');
	}
	
}
