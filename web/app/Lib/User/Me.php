<?php

App::uses('SessionComponent', 'Controller/Component');

class Me {
	
	private static $instance;
	
	private function __construct() {
		
	}
	
	public static function all() {
		return $this->Session->read('Auth.User');
	}
			
	public static function get($variable='id') {
		return $this->Session->read('Auth.User.'.$variable);
	}
			
}