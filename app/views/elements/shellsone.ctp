<?php
$inject = $data;

//echo "<pre>";
//print_r($inject);
//echo "</pre>";

$ttttable = @$table;

$fieldddd = @$field;




if(!empty($inject['shells']))
{
	
			$post_id = $inject['posts_one']['id'];
			echo "<a href='/posts/shlak_filed21/$post_id'>Удалить залитый шелл из кеша</a>";


			
				echo '<div id="'.$email.'">';
			
				print_r( $shells);

				echo'</div>';
		
			
			
}else
{
	echo 'Неполучается залить походу';
}
			
			
			
?>