    <style type="text/css">
  .table_th{
  background-color: #cd558e !important;
  color: #fff!important;
  }
</style>
   <!--  <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
    <button type="button" class=" bg-olive btn-flat margin"><?php echo $sel_term;?></button> -->
    <div class="datatalberes table-responsive" style="max-width:99%;overflow-x: scroll;" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;" >Sl</th>
                  <th style="width:10%;" >StudentID</th>
                  
                  <th style="width:20%;" >Name</th>
                  <th style="width:5%;" >Roll</th>
                  <?php
                 // pre($studentmarksDetails[0]['subjectData']);
                  if($studentmarksDetails){
                  foreach ($studentmarksDetails[0]['subjectData'] as $subjectData) {

                  ?>
                 <th style="border-right:0px;border-left:0px;position: absolute;margin-left: 30px;"><?php echo $subjectData->subject; ?></th>
                 <th style="border-left:0px;border-right:0px;"></th>
                 <th style="border-left:0px;border-right:0px;"></th>
                 <th style="border-left:0px;"></th>
                 
                  <?php }
                }?>
                   
                </tr>


                
                </thead>
                <tbody>

                  <tr class="table_th">
                  <td style="font-weight:bold;" ><?php echo $classname;?></td>
                  <td style="font-weight:bold;" > <?php echo $sel_term;?></td>
                   <td> </td>  <td> </td>
                  
                  <?php
                 // pre($studentmarksDetails[2]['marksData']);
                  if ($studentmarksDetails) {           
                  foreach ($studentmarksDetails[0]['subjectData'] as $subjectData) {

                  ?>
                  <td>W</td>
                  <td>O</td>
                  <td>TO</td>
                  <td>G</td>
                 
                 
                  <?php }
                   }?>
                   
                </tr>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              
                <?php 
                  $i = 1;
                  $marksindex=0;
               //  
                  foreach ($studentmarksDetails as $studentmarksdetails) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $studentmarksdetails['studentData']->student_uniq_id; ?></td>
            <td><?php echo $studentmarksdetails['studentData']->student_name; ?></td>
            
            <td><?php echo $studentmarksdetails['studentData']->class_roll; ?></td>
           
                 <?php
                  //pre($studentmarksDetails[0]['marksData']);
                  foreach ($studentmarksDetails[$marksindex]['marksData'] as $marksData) {

                  ?>
                  <td><?php echo $marksData->obtain_written_marks;?></td>
                  <td><?php echo $marksData->obtain_oral_marks;?></td>
                  <td><?php echo $marksData->obtain_total_marks;?></td>
                  <td><?php echo $marksData->grade;?></td>
                 
                 
                  <?php }?>
            
            
           
           
         
          </tr>
                    
                <?php $marksindex++;} ?>
             
                </tbody>
               
              </table>
            </div>

             
               
              </div>

              



          