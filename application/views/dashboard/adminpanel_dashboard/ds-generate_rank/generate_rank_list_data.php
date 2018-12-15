    <div class="datatalberes" style="overflow-x:auto;">
        <?php
              $attr = array("id"=>"GeneratedRankDataForm","name"=>"GeneratedRankDataForm");
              echo form_open('',$attr); ?>

                <input type="hidden" name="sel_class" value="<?php echo $selectclass;?>">
                <input type="hidden" name="rankmasterID" value="0">
                <input type="hidden" name="mode" value="ADD">
                <p style="color:red;text-align:center;">Note: Add first, second, third term marks, special marks before Save Rank  </p>
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>First Term </th>
                  <th>Second Term</th>
                  <th>Third Term</th>
                  <th>Special Marks</th>
                  <th>Grand Total</th>
                  <th>Rank</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $rank=1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <input type="hidden" name="student_uniq_id[]" value="<?php echo $value->student_uniq_id;?>">
            <input type="hidden" name="studentname[]" value="<?php echo $value->name;?>">
            <input type="hidden" name="academic_id[]" value="<?php echo $value->academic_id;?>">
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo $value->class_roll; ?>
            <input type="hidden" name="class_roll[]" value="<?php echo $value->class_roll;?>">
            <input type="hidden" name="rank[]" value="<?php echo $rank;?>">
            </td>
            <td><?php echo $value->first_term_total; ?></td>
            <td><?php echo $value->second_term_total; ?></td>
            <td><?php echo $value->third_term_total; ?></td>
            <td><?php echo $value->special_marks; ?></td>
            <td><?php echo $value->grand_total; ?></td>
            <input type="hidden" name="grand_total[]" value="<?php echo $value->grand_total;?>">
            <td style="font-weight: bold;font-weight: bold;color: #0e4e8c;font-size: 16px;"><?php echo $rank++;?></td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
               <div class="response_msg" id="ranksave_response_msg">
              <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary formBtn" id="saverank">Save Rank</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

             <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Save Rank</span>
            <br>
            </div>