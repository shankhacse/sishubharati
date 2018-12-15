<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/classsubject.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  <style type="text/css">
  .error-border{
    border: 1px solid red;
  }
</style>   
   
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add subjects to class</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add subjects to class</h3>
              <a href="<?php echo base_url();?>classsubject/subjectList" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"ClassSubjectForm","name"=>"ClassSubjectForm");
              echo form_open('',$attr); ?>
              <div class="row">
                <p style="color:red;text-align:center;">Note: It is a master Data , Please Save Carefully.</p>
            <div class="col-md-4 ">
              <label for="classList" class="searchby"> Class </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_class" name="sel_class" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                          <?php 
                            if($bodycontent['classList'])
                            {
                              foreach($bodycontent['classList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
                 <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Subjects </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_subject" name="sel_subject[]" class="form-control selectpicker"
                        data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
                        
                          <?php 
                            if($bodycontent['subjectList'])
                            {
                              foreach($bodycontent['subjectList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->subject ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                   <p id="clssubcreatmsg" class="form_error"></p>
                 
                  </div>
             
                </div>
            
           
                 <div class="row">
                    <div class="col-md-offset-3 col-md-6 btnview">
              <button type="submit" class="btn btn-primary formBtn" id="viewblocllist">Create Full Marks</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadsubjectList"> 
               <div class="datatalberes" >
             
             
              </div> 

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





