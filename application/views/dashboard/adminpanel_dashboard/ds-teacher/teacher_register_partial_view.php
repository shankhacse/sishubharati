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

           if($teacherAttendance){

          ?>


          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables"  style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>               
                   <th style="text-align:left;width:30%;">Name</th>
                   <th style="text-align:left;width:10%;">Employee Type</th>
                    <th style="text-align:left;width:10%;">Attendance Date</th>
                    <th style="text-align:left;width:10%;">In Time </th>
                    <th style="text-align:left;width:10%;">Out Time</th>
                    <th style="text-align:left;width:10%;">Action</th>
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        
      
  $presentDates = [];
      if(!empty($teacherAttendance)){
        $i=0;
        $sl=1;
      
        foreach ($teacherAttendance as $teacherAttendance) {
         $presentDates[]=date("d-m-Y",strtotime($teacherAttendance->att_date));
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>

           <td><?php echo $teacherAttendance->name;  ?></td>
           <td><?php echo $teacherAttendance->employee_type;  ?></td>
           <td><?php echo date("d-m-Y",strtotime($teacherAttendance->att_date)); ?></td>
           <td><?php echo $teacherAttendance->in_time; ?></td>
           <td><?php echo $teacherAttendance->out_time; ?></td>
           <td><a href="javascript:;" class="btn btn-danger btn-xs deleteattteacher" 

            data-title="Delete" data-mode="Delete"
             data-attid="<?php echo $teacherAttendance->id?>">
                <span class="glyphicon glyphicon-remove"></span>
              </a></td>
       
       
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
<?php


$allopendates=[];
foreach ($schoolOpenData as $schoolopen) {
 $allopendates[]=date("d-m-Y",strtotime($schoolopen->att_date));
}

$absentDays = array_diff($allopendates, $presentDates);

 pre($schoolOpenData);
 //pre($schoolOpenData);

// pre($absentDays);


if ($absentDays) {
 
?>
<div>
      <table class="table table-bordered table-striped table-responsive dataTables"  style="border-collapse: collapse !important;" >
        <thead>
          <tr style="background: #e65841;">
          <th>  Sl No </th>
          <th>  Absent Date </th>
        </tr>
          
        </thead>
        <tbody>
          <?php 
          $ab=1;
            foreach ($absentDays as $absentdays) {
             
         
          ?>
          <tr>

            <td><?php echo $ab++;?></td>
            <td><?php echo $absentdays;?></td>
          </tr>
          <?php    } ?>
        </tbody>
        
      </table>

      </div>
    <?php }?>

    </div>
<?php
  $curr_dt = date('d/m/Y');     
?>




 <?php 
} //end of teacher list record
else if($teacherAttendanceCount){ ?>

   <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables"  style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>               
                   <th style="text-align:left;width:30%;">Name</th>
                   <th style="text-align:left;width:10%;">Employee Type</th>
                    <th style="text-align:left;width:10%;">Total Present</th>
                    <th style="text-align:left;width:10%;">Total Absent</th>
                    <th style="text-align:left;width:10%;">School Open</th>
                   
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        
      

      if(!empty($teacherAttendanceCount)){
       
        $sl2=1;
        
        foreach ($teacherAttendanceCount as $teacherAttendanceCount) {
         
        
      ?>      
          <tr>
            <td><?php echo $sl2++; ?></td>

           <td><?php echo $teacherAttendanceCount->name;  ?></td>
           <td><?php echo $teacherAttendanceCount->employee_type;  ?></td>
           <td style="text-align: center;font-weight: bold;color: green;"><?php echo $teacherAttendanceCount->no_of_days; ?></td>
           <td style="text-align: center;font-weight: bold;color: red;"><?php 

           $totalSchoolOpen = count($schoolOpenData);
           $totalPresent=$teacherAttendanceCount->no_of_days;

           $totalAbsent=$totalSchoolOpen-$totalPresent;

           if ($totalAbsent!=0) {
             echo $totalAbsent;
           }
            ?></td>
           <td>
             
               <button type="button" class="btn btn-sm btn-warning" 
             data-toggle="modal" 
             data-target="#schoolopen" 
            
               ><?php echo count($schoolOpenData); ?></button> 
           </td>
       
       
          </tr>

          <?php 
         
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
}
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
<div class="modal fade" id="schoolopen" tabindex="-1" role="dialog" aria-labelledby="rollEditModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document" style="margin-top: 170px;">
    <div class="modal-content">
      <div class="modal-header" style="padding: 5px">
       <span class="label label-primary" style="background-color: #422095 !important;
font-size: 13px;">School Open Days</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div  style="max-height: 400px;overflow-y: scroll;">
      <table class="table table-striped table-bordered" >
        <tr>
           <th> Sl No</th>
           <th> Date</th>
        </tr>
       
   
    <tbody>
      <?php $i=1;
      foreach ($schoolOpenData as $key => $value) {
     
      ?>
      <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo date("d-m-Y",strtotime($value->att_date)); ?></td>
      </tr>
    <?php }?>
              
      
    </tbody>
  </table>
</div>
    <div class="response_msg" id="roll_response_msg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


