<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/publishresult.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subject List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Term List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:60%;">Term</th>
                  <th style="width:10%;">Session Year</th>
                  
                 
                  <th style="width:20%;">Result Publish Status</th>
                  
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['termList'] as $value) { 
              			$status = "";
              			if($value->is_publish=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag resultpublishstatus" data-setstatus="N" data-publishid="'.$value->id.'"><span class="glyphicon glyphicon-ok"></span> Published</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag resultpublishstatus" data-setstatus="Y" 
              				data-publishid="'.$value->id.'"><span class="glyphicon glyphicon-remove"></span> Not Publish</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $value->id; ?></td>
            <td><?php echo $value->term; ?></td>
            <td><?php echo $value->year; ?></td>
						
						
						
						<td style="text-align: center;"><?php echo $status; ?></td>
						
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>

              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->