 <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/admission.js"></script>  
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" id="centerListing">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Student</h3>
              <a href="<?php echo base_url();?>admission/addStudent" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="studentlist" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>Documents</th>
                  <th>Details</th>
                 
                  <th style="text-align:right;width:3%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['studentList'] as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

              			$status = "";
              			if($value['studentMasterData']->is_active=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag centerstatus" data-setstatus="N" data-pinid="'.$value['studentMasterData']->student_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag centerstatus" data-setstatus="Y" 
              				data-pinid="'.$value['studentMasterData']->student_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value['studentMasterData']->student_uniq_id; ?></td>
            <td><?php echo $value['studentMasterData']->name; ?></td>
            <td><?php echo $value['studentMasterData']->class_name; ?></td>
            <td><?php echo $value['studentMasterData']->class_roll; ?></td>
           
           
						<td>
              <button type="button" class="btn btn-sm bg-purple studentDocDtl" data-toggle="modal" data-target="#pop_modal_detail_admin" data-studentid=<?php echo $value['studentMasterData']->student_id;?> data-studentdtlmode ="DOCS" data-studentname="<?php echo $value['studentMasterData']->name; ?>" >Documents <span class="badge" style="color:#605ca8;"><?php echo count($value['studentUploadedDocsData']); ?></span></button> 
            </td>

             <td align="center">
              <button type="button" class="btn btn-sm bg-blue" style="color:#fff;" >
                <a href="<?php echo base_url(); ?>patient/viewpatient/<?php //echo $value->patient_id; ?>" data-title="Details" style="color:#fff;">Documents
               
              </a>
              </button> 

             </td>
	
						<td align="center" style="vertical-align:middle;padding:0;"> 
							<a href="<?php echo base_url(); ?>admission/addStudent/<?php echo $value['studentMasterData']->student_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
						
						</td>
					</tr>
              			
              	<?php
              		}

              	?>
                 <tfoot>
                <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                
               </tr>
                </tfoot>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->



