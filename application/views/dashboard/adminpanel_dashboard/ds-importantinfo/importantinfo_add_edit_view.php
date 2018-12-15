  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/importantinfo.js"></script> 
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
        <li class="active">Information ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Information File </h3>
                 <a href="<?php echo base_url();?>importantinfo" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              
             
              <form class="form-area" name="informationForm" id="informationForm" enctype="multipart/form-data">
                <div class="box-body">
             

                  <div class="form-group">
                    <input type="hidden" name="infoID" id="infoID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['InfoEditdata']->info_id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                  
                    

                  
                        <div class="form-group">
                          <label for="subcode">Title</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="infotitle" name="infotitle" placeholder="Enter Information Title" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['InfoEditdata']->title; } ?>" >
                        </div>

                   
                 
<!-- Add document-->
 
<?php $rowno=1;?>


             
 <div class="form-group">
    
       <label for="subcode">Upload File in Pdf Format ( maximum file size 500KB) </label>
          <input type="hidden" name="prvFilename[]" id="prvFilename_0_<?php echo $rowno; ?>" class="form-control prvFilename" value="" readonly >

          <input type="hidden" name="randomFileName[]" id="randomFileName_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="" readonly >

          <input type="hidden" name="docDetailIDs[]" id="docDetailIDs_0_<?php echo $rowno; ?>" class="form-control randomFileName" value="0" readonly >
      
        <input type="file" name="fileName[]" class="file fileName" id="fileName_0_<?php echo $rowno; ?>" accept=".pdf" />
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






                  <p id="infomsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="infosavebtn"><?php echo $bodycontent['btnText']; ?></button>
                    
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="info_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

