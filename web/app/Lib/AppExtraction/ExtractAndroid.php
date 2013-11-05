<?php

App::uses('AbstractExtract', 'Lib/AppExtraction');


class ExtractAndroid extends AbstractExtract {
	
	protected function isMyFile($file) {
		return ($file == 'apk');
	}
	
	public function process() {
		
	}

}