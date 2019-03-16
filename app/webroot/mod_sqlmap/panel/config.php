<?php
error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
//-----------------------  SETTINGS ----------------------------------

	$adminuser = "admin"; // Username for login to panel
	$adminpass = "18socks24"; // Password for login to panel

	$kpath =   "/var/www/ku/data/www/sup.com/app/webroot/mod_sqlmap/"; // exact path to katusha files
	$scandir = $kpath."scan_files/";

	$timeout = 10 * 1000; // Timeout when stats refreshing, in MILIseconds

	$timeoutlog = 3 * 1000; // Timeout when log file refreshing, in MILIseconds

	$logfile = $kpath."log.txt";

//--------------------------------------------------------------------

	function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return $str;
	}
	
	function cleang ($str)
	{
		global $_GET;
		return clean ($_GET[$str]);
	}

	function cleanp ($str)
	{
		global $_POST;
		return clean ($_POST[$str]);
	}

	function cleanss ($str)
	{
		global $_SESSION;
		return clean ($_SESSION[$str]);
	}

	function getFiles ($path)
	{
		$files = array();
		if ($handle = opendir($path)) 
		{
		    while (false !== ($entry = readdir($handle))) 
			{
        		if ($entry != "." && $entry != "..") 
					$files[] = $entry;
    		}
    		closedir($handle);
		}
		return $files;
	}

	session_start();	
?>
