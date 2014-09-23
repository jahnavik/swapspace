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
        <div class="mobile-menu-trigger"><span class="icomoon mobile-icon-menu" aria-hidden="true">&#xe008;</span><a class="menu-label">Select a Page</a></div>
          <ul class="primary-nav">
           
            <li>

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
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
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
   //$profile_url      = filter_var($user['link'], FILTER_VALIDATE_URL);
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
  echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
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
   //echo 'Welcome back '.$user_name.'!';
    //header('Location: http://localhost/swapspace/home.php');
  
  }else{ 
    //user is new
  //echo 'Hi '.$user_name.', Thanks for Registering!';
    $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email,  google_picture_link) 
    VALUES ($user_id, '$user_name','$email','$profile_image_url')");
   // header('Location: http://localhost/swapspace/home.php');
  }

  
 //echo '<br /><a href="'.$profile_url.'" target="_blank"><img src="'.$profile_image_url.'?sz=100" /></a>';
 echo '<br /><a class="logout" href="?reset=1">Logout</a>';
  
  //list all user details
  //echo '<pre>'; 
 // print_r($user);
 // echo '</pre>';  
}

// header('Location: http://localhost/swapspace/home.php');

?>

</li>
           

           <!--  <li class="search-wrapper">
              <a href="#" aria-hidden="true" data-icon="&#x2610;" class="search-popup-trigger icomoon"></a>
              <div id="top-search-wrapper">
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
    <div id="featured" class="clearfix container_12">
        
        <div  class=" grid_2 ">

    <ul class="ch-grid">
    <li>
        <div class="ch-item ch-img-1">
            <div class="ch-info">

                <h3>Books</h3>
               
            </div>
        </div>
    </li>
     <li>
        <div class="ch-item ch-img-2">
            <div class="ch-info">
                <h3 style = "margin-left: 5px;">Electronics</h3>
                
            </div>
        </div>
    </li>
     <li>
        <div class="ch-item ch-img-3">
            <div class="ch-info">
                <h3>Sports Equipment</h3>
               
            </div>
        </div>
    </li>
    </ul> 
    </div>   

      <div style="margin-top: 13px; margin-right : 3px;" class="banner featured-banner grid_8">        
     <iframe  id="ytplayer" type="text/html" width="640" height="440"
  src="http://www.youtube.com/embed/IcrQYwCj11Y?autoplay=0&origin=http://example.com"  frameborder="0"/>

</iframe>
      </div>
     
      <div class=" grid_2 omega">
         <ul class="ch-grid">
    <li>
        <div class="ch-item ch-img-4">
            <div class="ch-info">
                <h3 style = "margin-left: 5px;">Accessories</h3>
                
            </div>
        </div>
    </li>
     <li>
        <div class="ch-item ch-img-5">
            <div class="ch-info">
                <h3>Clothes</h3>
                
            </div>
        </div>
    </li>
     <li>
        <div class="ch-item ch-img-6">
            <div class="ch-info">
                <h3>Others</h3>
               
            </div>
        </div>
    </li>
    </ul> 
    </div>
</div><!-- end #featured -->      
    <div  id="main-container" class="homepage">
      
      <div class="container_12 full-container">

           <span class="style-border"></span>
      <div style="margin-top: -63px;" class="container_12">
        <div class="grid_4 widget-box">
          <div class="box-heading">
            <h4><b>What?</b> </h4>
          </div>
          <p>We provide users with a portal for exchanging/lending items with others. It helps users to look for items which they need and other people may have.</p>
        </div>
        <div class="grid_4 widget-box">
          <div class="box-heading">
            <h4><b>Why?</b></h4>
          </div>
          <p>It is not always feasible to purchase a new item when one needs to use it for a short while. Also sometimes items can be obtained faster when borrowed from people nearby.</p>
        </div>
        <div class="grid_12 widget-box omega">
          <div class="box-heading">
            <h4><b>How?</b></h4>
          </div>
          <p>The website allows users to request items they need from other users. Also a user may offer his items to another user. When there is mutual agreement between the users then we share their contact information with each other and let the swap happen!</p>
        </div>
       <br>
      </div>
      </div><!-- end .container_12 -->
      
    </div><!-- end #main-container -->
    <footer>
      <span class="style-border"></span>
      <div class="container_12">
        <div class="grid_4 widget-box">
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