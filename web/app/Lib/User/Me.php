<?php

App::uses('SessionComponent', 'Controller/Component');

class Me {
	
	private static $instance;
	
	private function __construct() {
		
	}
	
	public static function init() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
			
}