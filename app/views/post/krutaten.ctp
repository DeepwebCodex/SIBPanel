	<!-- START CONTENT -->
	<div id="content">
	
		<div class="page_block">
			
			Сайт:<?
			$f = parse_url($inject['Post']['gurl']);
			$g = $f['host'];
			echo "<a target='_blank' href='http://$g' />$g</a>";?><br/>
			
			Url: <?=$inject['Post']['url'];?><br/>
			Версия: <?=$inject['Post']['version']?><br/>
			Колонки: <?=$inject['Post']['work']?><br/>
			FILE_PRIV: <?=($inject['Post']['file_priv']=='1')? 'Y' : 'N'?><br/>
			<?if($inject['Post']['tables']!==''){?>
			Таблицы:<?=$inject['Post']['tables']?><br/>
			<?}?>
			----------------------------------<br/>
			ТИЦ: <?=$inject['Post']['tic']?><br/>
			PR: <?=$inject['Post']['pr']?><br/>
			ALEXA: <?=$inject['Post']['al']?><br/>
			Category~: <?=$inject['Post']['category']?><br/>
			COUNTRY~: <?=$inject['Post']['country']?><br/>
			
			
			<?if(trim(@$inject['Post']['logs'])!==''){?> [!] <?}?>
		</div>
		<br/>
		<table class="table">
			<thead>
				<th class="center" colspan="2">Получить бд,таблицы,колонки,данные</th>
			</thead>
			<tbody>
				<tr>
					<td colspan="2" class="center">
						<?=$ajax->link('GET BD', 'getbd/'.$this->params['pass']['0'],array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'bds'))?>
						<?=$ajax->link('GET DATA', 'getcooldata',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'cont'))?>
						<?=$ajax->link('Find Admin', 'admin/'.$g,array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'cont'))?>
					</td>
				</tr>
				<tr>
					<td id="bds" width="30%" class="va-top">
						<? if(isset($inject['bds'])){ ?>
							<?=$this->element('data',array('data'=>$inject))?>
						<?}?>
					</td>
					<td width="70%" class="va-top">
						<?=$ajax->remoteTimer(array('url' => array( 'controller' => 'posts', 'action' => 'viewdata'),'update' => 'datacool',false,'frequency' => 2))?>
						<div id="field">
							<?=$this->element('field')?>
						</div>
						<div id="cont"></div>
					</td>
				</tr>
			</tbody>
		</table>
		<br/>
		<?=$ajax->link('Очистить логи', 'clearUrl',array('class'=>'btn_simple btn_red page_btn fr','indicator'=>'work','escape' => false))?>
		<div class="clear"></div>
		<?php if(count($urls)>0){ $urrrl = ''; foreach ($urls as $value) $urrrl .= $value."\n\r"; }else $urrrl ='';?>
		<?=$ajax->remoteTimer(array('url' => array( 'controller' => 'posts', 'action' => 'urls'),'update' => 'logs',false,'frequency' => 2))?>
		<?=$form->textarea('logs',array('value'=>$urrrl,'id'=>'logs','style'=>'width:100%;height:200px'))?>
	</div>
	<!-- STOP CONTENT -->