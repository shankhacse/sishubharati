<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/paymentsummery.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  

   

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Summary</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment Summary</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"paymentSummeryForm","name"=>"paymentSummeryForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> From Date </label> </div>
            <div class="col-md-2">
                      <div class="form-group">
                     
                     <input class="form-control pull-right datepicker" id="fromdt" name="fromdt" type="text" autocomplete="off">
                      
                        </div>
                 
                  </div>
                  <div class="col-md-1 "><label for="classList" class="searchby"> To Date </label> </div>
                  <div class="col-md-2">
                      <div class="form-group">
                     
                     <input class="form-control pull-right datepicker" id="todt" name="todt" type="text" autocomplete="off" >
                      
                        </div>
                 
                  </div>
                 
             
                </div>

               <div><br></div>
            
            
            <p id="paysummsg" class="form_error"></p>
                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary" id="viewpaymentlist">View Payments</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadPaymentList"> 
            

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





