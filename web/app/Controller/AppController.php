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
App::uses('Error', 'Lib/Errors');
App::uses('TextHelper', 'Lib/Text');
App::uses('Me', 'Lib/User');
App::uses('Install', 'Lib/Install');

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
	
	var $uses = array('Category', 'Group', 'User', 'Application', 'Settings', 'Signing');
	
	public $components = array(
	    'Session',
	    'Auth' => array(
	        'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
	        'authorize' => array('Controller')
	    ),
	    'Cookie'
	);
	
	public function beforeFilter() {
		// Installation check
		if (!Install::isInstallLocked()) {
			$this->redirect('/install');
		}
		
		// Authentication - set cookie options
	    $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
	    $this->Cookie->httpOnly = true;
	
	    if (!$this->Auth->loggedIn() && $this->Cookie->read('remember_me_cookie')) {
	        $cookie = $this->Cookie->read('remember_me_cookie');
			
	        $user = $this->User->find('first', array(
	            'conditions' => array(
	                'User.username' => $cookie['username'],
	                'User.password' => $cookie['password']
	            )
	        ));
	
	        if ($user) {
	        	if ($this->Auth->login($user)) {
	        		Error::add('Login refreshed using cookies.', Error::TypeInfo);
	        	}
	        	else {
		        	Error::add('Invalid cookie login.', Error::TypeError);
		            $this->redirect('/users/logout');
	            }
	        }
	    }
	    
	    // Page data
		$counts = array();
		
		// Counting items (primarily for the left menu but used elsewhere)
		$counts['applications'] = $this->Application->countAll();
        $counts['users'] = $this->User->countAll();
        $counts['groups'] = $this->Group->countAll();
        $counts['categories'] = $this->Category->countAll();
        $counts['signing'] = $this->Signing->countAll();
        $this->set('menuCounts', $counts);
		
		// Debugging
		$this->set('debugMySQL', $this->Settings->get('debugMySQL'));
        
        // Global vars
        $siteName = $this->Settings->get('companyServerName');
        $this->set('siteName', (empty($siteName) ? __('AppStore') : $siteName));
    }

	public function isAuthorized($user) {
	    if (isset($user['role']) && ($user['role'] === 'owner' || $user['role'] === 'admin')) {
	        return true;
	    }
		if (true) {
			Error::add('No permissions set for '.$this->params['controller'].' / '.$this->params['action'].'.', Error::TypeInfo);
			return true;
		}
	    return false;
	}

	public function enableWoodWrapper() {
		$this->set('woodWrapper', ' wood-wrapper');
	}
	
	public function setPageIcon($pageIcon) {
		$this->set('pageIcon', $pageIcon);
	}
	
	public function enableAjaxFileUpload() {
		$this->set('ajaxFileUpload', true);
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

}
