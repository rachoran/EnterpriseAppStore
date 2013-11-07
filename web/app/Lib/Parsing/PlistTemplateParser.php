<?php

abstract class PlistTemplateParser {
	
	abstract protected function templateArray();
	
	public function processArray($arr) {
		$new = array();
		$temp = $this->templateArray();
		$x = 0;
		foreach ($arr as $k=>$v) {
			if (isset($temp[$k])) {
				if (is_array($v) && !empty($v) && isset($temp[$k]['results']) && !empty($temp[$k]['results'])) {
					$results = $temp[$k]['results'];
					//if ($x == 0) debug($results);
					$x++;
					//if ($k == 'UISupportedInterfaceOrientations') debug($results);
					foreach ($v as $k2=>$v2) {
						if (!is_array($v2)) {
							$v[$k2] = $results[$v2];
						}
					}
				}
				else {
					if (isset($temp[$k]['boolean']) && $temp[$k]['boolean']) {
						$v = ($v) ? 'Yes' : 'No';
					}
				}
				$key = $temp[$k]['name'];
				$new[$key] = $v;
			}
		}
		//debug($new);
		return $new;
	}
	
}