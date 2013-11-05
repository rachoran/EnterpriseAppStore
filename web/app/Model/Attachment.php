<?php

class Attachment extends AppModel {
	
	public function getAll() {
		$options = array();
		$options['fields'] = array('Attachment.*', 'FiletypesJoin.*');
		$options['joins'] = array(
			array(
				'table' => 'filetypes',
				'alias' => 'FiletypesJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Attachment.id = FiletypesJoin.id'
				)
			) 
		);
		$options['order'] = array('Attachment.name' => 'asc');
		$data = $this->find('all', $options);
		return $data;
	}
	
	public function getAllForApp($app) {
		$options = array();
		$options['fields'] = array('Attachment.*', 'FiletypesJoin.*');
		$options['joins'] = array(
			array(
				'table' => 'filetypes',
				'alias' => 'FiletypesJoin',
				'type' => 'LEFT',
				'conditions' => array(
					'Attachment.id = FiletypesJoin.id'
				)
			) 
		);
		$options['conditions'] = array('Attachment.application_id' => $app['Application']['id']);
		$options['order'] = array('Attachment.name' => 'asc');
		$data = $this->find('all', $options);
		return $data;
	}
	
	public function getOne($id) {
		$id = (int)$id;
		return $this->find('first', array('conditions' => array('Attachment.id' => $id)));
	}
	
	public function saveAttachment($id, $name, $description, $icon) {
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
