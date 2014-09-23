<?php
include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];

$item=$_POST['d1'];
if(!isset($_POST['del']))
{
//	echo "Please Fill the form";
	header("Location: wishlist.php");	
}
else
{
	//echo "jerk";
	// decrement category value
	$check = mysql_query("SELECT category from wishlist where item='$item'");
	$itmnm=mysql_fetch_array($check);
	$reqcat=$itmnm[0];
	echo $reqcat;
	mysql_query("UPDATE categories SET cnt=cnt-1 WHERE catnm='$reqcat'");


	//decrement tag counts for original product tags before modifying them and updating the tags list with new product names
	$check = mysql_query("SELECT item from wishlist where item='$item'");
	$itmnm=mysql_fetch_array($check);
	//echo "old name:";
	//echo $itmnm[0];
	//echo " ";
	$tagvals=explode(" ", $itmnm[0]);
	$tagvals=array_unique($tagvals);
	$numvals = count($tagvals);
	for ($i = 0; $i < $numvals; $i++)
	{
		$name=$tagvals[$i];
		//echo "oldtags:";
		//echo $name;
		//echo " ";
		mysql_query("UPDATE tags SET countt=countt-1 WHERE tagname='$name'");
	}
	//remove tags with count 0
	mysql_query("DELETE from tags where countt=0");



	mysql_query("DELETE from wishlist WHERE item='$item'");


	//delete from feed
	$typ="wishlist";
	mysql_query("DELETE from feed WHERE item1='$item' and type='$typ'");

//	echo "CS";
	header("location: wishlist.php");
}
?>