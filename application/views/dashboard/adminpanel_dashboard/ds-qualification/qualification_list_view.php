<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/classmaster.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Education Qualification List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Education Qualification List</h3>
              <a href="<?php echo base_url();?>qualification/addqualification" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Qualification</th>
                 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['qualificationList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->qualification_type; ?></td>
						
						
					
						<td align="center"> 
							<a href="<?php echo base_url(); ?>qualification/addqualification/<?php echo $value->qualification_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
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