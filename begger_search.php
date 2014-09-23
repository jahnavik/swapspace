
<?php
include "connect.php";
session_start();
$email= $_SESSION['email_ses'];
$name= $_SESSION['name_ses'];
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>  
  <meta charset="utf-8">
  <title>SwapSpace</title>
  <meta name="description" content="">
  <meta name="author" content="Speed730">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="css/reset.css" media="screen">
  <link rel="stylesheet" href="css/text.css" media="screen">  
  <link href='http://fonts.googleapis.com/css?family=Questrial|PT+Sans:400,700|Muli' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/prettyPhoto.css" media="screen">
  <link rel="stylesheet" href="css/jquery.jqzoom.css" media="screen">
  <link rel="stylesheet" href="css/icons/icons.css" media="screen">  
  <link rel="stylesheet" href="css/custom.css" media="screen">
  <link rel="stylesheet" href="css/responsive.css" media="screen">
  <link rel="stylesheet" href="cus-icons.css" type="text/css"  /> 
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link id="custom-style" rel="stylesheet" href="css/styles/red.css" media="screen">
  <!-- JAVASCRIPT
  ================================================== -->
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery-ui-1.10.3.min.js"></script>
  <script src="js/jquery.flexslider.js"></script>
  <script src="js/idangerous.swiper-1.9.min.js"></script>  
  <script src="js/jquery.sharrre-1.3.4.min.js"></script>  
  <script src="js/kenburns.js"></script>
  <script src="js/twitter/jquery.tweet.js"></script>
  <script src="js/jquery.fitvids.min.js"></script>  
  <script src="js/jquery.jqzoom-core-pack.js"></script>  
  <script src="js/jquery.prettyPopin.js"></script>  
  <script src="js/jquery.prettyPhoto.js"></script>  
  <script src="js/custom.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>


  <!--[if lt IE 9]>

    


    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <link rel="stylesheet" href="css/font-awesome-ie7.css">
  <![endif]-->  
</head>
<body>


<ul>
<?php

include "connect.php";

//input search string
//$input="first second ball";
$input="dota buf second";


//breaking the search string into separate words
$tagvals=explode(" ", $input);
$tagvals=array_unique($tagvals);
$num=count($tagvals);

$alltags=array();

// finding tags which are similar to words in the search string and putting them into an array
//echo "phase 1";
//echo "<br>";
for($i=0;$i<$num;$i++)
{
	$name=$tagvals[$i];
	$qry = mysql_query("SELECT tagname from tags where tagname like '%$name%'");
	while($row = mysql_fetch_row($qry))
	{
		//here
		//echo "finding tags:";
		//echo $row[0];
		//echo " ";
		array_push($alltags, $row[0]);
	}
}

// iterating over all the tags that have been obtained and obtaining items that have those tags one by one for each tag
// in the alltags array. Then every item obtained for each tag is added with the logged in users email id to the srchtbl
// with a count and then that count is incremented.
//echo "phase 2";
//echo "<br>";
$numvals=count($alltags);
for($i=0;$i<$numvals;$i++)
{
	$nm=$alltags[$i];
	//echo "tag:";
	//echo $nm;
	//echo "<br>";
	$qry=mysql_query("SELECT item from stash where item like '%$nm%'");

	//get email for the user who is logged in
	//$email="jahnavi10032@iiitd.ac.in";

	while($row = mysql_fetch_row($qry))
	{
		$itm=$row[0];
		//echo "item obtained:";
		//echo $row[0];
		//echo "||||";
		$check= mysql_query("SELECT item from srchtbl where item='$itm' and email='$email'");
		$array = mysql_fetch_array($check);
		if($array[0]!=$itm)
		{
			$num=1;
			//echo "if:";
			//echo $name;
			//echo " ";
			mysql_query("INSERT into srchtbl(item,email,cnt) VALUES ('$itm','$email','$num')");
		}
		else 	// this part is not working
		{
			//echo "else:";
			//echo $name;
			//echo " ";
			mysql_query("UPDATE srchtbl SET cnt=cnt+1 WHERE item='$itm' and email='$email'");
		}
	}
	//echo "<br>";
}

//get email for the user who is logged in
//$email="jahnavi10032@iiitd.ac.in";

//sorting srchtbl in descending order according to count for the email id of the logged in user
//echo "phase 3";
//echo "<br>";
$qry=mysql_query("SELECT item from srchtbl where email='$email' ORDER BY cnt DESC");
while($row = mysql_fetch_row($qry))
	{
		$itm=$row[0];
		//echo $itm;
		//echo "<br>";
		$new=mysql_query("SELECT email,item,category,upload from stash where item='$itm'");
		$inrow=mysql_fetch_row($new);
		$f1=$inrow[0];
		$f2=$inrow[1];
		$f3=$inrow[2];
		$f4=$inrow[3];
		//echo $f2,$f1,$f3,$f4; 
		echo "<li><a href=\"#\"><i class=\"cus-tag-red\"></i>  $f2,($f1),$f3,$f4 </a></li>"; 
	}

//remove the results searched by the logged in user
$qry=mysql_query("DELETE from srchtbl where email='$email'");
?>

</ul>



</body>
</html>