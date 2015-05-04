<?php 
//$link = mysql_connect('hostname','dbuser','dbpassword'); 
$link = mysql_connect('localhost','optimus','m1payne2');
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
echo 'Connection OK'; mysql_close($link); 
?> 