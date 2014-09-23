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



  <!--[if lt IE 9]>

    
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <link rel="stylesheet" href="css/font-awesome-ie7.css">
  <![endif]-->  
</head>
<body>
  <div id="wrapper">    
        
  
    <header>      
    <div class="container_12 header-inner relatived">
      <div id="logo" class="grid_3">
        <a href="index.php"><img src="images/logo_1.jpg" alt="olympia-logo" /></a>
      </div>    
     <nav class="grid_8 right omega">
        <div class="mobile-menu-trigger"><span class="icomoon mobile-icon-menu" aria-hidden="true">&#xe008;</span><a class="menu-label">Select a Page</a></div>
          <ul class="primary-nav">
                
                <span aria-hidden="true" data-icon="&#6600;" class="home"></span>
               
            <li><a href="account.php">Hi Dhruv !</a></li>
             <li><a  href="index.php">Log Out <i class="icomoon" aria-hidden="true" data-icon="&#xe014;"></i></a></li>  
           
          </ul>          
        </nav>
      </div><!-- container_12 -->
    </header>
    <div id="main-container">
      
      <div class="container_12 aside-container">
      <div style="margin-top: -30px;" class="grid_9">
       
	    
	   
      <!--   <h2>My Stash (<?php echo $num; ?> items)</h2>
         <a style="margin-top: -42px;" class="md-trigger style-button right"  class="icomoon" aria-hidden="true" data-icon="&#xe01a;" data-modal="modal-1"><strong>Add to Stash</strong></a>
         <div class="md-overlay"></div><!-- the overlay element --> 

		  <div class="subscribe_big">
            <form action="post">

              <input type="text" name="email" value="" placeholder="What are you looking for ?" />
              <button aria-hidden="true" data-icon="&#x2610;" title="Search" name="submit" class="icomoon"></button>
            </form>
          </div>
        
            <!-- <div class="searchradio">
              <div style="display: inline;"> 
                <div class="radio_skin">
                  <input type="radio" name="account" value="register" id="register">
                </div>
                <label class="input-label" for="register">Ask Like a Begger!</label>
              </div>
              <div style="display: inline;"> 
                <div class="radio_skin">
                  <input type="radio" name="account" value="guest" id="guest" checked>
                </div>
                <label class="input-label" for="guest">Give Like a King!</label>             
              </div>
          </div>       --> 
 <div style= "margin-top: 20px;"  class=" module clearfix">        
          <div class="box-heading"><h3>Search Results</h3></div>
      <div class="related-products  omega">
      
      <div class="slides">          
<?php

//input search string
//$input="first second ball";
$input="dota swag";


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
 // $email="jahnavi10032@iiitd.ac.in";

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
    else  // this part is not working
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
?>
           
      <div  style="margin-right: 13px; margin-bottom: 10px;" class="product-box grid_3">
       
        <a class="img-cover" href="#">          
          <img height="210" width="218" src="<?php echo $f4 ; ?>" alt="product-image">
        </a>
        <div class="product-meta">
          <h4><?php echo $f2 ; ?></h4>
          <p><i class="cus-user-suit"></i>  Owned By : <?php echo $f1 ; ?></p>
        </div><!-- product-meta -->
        <ul class="product-action">
          <li>
            <div class="tooltip-wrapper">
              <span class="tooltip"><?php echo $f3 ; ?></span>
            </div>
            <a href="#" class="icomoon" aria-hidden="true" data-icon="&#xe01c;"></a>                    
          </li>
          <li>
            <div class="tooltip-wrapper">
              <span class="tooltip">Wishlist</span>
            </div>
            <a href="#" class="icomoon" aria-hidden="true" data-icon="&#xe00d;"></a>
          </li>
          <li>
            <div class="tooltip-wrapper">
              <span class="tooltip">Add To Cart</span>
            </div>
            <a href="#" class="icomoon" aria-hidden="true" data-icon="&#x25e0;"></a>                    
          </li>
        </ul>
      </div><!-- .product-box -->

      <?php
      }

//remove the results searched by the logged in user
$qry=mysql_query("DELETE from srchtbl where email='$email'");
?>


     


    </div><!-- end slides -->
    </div><!-- end related products -->

      </div><!--end #column-left -->   
       </div>
        <div style="margin-top: -98px;" id="column-left" class="grid_3 aside omega">   
        <div style="margin-bottom: 20px;"class="breadcrumb">
            <span class="br_before">You are in:</span>
            <a href="index.php">Home</a>                
            <span class="br_sep">/</span>
            <span class="cur_link">Search Results...</span>
          </div> 
        <div class="box">
          <div class="box-heading"><h4>My Account</h4></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
                <li><a href="account.html"><i class="cus-bullet-red"></i> Profile</a></li>
                <li><a  href="wishlist.php"><i class="cus-bullet-red"></i> My Wishlist</a></li>                
                <li><a class="active" href="#"><i class="cus-bullet-red"></i> My Stash</a></li>
                
              
              </ul>
            </div>
          </div>
        </div>
      </div><!--end #column-left --> 

       </div><!-- end .container_12 -->
    
    <footer>
      <span class="style-border"></span>
      <div class="container_12">
        <div class="grid_12 widget-box">
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