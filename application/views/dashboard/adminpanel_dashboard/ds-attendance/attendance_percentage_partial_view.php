    <style type="text/css">
     .infohead{
      width:500px;width: 556px;color: #45b045;font-size: 16px;
     } 
.trnxdiv{
text-align:center;padding:10px;padding: 10px;margin-bottom: 50px;display:none;
}
.noinfo{
 text-align:center; 
}

.padhf{
  padding:5px;
}
    </style>   
        
        <div class="box-body" id="PatientList">
          <?php
          $attr = array("id"=>"StudentAttendanceForm","name"=>"StudentAttendanceForm");
              echo form_open('',$attr); ?>

       
          <?php

           if(sizeof($studentlistData)>0){

          ?>
  <button type="button" class=" bg-purple btn-flat margin">Attendance Information of <?php echo $classname->name?></button>


  <button type="button" class=" bg-purple btn-flat margin" style="float:right;"><?php echo date("F", mktime(0, 0, 0, $sel_month, 10));
  ?></button>
    <button type="button" class=" bg-green btn-flat margin" style="float:right;">Total Days : <?php echo $monthlyopendays?></button>
          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables" id="studentlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>
                 
                    <th style="text-align:left;width:10%;">Student ID</th>
                    <th style="text-align:left;width:20%;">Name</th>
                    <th style="text-align:center;width:10%;">Class Roll</th>
                    <th style="text-align:center;width:10%;">Present Count</th>
                    <th style="text-align:left;width:10%;">Present %</th>
                    <th style="text-align:center;width:10%;">Absent Count</th>
                    <th style="text-align:left;width:10%;">Absent %</th>
                    <th style="text-align:center;width:10%;">Action </th>
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
      

      if(!empty($studentlistData)){
        $i=0;
        $sl=1;
       $presentpercentage=0;
        $absentpercentage=0;
        foreach ($studentlistData as $student_list) {
          $totalMonthlrCount=$monthlyopendays;

          $presentCount=$student_list['presentCount']->total;
          $absentCount=$student_list['absentCount']->total;
          if ($totalMonthlrCount>0) {
          $presentpercentage=($presentCount/$totalMonthlrCount)*100;
          $absentpercentage=($absentCount/$totalMonthlrCount)*100;
          }
          
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>
            

            <input type="hidden" id="student_<?php echo $i;?>" name="student[]" value="<?php echo $student_list['attendanceMasterData']->student_uniq_id;?>">
             <input type="hidden" id="present_<?php echo $i;?>" name="present[]" value="<?php echo number_format($presentpercentage,2)?>">
             <input type="hidden" id="absent_<?php echo $i;?>" name="absent[]" value="<?php echo number_format($absentpercentage,2)?>">
           <td><?php echo $student_list['attendanceMasterData']->student_uniq_id;  ?></td>
           <td><?php echo $student_list['attendanceMasterData']->student_name; ?></td>
           <td style="text-align:center"><?php echo $student_list['attendanceMasterData']->class_roll; ?></td>
           <td style="color: #39ad39;font-weight: bold;text-align:center"><?php echo $presentCount;?> </td>
           <td style="color: #39ad39;font-weight: bold;"><?php echo number_format($presentpercentage,2)." %"?> </td>
           <td style="color: #ca6f7d;;font-weight: bold;text-align:center"><?php echo $absentCount;?> </td>
           <td style="color: #ca6f7d;;font-weight: bold;"><?php echo number_format($absentpercentage,2)." %"?> </td>
           <td style="text-align:center">
          <button type="button" 
          class="btn btn-sm bg-yellow viewattendainfo" data-toggle="modal" data-target="#attendance_info" data-studentid="<?php echo $student_list['attendanceMasterData']->student_uniq_id;?>" 
          data-studentname ="<?php echo $student_list['attendanceMasterData']->student_name; ?>" 
          data-selectclass ="<?php echo $sel_class;?>" 
          data-selectmonth="<?php echo $sel_month; ?>"
           >Details </button> 

            </td>
          </tr>

          <?php 
            $i++;
            }

          }
          else{ ?>
            <tr>
                <td colspan="7">No Records Found</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
<?php
  $curr_dt = date('d/m/Y');     
?>




 <?php 
} //end of patient list record

else{
?>
  <div class="well well-sm noinfo">
        No record found. 
        </div>
<?php
}


 echo form_close(); ?>
    </div>


      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="attendance_info" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header padhf" style="text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="st_name">Rana</h4></button>
        </div>
        <div class="modal-body" style=" display: block;height: 450px;overflow-y: scroll;">
        <div id="detail_information_view"></div>

        
      </div>
      <div class="modal-footer padhf">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>