<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/classmaster.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Class </h3>
                 <a href="<?php echo base_url();?>classmaster" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"ClassForm","name"=>"ClassForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="classID" id="classID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['ClassEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="adtype">Admisson Type</label> 
                    <select id="adtype" name="adtype" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                     <option value="0">Select</option>
                      <?php 
                      if($bodycontent['admissointypeList'])
                      {
                        foreach($bodycontent['admissointypeList'] as $value)
                        { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['ClassEditdata']->admisson_type_id==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->type; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="classname">Class</label>
                    <input type="text" class="form-control forminputs typeahead" id="classname" name="classname" placeholder="Enter Class Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['ClassEditdata']->name;}?>" >
                  </div>

                  
                        <div class="form-group">
                          <label for="cordpin">Class Code</label>
                          <input type="text" minlength="2" maxlength="2"  class="form-control forminputs removeerr typeahead " id="classcode" name="classcode" placeholder="Enter Class Code" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['ClassEditdata']->class_code; } ?>" >
                        </div>
                 

                  <p id="classmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="clssavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="cls_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

