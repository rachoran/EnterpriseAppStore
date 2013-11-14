<?php

class Install {
	
	const DBConnectionOk = 0;
	const DBConnectionFailed = 1;
	const DBConnectionBadDb = 2;
	
	public static function isShellMethod($methodName) {
		return (bool)@shell_exec('which '.$methodName);
	}
	
	public static function isS3Available() {
		return (bool)@file_get_contents('https://s3-eu-west-1.amazonaws.com/ridiculousenterpriseappstore/test.txt');
	}
	
	public static function isFolderWritable($folder) {
		$file = new File(APP.$folder.'test.txt', true);
		$ok = $file->exists();
		if ($ok) {
			$file->delete();
		}
		return $ok;
	}
	
	public static function isFileWritable($file) {
		$file = new File(APP.$file, false);
		return $file->writable();
	}
	
	public static function databaseConfiguration() {
		if (file_exists(APP.'Config'.DS.'database.php')) {
			App::uses('ConnectionManager', 'Model');
			$dataSource = ConnectionManager::getDataSource('default');
			return $dataSource->config;
		}
		else return null;
	}
	
	public static function isMySQLCool($dbConf) {
		$conn = @mysql_connect($dbConf['host'], $dbConf['login'], $dbConf['password']);
		if (!$conn) {
			return self::DBConnectionFailed;
		}
		else {
			if (@mysql_select_db($dbConf['database'], $conn)) {
				return self::DBConnectionOk;
			}
			else return self::DBConnectionBadDb;
		}
	}	
	
}