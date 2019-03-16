<?php

ini_set("memory_limit","5000M");
set_time_limit(0);
ignore_user_abort(true);
error_reporting(E_ALL);
//error_reporting(0);

if($_POST['submit2'])
{
	$gg = explode("\r\n",$_POST['text']);
	
	$bb2 = explode("\r\n",$_POST['text2']);
	$tt = array();
	foreach($gg as $g)
	{
		$g = str_replace('"','',$g);
		$g = str_replace("'",'',$g);
		$g = str_replace('inurl:','',$g);
		
		foreach($bb2 as $b)
		{
			$tt[] =  $b.' inurl:"'.trim($g).'"';
		
		}
	}
	
	$tt = array_unique($tt);
	shuffle($tt);
$file = 'aparser.txt';
foreach($tt as $ku){
#echo $ku."<br>";

file_put_contents($file, $ku."\r\n", FILE_APPEND);


}

echo 'good<br>';	
	
			
}
?>

	<br />
	<form method="post">
		<label>Куку ёптить мешает дорки + слова для а парсера</label><br />
		
		form: <textarea rows="10" cols="90" name="text"> Торкай сюда свои дорки</textarea><br />

	
		
		
		form: <textarea rows="10" cols="90" name="text2"> Жги сюда слова</textarea><br />
		<input type="submit" name="submit2" value="enter" />
	</form>
	