<?php

App::uses('Storage', 'Lib/Storage');

class Application extends AppModel {

	static public $iOSApp = array(0, 1);
	static public $iPhoneApp = array(0);
	static public $iPadApp = array(1);
	static public $AndroidApp = array(2, 3);
	static public $AndroidPhoneApp = array(2);
	static public $AndroidTabletApp = array(3);
	static public $Windows8App = array(4);
	static public $WebApp = array(5);

	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Application name is required'
            )
        )
    );
    
    public function getOne($id) {
		$this->id = $id;
        $data = $this->read(null, $id);
        return $data;
	}
	
	public function basicOptions() {
		$options = array();
		// TODO: Optimize
		$whereAndOrder = 'WHERE identifier = Application.identifier AND platform = Application.platform ORDER BY created DESC LIMIT 1';
		$latestId = '(SELECT id FROM applications '.$whereAndOrder.') AS id';
		$latestLocation = '(SELECT location FROM applications '.$whereAndOrder.') AS location';
		$latestName = '(SELECT name FROM applications '.$whereAndOrder.') AS name';
		$latestVersion = '(SELECT version FROM applications '.$whereAndOrder.') AS version';
		$latestCreated = '(SELECT created FROM applications '.$whereAndOrder.') AS created';
		$options['fields'] = array('*', 'COUNT(Application.id) AS count', $latestId, $latestLocation, $latestName, $latestVersion, $latestCreated);
		$options['order'] = array('Application.name' => 'ASC', 'Application.created');
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $options;
	}
	
	public function getAll() {
		$options = $this->basicOptions();
		$data =  $this->find('all', $options);
		//die(json_encode($data));
		return $data;
	}
	
	public function getAllHistoryForApp($identifier, $platform) {
		$options = array();
		$options['order'] = array('Application.created' => 'DESC');
		$options['conditions'] = array('Application.identifier' => $identifier, 'Application.platform' => (int)$platform);
		$data =  $this->find('all', $options);
		//die(json_encode($data));
		return $data;
	}
	
	public function searchFor($term) {
		$options = $this->basicOptions();
		$options['conditions'] = array('Application.name LIKE \'%'.$term.'%\'');
		$data =  $this->find('all', $options);
		return $data;
	}
	
	public function countAll() {
		$options = array();
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $this->find('count', $options);
	}
	
	public function countAppsForPlatforms($platforms) {
		$options = $this->basicOptions();
		$options['conditions'] = array();
		$options['conditions']['Application.platform'] = $platforms;
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $this->find('count', $options);
	}
	
	public function getAllWithGroupInfo($groupId) {
		$options = array();
		$options['fields'] = array('*', 'GroupJoin.group_id');
        
		$options['joins'] = array(
		    array('table' => 'applications_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Application.id = GroupJoin.application_id',
		            'GroupJoin.group_id = '.(int)$groupId
		        )
		    )
		);
		$options['order'] = array('Application.name' => 'ASC');
		return $this->find('all', $options);
	}
		
	public function getApplicationsWithGroupId($groupId) {
		$options = array();
		$options['joins'] = array(
		    array('table' => 'applications_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'INNER',
		        'conditions' => array(
		            'Application.id = GroupJoin.application_id'
		        )
		    )
		);
		$options['conditions'] = array(
		    'GroupJoin.group_id' => (int)$groupId
		);
		$options['order'] = array('Application.name' => 'ASC');
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $this->find('all', $options);
	}
	
	public function saveApp($appData, $confData, $file, $icon) {
		$id = isset($appData['id']) ? (int)$appData['id'] : 0;
		if ($id) {
			$this->id = $id;
		}
		else {
			$this->create();
		}
		
		$confData['isIcon'] = ($icon) ? 1 : 0;
		$this->set('name', $appData['name']);
		$this->set('identifier', $appData['identifier']);
		$this->set('version', $appData['version']);
		$this->set('sort', $appData['sort']);
		$this->set('size', $appData['size']);
		$this->set('platform', $confData['platform']);
		
		$s = new Settings();
		$this->set('location', ($s->get('s3Enable') ? 1 : 0));
		
		if (isset($confData['name'])) unset($confData['name']);
		if (isset($confData['identifier'])) unset($confData['identifier']);
		if (isset($confData['version'])) unset($confData['version']);
		if (isset($confData['sort'])) unset($confData['sort']);
		if (isset($confData['size'])) unset($confData['size']);
		if (isset($confData['platform'])) unset($confData['platform']);
		$this->set('config', json_encode($confData));
		
		$this->save();
		
		// Saving files
		$ok = true;
		if ($file && !empty($file)) {
			if (!Storage::saveFile($file, 'Applications'.DS.$this->id, true)) {
				$this->delete($this->id);
				$ok = false;
				// TODO: Display error
			}
		}
		if ($ok) {
			if (!file_exists($icon)) {
				copy(WWW_ROOT.'Userfiles'.DS.'Settings'.DS.'Images'.DS.'Icon', $icon);
			}
			if (!Storage::saveFile($icon, 'Applications'.DS.$this->id, false)) {
				// TODO: Display error
			}
		}
		
		return $ok ? $this : null;
	}

	
}
