<?php

class Install {
	
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
	
}