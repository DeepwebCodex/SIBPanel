	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li class="active"><?=$html->link('Одиночный дампинг',array('action'=>'dumping_all')); ?></li>
		</ul>
		<div class="clear"></div>
	
	

		
		
		
		<div class="clear"></div>
		<?	
		if(count($starts3_one)!==0)
		{
		echo '<br><h2 class="center" style="font-size:18px">Мультипоточная скачка одиночного сайта с выбраными колонками</h2><br>';?>
		
		<table class="table">
			<thead>
				
				<th class="center" width="50">ID</th>
				<th class="center" width="50">PID</th>
				<th class="center" width="50">Domen</th>
				<th class="center" width="50">Filed_ID</th>
				<th class="center" width="50">LASTLIMIT</th>
				<th class="center" width="10%">COUNT:</th>
				<th class="center" width="5">GET</th>
				<th class="center" width="5%">POTOK</th>
				<th class="center" width="5%">SPEED</th>
				<th class="center" width="5%">DOK</th>
				<th class="center" width="5%">Действия</th>
				<th class="center" width="5%">Применить</th>
				<th class="center" width="5%">Статус</th>
				<th class="center" width="5%">Причина</th>
				
				
			</thead>
			<tbody>
				<? foreach ($starts3_one as $work3){ ?>
				<tr>
					<td class="center"><?=$work3['multis_one']['id']?></td>
					<td class="center"><?=$work3['multis_one']['pid']?></td>
					<td class="center"><?=$work3['multis_one']['domen']?></td>
					<td class="center"><?=$work3['multis_one']['filed_id']?></td>
					
					<? echo "<FORM ACTION='/posts/dumping_all/' METHOD='POST'>";?>
					
					<td class="center">
					 <? echo "<input type='text' size='3' name='limit' value='".$work3['multis_one']['lastlimit']."'>"; ?>
					</td>
					<td class="center"><?=$work3['multis_one']['count']?></td>
					<td class="center"><?=$work3['multis_one']['get']?></td>
					
					
					
					
					
					<td class="center"><?=$work3['multis_one']['potok']?></td>
					<?
					if($work3['multis_one']['function']==1 ){
					
						$speed = 'slow';
					}else{
						
						$speed = 'fast';
					}
					?>
					<td class="center"><?=$speed?></td>
					
					
					
					<td class="center">
					
					
						 <? echo "<input type='text' size='2' name='dok' value='".$work3['multis_one']['dok']."'>"; ?>
					
					
					
					
					</td>
					
					
				
			
		<?	echo "<td><select name='st3_one'>";
			echo "<option value='2'>Закончить</option>";
			echo "<option value='3' selected>Перезапустить</option>";
			echo "<option value='4' >Удалить</option>";
			echo "</select></td>";
			echo "<input type='hidden' name='id3' value='".$work3['multis_one']['id']."'>";
			echo "<td><input type='hidden' name='filed_id' value='".$work3['multis_one']['filed_id']."'>";
			echo "<input type='hidden' name='pid' value='".$work3['multis_one']['pid']."'>";
			echo "<input type='submit' name='update33' value='update'>";
			echo "</td>";
			echo '</FORM>';
			
			$time = time();
			
			
			
			if($work3['multis_one']['get'] == 3){
			
				$st = 'В процессе';
			}elseif($work3['multis_one']['get'] == 2){
				$st = 'Остановлен';
			}elseif($work3['multis_one']['get'] == 1){
				
				
				
				if(($time - $work3['multis_one']['date']) > 500){
			
					$st = 'Завис';
				}else{
					$st = 'Качается';
					
				}
			}
			
			
			
				echo "<td class='center'>".$st."</td>";?>
			
			<? echo "<td class='center'>".$work3['multis_one']['prich']."</td></tr>";?>

				<? } ?>
			</tbody>
		</table>
		<? } ?>
		
		
	</div>
	<!-- STOP CONTENT -->
		
		
		
		

