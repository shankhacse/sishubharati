  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/teacher.js"></script> 
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
        <li class="active">Teachers ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Teacher </h3>
                 <a href="<?php echo base_url();?>teacher" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              
             
              <form class="form-area" name="teacherForm" id="teacherForm" enctype="multipart/form-data">
                <div class="box-body">
             

                  <div class="form-group">
                    <input type="hidden" name="teacherID" id="teacherID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['teacherEditdata']->teacher_id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                  
                    <div class="row">
                      <div class="col-md-8 col-sm-12 col-xs-12">

                             <div class="form-group">
                          <label for="subcode">Teacher Name</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="teacher" name="teacher" placeholder="Enter Teacher Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['teacherEditdata']->name; } ?>" >
                        </div>


                        <div class="form-group">
                          <label for="subcode">Subject</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="subject" name="subject" placeholder="Enter Teacher Subject" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['teacherEditdata']->subject; } ?>" >
                        </div>

                

                  
                 
<!-- Add document-->
 
<?php $rowno=1;?>


             
 <div class="form-group">
    
       <label for="subcode">Maximum file size 500KB </label>
          <input type="hidden" name="prvFilename[]" id="prvFilename_0_<?php echo $rowno; ?>" class="form-control prvFilename" value="" readonly >

          <input type="hidden" name="randomFileName[]" id="randomFileName_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="" readonly >

          <input type="hidden" name="docDetailIDs[]" id="docDetailIDs_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="0" readonly >
      
        <input type="file" name="fileName[]" class="file fileName" id="fileName_0_<?php echo $rowno; ?>" accept=".jpg , .jpeg , .png" />
        <div class="input-group col-xs-12">
             <!--  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span> -->
          <input type="text" name="userFileName[]" id="userFileName_0_<?php echo $rowno; ?>" class="form-control input-xs userFileName" readonly placeholder="Upload Document" >

            <input type="hidden" name="isChangedFile[]" id="isChangedFile_0_<?php echo $rowno; ?>" value="Y" >
            <span class="input-group-btn">
              <button class="browse btn btn-primary input-xs" type="button" id="uploadBtn_0_<?php echo $rowno; ?>">
                  <i class="fa fa-folder-open" aria-hidden="true"></i>
            </button>
              </span>
        </div>
     


</div>




<!-- end of Add document-->


                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">

                        <div class="student_picture" style="width: 163px;height:186px;border: 2px solid #cd558e;margin-top:25px;margin-left: 9px;">
                              <img id="profile_img" src="<?php if($bodycontent['mode']=="EDIT"){echo base_url()."application/assets/ds-documents/teacher_upload/".$bodycontent['teacherEditdata']->random_file_name;}else{ echo base_url(); ?>application/assets/images/blank-avatar.jpg<?php }?>" alt="Profile Picture" / style="width:159px;height:182px;">

                              <input type="hidden" id="derault_profile_src" name="derault_profile_src" value="<?php echo base_url(); ?>application/assets/images/blank-avatar.jpg">
                            </div>

                      </div>
                      </div>

                  
                   





                  <p id="teachermsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="teachersavebtn"><?php echo $bodycontent['btnText']; ?></button>
                    
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="teacher_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->
