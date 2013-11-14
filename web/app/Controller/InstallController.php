<?php

App::uses('Controller', 'Controller');
App::uses('Error', 'Lib/Errors');
App::uses('Install', 'Lib/Install');
App::uses('DBInstall', 'Lib/Install');

class InstallController extends Controller {
	
	public function beforeFilter() {
        parent::beforeFilter();
    }
    
    protected function currentPage($no=null) {
	    if ($no != null) {
		    $this->Session->write('Install.currentPage', (string)$no);
	    }
	    return $this->Session->read('Install.currentPage');
    }
    
    protected function checkPage($no) {
	    $this->currentPage($no);
	    if (Install::isInstallLocked()) {
		    if ($this->Session->read('Install.currentPage') && ($no == 4)) {
			    
		    }
		    else {
			    Error::add('Installation process has been finished, you are not allowed to access this section.', Error::TypeError);
			    $this->redirect(array('controller' => 'install', 'action' => 'locked'));
		    }
	    }
	    $page = $no;
	    $data = array();
	    if ($page == 0) {
		    $data = array();
	    }
	    else if ($page == 1) {
		    $data = $this->checkInfo();
	    }
	    else if ($page == 2) {
		    $data = $this->checkPermissions();
	    }
	    else if ($page == 3) {
		    $data = $this->checkDatabase();
	    }
	    else if ($page == 4) {
		    $this->installDB();
	    }
	    if (!empty($data) && !$data['result']) {
	    	Error::add('Please fix all the issuer marked in red before you can continue.', Error::TypeWarning);
	    }
	    $this->set('data', $data);
	    $this->set('siteName', 'Ridiculous Innovations - Enterprise AppStore');
	    $this->set('debugMySQL', false);
	    return true;
    }

    public function index() {
    	$this->checkPage(0);
		$this->layout = 'outside';
	}
	
    public function locked() {
	    $this->set('siteName', 'Ridiculous Innovations - Enterprise AppStore');
	    $this->set('debugMySQL', false);
    	$this->layout = 'outside';
	}
	
    public function info() {
    	$this->checkPage(1);
		$this->layout = 'outside';
	}
	
    public function permissions() {
    	$this->checkPage(2);
		$this->layout = 'outside';
	}
	
    public function database() {
    	$this->checkPage(3);
		$this->layout = 'outside';
	}
	
    public function success() {
    	$this->checkPage(4);
		$this->layout = 'outside';
		Error::add('Login to the system with username <strong>admin</strong> and password <strong>password</strong>!');
	}
	
	// Checks on page 1
	protected function checkInfo() {
		$data = array();
		$data['result'] = true;
		$t = array();
		
		$ok = false;
		
		// Testing iOS resigning
		$ok = @preg_match('/Mac\ OS\ X/si', $_SERVER['HTTP_USER_AGENT']);
		if ($ok) {
			$ok = Install::isShellMethod('codesign');
		}
		$t[] = array(__('iOS resigning'), $ok, 1, 'To use iOS resigning locally, you need to be running this system on an Apple Mac machine with the latest XCode + it\'s command line tools.');
		
		// Testing Android resigning
		$ok = Install::isShellMethod('jarsigner');
		$t[] = array(__('Android resigning'), $ok, 1, 'To use Android resigning locally, you need Java SE installed on your machine.');
		
		// Testing connection to S3 bucket
		$ok = Install::isS3Available();
		$t[] = array(__('Amazon S3 storage'), $ok, 1, 'To use S3 or SMS notifications internet connection needs to be available for the server.');
		
		// Testing Access to Twilio SMS gate
		$t[] = array(__('SMS notifications'), $ok, 1, 'To use S3 or SMS notifications internet connection needs to be available for the server.');
		
		$data['tests'] = $t;
		return $data;
	}
	
	// Checks on page 2
	protected function checkPermissions() {
		$data = array();
		$data['result'] = true;
		$t = array();
		
		// Testing tmp folder
		$ok = Install::isFolderWritable('tmp/');
		if (!$ok) $data['result'] = false;
		$t[] = array('/app/tmp/', $ok, 0, '/app/tmp/ folder needs to be writable.');
		
		// Testing private Userfiles folder
		$ok = Install::isFolderWritable('Userfiles/');
		if (!$ok) $data['result'] = false;
		$t[] = array('/app/Userfiles/', $ok, 0, '/app/tmp/ folder needs to be writable.');
		
		// Testing public Userfiles folder
		$ok = Install::isFolderWritable('webroot/Userfiles/');
		if (!$ok) $data['result'] = false;
		$t[] = array('/app/webroot/Userfiles/', $ok, 0, '/app/tmp/ folder needs to be writable.');
		
		// Testing database config file
		$ok = Install::isFileWritable('Config/database.php');
		$t[] = array('/app/Config/database.php', $ok, 1, '/app/Config/database.php folder should be writable if you want to configure the system automatically.');
		
		// Testing main config file
		$ok = Install::isFileWritable('Config/core.php');
		$t[] = array('/app/Config/core.php', $ok, 1, '/app/Config/core.php folder should be writable if you want to configure the system automatically.');
		
		$data['tests'] = $t;
		return $data;
	}
	
	// Checks on page 3
	protected function checkDatabase() {
		$data = array();
		$data['result'] = true;
		$data['tests'] = array();
		
		$dbOk = false;
		if ($this->request->is('post')) {
			$this->Session->write('Install.DBConfig', $this->request->data['db']);
			if (isset($this->request->data['go']) && (int)$this->request->data['go'] == 1) {
				$this->redirect(array('controller' => 'install', 'action' => 'success'));
			}
			else {
				$connectionStatus = Install::isMySQLCool($this->request->data['db']);
				$dbOk = ($connectionStatus == Install::DBConnectionOk);
			
				if (!$dbOk) {
					if ($connectionStatus == Install::DBConnectionFailed) {
						Error::add('Database connection credentials are not correct.', Error::TypeError);
					}
					else {
						Error::add('Database name is not correct.', Error::TypeError);
					}
				}
				else {
					DBInstall::createDatabaseConfigurationFile($this->request->data['db']);
					App::uses('ConnectionManager', 'Model');
					$db = ConnectionManager::getDataSource('default');
					$tables = $db->listSources();
					if (count($tables) > 0) {
						Error::add('Database contains conflicting tables.', Error::TypeWarning);
						//$dbOk = false;
					}
					else {
						Error::add('Database configuration works fine.');
					}
				}
			}
		}
		$this->set('dbOk', $dbOk);
		$db = $this->Session->read('Install.DBConfig');
		if (empty($db)) {
			$db = Install::databaseConfiguration();
			if (empty($db)) $db = array('login'=>'', 'password'=>'', 'host'=>'', 'database'=>'');
			else {
				Error::add('Database configuration file already existed so we have pre-filed the information for you.', Error::TypeInfo);
			}
		}
		$this->set('db', $db);
		$this->set('dbFileNotWritable', !Install::isFileWritable('Config/database.php'));
		
		return $data;
	}
	
	// Install db on page 4
	protected function installDB() {
		App::uses('ConnectionManager', 'Model');
		$db = ConnectionManager::getDataSource('default');
		$tables = $db->listSources();
		$install = new DBInstall();
		$ok = $install->install();
		if ($ok) {
			Error::add('Database has been installed correctly.');
			Install::lockInstall();
		}
		else {
			Error::add('There was a problem installing the database.', Error::TypeError);
		}
	}
	
}