<?php

App::uses('BDInstall', 'Lib/Install');

class InstallController extends AppController {
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'info', 'database', 'permissions', 'success');
    }
    
    

    public function index() {
		$this->layout = 'outside';
	}
	
    public function info() {
		$this->layout = 'outside';
	}
	
    public function database() {
		$this->layout = 'outside';
	}
	
    public function permissions() {
		$this->layout = 'outside';
	}
	
    public function success() {
		$this->layout = 'outside';
	}
	
}