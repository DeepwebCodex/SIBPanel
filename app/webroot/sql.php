<?php


$mysql = new InjectorComponent();
//$mysql->log_enable=true;
$mysql->log_enable=false;
$mysql->debug = false;

$url2 = 'URLURL';
	
	$exp = explode('++',$url2);
	if($exp[1] =='https' or $exp[1] =='https://')
	{
		$mysql->https = true;
		$mysql->https_check=true;
	}
	$url = $exp[0];
	$url_orig = $url;
	 


	if($exp[2] =='post' or $exp[2] =='get')
	{
		$url = $exp[2].'::'.$url;
	}	
	
	if($exp[3] !='')
	{
		$id = $exp[3];
	}	
	


$test = $mysql->inj_test($url);

if($test==false)
{
	
	echo $url_orig.':::false'.':::'.$id;
	
}else
{
	echo $url_orig.':::'.$test.':::'.$id;
}

///логирование
#print_r($_SERVER);
#print_r($mysql);
?>	