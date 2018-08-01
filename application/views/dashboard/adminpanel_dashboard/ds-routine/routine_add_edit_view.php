<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/routine.js"></script>  

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
                <a href="<?php echo base_url();?>routine" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
            
                <form class="form-area" name="RoutineForm" id="RoutineForm" enctype="multipart/form-data">
                 <input type="hidden" name="routineID" id="routineID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['routineEditdata'][0]->id;}else{echo "0";}?>" />
              
                  <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                <div class="box-body">

                   
                    <div class="row">
                  
                  

                      <div class="col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                           <label for="classList">Class</label> 
                           <div id="clserr">
                              <select id="sel_class" name="sel_class" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="0">Select</option>
                           <?php
                        
                          foreach ($bodycontent['classList'] as $value) { ?>

                            <option value="<?php echo $value->id; ?>"
                               <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][0]->class_id==$value->id){echo "selected";}else{echo "";} ?>
                               ><?php echo $value->name; ?></option>

                            <?php } ?>
                                                 
                              </select>
                            </div>
                      
                         </div>
                      </div>
                    </div>

                <div class="box ">
                 <div class="box-body  no-padding">    
                  <table class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th>Week Day</th>
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
                          $row=0;
                          foreach ($bodycontent['dayList'] as $value) { ?>
                      <tr>
                        <td>
                       <?php echo $value->days_name;?>
                        </td>
                        <td>
                          <input type="hidden" name="day[]" value="<?php echo $value->id;?>">
                          <input type="hidden" name="routine_details[]" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['routineEditdata'][$row]->routine_details_id;}else{echo "";}?>">
                          <div id="sel_subfirsterr_<?php echo $row?>">
                          <select id="sel_subfirst_<?php echo $row?>" name="sel_subfirst[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                      <option value="0">Select</option> 
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                          <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->first_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                          ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                        </td>
                        <td>
                          <div id="sel_subseconderr_<?php echo $row?>">
                            <select id="sel_subsecond_<?php echo $row?>" name="sel_subsecond[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                          <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->second_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                          ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                        </td>
                        <td>
                          <div id="sel_subthirderr_<?php echo $row?>">
                          <select id="sel_subthird_<?php echo $row?>" name="sel_subthird[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                           <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->third_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                           ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                        </td>
                        <td>&nbsp;</td>
                        <td>
                         <div id="sel_subfourtherr_<?php echo $row?>">
                           <select id="sel_subfourth_<?php echo $row?>" name="sel_subfourth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                           <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->fourth_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                           ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                       
                        </td>
                        <td>
                          <div id="sel_subfiftherr_<?php echo $row?>">
                           <select id="sel_subfifth_<?php echo $row?>" name="sel_subfifth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                          <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->fifth_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                          ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                        </td>
                        <td>
                          <div id="sel_subsixtherr_<?php echo $row?>">
                           <select id="sel_subsixth_<?php echo $row?>" name="sel_subsixth[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php foreach ($bodycontent['subjectList'] as $value) { ?>
                        <option value="<?php echo $value->id; ?>"
                          <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['routineEditdata'][$row]->sixth_cls_sub_id==$value->id){echo "selected";}else{echo "";} ?>
                          ><?php echo $value->subject; ?></option><?php } ?>
                                                 
                         </select></div>
                        </td>
                      </tr>
                      <?php $row++;} ?>

                      <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">
                    
                    </tbody>
                  </table>
                </div>
                </div>





              



                    				
					
                  <p id="routinemsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="routinesavebtn"><?php echo $bodycontent['btnText']; ?></button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                      
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="routine_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


