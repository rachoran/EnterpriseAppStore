<?php

App::uses('PlistTemplateParser', 'Lib/Parsing');

class InfoPlistTemplateParser extends PlistTemplateParser {
	
	protected function templateArray() {
		return array(
			'CFBundleDevelopmentRegion' => array('name' => 'Development region'),
			'CFBundleDisplayName' => array('name' => 'Display name'),
			'CFBundleExecutable' => array('name' => 'Executable name'),
			'CFBundleIdentifier' => array('name' => 'Bundle identifier'),
			'CFBundleInfoDictionaryVersion' => array('name' => 'InfoDictionary version'),
			'CFBundleName' => array('name' => 'Bundle name'),
			'CFBundlePackageType' => array('name' => 'Bundle OS Type code'),
			'CFBundleShortVersionString' => array('name' => 'Bundle versions string, short'),
			'CFBundleVersion' => array('name' => 'Bundle version'),
			'LSApplicationCategoryType' => array('name' => 'Category type'),
			'LSRequiresIPhoneOS' => array(
				'name' => 'Require iPhone OS',
				'boolean' => true
			),
			'DTXcode' => array(
				'name' => 'XCode version',
				'fourversion' => true
			),
			'DTSDKName' => array('name' => 'SDK name'),
			'DTSDKBuild' => array('name' => 'SDK build'),
			'BuildMachineOSBuild' => array('name' => 'Build machine build'),
			'DTPlatformName' => array('name' => 'Platform name'),
			'CFBundlePackageType' => array('name' => 'Bundle package type'),
			'CFBundleSupportedPlatforms' => array(
				'name' => 'Supported platforms',
				'results' => array(
					'iPhoneOS' => 'iPhone OS'
				)
			),
			'UIRequiredDeviceCapabilities' => array('name' => 'Required device papabilities'),
			'DTCompiler' => array('name' => 'Compiler'),
			'MinimumOSVersion' => array('name' => 'Minimum OS version'),
			'UIDeviceFamily' => array(
				'name' => 'Device family',
				'results' => array(
					'1' => 'iPhone or iPod',
					'2' => 'iPad'
				)
			), // 1 iPhone, 2 iPad
			'DTXcodeBuild' => array('name' => 'XCode build'),
			'UIAppFonts' => array('name' => 'App fonts'),
			'DTPlatformVersion' => array('name' => 'Platform version'),
			'DTPlatformBuild' => array('name' => 'Platform build'),
			'UISupportedInterfaceOrientations' => array(
				'name' => 'Supported orientations for iPhone &amp; iPod',
				'results' => array(
					'UIInterfaceOrientationPortrait' => 'Portrait',
					'UIInterfaceOrientationPortraitUpsideDown' => 'Upside down',
					'UIInterfaceOrientationLandscapeLeft' => ' Landscape left',
					'UIInterfaceOrientationLandscapeRight' => 'Landscape right'
				)
			),
			'UISupportedInterfaceOrientations~ipad' => array(
				'name' => 'Supported orientations for iPad'
			),
			/*
'UIViewControllerBasedStatusBarAppearance' => array(
				'name' => 'Status bar appearance'
			)
*/
		);
	}
	
}