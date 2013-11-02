<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	var $uses = array('Category', 'Group', 'User', 'Application');

	public function enableWoodWrapper() {
		$this->set('woodWrapper', ' wood-wrapper');
	}
	
	public function setPageIcon($pageIcon) {
		$this->set('pageIcon', $pageIcon);
	}
	
	public function enablePageClass($className) {
		$this->set('pageClass', ' '.$className);
	}
	
	public function setAdditionalJavascriptFiles($files) {
		$this->set('jsFiles', $files);
	}

	public function setAdditionalCssFiles($files) {
		$this->set('cssFiles', $files);
	}
	
	public function outputApi($data, $format=true, $errors=NULL) {
		$this->layout = 'ajax';
		if ($format) {
			$data = array_map('reset', $data);
			$this->set(compact('data'));
		}
		else {
			$this->set('data', $data);
		}
		$this->set('errors', $errors);
		$this->render('/Api/output');
	}

	public function beforeFilter() {
		$counts = array();
		$counts['applications'] = $this->Application->countAll();
        $counts['users'] = $this->User->countAll();
        $counts['groups'] = $this->Group->countAll();
        $counts['categories'] = $this->Category->countAll();
        $this->set('menuCounts', $counts);
    }

}
