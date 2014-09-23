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
              <li><a href="account.php">Hi <?php echo $name; ?> !</a></li>
              <li><a  href="index.php">Log Out <i class="icomoon" aria-hidden="true" data-icon="&#xe014;"></i></a></li>  
          </ul>          
        </nav>
      </div><!-- container_12 -->
    </header>
    <div id="main-container">
       <div class="page-top-leader omega">
        <div class="container_12 relatived clearfix">
          <h1 class="page-title">Search Results...</h1>
            <div class="breadcrumb">
              <span class="br_before">You are in:</span>
              <a href="home.php">Home</a>       
              <span class="br_sep">/</span>
              <span class="cur_link">Search Results...</span>
          </div>
        </div>
      </div><!-- .page-top-leader --> 
     <div class="container_12 aside-container">
      <div style="margin-top: -30px;" class="grid_10">
        <div class="subscribe_big">
          <form method="post" action="">
            <input type="text" name="val" value="" placeholder="What are you looking for ?" />
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


 <!-- Beggar's Search -->
        <div style= "margin-top: 20px;"  class="featured-module module clearfix">        
          <div class="box-heading"><h3>People who have this product</h3></div>
            <div class="related-products  omega">
              <div class="slides">          
                <?php
				if(isset($_POST['val'])){
						$input=$_POST['val'];
				}
				else
				if(isset($_GET['val']))
				{
				$input=$_GET['val'];
				}
				
                  //$input="dota swag";
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
						$modala = "modala";
						$modalc = "modalc";
                      $itm=$row[0];
                      //echo $itm;
                      //echo "<br>";
                      $new=mysql_query("SELECT email,item,category,upload,id from stash where item='$itm'");
                      $inrow=mysql_fetch_row($new);
                      $f1=$inrow[0];
                      $f2=$inrow[1];
                      $f3=$inrow[2];
                      $f4=$inrow[3];
					  $f5=$inrow[4];
						
						$modala=$modala.$f5;
						$modalc=$modalc.$f5;
                  ?>
				  
    <div class="md-modal md-effect-1" id="<?php echo $modala; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">Add to Wishlist?</h3>
        <div>
          <form action="addtowishlist.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="item" value="<?php echo $f2; ?> ">
			 <input type="hidden" name="category" value="<?php echo $f3; ?> ">
			 <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin-top: 30px;
                  margin-left: 190px;
                  border-radius: 2px;
                  background: #A5281B;"
        			type="submit" name="add">Yes</button>
        		   
                  <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin: 3px 2px;
                  border-radius: 2px;
                  background: #A5281B;"
                  class="md-close">No</button>
        		   
        		</form>
            </div>
          </div>
        </div>

		<div class="md-modal md-effect-1" id="<?php echo $modalc; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">I want this!</h3>
        <div>
          <form action="canihave.php" method="post" enctype="multipart/form-data">
		     <input type="hidden" name="emailid" value="<?php echo $f1; ?> ">
             <input type="hidden" name="item" value="<?php echo $f2; ?> ">
			 <input type="hidden" name="category" value="<?php echo $f3; ?> ">
			 <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin-top: 30px;
                  margin-left: 190px;
                  border-radius: 2px;
                  background: #A5281B;"
        			type="submit" name="add">Yes</button>
        		   
                  <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin: 3px 2px;
                  border-radius: 2px;
                  background: #A5281B;"
                  class="md-close">No</button>
        		   
        		</form>
            </div>
          </div>
        </div>
		
                <div  style="margin-right: 15px; margin-bottom: 10px;" class="product-box grid_3">
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
                    <a href="#" class="icomoon" aria-hidden="true" data-icon="&#xe01c;" ></a> 
						
                    </li>
                   <li>
                     <div class="tooltip-wrapper">
                       <span class="tooltip">Wishlist</span>
                      </div>
					  
                      <a href="#" class="icomoon md-trigger" aria-hidden="true" data-icon="&#xe00d;" data-modal="<?php echo $modala;?>"></a>
					    <div class="md-overlay"></div><!-- the overlay element --> 
                    </li>
                    <li>
                      <div class="tooltip-wrapper">
                         <span class="tooltip">Add To Cart</span>
                      </div>
                      <a href="#" class="icomoon md-trigger" aria-hidden="true" data-icon="&#x25e0;" data-modal="<?php echo $modalc; ?>"></a> 
						<div class="md-overlay"></div><!-- the overlay element --> 					  
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


          <!-- King's Search -->

          <div style= "margin-top: 20px;"  class="featured-module module clearfix">        
          <div class="box-heading"><h3>People who want this product</h3></div>
            <div class="related-products  omega">
              <div class="slides">          
                <?php
                  //$input="dota swag pum";
                  //breaking the search string into separate words
                

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
  $qry=mysql_query("SELECT item from wishlist where item like '%$nm%'");

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
//
//sorting srchtbl in descending order according to count for the email id of the logged in user
//echo "phase 3";
//echo "<br>";
$qry=mysql_query("SELECT item from srchtbl where email='$email' ORDER BY cnt DESC");
while($row = mysql_fetch_row($qry))
  {
    $itm=$row[0];
    //echo $itm;
    //echo "<br>";
	$num=mysql_numrows($qry);
	
	$moda="moda";
	$modc="modc";
		
    $new=mysql_query("SELECT email,item,category,id from wishlist where item='$itm'");
    $inrow=mysql_fetch_row($new);
    $f1=$inrow[0];
    $f2=$inrow[1];
    $f3=$inrow[2];
	$f4=$inrow[3];
	
	$moda=$moda.$f4;
	$modc=$modc.$f4;
	
    $pic = 'images/circle-icons/circle-icons/full-color/png/128px/';
                      
                      if ($f3=='Books')
                        $pic=$pic.'bookshelf.png';
                      else if ($f3=='Sports')
                        $pic=$pic.'skateboard.png';
                      else if ($f3=='Accessories')
                        $pic=$pic.'fashion.png';
                      else if ($f3=='Clothes')
                        $pic=$pic.'cart.png';
                      else if ($f3=='Electronics')
                        $pic=$pic.'plugin.png';
                      else
                        $pic=$pic.'cart.png';
                    
                    
                  ?>
				  
	    <div class="md-modal md-effect-1" id="<?php echo $moda; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">Add to Wishlist?</h3>
        <div>
          <form action="addtowishlist.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="item" value="<?php echo $f2; ?> ">
			 <input type="hidden" name="category" value="<?php echo $f3; ?> ">
			 <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin-top: 30px;
                  margin-left: 190px;
                  border-radius: 2px;
                  background: #A5281B;"
        			type="submit" name="add">Yes</button>
        		   
                  <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin: 3px 2px;
                  border-radius: 2px;
                  background: #A5281B;"
                  class="md-close">No</button>
        		   
        		</form>
            </div>
          </div>
        </div>			  
				  
	<div class="md-modal md-effect-1" id="<?php echo $modc; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">I have this?</h3>
        <div>
          <form action="ihavethis.php" method="post" enctype="multipart/form-data">
		     <input type="hidden" name="emailid" value="<?php echo $f1; ?> ">
             <input type="hidden" name="item" value="<?php echo $f2; ?> ">
			 <input type="hidden" name="category" value="<?php echo $f3; ?> ">
			 <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin-top: 30px;
                  margin-left: 190px;
                  border-radius: 2px;
                  background: #A5281B;"
        			type="submit" name="add">Yes</button>
        		   
                  <button 
                  style= "border: none;
                  padding: 0.6em 1.2em;
                  background: #c0392b;
                  color: #fff;
                  font-family: 'Lato', Calibri, Arial, sans-serif;
                  font-size: 1em;
                  letter-spacing: 1px;
                  text-transform: uppercase;
                  cursor: pointer;
                  display: inline-block;
                  margin: 3px 2px;
                  border-radius: 2px;
                  background: #A5281B;"
                  class="md-close">No</button>
        		   
        		</form>
            </div>
          </div>
        </div>
           
                <div  style="margin-right: 15px; margin-bottom: 10px;" class="product-box grid_3">
                  <a class="img-cover" href="#">          
                    <img height="130" width="130" style=" display: block; margin-left: auto; margin-top: 5px; margin-bottom: 5px; margin-right: auto; " src="<?php echo $pic ;?>" alt="product-image">
                   </a>
                  <div class="product-meta">
                    <h4><?php echo $f2 ; ?></h4>
                      <p><i class="cus-user-suit"></i>  Wished by : <?php echo $f1 ; ?></p>
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
                      <a href="#" class="icomoon md-trigger" aria-hidden="true" data-icon="&#xe00d;" data-modal="<?php echo $moda; ?>"></a>
					  <div class="md-overlay"></div><!-- the overlay element --> 
                    </li>
                    <li>
                      <div class="tooltip-wrapper">
                         <span class="tooltip">Add To Cart</span>
                      </div>
                      <a href="#" class="icomoon md-trigger" aria-hidden="true" data-icon="&#x25e0;"  data-modal="<?php echo $modc; ?>"></a>                    
					  <div class="md-overlay"></div><!-- the overlay element --> 
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
       <div style="margin-left: 50px; " id="column-left" class="grid_3  omega">   
       
        <div class="box">
          <div class="box-heading"><h4>My Account</h4></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
                <li><a href="home.php"><i class="cus-house"></i>&nbsp; Home</a></li>                
                <li><a href="account.php"><i class="cus-report-user"></i>&nbsp; My Account</a></li>
                <li><a class="active" href="wishlist.php"><i class="cus-cart-add"></i>&nbsp; My Wish List</a></li>                
                <li><a href="stash.php"><i class="cus-box"></i>&nbsp; My Stash</a></li>
               
              </ul>
            </div>
          </div>
        </div>
      </div>
      </div>
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