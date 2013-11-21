<?php

class PoliciesController extends AppController {
	
	public function isAuthorized($user) {
	    if (Me::minAdmin()) {
	        return true;
	    }
		else {
			Error::add('You are not authorized to access this section.', Error::TypeError);
			return false;
		}
	}
	
}
