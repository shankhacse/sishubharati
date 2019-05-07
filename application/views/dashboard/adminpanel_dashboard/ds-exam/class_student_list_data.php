    
    <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:10%;">Student ID</th>
                  
                  <th style="width:20%;">Name</th>
                  <th style="width:10%;">Roll</th>
                  <th style="width:15%;">First Term</th>
                  <th style="width:15%;">Second Term</th>
                  <th style="width:15%;">Third Term</th>
                 
                  
                </tr>
                </thead>
                <tbody>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              
                <?php 
                  $i = 1;
                 
                  foreach ($studentList as $key => $value) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_name; ?></td>
            
            <td><?php echo $value->class_roll; ?></td>
            <td>
              <?php
             

               if($value->first_term_data=='N') {
                ?>
              <a href="javascript:;" class="btn btn-danger btn-xs addsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Add"
              data-mode="Add"
              data-term="first"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>">
             
              Add Marks
              </a>
              <?php }else{ ?>
              <a href="javascript:;" class="btn btn-success btn-xs editsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="first"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->first_term_master_id; ?>">
             
              Edit Marks
              </a>
                <?php  
                if ($value->is_applicable_first_term_upload=='Y') {
                 
              
                ?>
               <a href="javascript:;" class="btn btn-warning btn-xs subjectpaper"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="first"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->first_term_master_id; ?>">
             
             Exam Paper

              </a>


            <?php 
          }

          } ?>
            </td>

            <td>
              <?php
             

               if($value->second_term_data=='N') {
                ?>
              <a href="javascript:;" class="btn btn-danger btn-xs addsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Add"
              data-mode="Add"
              data-term="second"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>">
             
              Add Marks
              </a>
              <?php }else{ ?>
              <a href="javascript:;" class="btn btn-success btn-xs editsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="second"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->second_term_master_id; ?>">
             
              Edit Marks
              </a>

               <a href="javascript:;" class="btn btn-warning btn-xs subjectpaper"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="second"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->second_term_master_id; ?>">
             
             Exam Paper
              
              </a>
            <?php } ?>
            </td>
             
             <td>
              <?php
             

               if($value->third_term_data=='N') {
                ?>
              <a href="javascript:;" class="btn btn-danger btn-xs addsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Add"
              data-mode="Add"
              data-term="third"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>">
             
              Add Marks
              </a>
              <?php }else{ ?>
              <a href="javascript:;" class="btn btn-success btn-xs editsubjectmarks"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="third"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->third_term_master_id; ?>">
             
              Edit Marks
              </a>

              <a href="javascript:;" class="btn btn-warning btn-xs subjectpaper"
              data-toggle="modal" data-target="#subject_marks" 
              data-title="Edit"
              data-mode="Edit"
              data-term="third"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentuniqid="<?php echo $value->student_uniq_id; ?>"
              data-marksmasterid="<?php echo $value->third_term_master_id; ?>">
             
             Exam Paper
              
              </a>
            <?php } ?>
            </td>
            
            
           
           
         
          </tr>
                    
                <?php } ?>
             
                </tbody>
               
              </table>
            </div>

             
               
              </div>

              



          