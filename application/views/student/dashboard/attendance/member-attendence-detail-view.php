<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header page-label">Attendance Detail(<?php echo $bodycontent['month'].",".$bodycontent['year']; ?>)</h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url(); ?>memberdashboard">Dashboard</a>
                    </li>

                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="<?php echo base_url(); ?>memberdashboard/attendancedetail">Attendance</a>
                    </li>
                </ol>
            </div>
        </div>
	</div>

	
	<div class="container-fluid">
				<div class="table-responsive"> 
			<table id="dietry-managment-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>In Time</th>
						<th>Out Time</th>
						<th>Workout Time</th>
					</tr>
				</thead>
       
				<tbody>
				<?php 
			
					if($bodycontent['memberAttDetail']){
						$i=1;
						foreach($bodycontent['memberAttDetail'] as $att_detail){
							if($att_detail['in_time'] AND $att_detail['out_time']){
								$dateDiff  = 0;
								$dateDiff = intval((strtotime($att_detail['out_time'])-strtotime($att_detail['in_time']))/60);
								$hour = "";
								$minute = "";
								$min="";
								
								$hour = round($dateDiff/60);
								$minute = $dateDiff%60;
								
								if($hour<10)
								{
									$hr = "0".$hour;
								}
								else
								{
									$hr = $hour;
								}
								
								if($minute<10)
								{
									$min = "0".$minute;
								}
								else
								{
									$min = $minute;
								}
								
								$work_out = $hr." hr ".$min." min";
								
								
							}
							else{
								$work_out = "<i class='fa fa-question' aria-hidden='true' title='Not allowed'></i>";
							}
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
						<td><?php 
							if($att_detail['in_time'])
							{
								echo date('h:i:s A',strtotime($att_detail['in_time']));
							}else{echo "<i class='fa fa-question' aria-hidden='true' title='Not allowed'></i>";}
						?>
						</td>
						<td><?php if($att_detail['out_time']){
								echo date('h:i:s A',strtotime($att_detail['out_time']));
							}
							else{echo "<i class='fa fa-question' aria-hidden='true' title='Not allowed'></i>";}  ?></td>
						<td><?php echo $work_out; ?></td>
						
					</tr>
					
				<?php	}
					}
				?>
				  
				</tbody>
			</table>
		</div>
	</div>

</div>





