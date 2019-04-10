<?php
echo $form->create('Post',array('url'=>array('action'=>'char')));
echo $form->textarea('tt',array('label'=>'текст'));
echo $form->submit('Go');
if(isset($text)){
echo 'CHAR('.$text.')';
}

?>