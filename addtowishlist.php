<?php

include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];

$product = $_POST['item'];
$category = $_POST['category'];

if(!isset($_POST['add']))
{
	//echo "Please Fill the form";
	header("Location: home.php");	
}
else
{
    //echo "WE ARE HERE!!!!";
	mysql_query("INSERT into wishlist(email,item,category) VALUES ('$email','$product','$category')");
	//echo "WE ARE HERE!!!!";
	header("Location: wishlist.php");
}
?>