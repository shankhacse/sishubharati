 <style type="text/css">
  .login_bgs{
background-image: linear-gradient(
        to right bottom, 
        rgba(126, 13, 111, 0.8), 
        rgba(40, 180, 131, 0.8)), 
        url(https://images.pexels.com/photos/808510/pexels-photo-808510.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
    background-size: cover; /* Fit by window size */
    background-position: center; /* Which side will stay after resize */
    background-attachment: fixed;
   
}
 </style>


 <script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 

   <section class="login_bgs">
            <div class="row">
                  <div class="col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 login_box">
                       <h1>Student/Parents Login</h1><br><br>
                      <div class="ct_contact_form">

                          <form>
                              <div class="form_field">
                                  <label class="fa fa-user"></label>
                                  <input class="conatct_plchldr" type="text" placeholder="Student ID">
                                </div>
                                <div class="form_field">
                                  <label class="fa fa-lock"></label>
                                  <input class="conatct_plchldr" type="password" placeholder="Password">
                                </div>
                                
                                <div class="login_field">
                                  <button class="login_btn">Login</button>


                                </div>
<a class="txt_login" href="#">
             Forget Password       
            </a>
                            </form>
                        </div>
                    </div>

                  </div>

</section>
                   