<?php
include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];

$product = $_POST['product'];
$category = $_POST['option'];

if(!isset($_POST['add']))
{
	//echo "Please Fill the form";
	header("Location: wishlist.php");	
}
else
{
    // echo "WE ARE HERE!!!!";
	mysql_query("INSERT into wishlist(email,item,category) VALUES ('$email','$product','$category')");

	//increase count of items category
	//echo $category;
	mysql_query("UPDATE categories SET cnt=cnt+1 WHERE catnm='$category'");

	//add tags for item to tags table
	$tagval=explode(" ", $product);
	$tagvals=array_unique($tagvals);
	$numvals = count($tagval);
	//$countt="count";
	//$num=1;
	//echo "starting 1";
	//mysql_query("INSERT into tags(tagname,count) VALUES ('$tagval[0]','$num')");
	for ($i = 0; $i < $numvals; $i++)
	{
		$name=$tagval[$i];
		//echo "name:";
		//echo $name;
		//echo " ";
		$check = mysql_query("SELECT tagname from tags where tagname='$name'");
		$num=1;
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

	//add to feed table
	$typ="wishlist";
	//echo $typ,$email,$product,$location,$category;
	mysql_query("INSERT into feed(type,user1,item1,loc1,category1) VALUES ('$typ','$email','$product','$location','$category')");

//	echo "Added!";
	header("Location: wishlist.php");
}
?>