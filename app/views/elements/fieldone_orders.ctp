<?php




	

$field = explode(',', $field);




	
	if(count($field)>0)
	{

		echo '<table style="width:100%"><tr>';
	foreach ($field as $var)
	{
	
		echo '<th style="width:auto;border:solid #fff 1px;padding-right:2px">'.$var.'</th>';
	}
	echo '</tr>';
	echo '</table>';
}else{
	echo '<h1>SELECT FIELD</h1>';
}
?>