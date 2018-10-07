<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/holidays.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Holiday List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Holiday List</h3>
              <a href="<?php echo base_url();?>holidays/addholidays" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Date</th>
                  <th>Holiday</th>
                  <th style="text-align:right;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['holidaysList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo date("d M Y", strtotime($value->date));?></td>
						<td><?php echo $value->title; ?></td>
						
						
						
						<td align="center"> 
							<a href="<?php echo base_url(); ?>holidays/addholidays/<?php echo $value->id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
              <a href="javascript:;" class="btn btn-danger btn-xs deleteholi" 
              data-title="Delete"
              data-holiid="<?php echo $value->id;?>"
              >
                <span class="glyphicon glyphicon-remove"></span>
              </a>
						
						</td>
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