	<!-- START CONTENT -->
	<div id="content">
	
	<!--<span class="btn_simple page_btn fr">Сортировать:</span>-->

		<div class="clear"></div>

		<table class="table no-nowrap" width='90%'>
			<thead>
				<th class="center" style="width:100px;">domen</th>
				<th class="center">filed_id</th>
				<th class="center">post_id</th>
				<th class="center">lastlimit</th>
				<th class="center">count</th>
				<th class="center" >get</th>
				<th class="center" >potok</th>
				<th class="center" >function</th>
				<th class="center" >prich</th>
				<th class="center">isp</th>
				<th class="center" >dok</th>
				<th class="center" >date</th>
			</thead>
			<tbody>
			
				
			<?php //print_r($data);?>
				<? if(count($data)==0){ ?>
					<tr>
						<td colspan="4" class="center">Нет строк для отображения</td>
					</tr>
				<? }else{ ?>
					<? foreach ($data as $value){ 
					
					
						echo '<tr id="data'.$value['multis']['id'].'">';
					?>
					
						<td  class="center" style="font-size:10px;"> <div style="word-wrap: break-word;width: 150px;" class="red"><?=$value['multis']['domen'];?></div></td>
						
						<td class="center" style="font-size:10px;"><?=$value['multis']['filed_id']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['post_id']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['lastlimit']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['count']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['get']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['potok']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['function']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['prich'];?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['isp']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['dok']?></td>
						<td class="center" style="font-size:10px;"><?=$value['multis']['date']?></td>
						
					</tr>
					
					
					
					
					<? } ?>
				<? } ?>
			</tbody>
		</table>
		
		<br/><br/>
	</div>
	<!-- STOP CONTENT -->