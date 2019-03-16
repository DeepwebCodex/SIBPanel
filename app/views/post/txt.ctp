<?php
echo $form->textarea('txt',array('value'=>$txt,'id'=>'txt','style'=>'width:100%;height:200px'));
echo $ajax->observeField('txt',    array('url' => array( 'action' => 'txt'),'frequency' => 0.2,'update'=>'cont'));	
?>