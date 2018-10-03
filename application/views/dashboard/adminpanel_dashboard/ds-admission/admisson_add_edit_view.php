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
        <div class="box box-primary formBlockMedium">
              <div class="box-header with-border">
                <h3 class="box-title">Registration -<?php echo $bodycontent['year']->year;?></h3>
                <a href="<?php echo base_url();?>admission" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
             
                <form class="form-area" name="AdmissionForm" id="AdmissionForm" enctype="multipart/form-data">
                 <input type="hidden" name="studentID" id="studentID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->student_id;}else{echo "0";}?>" />
              
                  <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                <div class="box-body">
                  <p style="color:red">Note: Please Select Carefully , you can not modify Admission Type and Class after save the Details.</p>
                   <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Admission Info</p>
                    <div class="row">
                   <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group">
                           <label for="admtype">Admission Type</label> 
                        <select id="admtype" name="admtype" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['admissiontypeList'])
                          {
                          foreach($bodycontent['admissiontypeList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->admission_type==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->type; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                   </div>
                </div>
                  

                      <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="form-group">
                           <label for="classList">Class</label> 
                           <div id="classview">
                              <select id="sel_class" name="sel_class" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="0">Select</option>
                           <?php
                           if($bodycontent['mode']=="EDIT"){
                          foreach ($bodycontent['classList'] as $value) { ?>

                          <option value="<?php echo $value->id; ?>" <?php if($bodycontent['admissionEditdata']->class_id==$value->id){echo "selected";}else{echo "";} ?>><?php echo $value->name; ?></option>

                            <?php }

                          }
                            ?>
                                                 
                              </select>
                              </div>
                         </div>
                      </div>
                    </div>


                          <div class="row">
                   <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                <label>Date of Admission</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datemask" id="dtadm" name="dtadm" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo date("d/m/Y",strtotime($bodycontent['admissionEditdata']->admission_dt));}else{echo date('d/m/Y');}  ?>">
                  

                </div>
                <!-- /.input group -->
              </div>
              
                  </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="form-group">
                     <label for="classList">Class Roll</label> 
                     <input type="text" class="form-control forminputs removeerr" id="classroll" name="classroll" placeholder="Class Roll" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->class_roll; } ?>" readonly />
                  </div>
                 </div>

                    </div>


                   <div class="row">
                 
                    <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                   <label for="classList">Entry Class (optional)</label> 
                   <input type="text" class="form-control forminputs removeerr" id="entrycls" name="entrycls" placeholder="Entry Class Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->entry_class; } ?>" />
                                   </div>
                                  </div>


                     <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                   <label for="classList">SL NO.</label> 
                   <input type="text" class="form-control forminputs removeerr" id="frmslno" name="frmslno" placeholder="Form Serial Number" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->frm_slno; } ?>" />
                                   </div>
                                  </div>
                  </div> 




                  <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Primary Info</p>
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="studentname">Student Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="studentname" name="studentname" placeholder="Enter Student Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->name; } ?>" />

                         
                         
                         
                        </div>
                      </div>
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordgender">Gender</label>
                        <select id="studentgender" name="studentgender" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" > 
                          <option value="0">Select</option>
                          <option value="M" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->gender=="M" ){echo "selected";}else{echo "";} ?>>Male</option>
                          <option value="F" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->gender=="F" ){echo "selected";}else{echo "";} ?>>Female</option>
                          <option value="O" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->gender=="O" ){echo "selected";}else{echo "";} ?>>Other</option>

                         </select>
                        </div>
                      </div>
                   
                    </div>

                     <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>Date of Birth</label>

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input class="form-control pull-right datemask" id="studentdob" name="studentdob" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo date("d/m/Y",strtotime($bodycontent['admissionEditdata']->date_of_birth));}?>" >
                            </div>
                          
                            <!-- /.input group -->
                          </div>
                          
                  </div>

                     <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group">
                           <label for="category">Category</label> 
                        <select id="category" name="category" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['categoryList'])
                          {
                          foreach($bodycontent['categoryList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->category==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->category; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                   </div>
                </div>
                     
                     </div>

                     <div class="row">
                         <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group">
                           <label for="bloodgroup">Blood Group</label> 
                        <select id="bloodgroup" name="bloodgroup" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['bloodgroupList'])
                          {
                          foreach($bodycontent['bloodgroupList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->blood_group==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->blood_group; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                   </div>
                </div>
                  

                      <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                          <label for="cordmobile">Previous School</label>

                          <input type="text" class="form-control forminputs removeerr " id="previousschool" name="previousschool" placeholder="Previous School" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->previous_school; } ?>" maxlength="10">
                        </div>
                      </div>
                    </div>

                      <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordname">Father's/Guardian's Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="fathername" name="fathername" placeholder="Enter Father's/Guardian's Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->father_name; } ?>" />

                          
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordmobile">Education Qualification</label>

                          <select id="fatheredu" name="fatheredu" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                        
                          if($bodycontent['qualificationList'])
                          {
                          foreach($bodycontent['qualificationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->qualification_id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->father_edu==$value->qualification_id){echo "selected";}else{echo "";} ?> ><?php echo $value->qualification_type; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                         
                        </div>
                      </div>
                    </div>


                      <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="fatheroccu">Occupation</label>

                               <select id="fatheroccu" name="fatheroccu" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                        
                          if($bodycontent['occupationList'])
                          {
                          foreach($bodycontent['occupationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->occupation_id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->father_occupation==$value->occupation_id){echo "selected";}else{echo "";} ?> ><?php echo $value->occupation_type; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                         

                          
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordmobile">Mobile</label>
                          <input type="text" class="form-control forminputs removeerr numchk" id="cordmobile" name="fathermob" placeholder="Mobile" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->father_mobile; } ?>" maxlength="10">
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordname">Mothers's Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="mothername" name="mothername" placeholder="Enter Mothers's Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->mother_name; } ?>" />

                          
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordmobile">Education Qualification</label>
                          <select id="motheredu" name="motheredu" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                        
                          if($bodycontent['qualificationList'])
                          {
                          foreach($bodycontent['qualificationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->qualification_id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->mother_edu==$value->qualification_id){echo "selected";}else{echo "";} ?> ><?php echo $value->qualification_type; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>


                        </div>
                      </div>
                    </div>

                         <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordname">Occupation</label>
                           <select id="motherocc" name="motherocc" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                        
                          if($bodycontent['occupationList'])
                          {
                          foreach($bodycontent['occupationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->occupation_id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->mother_occupation==$value->occupation_id){echo "selected";}else{echo "";} ?> ><?php echo $value->occupation_type; ?></option>
                      <?php   }
                          }
                          ?>

                        </select> 

                        
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordmobile">Mobile</label>
                          <input type="text" class="form-control forminputs removeerr numchk" id="mothermob" name="mothermob" placeholder="Mobile" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->mother_mobile; } ?>" maxlength="10">
                        </div>
                      </div>
                    </div>






                   

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Address Info</p>
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                 <label for="cordblock">District</label> 
							<select id="district" name="district" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
						   
							  <?php 
							  if($bodycontent['districtList'])
							  {
								foreach($bodycontent['districtList'] as $distlist)
								{ ?>
									<option value="<?php echo $distlist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['admissionEditdata']->distric_id==$distlist->id){echo "selected";}else{echo "";} ?> ><?php echo $distlist->name; ?></option>
						<?php   }
							  }
							  ?>

							</select>
                        </div>
                      </div>
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordvill">Village</label>
                          <input type="text" class="form-control forminputs" id="village" name="village" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->village; } ?>"  />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                     
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpo">Police Station</label>
                          <input type="text" class="form-control forminputs" id="policest" name="policest" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->police_station; } ?>"  >
                        </div>
                      </div>
					  
					   <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpin">Pin</label>
                          <input type="text" class="form-control forminputs removeerr typeahead " id="pincode" name="pincode" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->pincode; } ?>" >
                        </div>
                      </div>
					  
					  
                    </div>

                    <div class="row">
                      

                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordadd">Address</label>
                            <textarea id="address" name="address" class="form-control forminputs txtareastyle removeerr"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->address; } ?></textarea>
                        </div>
                      </div>

                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpin">Email</label>
                          <input type="text" class="form-control forminputs removeerr typeahead " id="email" name="email" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->email; } ?>" >
                        </div>
                      </div>
                     
					  



                    </div>

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Document Info</p>
					
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="staadhar">Aadhar Card</label>
                          <input type="text" class="form-control forminputs numchk" id="staadhar" name="staadhar" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->aadhar_id; } ?>"  />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="rationid">Ration ID No</label>
                          <input type="text" class="form-control forminputs" id="strationid" name="strationid" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['admissionEditdata']->ration_id; } ?>"  >
                        </div>
                      </div>
                    </div>


                   <!--  <div class="row">
                              
                               <div class="col-md-6 col-sm-12 col-xs-12">
                                 <button type="button" class="btn btn-sm btn-danger addDocument">
                                   <span class="glyphicon glyphicon-plus"></span> Add Document
                                 </button>
                               </div>
                      </div> -->

<!-- Add document-->
   <div class="box-body">
                 <div class="row">
                              
                               <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
                                 <button type="button" class="btn btn-sm btn-danger addDocument">
                                   <span class="glyphicon glyphicon-plus"></span> Add Document
                                 </button>
                               </div>
                      </div>      


             <div id="detail_Document">
            <div class="table-responsive">
            <?php
              $detailCount = 0;
              if($bodycontent['mode']=="EDIT")
              {
                $detailCount = sizeof($bodycontent['studentDocumenDtl']);
              }

              // For Table style Purpose
              if($bodycontent['mode']=="EDIT" && $detailCount>0)
              {
                $style_var = "display:block;width:100%;";
              }
              else
              {
                $style_var = "display:none;width:100%;";
              }
            ?>

              <table class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info" style="<?php echo $style_var; ?>">
                    <thead>
                      
                        <tr>
                            <th style="width:25%;" >Doc Type</th>
                    <th style="width:40%;">Browse</th>
                    <th style="width:30%;">Description</th>
                    <th style="width:5%;" style="text-align:right;">Del</th>
                        </tr>
                    </thead>
                   <tbody>
                <?php

                if($detailCount>0)
                {
                  foreach ($bodycontent['studentDocumenDtl'] as $key => $value) 
                  {
                    
                ?>
                
                <tr id="rowDocument_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>">
                  <td>
                    <select name="docType[]" id="docType_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control custom_frm_input docType">
                      <option value="0">Select</option>
                        <?php
                          foreach ($bodycontent['documentTypeList'] as  $docs) { ?>
                            <option value="<?php echo $docs->id; ?>" <?php if($value->document_type_id==$docs->id){echo "selected";}else{echo "";}?>><?php echo $docs->document_type; ?></option>
                        <?php }
                        ?>
                    </select>
                    <input type="hidden" name="prvFilename[]" id="prvFilename_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control prvFilename" value="<?php echo $value->user_file_name; ?>" readonly >

                    <input type="hidden" name="randomFileName[]" id="randomFileName_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control randomFileName" value="<?php echo $value->random_file_name; ?>" readonly >

                    <input type="hidden" name="docDetailIDs[]" id="docDetailIDs_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control randomFileName" value="<?php echo $value->id; ?>" readonly >
                  </td>
                  <td>

                    

                    <input type="file" name="fileName[]" class="file fileName" id="fileName_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>">
                    <div class="input-group col-xs-12">
                       

                      <input type="text" name="userFileName[]" id="userFileName_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control input-xs userFileName" readonly placeholder="Upload Document" value="<?php echo $value->user_file_name; ?>" >

                     
                      
                      <input type="hidden" name="isChangedFile[]" id="isChangedFile_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" value="N" >

                          <span class="input-group-btn">
                          <button class="browse btn btn-primary input-xs" type="button" id="uploadBtn_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>">
                              <i class="fa fa-folder-open" aria-hidden="true"></i>
                        </button>
                          </span>

                    </div>
                  </td>
                  <td>
                    <textarea name="fileDesc[]" id="fileDesc_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control custom_frm_input dtl_txt_area_trainer"><?php echo $value->uploaded_file_desc; ?></textarea>
                  </td>
                  <td style="vertical-align: middle;">
                    <a href="javascript:;" class="delDocType" id="delDocRow_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" title="Delete">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </td>
                </tr>

              <?php   
                  }
                }

                  ?>

                   </tbody>
                </table>
            </div>
          </div>

        </div>


<!-- end of Add document-->


                    				
					
                  <p id="admmsg" class="form_error"></p>

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


