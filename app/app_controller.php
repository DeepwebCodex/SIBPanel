<?php

class AppController extends Controller {
	
function _getip()
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
		return getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		return getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		return getenv("REMOTE_ADDR");
	else if (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		return $_SERVER['REMOTE_ADDR'];
	else
		return false;
}


	function beforeRender(){

	//	parent::beforeRender();



	}
	
	function beforeFilter(){
		
		list($msec, $sec) = explode(chr(32), microtime());
		$this->timework = $sec + $msec;
		
	}
	

}
?>