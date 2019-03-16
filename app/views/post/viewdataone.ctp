<?php

	
	//echo "<pre>";
	//echo '$dataCOLL';
	//print_r($dataCOLL);

	//echo '$inject';
	//print_r($inject);
	//echo "</pre>";
	
	//exit;

	$field = explode(',', $field);
	echo '<table style="width:100%">';
	if(count($field)>0 && isset($dataCOLL['data'][$inject['posts_one']['id']]) && count($dataCOLL['data'][$inject['posts_one']['id']])>0)
	{
		$i=0;
		foreach ($dataCOLL['data'][$inject['posts_one']['id']] as $value)
		{
			echo '<tr>';
			foreach ($field as $var)
			{
				if(isset($dataCOLL['data'][$inject['posts_one']['id']][$i][$var])){
					echo '<td>'.$dataCOLL['data'][$inject['posts_one']['id']][$i][$var].'</td>';
				}
			}
			$i++;
			echo '</tr>';
		}
	}
	echo '</table>';
?>