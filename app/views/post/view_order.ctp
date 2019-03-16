	<!-- START CONTENT -->
	<div id="content">
	

		<div class="clear"></div>

		<table class="table no-nowrap" width='90%'>
			<thead>
				<th class="center">id</th>
				<th class="center">post_id</th>
				<th class="center">shema</th>
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
						
						<td class="center" style="font-size:10px;"><?=$value['orders']['id']?></td>
						<td class="center" style="font-size:10px;"><?=$value['orders']['post_id']?></td>
						<td class="center" style="font-size:10px;"><?=$value['orders']['shema']?></td>

						
					</tr>
					
					
					
					
					<? } ?>
				<? } ?>
			</tbody>
		</table>
		
		<br/><br/>
	</div>
	<!-- STOP CONTENT -->