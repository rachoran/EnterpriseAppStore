<?php

App::uses('AbstractExtract', 'Lib/AppExtraction');


class ExtractApple extends AbstractExtract {
	
	protected function isMyFile($file) {
		//debug($ssss);
		return ($file == 'ipa');
	}
	
}