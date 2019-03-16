<?php
$filename = "stop.txt";
$fh = fopen($filename, "a+");
fwrite($fh, "stop");
fclose($fh);
?>