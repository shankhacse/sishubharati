 <div><?php
  $attr = array("id"=>"PaymentPaperUploadForm","name"=>"PaymentPaperUploadForm");
              echo form_open('',$attr); ?>
 <table class="table table-bordered table-striped" style="border-collapse: collapse !important;">
              <thead>
                <th width="25%" ></th>
                <th width="25%"></th>
                <th width="25%" style="font-weight: bold;"></th>
                <th width="25%"></th>
                
              </thead>
                <tbody>
                    <tr><td>Student Name@</td><td><?php echo $studentname;?></td>
                      <td>Student ID</td><td><?php echo $studentID;?></td> </tr>
                    <tr><td>Class</td><td><?php echo $classname;?></td> 
                      <td>Roll</td><td><?php echo $classroll;?></td></tr>
                  <tr><td colspan="2">Payment For Term</td><td colspan="2" style="text-transform: capitalize;">
                      <?php echo $term;?>
                    </td> </tr>

                    <tr><td colspan="2">Payment Date</td><td colspan="2">
              <input class="form-control pull-right datepicker" id="payment_dt" name="payment_dt" type="text" value="">
              <input  id="term" name="term" type="hidden" value="<?php echo $term;?>">
                    </td> </tr>
                <tr><td>Any Note:</td><td colspan="3">
              <input class="form-control pull-right " id="note" name="note" type="text" value="">
                    </td> </tr>
                 
                </tbody>
              </table>
   <input type="hidden" name="academicid" id="academicid" value="<?php echo $academicid; ?>" />
     <table class="table table-bordered" style="border-collapse: collapse !important;">
              <thead>
                <th width="5%">SL</th>
                <th width="75%">Particulars with Naration</th>
                <th width="20%"  >Amount Rs.</th>
              </thead>
                <tbody>
                    <?php
                          $totalamount=0;
                          $sl=1;
                          foreach ($uploadFeeList as $value) {
                          $totalamount=$totalamount+$value->amount;
                        
                     ?>
                    <tr>
                      <td><?php echo $sl++;?></td>
                      <td><?php echo 'Exam Paper Digital Copy Fee';?></td>
                      <td style="text-align:right;"><?php echo $value->amount;?></td>
                      <input type="hidden" name="upload_fee" id="upload_fee" value="<?php echo $value->amount;?>" /> 
                    </tr>
                    <?php 
                      }

                    ?>

                 <tr style="background-color: #e2e2e2;font-weight: bold;">
                   <td></td><td>Total Amount</td><td style="text-align:right;" id="total_amt"> <?php echo number_format($totalamount,2);?></td>
                 </tr>
                </tbody>
              </table>
            <p id="paperuploadpaymsg" class="form_error"></p>
             <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="paperpaysavebtn">Save Payment</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                      <br>
                   
                  </div>

            <?php echo form_close(); ?>

</div>