
 <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/admission.js"></script>  

 <style>
.modal {
  padding: 0 !important;
  text-align: center;
}
.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}
.modal .modal-dialog {
  text-align: left;
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  max-width: 90%;
}
.modal .close {
  position: absolute;
  right: 10px;
  color: black;
  text-shadow: none;
  font-size: 30px;
  line-height: 30px;
  top: 10px;
  opacity: 1;
}
.option_img{
height:200px;
width:160px;
border: 0.3em  solid #d4d4d4;
margin-top:10px;
}
.student_model{
padding:20px;
#box-shadow: 3px 3px 10px 1px rgba(95, 114, 146, 0.3);
}
.student_model h5
{
  font-family: "Gingham Variable", BlinkMacSystemFont, sans-serif;
  font-size: 15px;
  color:#1A5276;
}
@media screen and (max-width: 568px) {
.option_img{
width:100%;
height:auto;
}
}

.upper_div{
padding:20px;
margin:10px;
}
.image_box{
padding:20px


}
.image_box h3{
text-align: center;


}
.image_box img{
    margin-left: auto;
  margin-right: auto;
  display: block;
  }
  
  
  .custome_table tr{
  width:40%
  }


</style>
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
               <button type="button" class="btn btn-sm bg-yellow viewStudentinfo" data-toggle="modal" data-target="#student_info" data-studentid=<?php echo $value['studentMasterData']->student_id;?> data-studentdtlmode ="INFO" data-studentname="<?php echo $value['studentMasterData']->name; ?>" >View </button> 

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





      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="student_info" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="st_name"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>



