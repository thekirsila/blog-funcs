<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
        include "bloglib.php";
        getPostTitle(true);
        ?></title>
    <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
    <!--Font awesome code-->
    <script src="https://use.fontawesome.com/2d629c98cb.js"></script>
       <!--Open Graph meta tags-->
        <meta name="og:title" content="<?php echo $title;?>" />
        <meta name="og:description" content="
                                             <?php
                                             getPostDescription(true);
                                             ?>
                                             " />
        <meta name="og:site_name" content="A Preview Blog" />
        <meta name="og:locale" content="en_US" />
        <!--Title icon-->
        <link rel="shortcut icon" type="image/x-icon" href="icon.ico" />
  </head>
  <body style="padding-top: 70px">
  <div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top">
	    <div class="container-fluid">
	      <!-- Brand and toggle get grouped for better mobile display -->
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	        <a class="navbar-brand" href="index.php">A Preview Blog</a></div>
	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="collapse navbar-collapse" id="topFixedNavbar1">
              
<ul class="nav navbar-nav navbar-right">
  <li class="active"><a href="index.php">Blog</a></li>
</ul>
          </div>
	      <!-- /.navbar-collapse -->
        </div>
	    <!-- /.container-fluid -->
      </nav>
    </div>
      <?php
      getPostData();
      ?>
<script src="js/jquery-1.11.3.min.js"></script>

	<script src="js/bootstrap.js"></script>
  </body>
</html>