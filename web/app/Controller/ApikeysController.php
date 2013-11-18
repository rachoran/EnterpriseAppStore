<?php

class ApikeysController extends AppController {
	
	var $uses = array('Apikey');
	
	public function alalalalal() {
		$this->setPageIcon('gear');
		if ($this->request->is('post')) {
			$this->Settings->saveSettings($this->request->data['settings']);
			if (isset($this->request->form['file'])) {
				$this->Settings->saveFiles($this->request->form['file']);
			}
			Error::add('Settings has been successfully updated.');
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('settings', $this->Settings->settings());
	}
	
	public function index() {
		$this->setPageIcon('key');
		$this->set('data', $this->Apikey->getAll());
	}
	
	public function delete($id) {
		$ok = $this->Apikey->deleteOne($id);
		if ($ok) {
			Error::add('Key has been successfully deleted.');
		}
		else {
			Error::add('Unable to delete this key.', Error::TypeError);
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function edit($id) {
		$this->setPageIcon('key');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		// Checking for Id
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->Apikey->findById($id);
		}
		else {
			// Saving data
			if ($id) {
				$this->request->data['Apikey']['id'] = $id;
			}
			
			$ok = $this->Apikey->saveKey($this->request->data['Apikey']);
			if ($ok) Error::add('Key has been saved successfully.');
			else {
				Error::add('Unable to save this key.', Error::TypeError);
				return false;
			}
			
			if (isset($this->request->data['apply'])) {
				// Redirecting for the same page (Apply)
				return $this->redirect(array('controller' => 'apikeys', 'action' => 'edit', $this->Apikey->id, TextHelper::safeText($this->request->data['Apikey']['name'])));
			}
			else {
				// Redirecting to the index
				return $this->redirect(array('action' => 'index'));
			}
		}
		
		$this->set('data', $this->request->data);
	}
	
}
