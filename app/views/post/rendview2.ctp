
<div id="content">

	<ul class="page-nav fl">
			<li  ><?=$html->link('Cкачать из выборки',array('action'=>'rendview')); ?></li>
			<li ><?=$html->link('База сайтов (мыло пасс)',array('action'=>'rendview')); ?></li>
			<li class="active"><?=$html->link('База сайтов (просто мыла) ',array('action'=>'rendview2')); ?></li>
			<li><?=$html->link('txt (мыло пасс)',array('action'=>'download_domens')); ?></li>
			<li ><?=$html->link('txt (просто мыла) ',array('action'=>'download_domens2')); ?></li>
		</ul>
<div class="clear"></div>
<div class="clear"></div>
<br>
<br>
<div class="clear"></div>	

<?php

echo '<table class="table no-nowrap" border="1">';
	

 echo " ||". $html->link(' id ',array('action'=>'rendview2/id'));
 echo " ||". $html->link(' countMail ',array('action'=>'rendview2/countMail'));
 echo " ||". $html->link(' date ',array('action'=>'rendview2/date'));
 echo " ||". $html->link(' category ',array('action'=>'rendview2/category'));
 echo " ||". $html->link(' country ',array('action'=>'rendview2/country'));
 
 echo "<br>";
 echo "<br>";


$options['url'] = '/posts/rendview2';


$i = 0;



echo " 
<TH>num</TH>
<TH>del</TH>
<TH>domen</TH>
<TH>countMail</TH>
<TH>country</TH>
<TH>cat</TH>
<TH>date</TH>
<TH>down</TH>
<TH>down2</TH>";
$i = 1;
foreach($data as $key =>$d):

	$domen		=  $d['renders_one']['domen'];	
	$countMail  =  $d['renders_one']['countMail'];
	$country =     $d['renders_one']['country'];
	$category =    $d['renders_one']['category'];
	$date	  =    $d['renders_one']['date'];
	$download =    $d['renders_one']['download'];
	
	$download = str_replace('#','%23',$download);
	$download2 = str_replace('sliv','sliv_save',$download);
	
	$g = $ajax->link(
	'del', 
	"/posts/rendview2/{$domen}",
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
	echo "<td>{$country}</td>";
	echo "<FORM ACTION='/posts/rendview2/' METHOD='POST'>";
	echo "<td><input type='text' name='category' value='$category'>";
	//echo "<td>{$category}</td>";
	echo "<input type='hidden' name='domen' value='{$domen}'>";
	echo "<input type='submit' name='update' value='update'></td>";
	echo '</form>';
	echo "<td style='width:100px;'>{$date}</td>";
	echo "<td><b><a target='_blank' href='{$download}'>Скачать</a></td>";
		echo "<td><b><a target='_blank' href='{$download2}'>Скачать2</a></td>";
	echo "</tr>";
	
	
$i++;
endforeach;

echo '</table></div>';
?>



