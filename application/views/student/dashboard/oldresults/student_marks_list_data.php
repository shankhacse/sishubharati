
    <div class="datatalberes" id="printableArea" style="overflow-x:auto;"><center>
      <?php 
      if($studentInfo){
      ?>
       
      <button type="button" class="btn-xs bg-maroon margin"><h4 class="modal-title" id="student_name">Student Name : <?php echo $studentInfo->student_name;?></h4></button>
      <button type="button" class="btn-xs bg-purple margin"><h4 class="modal-title" id="student_name">Class : <?php echo $studentInfo->class_name;?></h4></button>
      <button type="button" class="btn-xs bg-yellow margin"><h4 class="modal-title" id="student_name">Roll : <?php echo $studentInfo->class_roll;?></h4></button>
    <?php }?>

     <h2 style="color: #1e8292;text-decoration: underline;">First Term</h2></center>
      
       <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;overflow-x:auto;">
               
             <thead>
                <tr  >
                   <th colspan="2" style="text-align: center;">First Term</th>
                   <th colspan="3" style="text-align: center;">Full Marks</th>
                   <th>&nbsp;</th>
                   <th colspan="3" style="text-align: center;">Obtain Marks</th>
                   <th>&nbsp;</th>
                   <th>&nbsp;</th>
                </tr>
                <tr>
                  <th style="width:2%;">Sl</th>
                  <th style="width:20%;">Subject</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;"></th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:8%;">Grade</th>
                  <th style="width:8%;">Highest</th>
              
                 
                  
                </tr>
                </thead>
                
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($first_term_marks as $first_term_marks) {

                 

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $first_term_marks->subject;?></td>
            <td><?php echo $first_term_marks->full_marks;?></td>
            <td><?php echo $first_term_marks->full_written_marks;?></td>
            <td><?php 
            if ($first_term_marks->full_oral_marks!='0') {
              echo $first_term_marks->full_oral_marks;
            }
            
            ?></td>
            <td>&nbsp;</td>
            <td><?php echo $first_term_marks->obtain_written_marks;?></td>
            <td><?php 
            if ($first_term_marks->obtain_oral_marks!='0') {
               echo $first_term_marks->obtain_oral_marks;
            }
           
            ?></td>
            <td><?php echo $first_term_marks->obtain_total_marks;?></td>
            <td><?php echo $first_term_marks->grade;?></td>
            <td><?php echo $this->highest_marks_method_call_view->highestMarks($first_term_marks->class_id,$first_term_marks->subject_id,$first_term_marks->term,$first_term_marks->session_id);?></td>
           </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>


              <div class="table-responsive">
              <table class="table table-bordered" border="2" style="font-size:16px;overflow-x:auto;">
                <thead>
                  <tr>
                    <th  colspan="2" style="color:#fff;background-color:#18236f;font-weight: bold;text-align: center;">
                     First Term Performance
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr><td width="60%">Attendance</td> <td><?php echo $attendanceT1;?></td></tr>
                  <tr><td width="60%">Sporting</td> <td><?php echo $sportingT1;?></td></tr>
                  <tr><td width="60%">Discipline</td> <td><?php echo $disciplineT1;?></td></tr>
                  <tr><td width="60%">Cultural Efficiency</td> <td><?php echo $cultural_efficiencyT1;?></td></tr>
                  
                  
                </tbody>
              </table>
              </div> 




              <center> <h2 style="color: #1e8292;text-decoration: underline;">Second Term</h2></center>
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;overflow-x:auto;">
               
             <thead>
                <tr>
                   <th colspan="2" style="text-align: center;">Second Term</th>
                   <th colspan="3" style="text-align: center;">Full Marks</th>
                   <th>&nbsp;</th>
                   <th colspan="3" style="text-align: center;">Obtain Marks</th>
                   <th>&nbsp;</th>
                   <th>&nbsp;</th>
                </tr>
                <tr>
                  <th style="width:2%;">Sl</th>
                  <th style="width:20%;">Subject</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;"></th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:8%;">Grade</th>
                  <th style="width:8%;">Highest</th>
              
                 
                  
                </tr>
                </thead>
                
                <tbody>
               
                <?php 
                  $i2 = 1;
                  foreach ($second_term_marks as $second_term_marks) {

                 

                  
                  ?>

          <tr>
            <td><?php echo $i2++; ?></td>
            <td><?php echo $second_term_marks->subject;?></td>
            <td><?php echo $second_term_marks->full_marks;?></td>
            <td><?php echo $second_term_marks->full_written_marks;?></td>
            <td><?php 
                  if ($second_term_marks->full_oral_marks!='0') {
                    echo $second_term_marks->full_oral_marks;
                  }
                    
            ?></td>
            <td>&nbsp;</td>
            <td><?php echo $second_term_marks->obtain_written_marks;?></td>
            <td><?php 
                  if ($second_term_marks->obtain_oral_marks!='0') {
                   echo $second_term_marks->obtain_oral_marks;
                  }
                  
            ?></td>
            <td><?php echo $second_term_marks->obtain_total_marks;?></td>
            <td><?php echo $second_term_marks->grade;?></td>
            <td><?php echo $this->highest_marks_method_call_view->highestMarks($second_term_marks->class_id,$second_term_marks->subject_id,$second_term_marks->term,$second_term_marks->session_id);?></td>
           </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

              <div class="table-responsive">
                <table class="table table-bordered" border="2" style="font-size:16px;overflow-x:auto;">
                  <thead>
                    <tr>
                      <th  colspan="2" style="color:#fff;background-color:#18236f;font-weight: bold;text-align: center;">
                       Second Term Performance
                      </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td width="60%">Attendance</td> <td><?php echo $attendanceT2;?></td></tr>
                    <tr><td width="60%">Sporting</td> <td><?php echo $sportingT2;?></td></tr>
                    <tr><td width="60%">Discipline</td> <td><?php echo $disciplineT2;?></td></tr>
                    <tr><td width="60%">Cultural Efficiency</td> <td><?php echo $cultural_efficiencyT2;?></td></tr>
                    
                    
                  </tbody>
                </table>
                </div>

               <center> <h2 style="color: #1e8292;text-decoration: underline;">Third Term</h2></center>
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
               
             <thead>
                <tr>
                   <th colspan="2" style="text-align: center;">Third Term</th>
                   <th colspan="3" style="text-align: center;">Full Marks</th>
                   <th>&nbsp;</th>
                   <th colspan="3" style="text-align: center;">Obtain Marks</th>
                   <th>&nbsp;</th>
                   <th>&nbsp;</th>
                </tr>
                <tr>
                  <th style="width:2%;">Sl</th>
                  <th style="width:20%;">Subject</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;"></th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:8%;">Grade</th>
                  <th style="width:8%;">Highest</th>
              
                 
                  
                </tr>
                </thead>
                
                <tbody>
               
                <?php 
                  $i3 = 1;
                  foreach ($third_term_marks as $third_term_marks) {

                 

                  
                  ?>

          <tr>
            <td><?php echo $i3++; ?></td>
            <td><?php echo $third_term_marks->subject;?></td>
            <td><?php echo $third_term_marks->full_marks;?></td>
            <td><?php echo $third_term_marks->full_written_marks;?></td>
            <td><?php 
                  if ($third_term_marks->full_oral_marks!='0') {
                     echo $third_term_marks->full_oral_marks;
                  }
           
            ?></td>
            <td>&nbsp;</td>
            <td><?php echo $third_term_marks->obtain_written_marks;?></td>
            <td><?php 
                    if ($third_term_marks->obtain_oral_marks!='0') {
                       echo $third_term_marks->obtain_oral_marks;
                    }
                   

            ?></td>
            <td><?php echo $third_term_marks->obtain_total_marks;?></td>
            <td><?php echo $third_term_marks->grade;?></td>
            <td><?php echo $this->highest_marks_method_call_view->highestMarks($third_term_marks->class_id,$third_term_marks->subject_id,$third_term_marks->term,$third_term_marks->session_id);?></td>
           </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

              <div class="table-responsive">
                <table class="table table-bordered" border="2" style="font-size:16px;overflow-x:auto;">
                  <thead>
                    <tr>
                      <th  colspan="2" style="color:#fff;background-color:#18236f;font-weight: bold;text-align: center;">
                       Third Term Performance
                      </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td width="60%">Attendance</td> <td><?php echo $attendanceT3;?></td></tr>
                    <tr><td width="60%">Sporting</td> <td><?php echo $sportingT3;?></td></tr>
                    <tr><td width="60%">Discipline</td> <td><?php echo $disciplineT3;?></td></tr>
                    <tr><td width="60%">Cultural Efficiency</td> <td><?php echo $cultural_efficiencyT3;?></td></tr>
                    
                    
                  </tbody>
                </table>
                </div>

              
            </div>

          <!--   <input type="button" class="btn btn-primary btn-md" onclick="printDiv('printableArea')" value="print marks!" /> -->