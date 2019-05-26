<hr>
    <div class="datatalberes"  style="overflow-x:auto;">
              <table  class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead style="background-color: #cd558e;color: #fff;">
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:10%;">Student ID</th>
                  <th style="width:10%;">Bill No</th>
                  <th style="width:10%;">Payment Date</th>
                  <th style="width:10%;">Payment For</th>
                  <th style="width:5%;">For Month</th>
                 
                  <th style="width:10%;">Fine Amount</th>
               
                 
                  
                </tr>
                </thead>
                <tbody style="color: rebeccapurple;">
               
                <?php 
                  $i = 1;
                  $row=1;
                  $total_fine_amount=0;
                  foreach ($paymentList as $key => $value) {

                $total_fine_amount+=$value->fine_amount;

                  if ($value->fine_amount!='0') {
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->bill_no; ?></td>
            <td><?php echo date("d-m-Y",strtotime($value->payment_dt)); ?></td>
            <td><?php 

            if($value->payment_for=='ADM'){
              echo "Admission Fee";
            }elseif ($value->payment_for=='SES') {
              echo "Session Fee";
            }elseif ($value->payment_for=='MON') {
              echo "Tuition Fee";
            }elseif ($value->payment_for=='PUB') {
              echo "Paper Upload Fee";
            }

            ?></td>
            <td><?php echo $value->for_month; ?></td>
           
            <td align="right"><?php 
            if ($value->fine_amount!='0') {
              echo $value->fine_amount;
            }

             ?></td>
          
       

               
           
           
         
          </tr>
                    
                <?php $row++;
              }
                  }

                ?>

                 <tfoot>
            <tr style="font-weight: bold;font-size: 18px;    background-color: #e1dada;color: #274aad;">
                <th colspan="4" style="text-align:right">Total Fine Amount:</th>
                <th></th>
                <th></th>
                <th  style="text-align:right"><?php echo number_format($total_fine_amount,2);?></th>
            </tr>
        </tfoot>
         
                </tbody>
               
              </table>
            </div>