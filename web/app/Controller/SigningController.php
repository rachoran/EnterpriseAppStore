<?php

class SigningController extends AppController {

	var $uses = array('Signing');
	
	public function index() {
		$this->setPageIcon('certificate');
		$this->set('signings', $this->Signing->getAll());
	}

	public function edit($id) {
		$this->setPageIcon('certificate');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('signing', $this->Signing->getOne($id));
		
		$isEdit = true;
		if ($this->request->is('post')) {
			$this->Signing->saveSigning($this->request->data['formData'], $this->request->form['formFile']);
		}
		else $isEdit = false;
		
		if ($isEdit) {
			if (isset($this->request->data['apply'])) {
				$this->redirect(array("controller" => "signing", "action" => "edit", $this->Signing->id, $this->request->data['formData']['name']));
			}
			else {
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function delete($id) {
		$this->Signing->delete((int)$id);
		$folderPath = WWW_ROOT.'Userfiles/Signing/'.$id.'/';
		$dir = new Folder();
		$dir->delete($folderPath);
		return $this->redirect(array('action' => 'index'));
	}
	
	public function downloadCert($id) {
		$s = $this->Signing->getOne($id);
		$this->viewClass = 'Media';
	    $params = array(
	        'id'        => 'cert.p12',
	        'name'      => basename($s['Signing']['certificate']),
			'extension' => 'p12',
	        'path'      => 'webroot/Userfiles/Signing/'.$id.'/',
	        'mimeType'  => array(
	            'p12'  => 'application/x-pkcs12'
	        )
	    );
	    $this->set($params);
	}

	public function downloadProv($id) {
		$s = $this->Signing->getOne($id);
		$this->viewClass = 'Media';
	    $params = array(
	        'id'        => 'prov.mobileprovision',
	        'name'      => basename($s['Signing']['provisioning']),
	        'extension' => 'mobileprovision',
	        'path'      => 'webroot/Userfiles/Signing/'.$id.'/',
	        'mimeType'  => array(
	            'mobileprovision'  => 'application/octet-stream'
	        )
	    );
	    $this->set($params);
	}
	
}
