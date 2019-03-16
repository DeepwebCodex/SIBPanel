	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li ><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li ><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li> <?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li class="active" ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li><?=$html->link('Одиночный дампинг',array('action'=>'dumping_all')); ?></li>
			
		</ul>
		<div class="clear"></div>
	
		<table class="table">
			<thead>
				<th>Добавление ссылок</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="hash"><span>Одиночный взлом, это независимая подпрограмма для анализа сайта на уязвимостьи sqli пятью способами. <br>Помогает искать мыла на во всех базах данных. Искать возможные кредитные карты. Считать количество в таблице если найдет.<br> Дампить выделенные колонки с максимальной скорость в 6 потоков через group_concat. Пробовать заливать шелл на домен.</span></label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<br>
						<?=$form->input('link',array('type'=>'text', 'class'=>'input','div'=>true,'label'=>'Линк на уязвимую страницу с ? и = в ссылке <br> '))?>
						
						
						<br>
						<br>
						
						
						<?=$form->submit('Анализировать', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<br/>
						
						<?=$form->create('Post',array('type'=>'file','url'=>'add_one_domen'))?>
						<?=$form->input('domen',array('type'=>'text', 'class'=>'input','div'=>true,'label'=>'Домен для запуска паука              - '))?>
						
						
						<br>
						<br>
						
						
						<?=$form->submit('Анализировать', array('name'=>'domen_sub','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<br/>
						
						
						
						<!--
						<label for="hash">Укажите домен для запуска паука:</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('domen',array('type'=>'text', 'class'=>'input','div'=>false,'label'=>'domen'))?>
						
						<br>
						
						
						<?=$form->submit('Добавить', array('name'=>'cron','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						-->
						
						
					</td>
				</tr>
			</tbody>
		</table>

		
		
		
		<div class="clear"></div>
		<? if(count($data)!=0){ ?>
		<table class="table no-nowrap" width='90%'>
			<thead>
				<th class="center" style="width:100px;">DOMEN</th>
				<th class="center" style="width:6px;">U</th>
				<th class="center"style="width:25px;">HTTP</th>
				<th class="center">HEADER</th>
				<th class="center">COLUMN</th>
				<th class="center">WORK</th>
				<th class="center">METHOD</th>
				<th class="center">PRIV</th>			
				<th class="center" >VER</th>
				<th class="center" >USER</th>
			
				<th class="center" >CLICK</th>
			</thead>
			<tbody>
			<? } ?>
				
			
				<? if(count($data)==0){ ?>
					<!--<tr>
						<td colspan="13" class="center">Нет строк для отображения</td>
					</tr> --!>
				<? }else{
					
					
					 foreach ($data as $value){ ?>
			<?		
			$id = 			$value['id'][0];
			$gurl = 		$value['gurl'][0];
			$url = 			$value['url'][0];
			$file_priv = 	$value['file_priv'][0];
			$tic = 			$value['tic'][0];
			$sposob = 		$value['sposob'][0];
			$method = 		$value['find'][0];
			$column =  		$value['column'][0];
			$version =  	$value['version'][0];
			$work =      	$value['work'][0];
			$status =    	$value['status'][0];
			$domen =     	$value['domen'][0];
			$order =     	$value['order'][0];
			$work =     	$value['work'][0];
			$sleep =     	$value['sleep'][0];
			$user =     	$value['user'][0];
			$http =     	$value['http'][0];
			$header =     	$value['header'][0];
			
			
					?>
					
						<? $f = parse_url($gurl);?>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 130px;"><?=$domen?></div></td>
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 6px;"><?php
							if($http =='https' or $http =='https://')
								{
									echo $html->link('u','https://'.$url,array('target'=>'_blank'));
								}
								else
								{
									echo $html->link('u','http://'.$url,array('target'=>'_blank'));
								}
						?></div></td>
						
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 30px;"><?
						
						
						$http2 = str_replace('http://','http',$http); echo $http2;?></div></td>
						
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 30px;"><?if($header ==''){echo 'get';}else{echo $header;}?></div></td>
						
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 30px;"><?=$column?></div></td>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 100px;"><?=$work?></div></td>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 100px;"><?=$method?></div></td>
						<td class="center" style="font-size:10px;"><?
						if($file_priv =='')
						{
							echo "NO";
						}
						elseif($file_priv =='0')
						{
							echo "NO";
						}
						elseif($file_priv =='1')
						{
							echo "YES";
						}
						elseif($file_priv =='Y')
						{
							echo "YES";
						}
							
						
						
						
						
						?></td>
						
						
						
						<td class="center" style="font-size:10px;"><?=$version; ?></td>
						<td class="center" style="font-size:10px;"><?=$user; ?></td>
						
						<td width="70">
							<?=$this->Html->link($this->Html->image("curl.png", array("alt" => "Запустить")),array('action'=>'krutaten_one/'.$id.'/load'),array('escape' => false,'class' => 'icon','title'=>'Запустить','target'=>'_blank'))?>		
							<?=$ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts/shlak_one/'.$id,array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$id))?>
						</td>
					</tr>
					
				
					
					
					
					
					
					<? } ?>
				<? } ?>
			</tbody>
		</table>
		
	</div>
	<!-- STOP CONTENT -->
		
		
		
		

