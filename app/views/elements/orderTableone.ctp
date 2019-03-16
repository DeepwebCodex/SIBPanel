<?php
$inject = $data;


///print_r($data);

$ttttable = @$table;

$fieldddd = @$field;

if(!empty($inject['ordersTable']))
{
	
		$post_id = $inject['posts_one']['id'];
			echo "<a href='/posts/shlak_cardTable_one/$post_id'>Удалить найденные карты(таблицы) из кэша</a><br>";
			foreach ($inject['ordersTable'] as $order)
			{
		
				echo '<div id="'.$order.'">';
			
				print_r($order);

				echo'</div>';
		
			}
			
}else
{
	echo 'Нету ordersTable  походу';
}
			
			
			
?>