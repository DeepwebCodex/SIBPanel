<?php




	

$field = explode(',', $field);



	echo $form->select('desc', array('desc','ask'),null,array('empty'=>false)).' ';
	echo $ajax->observeField('desc',    array('url' => array( 'action' => 'choisgetdata_one/desc'),'frequency' => 0.2,'update'=>'cont'));
		
		
		
	echo '<label name="limit">Сколько строк показать :</label><input name="limit" value="10" onclick="if(this.value==\'count\')this.value=\'\'" type="text" size="5" id="limit" />';
	echo $ajax->observeField('limit',    array('url' => array( 'action' => 'choisgetdata_one/limit'),'frequency' => 0.2,'update'=>'cont'));
	

	
	
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