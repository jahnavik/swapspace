<?php
include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];

$id = $_POST['e1'];
$product = $_POST['prod'];
$category = $_POST['opt'];

if(!isset($_POST['edit']))
{
	//echo "Please Fill the form";
	header("Location: wishlist.php");
}
else
{
	
	// decrement old category value, increment new category value, if categories are different
	$check = mysql_query("SELECT item,category from wishlist where id = '$id'");
	$itmnm=mysql_fetch_array($check);
	$reqcat=$itmnm[1];
	$fitm=$itmnm[0];
	echo $reqcat;
	if($reqcat!=$category)
	{
	mysql_query("UPDATE categories SET cnt=cnt-1 WHERE catnm='$reqcat'");
	mysql_query("UPDATE categories SET cnt=cnt+1 WHERE catnm='$category'");
	//update feed category and product
	mysql_query("UPDATE feed SET  category1='$category',item1='$product' where item1='$fitm'");
	}

	//decrement tag counts for original product tags before modifying them and updating the tags list with new product names
	$check = mysql_query("SELECT item from wishlist where id = '$id'");
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

	
	// update wishlist item to new values
	mysql_query("UPDATE wishlist SET item='$product', category='$category' WHERE id = '$id'");
	

	//updating with new tag valuse
	$tagval=explode(" ", $product);
	$tagvals=array_unique($tagvals);
	//echo "product:";
	//echo $product;
	$numvals = count($tagval);
	for ($i = 0; $i < $numvals; $i++)
	{
		$name=$tagval[$i];
		//echo "name:";
		//echo $name;
		//echo " ";
		$check = mysql_query("SELECT tagname from tags where tagname='$name'");
		//echo $check;
		$array = mysql_fetch_array($check);
		//echo "arr:";
		//echo $array[0];
		//echo " ";
		//echo $name;
		//mysql_query("INSERT into tags(tagname,count) VALUES ('$name','$num')");
		if($array[0]!=$name)
		{
			$num=1;
			//echo "if:";
			//echo $name;
			//echo " ";
			mysql_query("INSERT into tags(tagname,countt) VALUES ('$name','$num')");
		}
		else 	// this part is not working
		{
			//echo "else:";
			//echo $name;
			//echo " ";
			mysql_query("UPDATE tags SET countt=countt+1 WHERE tagname='$name'");
		}
	}
	

	//	echo "Added!";
	header("Location: wishlist.php");
}
?>