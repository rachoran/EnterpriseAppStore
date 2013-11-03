<?php

class SigningController extends AppController {

	var $uses = array('Signing');
	
	public function index() {
		$this->set('signings', $this->Signing->getAll());
	}
	
}
