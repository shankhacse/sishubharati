<div class="panel panel-primary">
      <div class="panel-heading">
                            Attendance Details <?php echo $bodycontent['month']."-".$bodycontent['year']?>                       </div>


	
	<div class="container-fluid">
				<div class="table-responsive"> 
			<table id="dietry-managment-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Status</th>
						
					</tr>
				</thead>
       
				<tbody>
				<?php 
			
					if($bodycontent['studentAttDetail']){
						$i=1;
						foreach($bodycontent['studentAttDetail'] as $att_detail){
							
							?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php 
							if($att_detail['att_date']){
									echo date('d-m-Y',strtotime($att_detail['att_date']));
								}
							else{echo "";}
							?>
						</td>
						<td>
			    			 <?php

			               if ($att_detail['attendance_status']=='P') {
			               
			                echo "<b style='color: #0B8;'>Present";
			               }else if($att_detail['attendance_status']=='A'){
			                
			                echo "<b style='color: #F01616;'>Absent";
			               }

			               ?>
    		</td>
						
					</tr>
					
				<?php	}
					}
				?>
				  
				</tbody>
			</table>
		</div>
	</div>



</div><!-- end of pannel div-->







