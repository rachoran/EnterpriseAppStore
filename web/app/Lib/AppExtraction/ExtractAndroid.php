<?php

App::uses('Extract', 'Lib/AppExtraction');


class ExtractAndroid extends Extract {
	
	protected function isMyFile($fileExtension) {
		return ($fileExtension == 'apk');
	}
	
	public function process() {
		
	}

}