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
  <link rel="stylesheet" href="cus-icons.css" type="text/css"  /> 
  <link rel="stylesheet" href="css/custom.css" media="screen">
  <link rel="stylesheet" href="css/responsive.css" media="screen">
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
  
  <div id="wrapper">    


  
     <header>
    <div class="container_12 header-inner relatived">
      <div id="logo" class="grid_3">
        <a href="index.php"><img src="images/logo_1.jpg" alt="olympia-logo" /></a>
      </div>    
      <nav class="grid_8 right omega">
          <ul class="primary-nav">
                
                <span aria-hidden="true" data-icon="&#6600;" class="home"></span>
               
            <li><a href="account.php">

            <?php

include "connect.php";

########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id     = '81462988222-s4iolt9npgon5ulbbemthqm5oeuprk23.apps.googleusercontent.com';
$google_client_secret   = '0LAMwGCXPbUSVfGlabVUE_Bw';
$google_redirect_url  = 'http://localhost/swapspace/home.php'; //path to your script
$google_developer_key   = 'AIzaSyC2AOMQqNLQfANVXCF_jbSJ9w1HqpyoxKg';

// ########## MySql details (Replace with yours) #############
// $db_username = "root"; //Database Username
// $db_password = ""; //Database Password
// $hostname = "localhost"; //Mysql Hostname
// $db_name = 'login'; //Database Name
// ###################################################################



//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

//start session
session_start();

$gClient = new Google_Client();
$gClient->setApplicationName('Login to Sanwebe.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  //header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
  header('Location: http://localhost/swapspace/index.php');
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
  $gClient->authenticate($_GET['code']);
  $_SESSION['token'] = $gClient->getAccessToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
  return;
}


if (isset($_SESSION['token'])) 
{ 
  $gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
    //For logged in user, get details from google using access token
    $user         = $google_oauthV2->userinfo->get();
    $user_id        = $user['id'];
    $user_name      = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email        = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
   // $profile_url      = filter_var($user['link'], FILTER_VALIDATE_URL);
    $profile_image_url  = filter_var($user['picture'], FILTER_VALIDATE_URL);
    $personMarkup     = "$email<div><img src='$profile_image_url?sz=50'></div>";
    $_SESSION['token']  = $gClient->getAccessToken();
}
else 
{
  //For Guest user, get google login url
  $authUrl = $gClient->createAuthUrl();
}


if(isset($authUrl)) //user is not logged in, show login button
{
 // echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
} 
else // user logged in 
{
   /* connect to database using mysqli */
  $mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
  
  if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
  }
  
  //compare user id in our database
 $user_exist = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user_id")->fetch_object()->usercount; 
  if($user_exist)
  {
   echo 'Welcome back '.$user_name.'!';
    //header('Location: http://localhost/swapspace/home.php');
  
  }else{ 
    //user is new
  echo 'Hi '.$user_name.', Thanks for Registering!';
    $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email, google_picture_link) 
    VALUES ($user_id, '$user_name','$email', '$profile_image_url')");
   // header('Location: http://localhost/swapspace/home.php');
  }

  
 //echo '<br /><a href="'.$profile_url.'" target="_blank"><img src="'.$profile_image_url.'?sz=100" /></a>';
  //echo '<br /><a class="logout" href="?reset=1">Logout</a>';
  
  //list all user details
 //echo '<pre>'; 
  //print_r($user);
 // echo '</pre>';  
}
$_SESSION['email_ses']=$email; 
$_SESSION['name_ses']=$user_name;

//$_SESSION["name"]="jahnavi10032@iiitd.ac.in";

$q1="SELECT * FROM wishlist WHERE email='$email'";
$q2="SELECT * FROM stash WHERE email='$email'";
$r1=mysql_query($q1);
$r2=mysql_query($q2);
$n1=mysql_numrows($r1);
$n2=mysql_numrows($r2);


// header('Location: http://localhost/swapspace/home.php');

?>
</a>
             <li><a href="#"><i class="cart-top-icon icomoon" aria-hidden="true" data-icon="&#x25e0;"></i></a></li>
            <li><a href="" aria-hidden="true" style="display : inline; background: #e64a3c; border-radius: 95px; width: 2px; height: 7px; color:#fff">1</a><div class="megamenu">
                <div class="grid_4 omega">
                  <h4><strong>Notifications</strong></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, ipsum modi quod ea eligendi pariatur incidunt cumque nihil quas porro! Quos aliquam dolore quae earum itaque! Sint, nobis magni ducimus.
                  </p>                  
                </div>
                
              </div></li>
            <li><a  href="?reset=1">Log Out <i class="icomoon" aria-hidden="true" data-icon="&#xe014;"></i></a></li>           
                              
            <!-- <li class="search-wrapper">
              <a href="#" aria-hidden="true" data-icon="&#x2610;" class="search-popup-trigger icomoon"></a>
              <div id="top-searc-wrapper"
                <div class="relatived">
                  <form action="get">
                    <input aria-hidden="true" type="submit" value="&#x2610;" id="search" class="search-button icomoon">
                    <input type="text" name="search" placeholder="search..."/>
                  </form>
                </div>
              </div>
            </li>  -->
          </ul>          
        </nav>
      </div><!-- container_12 -->
    </header>

    <div id="main-container">
      <!-- <div class="page-top-leader omega">
      <div class="container_12 relatived clearfix"> 
        <div class="breadcrumb">
          <span class="br_before">You are in:</span>
          <span class="cur_link">Home</span>
        </div>
      </div>
    </div><!-- .page-top-leader --> 
      <div class="container_12">        
      <div id="column-left" class="grid_3 aside">
       <?php

        $tbl_name="categories";
        $query="SELECT * FROM $tbl_name";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
        ?>
       <div class="white-box box ">
          <div class="box-heading">Categories</div>
          <div class="box-content">
            <div class="box-category">
            

                <?php
              if($num==0)
                {
                  echo "There are no items in any category!";

                }
              else{
                  echo"<ul>";
                  
                  $i=0;
      
                  while ($i<$num)
                  {
                  $f1=mysql_result($result,$i,"catnm");
                  $f2=mysql_result($result,$i,"cnt");
                 // echo "<li><a href=\"#\"><i class=\"cus-page-white-ruby\"></i>  $f1 ($f2)</a></li>";
                  if($i==0)
                  {
                    echo "<li><a href=\"#\"><i class=\"cus-page-white-ruby\"></i>  $f1 ($f2)</a></li>";
                  }
                  elseif ($i==1) 
                  {
                    echo "<li><a href=\"#\"><i class=\"cus-book-open\"></i>  $f1 ($f2)</a></li>";
                  }
                  elseif ($i==2) 
                  {
                    echo "<li><a href=\"#\"><i class=\" cus-user-red\"></i>  $f1 ($f2)</a></li>";
                  }
                  elseif ($i==3) 
                  {
                    echo "<li><a href=\"#\"><i class=\" cus-disconnect\"></i>  $f1 ($f2)</a></li>";
                  }
                  elseif ($i==4) 
                  {
                    $f3=$f1;
                    $f4=$f2;
                  }
                  else 
                  {
                    echo "<li><a href=\"#\"><i class=\" cus-world\"></i>  $f1 ($f2)</a></li>";
                  }
                  $i=$i+1;            
                  }
                  echo "<li><a href=\"#\"><i class=\" cus-information\"></i>  $f3 ($f4)</a></li>";
          echo "</ul>";        
                }
                ?>
            </div>
          </div>
        </div>
        <!-- code for retrieving top 10 tags -->
        <?php
      
        $tbl_name="tags";
        $countt= "countt";
        $query="SELECT * FROM $tbl_name ORDER BY $countt DESC limit 10";
        $result=mysql_query($query);
        $num=mysql_numrows($result);
        ?>
         <div class="white-box box">
          <div class="box-heading">Popular Tags</div>
          <div class="box-content">
            <div class="box-category">
              <?php
              if($num==0)
                {
                  echo "There are no tags";
                }
              else{
                echo"<ul>";
                  $i=0;
      
                  while ($i<$num)
                  {
                  $f1=mysql_result($result,$i,"tagname");
                  $f2=mysql_result($result,$i,"countt");
                  echo "<li><a href=\"#\"><i class=\"cus-tag-red\"></i>  $f1 ($f2)</a></li>"; 
                  $i=$i+1;            
                  }
    echo    "</ul>";        
                }
                ?>
            </div>
          </div>
        </div>
        
              
      </div><!-- end #column-left -->
      <div style="margin-top: -30px;" class="clearfix aside-container grid_6 omega">
        <div class="subscribe">
            <form action="post">
              <input type="text" name="email" value="" placeholder="What are you looking for ?" />
              <button aria-hidden="true" data-icon="&#x2610;" title="Search" name="submit" class="icomoon"></button>
            </form>

             <!-- <div class="buttons">
                
                 <a href="" class="positive">
                        <img src="images/textfield_key1.png" alt=""/> 
                       Ask Like a Borrower ?!
                    </a>

                    <a href="" class="regular">
                       <img src="images/apply2.png" alt=""/> 
                       Give Like a King !
                    </a>
              </div> -->
          </div>
<div style="margin-top: 30px;">

<?php

$qry=mysql_query("SELECT id,type from feed ORDER BY id DESC");
while($row=mysql_fetch_row($qry))
{
  $match=$row[0];
 
  if($row[1]=="stash")
  {
     $new=mysql_query("SELECT user1,item1,loc1,category1 from feed where id='$match'");
    $inrow = mysql_fetch_row($new);
    $f1=$inrow[0];
    $f2=$inrow[1];
    $f3=$inrow[2];
    $f4=$inrow[3];
    ?>

    <div class= "stashbox white-box">  
             
            <img style="float: left; margin-right: 5px;"src="images/circle-icons/circle-icons/full-color/png/64px/profle.png">
              <p> <a class="a_col" href="user.html"><?php echo $f1 ?></a> added an item : <strong> <?php echo $f2 ?> </strong> to her stash in the category <strong><?php echo $f4 ?></strong>.</p>
              <div class="white-box-stash">
                <img src="images/circle-icons/circle-icons/full-color/png/64px/fashion.png"> 
                <a href= <?php echo $f3; ?> class="preview" ><img  height= "64" width= "64" style=" border: 1px solid gainsboro; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px;" src=<?php echo $f3 ; ?> ></a>
               </div>
          </div>
<?php

 }
  elseif($row[1]=="wishlist")
  {
  
    $new=mysql_query("SELECT user1,item1,category1 from feed where id='$match'");
    $inrow = mysql_fetch_row($new);
    $f1=$inrow[0];
    $f2=$inrow[1];
    $f3=$inrow[2];
    ?>

 <div class= "wishlistbox white-box">  
             
            <img style="float: left; margin-right: 5px;"src="images/circle-icons/circle-icons/full-color/png/64px/profle.png">
              <p><a class="a_col" href="user.html"><?php echo $f1  ?></a> added an item : <strong><?php echo $f2 ?></strong> in the category <strong><?php echo $f3 ?></strong>. </p>
              <div class="white-box-wish"><img src="images/circle-icons/circle-icons/full-color/png/64px/umbrella.png"></div>
          </div>

<?php 
}
    else 
    {

      ?>
          <div  class= "swapbox white-box">  
             
            <img style="float: left;"src="images/circle-icons/circle-icons/full-color/png/64px/profle.png">
              <p> &nbsp; <a class="a_col" href="user.html"><?php echo $f1 ?></a> swapped an item with  <a class="b_col" href="user.html">Arhan Sibal</a>.</p>
              <div ><img src="images/circle-icons/circle-icons/full-color/png/64px/art.png"> 
                <img src="images/swap.png"> <img src="images/circle-icons/circle-icons/full-color/png/64px/bike.png"></a></div>
          </div>

         <?php
         }
}
         ?>

         </div>

          

       </div><!-- end .aside-container -->
     
      <div style="float:right;" id="column-right" class="grid_3 omega">
        <div class="white-box box content">
          <div class="box-heading"><a style="color: #1c1c1c;" title="Open Wishlist" href="wishlist.php">Wishlist</a></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
                <?php
                               
                               if ($n1==0)
                                       echo "No Updates Yet!";
                               else
                               {
                                       $i=0;
                                       while ($i<$n1)
                                       {
                                               $item1=mysql_result($r1,$i,"item");
                               ?>
                <li><a href="#"><i class="cus-bullet-star"></i> <?php echo $item1; ?></a></li>             
                <?php
                               $i++;
                               }
                               }
                               ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="white-box box">
          <div class="box-heading"><a style="color: #1c1c1c;" title="Open Stash item" href="stash.php">My Stash</a></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
               
                               <?php
                               
                               if ($n2==0)
                                       echo "No Updates Yet!";
                               else
                               {
                                       $j=0;
                                       while ($j<$n2)
                                       {
                                               $item2=mysql_result($r2,$j,"item");
                               ?>
                <li><a href="#"><i class="cus-thumb-up"></i> <?php echo $item2; ?></a></li>
                <?php
                               $j++;
                               }
                               }
                               ?>          
                
              </ul>
            </div>
          </div>
        </div>
      </div><!-- end right vcolumn -->
      </div><!-- end .container_12 -->
   
  </div><!-- end .main-container -->
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
</body>
</html>