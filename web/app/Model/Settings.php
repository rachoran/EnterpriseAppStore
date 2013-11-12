<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class Settings {
	
	public $useTable = false;
	
	public static $settings;
	
	public function get($var) {
		$data = $this->settings();
		if (isset($data[$var])) {
			return $data[$var];
		}
		return NULL;
	}
	
	public function settings() {
		$data = Settings::$settings;
		if ($data) {
			return $data;
		}
		$folderPath = WWW_ROOT.'Userfiles/Settings/Data/';
		$file = new File($folderPath.'settings.json', true, 0644);
		if ($file->exists()) {
			$jsonData = $file->read();
			$data = json_decode($jsonData, true);
			Settings::$settings = $data;
			return $data;
		}
		else return array();
	}
	
	public function saveSettings($settings) {
		if (!empty($settings)) Settings::$settings = $settings;
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