<?php

class UsersController extends AppController {
	
	var $uses = array('User', 'Group', 'Application');
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'register', 'logout');
    }

    public function login() {
    	$this->layout = 'outside';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	Error::add('You have been logged in.', Error::TypeOk);
	        	if (isset($this->request->data['User']['remember_me']) && $this->request->data['User']['remember_me'] == 1) {
	                unset($this->request->data['User']['remember_me']);
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
					$this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '1 day');
	            }	
	            return $this->redirect($this->Auth->redirect());
	        }
	        Error::add('Invalid username or password, please try again.', Error::TypeError);
	    }
	}
	
	public function register() {
		$this->layout = 'outside';
        if ($this->request->is('post')) {
        	if ($this->User->isUsername($this->request->data['User']['username'])) {
	        	
        	}
            $this->User->create();
            $this->request->data['User']['role'] = 'user';
            if ($this->User->save($this->request->data)) {
                Error::add('The user has been registered', Error::TypeOk);
                $this->login();
            }
            Error::add('The user could not be saved. Please, try again.', Error::TypeError);
        }
    }
	
	public function logout() {
		$this->Cookie->write('remember_me_cookie',  null);
		Error::add('You have been successfully logged out.', Error::TypeOk);
	    return $this->redirect($this->Auth->logout());
	}

	public function index() {
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->set('users', $this->User->getAllUsers());
	}
	
	public function edit($id=0) {
		// Setting up the page
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		
		// Checking for Id
		if ($id == 'new') {
			$id = 0;
		}
		else $id = (int)$id;
		
		// Groups for the join subset
		$list = $this->User->Group->find('list');
		$this->set('groups', $list);
		
		$ok = false;
		if (empty($this->request->data)) {
			// Getting data
        	$this->request->data = $this->User->findById($id);
		}
		else {
			// Saving data
			if (!$id) {
				$this->User->create();
			}
			else {
				$this->User->id = $id;
			}
			
			$ok = $this->User->save($this->request->data, true);
			if ($ok) {
				Error::add('User has been successfully saved.');
				if (isset($this->request->data['apply'])) {
					// Redirecting for the same page (Apply)
					$this->redirect(array('controller' => 'users', 'action' => 'edit', $this->User->id, TextHelper::safeText($this->request->data['User']['username'])));
				}
				else {
					// Redirecting to the index
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
			}
			else {
				Error::add('Unable to save this user.', Error::TypeError);
			}
		}
		
		// Selected groups
		$arr = array();
		if (isset($this->request->data['Group'])) foreach ($this->request->data['Group'] as $group) {
			if (!is_array($group)) $arr[(int)$group] = 1;
			else $arr[$group['id']] = 1;
		}
		$this->set('selectedGroups', $arr);
		
		return $ok;
	}
	
	public function view($id) {
		App::uses('Platforms', 'Lib/Platform');
		$this->setPageIcon('user');
		$this->enablePageClass('basic-edit');
		$this->setAdditionalCssFiles(array('basic-edit'));
		$this->setAdditionalJavascriptFiles(array('application-list'));
		
		// Getting basic user info data
		$user = $this->User->getOne($id);
		$basicInfo = array();
		$basicInfo[__('First name')] = $user['User']['firstname'];
		$basicInfo[__('Last name')] = $user['User']['lastname'];
		$basicInfo[__('Username')] = $user['User']['username'];
		$basicInfo[__('Email')] = '<a href="mailto:'.$user['User']['email'].'" title="Email '.$user['User']['firstname'].'">'.$user['User']['email'].'</a>';
		$basicInfo[__('Company')] = $user['User']['company'];
		$basicInfo[__('Registration date')] = $user['User']['created'];
		$basicInfo[__('Last online')] = 'n/a';
		$basicInfo[__('Role')] = '<strong>'.strtoupper($user['User']['role']).'</strong>';
		$this->set('basicInfo', $basicInfo);
		
		// Filling apps available through groups assigned
		$this->set('user', $user);
		$ids = array();
		$groups = $this->Group->getGroupsForUser($id, false);
		foreach ($groups as $group) {
			$ids[] = $group['Group']['id'];
		}
		$this->set('apps', $this->Application->getApplicationsWithGroupIds($ids));
	}
	
	public function delete($id) {
		$this->setPageIcon('user');
		$user = $this->User->getOne($id);
		if ($user['User']['role'] != 'owner') {
			$this->User->delete((int)$id);
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}
