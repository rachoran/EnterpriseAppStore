<?php

App::uses('Me', 'Lib/User');


abstract class Extract {

	protected $file = null;
	public $data = null;
	public $icon = null;
	public $app = null;
	public $errors = null;
	public $warnings = null;
	

	public function __construct($file) {
		$this->file = $file;
	}
	
	abstract protected function isMyFile($fileExtension);
	
	public function is() {
		$fileExtension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        return $this->isMyFile($fileExtension);
    }
    
    protected function tempPath() {
    	$userId = (int)Me::id();
    	$path = TMP.$userId.DS;
    	$dir = new Folder();
		$dir->create($path);
	    return $path;
    }
    
    abstract public function process();
    
    protected function saveAppFile($app) {
	    
    }
    
	public function data() {
		return array('app'=>$this->data, 'warnings'=>$this->warnings);
	}
	
	public function clean() {
		$dir = new Folder();
		$dir->delete($this->tempPath());
	}
	
	protected function raiseError($error) {
		if (!$this->errors) {
			$this->errors = array();
		}
		$this->errors[] = $error;
	}
	
	protected function raiseWarning($warning) {
		if (!$this->warnings) {
			$this->warnings = array();
		}
		$this->warnings[] = $warning;
	}
	
}