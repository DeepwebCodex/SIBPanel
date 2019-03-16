<?php
echo $form->create('Post');
echo $form->input('finish');
echo $form->submit('GO!').'<br/>';
if(isset($url)){
//	print_r($url);
//	die();
	foreach ($url as $values){
		echo $values.'<br/>';
	}
}
?>