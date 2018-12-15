
    <div class="datatalberes" id="printableArea" style="overflow-x:auto;"><center>
      <?php 
      if($studentInfo){
      ?>
       
      <button type="button" class="btn-xs bg-maroon margin"><h4 class="modal-title" id="student_name">Student Name : <?php echo $studentInfo->student_name;?></h4></button>
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="student_name">Class : <?php echo $studentInfo->class_name;?></h4></button>
      <button type="button" class="btn-xs bg-yellow margin"><h4 class="modal-title" id="student_name">Roll : <?php echo $studentInfo->class_roll;?></h4></button>
    <?php }?>

     <h2 style="color: #1e8292;text-decoration: underline;"><?php echo $term;?> Term</h2></center>
      
       <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
               
             <thead>
                <tr>
                   <th colspan="2"><?php echo $term;?> Term</th>
                   <th colspan="3">Full Marks</th>
                   <th>&nbsp;</th>
                   <th colspan="3">Obtain Marks</th>
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
                  foreach ($term_marks as $term_marks) {

                 

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $term_marks->subject;?></td>
            <td><?php echo $term_marks->full_marks;?></td>
            <td><?php echo $term_marks->full_written_marks;?></td>
            <td><?php echo $term_marks->full_oral_marks;?></td>
            <td>&nbsp;</td>
            <td><?php echo $term_marks->obtain_written_marks;?></td>
            <td><?php echo $term_marks->obtain_oral_marks;?></td>
            <td><?php echo $term_marks->obtain_total_marks;?></td>
            <td><?php echo $term_marks->grade;?></td>
             <td><?php echo $this->highest_marks_method_call_view->highestMarks($term_marks->class_id,$term_marks->subject_id,$term_marks->term,$term_marks->session_id);?></td>
           </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

              
             

               
            <div class="table-responsive">
<table class="table table-bordered" border="2" style="font-size:12px;">
  <thead>
    <tr>
      <th  colspan="2" style="color:#fff;background-color:#18236f;font-weight: bold;text-align: center;">
       <?php echo $term;?> Term Performance
      </th>
      
    </tr>
  </thead>
  <tbody>
    <tr><td width="60%">Attendance</td> <td><?php echo $attendance;?></td></tr>
    <tr><td width="60%">Sporting</td> <td><?php echo $sporting;?></td></tr>
    <tr><td width="60%">Discipline</td> <td><?php echo $discipline;?></td></tr>
    <tr><td width="60%">Cultural Efficiency</td> <td><?php echo $cultural_efficiency;?></td></tr>
    
    
  </tbody>
</table>
</div> 

              
            </div>

          <!--   <input type="button" class="btn btn-primary btn-md" onclick="printDiv('printableArea')" value="print marks!" /> -->