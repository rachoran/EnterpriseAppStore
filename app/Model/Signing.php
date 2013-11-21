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

	public function saveSigning($formData, $fileData) {
		$id = (int)$formData['id'];
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		
		$this->set('name', $formData['name']);
		if (!empty($formData['password']) && $formData['password'] != 'password') {
			$this->set('password', $formData['password']);
		}
		
		$this->save();
		$id = $this->id;
		
		if (!isset($fileData['tmp_name'])) return $this;
		$folderPath = WWW_ROOT.'Userfiles/Signing/'.$id.'/';
		$dir = new Folder();
		$dir->create($folderPath);
		
		$saveAgain = false;
		if ($fileData['tmp_name']['certificate']) {
			move_uploaded_file($fileData['tmp_name']['certificate'], $folderPath.'cert.p12');
			$this->set('certificate', $fileData['name']['certificate']);
			$saveAgain = true;

		}
		if ($fileData['tmp_name']['provisioning']) {
			move_uploaded_file($fileData['tmp_name']['provisioning'], $folderPath.'prov.mobileprovision');
			$this->set('provisioning', $fileData['name']['provisioning']);
			$saveAgain = true;
		}
		
		if ($saveAgain) {
			$this->save();
		}
		
		return $this;
	}
	
}