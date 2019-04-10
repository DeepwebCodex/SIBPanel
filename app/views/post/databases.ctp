	<!-- START CONTENT -->
	<div id="content">

		<span class="btn_simple btn_green page_btn fl"><?=$paginator->prev('« Назад ', " "," ", array('class' => 'disabled'))?></span>
		<span class="btn_simple page_btn fl"><?=$paginator->counter(array('separator'=>' из '))?></span>
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->next(' Дальше »'," "," ", array('class' => 'disabled'))?></span>

		
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('мульти', 'multi')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('статус', 'get')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('количество', 'count')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('пароли', 'password')?></span>
        <span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('adress', 'adress')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('название', 'table')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('id', 'id')?></span>
		
		<span class="btn_simple page_btn fr">Сортировать по:</span>

		<div class="clear"></div>

		<table class="table">
			<thead>
				<th class="center" style="width:130px;">id</th>
				<th class="center" style="width:130px;">Сайт</th>
				<th class="center" style="width:15px;">U</th>
				<th class="center">Название</th>
				<th class="center">Пароли</th>
				<th class="center">Имена</th>
				<th class="center">Логин</th>
				<th class="center">Соль</th>
                <th class="center">ТЕЛ</th>
                <th class="center">АДРЕСС</th>
				<th class="center">Тип БД</th>
				<th class="center">Количество</th>
				<th class="center">Статус</th>
				<th class="center">Мульти</th>
				<th class="center">Клик</th>
			</thead>
			<tbody>
				<? if(count($data)==0){ ?>
					<tr>
						<td colspan="3" class="center">Нет строк для отображения</td>
					</tr>
				<? }else{ ?>
					<? foreach ($data as $value){ ?>
					
					<?php 
					//print_r($value['Filed']);
					
					if($value['Filed']['color'] =='white')
					{
						echo '<tr style="background-color:white" id="data'.$value['Filed']['id'].'">';
						
					}elseif($value['Filed']['color'] =='CCCC00'){
						
						echo '<tr style="background-color:#CCCC00" id="data'.$value['Filed']['id'].'">';
					}elseif($value['Filed']['color'] =='CC0099'){
						
						echo '<tr style="background-color:#CC0099" id="data'.$value['Filed']['id'].'">';
					}else
					{
						echo '<tr style="background-color:white" id="data'.$value['Filed']['id'].'">';
					}?>
					
					
					
						
						<? $bd = explode(':', $value['Filed']['ipbase']);?>
						
						<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><?=$value['Filed']['id']?></div></td>
						
						
						<? $f = parse_url('http://'.$value['Filed']['site']);?>
						<td class="center" style="font-size:10px;"> <div style="word-wrap:break-word; width:130px; white-space:normal;"><?=$html->link($f['host'],'http://'.$f['host'],array('target'=>'_blank')); ?></div></td>
						
						<td class="center" style="font-size:10px;"> <div style="word-wrap:break-word;width: 6px; white-space:normal;"><?=$html->link('u','http://'.$value['Filed']['site'],array('target'=>'_blank'));?></div></td>
					
						<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 140px; white-space:normal;"><?=$bd[1].'/'.$value['Filed']['table']?> / <?=$value['Filed']['label']?><div></td>
						
						<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['password']?></span></div></td>
						
							<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['name']?></span></div></td>
							
							<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['login']?></span></div></td>
							
							<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['salt']?></span></div></td>
                            
                            <td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['phone']?></span></div></td>
                            
                            <td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?=$value['Filed']['adress']?></span></div></td>
							
							
								<td  class="center" style="font-size:10px;"><div style="word-wrap:break-word; width: 80px; white-space:normal;"><span class="green"><?
								if($value['Filed']['typedb'] == 'mssql'){
									echo "<span style='color:blue;'>";
									echo  $value['Filed']['typedb'];
									echo "</span>";
								}else{
									echo $value['Filed']['typedb'];
									
								}
								
								
								?></span></div></td>
						
						
						
						<td class="center" style="font-size:10px;"><?=$value['Filed']['lastlimit']?>/<span class="red"><?=$value['Filed']['count']?></span></td>
						<td class="center" style="font-size:10px;">
							<? if($value['Filed']['get']==0){ ?>
								Не начали
							<? }elseif($value['Filed']['get']==1){ ?>
								Сливаем <?= $this->Html->image("loader.gif", array("alt" => "Проверить позже")) ?>
							<? }elseif($value['Filed']['get']==2){ ?>
								<span class="green">Закончили</span>
							<? }elseif($value['Filed']['get']==3) 
							{
								if($value['Filed']['count']-$value['Filed']['lastlimit'] < 500){
									echo '<span class="red">Закончили</span>';
								}else{
									echo '<span class="red">Разорвано</span>';
								}
								
							
							
							
							 } ?>
							
							
							<!--
							<? if($value['Filed']['function']==1){ ?>
								- МЕДЛЕННАЯ!
							<? } ?>
							-->
						</td>
						
						<td class="center"><span class="red"><?=$value['Filed']['multi']?></span></td>
						
					 <?// print_r($value); exit;?>
					 
						
						<? echo '<td width="60">'.$ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts/shlak3/'.$value['Filed']['id'],array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$value['Filed']['id']));
						
						
						//echo $this->Html->link($this->Html->image("curl.png", array("alt" => "Запустить")),array('action'=>'/view_order_one/'.$value['Filed']['id'].''),array('escape' => false,'class' => 'icon','title'=>'Запустить'));	
						echo '<a href="/posts/view_iframe/'.$value['Filed']['id'].'" target="_blank"><span style="font-size:12px;color:red;">->></a></span>';
						echo '<br>';
						
						echo $ajax->link('D', '/posts/color/'.$value['Filed']['id'].'/CCCC00',array('class'=>'icon','title'=>'чёто интересное','escape' => false));
						
						echo '||';
						
						echo $ajax->link('W', '/posts/color/'.$value['Filed']['id'].'/white',array('class'=>'icon','title'=>'сбросить выдаление','escape' => false));
						echo '||';
						
						echo $ajax->link('G', '/posts/color/'.$value['Filed']['id'].'/CC0099',array('class'=>'icon','title'=>'Гавно','escape' => false));
						
						echo '||';
						
						echo $ajax->link('P', '/posts/up/'.$value['Filed']['id'],array('class'=>'icon','title'=>'Перезапуск','escape' => false));
						
						
						
						echo '</td>'; 
						
						
						?>
						
					</tr>
					<? } ?>
				<? } ?>
			</tbody>
		</table>

		<span class="btn_simple btn_green page_btn fl"><?=$paginator->prev('« Назад ', " "," ", array('class' => 'disabled'))?></span>
		<span class="btn_simple page_btn fl"><?=$paginator->counter(array('separator'=>' из '))?></span>
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->next(' Дальше »'," "," ", array('class' => 'disabled'))?></span>

		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('статус', 'get')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('количество', 'count')?></span>
		<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('название', 'table')?></span>
		<span class="btn_simple page_btn fr">Сортировать по:</span>

		<div class="clear"></div>
	</div>
	<!-- STOP CONTENT -->