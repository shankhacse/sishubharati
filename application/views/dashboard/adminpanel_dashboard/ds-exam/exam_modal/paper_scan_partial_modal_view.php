   <form class="form-area" name="paperscanForm" id="paperscanForm" enctype="multipart/form-data">
    <input type="hidden" name="marksmasterID" id="marksmasterID" value="<?php echo $marksmasterid;?>" />
              
   <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>" />
   <!-- Add document-->
   <div class="box-body" style="min-height: 380px;">
                 <div class="row">
                              
                               <div class="col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 10px;text-transform: capitalize;">
                                 <button type="button" class="btn btn-sm btn-danger addDocument">
                                   <span class="glyphicon glyphicon-plus"></span> Add Paper <?php echo ucfirst($term)." Term"?>
                                 </button>
                               </div>
                      </div>      


             <div id="detail_Document">
            <div class="table-responsive">
            <?php
              $detailCount = 0;
              if($mode=="Edit")
              {
                $detailCount = sizeof($studentDocumenDtl);
              }

              // For Table style Purpose
              if($mode=="Edit" && $detailCount>0)
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
                  foreach ($studentDocumenDtl as $key => $value) 
                  {
                    
                ?>
                
                <tr id="rowDocument_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>">
                  <td>
                    <select name="docType[]" id="docType_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control custom_frm_input docType">
                      <option value="3">Pdf Only</option>
                        
                    </select>
                    <input type="hidden" name="prvFilename[]" id="prvFilename_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control prvFilename" value="<?php echo $value->user_file_name; ?>" readonly >

                    <input type="hidden" name="randomFileName[]" id="randomFileName_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control randomFileName" value="<?php echo $value->random_file_name; ?>" readonly >

                    <input type="hidden" name="docDetailIDs[]" id="docDetailIDs_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control randomFileName" value="<?php echo $value->id; ?>" readonly >
                  </td>
                  <td>

                    

                    <input type="file" name="fileName[]" class="file fileName" id="fileName_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" accept=".pdf">
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
                    <textarea name="fileDesc[]" id="fileDesc_<?php echo $value->id; ?>_<?php echo $value->upload_from_module_id; ?>" class="form-control custom_frm_input dtl_txt_area_trainer" style="height: 33px;"><?php echo $value->uploaded_file_desc; ?></textarea>
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

            <p id="marksmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="paperscansavebtn">Save</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                      
                     
                  </div>

                     </form>

              <div class="response_msg" id="marks_response_msg">