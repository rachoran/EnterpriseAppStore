<?php

class Download extends AppModel {
	
	public function saveDownload($appId, $time=false) {
		$this->create();
		$this->set('application_id', (int)$appId);
		if ($time) $this->set('created', date('Y-m-d H:i:s', $time));
		$this->save();
		return $this;
	}
	
	public function countAll($options=array()) {
		return $this->find('count', $options);
	}
	
	public function daysToSeconds($days) {
		return ((($days * 24) * 60) * 60);
	}
	
	public function countAllForLastNumberOfDays($days=30) {
		$options = array();
		$options['conditions'] = array('Download.created >' => date('Y-m-d H:i:s', (time() - $this->daysToSeconds($days))));
		return $this->countAll($options);
	}
	
	public function allForLastNumberOfDays($days=15) {
		$options = array();
		$options['conditions'] = array('Download.created >' => date('Y-m-d H:i:s', (time() - $this->daysToSeconds($days))));
		return $this->find('all', $options);
	}
	
	private function graphKeyForPlatform($platform) {
		switch ($platform) {
			case 0:
				return 'a';
				break;
			case 1:
				return 'a';
				break;
			case 2:
				return 'a';
				break;
			case 3:
				return 'b';
				break;
			case 4:
				return 'b';
				break;
			case 5:
				return 'b';
				break;
			case 6:
				return 'c';
				break;
			case 7:
				return 'c';
				break;
			case 8:
				return 'd';
				break;
		}
		return false;
	}
	
	public function dataForChartForLastNumberOfDaysWithInfo($days=15) {
		$options = array();
		$options['fields'] = array('Download.created', 'AppsJoin.platform', 'COUNT(Download.application_id) AS count');
		$options['joins'] = array(
			array(
				'table' => 'applications',
				'alias' => 'AppsJoin',
				'type' => 'RIGHT',
				'conditions' => array(
					'Download.application_id = AppsJoin.id'
				)
			)
		);
		$options['group'] = array('DAY(Download.created)', 'AppsJoin.platform');
		$options['conditions'] = array(
			'Download.created >' => date('Y-m-d H:i:s', (time() - $this->daysToSeconds($days))),
			//'AppsJoin.platform = 0'
		);
		$data = $this->find('all', $options);
		$newData = array();
		foreach ($data as $dp) {
			$dateKey = date('Y-m-d', strtotime($dp['Download']['created']));
			if (!isset($newData[$dateKey])) $newData[$dateKey] = array();
			if (!isset($newData[$dateKey][$this->graphKeyForPlatform($dp['AppsJoin']['platform'])])) {
				$newData[$dateKey][$this->graphKeyForPlatform($dp['AppsJoin']['platform'])] = 0;
			}
			$newData[$dateKey][$this->graphKeyForPlatform($dp['AppsJoin']['platform'])] += $dp[0]['count'];
		}
		$data = array();
		$x = 0;
		foreach ($newData as $key=>$d) {
			$data[$x] = $d;
			$data[$x]['x'] = $key;
			$x++;
		}
		return $data;
	}
	
	public function averageNumberOfDownloadsPerNumberOfDays($days=30) {
		$days = (int)$days;
		if (!$days) return -1;
		$options = array();
		$options['fields'] = array('(count(Download.application_id) / '.$days.') AS average');
		$options['conditions'] = array('Download.created >' => date('Y-m-d H:i:s', (time() - $this->daysToSeconds($days))));
		$data = $this->find('all', $options);
		return $data[0][0]['average'];
	}
	
	public function numberOfDownloadsYesterday() {
		$options = array();
		
		$date = new DateTime();
		$date->sub(new DateInterval('P1D'));

		$options['conditions'] = array(
									'Download.created >' => $date->format('Y-m-d 00:00:00'),
									'Download.created <' => $date->format('Y-m-d 23:59:59')
									);
		$data = $this->find('count', $options);
		return $data;
	}
	
	public function numberOfDownloadsForPlatforms($platforms=array()) {
		
	}
	
}
