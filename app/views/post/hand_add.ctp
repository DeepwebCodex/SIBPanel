	<!-- START CONTENT -->
	<div id="content">
		<ul class="page-nav fl">
			<li><?=$html->link('Ручной анализ',array('action'=>'hand_dumper')); ?></li>
			<li  class="active"><?=$html->link('Добавление сайта в ручной анализ',array('action'=>'hand_add')); ?></li>
			
		</ul>
		<div class="clear"></div>
	
	

		
		
		
		<div class="clear"></div>
		<?	
		if(count($starts3_one)!==0)
		{
			echo '<br><h2 class="center" style="font-size:18px">Добавьте линк для ручного анализа с вашими данными</h2><br>';?>
				<table>
					
					
				<? echo "<FORM ACTION='/posts/hand_add/' METHOD='POST'>";?>
				
			<label> Линк для взлома (если GET то полный url, если POST HEAD то url страницы без параметров)<br>
				 <? echo "<input type='text' size='115' name='limit' value='".$work3['multis_one']['lastlimit']."'>"; ?>
			</label>		

			
				<br><br>
			<label> POST данные:
				<? echo "<input type='text' size='100' name='dok' value='".$work3['multis_one']['dok']."'>"; ?>
			</label>	
				<br><br>		
			

			<label> Тип БД:
			
			<?	echo "<select name='typedb'>";
				echo "<option value='1'>MSSQL</option>";
				echo "<option value='2' selected>MYSQL</option>";
			
				echo "</select><br><br>";			
						
			?>			
			</label>				
				<br><br>	

			<label> Тип запроса:	
				
			<?	echo "<select name='typeheader'>";
				echo "<option value='1'>GET</option>";
				echo "<option value='2' selected>POST</option>";
				echo "<option value='3' >COOKIES</option>";
				echo "</select><br><br>";
			?>	
				
			</label>		
			<?	
				echo "<input type='hidden' name='id3' value='".$work3['multis_one']['id']."'>";
				echo "<td><input type='hidden' name='filed_id' value='".$work3['multis_one']['filed_id']."'>";
				echo "<input type='hidden' name='pid' value='".$work3['multis_one']['pid']."'>";
				echo "<input type='submit' name='update33' value='update'>";
				echo "";
				echo '</FORM>';
				
				$time = time();
			?>
			
			
			
		<? } ?>
		
		
	</div>
	<!-- STOP CONTENT -->
		
		
		
		

