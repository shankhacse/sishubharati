<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/teacher.js"></script>   
<style type="text/css">
  
  .events_poster {
    width: 100px;
    height: 70px;
    border-radius: 10%;
    border: 1px solid #989898;
}
</style>  
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Teacher List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Teachers List</h3>
              <a href="<?php echo base_url();?>teacher/addTeacher" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Teacher Name</th>
                
                  <th>Subject</th>
                  <th>Picture</th>
                  <th>Status</th>

                  
                  
                  <th style="text-align:right;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['teacherList'] as $value) { 
              		$status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag eventsstatus" data-setstatus="0" data-eventsid="'.$value->teacher_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag eventsstatus" data-setstatus="1" 
                      data-eventsid="'.$value->teacher_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
        $uplodedFolder='teacher_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

              		

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->subject; ?></td>
						
						<td align="center"> 
							<img src="<?php echo $download_link; ?>" class="events_poster" />
						
						</td>
            <td><?php echo $status; ?></td>
            <td align="center"> 
            
              <a href="<?php echo base_url(); ?>teacher/addTeacher/<?php echo $value->teacher_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
                <span class="glyphicon glyphicon-pencil"></span>
              </a>
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