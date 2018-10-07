<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/changepass.js"></script>
<section class="content">
	
	<div class="row">
                <div class="col-lg-2">
                   
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Change Password
                        </div>
                        <div class="panel-body">
                            <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="layout_white form-div-container">
			
			<div class="col-md-12 col-sm-12 col-xs-12 bg-white">
				<form class="form-area" name="passwordUpdateForm" id="passwordUpdateForm"
				action="<?php echo base_url();?>generatepassword/generatepass" method="post">
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


					
				
					  
					  <div class="form-group row">
						<div class="col-sm-12">
							<div class="text-center">
								<button type="submit" class="btn btn-md btn-success custome-btn" id="submitBtnpass" style="width:50%;"><i class="fa fa-tags">&nbsp;</i>Update</button>
								
							</div>
						</div>
					  </div>
				</form>
			</div>
			<div class="clearfix"></div>
        </div>
    </div>
</div>

                        </div>
                       
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-2">
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
</section>


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