<?php

class Utils {

	public function print_array($arrName, $arr, $fields) {
		
		echo "\n$arrName\n----------\n";
		
		echo implode(' | ', $fields) . "\n\n";

		foreach ($arr as $row) {
			
			$values = array();
			
			foreach ($fields as $field) {
				$values[] = isset($row[$field]) ? $row[$field] : null;
			}

			echo implode(' | ', $values) . "\n";
		}
	}
}

