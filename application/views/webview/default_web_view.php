<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="<?php echo base_url();?>application/web_assets/images/favicon.png">
    <title>Sishubharati</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bx-Slider StyleSheet CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/jquery.bxslider.css" rel="stylesheet"> 
    <!-- Font Awesome StyleSheet CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>application/web_assets/css/svg-style.css" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/prettyPhoto.css" rel="stylesheet">
    <!-- Widget CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/widget.css" rel="stylesheet">
    <!-- DL Menu CSS -->
	<link href="<?php echo base_url();?>application/web_assets/js/dl-menu/component.css" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/typography.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/animate.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/owl.carousel.css" rel="stylesheet">
    <!-- Shortcodes CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/color.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="<?php echo base_url();?>application/web_assets/css/responsive.css" rel="stylesheet">



    
 
  </head>

  <body>

<!--Wrapper Start-->  
<div class="ct_wrapper">
	
<?php 
include('dswv-home/header.php');
?>
    <!--Banner Wrap Start-->

       <?php if($bodyview)  : ?>  
    
                
        <?php $this->load->view($bodyview); ?>
 
 
     <?php
       endif; 
      ?>


<?php 
include('dswv-home/footer.php');
?>
    <!--Footer Wrap End-->
</div>
<!--Wrapper End-->



    <!--Bootstrap core JavaScript-->
 <!-- <script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script>  -->
  <!--Bx-Slider JavaScript-->
	<script src="<?php echo base_url();?>application/web_assets/js/jquery.bxslider.min.js"></script>
    <!--Dl Menu Script-->
	<script src="<?php echo base_url();?>application/web_assets/js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo base_url();?>application/web_assets/js/dl-menu/jquery.dlmenu.js"></script>
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo base_url();?>application/web_assets/js/owl.carousel.js"></script>
    <!--Map JavaScript-->
    <!-- <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyA6rAFLLBeznOfeK8EZ8vpuugtJsTfCsf8&callback=initialize"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBL-aKIIMAVmw80IiR03i9eZ6nW5S1bcHA"
  type="text/javascript"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo base_url();?>application/web_assets/js/jquery.downCount.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo base_url();?>application/web_assets/js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo base_url();?>application/web_assets/js/waypoints-min.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo base_url();?>application/web_assets/js/custom.js"></script>


  </body>
</html>
