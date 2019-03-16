
<div id="content">
<ul class="page-nav fl">
			<li ><?=$html->link('Шеллы',array('action'=>'shelltest2')); ?></li>
			<li><?=$html->link('Настройки',array('action'=>'settings')); ?></li>
			<li class="active"><?=$html->link('Таблица Fileds',array('action'=>'squleview')); ?></li>
			
			
</ul>
<div class="clear"></div>		
<?php

$i = 0;

echo '<table class="table no-nowrap" border="1">';

echo " 
<thead>
<TH class='center' style='font-weight:700'>num</TH>
<TH class='center' style='font-weight:700'>squle_post</TH>
<TH class='center' style='font-weight:700'>squle_fileds</TH>
<TH class='center' style='font-weight:700'>table</TH>
<TH class='center' style='font-weight:700'>label</TH>
<TH class='center' style='font-weight:700' >get</TH>
<TH class='center' style='font-weight:700'>doc</TH>
<TH class='center' style='font-weight:700'>lastlimit</TH>
<TH class='center' style='font-weight:700'>count</TH>
<TH class='center' style='font-weight:700'>password</TH>
<TH class='center' style='font-weight:700'>url</TH>
<thead>";

$i = 1;
foreach($data as $key =>$d):

	$sqlule_post=  $d['squle_post'];
	$sqlule_fileds=$d['squle_fileds'];		
	$table  = 	   $d['table'];
	$label  = 	   $d['label'];
	$get  = 	   $d['get'];
	$dok  = 	   $d['dok'];
	$lastlimit  =  $d['lastlimit'];
	$count  = 	   $d['count'];
	$password  =   $d['password'];
	$url  =    	   $d['url'];
	
	
	
	if(is_array($table))
	{
		$table2 = '';
		
		foreach($table as $t)
		{
			$table2 .=$t."<br>";
		}
	}
	
	if(is_array($label))
	{
		$label2 = '';
		
		foreach($label as $l)
		{
			$label2 .=$l."<br>";
		}
	}
	
	if(is_array($lastlimit))
	{
		$lastlimit2 = '';
		
		foreach($lastlimit as $ls)
		{
			$lastlimit2 .=$ls."<br>";
		}
	}
	
	if(is_array($count))
	{
		$count2 = '';

		foreach($count as $c2)
		{
			$count2 .=$c2."<br>";
		}
	}
	
	if(is_array($password))
	{
		$password2 = '';
		
		foreach($password as $p)
		{
			$password2 .=$p."<br>";
		}
	}
	
	if(is_array($get))
	{
		$get2 = '';
		
		foreach($get as $g)
		{
			$get2 .=$g."<br>";
		}
	}
	
	if(is_array($dok))
	{
		$dok2 = '';
		
		foreach($dok as $d)
		{
			$dok2 .=$d."<br>";
		}
	}
	
	
	
	
	echo "<tbody><tr style='color:black'>";
	echo "<td>{$i}</td>";
	echo "<td>{$sqlule_post}</td>";
	echo "<td>{$sqlule_fileds}</td>";
	echo "<td>{$table2}</td>";
	echo "<td>{$label2}</td>";
	echo "<td>{$get2}</td>";
	echo "<td>{$dok2}</td>";
	echo "<td>{$lastlimit2}</td>";
	echo "<td>{$count2}</td>";
	echo "<td>{$password2}</td>";
	echo "<td width=370px><b><a target='_blank' href='{$url}'>{$url}</a></b>";
	echo "</tr></tbody>";
	
	
$i++;
endforeach;

echo '</table>';
?>
</div>


