	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li class="active"><?=$html->link('Шеллы',array('action'=>'shelltest2')); ?></li>
			<li><?=$html->link('Таблица Fileds',array('action'=>'squleview')); ?></li>
			<li><?=$html->link('Чекнуть шеллы',array('action'=>'shelltest/yes')); ?></li>
			<li><?=$html->link('Чекнуть прокси',array('action'=>'proxy_one')); ?></li>
			<li><?=$html->link('Обновить главную',array('action'=>'mailinfo2')); ?></li>
			
			
		</ul>

		

		<div class="clear"></div>
		<table class="table no-nowrap">
			<thead>
				<th class="center">Список действующих шеллов <?if(count($serv) > 0){?>(<?=count($serv)?> шт.)<?}?></th>
			</thead>
			<tbody>
				<? if(count($serv)==0){ ?>
					<tr>
						<td class="center">Нет строк для отображения</td>
					</tr>
				<? }else{ ?>
					<? foreach ($serv as $ser){ ?>
					<tr>
						<td><?=$ser ?></td>
					</tr>
					<? } ?>
				<? } ?>
			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->