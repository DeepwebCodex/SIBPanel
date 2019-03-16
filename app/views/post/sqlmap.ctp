	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
		
			<li><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li class="active"><?=$html->link('SQLMAP анализ',array('action'=>'sqlmap')); ?></li>
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
						<label for="hash">Укажите путь к файлу ссылок(добавить сразу) ЕСЛИ ХОТИТЕ ЗАЛИВАТЬ 1 ЛИНК  = 1 ДОМЕН. Сразу в основную базу:</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file_one',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<br>
						
						
						<br>
						
						
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<br/>
						
						
					
					
					
					
						<label for="hash">Укажите путь к файлу ссылок(добавить сразу) Если хотите сканить N ссылок с домена то сюда, править в корне config.php</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<br>
						<?=$form->input('link',array('type'=>'text', 'class'=>'input','div'=>false,'label'=>'url к файлу с ссылками '))?>
						
						<br>
						
						
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						<br/>
						
						
						<label for="hash">Укажите путь к файлу ссылок(фоновое добавление):</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file_cron',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						
						<br>
						
						<?=$form->input('link2',array('type'=>'text', 'class'=>'input','div'=>false,'label'=>'url к файлу с ссылками для крона '))?>
							<br>
						
						
						<?=$form->submit('Добавить в крон', array('name'=>'cron','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br/>
						
						
						<span class="comment red">Допустимый формат файлов .txt в кодировке UTF-8</span>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->
		
		
		
		

