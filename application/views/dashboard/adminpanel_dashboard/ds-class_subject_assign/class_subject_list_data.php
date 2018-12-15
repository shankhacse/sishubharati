    <form class="form-area" name="classSubjectSaveForm" id="classSubjectSaveForm" enctype="multipart/form-data">
    <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  
                  <th style="width:20%;">Subject</th>
                  <th style="width:10%;">Code</th>
                  <th style="width:20%;">Select Full Marks</th>
                  <th style="width:10%;">W+O/W</th>
                  <th style="width:20%;">Written Marks</th>
                  <th style="width:20%;">Oral Marks</th>
                 
                  
                </tr>
                </thead>
                <tbody>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              <input type="hidden" name="sel_class" value="<?php echo $sel_class;?>">  
                <?php 
                  $i = 1;
                  $row=1;
                  foreach ($subjectList as $key => $value) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['subject']; ?></td>
             <input type="hidden" name="subjectid[]" value="<?php echo $value['id'];?>">
            <td><?php echo $value['subject_code']; ?></td>
            <td>
               <div id="sel_subfmarkserr_<?php echo $row?>">
                 <select id="sel_fullmarks_<?php echo $row?>" name="sel_fullmarks[]" class="form-control selectpicker sfullmarks" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <option value="100">100</option>
                        <option value="50">50</option>
                        <option value="25">25</option>
                        
                        
                                                 
                </select>
             </div>
            </td>
            <td>
               <div id="sel_wrerr_<?php echo $row?>">
                 <select id="sel_wr_<?php echo $row?>" name="sel_wr[]" class="form-control selectpicker sfullmarks " data-show-subtext="true" data-live-search="true">
                        <option value="wo">written & oral</option>
                        <option value="w">only written</option>
                       
                        
                                                 
                </select>
             </div>
            </td>
            <td>
              <div id="sel_subwmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_writtenmarks[]" id="sel_writtenmarks_<?php echo $row?>" readonly />
              </div>
            </td>
            <td>
                <div id="sel_subomarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_oralmarks[]" id="sel_oralmarks_<?php echo $row?>" readonly />
              </div>
            </td>
            
           
           
         
          </tr>
                    
                <?php $row++;} ?>
              <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">
                </tbody>
               
              </table>
            </div>

              <p id="clssubmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="clssubjectsavebtn">Save</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                      
                     
                  </div>

                     </form>

              <div class="response_msg" id="clssub_response_msg">
               
              </div>