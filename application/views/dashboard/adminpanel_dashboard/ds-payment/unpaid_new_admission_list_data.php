
    <div class="datatalberes" style="overflow-x:auto;">
                 <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>Father Name</th>
                  <th>Admission</th>
                  <th width="10%">Action</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($unpaidStudentList as $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo $value->class_roll; ?></td>
            <td><?php echo $value->father_name; ?></td>
            <td><?php echo date("d M Y", strtotime($value->admission_dt));?></td>
               <td>
                <button type="button" class="btn btn-sm btn-danger ViewAdmMakePayment" data-toggle="modal" data-target="#makepayment_info" 
                data-studentid="<?php echo $value->student_uniq_id;?>" 
                data-academicid="<?php echo $value->academic_id;?>" 
                data-classname="<?php echo $value->class_name;?>" 
                data-classroll="<?php echo $value->class_roll;?>" 
                data-mode ="ADMFEE" 
                data-studentname="<?php echo $value->name; ?>" >Make Payment </button> 
            </td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

            </div>