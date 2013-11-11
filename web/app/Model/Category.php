<?php

class Category extends AppModel {
	
	public $hasAndBelongsToMany = array(
        'Application' => array(
			'className' => 'Application',
			'joinTable' => 'applications_categories',
			'foreignKey' => 'category_id',
			'associationForeignKey' => 'application_id',
			'unique' => 'keepExisting',
	    )
    );

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
		$options = array();
		$options['order'] = array('Category.name' => 'asc');
		return $this->find('all', $options);
	}
	
	public function getAllWithInfo() {
		$options = array();
		$options['fields'] = array('*', 'count(ApplicationsJoin.application_id) AS appsCount');
		$options['joins'] = array(
			array(
				'table' => 'applications_categories',
				'alias' => 'ApplicationsJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Category.id = ApplicationsJoin.category_id'
				)
			) 
		);
		$options['group'] = array('Category.id');
		$options['order'] = array('Category.name' => 'asc');
		$data = $this->find('all', $options);
		return $data;
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
	
	public function getAllForApp($appId) {
		$options = array();
		$options['fields'] = array('*');
		$options['joins'] = array(
			array(
				'table' => 'applications_categories',
				'alias' => 'ApplicationsJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Category.id = ApplicationsJoin.category_id',
					'ApplicationsJoin.application_id' => (int)$appId
				)
			) 
		);
		//$options['group'] = array('Category.id');
		$options['order'] = array('Category.name' => 'ASC');
		return $this->find('all', $options);
	}
		
}
