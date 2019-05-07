
<script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 
<section class="about_us_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub_banner_hdg">
                        <h3>About Us</h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>




<section class="history_warp">
        	<div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="get_started_content_wrap ct_blog_detail_des_list">
                            <div class="about_text">
                            <h3>OUR HISTORY</h3>
                           <p><?php echo $bodycontent['aboutUsData']->history;?></p>
                            
                        </div>
                        </div>
                    </div>
                
                    <div class="col-md-6" style="margin-top: 85px;">
                        <img src="<?php echo base_url();?>application/web_assets/images/history.jpg" alt="">
                </div>
            </div>
        </section>




        <section class="mission_warp">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <img src="<?php echo base_url();?>application/web_assets/images/mission.jpg" alt="">
                </div>
                    <div class="col-md-6">
                        <div class="get_started_content_wrap ct_blog_detail_des_list">
                            <div class="about_text">
                            <h3>OUR MISSION</h3>
                           <p><?php echo $bodycontent['aboutUsData']->mission;?></p>
                            
                        </div>
                        </div>
                    </div>
                
                    
            </div>
        </section>



        <section class="vision_warp">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="get_started_content_wrap ct_blog_detail_des_list">
                            <div class="about_text">
                            <h3>OUR VISION</h3>
                           <p><?php echo $bodycontent['aboutUsData']->vision;?></p>
                            
                        </div>
                    </div>
                    </div>
                
                    <div class="col-md-6">
                        <img src="<?php echo base_url();?>application/web_assets/images/vision.jpg" alt="">
                </div>
            </div>
        </section>


        <section class="about_us_warp_img">
<div class="container">
                
                    <div class="about_warp_banner">
                        <h2>SISHU BHARATI VIDYAMANDIR</h2>      
                        
                    </div>
                    
                </div>
            
        </section>


        <div class="ct_content_wrap">
        <section class="teacher_bg">

            <div class="ct_heading_1_wrap">
                    <h3>Our Teachers</h3>
                    <!-- <p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consec <br/>tetuer adipis elit, aliquam eget nibh etlibura.</p> -->
                    <span><img src="images/hdg-01.png" alt=""></span>
                </div>
            <div class="container">
                <div class="row">
                    <?php if($bodycontent['teacherList']){
                        foreach ($bodycontent['teacherList'] as $key => $value) {

          $uplodedFolder='teacher_upload';
        if ($value->is_file_uploaded=='Y') {
           $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
        }else{
           $download_link=base_url()."application/assets/images/blank-avatar.jpg";
        }
                           
                       
                      ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="ct_teacher_outer_wrap">
                            <figure>
                                <img alt="" src="<?php echo $download_link; ?>" style="max-height: 260px;" >
                            </figure>
                            <div class="ct_teacher_wrap" style="padding: 9px 15px;">
                                <h5><a href="#"><?php echo $value->name; ?></a></h5>
                                <span><?php echo $value->subject; ?></span>
                                
                            </div>
                        </div>
                    </div>
                <?php } }?>
              
               
             
             
                 
               
                   
                </div>
            </div>
        </section>
        
    </div>