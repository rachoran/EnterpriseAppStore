<?php

class AdminApiController extends AppController {

	var $uses = array('Download', 'Application');
	
	public function generateDummyAppsAndDownloads() {
		$x = 0;
		for ($p = 0; $p <= 5; $p++) {
			for ($d = 0; $d <= 24; $d++) {
				$rand = rand(5, 25);
				for ($r = 0; $r <= $rand; $r++) {
					$this->Download->saveDownload(2, (time() - $this->Download->daysToSeconds($d)));
					$x++;
				}
			}
		}
		die('Generated: '.$x);
	}
	
	public function platformDownloads($days=15) {
		$data = $this->Download->dataForChartForLastNumberOfDaysWithInfo(12);
		$this->outputApi($data, false);
	}
	
}
