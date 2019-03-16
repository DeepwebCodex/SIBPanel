<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
		
			
			<li><?=$html->link('txt (мыло пасс)',array('action'=>'download_domens')); ?></li>
			<li><?=$html->link('txt (просто мыла) ',array('action'=>'download_domens2')); ?></li>
			<li class="active"><?=$html->link('txt (ОДИНОЧНЫЙ) ',array('action'=>'download_domens3')); ?></li>
		</ul>

		

		<div class="clear"></div>
		<table class="table no-nowrap">
			<thead>
				<th>Название</th> 
				<th>Дата</th> 
				<th>Размер</th>
				<th>Действие</th>
			</thead>
			<tbody>
<?
	$dir = "./slivdump_one";   //задаём имя директории
	if(is_dir($dir)) {   //проверяем наличие директории
		$files = scandir($dir);    //сканируем (получаем массив файлов)
		array_shift($files); // удаляем из массива '.'
		array_shift($files); // удаляем из массива '..'
		$domain_name = ""; // Для сохранения доменного имени

		if(count($files)>0)
		{

			if(!isset($_GET['name']))
			{
				for($i=0; $i < sizeof($files); $i++)
				{
					preg_match("/([a-z0-9\-\.]*)\.([a-z]{2,})/", $files[$i], $name);
					//if($domain_name != $name[0] AND strpos($name[0],'txt'))
					//{
						$domain_name = $name[0];
						
						// Поиск и подсчет размера
						//$size = 0;
						$size =  filesize("{$dir}/{$files[$i]}");
						$xxx = $size / 1024 / 1024; // тут результат в мегабайтах, без округления
						$result = round($xxx,3);
						//for($num=0; $num < sizeof($files); $num++)
						//echo 123;
							//if(preg_match("/_{$domain_name}_/", $files[$num]))
								//$size = $size + filesize("{$dir}/{$files[$num]}");
								
								
						
						if($size > 10)
						{
							
							$date = date ("d.m.Y H:i:s", filemtime($dir."/".$files[$i]));
							
							echo "<tr>
								<td>{$domain_name}</td>
								<td>{$date}</td>
								<td>{$result} мбайт</td>
								<td><a class='btn btn_green' href='./download_domens3/?name=$domain_name'>Скачать</a></td>
							</tr>";
						}
					//}
				}
			}

		}else
			echo "<tr><td colspan='4' class='center'>Нет файлов</td></tr>";
	}else
		echo "<tr><td colspan='4' class='center'>No directory {$dir}</td></tr>";
?>


			</tbody>
		</table>

	</div>
	<!-- STOP CONTENT -->
