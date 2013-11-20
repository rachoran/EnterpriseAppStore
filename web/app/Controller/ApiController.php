<?php

class ApiController extends AppController {
	
	public function isAuthorized($user) {
	    if (Me::minDev()) {
	        return true;
	    }
		else {
			Error::add('You are not authorized to access this section.', Error::TypeError);
			return false;
		}
	}
	
}