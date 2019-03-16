	<!-- START CONTENT -->
	<div id="content">
	
	<span class="btn_simple btn_green page_btn fl"><?=$paginator->prev('« Назад ', " "," ", array('class' => 'disabled'))?></span>
	<span class="btn_simple page_btn fl"><?=$paginator->counter(array('separator'=>' из '))?></span>
	<span class="btn_simple btn_green page_btn fl"><?=$paginator->next(' Дальше »'," "," ", array('class' => 'disabled'))?></span>

	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('date', 'date')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('pr', 'pr')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('alexa', 'alexa')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('country', 'country')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('method', 'method')?></span>
	<span class="btn_simple btn_green page_btn fr"><?=$paginator->sort('id', 'post.id')?></span>
	
	
	<!--<span class="btn_simple page_btn fr">Сортировать:</span>-->

		<div class="clear"></div>

		<table class="table no-nowrap" width='90%'>
			<thead>
				<th class="center" style="width:100px;">DOMEN</th>
				<th class="center" style="width:6px;">U</th>
				
				<th class="center">TIC</th>
				<th class="center" >PR</th>
				<th class="center" >AlEXA</th>
				<th class="center" >COUNTRY</th>
				<th class="center">METHOD</th>
				<th class="center" >DATE</th>
				<th class="center" >COUNT</th>
				<th class="center" >CLICK</th>
			</thead>
			<tbody>
			
				
			
				<? if(count($data)==0){ ?>
					<tr>
						<td colspan="4" class="center">Нет строк для отображения</td>
					</tr>
				<? }else{ ?>
					<? foreach ($data as $value){ ?>
					
					<?php if($value['Filed'][0] !='')
					{
						echo '<tr style="background-color:#ddd;" id="data'.$value['Post']['id'].'">';
					}else{
						echo '<tr id="data'.$value['Post']['id'].'">';
					
					}?>
					
						<? $f = parse_url($value['Post']['gurl']);?>
						<td  class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 150px;" class="red"><?=$html->link($value['Post']['domen'],'http://'.$value['Post']['domen'],array('target'=>'_blank'));?></div></td>
						<td class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 6px;"><?=$html->link('u','http://'.$value['Post']['url'],array('target'=>'_blank'));?></div></td>
						
						
					
						
						<td class="center" style="font-size:10px;"><?
						if($value['Post']['tic']==-1){
							echo 'n/a';
						}else{
							echo $value['Post']['tic'];
						}
						
						?></td>
						<td class="center" style="font-size:10px;"><?=$value['Post']['pr']?></td>
						<td class="center" style="font-size:10px;"><? echo $value['Post']['alexa'];?></td>
						
							
						
						
						
			
						
						<?
						if($value['Post']['country'] == 'unkown' or $value['Post']['country'] == '0' )
						{
							$cc = 'unkown';
					
						}elseif($value['Post']['country'] == 'EU'){
							$cc ='EU';
						}
						else{
							$cc = '<img src=/flags/'.$value['Post']['country'].'.gif>';
						}?>
						
						<td class="center" style="font-size:10px;"><?=$cc;?></td>
						<td class="center" style="font-size:10px;"><?=$value['Post']['find']?></td>
						<td class="center" style="font-size:10px;"><?=$value['Post']['date']?></td>
						<td class="center" style="font-size:10px;"><?=$value['Post']['multi_count']?></td>
						
						<td width="70">
							<?=$this->Html->link($this->Html->image("curl.png", array("alt" => "Запустить")),array('action'=>'/view_order_one/'.$value['Post']['id'].''),array('escape' => false,'class' => 'icon','title'=>'Запустить'))?>			
							<?=$ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts/shlak/'.$value['Post']['id'],array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$value['Post']['id']))?>
						</td>
					</tr>
					
				
					
					
					
					
					
					<? } ?>
				<? } ?>
			</tbody>
		</table>
	
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->prev('« Назад ', " "," ", array('class' => 'disabled'))?></span>
		<span class="btn_simple page_btn fl"><?=$paginator->counter(array('separator'=>' из '))?></span>
		<span class="btn_simple btn_green page_btn fl"><?=$paginator->next(' Дальше »'," "," ", array('class' => 'disabled'))?></span>

		<div class="clear"></div>

		
		<br/><br/>
	</div>
	<!-- STOP CONTENT -->