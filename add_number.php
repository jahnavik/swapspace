<?php

include "connect.php";

session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];

$phone = $_POST['phone'];

if(!isset($_POST['add']))
{
	//echo "Please Fill the form";
	header("Location: account.php");	
}
else
{
	$q="SELECT * FROM details WHERE email='$email'";
	$r=mysql_query($q);
	$num=mysql_numrows($r);
	if ($num==0)
	{
		mysql_query("INSERT INTO details (email,phone) VALUES ('$email','$phone')");
		//echo "HERE";
	}
	
	else 
	{
		mysql_query("UPDATE details SET phone='$phone' WHERE email='$email'");
		//echo "HERE 2";
	}
		//	echo "Added!";
	header("Location: account.php");
}
?>