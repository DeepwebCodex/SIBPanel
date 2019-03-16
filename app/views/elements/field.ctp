<?php

//echo '"'.$field.'"';


$field = explode(',', $field);
if(count($field)>0)
{

	foreach ($field as $var){
	
	//	echo $var.' ';
		//echo $ajax->link($var, 'getTables/'.$bd,array('indicator'=>'work','escape' => false,'update'=>'bds'));

	}
}else
{
	$field = array($field);
}
	echo '<br/><input name="where" value="Where" onclick="if(this.value==\'Where\')this.value=\'\'" type="text" size="20" id="where" />';
	echo $ajax->observeField('where',    array('url' => array( 'action' => 'choisgetdata_one/where'),'frequency' => 0.2,'update'=>'cont'));

	
	echo $form->select('desc', array('desc','asc'),null,array('empty'=>false)).' ';	
	echo $ajax->observeField('desc',    array('url' => array( 'action' => 'choisgetdata_one/desc'),'frequency' => 0.2,'update'=>'cont'));
		
		
	echo '<input name="limit" value="12" onclick="if(this.value==\'count\')this.value=\'\'" type="text" size="5" id="limit" />';	
	echo $ajax->observeField('limit',    array('url' => array( 'action' => 'choisgetdata_one/limit'),'frequency' => 0.2,'update'=>'cont'));
	


	
	
	if(count($field)>0){

		echo '<table style="width:100%"><tr>';
	foreach ($field as $var){
	
		echo '<th style="width:auto;border:solid #fff 1px;padding-right:2px">'.$var.'</th>';
		
		//echo $var.' ';
		//echo $ajax->link($var, 'getTables/'.$bd,array('indicator'=>'work','escape' => false,'update'=>'bds'));

	}
	echo '</tr>';
	echo '</table>';
}else{
	echo '<h1>SELECT FIELD</h1>';
}
?>