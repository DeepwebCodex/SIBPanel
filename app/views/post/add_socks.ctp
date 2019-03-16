	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li class="active"><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li><?=$html->link('Добавить прокси',array('action'=>'add_socks')); ?></li>
			<li><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			
		</ul>
		<div class="clear"></div>
	
		<table class="table">
			<thead>
				<th>Добавление ссылок</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="hash">Укажите путь к файлу прокси!Не соксов:</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<span class="comment red">Допустимый формат файлов .txt в кодировке UTF-8</span>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->
		
		
		
		

