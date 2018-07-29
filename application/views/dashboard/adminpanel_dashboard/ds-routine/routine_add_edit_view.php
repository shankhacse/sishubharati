<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/admission.js"></script>  

    <style type="text/css">
   .file {
  visibility: hidden;
  position: absolute;
} 

  </style> 
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student <?php echo $bodycontent['mode']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockLarge">
              <div class="box-header with-border">
                <h3 class="box-title">Routine -<?php echo $bodycontent['year']->year;?></h3>
                <a href="<?php echo base_url();?>admission" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
             
                <form class="form-area" name="AdmissionForm" id="AdmissionForm" enctype="multipart/form-data">
                 <input type="hidden" name="studentID" id="studentID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['routineEditdata']->student_id;}else{echo "0";}?>" />
              
                  <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                <div class="box-body">

                   
                    <div class="row">
                  
                  

                      <div class="col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                           <label for="classList">Class</label> 
                          
                              <select id="sel_class" name="sel_class" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="0">Select</option>
                           <?php
                        
                          foreach ($bodycontent['classList'] as $value) { ?>

                          <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>

                            <?php } ?>
                                                 
                              </select>
                      
                         </div>
                      </div>
                    </div>

                <div class="box ">
                 <div class="box-body  no-padding">    
                  <table class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th>Days</th>
                        <th>First</th>
                        <th>Second</th>
                        <th>Third</th>
                        <th>Break</th>
                        <th>Fourth</th>
                        <th>Fifth</th>
                        <th>Sixth</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                          $row=1;
                          foreach ($bodycontent['dayList'] as $value) { ?>
                      <tr>
                        <td>
                       <?php echo $value->days_name?>
                        </td>
                        <td>
                          <select id="sel_subfirst_<?php echo $row?>" name="sel_subfirst[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                        <td>
                          <select id="sel_subsecond_<?php echo $row?>" name="sel_subsecond[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                        <td>
                          <select id="sel_subthird_<?php echo $row?>" name="sel_subthird" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                        <td>&nbsp;</td>
                        <td>
                           <select id="sel_subfourth_<?php echo $row?>" name="sel_subfourth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                        <td>
                           <select id="sel_subfifth_<?php echo $row?>" name="sel_subfifth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                        <td>
                           <select id="sel_subsixth_<?php echo $row?>" name="sel_subsixth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select>
                        </td>
                      </tr>
                      <?php $row++;} ?>
                    
                    </tbody>
                  </table>
                </div>
                </div>





              



                    				
					
                  <p id="routinemsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="admsavebtn"><?php echo $bodycontent['btnText']; ?></button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                      
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="adm_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


