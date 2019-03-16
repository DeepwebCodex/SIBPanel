<?php

$mysql = new InjectorComponent();
$mysql->log_enable=false;
$mysql->debug=false;
$url = 'URLURL';

if(stristr($url,'https'))
{
	//$this->d('RABOTA S HTTPS');
	$mysql->https=true;
}




$url = str_replace('get::','',$url);
//$url = str_replace('post::','',$url);


$url = str_replace('http://http://','http://',$url);
$url = str_replace('https://https://','https://',$url);


$url = str_replace('WWW.','www.',$url);
$url = str_replace('wwwwww.','www.',$url);
$url = str_replace('wwwwww','www',$url);

	
	
$url = str_replace("http://http://","",$url);
$url = str_replace("https://http://","",$url);
$url = str_replace("https://https://","",$url);
$url = str_replace(array("http://","https://"),"",$url);	

$url = str_replace('//','/',$url);
$url =  trim($url);

$test = $mysql->start_crowler($url);

if($test)
{
	echo "$url:::true:::true";
}else
{
	echo "$url:::false:::false";
}
?>	