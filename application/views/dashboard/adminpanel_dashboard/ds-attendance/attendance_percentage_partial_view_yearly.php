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
  <button type="button" class=" bg-purple btn-flat margin" style="float:right;"><?php echo date("F", strtotime($sel_month));?></button>
          <div style="">
              <table class="table table-bordered table-striped table-responsive dataTables" id="studentlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:5%;">Sl No.</th>
                 
                    <th style="text-align:left;width:10%;">Student ID</th>
                    <th style="text-align:left;width:20%;">Name</th>
                    <th style="text-align:left;width:5%;">Class Roll</th>
                    <th style="">Jan</th>
                    <th style="">Feb </th>
                    <th style="">Mar</th>
                    <th style="">Apr</th>
                    <th style="">May</th>
                    <th style="">Jun</th>
                    <th style="">Jul</th>
                    <th style="">Aug</th>
                    <th style="">Sep</th>
                    <th style="">Oct</th>
                    <th style="">Nov</th>
                    <th style="">Dec</th>
                    <th style="">Average</th>
                    


                
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
      
/*echo "<pre>";
print_r($studentlistData);
echo "<pre>";*/
      if(!empty($studentlistData)){
        $i=0;
        $sl=1;
       $presentpercentage=0;
        $absentpercentage=0;

        foreach ($studentlistData as $student_list) {
          $totalMonthlrCount=$monthlyopendays;
          $totalpresentpercentage=0;
         /* $presentCount=$student_list['presentCount']->total;
          $absentCount=$student_list['absentCount']->total;
          if ($totalMonthlrCount>0) {
          $presentpercentage=($presentCount/$totalMonthlrCount)*100;
          
          }*/
          
        
      ?>      
          <tr>
            <td><?php echo $sl++; ?></td>
            
           <td><?php echo $student_list['attendanceMasterData']->student_uniq_id;  ?></td>
           <td><?php echo $student_list['attendanceMasterData']->student_name; ?></td>
           <td><?php echo $student_list['attendanceMasterData']->class_roll; ?></td>
           
           <td style="color: #39ad39;font-weight: bold;"><?php //print_r($student_list['janopenDays']);

           if($student_list['janopenDays']->total>0){
            $janper=($student_list['JanpresentCount']->total/$student_list['janopenDays']->total)*100;
            $totalpresentpercentage+=$janper;
            echo number_format($janper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['febopenDays']->total>0){
            $febper=($student_list['febpresentCount']->total/$student_list['febopenDays']->total)*100;
             $totalpresentpercentage+=$febper;
            echo number_format($febper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['maropenDays']->total>0){
            $marper=($student_list['marpresentCount']->total/$student_list['maropenDays']->total)*100;
           $totalpresentpercentage+=$marper;
            echo number_format($marper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['apropenDays']->total>0){
            $aprper=($student_list['aprpresentCount']->total/$student_list['apropenDays']->total)*100;
           $totalpresentpercentage+=$aprper;
            echo number_format($aprper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['mayopenDays']->total>0){
            $mayper=($student_list['maypresentCount']->total/$student_list['mayopenDays']->total)*100;
            $totalpresentpercentage+=$mayper;
            echo number_format($mayper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['junopenDays']->total>0){
            $junper=($student_list['junpresentCount']->total/$student_list['junopenDays']->total)*100;
            $totalpresentpercentage+=$junper;
            echo number_format($junper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php 

           if($student_list['julopenDays']->total>0){
            $julper=($student_list['julpresentCount']->total/$student_list['julopenDays']->total)*100;
            $totalpresentpercentage+=$julper;
            echo number_format($julper,2)."%";
           }

           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php
           if($student_list['augopenDays']->total>0){
            $augper=($student_list['augpresentCount']->total/$student_list['augopenDays']->total)*100;
              $totalpresentpercentage+=$augper;
            echo number_format($augper,2)."%";
           }
           ?> </td>
           <td style="color: #39ad39;font-weight: bold;"><?php
           if($student_list['sepopenDays']->total>0){
            $sepper=($student_list['seppresentCount']->total/$student_list['sepopenDays']->total)*100;
             $totalpresentpercentage+=$sepper;
            echo number_format($sepper,2)."%";
           }
           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php
           if($student_list['octopenDays']->total>0){
            $octper=($student_list['octpresentCount']->total/$student_list['octopenDays']->total)*100;
            $totalpresentpercentage+=$octper;
            echo number_format($octper,2)."%";
           }
           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php
           if($student_list['novopenDays']->total>0){
            $novper=($student_list['novpresentCount']->total/$student_list['novopenDays']->total)*100;
            $totalpresentpercentage+=$novper;
            echo number_format($novper,2)."%";
           }
           ?></td>
           <td style="color: #39ad39;font-weight: bold;"><?php
           if($student_list['decopenDays']->total>0){
            $decper=($student_list['decpresentCount']->total/$student_list['decopenDays']->total)*100;
            $totalpresentpercentage+=$decper;
            echo number_format($decper,2)."%";
           }
           ?></td>
           <td style="color: #781bcd;font-weight: bold;">
             <?php
             //pre($attMonths);
             if(!empty($attMonths)){

             $tot_mon=count($attMonths);
              $totalpresentpercentage;

              $avg= $totalpresentpercentage/$tot_mon;
              echo number_format($avg,2)."%";

             }

             ?>
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
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header padhf" style="text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="st_name">Rana</h4></button>
        </div>
        <div class="modal-body" >
        <div id="detail_information_view" ></div>

        
      </div>
      <div class="modal-footer padhf">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>