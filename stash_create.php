<?php

include "connect.php";

$email = "jahnavi10032@iiitd.ac.in";
$product = $_POST['product'];
$category = $_POST['option'];

if(!isset($_POST['add']))
{
	//echo "Please Fill the form";
	header("Location: stash.php");	
}
else
{
   // echo "WE ARE HERE!!!!";
	mysql_query("INSERT into stash(email,item,category) VALUES ('$email','$product','$category')");
//	echo "Added!";
	header("Location: stash.php");
}
?>