<?php

App::uses('SessionComponent', 'Controller/Component');

class Error {
	
	const TypeOk = 0;
	const TypeWarning = 1;
	const TypeError = 2;
	const TypeInfo = 3;
	
	protected static $componentCollection;
	protected static $session;
	
	protected static function checkcomponentCollection() {
		if (!self::$componentCollection || !self::$session) {
			self::$componentCollection = new ComponentCollection();
			self::$session = new SessionComponent(self::$componentCollection);
		}
	}
	
	public static function add($message, $type=Error::TypeOk) {
		self::checkcomponentCollection();
		$ses = self::getAll();
		if (!$ses) $ses = array();
		$ses[$type][] = __($message);
		self::$session->write('Error', $ses);
	}
	
	public static function getAll($type='all') {
		self::checkcomponentCollection();
		$ses = self::$session->read('Error');
		return $ses;
	}
	
	public static function clear() {
		self::checkcomponentCollection();
		self::$session->write('Error', null);
	}
	
}