<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/paymentsummery.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 

   

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment Report</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"paymentReportForm","name"=>"paymentReportForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-1 "><label for="classList" class="searchby"> From Date </label> </div>
            <div class="col-md-2">
                      <div class="form-group">
                     
                     <input class="form-control pull-right datepicker" id="fromdt" name="fromdt" type="text" autocomplete="off" value="<?php echo $bodycontent['startDt'];?>">
                      
                        </div>
                 
                  </div>
                  <div class="col-md-1 "><label for="classList" class="searchby"> To Date </label> </div>
                  <div class="col-md-2">
                      <div class="form-group">
                     
                     <input class="form-control pull-right datepicker" id="todt" name="todt" type="text" autocomplete="off"  value="<?php echo $bodycontent['endDt'];?>">
                      
                        </div>
                 
                  </div>
                    <div class="col-md-1 "><label for="classList" class="searchby"> Payment Type </label> </div>
                       <div class="col-md-2">
                      <div class="form-group">
                     
                     
                       <select id="payment_type" name="payment_type" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                        <option value="ALL">Select</option>
                        <option value="ADM">Asmission</option>
                        <option value="SES">Session</option>
                        <option value="MON">Tuition</option>
                        <option value="PUB">Paper Upload</option>
                        <option value="FINE">Fine</option>
                        </select>
                        </div>
                 
                  </div>

                  <div class=" col-md-2 btnview">
              <button type="submit" class="btn btn-primary" id="viewpaymentlist">View Payments</button>
              </div>
                 
             
                </div>

               <div><br></div>
            
            
            <p id="paysummsg" class="form_error"></p>
                <!--  <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary" id="viewpaymentlist">View Payments</button>
              </div>
                 </div> -->
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadPaymentReport"> 
            

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





