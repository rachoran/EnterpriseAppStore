<?php

App::uses('Settings', 'Model');
App::import('Vendor/S3', 'S3');


define('STORAGE_LOCAL', 0);
define('STORAGE_S3', 1);
define('STORAGE_FTP', 2); // Currently not being used

class Storage {

	public static function usedStorage() {
		$s = new Settings();
		$s3Enabled = $s->get('s3Enable');
		return $s3Enabled ? STORAGE_S3 : STORAGE_LOCAL;
	}
	
	public static function isIconForAppWithId($id) {
		if (Storage::usedStorage() == STORAGE_LOCAL) {
			die('Local');
		}
		else {
			$path = md5(Configure::read('Security.salt').Configure::read('Security.cipherSeed')).DS.'Applications'.DS.$id.DS.'icon.png';
			$s = new Settings();
			S3::setAuth($s->get('s3AccessKey'), $s->get('s3SecretKey'));
		}
	}
	
	public static function urlForIconForAppWithId($id) {
		if (Storage::usedStorage() == STORAGE_LOCAL) {
			die('Local');
		}
		else {
			$path = md5(Configure::read('Security.salt').Configure::read('Security.cipherSeed')).DS.'Applications'.DS.$id.DS.'icon.png';
			$s = new Settings();
			return 'http://'.$s->get('s3Bucket').'.s3.amazonaws.com/'.$path;
		}
	}
	
	public static function saveFile($file, $section='General', $protected=true) {
		$ok = false;
		if (Storage::usedStorage() == STORAGE_LOCAL) {
			die('Local');
		}
		else {
			$s = new Settings();
			S3::setAuth($s->get('s3AccessKey'), $s->get('s3SecretKey'));
			$ok = S3::putObject(S3::inputFile($file, false), $s->get('s3Bucket'), md5(Configure::read('Security.salt').Configure::read('Security.cipherSeed')).DS.$section.DS.pathinfo($file, PATHINFO_BASENAME), ($protected ? S3::ACL_PRIVATE : S3::ACL_PUBLIC_READ));
		}
		return $ok;
	}
	
	public static function deleteFile($file, $protected=true) {
		if (Storage::usedStorage() == STORAGE_LOCAL) {
			
		}
		else {
			S3::setAuth($s->get('s3AccessKey'), $s->get('s3SecretKey'));
		}
	}
	
}
