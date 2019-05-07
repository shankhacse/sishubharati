
 <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/changeteacherpass.js"></script> 




 <!-- Main content -->
    <section class="content">

		    <div class="box box-primary formBlock">
            <div class="box-header">
              <h3 class="box-title"> Change Password(Teacher)</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            	<form class="form-area" name="teacherpasswordUpdateForm" id="teacherpasswordUpdateForm"
				 method="post">
					<input type="hidden" value="<?php echo base_url(); ?>" id="basepath" />
					
				
				
					<div class="form-group row">
						<label for="currency_name" class="col-sm-4 col-form-label">Current Password</label>
						<div class="col-sm-8">
						  <input type="password" class="form-control custom_frm_input" id="cur_pass" name="cur_pass"  placeholder="Current Password" value="">
						
						</div>
					</div>
				
						<div class="form-group row">
						<label for="currency_name" class="col-sm-4 col-form-label">New Password</label>
						<div class="col-sm-8">
						  <input type="password" class="form-control custom_frm_input" id="password" name="password"  placeholder="New Password" value="">
						
						</div>
					</div>
						<div class="form-group row">
						<label for="currency_name" class="col-sm-4 col-form-label">Confirm Password</label>
						<div class="col-sm-8">
						  <input type="password" class="form-control custom_frm_input" id="cpass" name="cpass"  placeholder="Confirm Password" value="">
						
						</div>
					</div>
					

				
				 	<div class="row">
						<div class="col-sm-4">
							<p>&nbsp;</p>
						</div>
						<div class="col-sm-8">
							&nbsp;&nbsp;<p class="password-validation-err validation-err" style="color: red;"></p>
						</div>
					</div>


					
				 <div class="row">
                    <div class="col-md-offset-6 col-md-6 btnview">
                       <p id="teacherattregmsg" class="form_error"></p>
              <button type="submit" class="btn btn-primary" id="submitBtnpass" ><i class="fa fa-tags">&nbsp;</i>Update</button>
								
              </div>
                 </div>
					  
					 <!--  <div class="form-group row">
						<div class="col-sm-12">
							<div class="text-center">
								<button type="submit" class="btn btn-md btn-success custome-btn" id="submitBtnpass" style="width:50%;"><i class="fa fa-tags">&nbsp;</i>Update</button>
								
							</div>
						</div>
					  </div> -->
				</form>

             

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
           

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->



 <!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <p id="save-msg-data"></p>
      </div>
      <div class="modal-footer">
      
    
    
    
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="return redirectStudentDashnoard();">Close</button>
       
      </div>
    </div>

  </div>
</div>