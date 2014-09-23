<?php
include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];


if (isset($_POST["upload"]))
{
	if (isset($_SESSION["name"]))
	{
		$name = $_FILES["file"]["name"];
		$type = $_FILES["file"]["type"];
		$size = $_FILES["file"]["size"];
		$tmp_name = $_FILES["file"]["tmp_name"];
		$error = $_FILES["file"]["error"];
		$id = $_POST['id'];
		//$email = "jahnavi10032@iiitd.ac.in";
		$product = $_POST['product'];
		$category = $_POST['option'];
		
		if ($type== "image/gif" || $type== "image/png" || $type== "image/jpeg" || $type== "image/jpg")
		{
			if($error > 0)
			{
	//			echo "Error!".$error;
				header("location: stash.php");
			}
			else
			{  
				$location = "upload/".$name;
				
				if (file_exists("upload/".$name))
				{
					//echo $name." already exists";
					unlink($location);
				}
				
				move_uploaded_file($tmp_name,$location);
				$user = $_SESSION["name"];
				$sqlcode = mysql_query("INSERT INTO stash (id,email,item,category,upload) VALUES ('$id','$email','$product','$category','$location') ");
				
				//increase count of items category
				//echo $category;
				mysql_query("UPDATE categories SET cnt=cnt+1 WHERE catnm='$category'");

				//add tags for item to tags table
				$tagval=explode(" ", $product);
				$tagval=array_unique($tagval);
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
				$typ="stash";
				//echo $typ,$email,$product,$location,$category;
				mysql_query("INSERT into feed(type,user1,item1,loc1,category1) VALUES ('$typ','$email','$product','$location','$category')");


				//echo "<a href='$location'>Click here to view the file.</a>";
				header("location:stash.php");
				//header("location:read_ta.php?file='$name'");
			}
		}
	
		else
		{
		//	echo "Error1";	
			header("location:stash.php");
		}
	
	}
	else
	{
		//	echo "Error2";	
			header("location:stash.php");
	}
	}
else
{
	echo "<a href='stash.php'>";
}
?>