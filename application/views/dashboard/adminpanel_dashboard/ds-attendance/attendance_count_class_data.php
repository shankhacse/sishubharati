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

           if(sizeof($montlyCountDetails)>0){

          ?>
  <button type="button" class=" bg-purple btn-flat margin">Attendance Entry of <?php echo $classname->name?></button>
  <button type="button" class=" bg-purple btn-flat margin" style="float:right;"><?php echo date("F", mktime(0, 0, 0, $sel_month, 10));
  ?></button>
          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables" id="studentlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl No.</th>
                 
                    <th style="text-align:left;width:20%;">Class</th>
                    <th style="text-align:left;width:30%;">Attendance Date</th>
                    <th style="text-align:left;width:10%;">Session</th>
                     <th style="text-align:left;width:10%;">Entry By</th>
                     <th style="text-align:left;width:10%;">Details</th>
                     <th style="text-align:left;width:10%;">Delete</th>
                   
                    


                
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
      
/*echo "<pre>";
print_r($studentlistData);
echo "<pre>";*/
      if(!empty($montlyCountDetails)){
        $i=0;
        $sl=1;

        foreach ($montlyCountDetails as $countDetails) {
        

       
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>
            
           <td><?php echo $countDetails->classname;  ?></td>
           <td><?php echo date("d-m-Y", strtotime($countDetails->taken_date));?></td>
           <td><?php echo $countDetails->year;  ?></td>
           <td style="text-transform: capitalize;"><?php
           if ($countDetails->role=='TEACHER') {
              echo $countDetails->teachername;
            }else{
              echo $countDetails->username;
            } 
             ?></td>
           <td>  <button type="button" 
          class="btn btn-sm bg-yellow calassattendainfo" data-toggle="modal" data-target="#attendance_info_class" 
          data-attmastid="<?php echo $countDetails->id;?>"
          data-classname="<?php echo $countDetails->classname;?>"
          data-month="<?php echo date("F", mktime(0, 0, 0, $sel_month, 10));
  ?>"
           >Details </button> </td>
          
         <td>
           <button type="button" 
          class="btn btn-sm btn-danger attmasterdlt"
          data-attmastid="<?php echo $countDetails->id;?>"
         
           >Delete </button> 

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
  <div class="modal fade bd-example-modal-lg" id="attendance_info_class" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header padhf" style="text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="classname"></h4></button>

        </div>
        <div class="modal-body" style=" display: block;height: 500px;overflow-y: scroll;" >
        <div id="detail_information_view" ></div>

        
      </div>
      <div class="modal-footer padhf">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>