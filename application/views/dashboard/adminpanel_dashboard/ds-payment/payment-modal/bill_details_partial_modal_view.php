 <div><?php
  $attr = array("id"=>"PaymentSessionForm","name"=>"PaymentSessionForm");
              echo form_open('',$attr); ?>
 
<button type="button" class="btn-xs bg-primary margin"><?php echo "Student ID : ".$student_uniq_id; ?></button>
<button type="button" class="btn-xs bg-purple margin" style="float:right;"><?php echo "Bill No : ".$billno; ?></button>
     <table class="table table-bordered dataTables" style="border-collapse: collapse !important;">
              <thead>
                <th width="5%">SL</th>
                <th width="75%">Particulars with Naration</th>
                <th width="20%"  >Amount Rs.</th>
              </thead>
                <tbody>
                    <?php
                          $totalamount=0;
                          $sl=1;
                          foreach ($billDetails as $value) {
                          $totalamount=$totalamount+$value->amount;
                        
                     ?>
                    <tr>
                      <td><?php echo $sl++;?></td>
                      <td><?php echo $value->payment_desc;?></td>
                      <td style="text-align:right;"><?php echo $value->amount;?></td> 
                    </tr>
                    <?php 
                      }

                    ?>
                 <tr style="background-color: #e2e2e2;font-weight: bold;">
                   <td></td><td>Total Amount</td><td style="text-align:right;"><?php echo number_format($totalamount,2);?></td>
                 </tr>
                </tbody>
              </table>
            <p id="sespaymsg" class="form_error"></p>
        

            <?php echo form_close(); ?>

</div>
