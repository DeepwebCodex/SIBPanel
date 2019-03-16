	<!-- START CONTENT -->
	<div id="content">

		<div class="clear"></div>
		<ul class="page-nav fl">
			<li><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li class="active"><?=$html->link('Статистика посещений',array('action'=>'statistics')); ?></li>
		</ul>
		<div class="clear"></div>
	
		
		<table class="table">
			<thead>
				<th>IP Адресс</th>
				<th width="18%">Дата посещения</th>
				<th width="18%">Время посещения</th>
			</thead>
			<tbody>
				<? if(count($clients)!==0){ ?>
					<? foreach ($clients as $client){ ?>
					<tr>
						<td><?=$client['ip']?></td>
						<td class="center"><?=date('d-m-Y',$client['datetime'])?></td>
						<td class="center"><?=date('H:i:s',$client['datetime'])?></td>
					</tr>
					<? } ?>
				<? } else { ?>
					<tr>
						<td colspan="3">Список пуст</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
		
		


	</div>
	<!-- STOP CONTENT -->