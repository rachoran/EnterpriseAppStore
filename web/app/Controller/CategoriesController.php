<?php

class CategoriesController extends AppController {

	var $uses = array('Category');
	
	public function index() {
		$this->enablePageClass('categories');
		$this->setAdditionalCssFiles(array('categories'));
		$this->set('categories', $this->Category->getAll());
	}
	
}
