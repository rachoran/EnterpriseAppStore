<?php

class CalendarController extends AppController {
	
	public function isAuthorized($user) {
	    if (Me::minUser()) {
	        return true;
	    }
		else {
			Error::add('You are not authorized to access this section.', Error::TypeError);
			return false;
		}
	}
	
	public function index() {
		$this->setAdditionalJavascriptFiles(array('calendar'));
	}
	
}
