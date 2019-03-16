<?php

	$field = explode(',', $field);
	echo '<table style="width:100%">';
	if(count($field)>0 && isset($dataCOLL['data'][$inject['Post']['id']]) && count($dataCOLL['data'][$inject['Post']['id']])>0){
		$i=0;
		foreach ($dataCOLL['data'][$inject['Post']['id']] as $value){
			echo '<tr>';
			foreach ($field as $var){
				if(isset($dataCOLL['data'][$inject['Post']['id']][$i][$var])){
					echo '<td>'.$dataCOLL['data'][$inject['Post']['id']][$i][$var].'</td>';
				}
			}
			$i++;
			echo '</tr>';
		}
	}
	echo '</table>';
?>