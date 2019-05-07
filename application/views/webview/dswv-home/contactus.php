   <!-- jQuery -->
  <script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/jquery/dist/jquery.min.js"></script>
 <script src="<?php echo base_url();?>application/web_assets/js/home.js"></script>
 
<!--Wrapper Start-->  
<div class="ct_wrapper">
	
    <!--Header Wrap Start-->
    
    
    <!--Banner Wrap Start-->
    <section class="sub_banner_wrap">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6">
                	<div class="sub_banner_hdg">
                    	<h3>Contact Us</h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
    <!--Banner Wrap End-->
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
        <!--Map Wrap Start--><br>
       <div class="col-md-10 col-md-offset-1 map-canvas gt_contact_us_map" id="map_container">
             <div id="map"></div>
        </div>
        <!--Map Wrap End-->
        
     
        <!--Get in Touch With Us Wrap Start-->
        <section>
        	<div class="container">
            	<div class="get_touch_wrap">
                	<h4>GET IN TOUCH WITH US:</h4>
                   <!--  <p>We are home to 1,500 students (aged 12 to 16) and 100 expert faculty and staff community representing over 40 different nations. We are proud of our international and multi-cultural ethos, the way our community collaborates to make a difference. Our world-renowned curriculum is built on the best.</p> -->
                </div>
                 <?php 
              $attr = array("id"=>"contactForm","name"=>"contactForm");
              echo form_open('',$attr); ?>
               <input type="hidden" id="baseurl" value="<?php echo base_url(); ?>"/>
                <div class="row">
                	<div class="col-md-6">
                    	<div class="ct_contact_form">
                        	<form>
                            	<div class="form_field">
                                	<label class="fa fa-user"></label>
                                	<input class="conatct_plchldr" type="text" placeholder="Your Name" name="conpername" required>
                                </div>
                                <div class="form_field">
                                	<label class="fa fa-envelope-o"></label>
                                	<input class="conatct_plchldr" type="text" name="conemail" placeholder="Email Address">
                                </div>

                                 <div class="form_field">
                                    <label class="fa fa-phone"></label>
                                    <input class="conatct_plchldr" type="text" name="conphone" placeholder="Phone Number" required>
                                </div>
                                <div class="form_field">
                                	<label class="fa fa-edit"></label>
                                	<textarea class="conatct_plchldr" placeholder="Write Detail" name="message" required></textarea>
                                </div>
                                <div class="form_field">
                                	<button type="submit" >Send Now <i class="fa fa-arrow-right" id="contactmessage" ></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
						<div class="bottom_border">
							<div class="row">
								<div class="col-md-6">
									<div class="ct_contact_address">
										<h5><i class="fa fa-map-o"></i>Address</h5>
										<p>PANDAVESWAR :: BURDWAN<br>

BEHIND OF PANDAVESWAR HEALTH CENTER<br>
AND NEAR AJOY PETROL PUMP</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ct_contact_address">
										<h5><i class="fa fa-envelope-o"></i>Contact & Email</h5>
										<ul class="fax_info">
											<li>+91-9733069624</li>
											<li>+91-9333986937</li>
										</ul>
										<p>asimsbbm@gmail.com</p>
									</div>
								</div>
							</div>
						</div>
						
                       
                    </div>
                    
                </div>
            </div>
        </section>
        <!--Get in Touch With Us Wrap End-->
       <?php echo form_close(); ?> 
        
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->


<!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <p id="save-msg-data"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload();">Close</button>
      </div>
    </div>

  </div>
</div>
    