<?php 
echo $form->create('Mail',array('type'=>'file'));
echo $form->input('file',array('label'=>'Файл с ключами(utf-8)','type'=>'file'));
echo $form->input('pometka',array('label'=>'pometka'));
echo $form->submit('Поехали!!!');
?>
