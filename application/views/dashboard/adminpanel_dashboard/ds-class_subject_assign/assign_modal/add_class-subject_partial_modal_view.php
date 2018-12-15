  <?php $row=1;?>
   <form class="form-area" name="classSingleSubjectSaveForm" id="classSingleSubjectSaveForm" enctype="multipart/form-data">
   	<input type="hidden" name="clssunasinmstid" id="roclssunasinmstidwnum" value="<?php echo $cls_sub_assign_mstid;?>">
  <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Add Subject </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_subject" name="sel_subject" class="form-control selectpicker"
                        data-show-subtext="true" data-actions-box="true" data-live-search="true"  >
                        <option value="0">Select</option>
                          <?php 
                            if($subjectList)
                            {
                              foreach($subjectList as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->subject ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
               
                 
                  </div>
             
                </div>


			<div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Full Marks </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
			                <div id="sel_subfmarkserr_<?php echo $row?>">
			                 <select id="sel_fullmarks_<?php echo $row?>" name="sel_fullmarks" class="form-control selectpicker sfullmarks" data-show-subtext="true" data-live-search="true">
			                         <option value="0">Select</option>
                              <option value="100">100</option>
                              <option value="50">50</option>
                              <option value="25">25</option>
                        
			                        
			                                                 
			                </select>
			             </div>

            		 </div>
             
                </div>
            </div>

            <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Written & oral /written </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
              <div id="sel_wrerr_<?php echo $row?>">
                 <select id="sel_wr_<?php echo $row?>" name="sel_wr" class="form-control selectpicker sfullmarks " data-show-subtext="true" data-live-search="true">
                        <option value="wo">written & oral</option>
                        <option value="w">only written</option>
                       
                        
                                                 
                </select>
             </div>

                 </div>
             
                </div>
            </div>


         <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Written marks </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                  <div id="sel_subwmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_writtenmarks" id="sel_writtenmarks_<?php echo $row?>" readonly />
              </div>
                      </div>

            </div>
             
               
         </div>


         <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Oral marks </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
             <div id="sel_subomarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_oralmarks" id="sel_oralmarks_<?php echo $row?>" readonly />
              </div>
                      </div>

            </div>
             
               
         </div>
		<?php $row++;?>
          <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">

           <p id="clssubmsg" class="form_error"></p>
        

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="clssubjectsavebtn">Save</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                      
                     
                  </div><br>


              </form>