<?php

App::uses('Storage', 'Lib/Storage');

class Application extends AppModel {
	
	public $hasAndBelongsToMany = array(
        'Group' => array(
			'className' => 'Group',
			'joinTable' => 'applications_groups',
			'foreignKey' => 'application_id',
			'associationForeignKey' => 'group_id',
			'unique' => 'keepExisting',
	    ),
        'Category' => array(
			'className' => 'Category',
			'joinTable' => 'applications_categories',
			'foreignKey' => 'application_id',
			'associationForeignKey' => 'category_id',
			'unique' => 'keepExisting',
	    )
    );
    
    // TODO: Move more stuff into the vitual fields
    public $virtualFields = array(
    	//'count' => "COUNT(Application.id)"
	);
	
	public $order = array('Application.name' => 'ASC', 'Application.created' => 'DESC');

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
		//*
$whereAndOrder = 'WHERE identifier = Application.identifier AND platform = Application.platform ORDER BY created DESC LIMIT 1';
		$latestId = '(SELECT id FROM applications '.$whereAndOrder.') AS id';
		$latestLocation = '(SELECT location FROM applications '.$whereAndOrder.') AS location';
		$latestName = '(SELECT name FROM applications '.$whereAndOrder.') AS name';
		$latestVersion = '(SELECT version FROM applications '.$whereAndOrder.') AS version';
		$latestCreated = '(SELECT created FROM applications '.$whereAndOrder.') AS created';
		$options['fields'] = array('*', 'COUNT(Application.id) AS count', $latestId, $latestLocation, $latestName, $latestVersion, $latestCreated);
		//*/
		$options['group'] = array('Application.identifier', 'Application.platform');
		return $options;
	}
	
	public function getAll() {
		$options = $this->basicOptions();
		$data =  $this->find('all', $options);
		return $data;
	}
	
	public function getAllApplications() {
		$this->unbindModel(array('hasAndBelongsToMany' => array('Group', 'Category')));
		$options = $this->basicOptions();
		$data =  $this->find('all', $options);
		return $data;
	}
	
	public function getAllHistoryForApp($identifier, $platform) {
		$options = array();
		
		$options['order'] = array('Application.created' => 'DESC');
		$options['conditions'] = array('Application.identifier' => $identifier, 'Application.platform' => (int)$platform);
		$data =  $this->find('all', $options);
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
		$options = $this->basicOptions();
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
		return $this->find('all', $options);
	}

	public function getApplicationsWithGroupIds($groupIds) {
		$options = $this->basicOptions();
		$options['joins'] = array(
		    array('table' => 'applications_groups',
		        'alias' => 'GroupJoin',
		        'type' => 'INNER',
		        'conditions' => array(
		            'Application.id = GroupJoin.application_id'
		        )
		    )
		);
		// If one sigle id has been served
		if (is_int($groupIds) || is_array($groupIds)) {
			$options['conditions'] = array(
			    'GroupJoin.group_id' => $groupIds
			);
		}
		else  {
			return array();
		}
		return $this->find('all', $options);
	}
	
	public function getAllForCategory($catId) {
		$options = $this->basicOptions();
		$options['joins'] = array(
			array(
				'table' => 'applications_categories',
				'alias' => 'ApplicationsJoin',
				'type' => 'INNER',
				'conditions' => array(
					'Application.id = ApplicationsJoin.application_id',
				)
			) 
		);
		$options['conditions']['ApplicationsJoin.category_id'] = (int)$catId;
		$data = $this->find('all', $options);
		return $data;
	}

	public function saveApp($appData, $confData, $file, $icon) {
		$id = (int)$this->id;
		$modify = false;
		
		// Getting config data
		if ((bool)$id) {
			$app = $this->getOne($id);
			$cd = json_decode($app['Application']['config'], true);
			$confData = array_merge($cd, $confData);
			$modify = true;
		}
		else {
			// Hangling default fields for the web & appstore apps
			if (isset($appData['Application']['type']) && $appData['Application']['type'] > 0) {
				$appData['Application']['size'] = 0;
				$appData['Application']['identifier'] = $appData['Application']['url'];
				$appData['Application']['platform'] = ($appData['Application']['type'] == 1) ? 8 : 9;
			}
		}
		
		// If new, creating info about file location
		if (!$modify) {
			$s = new Settings();
			$appData['Application']['location'] = $s->get('s3Enable') ? 1 : 0;
		}
		
		// Removing basic data from the config data
		if (isset($confData['name'])) unset($confData['name']);
		if (isset($confData['url'])) unset($confData['url']);
		if (isset($confData['identifier'])) unset($confData['identifier']);
		if (isset($confData['version'])) unset($confData['version']);
		if (isset($confData['sort'])) unset($confData['sort']);
		if (isset($confData['size'])) unset($confData['size']);
		if (isset($confData['platform'])) unset($confData['platform']);
		
		// Creating config
		$appData['Application']['config'] = json_encode($confData);
		
		// Save data
		$this->save($appData);

		// Saving files
		$ok = true;
		if ($file && !empty($file)) {
			if (!Storage::saveFile($file, 'Applications'.DS.$this->id, true)) {
				$this->delete($this->id);
				$ok = false;
				// TODO: Display error
			}
		}
		
		// TODO: Use proper user Id
		$tempFolderPath = TMP.'1'.DS;
		$dir = new Folder();
		$dir->create($tempFolderPath);
		
		// Uploading default icon if one is being submitted
		if ($ok && isset($appData['form']['iconFile']['tmp_name']) && $appData['form']['iconFile']['tmp_name']) {
			move_uploaded_file($appData['form']['iconFile']['tmp_name'], $tempFolderPath.'icon');
			$s = getimagesize($tempFolderPath.'icon');
			if (!$s) {
				$ok = true;
			}
			if (!Storage::saveFile($tempFolderPath.'icon', 'Applications'.DS.$this->id, false)) {
				// TODO: Display error
			}
		}
		
		// Creating default icon if one doesn't exist
		if ($ok && !$modify) {
			// TODO: If icon doesn't exist, create an error message
			$defaultIcon = WWW_ROOT.'Userfiles'.DS.'Settings'.DS.'Images'.DS.'Icon';
			if (!$icon || !file_exists($icon)) {
				$icon = $tempFolderPath.'icon';
				copy($defaultIcon, $icon);
			}
			if (!Storage::saveFile($icon, 'Applications'.DS.$this->id, false)) {
				// TODO: Display error
			}
		}
		
		// Cleaning temp
		$dir->delete($tempFolderPath);
		
		// TODO: Improve logic
		if ($modify) return $this;
		
		return $ok ? $this : false;
	}
	
}
