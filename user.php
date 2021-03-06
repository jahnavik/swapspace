<?php
include "connect.php";
session_start();
$emails= $_SESSION['email_ses'];
$names= $_SESSION['name_ses'];

if(isset($_GET['user']))
{
	$user=$_GET['user'];
}
				
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

  <?php
	
		$tbl_name="google_users";
		$query="SELECT * FROM $tbl_name WHERE google_email='$user'";
		$result=mysql_query($query);
//	$num=mysql_numrows($result);
		$name=mysql_result($result,0,"google_name");
//	$email=mysql_result($result,0,"google_email");
		$pic=mysql_result($result,0,"google_picture_link");
		$ph=0;
		$query1="SELECT * FROM details WHERE email='$user'";
		$result1=mysql_query($query1);
		$n=mysql_numrows($result1);
		if ($n!=0)
			$ph=mysql_result($result1,0,"phone");
	  ?> 
  
  <div id="wrapper">    
  <header>
    <div class="container_12 header-inner relatived">
      <div id="logo" class="grid_3">
        <a href="index.php"><img src="images/logo_1.jpg" alt="olympia-logo" /></a>
      </div>    
      
      <nav class="grid_8 right omega">
        <ul class="primary-nav">
          <span aria-hidden="true" data-icon="&#6600;" class="home"></span>
            <li><a href="home.php">Hi <?php echo $names; ?> !</a></li>
            <li><a  href="index.php">Log Out <i class="icomoon" aria-hidden="true" data-icon="&#xe014;"></i></a></li>  
          </ul>          
        </nav>
    </div><!-- container_12 -->
  </header>
	
    <div id="main-container" class="account-page">
      <div class="page-top-leader omega">
        <div class="container_12 relatived clearfix">
          <h1 class="page-title">My Account</h1>
            <div class="breadcrumb">
              <span class="br_before">You are in:</span>
                <a href="home.php">Home</a>        
              <span class="br_sep">/</span>
            <span class="cur_link">My Account</span>
          </div>
        </div>
      </div><!-- .page-top-leader -->      
      
  <div  class="container_12">
    <div style="margin-top: -30px;" class="grid_10 aside-container">        
        <!-- my account content -->
      <div class="content ">
          <h3>My Account</h3>
            <ul class="list">
              <li><a href="#"><b>Name</b> : <?php echo $name; ?></a></li>
              <li><a href="#"><b>Phone Number</b> : <?php if ($ph!=0) echo $ph; else echo "NA"; ?> &nbsp;</a>
              </li>  
              <li><a href="#"><b>Email Address</b> : <?php echo $user; ?></a></li>
            </ul>
      </div>  
		
      <div class="content">
          <h3>My Wishlist  <a href="wishlist.php"><i style="float: right; "class="icomoon edit-tab" aria-hidden="true" title="Edit Wishlist" data-icon="&#x2199;"></i></a></h3>
            <?php
		          $wishlist="wishlist";
		          $query1="SELECT * FROM $wishlist WHERE email='$user'";
		          $result1=mysql_query($query1);
		          $num=mysql_numrows($result1);
		          if($num==0)
                {
                  //echo"<img src=\"images/wishlamp.jpg\">";
                  echo "There are no items in your wish list. Go make a wish!";
                }
              else 
              {
		          $i=0;
		          while ($i<$num)
		            {
			             $item=mysql_result($result1,$i,"item");
            ?>
          <ul class="list">
            <li><a href="#"><?php echo $item; ?></a></li>
		        <?php
		           $i++;
		          }
            }
	         	?>
          </ul>
      </div> 
		
		
          
      <div class="content">
        <h3>My Stash  <a href="stash.php"><i style="float: right;" class="icomoon edit-tab" aria-hidden="true" title= "Edit Stash" data-icon="&#x2199;"></i></a></h3>
          <?php
		        $stash="stash";
		        $query2="SELECT * FROM $stash WHERE email='$user'";
		        $result2=mysql_query($query2);
		        $num1=mysql_numrows($result2);
             if($num1==0)
                {
                 // echo"<img src=\"images/emptychest.jpg\">";
                  echo "<br> There are no items in your stash. Tell us what you have.!";
                }
              else {
		        $j=0;
		        while ($j<$num1)
		        {
		          $item1=mysql_result($result2,$j,"item");
          ?>   
        
        <ul class="list">
          <li><a href="#"><?php echo $item1; ?></a></li>
		        <?php
			         $j++;
			         } }
		        ?>
          </ul>
        </div>      
      </div>
      
      <div  style="margin-left: 50px;" id="column-left"  class="grid_3 omega"> 
        <img height= "120" width="120" style=" border: 1px solid gainsboro; -webkit-border-radius: 100px; -moz-border-radius: 100px; border-radius: 100px;" src=" <?php echo $pic; ?>">
        <br><br>
        <div class="box">
          <div class="box-heading"><h4>My Account</h4></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
                <li><a href="home.php"><i class="cus-house"></i>&nbsp; Home</a></li>                
                <li><a class="active" href="account.php"><i class="cus-report-user"></i>&nbsp; My Account</a></li>
                <li><a href="wishlist.php"><i class="cus-cart-add"></i>&nbsp; My Wish List</a></li>                
                <li><a href="stash.php"><i class="cus-box"></i>&nbsp; My Stash</a></li>
               
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--end #column-left -->  

    </div><!-- end .container_12 -->
     
    <footer>
      <span class="style-border"></span>
      <div class="container_12">
        <div class="grid_14 widget-box">
          <div class="box-heading">
              <h4>Contact Us</h4>
          </div>
        <ul class="contact-info">
            <li><i class="icomoon" aria-hidden="true" data-icon="&#x25df;"></i><span>+91-8130201142 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></li>
            <li><i class="icomoon" aria-hidden="true" data-icon="&#x21b4;"></i><span>akanksha10008@iiitd.ac.in &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></li>
            <li><i class="icomoon" aria-hidden="true" data-icon="&#xe007;"></i><span>IIIT-Delhi &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></li>

        
       </ul>
        </div>
       
      </div><!-- end .container_12 -->
    </footer>
  </div><!-- end #wrapper This wrapper cover all the website-->  
  <script src="js/classie.js"></script>
    <script src="js/modalEffects.js"></script>

    <!-- for the blur effect -->
    <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
    <script>
      // this is important for IEs
      var polyfilter_scriptpath = '/js/';
    </script>
    <script src="js/cssParser.js"></script>
    <script src="js/css-filters-polyfill.js"></script>
</body>
</html>