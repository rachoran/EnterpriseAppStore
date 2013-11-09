<?php

class DBTables {
	
	public function tables() {
		return array(
			'applications' => array(
				'table' => 'CREATE TABLE `applications` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
			'applications' => array(
				'table' => '',
				'data' => ''
			),
		);
	}
	
}