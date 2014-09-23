<?php

$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'swapspace'; //Database Name

$connect = mysql_connect($hostname, $db_username, $db_password) or die("Could not connect to MySql");
mysql_select_db($db_name) or die("No Database");


?>