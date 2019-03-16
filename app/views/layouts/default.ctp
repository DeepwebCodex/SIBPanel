<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SIB Service - NETSKY Project</title>
	<link href="favicon.ico" rel="shortcut icon" />
	
	<?=$html->css('reset'); ?>
	<?=$html->css('style'); ?>

	<?//=$javascript->link('jquery');?>
	
	
<script type="text/javascript">
function ShowDiv(obj)
{
 document.getElementById('divId'+obj).style.display = 'block';
}


function ShowDiv2(obj)
{
 document.getElementById('divId'+obj).style.display = 'none';
}
</script>


	
	<script type="text/javascript">

	
	var qw=jQuery.noConflict();
	function ShowOpenMenu(gen){
		qw('#'+gen).slideToggle();
		qw('#plus_'+gen).hide();
		qw('#minus_'+gen).show();
	}
	function ShowCheckMinus(gen){	
		ShowOpenMenu(gen);
		qw('#plus_'+gen).show();
		qw('#minus_'+gen).hide();
	}
	</script>
	
	

	
	
	
	<?=$javascript->link('prototype'); ?>
	<?=$javascript->link('scriptaculous.js?load=effects,builder'); ?>
</head>
<body>
<div id="work" class="work" style="display: none;">
	<div class="loader_big"></div>
</div>

<div class="wrap">
	<!-- START HEADER -->
	<div id="header">
	
		
		
		
	<nav class="top-navigation ">
	
	<ul class="navigation-list">
		<li class="<?=($this->params['action']=='mailinfo' || $this->params['action']=='add')?'active':'' ?>"><?=$html->link('Состояние',array('action'=>'mailinfo')); ?> </li>
		
		<li class="<?=($this->params['action']=='index' || $this->params['action']=='krutaten')?'active':'' ?>"><?=$html->link('Уязвимые['.$usp.']',array('action'=>'index/3')); ?></li>
		
		<li class="<?=($this->params['action']=='index2' || $this->params['action']=='krutaten')?'active':'' ?>"><?=$html->link('Невскрытые['.$usp22.']',array('action'=>'index2/1')); ?></li>
		
		
		
		
		

		
		<li class="<?=($this->params['action']=='databases')?'active':'' ?>"><?=$html->link('[T]Мыла['.$usp2.']',array('action'=>'databases')); ?></li>
		
		<li class="<?=($this->params['action']=='order_count')?'active':'' ?>"><?=$html->link('[T]Карты ['.$usp4.']',array('action'=>'order_count')); ?></li> 
		 
		<li class="<?=($this->params['action']=='ssn_count')?'active':'' ?>"><?=$html->link('[T]SSN ['.$usp44.']',array('action'=>'ssn_count')); ?></li> 
		
		

		<li class="<?=($this->params['action']=='domens' || $this->params['action']=='domens2' || $this->params['action']=='domens3' || $this->params['action']=='domens4' || $this->params['action']=='download_domens')?'active':'' ?>"><?=$html->link('Выборки',array('action'=>'domens')); ?></li>
		
		<li class="<?=($this->params['action']=='shelltest2' || $this->params['action']=='hash')?'active':'' ?>"><?=$html->link('Другое',array('action'=>'shelltest2')); ?></li>
		
		<li class="<?=($this->params['action']=='terms')?'active':'' ?>"><?=$html->link('СОГЛАШЕНИЕ',array('action'=>'terms')); ?></li> 
		
	
		</ul>
	</nav>
	
	<div style="clear:both"></div>
	
	<div style='text-align:left;'>
	
		<ul class="navigation-list">
		
		<li class="<?=($this->params['action']=='domens')?'active':'' ?>"><?=$html->link('ДОМЕНЫ УЯЗВИМЫЕ ['.$domens10.']',array('action'=>'order_domens')); ?></li> 
		
		<li class="<?=($this->params['action']=='domens')?'active':'' ?>"><?=$html->link('ДОМЕНЫ ПЛОХИЕ ['.$domens11.']',array('action'=>'order_domens_bad')); ?></li> 
		
		<li class="<?=($this->params['action']=='domens')?'active':'' ?>"><?=$html->link('ПОТЕНЦИАЛЬНЫЕ ЛИНКИ В ПУЛЕ ['.$domens_links.']',array('action'=>'index3')); ?></li> 
		
		<li class="<?=($this->params['action']=='index_forms' || $this->params['action']=='krutaten')?'active':'' ?>"><?=$html->link('Изменения',array('action'=>'index2/1_f')); ?></li>
		</ul>
	
	</div>
	
	<div style="clear:both"></div>
	<br>
</div>
	<!-- STOP HEADER -->

	<!-- START INFOBAR -->
	<br>
	<br>
	<div class="infobar" style='text-align:left;clear:both;'>
	<div>Версия 6.0 
	<br>SQLMAP/POST/HTTPS/
	</div>
		
	<br>
	<div class="fl"><?=$html->link('Очистить базу данных',array('action'=>'empty_databases'),array('class'=>'','onclick'=>'if(!confirm("Вся база полностью будет очищена. Продолжить?")){return false;}'))?></div>
	<br>
	
		
		
		<div class="fl">Сылок и форм в общем ПУЛЕ, всего: <?=$post_all_links;?>/ <a href="/posts/post_recheck">перечекать ссылки</a>  </div>  <br>
		
		<div class="fl">Сылок и форм в общем ПУЛЕ добавленных из TXT, всего: <?=$post_all_links_txt;?>/ <a href="/posts/post_recheck/txt">перечекать ссылки</a>  </div>  <br>
		
		<div class="fl">Сылок и форм в общем ПУЛЕ найденных ПАУКОМ, всего: <?=$post_all_links_crowler;?>/ <a href="/posts/post_recheck/crowler/txt">перечекать ссылки</a>  </div>  <br>
		
		 <br>
		 <br>
		

		
		
	
		<div class="fl">Попали в шлак ссылки и формы из ПУЛА: <?=$post_all_links_shlak?>  </div>  <br>
		
	
	
		<div class="fl">Попали в шлак ссылки: <?=$shlak;?> / <a href="/posts/post_recheck">перечекать ссылки</a>  </div>  <br>
		
		<div class="fl">Попали в шлак домены: <?=$shlak_domens;?> / <a href="/posts/domen_recheck">перечекать домены</a> </div> <br>
		
		
		
	
		
		
		<div class="fl"><a href="/posts/mailinfo2">Обновить главную</a> </div>
		<br><br>
		
		
		<div class="fl"><?=$html->link('Перечекать через sqlmap ВСЕ вообще',array('action'=>'sqlmap_check_all'),array('class'=>'','onclick'=>'if(!confirm("Перечекать дополнительно ВСЕ  Продолжить?")){return false;}'))?></div> <br>
		
		<div class="fl"><?=$html->link('Перечекать через sqlmap ВСЕ НЕВСКРЫТЫЕ + УЯЗВИМЫЕ',array('action'=>'sqlmap_check_y'),array('class'=>'','onclick'=>'if(!confirm("Перечекать дополнительно ВСЕ НЕВСКРЫТЫЕ+ УЯЗВИМЫЕ. Продолжить?")){return false;}'))?></div> <br>
		
		<div class="fl"><?=$html->link('Перечекать через sqlmap ВСЕ НЕВСКРЫТЫЕ',array('action'=>'sqlmap_check_ne'),array('class'=>'','onclick'=>'if(!confirm("Перечекать дополнительно ВСЕ НЕВСКРЫТЫЕ. Продолжить?")){return false;}'))?></div> <br>
		
		<div class="fl"><?=$html->link('По новой найти таблицы с email',array('action'=>'multi_duble_check_email'),array('class'=>'','onclick'=>'if(!confirm("Будет по новой произведен поиск емайлов. Продолжить?")){return false;}'))?></div> <br>
		
		<div class="fl"><?=$html->link('Перечекать невскрытые',array('action'=>'multi_duble_check'),array('class'=>'','onclick'=>'if(!confirm("Все ссылки будут перечеканы. Продолжить?")){return false;}'))?></div> <br>

		<div class="fl"> <a href="/posts/down_test">скачать все Уязвимые</a> </div> <br>
		
		<div class="fl"> <a href="/posts/down_test_priv">скачать все Уязвимые где есть права на запись (file_priv)</a> </div> <br>
		
		<div class="fl"> <a href="/posts/down_multi">скачать все НЕВСКРЫТЫЕ (30% уязвимы через sqlmap)</a> </div> <br>
		
		<div class="fl"> <a href="/posts/down_multi_top">скачать все НЕВСКРЫТЫЕ алекса < 50000 и pr >6 (30% уязвимы через sqlmap)</a> </div> <br>
		
		
		
		
		
	</div>
	<!-- STOP INFOBAR -->

<!--
<?=$html->link('Добавить ссылок',array('action'=>'add')); ?>
<?=$html->link('Добавить прокси',array('action'=>'add_proxy')); ?>

<?php 
	echo $form->create('Post',array('action'=>'goadd'));
	echo $form->input('gurl',array('style'=>'width:100%','value'=>@$inject['Post']['gurl'],'class'=>false,'label'=>false));
	echo $form->submit('getData');
	echo $form->end();
?>



-->

<?=$content_for_layout;?>


	<!-- START FOOTER -->
	
	<!-- STOP FOOTER -->
</div>
</body>
</html>