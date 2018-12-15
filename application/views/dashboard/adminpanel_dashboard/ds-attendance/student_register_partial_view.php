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
    </style>   
        
        <div class="box-body" id="PatientList">
          <?php
          $attr = array("id"=>"StudentAttendanceForm","name"=>"StudentAttendanceForm");
              echo form_open('',$attr); ?>

       
          <?php

           if(sizeof($studentlistData)>0){

          ?>
  <button type="button" class=" bg-purple btn-flat margin">Attendance Information of <?php echo $classname->name?></button>
  <button type="button" class=" bg-purple btn-flat margin" style="float: right;"><?php echo "Date : ".$attdate;?></button>

          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables" id="studentlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>
                 
                    <th style="text-align:left;width:20%;">Student ID</th>
                    <th style="text-align:left;width:30%;">Name</th>
                    <th style="text-align:left;width:10%;">Class Roll</th>
                    <th style="text-align:left;width:10%;">Attendance </th>
                    <th style="text-align:left;width:10%;">Action </th>
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
      

      if(!empty($studentlistData)){
        $i=0;
        $sl=1;
        
        foreach ($studentlistData['attendanceDetailData'] as $student_list) {
         
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>
            

            <input type="hidden" id="student_<?php echo $i;?>" name="student[]" value="<?php echo $student_list->student_uniq_id;?>">
            
           <td><?php echo $student_list->student_uniq_id;  ?></td>
           <td><?php echo $student_list->student_name; ?></td>
           <td><?php echo $student_list->class_roll; ?></td>
           <td>
               <?php

               if ($student_list->attendance_status=='P') {
                echo "<b style='color: #0B8;'>Present";
               }else if($student_list->attendance_status=='A'){
                echo "<b style='color: #F01616;'>Absent";
               }

               ?>
           </td>
           <td align="center" style="vertical-align:middle;padding:0;"> 
            <button type="button" class="btn btn-sm bg-blue updtAttendance" 
            data-toggle="modal" 
            data-target="#updateAttendaceModal"  
            data-attdetid="<?php echo $student_list->id; ?>"
            data-attstatus="<?php echo $student_list->attendance_status; ?>"
            data-student="<?php echo $student_list->student_name; ?>"
            data-studentunqid="<?php echo $student_list->student_uniq_id; ?>"
            > <span class="glyphicon glyphicon-pencil"></span></button>

            
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
<div id="updateAttendaceModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:7px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="attdetailsid" id="attdetailsid">
         <table>
          <tr>
            <td id="stname" style="font-size: 15px;color: #c43cda;font-weight: bold;"></td>
          </tr>
        </table>
      </div>
      <div class="modal-body" style="height: 70px;">
       
        <div class="maxl" style="margin-top: 10px;">
                    <label class="radio inline"> 
                        <input type="radio" id="attUpdt_p" name="attUpdt" value="P">
                        <span> Present </span> 
                     </label>
                    <label class="radio radiocol inline"> 
                        <input type="radio" id="attUpdt_a" name="attUpdt" value="A">
                        <span>Absent </span> 
                    </label>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="updtAttendancebtn" style="padding: 0px 6px; margin-left:20px ">Update</button>
                  </div>
      </div>
      <div class="modal-footer" style="padding: 5px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding: 2px 9px;" >Close</button>
      </div>
    </div>

  </div>
</div>