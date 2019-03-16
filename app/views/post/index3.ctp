	<!-- START CONTENT -->
	<div id="content">
	

	
	<BR>
	ЭТО ТАБЛИЦА POSTS_ALL СЮДА МОЖНО ДОБАВЛЯТЬ МНОГО ССЫЛОК GET AND POST  ДЛЯ ПРОВЕРКИ НА SQLI. ВСЕ ССЫЛКИ ГРУПИРУЮТСЯ ПО ДОМЕНАМ. И КАК ТОЛЬКО ОДНА СТАНОВИТСЯ УЯЗВИМОЙ, ОНА ПЕРЕМЕЩАЕТСЯ В ОБЫЧНЫЕ "УЯЗВИМЫЕ"
	<br>
	
	
	
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('date', 'date')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('method', 'method')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('country', 'country')?></span>

	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('alexa', 'alexa')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('pr', 'pr')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('tic', 'tic')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('file_priv', 'file_priv')?></span>

	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('tables', 'tables')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('link', 'link')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('id', 'posts_all.id')?></span>
	
	
	<!--<span class="btn_simple page_btn fr">Сортировать:</span>-->

		<div class="clear"></div>

		<table class="table no-nowrap" width='90%'>
			<thead>
				<th class="center" style="width:100px;">DOMEN</th>
				<th class="center" style="width:6px;">U</th>
				<th class="center">TABLES</th>
	
				<th class="center">PRIV</th>
				<th class="center">TIC</th>
				<th class="center" >PR</th>
				<th class="center" >AlEXA</th>
	
				<th class="center">STATUS</th>
				<th class="center">METHOD</th>
				<th class="center">HEADER</th>
				<th class="center">TYPEDB</th>
				<th class="center" >DATE</th>
				<th class="center" >CLICK</th>
			</thead>
			<tbody>
			
				
			
				<? if(count($data)==0){ ?>
					<tr>
						<td colspan="4" class="center">Нет строк для отображения</td>
					</tr>
				<? }else{ ?>
				
				
					<? foreach ($data as $value){ ?>
					<? //print_r($value); ?>
					
					<?php if($value['Filed'][0] !='')
					{
						echo '<tr style="background-color:#ddd;" id="data'.$value['posts_all']['id'].'">';
					}else{
						echo '<tr id="data'.$value['posts_all']['id'].'">';
					
					}?>
					
						<? $f = parse_url($value['posts_all']['gurl']);?>
						<td  class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 150px;" class="red"><?=$html->link($value['posts_all']['domen'],$http .'://'.$value['posts_all']['domen'],array('target'=>'_blank'));?></div></td>
						
						<?php
							$http = str_replace('://','',$value['posts_all']['http']);
						?>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 6px;"><?=$html->link('u',$http.'://'.$value['posts_all']['url'],array('target'=>'_blank'));?></div></td>
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 100px;"><?=$value['posts_all']['tables']?></div></td>
					
						<td class="center" style="font-size:10px;"><?=$value['posts_all']['file_priv']?></td>
						<td class="center" style="font-size:10px;"><?
						if($value['posts_all']['tic']==-1){
							echo 'n/a';
						}else{
							echo $value['posts_all']['tic'];
						}
						
						?></td>
						<td class="center" style="font-size:10px;"><?=$value['posts_all']['pr']?></td>
						<td class="center" style="font-size:10px;"><? echo $value['posts_all']['alexa'];?></td>
						
							
						
						
						
			
						
						<?
						if($value['posts_all']['country'] == 'unkown' or $value['posts_all']['country'] == '0' )
						{
							$cc = 'unkown';
					
						}elseif($value['posts_all']['country'] == 'EU'){
							$cc ='EU';
						}
						else{
							$cc = '<img src=/flags/'.$value['posts_all']['country'].'.gif>';
						}?>
						
							
						<?if($value['posts_all']['status']==2 AND $value['posts_all']['prohod']==5){?>
							<td class="center" style="font-size:10px;"><span style='color:blue;font-weight:600'>BAD</span></td>
							
							
						<?}elseif($value['posts_all']['status']==3){?>
							
							<td class="center" style="font-size:10px;"><span style='color:red;font-weight:600'>GOOD</span></td>
							
					<?	}else{?>
						<td class="center" style="font-size:10px;"><span style='color:green;'>CHEKING</span></td>
						
						<?}?>
						
						
						<?if($value['posts_all']['header']=='post'){?>
							<td class="center" style="font-size:10px;"><span style='color:blue;font-weight:600'><?=$value['posts_all']['header'];?></span></td>
							
							
						<?}else{?>
							
							<td class="center" style="font-size:10px;"><span style='color:red;font-weight:600'><?=$value['posts_all']['header'];?></span></td>
							
					<?	}?>
						
						<td class="center" style="font-size:10px;"><?=$value['posts_all']['find']?></td>
						
						
						<? 
						
						if(preg_match("/microsoft/i",$value['posts_all']['version']))
						{
						?>
							<td class="center" style="font-size:10px;color:blue;">mssql 100%</td>
						<?
						}else{?>
							<td class="center" style="font-size:10px;color:red">mysql 100%</td>
						<?}
						
							
						?>
						
						
						
						<td class="center" style="font-size:10px;"><?=$value['posts_all']['date']?></td>
						<td width="70">																					
							<?=$this->Html->link($this->Html->image("curl.png", array("alt" => "Запустить")),array('action'=>'view_order_one/'.$value['posts_all']['id'].'/posts_all'),array('escape' => false,'class' => 'icon','title'=>'Запустить'))?>		
							<?=$ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts/shlak_all/'.$value['posts_all']['id'],array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$value['posts_all']['id']))?>
						</td>
					</tr>
					
				
					
					<?php  if($value['Filed'][0] !=''){
					
						foreach($value['Filed'] as $val)
						{
						
						echo "<tr style='background-color:#ccc;' id='data".$val['id']."'><td colspan='10'>";
						echo "<span style='font-size:12px;color:red;'>ID: </span>".$val['id']."</span> ";;
						echo " || <span style='font-size:12px;color:red;'>  Найдено мыл:</span> <span style='font-size:15px;color:blue;'>".$val['count']."</span>";
						
					
						
						echo " || <span style='font-size:12px;color:red;'>  Статус скачки:</span> ";
						
						
						if($val['get']==2){
							echo "<span style='font-size:15px;color:blue;'>Закончили </span>";
						}elseif($val['get']==3){
							echo "<span style='font-size:15px;color:blue;'>Разорвано </span>";
						}elseif($val['get']==''){
							echo "<span style='font-size:15px;color:blue;'>Не начато </span>";
						}elseif($val['get']==1){ 
							echo 'Сливаем'.$this->Html->image("loader.gif", array("alt" => "Проверить позже"));
						}
						
						
						//echo " || <span style='font-size:12px;color:red;'>Multi:</span><span style='font-size:15px;color:blue;'> ".$value['Filed'][0]['multi']."</span> ";
						echo " || <span style='font-size:12px;font-weight:700'>".$val['table'].'.'.$val['label'].'</span><span class="green" style="font-weight:700">'.$val['password'].'</span>	';
						
									
							echo '<td width="60">'.$ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts_alls/shlak3/'.$val['id'],array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$val['id'])).' <a href="/posts_alls/view_iframe/'.$val['id'].'" target="_blank"><span style="font-size:12px;color:red;">>></a></span></td>';
						
						
						echo "</td></tr>";
					}}?>
					
					
					
					<? } ?>
				<? } ?>
			</tbody>
		</table>
	
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->prev('« Назад ', " "," ", array('class' => 'disabled'))?></span>
		<span class="btn_simple page_btn fl"><?=$paginator->counter(array('separator'=>' из '))?></span>
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->next(' Дальше »'," "," ", array('class' => 'disabled'))?></span>

		<div class="clear"></div>

		
		<br/><br/>
	</div>
	<!-- STOP CONTENT -->