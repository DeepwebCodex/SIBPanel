
<div id="content">
<ul class="page-nav fl">
			
			
		<li class="active">Домены ГДЕ НЕ НАШЛО НИЧЕГО ИНТЕРЕСНОГО</li>
			
			
</ul>
<div class="clear"></div>		
<?php

$i = 0;
 echo "<br>";
 echo "<br>";

 echo " ||". $html->link(' id ',array('action'=>'order_domens_bad/id'));
 echo " ||". $html->link(' date ',array('action'=>'order_domens_bad/date'));

 echo "<br>";
 echo "<br>";



echo '<table class="table no-nowrap" border="1">';

echo " 
<thead>
<TH class='center' style='font-weight:700'>DOMEN_NEW</TH>
<TH class='center' style='font-weight:700'>STATUS</TH>
<TH class='center' style='font-weight:700'>HTTP</TH>
<TH class='center' style='font-weight:700'>PR</TH>
<TH class='center' style='font-weight:700'>ALEXA</TH>
<TH class='center' style='font-weight:700'>COUNTRY</TH>
<TH class='center' style='font-weight:700'>CHECK</TH>
<TH class='center' style='font-weight:700'>DATE</TH>
<TH class='center' style='font-weight:700'>ACT</TH>
<thead>";

$i = 1;



foreach($data as $key =>$d):

	


//echo '<br>';
			
			$date =  	 	 $d['date'][0];
			$domen =  	 	 $d['domen'][0];
			$domen_new =  	 $d['domen'][0];
			$url =  	 	 $d['url'][0];
			$status = 	 	 $d['status'][0];
			$http =   		 $d['http'][0];
			$date =  	 	 $d['date'][0];
			$get_type =  	 $d['get_type'][0];
			$id =   		 $d['id'][0];
			$pr =   		 $d['pr'][0];
			$alexa =   		 $d['alexa'][0];
			$country =   	 $d['country'][0];
			
			
			$links_domen =  $d['links_domen'];


	
	
	echo "<tbody>";
	
	
	if($color =='white')
	{
		echo '<tr style="background-color:white; color:black;" id="data'.$id.'">';
		
	}elseif($color =='CCCC00'){
		
		echo '<tr style="background-color:#CCCC00;color:black;" id="data'.$id.'">';
	}elseif($color =='CC0099'){
		
		echo '<tr style="background-color:#CC0099; color:black;" id="data'.$id.'">';
	}else
	{
		echo '<tr style="background-color:white; color:black;" id="data'.$id.'">';
	}
	
	
	
	
	//echo "<tr style=''>";
	
	//echo "<td>{$domen}</td>";
	
	if(count($links_domen)>0)
		{
			$cc = count($links_domen);
			
	echo "<td>{$domen_new} <span style='color:blue;font-weight:700'>({$cc})</span><a href=\"#\" onclick=\"ShowDiv({$id}); return false\">Открыть/</a><a href=\"#\" onclick=\"ShowDiv2({$id}); return false\">Закрыть</a> <a target='_blank' href=\"{$url}\"></a></td>";
	//echo "<td>{$domen} <span style='color:blue;font-weight:700'>({$cc})</span><a href=\"#\" onclick=\"ShowDiv(); return false\">Открыть/</a></td>";
	
		}else
		{
			echo "<td>{$domen_new} </td>";
			
			
		}
	
	echo "<td>{$status}</td>";
	echo "<td>{$http}</td>";
	echo "<td>{$pr}</td>";
	echo "<td>{$alexa}</td>";
	echo "<td>{$country}</td>";
	
	
	echo "<td style='width:100px;'>{$url}</td>";
	echo "<td>{$date}</td>";
	

	
	 echo '<td width="40">'.$ajax->link("DEL", '/posts/shlak_domen_bad/'.$id,array('class'=>'icon','title'=>'Переместить в шлак','escape' => false));
	
	
	
	
	 echo "</td>";
	

	
	echo "</tr>";
	
		
			if(count($links_domen)>0)
				{	
				
				
					
					echo "<td id='divId{$id}' colspan='12'><table class='table2 no-nowrap' border='1'   >";
					
					
					echo '
				<th class="center" style="width:6px;">ПОТЕНЦИАЛЬНЫЕ</th>
				<th class="center" style="width:6px;">HEADER</th>
				<th class="center" style="width:6px;">HTTP</th>
				<th class="center"style="width:100px;">FIND</th>';
					
					
					
					
				
					foreach($links_domen as $ku=>$one)
					{
						
						$id2 = $one['posts_all']['id'];
	
						
						
					
						
						
						echo "<tr>";
						
						$url = $one['posts_all']['url'];
						
						$url2  = substr($url, 0,65);
						$head = $one['posts_all']['http'];
						
						echo "<td><a target='_blank' href='$head{$url}'>$url2>"; 

						echo "<span style='color:blue;font-weight:700'>						>>></a></span></td>";
						
						
						
						if($one['posts_all']['header']=='post'){
							
							if($one['posts_all']['status']==3){
								
								echo "<td><span style='color:red;font-weight:800'>	{$one['posts_all']['header']} 100%</span></td>";
							}else{
								echo "<td><span style='color:blue;font-weight:600'>	{$one['posts_all']['header']}</span></td>";
								
							}
							
						}else{
							if($one['posts_all']['status']==3){
								echo "<td><span style='color:red;font-weight:800'>	{$one['posts_all']['header']} 100%</span></td>";
							}else{
								echo "<td>	{$one['posts_all']['header']}</td>";
								
							}
						}
						
						echo "<td>{$one['posts_all']['http']}</td>";
						echo "<td>{$one['posts_all']['find']}</td>";
						
						
						echo "<td>";
							echo $this->Html->link($this->Html->image("curl.png", array("alt" => "Запустить")),array('action'=>'/view_order_one/'.$id2.'/posts_all'),array('escape' => false,'class' => 'icon','title'=>'Запустить'));
							echo $ajax->link($this->Html->image("delete.png", array("alt" => "Переместить в шлак")), '/posts/shlakk_domen_links/'.$id2,array('class'=>'icon','title'=>'Переместить в шлак','escape' => false,'update'=>'data'.$value['Post']['id']));
						
						echo "</td>";
					
					}
					
					echo "</table></td>";
				}
				
	
	
	echo "</tr></tbody>";
	
	
$i++;
endforeach;

echo '</table>';
?>
</div>


