  <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  
                  <th style="width:10%;">Subject</th>
                 
                  <th style="width:20%;">Select Full Marks</th>
                  <th style="width:10%;">W+O/W</th>
                  <th style="width:20%;">Written Marks</th>
                  <th style="width:20%;">Oral Marks</th>
                  <th style="width:10%;">Action</th>
                 
                  
                </tr>
                </thead>
                <tbody>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
            
                <?php 
                  $i = 1;
                  $row=1;

                  $fullmarks = array('100','50','25' );
                  foreach ($subjectDetails as  $value) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->subject; ?></td>
             
           
            <td>
               <div id="sel_subfmarkserr_<?php echo $row?>">
                 <select id="sel_fullmarks_<?php echo $row?>" name="sel_fullmarks[]" class="form-control selectpicker sfullmarks" data-show-subtext="true" data-live-search="true">

                        <?php 
                    
                        foreach($fullmarks as $full_marks)
                        { ?>
                            <option value="<?php echo $full_marks; ?>" <?php if($value->subject_full_marks==$full_marks){echo "selected";}else{echo "";} ?> ><?php echo $full_marks; ?></option>
                <?php   }
                     
                      ?>
                        
                                                 
                </select>
             </div>
            </td>
             <td>
               <div id="sel_wrerr_<?php echo $row?>">
                 <select id="sel_wr_<?php echo $row?>" name="sel_wr[]" class="form-control selectpicker sfullmarks " data-show-subtext="true" data-live-search="true">
                        <option value="wo" <?php if($value->marks_type=='wo'){echo "selected";}else{echo "";} ?> >written & oral</option>
                        <option value="w" <?php if($value->marks_type=='w'){echo "selected";}else{echo "";} ?> >only written</option>
                       
                        
                                                 
                </select>
             </div>
            </td>
            <td>
              <div id="sel_subwmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_writtenmarks[]" id="sel_writtenmarks_<?php echo $row?>" value="<?php echo $value->subject_written_marks; ?>" readonly />
              </div>
            </td>
            <td>
                <div id="sel_subomarkserr_<?php echo $row?>">
                 <input type="text" class="form-control" name="sel_oralmarks[]" id="sel_oralmarks_<?php echo $row?>" value="<?php echo $value->subject_oral_marks; ?>" readonly />
              </div>
            </td>
            
           <td>
           	<button type="button" class="btn btn-primary updtsubjectfmarksbtn" 
           	data-dismiss="modal"
           	data-assdtlid="<?php echo $value->id; ?>" 
           	data-rownum="<?php echo $row; ?>" 
           	>Update</button>
           </td>
           
         
          </tr>
                    
                <?php $row++;} ?>
              <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">
                </tbody>
               
              </table>
            </div>