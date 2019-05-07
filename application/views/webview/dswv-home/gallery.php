<style type="text/css">
  

    .image_poster {
 width: 387px;
 height:300px;
 
} 

.galback{
  background-color: #f6f6f6;
  padding: 14px 0;
}
</style>

 
<!-- Mobile Specific Meta
  ================================================== -->
 
  <!-- CSS
  ================================================== -->
  <!-- RS5.0 Main Stylesheet -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/settings.css">
  RS5.0 Layers and Navigation Styles
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/layers.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/navigation.css">
  REVOLUTION STYLE SHEETS
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
  <link rel="stylesheet" type="text/css" href="plugins/revo-slider/fonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/settings.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/layers.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/revo-slider/css/navigation.css">  -->
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
 <!--  <link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/bootstrap/css/bootstrap.min.css"> -->
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/lightbox2/dist/css/lightbox.min.css">
  <!-- Slick Carousel -->
<!--   <link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/slick-carousel/slick/slick.css">
<link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css"> -->
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/perfect_gallery/css/style.css">


  <!-- Colors -->
  
  


 
  <!-- <div id="preloader">
    <div class='preloader'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>  -->
  <!--
  End Preloader
  ==================================== -->


  

<!--
Fixed Navigation
==================================== -->

<!--
End Fixed Navigation
==================================== -->




<!-- Start Portfolio Section
    =========================================== -->


 
    
    <section class="portfolio section-sm galback" id="portfolio">
      <div class="container-fluid">
        <div class="row " >
          <div class="col-lg-12">
         

            <div class="portfolio-filter">
              <button type="button" data-filter="all">All</button>
              <?php 
              foreach ($bodycontent['albumList'] as $value) {
              

              ?>
              <button type="button" data-filter=".<?php echo $value->name?>"><?php echo $value->name?></button>
               <?php 
                      }
              ?>
              
            </div>

            

          
            <div class="portfolio-items-wrapper">
              <div class="row">
                <?php

                    if ($bodycontent['imageList']) {
                               foreach ($bodycontent['imageList'] as $value) {

                ?>
                <div class="col-md-3 col-sm-6 col-xs-6 mix <?php echo $value->album?>" >
                    <div class="portfolio-block">
                      <img class="img-responsive image_poster" src="<?php echo base_url();?>application/assets/ds-documents/gallery_upload/<?php echo $value->random_file_name?>" alt="">
                      <div class="caption">
                        <a class="search-icon" href="<?php echo base_url();?>application/assets/ds-documents/gallery_upload/<?php echo $value->random_file_name?>" data-lightbox="image-1">
                          <i class="tf-ion-ios-search-strong"></i>
                        </a>
                        <h4><a href="">View Large</a></h4>
                      </div>
                    </div>
                  </div>
                  <?php  }
                    }else{
                ?>
                <div class="col-md-3 col-sm-6 col-xs-6 mix all" >
                    <div class="portfolio-block">
                      <img class="img-responsive" src="<?php echo base_url();?>application/assets/ds-documents/gallery_upload/slide1.jpg" alt="">
                      <div class="caption">
                        <a class="search-icon" href="<?php echo base_url();?>application/assets/ds-documents/gallery_upload/slide1.jpg" data-lightbox="image-1">
                          <i class="tf-ion-ios-search-strong"></i>
                        </a>
                        <h4><a href="">View Large</a></h4>
                      </div>
                    </div>
                  </div>

                 <?php 
                        }
                 ?>
             

              </div><!-- end of row -->
          
            </div><!-- end portfolio-items-wrapper -->
            
          </div> <!-- /end col-lg-12 -->
        </div> <!-- end row -->

      </div>  <!-- end container -->
    </section>   <!-- End section -->


     





    <!-- end Footer Area
    ========================================== -->


    
    <!-- 
    Essential Scripts
    =====================================-->
    <!-- Main jQuery -->
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Google Map -->
    <!-- Google Map -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script  src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/google-map/gmap.js"></script> -->
    <!-- Bootstrap 3.7 -->
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Parallax -->
   <!--  <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/parallax/jquery.parallax-1.1.3.js"></script> -->
    <!-- lightbox -->
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/lightbox2/dist/js/lightbox.min.js"></script>
   <!--  Owl Carousel
   <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/slick-carousel/slick/slick.min.js"></script> -->
    <!-- Portfolio Filtering -->
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/mixitup/dist/mixitup.min.js"></script>
    <!-- Smooth Scroll js
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/smooth-scroll/dist/js/smooth-scroll.min.js"></script> -->
    
    <!-- Custom js -->
    <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/js/script.js"></script>

  </body>
  </html>