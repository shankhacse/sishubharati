
    <div class="datatalberes" style="overflow-x:auto;">
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
                  <!-- <th width="10%">Action</th> -->
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($paymentList as $value) {

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
                      echo "Monthly Tution";
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
             <!--   <td>
              <button type="button" class="btn btn-sm btn-warning ViewTutionMakePayment" data-toggle="modal" data-target="#makepaymenttution_info" 
              data-studentid="<?php echo $value->student_uniq_id;?>" 
              data-academicid="<?php echo $value->academic_id;?>" 
              data-classname="<?php echo $value->class_name;?>" 
              data-classroll="<?php echo $value->class_roll;?>" 
              data-mode ="MONFEE" 
              data-studentname="<?php echo $value->name; ?>" >Make Payment </button> 
                         </td> -->
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

            </div>