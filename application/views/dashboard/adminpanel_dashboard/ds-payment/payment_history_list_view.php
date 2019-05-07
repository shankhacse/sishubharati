<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/payment.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
    <style>
   
    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment History of Student </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment History of Student</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"PaymentHistoryForm","name"=>"PaymentHistoryForm");
              echo form_open('',$attr); ?>
                <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby">Search By </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_type_searchby" name="sel_type_searchby" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                        <option value="SID">Student ID</option>
                        <option value="SNAME">Student Name</option>
                       
                        </select>
                        </div>
                 
                  </div>
             
                </div>
              <div class="row scbyname">
            <div class="col-md-4 "><label for="classList" class="searchby"> Class </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_classpayhis" name="sel_classpayhis" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['classList'])
                            {
                              foreach($bodycontent['classList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
             <div class="row scbyname">
            <div class="col-md-4 "><label for="classList" class="searchby">Student </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     <div id="student_viewph">
                       <select id="sel_student" name="sel_student" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                        
                        </select>
                        </div>
                        </div>
                 
                  </div>
             
                </div>
            <div class="row scbyid">
            <div class="col-md-4 "><label for="classList" class="searchby"> Student ID </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                         <select id="sel_student_id" name="sel_student_id" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['StudentIdList'])
                            {
                              foreach($bodycontent['StudentIdList'] as $value)
                              { ?>
                    <option value="<?php echo $value->academic_id; ?>"><?php echo $value->student_uniq_id ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>

 <?php
  $curr_dt = date('d/m/Y');   
    
?>              
              <div class="row scbyid">
                      <div class="col-md-4 "><label for="classList" class="searchby">Payment Date </label> </div>
                      <div class="col-md-4">
                                <div class="form-group">
                             <input type="text" id="datepickeratt" class="form-control custom_frm_input"  name="attendance_date"  placeholder="" value="<?php echo $curr_dt;?>" />   
                                  </div>

                                   
                           
                      </div>
                </div>
                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary ">View</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadStudentPaymentHistory"> 


               <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Bill No</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Payment Date</th>
                  <th>Payment For</th>
                  <th>For Month</th>
                  <th>Note</th>
                  <th>Amount</th>
                  <th>Fine</th>
                  <th>Total</th>
                  <th>Print</th> 
                  <th>Entry By</th> 
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($bodycontent['paymentList'] as $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->bill_no; ?></td>
            <td><?php echo $value->student_name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo date("d M Y", strtotime($value->payment_dt));?></td>
            <td><?php  
                    if ($value->payment_for=='ADM') {
                      echo "Admission Fee";
                    }elseif ($value->payment_for=='SES') {
                      echo "Session Fee";
                    }elseif ($value->payment_for=='MON') {
                      echo "Monthly Tuition";
                    }elseif ($value->payment_for=='PUB') {
                      echo "Exam Paper Fee (".$value->for_term." term)";
                    }
            ?></td>
            <td><?php echo $value->for_month; ?></td>
            <td><?php echo $value->note; ?></td>
            <td style="text-align:right;"><?php echo $value->amount; ?></td>
            <td style="text-align:right;"><?php
                  if ($value->fine_amount>0) {
                   echo $value->fine_amount;
                  }
              ?></td>
            <td style="text-align:right;"><?php 
            if ($value->payment_for=='MON') {
              echo $value->total_amt;
            }else{?>
              <a class="viewPaymentDtlData"
              href="javascript:;" 
              data-toggle="modal" 
              data-paymentid="<?php echo $value->payment_master_id; ?>"
              data-paymentfor="<?php echo $value->payment_for; ?>"
              data-billno="<?php echo $value->bill_no; ?>"
              data-target="#paymenyhistory_info" ><?php echo $value->total_amt;?></a>
           <?php }?>
              
             

            </td>
             <td>
             <a href="<?php echo base_url(); ?>payment/printPaymentReceipt/<?php echo $value->payment_master_id; ?>" class="btn btn-primary btn-xs" data-title="Pdf" target="_blank" >
                <span class="glyphicon glyphicon-print"></span>
              </a> 
                         </td> 
              <td><?php echo $value->username; ?></td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
              

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->







      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="paymenyhistory_info" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="title_info"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" >Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>



<!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <p id="save-msg-data"></p>
      </div>
      <div class="modal-footer">

   <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" onclick="return redirectMe();">Close</button>
    
      </div>
    </div>

  </div>
</div>


