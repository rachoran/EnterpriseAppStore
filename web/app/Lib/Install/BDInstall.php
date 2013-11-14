<?php

App::uses('Model', 'Model');

class BDInstall {
	
	public function executeQuery($query) {
		debug($query);
		return false;
		
		$model = new Model();
		$model->query($query);
	}
	
	public function install() {
		$arr = $this->tables();
		foreach ($arr as $name=>$sql) {
			$this->executeQuery($sql['table']);
			if (!empty($sql['data']) && is_array($sql['data'])) foreach ($sql['data'] as $query) {
				$this->executeQuery($query);
			}
		}
	}
	
	public function tables() {
		return array(
			// Applications
			'applications' => array(
				'table' => "CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identifier` varchar(150) NOT NULL,
  `url` text NOT NULL,
  `platform` tinyint(2) unsigned NOT NULL,
  `version` varchar(15) NOT NULL,
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `sort` int(5) unsigned NOT NULL DEFAULT '1000',
  `config` text NOT NULL,
  `location` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`identifier`,`platform`,`sort`),
  KEY `version` (`version`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Applications_attachments
			'applications_attachments' => array(
				'table' => "CREATE TABLE `applications_attachments` (
  `application_id` bigint(20) unsigned NOT NULL,
  `attachment_id` bigint(20) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`attachment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Application_groups
			'applications_groups' => array(
				'table' => "CREATE TABLE `applications_groups` (
  `application_id` bigint(20) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Attachments
			'attachments' => array(
				'table' => "CREATE TABLE `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) unsigned DEFAULT NULL,
  `application_identifier` varchar(150) NOT NULL,
  `application_platform` tinyint(2) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filetype_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`,`name`,`created`,`modified`),
  KEY `application_identifier` (`application_identifier`),
  KEY `application_platform` (`application_platform`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Categories
			'categories' => array(
				'table' => "CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Travel', '', 'icon-plane', NOW(), NOW());",
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Health', '', 'icon-ambulance', NOW(), NOW());",
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Photography', '', 'icon-camera', NOW(), NOW());",
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Games', '', 'icon-fighter-jet', NOW(), NOW());",
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Legal', '', 'icon-legal', NOW(), NOW());",
					"INSERT INTO `categories` (`name`, `description`, `icon`, `created`, `modified`) VALUES('Utilities', '', 'icon-lightbulb', NOW(), NOW());",
				),
			),
			
			// Signings
			'signings' => array(
				'table' => "CREATE TABLE `signings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `certificate` varchar(250) NOT NULL,
  `password` varchar(150) NOT NULL,
  `provisioning` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Downloads
			'downloads' => array(
				'table' => "CREATE TABLE `downloads` (
  `application_id` bigint(20) unsigned NOT NULL,
  `created` datetime NOT NULL,
  KEY `application_id` (`application_id`,`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			//Filetypes (mime)
			'filetypes' => array(
				'table' => "CREATE TABLE `filetypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mime` varchar(25) NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mime` (`mime`,`allowed`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Groups
			'groups' => array(
				'table' => "CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `all_versions_available` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`created`,`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// History
			'history' => array(
				'table' => "CREATE TABLE `history` (
  `application_id` bigint(20) unsigned NOT NULL,
  `action` varchar(3) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`action`,`created`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Ideas
			'ideas' => array(
				'table' => "CREATE TABLE `ideas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(80) NOT NULL,
  `area` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`,`area`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			// Users
			'users' => array(
				'table' => "CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `company` varchar(80) NOT NULL,
  `password_token` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nickname` (`username`,`email`,`password`),
  KEY `role` (`role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
				'data' => array(
					"INSERT INTO `users` (`username`, `email`, `password`, `role`, `created`, `modified`, `firstname`, `lastname`, `company`, `password_token`) VALUES('admin', 'admin@example.com', '3a37e68dd29ea23ff7fc9cf009da7bef9a13a5f4', 'owner', NOW(), NOW(), 'Super', 'Admin', 'Company', '');",
				),
			),
			
			// Groups_users
			'groups_users' => array(
				'table' => "CREATE TABLE `users_groups` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'data' => array(),
			),
			
			/*
			// Xxxxxx
			'xxxx' => array(
				'table' => "',
				'data' => array(),
			),
			*/
		);
	}
	
}