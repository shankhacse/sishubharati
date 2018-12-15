<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"><div class="banner_outer_wrap">
      <ul class="main_slider">
          <li>
              <img src="<?php echo base_url();?>application/web_assets/images/slide1.jpg" alt="">
                <!-- <div class="ct_banner_caption">
                    <h4 class="fadeInDown">WELCOME TO <span>EDU LEARN</span></h4>
                    <span class="fadeInDown">Learning Online is Easy Now</span>
                    <h2 class="fadeInDown">WE ARE THE BEST <br/> IN Online EDUCATION</h2>
                    <p class="fadeInDown">HELLO, ARE YOU READY TO START RIGHT NOW ?</p>
                    <a class="active fadeInDown" href="#">FIND COURSES</a>
                    <a class="fadeInDown" href="#">DISCOVER MORE</a>
                </div> -->
            </li>
            <li>
              <img src="<?php echo base_url();?>application/web_assets/images/slide2.jpg" alt="">
                <!-- <div class="ct_banner_caption">
                    <h4 class="fadeInDown">WELCOME TO <span>EDU LEARN</span></h4>
                    <span class="fadeInDown">Learning Online is Easy Now</span>
                    <h2 class="fadeInDown">WE ARE THE BEST <br/> IN Online EDUCATION</h2>
                    <p class="fadeInDown">HELLO, ARE YOU READY TO START RIGHT NOW ?</p>
                    <a class="active fadeInDown" href="#">FIND COURSES</a>
                    <a class="fadeInDown" href="#">DISCOVER MORE</a>
                </div> -->
            </li>
            <li>
              <img src="<?php echo base_url();?>application/web_assets/images/slide3.jpg" alt="">
                <!-- <div class="ct_banner_caption">
                    <h4 class="fadeInDown">WELCOME TO <span>EDU LEARN</span></h4>
                    <span class="bounceInUp">Learning Online is Easy Now</span>
                    <h2 class="fadeInDown">WE ARE THE BEST <br/> IN Online EDUCATION</h2>
                    <p class="fadeInDown">HELLO, ARE YOU READY TO START RIGHT NOW ?</p>
                    <a class="active fadeInDown" href="#">FIND COURSES</a>
                    <a class="fadeInDown" href="#">DISCOVER MORE</a>
                </div> -->
            </li>
        </ul>

        
    </div>

<section class="home_option_wrap">
            <div class="container">
    <div class="row">
        <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
          <img src="<?php echo base_url();?>application/web_assets/images/id-card.png" width="100" height="100" class="option_img"> 
            
            <h3><a href="<?php echo base_url();?>home/admissionpage">Admission</a></h3> 
              
            </div>
            <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
              <img src="<?php echo base_url();?>application/web_assets/images/ereader-1.png" width="100" height="100" class="option_img" >
            
            <h3><a href="<?php echo base_url();?>home/importantinfo">Importent Info</a></h3> 
            
            </div>
            <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
             
           <img src="<?php echo base_url();?>application/web_assets/images/desktop.png" width="100" height="100" class="option_img" >
            <h3><a href="#">E-payment</a></h3> 
              
            </div>
            <div class=" adminhome1 col-md-3 col-sm-4 col-xs-3">
            <img src="<?php echo base_url();?>application/web_assets/images/laptop.png" width="100" height="100"  class="option_img" >
            
            <h3><a href="<?php echo base_url();?>home/noticeboard">Notice</a></h3> 
            
            </div> 

            <div class=" adminhome1 col-md-3 col-sm-4 col-xs-3 ">
            <img src="<?php echo base_url();?>application/web_assets/images/acoustic-guitar.png" width="100" height="100" class="option_img" >
            <h3><a href="<?php echo base_url();?>home/gallery">Photo Gallery</a></h3> 
            
            </div> 

           
           
            

          </div>
  </div>
</section>
    <!--Banner Wrap End-->

<link rel="stylesheet" href="<?php echo base_url();?>application/web_assets/css/notice.css">

<section class="ct_register_bg">
            <div class="container">

                <div class="row">
                    <div class="col-md-6">
                        <div class="ct_hreg_wrap">
                            <div class="register_top_detail">
                                <h5>New Session Admissions Started</h5>
                                 <span>BY: School Authority</span> 
                               
                               <!--  <p>Admissions here to get online access to your </p> -->
                            </div>

                           
                            <a href="<?php echo base_url();?>home/admissionpage">Admission Information</a>
                        </div>
                    </div>
                   <div class="col-md-6 news"><h3><a href="<?php echo base_url();?>home/noticeboard">News and Updates</a>
</h3>
  <div class="container">
      <div class="row">
        <div class="centered">
          <div id="nt-example1-container" >
            
                    <ul id="nt-example1" >
                      <?php 
                        if ($bodycontent['NoticeList']) {
                          
                        foreach ($bodycontent['NoticeList'] as  $value) {
                         
                          $uplodedFolder='notice_upload';
                                $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                        ?>
                        <li><a href="<?php echo $download_link; ?>" download><?php echo $value->title; ?> </a></li>
                      
                    <?php

                        }
                      }

                    ?>
                    </ul>
                   
                </div>
        </div>
        
        
      </div>
    </div>
</div>
                </div>
            </div>
        </section>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="<?php echo base_url();?>application/web_assets/js/notice.js"></script>
      <section class="ct_birth_bg">
            <div class="container">

                <div class="row ">
      
        
 
<div class=" col-md-5 font_gallery " id="content " style="margin-left: 20px;">
  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/event1.jpg" width="200" height="150" alt="cherry blossoms">
        <p class="caption">Sports </p>
      </div>
     <!--  <div class="back">
       <a href="https://en.wikipedia.org/wiki/Cherry_blossom" target="_blank">
         <h1>Cherry blossom</h1>
       </a>
       <p class="date">23/07/1997</p>
       <p class="description">A cherry blossom is the flower of any of several trees of genus Prunus, particularly the Japanese cherry, Prunus serrulata, which is called sakura after the Japanese (桜 or 櫻; さくら).</p>
     </div> -->
    </div>
  </div>

  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/event2.jpg" width="200" height="150" alt="cherry blossoms">
        <p class="caption">Celabration</p>
      </div>
      <!-- <div class="back">
        <a href="https://en.wikipedia.org/wiki/Tulip" target="_blank">
          <h1>Tulip</h1>
        </a>
        <p class="date">14/07/2001</p>
        <p class="description">Tulips (Tulipa) form a genus of spring-blooming perennial herbaceous bulbiferous geophytes. The flowers are usually large, showy and brightly coloured, generally red, yellow, or white.</p>
      </div> -->
    </div>
  </div>

  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/event3.jpg" width="200" height="150" alt="cherry blossoms">
        <p class="caption">Culture</p>
      </div>
      <!-- <div class="back">
        <a href="https://en.wikipedia.org/wiki/Lavandula" target="_blank">
          <h1>Lavender</h1>
        </a>
        <p class="date">06/08/2004</p>
        <p class="description">Lavandula is a genus of 47 known species of flowering plants in the mint family. The most widely cultivated species is often referred to as lavender, and there is a color named for the shade of its the flowers. </p>
      </div> -->
    </div>
  </div>
  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/event4.jpg" width="200" height="150" alt="cherry blossoms">
        <p class="caption">Academy</p>
      </div>
      <!-- <div class="back">
        <a href="https://en.wikipedia.org/wiki/Lavandula" target="_blank">
          <h1>Lavender</h1>
        </a>
        <p class="date">06/08/2004</p>
        <p class="description">Lavandula is a genus of 47 known species of flowering plants in the mint family. The most widely cultivated species is often referred to as lavender, and there is a color named for the shade of its the flowers. </p>
      </div> -->
    </div>
  </div>
</div>
<?php 
$birthday=0;

if ($bodycontent['birthdayStudentListToday']) { 
  /* This block is display if birthday is availabkle*/
  ?>
    <div class="col-md-5 holder2">
        <!-- <h2>Birthday Wish</h2> -->
        <div class="col-md-6 col-sm-6 col-xs-6">
        
 <img src="<?php echo base_url();?>application/web_assets/images/1uGn.gif"  class="wish" style="padding: 0"alt="">
</div> <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="birthday">

        <ul class="main_slider">
            <?php
$arrayName = array('student_pic.png','kid1.jpg','IMG_0490.JPG');
foreach ($bodycontent['birthdayStudentListToday'] as  $value) {
    # code...

$src = base_url()."application/assets/ds-documents/admission_upload/".$value->random_file_name;
            ?>

            <li>
                <img src="<?php echo $src;?>"   alt=""><br>

          <b><h5 style="text-align: center; color: white"><?php echo $value->student_name;?><br>
                Class:<?php echo $value->class_name;?><br>
                <?php echo $diff = (date('Y') - date('Y',strtotime($value->date_of_birth)));?> Years</h5></b>
           
            </li>
<?php 


}?>
 <?php 
} else {

  ?>
    
<!-- if birthday not avialable -->
 <div class=" col-md-5 font_gallery " id="content " style="margin-left: 20px; float:right">
  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/p2.jpg" width="200" height="200" alt="">
       
      </div>
    
    </div>
  </div>

  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/p1.jpg" width="200" height="200" alt="">
       
      </div>
   
    </div>
  </div>

  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/p3.jpg" width="200" height="200" alt="">
       
      </div>
    
    </div>
  </div>
  <div class="container1 col-md-6">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo base_url();?>application/web_assets/images/p4.jpg" width="200" height="200" alt="">
       
      </div>
     
    </div>
  </div>
</div> <!-- end of birthday not avialable -->


<?php
}//end of else
?>
            <!-- <li>
                <img src="<?php echo base_url();?>application/web_assets/images/kid1.jpg"   alt=""><br>
            
                      <b> Shankha Ghosh<br>
                Class:v<br>
                10 Years</b>
               <div class="ct_banner_caption">
                   <h4 class="fadeInDown">WELCOME TO <span>EDU LEARN</span></h4>
                   <span class="fadeInDown">Learning Online is Easy Now</span>
                   <h2 class="fadeInDown">WE ARE THE BEST <br/> IN Online EDUCATION</h2>
                   <p class="fadeInDown">HELLO, ARE YOU READY TO START RIGHT NOW ?</p>
                   <a class="active fadeInDown" href="#">FIND COURSES</a>
                   <a class="fadeInDown" href="#">DISCOVER MORE</a>
               </div>
            </li>
            
                      <li>
                <img src="<?php echo base_url();?>application/web_assets/images/IMG_0490.JPG"   alt=""><br>
            
                      <b> Shankha Ghosh<br>
                Class:v<br>
                10 Years</b>
               <div class="ct_banner_caption">
                   <h4 class="fadeInDown">WELCOME TO <span>EDU LEARN</span></h4>
                   <span class="fadeInDown">Learning Online is Easy Now</span>
                   <h2 class="fadeInDown">WE ARE THE BEST <br/> IN Online EDUCATION</h2>
                   <p class="fadeInDown">HELLO, ARE YOU READY TO START RIGHT NOW ?</p>
                   <a class="active fadeInDown" href="#">FIND COURSES</a>
                   <a class="fadeInDown" href="#">DISCOVER MORE</a>
               </div>
            </li> -->
        </ul>
    </div>
        </div>
        </div> 






       </div>
       </div>
     
   
       </section>  
    <!--Content Wrap Start-->
    
        <!--Get Started Wrap Start-->
        <section>
          <div class="container">
              <div class="get_started_outer_wrap">
                <div class="row">
                        <div class="col-md-7">
                            <div class="get_started_content_wrap ct_blog_detail_des_list">
                                <h3>Sishu Bharati Vidya Mandir</h3>
                                <p>Sishu Bharati Vidya Mandir and its family dedicated to these very ideals,commits to working hand in hand with you to ensure that your child grows into the sort of citizen that your child makes every nation proud.We affirm that education and well being of a child is a joint venture between his/her parents and Academy. We seek simply not our achievers but also to render our students into good human beings with a sense of discipline and a respect for heritage.</p>
                                 <h3>Our Aim</h3>
                                <ul>
                                  <li>Develop every child’s potential</li>
                                    <li>Nurture a life-long love of learning</li>
                                    <li>Create an exciting environmen</li>
                                    <li>Ensure self esteem and confidence are high</li>
                                    <li>Provide opportunities that challenge</li>
                                </ul>
                            </div>
                        </div>
                    
                        <div class="col-md-5">
                            <div class="get_started_video">
                                <img src="<?php echo base_url();?>application/web_assets/images/about_school.jpg" alt="">
                                <!-- <div class="get_video_icon">
                                   
                                </div> -->
                            </div>
                        </div>
                  </div>
                </div>
                
                <!-- <div class="row">
                  <div class="col-md-6 col-sm-6">
                      <div class="get_started_services">
                          <div class="get_started_icon">
                              <i class="fa fa-paper-plane-o"></i>
                            </div>
                            <div class="get_icon_des">
                              <h5>OUR MISSION</h5>
                                <p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.</p>
                                <a href="#">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="get_started_services">
                          <div class="get_started_icon">
                              <i class="fa fa-bookmark-o"></i>
                            </div>
                            <div class="get_icon_des">
                              <h5>OUR VISSION</h5>
                                <p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.</p>
                                <a href="#">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div> -->
                
            </div>
        </section>
        <!--Get Started Wrap End-->

        
        <!--Courses By Subject Wrap Start-->
        <section class="ct_courses_subject_bg">
          <div class="container">
              <!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap ct_white_hdg">
                  <h3>Activities Offered</h3>
                    <span><img src="<?php echo base_url();?>application/web_assets/images/logo.png" width="40" height="40" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Courses Subject List Wrap Start-->
                <div class="courses_subject_carousel owl-carousel">
                  <div class="item">
                        <div class="course_subject_wrap ct_bg_1 ">
                            <i class="fa fa-music"></i>
                            <div class="course_subject_des">
                                <p>Dance & Music </p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_2">
                            <i class="fa fa-users"></i>
                            <div class="course_subject_des">
                                <p>Drama</p>
                            </div>
                        </div>
                    </div>
                  <!-- 
                    <div class="item">
                      <div class="course_subject_wrap ct_bg_3">
                          <i class="fa fa-briefcase"></i>
                          <div class="course_subject_des">
                              <p>Music</p>
                          </div>
                      </div>
                  </div> -->
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_4">
                            <i class="fa fa-question"></i>
                            <div class="course_subject_des">
                                <p>Quizzing</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_5">
                           <i class="fa fa-paint-brush"></i>
                            <div class="course_subject_des">
                                <p>Art & Craft</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_6">
                            <i class="fas fa-soccer-ball-o"></i>
                            <div class="course_subject_des">
                                <p>Sports</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_1">
                            <i class="fas fa-walking"></i>
                            <div class="course_subject_des">
                                <p>Karate</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="course_subject_wrap ct_bg_2">
                            <i class="fa fa-child"></i>
                            <div class="course_subject_des">
                                <p>Yoga</p>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <!--Courses Subject List Wrap End-->
            </div>
        </section>
        <!--Courses By Subject Wrap End-->
        
       
        <!--Register Now Wrap Start-->
       
        <!--Register Now Wrap End-->
        <!-- <section class="ct_menu_bg">
            <div class="container">
        <div class="row">
        <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
          <img src="<?php echo base_url();?>application/web_assets/images/id-card.png" width="100" height="100" class="option_img"> 
            
            <h3>Admission</h3> 
              
            </div>
            <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
              <img src="<?php echo base_url();?>application/web_assets/images/ereader-1.png" width="100" height="100" class="option_img" >
            
            <h3>Importent Info</h3> 
            
            </div>
            <div class="adminhome1 col-md-3 col-sm-4 col-xs-3 ">
             
           <img src="<?php echo base_url();?>application/web_assets/images/desktop.png" width="100" height="100" class="option_img" >
            <h3>Online Payment </h3> 
              
            </div>
            <div class=" adminhome1 col-md-3 col-sm-4 col-xs-3">
            <img src="<?php echo base_url();?>application/web_assets/images/laptop.png" width="100" height="100"  class="option_img" >
            
            <h3>News & Event</h3> 
            
            </div> 
        
            <div class=" adminhome1 col-md-3 col-sm-4 col-xs-3 ">
            <img src="<?php echo base_url();?>application/web_assets/images/acoustic-guitar.png" width="100" height="100" class="option_img" >
            <h3>Photo Gallery</h3> 
            
            </div> 
        
           
            
           
            
        
          </div>
              </div>
          </section> -->
        <!--Our Teacher Wrap Start-->
        
        <!--Our Teacher Wrap End-->
        
        <!--Figures & Facts Wrap Start-->
        <section class="ct_facts_bg">
            <ul>
                <li>
                    <i class="fa fa-user"></i>
                    <h2 class="counter">25</h2>
                    <span>Certified Teachers</span>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <h2 class="counter">1100</h2>
                    <span>Students Enrolled</span>
                </li>
                <li>
                    <i class="fas fa-award"></i>
                    <h2 class="counter">43</h2>
                    <span>Student Awards</span>
                </li>
                <li>
                   <i class="fas fa-graduation-cap"></i>
                    <h2 class="counter">14</h2>
                    <span>Academic exprience years</span>
                </li>
            </ul>
        </section>
        <!--Figures & Facts Wrap End-->
        
                <!--Our Events Wrap Start-->
        <section class="event_bg">
          <div class="container">
              <!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                  <h3>Our Upcomming Events</h3>
                    <!-- <p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec <br/>tetuer adipis elit, aliquam eget nibh etlibura.</p> -->
                    <span><img src="<?php echo base_url();?>application/web_assets/images/logo.png" width="40" height="40" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Event List Wrap Start-->
                <div class="row">
                  <!-- <div class="col-md-6">
                                            <div class="ct_main_event_wrap">
                                                <h4>Independence day Celabration</h4>
                                                <h5>Event Date is : <span>15 August</span></h5>
                                                <ul class="countdown">
                                                    <li>
                                                        <span class="days">00</span>
                                                        <p class="days_ref">days</p>
                                                    </li>
                                                    <li>
                                                        <span class="hours">00</span>
                                                        <p class="hours_ref">hours</p>
                                                    </li>
                                                    <li>
                                                        <span class="minutes">00</span>
                                                        <p class="minutes_ref">min</p>
                                                    </li>
                                                    <li>
                                                        <span class="seconds last">00</span>
                                                        <p class="seconds_ref">sec</p>
                                                    </li>
                                                </ul>
                                                <ul class="event_location_list">
                                                    <li><i class="fa fa-map-marker"></i></li>
                                                    <li><i class="fa fa-map-marker"></i></li>
                                                </ul>
                                            </div>
                                        </div> -->
                    
                    <div class="col-md-12">
                      <div class="row">
                        <?php
                              if ($bodycontent['EventsList']) {
                                foreach ($bodycontent['EventsList'] as $value) { 
                             
                        ?>
                          <div class="col-md-3">
                              <div class=" sub_event_wrap" >
                                  <h6><a href="<?php echo base_url();?>home/eventupdate"><?php echo $value->title; ?></a></h6>
                                    <span><i class="fa fa-clock-o"></i><?php echo $value->event_time; ?>, <?php echo date("d M Y", strtotime($value->event_date));?></span>
                                    <span><i class="fa fa-map-marker"></i><?php echo $value->event_place; ?></span>
                                </div>
                            </div>

                            <?php

                          }
                              }else{
                               echo "<h3><center> Upcomming Event Details Comming soon...</center></h3>";
                              }
                        ?>

                            
                          
                            
                          
                            
                         
                        </div>
                    </div>
                    
                </div>
                <!--Event List Wrap End-->
                
            </div>
        </section>
        <!--Our Events Wrap End-->
        
        <!--Testimonial Wrap Start-->
        
        <!--Testimonial Wrap End-->
        
        <!--Learn More Wrap Start-->
        <!-- <div class="ct_learn_more_bg">
          <div class="container">
              <div class="ct_learn_more">
                  <h4>We provide universal access to the world’s best <span>education.</span></h4>
                    <a href="#">Learn More</a>
                </div>
            </div>
        </div> -->
        <!--Learn More Wrap End-->
        
        <!-- Latest News Wrap Start
        <section class="ct_blog_simple_bg">
            <div class="container">
                Heading Style 1 Wrap Start
                <div class="ct_heading_1_wrap">
                    <h3>Our News</h3>
                    <p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec <br/>tetuer adipis elit, aliquam eget nibh etlibura.</p>
                    <span><img src="images/hdg-01.png" alt=""></span>
                </div>
                Heading Style 1 Wrap End
                
                Latest News Wrap Start
                <div class="row">
                    <div class="col-md-4">
                        <div class="ct_news_wrap">
                            <span>2015-10-08</span>
                            <h5><a href="#">Those Other College Expenses You Aren’t Thinking</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="news_img">
                                <img src="https://placeholdit.imgix.net/~text?txtsize=16&txt=30%C3%9730&w=30&h=30" alt="">
                                <label>John Snow</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ct_news_wrap">
                            <span>2015-10-08</span>
                            <h5><a href="#">Those Other College Expenses You Aren’t Thinking</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="news_img">
                                <img src="https://placeholdit.imgix.net/~text?txtsize=16&txt=30%C3%9730&w=30&h=30" alt="">
                                <label>John Snow</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ct_news_wrap">
                            <span>2015-10-08</span>
                            <h5><a href="#">Those Other College Expenses You Aren’t Thinking</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="news_img">
                                <img src="https://placeholdit.imgix.net/~text?txtsize=16&txt=30%C3%9730&w=30&h=30" alt="">
                                <label>John Snow</label>
                            </div>
                        </div>
                    </div>
                </div>
                Latest News Wrap End
            </div>
        </section> -->
        <!--Latest News Wrap End-->
    </div>
    <!--Content Wrap End-->
    
   
