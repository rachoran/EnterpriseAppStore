<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
App::uses('Group', 'Model');


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
			
	public static function role() {
		self::checkcomponentCollection();
		return self::$auth->user('role');
	}
			
	public static function roleNo() {
		$role = self::role();
		if ($role == 'owner') {
			return 3;
		}
		elseif ($role == 'admin') {
			return 2;
		}
		elseif ($role == 'developer') {
			return 1;
		}
		elseif ($role == 'user') {
			return 0;
		}
	}
			
	public static function minUser() {
		$role = self::roleNo();
		return ($role >= 0);
	}
			
	public static function minDev() {
		$role = self::roleNo();
		return ($role >= 1);
	}
			
	public static function minAdmin() {
		$role = self::roleNo();
		return ($role >= 2);
	}
			
	public static function minOwner() {
		$role = self::roleNo();
		return ($role >= 3);
	}
			
	public static function isUser() {
		$role = self::roleNo();
		return ($role == 0);
	}
			
	public static function isDev() {
		$role = self::roleNo();
		return ($role == 1);
	}
			
	public static function isAdmin() {
		$role = self::roleNo();
		return ($role == 2);
	}
			
	public static function isOwner() {
		$role = self::roleNo();
		return ($role == 3);
	}
			
	public static function get($variable='id') {
		self::checkcomponentCollection();
		return self::$auth->user($variable);
	}
	
	private static $groupIdsCache;
	
	public static function groupIds() {
		if (self::minDev()) return null;
		if (!empty(self::$groupIdsCache)) return self::$groupIdsCache;
		$group = new Group();
		$groups = $group->getGroupsForUser(self::id(), false);
		self::$groupIdsCache = array();
		foreach ($groups as $group) {
			self::$groupIdsCache[] = $group['Group']['id'];
		}
		return self::$groupIdsCache;
	}
			
}