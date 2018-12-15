<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/message.js"></script>
<section class="content">
	
	<div class="row">
                <div class="col-lg-2">
                   
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Send Message
                        </div>
                        <div class="panel-body">
                            <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="layout_white form-div-container">
			
			<div class="col-md-12 col-sm-12 col-xs-12 bg-white">
				
				<?php 
              $attr = array("id"=>"SendMessageForm","name"=>"SendMessageForm");
              echo form_open('',$attr); ?>
					<input type="hidden" value="<?php echo base_url(); ?>" id="basepath" />
			<input type="hidden" value="<?php echo $bodycontent['student_uniq_id']; ?>" id="student_uniq_id" name="student_uniq_id" />
			<input type="hidden" value="<?php echo $bodycontent['academic_id']; ?>" id="academic_id" name="academic_id" />
					
				
				
					<div class="form-group row">
						<label for="currency_name" class="col-sm-4 col-form-label">New Message</label>
						<div class="col-sm-8">
						  <textarea type="text" class="form-control custom_frm_input" id="message" name="message"  placeholder="New message" style="height: 100px;"></textarea>
						
						</div>
					</div>
				
					

				
				 	<div class="row">
						<div class="col-sm-4">
							<p>&nbsp;</p>
						</div>
						<div class="col-sm-8">
							&nbsp;&nbsp;<p class="msg-validation-err validation-err" style="color: red;"></p>
						</div>
					</div>


					
				
					  
					  <div class="form-group row">
						<div class="col-sm-12">
							<div class="text-center">
								<button type="submit" class="btn btn-md btn-success custome-btn"  style="width:50%;"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send</button>
								
							</div>
						</div>
					  </div>
				 <?php echo form_close(); ?>
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


            <div class="row">
                <div class="col-lg-1">
                   
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-10">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Message List
                        </div>
                        <div class="panel-body">
                            <div class="row">

                            	<div class="table-responsive" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped " style="border-collapse: collapse !important;">
                <thead>
                <tr>
                        <th width="5%">Sl</th>
                        
                        <th width="40%">Message</th>
                        <th width="10%">Send Date</th>
                        <th width="40%">Reply From Admin</th>
                        <th width="10%">Reply Date</th>
                        
                 
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['messageList'] as $key => $value) { 
              		
              		?>

					<tr>
						
            <td><?php echo $i++; ?></td>
            
          
            <td><?php echo $value->student_message; ?></td>
            <td><?php echo date("d M Y", strtotime($value->created_on)); ?></td>
            <td><?php echo $value->admin_reply; ?></td>
            <td><?php 
            if ($value->admin_reply_date!='') {
            	 echo date("d M Y", strtotime($value->admin_reply_date));
            }
            ?></td>
            
						
						
					</tr>
              			
              	<?php
              	}

              	?>

                </tbody>
               
              </table>

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
      
    
    
    
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="return redirectStudentMessage();">Close</button>
       
      </div>
    </div>

  </div>
</div>