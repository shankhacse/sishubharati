    <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:20%;">Student ID</th>
                  <th style="width:20%;">Name</th>
                  <th style="width:10%;">Class</th>
                  <th style="width:10%;">Roll</th>
                  <th style="width:10%;">Gender</th>
                  <th style="width:10%;">DOB</th>
                  <th style="width:10%;">Reset Password</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $row=1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo $value->class_roll; ?></td>
               <td><?php 
                if ($value->gender=="M") {
                   echo "Male";
                 }elseif ($value->gender=="F") {
                   echo "Female";
                 } ?>
                   
                 </td>
            <td><?php echo date("Y-m-d", strtotime($value->date_of_birth));?></td>
            <td>
              <div class="status_dv" id="reset_request_<?php echo $row;?>">
                <span class="label label-danger status_tag passreset" data-setstatus="1" 
                      data-studentid="<?php echo $value->student_id;?>"
                      data-defaultpass="<?php echo date("Y-m-d", strtotime($value->date_of_birth));?>"
                      data-rowid="<?php echo $row;?>"
                      ><span class="glyphicon glyphicon-send"></span> Reset Password </span>

                </div>

                <div class="status_dv" id="reset_done_<?php echo $row;?>" style="display:none;"
                  >
                <span class="label label-success status_tag passreset" data-setstatus="1" 
                      data-studentid="<?php echo $value->student_id;?>"
                      data-defaultpass="<?php echo date("Y-m-d", strtotime($value->date_of_birth));?>"
                      data-rowid="<?php echo $row;?>"
                      ><span class="glyphicon glyphicon-ok"></span> Reset Password</span>

                </div>
                
            <img id="loading_<?php echo $row;?>" src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:none;width: 20px;" />
          
           
            </td>
           
           
         
          </tr>
                    
                <?php $row++;
                  }

                ?>
             
                </tbody>
               
              </table>
            </div>