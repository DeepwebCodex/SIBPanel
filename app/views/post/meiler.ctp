	<!-- START CONTENT -->
	<div id="content">

<?php 

//echo '<pre>';
//print_r($data);
//echo '</pre>';

echo '<table class="table no-nowrap" border="1">';

echo "<tbody><tr style='color:black'>";

echo "<FORM ACTION='/posts/meiler/' METHOD='POST'>";

echo "<td><select name='sdate'>";

	foreach($data['sdate'] as $key =>$d)
	{
		$date = $d['mails']['date'];
		
		
		if($date == $data['sdate1']){
			echo "<option selected value='$date'>$date</option>";
		}else {
			echo "<option value='$date'>$date</option>";
		}
		
		
	}

echo "</select>";


echo "<select name='podate'>";
	foreach($data['podate'] as $key =>$d)
	{
		//print_r($d);
		$date = $d['mails']['date'];
		
		if($date == $data['podate1']){
			echo "<option selected value='$date'>$date</option>";
		}else {
			echo "<option value='$date'>$date</option>";
		}
		
	}
	
echo "</select></td>";

//////////////////////////	


echo "<td><select name='type'>";
echo "<option value='countNoHash' >countNoHash</option>";
echo "<option value='countHash'>countHash</option>";
echo "<option value='countPass'>countPass</option>";
echo "<option value='countMail' selected>countMail</option>";
echo "</select></td></tr>";

echo "<tr style='color:black'>";
echo "<td><input type='text' name='domen' value=''>";
echo "<label for=\"domen\">Почтовик</label></td>";
echo "<td><input type='submit' name='down' value='donwload'></td>";
echo '</tr>';


echo "<tr style='color:black'>";
echo "<td><input type='text' name='zona' value=''>";
echo "<label for=\"zona\">Зона</label></td>";
echo "<td><input type='submit' name='down2' value='donwload'></td>";
echo '</tr>';


echo "<tr style='color:black'>";
echo "<td><select name='site'>";
echo "<option value=''></option>";
	foreach($data['domens'] as $key =>$d)
	{
		$domen = $d['renders']['domen'];
		
		echo "<option value='$domen'>$domen</option>";
		
	}
echo "</select></td>";

echo "<td><input type='submit' name='onedomen' value='download'></td>";
echo '</tr>';
echo "</table>";
?>
</div>
