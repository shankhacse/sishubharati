 <style type="text/css">
   .inptc{
    border: 2px solid #fff;
    background-color: #f2eded;
    text-decoration: underline;
    font-weight: bold;
   }


.inline{
  #display: inline-block;
}
.inline + .inline{
  margin-left:10px;
}
.radio{
  color:#999;
  font-size:15px;
  position:relative;
}
.radio span{
  position:relative;
   padding-left:20px;
}
.radio span:after{
  content:'';
  width:15px;
  height:15px;
  border:3px solid;
  position:absolute;
  left:0;
  top:1px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
  box-sizing:border-box;
  -ms-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
}
.radio input[type="radio"]{
   cursor: pointer; 
  position:absolute;
  width:100%;
  height:100%;
  z-index: 1;
  opacity: 0;
  filter: alpha(opacity=0);
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
}
.radio input[type="radio"]:checked + span{
  color:#0B8;  
}
.radio input[type="radio"]:checked + span:before{
    content:'';
  width:5px;
  height:5px;
  position:absolute;
  background:#0B8;
  left:5px;
  top:6px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
}

.radiocol input[type="radio"]:checked + span{
  color:#F01616;  
}
.radiocol input[type="radio"]:checked + span:before{
    content:'';
  width:5px;
  height:5px;
  position:absolute;
  background:#F01616;
  left:5px;
  top:6px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
}


   
    </style>


    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock" style="width: 1000px;line-height: 1.6;" >
              <div class="box-header with-border">
                <h3 class="box-title">Character certificate </h3>
                 
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <form id="tcStudentInfo" method="post" action="<?php echo base_url(); ?>studentaction/printCharacterCertificate"  target="_blank">
                <div class="box-body">
                  
                    <?php if($studentdata){
                    ?>
                <input type="hidden" class="" id="student_uniq_id" name="student_uniq_id"  value="<?php echo $studentdata->student_uniq_id;?>" >
                <input type="hidden" class="" id="gender" name="gender"  value="<?php echo $studentdata->gender;?>" >
                <input type="hidden" class="" id="academic_id" name="academic_id"  value="<?php echo $academic_id;?>" > 

                 <div class="row">
                     <div class="col-md-10">   
                  <div class="form-group">
                  This is to certify that <input type="text" class="inptc" id="studentname" name="studentname" placeholder="Student Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->name;?>" >

                    Son/Daughter of (Fathers's Name)
                    <input type="text" class="inptc" id="fathername" name="fathername" placeholder="Father Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->father_name;?>" >
                    
                    & (Mother's Name)
                    <input type="text" class="inptc" id="mothetname" name="mothetname" placeholder="Mother Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->mother_name;?>" >
                    has been bonafied student of Pandaveswar Sishu Bharati Vidya Mandir for last 
                    <input type="text" class="inptc" id="years" name="years" placeholder="years" autocomplete="off" style="width: 200px;" value="<?php //echo $studentdata->admission_class;?>" > years.
                   He/She was very obedient,sincere and hardworking.

                    According to the school Records,his/her Date of Birth is 
                     <input type="text" class="inptc" id="dob" name="dob" placeholder=" Birth date" autocomplete="off" style="width: 200px;" value="<?php echo date('d-M-Y', strtotime($studentdata->date_of_birth));?>" >
                   
                      He/She 
                      bears a good moral character.His/Her behaviour was good with teachers and students.
                      I wish all success and prosperity in her life. 

                              <div class="maxl" >
                    <label class="radio inline">&nbsp;&nbsp; <b>Need Print Date :<b>&nbsp;
                        <input type="radio" name="needsign" value="Y" >
                        <span> Yes </span> 
                     </label>
                    <label class="radio radiocol inline"> 
                        <input type="radio" name="needsign" value="N" checked>
                        <span>No </span> 
                    
                     </label>
                          <input type="text" class="inptc" id="printdate" name="printdate" placeholder="" autocomplete="off" style="width:200px;margin-left:5px" value="<?php echo date("d.m.Y");?>" >&nbsp; & &nbsp; Signature
                  </div>

                  </div>

                  </div>
                  <div class="col-md-2"> 

                    <?php


                       $uplodedFolder='admission_upload';
        if ($studentdata->is_file_uploaded=='Y') {
           $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$studentdata->random_file_name;
        }else{
          if ($studentdata->gender=="M") {
                   $download_link=base_url()."application/assets/images/male_avatar.jpg";
                 }elseif ($studentdata->gender=="F") {
                    $download_link=base_url()."application/assets/images/female_blank_avatar.jpg";
                 } 

          
        }


                    ?>
                    <div class="student_picture" style="width: 135px;height:161px;border: 2px solid #cd558e;">
                             <!--  <img id="profile_img" src="/sishubharati/application/assets/images/blank-avatar.jpg" alt="Profile Picture" style="width:140px;height:160px;"> -->
                               <img src="<?php echo $download_link; ?>" class="profile_pic" style="width: 35mm;height: 42mm;" />

                              <input id="derault_profile_src" name="derault_profile_src" value="/sishubharati/application/assets/images/blank-avatar.jpg" type="hidden">
                              
                            </div>
                                <div class="maxl">
                    <label class="radio inline">&nbsp;  
                        <input type="radio" name="needpicture" value="Y" >
                        <span> Yes </span> 
                     </label>
                    <label class="radio radiocol inline"> 
                        <input type="radio" name="needpicture" value="N" checked>
                        <span>No </span> 
                    </label>
                  </div>
                    </div>


                </div><!--end of row -->

             

                  
                      
                 
                  
                  <p id="classmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-warning formBtn" id="clssavebtn">
                        <span class="glyphicon glyphicon-print"></span> &nbsp;Print Certificate</button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
            
            <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                   <?php }else{ echo "No record found";}?>
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="cls_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    

