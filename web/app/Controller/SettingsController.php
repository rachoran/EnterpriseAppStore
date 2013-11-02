<?php

class SettingsController extends AppController {
	
	var $uses = array('Settings');
	
	public function index() {
		if ($this->request->is('post')) {
			$this->Settings->saveSettings($this->request->data['settings']);
		}
		$this->set('settings', $this->Settings->settings());
	}
	
}
