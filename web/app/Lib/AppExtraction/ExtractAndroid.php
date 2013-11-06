<?php

App::uses('AbstractExtract', 'Lib/AppExtraction');


class ExtractAndroid extends AbstractExtract {
	
	protected function isMyFile($fileExtension) {
		return ($fileExtension == 'apk');
	}
	
	public function process() {
		
	}

}