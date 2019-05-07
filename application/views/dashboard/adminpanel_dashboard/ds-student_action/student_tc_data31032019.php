  
 <style type="text/css">
   .inptc{
    border: 2px solid #fff;
    background-color: #f2eded;
    text-decoration: underline;
    font-weight: bold;
   }
 </style>


    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock" style="width: 1000px;line-height: 1.6;" >
              <div class="box-header with-border">
                <h3 class="box-title">Transfer Certificate </h3>
                 
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <form id="tcStudentInfo" method="post" action="<?php echo base_url(); ?>studentaction/printTC"  target="_blank">
                <div class="box-body">
                  
                    <?php if($studentdata){
                    ?>
                <input type="hidden" class="" id="student_uniq_id" name="student_uniq_id"  value="<?php echo $studentdata->student_uniq_id;?>" >
                <input type="hidden" class="" id="gender" name="gender"  value="<?php echo $studentdata->gender;?>" >    
                  <div class="form-group">
                  This is certify that <input type="text" class="inptc" id="studentname" name="studentname" placeholder="Student Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->name;?>" >

                    Son/Daughter of (Fathers's Name)
                    <input type="text" class="inptc" id="fathername" name="fathername" placeholder="Father Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->father_name;?>" >
                    
                    & (Mother's Name)
                    <input type="text" class="inptc" id="mothetname" name="mothetname" placeholder="Mother Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->mother_name;?>" >
                    Joined this school in class
                    <input type="text" class="inptc" id="admclassname" name="admclassname" placeholder=" Class Name" autocomplete="off" style="width: 200px;" value="<?php echo $studentdata->admission_class;?>" >
                    on
                    <input type="text" class="inptc" id="admissiondt" name="admissiondt" placeholder=" Admission date" autocomplete="off"  style="width: 200px;" value="<?php echo date('d-M-Y', strtotime($studentdata->admission_dt));?>" >
                    According to the school Records,his/her Date of Birth is 
                     <input type="text" class="inptc" id="dob" name="dob" placeholder=" Birth date" autocomplete="off" style="width: 200px;" value="<?php echo date('d-M-Y', strtotime($studentdata->date_of_birth));?>" >
                     Nationality 
                     <input type="text" class="inptc" id="nationality" name="nationality" placeholder="Nationality" autocomplete="off"  style="width: 200px;" value="Indian" >
                     State 
                     <input type="text" class="inptc" id="state" name="state" placeholder="State" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->statename;?>" >
                      District 
                     <input type="text" class="inptc" id="district" name="district" placeholder="District" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->districname;?>" >
                     village
                     <input type="text" class="inptc" id="village" name="village" placeholder="Village" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->village;?>" >

                     Wheather the pupil belongs to

                      <input type="text" class="inptc" id="caste" name="caste" placeholder="Caste" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->student_category;?>" >Caste.

                      He/She was studying in class
                      <input type="text" class="inptc" id="currentclass" name="currentclass" placeholder="Current Class" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->current_class;?>" >
                      , the school session
                      <input type="text" class="inptc" id="session" name="session" placeholder="Current Session" autocomplete="off"  style="width: 200px;" value="<?php echo $studentdata->year;?>" >
                      bears a good moral character.His/Her behaviour was good with teachers and students.

                  </div>

             

                  
                      
                 
                  
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

    

