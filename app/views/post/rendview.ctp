
<div id="content">

	<ul class="page-nav fl">
			
			<li class="active"><?=$html->link('txt (мыло пасс)',array('action'=>'download_domens')); ?></li>
			<li ><?=$html->link('txt (просто мыла) ',array('action'=>'download_domens2')); ?></li>
		</ul>
<div class="clear"></div>
<div class="clear"></div>
<br>
<br>
<div class="clear"></div>	

<?php

echo '<table class="table no-nowrap" border="1">';
	

 echo " ||". $html->link(' id ',array('action'=>'rendview/id'));
 echo " ||". $html->link(' countMail ',array('action'=>'rendview/countMail'));
 echo " ||". $html->link(' countPass ',array('action'=>'rendview/countPass'));
 echo " ||". $html->link(' countNoNash ',array('action'=>'rendview/countNoHash'));
 echo " ||". $html->link(' countNash ',array('action'=>'rendview/countHash'));
 echo " ||". $html->link(' date ',array('action'=>'rendview/date'));
 echo " ||". $html->link(' category ',array('action'=>'rendview/category'));
 echo " ||". $html->link(' country ',array('action'=>'rendview/country'));
 
 echo "<br>";
 echo "<br>";


$options['url'] = '/posts/rendview';


$i = 0;



echo " 
<TH>num</TH>
<TH>del</TH>
<TH>domen</TH>
<TH>countMail</TH>
<TH>countPass</TH>
<TH>countNoHash</TH>
<TH>countHash</TH>
<TH>country</TH>
<TH>cat</TH>
<TH>date</TH>
<TH>down1</TH>
<TH>down2</TH>";
$i = 1;
foreach($data as $key =>$d):

	$domen		=  $d['renders']['domen'];	
	$countMail  =  $d['renders']['countMail'];
	$countPass =   $d['renders']['countPass']; 
	$countNoHash = $d['renders']['countNoHash'];
	$countHash =   $d['renders']['countHash']; 
	$country =     $d['renders']['country'];
	$category =    $d['renders']['category'];
	$date	  =    $d['renders']['date'];
	$download =    $d['renders']['download'];
	
	$download2 = str_replace('slivpass','slivpass_save',$download);
	
	
	$download = str_replace('#','%23',$download);
	
	$download2 = str_replace('#','%23',$download2);
	
	
	$g = $ajax->link(
	'del', 
	"/posts/rendview/{$domen}",
	array(
	'style'=>'color:black',
	'escape' => false,
	'update'=>"delete{$domen}"
	));
	
	
	//$ajax->form('edit','post',array('model'=>'User','update'=>'UserInfoDiv'));
	
	
	
	echo $ajax->observeField( 
	"up{$i}",     
	array('url' => array( 'action' => 'edit' ),        
	'frequency' => 0.2,    ) );
	
	
	
	if($country =='')$country = 'unkown';
	echo "<tr id='delete{$domen}'>";
	echo "<td>{$i}</td>";
	echo "<td>{$g}</td>";
	echo "<td width=370px><b><a target='_blank' href='http://{$domen}'>{$domen}</a></b>";
	echo "<td>{$countMail}</td>";
	echo "<td>{$countPass}</td>";
	echo "<td>{$countNoHash}</td>";
	echo "<td>{$countHash}</td>";
	echo "<td>{$country}</td>";
	echo "<FORM ACTION='/posts/rendview/' METHOD='POST'>";
	echo "<td style='width:90px;'><input style='width:90px;' type='text' name='category' value='$category'>";
	//echo "<td>{$category}</td>";
	echo "<input type='hidden' name='domen' value='{$domen}'>";
	echo "<input type='submit' name='update' value='update'></td>";
	echo '</form>';
	echo "<td>{$date}</td>";
	echo "<td><b><a target='_blank' href='{$download}'>Скачать</a></td>";
	echo "<td><b><a target='_blank' href='{$download2}'>Скачать2</a></td>";
	echo "</tr>";
	
	
$i++;
endforeach;

echo '</table></div>';
?>



