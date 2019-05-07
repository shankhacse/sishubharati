
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
    <style>
     <style type="text/css">
   .file {
  visibility: hidden;
  position: absolute;
} 

  </style>


    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Attendance</h3>
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              
             
              <form class="form-area" name="teacherAttendanceEntry" id="teacherAttendanceEntry" enctype="multipart/form-data">
                <div class="box-body">
             

                  <div class="form-group">
                    <input type="hidden" name="teacherID" id="teacherID" value="<?php echo $teacherEditdata->teacher_id;?>" />
                    <input type="hidden" name="teacherattendID" id="teacherattendID" value="<?php echo $teacherattendID;?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>" />
                  
                    <div class="row">
                      <div class="col-md-8 col-sm-12 col-xs-12">

                             <div class="form-group">
                          <label for="subcode"> Name</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="teacher" name="teacher" placeholder="Enter Teacher Name" autocomplete="off" value="<?php if($mode=="EDIT"){echo $teacherEditdata->name; } ?>" readonly >
                        </div>


                        
                           <div class="form-group">
                            <label>Entry Date</label>

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input class="form-control pull-right datepicker" id="attdate" name="attdate" type="text" value="<?php if($mode=="EDIT"){echo date("d/m/Y");}?>" >
                            </div>
                          
                            <!-- /.input group -->
                          </div>
                         
                      

                

                  
                 
<!-- Add document-->
 
<?php $rowno=1;?>



             
 <div class="form-group">
    
     
        <div class="input-group col-md-5" style="float: left;">
               <div class="form-group">
                              <label>In Time </label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input class="form-control pull-right timepickers" id="intime" name="intime" type="text" value="">
                  </div>

                   </div>
           
        </div>
      
             <div class="input-group col-md-offset-2 col-md-5" style="float: left;">
               <div class="form-group">
                              <label>Out Time </label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input class="form-control pull-right timepickers" id="outtime" name="outtime" type="text" value="">
                  </div>

                   </div>
           
        </div>
     


</div>




<!-- end of Add document-->



                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">

                        <div class="student_picture" style="width: 163px;height:186px;border: 2px solid #cd558e;margin-top:25px;margin-left: 9px;">
                              <img id="profile_img" src="<?php if($mode=="EDIT"){
                                
                                if($teacherEditdata->is_file_uploaded=='Y'){
echo base_url()."application/assets/ds-documents/teacher_upload/".$teacherEditdata->random_file_name;
                                }else{
                                  echo base_url()."application/assets/images/blank-avatar.jpg";
                                }


                            }else{ echo base_url(); ?>application/assets/images/blank-avatar.jpg<?php }?>" alt="Profile Picture" / style="width:159px;height:182px;">

                              <input type="hidden" id="derault_profile_src" name="derault_profile_src" value="<?php echo base_url(); ?>application/assets/images/blank-avatar.jpg">
                              
                            </div>
                           

                      </div>
                      </div>

                  <div class="row">
                       <div class="col-md-8 col-sm-12 col-xs-12">
                        
                          
                      </div>    
                </div> 





                  <p id="teacherattmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="teacherattsavebtn"><?php echo $btnText; ?></button>
                    
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $btnTextLoader; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="teacheratt_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

