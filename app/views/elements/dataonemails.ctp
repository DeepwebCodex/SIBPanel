<?php
$inject = $data;

$ttttable = @$table;


echo " <div style='clear: both'></div>";


echo 'ВЫБИРАЙТЕ ВСЕГДА ПЕРВОЙ КОЛОНКОЙ EMAIL (КОЛОНКА ГДЕ ЕСТЬ МЫЛА MAIL USER_EMAIL  И Т.П.) !!!!!!!!!!!!!!!!!!';



$fieldddd = @$field;
$post_id = $inject['posts_one']['id'];
if(!empty($inject['bds']))
{

$bd = $inject['bds'];
			
$table = 	 $inject['table'];	
				
				?>
				<div>
		
				 <div style="margin-right:4px;float:left;cursor:pointer;" onClick="ShowOpenMenu('<?php echo $bd;?>'); return false;" id="plus_<?php echo $bd;?>">+</div>
				 
				 <div style="float:left;cursor:pointer;display:none" class="onetab_ww" onClick="ShowCheckMinus('<?php echo $bd;?>'); return false;" id="minus_<?php echo $bd;?>">-</div>
			
				<?php
				
					
				$count2 = "<span style='color:red; font-size:13px;font-weight:700;'>".$count."</span>";	
				echo $ajax->link($bd, 'getTables_one/'.$bd,array('indicator'=>'work','escape' => false,'update'=>'bds','style'=>"color:black")).'<br/>
				<div id="'.$bd.'">';
			
				if(!empty($inject['field'][$bd]))
				{

				
				
			
					
						//if(empty($table))continue;
					
						
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
								$bd = str_replace('//','',$bd);
								$table = str_replace('//','',$table);
								$field = str_replace('//','',$field);
								echo $ajax->observeField($bd.$table.$field,    array('url' => array( 'action' => 'chengetable_one_mails/'.$bd.'/'.$table.'/'.$field.'/'),'frequency' => 0.2,'update'=>'field'));
								
								
							}
							
							echo '</div>'; 
						}
						
						echo '</div>';
		
					
				
				}else
				{
					//echo 'таблиц нет или не выбраны';
				}

				echo'</div>
				</div>';
			
			
}else
{
	echo 'Не могу получить БД';
}
			
			
			
?>

<td width="70%" class="va-top">
						<?=$ajax->remoteTimer(array('url' => array( 'controller' => 'posts', 'action' => 'viewdata_one'),'update' => 'datacool',false,'frequency' => 2))?>
						<div id="field">
							<?php 
							echo $this->element('fieldone_mails');
							?>
						</div>
						<div id="cont"></div>
					</td>
					
					
					
		<?=$ajax->link('|Сдампить|', 'getdump_one',array('class'=>'btn btn_red','indicator'=>'work','escape' => false,'update'=>'cont'))?>				