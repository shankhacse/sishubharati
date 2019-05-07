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
        
      

      if(!empty($teacherAttendance)){
        $i=0;
        $sl=1;
        
        foreach ($teacherAttendance as $teacherAttendance) {
         
        
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
                    <th style="text-align:left;width:10%;">Total</th>
                   
                    
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
           <td><?php echo $teacherAttendanceCount->no_of_days; ?></td>
       
       
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


