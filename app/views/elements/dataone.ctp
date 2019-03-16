<?php
$inject = $data;

$ttttable = @$table;

$fieldddd = @$field;
$post_id = $inject['posts_one']['id'];
if(!empty($inject['bds']))
{echo "<a href='/posts/shlak_bds/$post_id'>Удалить найденные базы из кэша</a><br>";
			foreach ($inject['bds'] as $count=> $bd)
			{
			
				if(isset($inject['tables'][$bd]))
				{
				?>
				<div>
		
				 <div style="margin-right:4px;float:left;cursor:pointer;" onClick="ShowOpenMenu('<?php echo $bd;?>'); return false;" id="plus_<?php echo $bd;?>">+</div>
				 
				 <div style="float:left;cursor:pointer;display:none" class="onetab_ww" onClick="ShowCheckMinus('<?php echo $bd;?>'); return false;" id="minus_<?php echo $bd;?>">-</div>
			
				<?php
				}
					
					$count2 = $bd;
					
					$bd = $count;
					
					
					
					//$count2 = "<span style='color:red; font-size:13px;font-weight:700;'>".$count."</span>";	
					$count2_2 = "<span style='color:red; font-size:13px;font-weight:700;'>".$count2."</span>";	
				


				
					
				echo $ajax->link($count."($count2_2)", 'getTables_one/'.$bd,array('indicator'=>'work','escape' => false,'update'=>'bds','style'=>"color:black")).'<br/>
				<div id="'.$bd.'">';
			
				if(!empty($inject['tables'][$bd]))
				{

				
					foreach ($inject['tables'][$bd] as $table)
					{
					
						if(empty($table))continue;
					
						
						echo '<div style="margin-left:5px;padding-right:5px">';
						echo $ajax->link($table, 'getField_one/'.$bd.'/'.$table,array('style'=>'color:red','indicator'=>'work','escape' => false,'update'=>'bds'));
						
						if(isset($inject['field'][$bd][$table]))
						{
							
							echo '<div style="margin-left:5px;padding-right:5px">'; 
							
							foreach ($inject['field'][$bd][$table] as $field)
							{
							
								$ch = false;
								
								if($ttttable==$bd.'.'.$table AND strstr($fieldddd, $field))
								{	
									$ch = 1;	
								}
								
								//print_r($bd.$table.$field);
								
								echo $form->checkbox($field,array('checked'=>$ch,'id'=>$bd.$table.$field)).' '.$field.'<br>';

								echo $ajax->observeField($bd.$table.$field,    array('url' => array( 'action' => 'chengetable_one/'.$bd.'/'.$table.'/'.$field),'frequency' => 0.2,'update'=>'field'));
								
								
							}
							
							echo '</div>'; 
						}
						
						echo '</div>';
		
					}
				
				}else
				{
					//echo 'таблиц нет или не выбраны';
				}

				echo'</div>
				</div>';
			}
			
}else
{
	echo 'Не могу получить БД';
}
			
			
			
?>