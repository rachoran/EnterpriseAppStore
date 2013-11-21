<?php

App::uses('Model', 'Model');


class AppModel extends Model {
	
	public function identicalFieldValues($field=array(), $compare_field=null) { 
        foreach ($field as $key => $value) { 
            $v1 = $value; 
            $v2 = $this->data[$this->name][$compare_field];                  
            if ($v1 !== $v2) { 
                return false; 
            }
            else { 
                continue; 
            } 
        } 
        return true; 
    }
	
}
