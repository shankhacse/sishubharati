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

 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/css/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/css/css/table.css">

    <link href="<?php echo base_url();?>application/web_assets/css/main.css" rel="stylesheet">


    <link href="<?php echo base_url();?>application/web_assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
 
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
<!--Accordian Javascript-->
    <script src="<?php echo base_url();?>application/web_assets/js/jquery.accordion.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo base_url();?>application/web_assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>application/web_assets/js/prism.js"></script>
    <script src="<?php echo base_url();?>application/web_assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="<?php echo base_url();?>application/web_assets/js/jquery.newsTicker.js"></script>
    <script>
        $('a[href*=#]').click(function(e) {
          var href = $.attr(this, 'href');
          if (href != "#") {
            $('html, body').animate({
                scrollTop: $(href).offset().top - 81
            }, 500);
        }
        else {
          $('html, body').animate({
                scrollTop: 0
            }, 500);
        }
          return false;
      });

        $(window).load(function(){
              $('code.language-javascript').mCustomScrollbar();
          });
            var nt_title = $('#nt-title').newsTicker({
                row_height: 40,
                max_rows: 1,
                duration: 3000,
                pauseOnHover: 0
            });
            var nt_example1 = $('#nt-example1').newsTicker({
                row_height: 80,
                max_rows: 3,
                duration: 4000,
                prevButton: $('#nt-example1-prev'),
                nextButton: $('#nt-example1-next')
            });
            var nt_example2 = $('#nt-example2').newsTicker({
                row_height: 60,
                max_rows: 1,
                speed: 300,
                duration: 6000,
                prevButton: $('#nt-example2-prev'),
                nextButton: $('#nt-example2-next'),
                hasMoved: function() {
                  $('#nt-example2-infos-container').fadeOut(200, function(){
                    $('#nt-example2-infos .infos-hour').text($('#nt-example2 li:first span').text());
                    $('#nt-example2-infos .infos-text').text($('#nt-example2 li:first').data('infos'));
                    $(this).fadeIn(400);
                  });
                },
                pause: function() {
                  $('#nt-example2 li i').removeClass('fa-play').addClass('fa-pause');
                },
                unpause: function() {
                  $('#nt-example2 li i').removeClass('fa-pause').addClass('fa-play');
                }
            });
            $('#nt-example2-infos').hover(function() {
                nt_example2.newsTicker('pause');
            }, function() {
                nt_example2.newsTicker('unpause');
            });
            var state = 'stopped';
            var speed;
            var add;
            var nt_example3 = $('#nt-example3').newsTicker({
                row_height: 80,
                max_rows: 1,
                duration: 0,
                speed: 10,
                autostart: 0,
                pauseOnHover: 0,
                hasMoved: function() {
                  if (speed > 700) {
                    $('#nt-example3').newsTicker("stop");
                    console.log('stop')
                    $('#nt-example3-button').text("RESULT: " + $('#nt-example3 li:first').text().toUpperCase());
                    setTimeout(function() {
                      $('#nt-example3-button').text("START");
                      state = 'stopped';
                    },2500);
                    
                  }
                  else if (state == 'stopping') {
                    add = add * 1.4;
                    speed = speed + add;
                    console.log(speed)
                    $('#nt-example3').newsTicker('updateOption', "duration", speed + 25);
                    $('#nt-example3').newsTicker('updateOption', "speed", speed);
                  }
                }
            });
            
            $('#nt-example3-button').click(function(){
              if (state == 'stopped') {
                state = 'turning';
                speed = 1;
                add = 1;
                $('#nt-example3').newsTicker('updateOption', "duration", 0);
                $('#nt-example3').newsTicker('updateOption', "speed", speed);
                nt_example3.newsTicker('start');
                $(this).text("STOP");
              }
              else if (state == 'turning') {
                state = 'stopping';
                $(this).text("WAITING...");
              }
            });
        </script>
  </body>
</html>
