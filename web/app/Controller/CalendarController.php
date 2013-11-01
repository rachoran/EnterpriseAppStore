<?php

class CalendarController extends AppController {
	
	public function index() {
		$this->setAdditionalJavascriptFiles(array('calendar'));
	}
	
}
