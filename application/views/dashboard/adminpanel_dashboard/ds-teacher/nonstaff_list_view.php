<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/teacher.js"></script>   
<style type="text/css">
  
  .profile_pic {
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
        <li class="active">Non Staff List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Non Staff List</h3>
              <a href="<?php echo base_url();?>teacher/addTeacher" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th> ID</th>
                  <th> Name</th>
                 
                  <th>Work For</th>
                  <th>Picture</th>
                  <th>DOB</th>
                  <th>Status</th>

                  
                  
                  <th style="text-align:right;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['nonstaffList'] as $value) { 
              		$status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag teacherstatus" data-setstatus="0" data-teacherid="'.$value->teacher_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag teacherstatus" data-setstatus="1" 
                      data-teacherid="'.$value->teacher_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
        $uplodedFolder='teacher_upload';
        if ($value->is_file_uploaded=='Y') {
           $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
        }else{
           $download_link=base_url()."application/assets/images/blank-avatar.jpg";
        }
       
                  ?>

              		

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->teacher_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->subject; ?></td>
						
						<td align="center"> 
							<img src="<?php echo $download_link; ?>" class="profile_pic" />
						
						</td>
            <td><?php 
            if($value->date_of_birth!=''){echo date("Y-m-d", strtotime($value->date_of_birth));} ?></td>
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