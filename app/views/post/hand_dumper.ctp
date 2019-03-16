	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li><?=$html->link('Добавить прокси',array('action'=>'add_socks')); ?></li>
			<li ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li class="active"><?=$html->link('Ручной анализ',array('action'=>'hand_dumper')); ?></li>
			<li ><?=$html->link('Добавление сайта в ручной анализ',array('action'=>'hand_add')); ?></li>
		</ul>
		<div class="clear"></div>
	
		<table class="table">
			<thead>
				<th>Добавление ссылок</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="hash"><span>Ручной анализ линка, с своими параметрами + автодокачка мыл, когда это надо будет сделать</span></label>
						
				
						
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
			
			
					?>
					
						<? $f = parse_url($gurl);?>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 130px;"><?=$domen?></div></td>
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 6px;"><?=$html->link('u','http://'.$url,array('target'=>'_blank'));?></div></td>
						
						
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
		
		
		
		

