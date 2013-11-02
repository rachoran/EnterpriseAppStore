<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class Settings {
	
	public function index() {
		
	}
	
	public function settings() {
		$folderPath = WWW_ROOT.'Userfiles/Settings/Data/';
		$file = new File($folderPath.'settings.json', true, 0644);
		if ($file->exists()) {
			$jsonData = $file->read();
			return json_decode($jsonData, true);
		}
		else return array();
	}
	
	public function saveSettings($settings) {
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
			move_uploaded_file($settings['tmp_name']['logo'], $folderPath.'Logo.png');
		}
		if ($settings['tmp_name']['icon']) {
			move_uploaded_file($settings['tmp_name']['icon'], $folderPath.'Icon.png');
		}
		return true;
	}
	
	
}