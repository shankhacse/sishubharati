<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/qualification.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Qualification ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Qualification </h3>
                 <a href="<?php echo base_url();?>qualification" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"QualificationForm","name"=>"QualificationForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                	<input type="hidden" name="qualificationID" id="qualificationID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['qualificationEditdata']->qualification_id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                 

                  

                  <div class="form-group">
                    <label for="classname">Qualification</label>
                    <input type="text" class="form-control forminputs typeahead" id="qualification" name="qualification" placeholder="Enter Qualification Type" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['qualificationEditdata']->qualification_type;}?>" >
                  </div>

                 

                  <p id="qualificationmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="qulsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="qul_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

