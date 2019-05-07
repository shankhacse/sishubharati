
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentdashboard.js"></script>
<div class="panel panel-primary">
      <div class="panel-heading">
                            Payment List                     </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">
                 <table class="table table-bordered table-striped " style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                 <!--  <th>Student ID</th>
                 <th>Bill No</th>
                 <th>Name</th>
                 <th>Class</th> -->
                  <th>Payment Date</th>
                  <th>Payment For</th>
                  <th>For Month</th>
                 
                  <th>Amount</th>
                  <th>Fine</th>
                  <th>Total</th>
                  <th width="10%">Print</th>
                  
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
            <!-- <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->bill_no; ?></td>
            <td><?php echo $value->student_name; ?></td> 
            <td><?php echo $value->class_name; ?></td> -->
            <td><?php echo date("d M Y", strtotime($value->payment_dt));?></td>
            <td><?php  
                    if ($value->payment_for=='ADM') {
                      echo "Admission Fee";
                    }elseif ($value->payment_for=='SES') {
                      echo "Session Fee";
                    }elseif ($value->payment_for=='MON') {
                      echo "Monthly Tution";
                    }
            ?></td>
            <td><?php echo $value->for_month; ?></td>
            
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

           <?php 
                 // echo $value->total_amt;

         }?>
              
             

            </td>
             <td>
             <a href="<?php echo base_url(); ?>studentdashboard/printPaymentReceipt/<?php echo $value->payment_master_id; ?>" class="btn btn-primary btn-xs" data-title="Pdf" target="_blank" >
                <span class="glyphicon glyphicon-print"></span>
              </a> 
                         </td> 
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

            </div>

 </div><!-- end of panel div-->



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