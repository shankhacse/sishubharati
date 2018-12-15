      <?php
              $attr = array("id"=>"ResetRollData","name"=>"ResetRollData");
              echo form_open('',$attr); ?>
    <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:20%;">Student ID</th>
                  <th style="width:20%;">Name</th>
                  <th style="width:10%;">Class</th>
                  <th style="width:10%;">Old Roll</th>
                  <th style="width:10%;">New Roll</th>
                  <th style="width:10%;">Rank</th>
                  <th style="width:10%;">Payment</th>
                  
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $row=1;
                  $newroll=1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td style="font-weight: bold;color: #de741a;"><?php echo $value->class_roll; ?></td>
              
            <td style="font-weight: bold;" >
              <input type="hidden" name="academic_id[]" value="<?php echo $value->academic_id; ?>">
              <input type="hidden" name="newroll[]" value="<?php echo $newroll; ?>">
              <?php echo $newroll; ?>
            </td>
            <td style="font-weight: bold;color: #124bbf;"><?php echo $value->rank; ?></td>
            
            <td style="font-weight: bold;color: #6abc1e;"><?php 

            if ($value->aca_fee_payment=='Y') {
              echo "Paid";
            }else{
              echo "Not Paid";
            }
            
            ?></td>
           
         
          </tr>
                    
                <?php $row++;$newroll++;
                  }

                ?>
             
                </tbody>
               
              </table>
            <div class="response_msg" id="updroll_response_msg">

                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary" id="updroll">Update New Roll</button>
              </div>
                 </div>
            
        
              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            </div>

             <?php echo form_close(); ?>