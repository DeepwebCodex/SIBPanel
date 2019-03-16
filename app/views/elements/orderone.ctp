<?php
$inject = $data;


///print_r($data);

$ttttable = @$table;

$fieldddd = @$field;

if(!empty($inject['orders']))
{
	
		$post_id = $inject['posts_one']['id'];
			echo "<a href='/posts/shlak_card_one/$post_id'>Удалить найденные карт из кэша</a><br>";
			foreach ($inject['orders'] as $order)
			{
		
				echo '<div id="'.$order.'">';
			
				print_r($order);

				echo'</div>';
		
			}
			
}else
{
	echo 'Нету orders  походу';
}
			
			
			
?>