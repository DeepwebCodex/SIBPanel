<?php
$inject = $data;
			
$ttttable = @$table;
$fieldddd = @$field;

if(!empty($inject['bds'])){
			foreach ($inject['bds'] as $bd){
		
				if(isset($inject['tables'][$bd])){
				?>
		<div>
		
			 <div style="margin-right:4px;float:left;cursor:pointer;" onClick="ShowOpenMenu('<?php echo $bd;?>'); return false;" id="plus_<?php echo $bd;?>">+</div>
			 <div style="float:left;cursor:pointer;display:none" class="onetab_ww" onClick="ShowCheckMinus('<?php echo $bd;?>'); return false;" id="minus_<?php echo $bd;?>">—</div>
		
			<?php
				}
				
			echo $ajax->link($bd, 'getTables/'.$bd,array('indicator'=>'work','escape' => false,'update'=>'bds')).'<br/>
			<div id="'.$bd.'">';
			
			if(!empty($inject['tables'][$bd]))
			{

			//	$ch = 0;
			
					foreach ($inject['tables'][$bd] as $table){
					
						if(empty($table))continue;
					
						//echo $table.'<br>';
					
						echo '<div style="margin-left:5px;padding-right:5px">';
						echo $ajax->link($table, 'getField/'.$bd.'/'.$table,array('style'=>'color:red','indicator'=>'work','escape' => false,'update'=>'bds'));
						
						if(isset($inject['field'][$bd][$table])){
							//print_r($inject['field'][$bd][$table]);
							echo '<div style="margin-left:5px;padding-right:5px">'; 
							foreach ($inject['field'][$bd][$table] as $field){
							
								$ch = false;
								
								if($ttttable==$bd.'.'.$table AND strstr($fieldddd, $field)){

									//echo '1';
									$ch = 1;
									
								}
								
								echo $form->checkbox($field,array('checked'=>$ch,'id'=>$bd.$table.$field)).' '.$field.'<br>';

								echo $ajax->observeField($bd.$table.$field,    array('url' => array( 'action' => 'chengetable/'.$bd.'/'.$table.'/'.$field),'frequency' => 0.2,'update'=>'field'));
								
								
							}
							echo '</div>'; 
						}
						
						echo '</div>';
		
					}
				
			}else{
				//echo 'таблиц нет или не выбраны';
			}

			echo'</div>
			</div>';
			//echo $bd.'<br/>';
			}
			
}else{
	echo 'Нет баз данных<br>возможно sqli закрыли';
}
			
			
			
?>