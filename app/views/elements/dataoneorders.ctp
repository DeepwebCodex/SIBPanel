




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
							
							echo '<form action="/posts/getcooldata_one_now" method="POST" target="_blank">';
							
							echo 'SORT';
							echo "<input type='input' name='desc'  value='desc'>";
							
							echo '<br><br>';
							
							
							echo 'СКОЛЬКО ЗАПИСЕЙ ВЫВЕСТИ';
							echo "<input type='input' name='limit'  value='50'>";
							
							
							
							
							//echo "<input type='input' name='do'  value=''>";
							
							echo '<br><br>';
							
							foreach ($inject['field'][$bd][$table] as $field)
							{
							
								$ch = false;
								
								if($ttttable==$bd.'.'.$table AND strstr($fieldddd, $field))
								{	
									$ch = 1;	
								}
								
								//print_r($bd.$table.$field);
								$bd = str_replace('//','',$bd);
								$table = str_replace('//','',$table);
								$field = str_replace('//','',$field);
								
								
								
								echo "<label>".$field." - </label>";
								//echo "<input type='checkbox' name='".$field."'  value='".$bd.'/'.$table.'/'.$field."/'>";
								
								echo "<input type='checkbox' name='check-$field'  value='".$field."'>";
								echo '<br>';
								
								//	echo $form->checkbox($field,array('checked'=>$ch,'id'=>$bd.$table.$field)).' '.$field.'<br>';
								
								//echo $ajax->observeField($bd.$table.$field,    array('url' => array( 'action' => 'chengetable_one_orders/'.$bd.'/'.$table.'/'.$field.'/'),'frequency' => 0.2,'update'=>'field'));
								
								
							}
							
							echo '</div>'; 
						}
						
						echo '<input name="table" type="hidden" value="'.$table.'"></input>';
						
						echo '<input name="bd" type="hidden" value="'.$bd.'"></input>';
						
						echo '<input name="sub" type="submit" value="ПОКАЗАТЬ ПРЯМ СЧАС ВЫВОД ЛЮБЫЕ КОЛОНКИ"></input>';
						
						echo '</form></div>';
						
						
						
						
						
						
						
		
					
				
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


					
					
		