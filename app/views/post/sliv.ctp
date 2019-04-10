
<h1>Сливаем мыла</h1>
<?php

echo $form->create('Post');
echo $form->input('idf');
echo $form->input('limit');

$gg = array();

	foreach ($serv as $val){
	
		$gg[$val] = $val; 
		
		
	}

echo $form->select('shell', $gg,null,array('empty'=>false)).'<br/>';
echo $form->submit('Go!');
//print_r($serv);
?>