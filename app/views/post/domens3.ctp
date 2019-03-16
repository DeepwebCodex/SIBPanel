<? if(!isset($z) && !isset($t)){ ?>

	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li><?=$html->link('Domens',array('action'=>'domens')); ?></li>
			<li><?=$html->link('Domens2',array('action'=>'domens2')); ?></li>
			<li class="active"><?=$html->link('Domens3',array('action'=>'domens3')); ?></li>
			<li><?=$html->link('Domens4',array('action'=>'domens4')); ?></li>
			<li><?=$html->link('Cкачать',array('action'=>'download_domens')); ?></li>
		</ul>

		<div class="clear"></div>
		<table class="table no-nowrap">
			<thead>
				<th>Домен</th><th class="center">Хешированые</th><th class="center">Откртые</th>
			</thead>
			<tbody>
				<? if(count($domen) > 0){ ?>
					<? foreach ($domen as $key => $val){ ?>
					<tr>
						<td>.<?=$key?> - <?=$val?> в базе</td>
						<td><?=$html->link('Скачать',array('action'=>'domens3/?z='.$key.'&t=1'),array('class'=>'btn btn_green')); ?></td>
						<td><?=$html->link('Скачать',array('action'=>'domens3/?z='.$key.'&t=2'),array('class'=>'btn btn_green')); ?></td>
					</tr>
					<? } ?>
				<? }else{ ?>
					<tr>
						<td colspan="3" class="center">Нет записей</td>
					</tr>
				<? } ?>
			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->

<?
}else {	

	if($t==1){
		ob_clean();
		header("Content-Description: File Transfer\r\n");
		header("Pragma: public\r\n");
		header("Expires: 0\r\n");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
		header("Cache-Control: public\r\n");
		header("Content-Type: text/plain; charset=UTF-8\r\n");
		header("Content-Disposition: attachment; filename=\"{$z}_h.txt\"\r\n");
		ob_end_clean();
		$dd = new DATABASE_CONFIG;
		$dannie=$dd->default;
		$ddb2=mysql_connect($dannie['host'],$dannie['login'],$dannie['password']);
		mysql_select_db($dannie['database'],$ddb2);
		$result = mysql_query("SELECT * FROM `domens` WHERE domen2='$z'",$ddb2);
		while ($row = mysql_fetch_array($result)){
			if($row[1]==$z){
				if(strlen($row[3])>=11)
					echo $row[2].":".$row[3]."\n";
			}
		}
		exit;
	}
	
	if($t==2){
		ob_clean();
		header("Content-Description: File Transfer\r\n");
		header("Pragma: public\r\n");
		header("Expires: 0\r\n");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
		header("Cache-Control: public\r\n");
		header("Content-Type: text/plain; charset=UTF-8\r\n");
		header("Content-Disposition: attachment; filename=\"{$z}_o.txt\"\r\n");
		$dd = new DATABASE_CONFIG;
		$dannie=$dd->default;
		$ddb2=mysql_connect($dannie['host'],$dannie['login'],$dannie['password']);
			mysql_select_db($dannie['database'],$ddb2);
			$result = mysql_query("SELECT * FROM `domens` WHERE domen2='$z'",$ddb2);
			while ($row = mysql_fetch_array($result)){
			if($row[1]==$z){
				if(strlen($row[3])<=10)
					echo $row[2].":".$row[3]."\n";
			}
		}
		exit;
	}

}

?>