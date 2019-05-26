<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentmarks.js"></script>
<section class="content">
	
	<div class="row">
                <div class="col-lg-2">
                   
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Exam results
                            <a href="<?php echo base_url();?>studentdashboard/gradelist" style="color: #fff;float: right;" ><span class="glyphicon glyphicon-list"></span> Grade List</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="layout_white form-div-container">
			
			<div class="col-md-12 col-sm-12 col-xs-12 bg-white">
				 <?php
              $attr = array("id"=>"StudentMarksViewForm","name"=>"StudentMarksViewForm");
              echo form_open('',$attr); ?>
					<input type="hidden" value="<?php echo base_url(); ?>" id="basepath" />
					
				
				
					<div class="form-group row">
						<label for="currency_name" class="col-sm-4 col-form-label">Select Term</label>
						<div class="col-sm-8">
						 <select id="term" name="term" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['termList'])
                          {
                          foreach($bodycontent['termList'] as $value)
                          { ?>
                            <option value="<?php echo $value->term; ?>" ><?php echo $value->term; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
						
						</div>
					</div>
				
					
						
					

				
				 	<div class="row">
						<div class="col-sm-4">
							<p>&nbsp;</p>
						</div>
						<div class="col-sm-8">
							&nbsp;&nbsp;<p class="validation-err" id="markserr" style="color: red;"></p>
						</div>
					</div>


					
				
					  
					  <div class="form-group row">
						<div class="col-sm-12">
							<div class="text-center">
								<button type="submit" class="btn btn-md btn-success custome-btn" id="submitBtnpass" style="width:50%;"><i class="fa fa-tags">&nbsp;</i>View Marks</button>
								
							</div>
						</div>
					  </div>
					   <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
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
</section>

 <section id="loadStudentMarksheet"> 
               <div class="datatalberes" >
             
             
              </div> 

             </section>


