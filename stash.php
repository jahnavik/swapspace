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

  <div class="md-modal md-effect-1" id="modal-1">
      <div class="md-content">
        <h3 style="color: #fff;">Add to Stash!</h3>
        <div>
            <form action="stash_create.php" method="post"
enctype="multipart/form-data">
  <fieldset>
    
    <strong>Product Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input required name="product" type="text"><br><br></strong>
    <strong>Select Product Category: &nbsp; &nbsp;</strong>
  <div class="optiondrop">
  <select required name="option">
    <option value=""> --- Please Select --- </option>
  <option value="Books">Books</option>
  <option value="Accessories">Accessories</option>
  <option value="Electronics">Electronics</option>
  <option value="Clothes">Clothes</option>
  <option value="Sports">Sports Equipments</option>
  <option value="Others">Others/Miscellaneous</option>
</select>
<span class="selected_value"></span>
</div>
  

      <?php   	
		$tbl_name="stash";
		$query="SELECT * FROM $tbl_name WHERE email='$email'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
    if($num!=0)
  		$id=mysql_result($result,$num-1,"id");
    else
      $id=0;
	  ?>
        
<label for="file"><br><strong>Upload Product's Image: &nbsp; &nbsp;</strong></label>
<input required type="file" name="file" id="file"><br>
<input type="hidden" name="id" value="<?php echo $id+1;?> ">

</fieldset>

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
			type="submit"
			name="upload" formaction="upload_file.php"
           >Submit</button>
		   
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

           class="md-close">Close</button>
		   
		   </form>
        </div>
      </div>
    </div>


  
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
       
	     
	   
        <h2>My Stash (<?php echo $num; ?> items)</h2>
        <a style="margin-top: -42px;"  class="md-trigger style-button right"  class="icomoon" aria-hidden="true" data-icon="&#xe01a;" data-modal="modal-1"><strong>Add to Stash</strong></a>
         <div class="md-overlay"></div><!-- the overlay element -->

		 
        <div style="margin-bottom: 20px;"class="wishlist-info">
          <table> 
             <thead>
            <tr>
              <td class="image">Product Category</td>
              <td class="name">Product Name</td>
              <td class="model">Image</td>
              <td class="quantity">Actions</td>

            </tr>
            </thead>
            <tbody>
			
			 <?php

    if($num==0)
    {
              echo"<tr>";

              echo"<td><img src=\"images/no_update.jpg\"></td>";
              echo"<td style=\"font-size : 20px;\">";
              
      echo "There are no items in your stash!";

  
        echo "</td>";
                    echo "   <td></td>";
echo "      </tr>";
  }
  else{ 
				$i=0;
			while ($i<$num)
			{ 
				$modale="modale";
				$modald="modald";	
				$f1=mysql_result($result,$i,"email");
				$f2=mysql_result($result,$i,"item");
				$f3=mysql_result($result,$i,"category");
				$f4=mysql_result($result,$i,"id");
				$f5=mysql_result($result,$i,"upload");
			$pic = 'images/circle-icons/circle-icons/full-color/png/64px/';
				
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
					$pic=$pic.'dolly.png';
			
				$modale=$modale.$f4;
				$modald=$modald.$f4;
				
			?>
              <tr>
                <td><a href="#" title="<?php echo $f3; ?>"><img src="<?php echo $pic; ?>" alt="product name"></a></td>
                <td><?php echo $f2; ?></td>
                <td class="image"><a href="<?php echo $f5; ?>" class="preview"><img src="<?php echo $f5; ?>" HEIGHT="50" WIDTH="50" BORDER="0" alt="product name"></a></td>
                
				 <div class="md-modal md-effect-1" id="<?php echo $modald; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">Delete item from stash!</h3>
        <div>
          <form action="stash_delete.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="d1" value="<?php echo $f2; ?>">
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
          margin-top: 2px;
          margin-left: 200px;
          border-radius: 2px;
          background: #A5281B;"
			type="submit"
			name="del"
           >Yes</button>
		   
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
			class="md-close"
           >No</button>
		   
		   
	</form>	   
        </div>
      </div>
    </div>

  <div class="md-modal md-effect-1" id="<?php echo $modale; ?>">
      <div class="md-content">
        <h3 style="color: #fff;">Edit Stash</h3>
        <div>
          <form action="stash_modify.php" method="POST" enctype="multipart/form-data">
  <fieldset>
    
    <strong>Product Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input required name="prod" type="text" value="<?php echo $f2; ?>"><br><br></strong>
    <strong>Select Product Category: &nbsp; &nbsp;</strong>
	<input type="hidden" name="e1" value="<?php echo $f4; ?>">
  <div class="optiondrop">
  <select required name="opt" >
    <option value=""> --- Please Select --- </option>
  <option value="Books">Books</option>
  <option value="Accessories">Accessories</option>
  <option value="Electronics">Electronics</option>
  <option value="Clothes">Clothes</option>
  <option value="Sports">Sports Equipments</option>
  <option value="Others">Others/Miscellaneous</option>
</select>
<span class="selected_value"></span>
</div>
  </fieldset>

         
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
			type="submit"
			name="edit"
           >Update</button>
		   
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
			class="md-close"
           >Close</button>
		   
		   
	</form>	   
        </div>
      </div>
    </div>
	
                <td class="action">
                  <a class="update_cart icomoon md-trigger" data-icon="&#xe00b;" title="Update" aria-hidden="true" data-modal="<?php echo $modale; ?>"></a>
				  <div class="md-overlay"></div><!-- the overlay element --> 
                  <a class="remove_cart icomoon md-trigger" data-icon="&#xe004;" title="Remove" aria-hidden="true" data-modal="<?php echo $modald; ?>"></a>
					<div class="md-overlay"></div><!-- the overlay element -->        
				  
	               </td>
              </tr>
              
			<?php
			$i++;
			 }			 
			 }
			?>
			  </tbody>
          </table>          
        </div><!-- .wishlist-info -->
       
      </div>
      <div style="margin-top: -98px;" id="column-left" class="grid_3 aside omega">   
        <div style="margin-bottom: 20px;"class="breadcrumb">
            <span class="br_before">You are in:</span>
            <a href="index.php">Home</a>        
            <span class="br_sep">/</span>
            <a href="account.php">Profile</a>        
            <span class="br_sep">/</span>
            <span class="cur_link">My Stash</span>
          </div> 
        <div class="box">
          <div class="box-heading"><h4>My Account</h4></div>
          <div class="box-content">
            <div class="box-category">
              <ul>
                <li><a href="home.php"><i class="cus-bullet-red"></i> Home</a></li>                
                <li><a href="account.php"><i class="cus-bullet-red"></i> Profile</a></li>
                <li><a  href="wishlist.php"><i class="cus-bullet-red"></i> My Wishlist</a></li>                
                <li><a class="active" href="stash.php"><i class="cus-bullet-red"></i> My Stash</a></li>
                
              
              </ul>
            </div>
          </div>
        </div>
      </div><!--end #column-left -->      </div><!-- end .container_12 -->
    
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