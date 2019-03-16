	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li ><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li class="active"><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li><?=$html->link('Одиночный дампинг',array('action'=>'dumping_all')); ?></li>
			
		</ul>
		<div class="clear"></div> 
		<table class="table">
			<thead>
				<th>Добавление доменов</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="hash">Укажите путь к файлу ссылок(добавить сразу):</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<br>
						<?=$form->input('link',array('type'=>'text', 'class'=>'input','div'=>false,'label'=>'url к файлу с с доменами '))?>
						
						<br>
						
						
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<br/>
						
						
					
						
						
						<span class="comment red">Допустимый формат файлов .txt в кодировке UTF-8</span>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->
		
		
		
		

