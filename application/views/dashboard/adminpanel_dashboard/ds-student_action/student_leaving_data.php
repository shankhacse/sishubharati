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
                <h3 class="box-title">Leaving certificate </h3>
                 
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <form id="tcStudentInfo" method="post" action="<?php echo base_url(); ?>studentaction/printLeavingCertificate"  target="_blank">
                <div class="box-body">
                  
                    <?php if($studentdata){
                    ?>
                <input type="hidden" class="" id="student_uniq_id" name="student_uniq_id"  value="<?php echo $studentdata->student_uniq_id;?>" >
                <input type="hidden" class="" id="gender" name="gender"  value="<?php echo $studentdata->gender;?>" >
                <input type="hidden" class="" id="academic_id" name="academic_id"  value="<?php echo $academic_id;?>" > 

                 <div class="row">
                     <div class="col-md-10">   
                  <div class="form-group">

                    <table style="font-weight: 600;color: #0b598a;">
                      <tr>
                        <td>1. Name Of The Student :  <input type="text" class="inptc" id="studentname" name="studentname" placeholder="Student Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->name;?>" ></td>
                        <td>
                          &nbsp; &nbsp;2. Fathers's Name :
                    <input type="text" class="inptc" id="fathername" name="fathername" placeholder="Father Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->father_name;?>" >
                        </td>
                      </tr>
                      <tr>
                        <td>
                           3. Mother's Name : 
                    <input type="text" class="inptc" id="mothetname" name="mothetname" placeholder="Mother Name" autocomplete="off" style="width: 200px;margin-left: 37px" value="<?php echo $studentdata->mother_name;?>" >
                        </td>
                        <td>
                          &nbsp; &nbsp;4.Address Village
                          <input type="text" class="inptc" id="village" name="village" placeholder="Village" autocomplete="off" style="width: 200px;margin-left: 12px" value="<?php echo $studentdata->village;?>" >
                        </td>
                      </tr>
                      <tr>
                        <td> P.S
                          <input type="text" class="inptc" id="police_station" name="police_station" placeholder="Police Station" autocomplete="off" style="width: 200px;margin-left: 130px" value="<?php echo $studentdata->police_station;?>" >
                        </td>
                        <td> &nbsp; &nbsp;Dist
                          <input type="text" class="inptc" id="districname" name="districname" placeholder="District" autocomplete="off" style="width: 200px;margin-left: 92px" value="<?php echo $studentdata->districname;?>" >
                        </td>
                      </tr>

                        <tr>
                        <td> State
                          <input type="text" class="inptc" id="statename" name="statename" placeholder="State" autocomplete="off" style="width: 200px;margin-left: 116px" value="<?php echo $studentdata->statename;?>" >
                        </td>
                        <td> &nbsp; &nbsp;5.Nationality
                          <input type="text" class="inptc" id="nationality" name="nationality" placeholder="Nationality" autocomplete="off" style="width: 200px;margin-left: 37px" value="Indian" >
                        </td>
                      </tr>
                        <tr>
                        <td> 
                          6.Category
                          <input type="text" class="inptc" id="category" name="category" placeholder="Category" autocomplete="off" style="width: 200px;margin-left: 82px" value="<?php echo $studentdata->student_category;?>" >
                        </td>
                        <td> &nbsp;
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">7.Date of admission in the school
                          <input type="text" class="inptc" id="admission_dt" name="admission_dt" placeholder="Admission Date" autocomplete="off" style="width: 200px;" value="<?php echo date("d M Y", strtotime($studentdata->admission_dt));?>" >
                          &nbsp; &nbsp;in class <input type="text" class="inptc" id="admission_class" name="admission_class" placeholder="Admission Class" autocomplete="off" style="width: 200px;margin-left: 27px" value="<?php echo $studentdata->admission_class;?>" >
                        </td>
                      </tr>
                       <tr>
                        <td colspan="2">8.Date of birth according to Admission Register
                          <input type="text" class="inptc" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" autocomplete="off" style="width: 200px;" value="<?php echo date("d M Y", strtotime($studentdata->date_of_birth));?>" >
                         
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">9.Class in which the student studies last
                          <input type="text" class="inptc" id="current_class" name="current_class" placeholder="Current Class" autocomplete="off" style="width: 200px;margin-left:43px" value="<?php echo $studentdata->current_class;?>" >
                         
                        </td>
                      </tr>

                        <tr>
                        <td colspan="2">10.School/Board/Annual Examination last taken with the result
                          <input type="text" class="inptc" id="last_exam" name="last_exam" placeholder="" autocomplete="off" style="width: 200px;" value="" >
                         
                        </td>
                      </tr>

                        <tr>
                        <td colspan="2">11.Subjects studies:
                          <input type="text" class="inptc" id="subjects" name="subjects" placeholder="subjects" autocomplete="off" style="width: 300px;" value="Bengali,Hindi,English,Math,Science" >
                         
                        </td>
                      </tr>

                        <tr>
                        <td colspan="2">12.Wheather qualified for promotion to higher class
                          <input type="text" class="inptc" id="ispromote" name="ispromote" placeholder="" autocomplete="off" style="width: 50px;" value="Yes" >&nbsp; if,so ,to which class:<input type="text" class="inptc" id="promotion" name="promotion" placeholder="" autocomplete="off" style="width: 200px;" value="" >
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">13.Month up to which the school due paid
                          <input type="text" class="inptc" id="lastpaid" name="lastpaid" placeholder="Last paid month" autocomplete="off" style="width:200px;" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">14.Games played /Extra curricular activities in which the student took part (Mention achievment level there in):
                          <input type="text" class="inptc" id="games" name="games" placeholder="" autocomplete="off" style="width:685px;" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                       <tr>
                        <td colspan="2">15.General conduct:
                          <input type="text" class="inptc" id="gencon" name="gencon" placeholder="" autocomplete="off" style="width:200px;margin-left:98px" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                        <tr>
                        <td colspan="2">16.Date of application for certificate:
                          <input type="text" class="inptc" id="dtaplcertificate" name="dtaplcertificate" placeholder="" autocomplete="off" style="width:200px;" value="<?php echo date("d M Y");?>" >&nbsp; 
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">17.Date of issue of certificate:
                          <input type="text" class="inptc" id="issuedate" name="issuedate" placeholder="" autocomplete="off" style="width:200px;margin-left:42px" value="<?php echo date("d M Y");?>" >&nbsp; 
                         
                        </td>
                      </tr>

                       <tr>
                        <td colspan="2">18.Reason for leaving school: 
                          <input type="text" class="inptc" id="leavingreason" name="leavingreason" placeholder="" autocomplete="off" style="width:400px;margin-left:43px" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">19.Marks Of identification
                          <input type="text" class="inptc" id="identification" name="identification" placeholder="" autocomplete="off" style="width:400px;margin-left:62px" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">20.Any other remarks
                          <input type="text" class="inptc" id="otherremarks" name="otherremarks" placeholder="" autocomplete="off" style="width:400px;margin-left:88px" value="" >&nbsp; 
                         
                        </td>
                      </tr>

                       <tr>
                        <td colspan="2">
                             
                         
                         
                        </td>
                      </tr>



                    </table>

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
                                <div class="maxl" style="display: none;">
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

    

