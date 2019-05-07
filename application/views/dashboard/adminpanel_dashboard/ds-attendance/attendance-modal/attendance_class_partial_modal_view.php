
    
        
     <div class="table-responsive" >          
  <table class="table table-bordered table-striped" style="color: #1d7894;">
<thead>
  <th>Sl</th>
  <th>Student ID</th>
  <th>Student Name</th>
	<th>Date</th>
	<th>Status</th>
</thead>

   
    <tbody>
    	<?php 
      $presentCount=0;
      $absentCount=0;
      $i=1;
    	foreach ($attendanceDtl as $value) {
    	
    	?>
    	<tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $value->student_uniq_id;?></td>
        <td><?php echo $value->student_name;?></td>
    		<td><?php echo date("d-m-Y", strtotime($value->taken_date));?></td>
    		<td>
    			 <?php

               if ($value->attendance_status=='P') {
                $presentCount++;
                echo "<b style='color: #0B8;'>Present";
               }else if($value->attendance_status=='A'){
                $absentCount++;
                echo "<b style='color: #F01616;'>Absent";
               }

               ?>
    		</td>
    	</tr>
      <?php }?>

    </tbody>
  </table>
  <button type="button" class="btn btn-danger" style="float: left;">Absent  <span class="badge"><?php echo $absentCount;?></span></button> 
   <button type="button" class="btn btn-success" style="float: right;">Present  <span class="badge"><?php echo $presentCount;?></span></button> 
   
  </div>
   

  

     
 
     

      