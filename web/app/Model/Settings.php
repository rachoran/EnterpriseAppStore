<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class Settings {
	
	public function get($var) {
		$data = $this->settings();
		if (isset($data[$var])) {
			return $data[$var];
		}
		return NULL;
	}
	
	public function settings() {
		App::import('Component', 'SessionComponent'); 
		$data = SessionComponent::read('Settings.Data');
		if ($data) {
			return $data;
		}
		$folderPath = WWW_ROOT.'Userfiles/Settings/Data/';
		$file = new File($folderPath.'settings.json', true, 0644);
		if ($file->exists()) {
			$jsonData = $file->read();
			$data = json_decode($jsonData, true);
			SessionComponent::write('Settings.Data', $data);
			return $data;
		}
		else return array();
	}
	
	public function saveSettings($settings) {
		App::import('Component', 'SessionComponent'); 
		if (!empty($settings)) SessionComponent::write('Settings.Data', $settings);;
		$folderPath = WWW_ROOT.'Userfiles/Settings/Data/';
		$dir = new Folder();
		$dir->create($folderPath);
		$file = new File($folderPath.'settings.json', true, 0644);
		$file->write(json_encode($settings));
	}
	
	public function saveFiles($settings) {
		if (!isset($settings['tmp_name'])) return false;
		$folderPath = WWW_ROOT.'Userfiles/Settings/Images/';
		$dir = new Folder();
		$dir->create($folderPath);
		if ($settings['tmp_name']['logo']) {
			move_uploaded_file($settings['tmp_name']['logo'], $folderPath.'Logo');
		}
		if ($settings['tmp_name']['icon']) {
			move_uploaded_file($settings['tmp_name']['icon'], $folderPath.'Icon');
		}
		return true;
	}
	
	
}