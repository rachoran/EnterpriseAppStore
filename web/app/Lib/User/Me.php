<?php

App::uses('AuthComponent', 'Controller/Component');


class Me {
	
	protected static $componentCollection;
	protected static $auth;
	
	protected static function checkcomponentCollection() {
		if (!self::$componentCollection || !self::$auth) {
			self::$componentCollection = new ComponentCollection();
			self::$auth = new AuthComponent(self::$componentCollection);
		}
	}
	
	public static function all() {
		self::checkcomponentCollection();
		return self::$auth->user();
	}
			
	public static function id() {
		self::checkcomponentCollection();
		return self::$auth->user('id');
	}
			
	public static function get($variable='id') {
		self::checkcomponentCollection();
		return self::$auth->user($variable);
	}
			
}