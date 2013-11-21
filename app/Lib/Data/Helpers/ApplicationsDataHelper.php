<?php

class ApplicationsDataHelper {
	
	public static function prepareBasicInfoForApp($app) {
		$basicInfo = array();
		$basicInfo[__('Application identifier')] = $app['Application']['identifier'];
		if (!empty($app['Application']['version'])) $basicInfo[__('Version')] = $app['Application']['version'];
		$basicInfo[__('Created')] = date('M. jS Y, H:i', strtotime($app['Application']['created']));
		if ($app['Application']['created'] != $app['Application']['modified']) {
			$basicInfo[__('Last modified')] = date('M. jS Y, H:i', strtotime($app['Application']['modified']));
		}
		$basicInfo[__('Platform')] = Platforms::platformToString($app['Application']['platform']);
		
		App::uses('CakeNumber', 'Utility');
		if ($app['Application']['size'] > 2) $basicInfo[__('Filesize')] = CakeNumber::toReadableSize($app['Application']['size']);
		return $basicInfo;
	}
	
	public static function prepareBasicInfoForAndroid($data, $platform, $basicInfo) {
		if (isset($data['version-code'])) {
			$basicInfo[__('Version code')] = $data['version-code'];
		}
		if (isset($data['install-location'])) {
			$basicInfo[__('Install location')] = $data['install-location'];
		}
		if (isset($data['min-sdk-version'])) {
			$basicInfo[__('Min SDK version')] = $data['min-sdk-version'];
		}
		if (isset($data['target-sdk-version'])) {
			$basicInfo[__('Target SDK version')] = $data['target-sdk-version'];
		}
		if (isset($data['large-heap'])) {
			$basicInfo[__('Large heap')] = $data['large-heap'] ? 'Yes' : 'No';
		}		
		return $basicInfo;
	}
	
	public static function prepareBasicInfoForApple($data, $platform, $basicInfo) {
		$basicInfo[__('Provisioning')] = '<strong>'.strtoupper($data['provisioning']).'</strong>';
		$basicInfo[__('Minimum OS version')] = 'iOS '.$data['plist']['MinimumOSVersion'];
		
		if (($platform == 0 || $platform == 2) && isset($data['plist']['UISupportedInterfaceOrientations'])) {
			$orientations = $data['plist']['UISupportedInterfaceOrientations'];
			$orientation = '<span style="font-size:33px;">';
			foreach ($orientations as $o) {
				if ($o == 'UIInterfaceOrientationPortrait') $rotation = 0;
				else if ($o == 'UIInterfaceOrientationPortraitUpsideDown') $rotation = 180;
				else if ($o == 'UIInterfaceOrientationLandscapeLeft') $rotation = 270;
				else if ($o == 'UIInterfaceOrientationLandscapeRight') $rotation = 90;
				$orientation .= '<i class="icon-mobile-phone icon-rotate-'.$rotation.' rounded-border" style="margin-left:12px; background:#FFF; display:block; float:left; width:40px; height:40px; text-align:center; line-height:40px;"></i>';
			}
			$basicInfo[__('iPhone orientations')] = $orientation.'</span>';
		}
		if (($platform == 1 || $platform == 2) && isset($data['plist']['UISupportedInterfaceOrientations~ipad'])) {
			$orientations = $data['plist']['UISupportedInterfaceOrientations~ipad'];
			$orientation = '<span style="font-size:33px;">';
			foreach ($orientations as $o) {
				if ($o == 'UIInterfaceOrientationPortrait') $rotation = 0;
				else if ($o == 'UIInterfaceOrientationPortraitUpsideDown') $rotation = 180;
				else if ($o == 'UIInterfaceOrientationLandscapeLeft') $rotation = 270;
				else if ($o == 'UIInterfaceOrientationLandscapeRight') $rotation = 90;
				$orientation .= '<i class="icon-mobile-phone icon-rotate-'.$rotation.' rounded-border" style="margin-left:12px; background:#FFF; display:block; float:left; width:40px; height:40px; text-align:center; line-height:40px;"></i>';
			}
			$basicInfo[__('iPad orientations')] = $orientation.'</span>';
		}
		
		$v = (string)(int)$data['plist']['DTXcode'];
		$basicInfo[__('Built with XCode')] = $v[0].'.'.$v[1].'.'.$v[2];
		
		if (isset($data['plist']['Unity_LoadingActivityIndicatorStyle'])) {
			$basicInfo[__('Thirdparty')] = 'Unity3D build';
		}
		return $basicInfo;
	}
}