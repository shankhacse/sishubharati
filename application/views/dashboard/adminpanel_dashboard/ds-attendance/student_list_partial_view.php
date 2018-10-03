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
  <button type="button" class=" bg-purple btn-flat margin">Students List of <?php echo $classname->name?></button>
          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables" id="studentlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>
                    <th style="text-align:left;width:20%;">Student ID</th>
                    <th style="text-align:left;width:30%;">Name</th>
                    <th style="text-align:left;width:10%;">Class Roll</th>
                    <th style="text-align:left;width:30%;">Present / Absent </th>
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
      

      if(sizeof($studentlistData)>0){
        $i=0;
        $sl=1;
        
        foreach ($studentlistData as $student_list) {
         
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>

            <input type="hidden" id="student_<?php echo $i;?>" name="student[]" value="<?php echo $student_list->student_uniq_id;?>">
             <input type="hidden" id="class_roll_<?php echo $i;?>" name="class_roll[]" value="<?php echo $student_list->class_roll;?>">
             <input type="hidden" id="sel_class" name="sel_class" value="<?php echo $student_list->class_id;?>">
           <td><?php echo $student_list->student_uniq_id  ?></td>
           <td><?php echo $student_list->student_name; ?></td>
           <td><?php echo $student_list->class_roll; ?></td>
           <td>
                <div class="maxl">
                    <label class="radio inline"> 
                        <input type="radio" name="attendance[<?php echo $i;?>]" value="P" checked>
                        <span> Present </span> 
                     </label>
                    <label class="radio radiocol inline"> 
                        <input type="radio" name="attendance[<?php echo $i;?>]" value="A">
                        <span>Absent </span> 
                    </label>
                  </div>
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

 <div class="container" style="margin-top:50px; ">
  <div class="form-group row">
    <label for="date" class=" col-sm-2 col-form-label">Attendance Date</label>
      <div class="col-sm-2 col-xs-12">
                    <input type="text" id="datepicker" class="form-control custom_frm_input"  name="attendance_date"  placeholder="" value="<?php echo $curr_dt;?>" />
        </div>

      
    </div>
     <p id="attmsg" class="form_error"></p> 
     <p id="attendance_manual_err_msg" class="form_error"></p>
    <div class="form-group row" style="margin-top:20px;" >

      <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="attendanceSave" style="display: inline-block;width:200px;">Save</button>
            </div>
    </div>

   

</div> 


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


