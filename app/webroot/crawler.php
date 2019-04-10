<?php


$mysql = new InjectorComponent();
$mysql->log_enable=false;
$mysql->debug=false;
$url = 'URLURL';



if(stristr($url,'https'))
{
	//$this->d('RABOTA S HTTPS');
	$this->https=true;
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


$url_new = $url;



$test = $mysql->start_crowler($url_new);

if($test==false)
{
	echo "$url:::false:::false";
	//echo "$url_new:::false:::false";

	
}else
{
	//echo "$url_new:::".$test;
	//echo "$url_new:::true:::true";
	echo "$url:::true:::true";
}

///логирование
//print_r($_SERVER);
//print_r($mysql);
?>	