<?php
$inject = $data;

//echo "<pre>";
//print_r($inject);
//echo "</pre>";

$ttttable = @$table;

$fieldddd = @$field;




if(!empty($inject['emails']))
{
	
			$post_id = $inject['posts_one']['id'];
			echo "<a href='/posts/shlak_filed/$post_id'>Удалить найденные мыла из кэша</a>";


			foreach ($inject['emails'] as $email)
			{
		
				echo '<div id="'.$email.'">';
			
				print_r( $email);

				echo'</div>';
		
			}
			
}else
{
	echo 'Нету emails походу';
}
			
			
			
?>