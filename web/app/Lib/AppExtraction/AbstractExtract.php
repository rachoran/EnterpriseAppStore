<?php

abstract class AbstractExtract {

	protected $file = null;
	public $errors = null;
	

	public function __construct($file) {
		$this->file = $file;
	}
	
	abstract protected function isMyFile($file);
	
	public function is() {
		$fileExtension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        return $this->isMyFile($fileExtension);
    }
    
    abstract public function process();
    
	public function data() {
		return $this->file;
	}
	
}