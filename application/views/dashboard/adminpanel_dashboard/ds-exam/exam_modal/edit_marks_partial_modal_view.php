   <form class="form-area" name="examMarksForm" id="examMarksForm" enctype="multipart/form-data">
    <button type="button" class="btn-xs bg-red margin">Edit Marks <?php echo ucfirst($term)." Term"?></button>
  <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                   <th colspan="2">&nbsp;</th>
                   <th colspan="3">Full Marks</th>
                   <th >&nbsp;</th>
                   <th colspan="3">Obtain Marks</th>
                   <th >&nbsp;</th>
                </tr>
                <tr>
                  <th style="width:2%;">Sl</th>
                  <th style="width:20%;">Subject</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;"></th>
                  <th style="width:10%;">Written</th>
                  <th style="width:10%;">Oral</th>
                  <th style="width:10%;">Total</th>
                  <th style="width:8%;">Grade</th>
              
                 
                  
                </tr>
                </thead>
                <tbody>
               <input type="hidden" name="mode" id="mode" value="EDIT" />
               <input type="hidden" name="marksmasterID" id="marksmasterID" value="<?php echo $marksmasterid;?>" />
               <input type="hidden" name="term" id="term" value="<?php echo $term;?>" />
               <input type="hidden" name="academic_id" id="academic_id" value="<?php echo $academicid;?>" />
               <input type="hidden" name="class_id" id="class_id" value="<?php echo $classid;?>" />
               <?php
                $i=1;
                $row=1;
                $grandtotalmarks=0;
                foreach ($subjestList as $value) {
                  $grandtotalmarks=$grandtotalmarks+$value->obtain_total_marks;

                ?>
            
          <tr>
            <td><?php echo $i++; ?>
             <input type="hidden" name="marksdetailsid[]" id="marksdetailsid_<?php echo $row?>" value="<?php echo $value->marks_details_id;?>" > 
            </td>

            <td><?php echo $value->subject;?>
             <input type="hidden" class="form-control" name="subjectid[]" id="subjectid_<?php echo $row?>" value="<?php echo $value->subjectid;?>" >  
            </td>
            <td><?php echo $value->full_marks;?>
            <input type="hidden" class="form-control" name="totalfullmarks[]" id="totalfullmarks_<?php echo $row?>" value="<?php echo $value->full_marks;?>" >  
            </td>
            <td><?php echo $value->full_written_marks;?>
               <input type="hidden" class="form-control" name="totwrittenmarks[]" id="totwrittenmarks_<?php echo $row?>" value="<?php echo $value->full_written_marks;?>" >
            </td>
            <td><?php echo $value->full_oral_marks;?>
              <input type="hidden" class="form-control" name="totoralmarks[]" id="totoralmarks_<?php echo $row?>" value="<?php echo $value->full_oral_marks;?>" >
            </td>
            <td></td>
            <td>
               <div id="subwmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control obwrittenmarks numchk" name="obtainwrittenmarks[]" id="obtainwrittenmarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $value->obtain_written_marks;?>" autocomplete="off" / >
              </div>
            </td>
            <td>
              <div id="subomarkserr_<?php echo $row?>">
                 <input type="text" class="form-control oboralmarks" name="obtainoralmarks[]" id="obtainoralmarks_<?php echo $row?>"  onkeyup="numericFilter(this)" value="<?php echo $value->obtain_oral_marks;?>" autocomplete="off" / >
              </div>
            </td>
            <td>
              <div id="totalmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control obtotalmarks" name="obtaintotalmarks[]" id="obtaintotalmarks_<?php echo $row?>" value="<?php echo $value->obtain_total_marks;?>" readonly >
              </div>
            </td>
            <td>
              <div id="gradeerr_<?php echo $row?>">
                 <input type="text" class="form-control" name="grade[]" id="grade_<?php echo $row?>" value="<?php echo $value->grade;?>" readonly />
              </div>
            </td>
           
           </tr>          
               <?php $row++;}?> 
               <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">
                <tr style="background-color: #dbdb92;font-weight: bold;font-size: 20px;">
                <td colspan="6"></td>
                <td colspan="2">Grand Total</td>
                <td><input type="text" class="form-control" name="grandtotalmarks" id="grandtotalmarks" value="<?php echo $grandtotalmarks;?>" readonly></td>
                <td> </td>
              </tr>
             
                </tbody>
               
              </table>

             <div class="row">
                   <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                          <label for="subcode">Attendance</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="attendance" name="attendance" placeholder="Attendance" autocomplete="off" value="<?php echo $attendance;?>" >
                        </div>

                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                          <label for="subcode">Sporting</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="sporting" name="sporting" placeholder="sporting" autocomplete="off" value="<?php echo $sporting;?>" >
                        </div>

                  </div>
            </div>

            <div class="row">
                   <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                          <label for="subcode">Discipline</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="discipline" name="discipline" placeholder="Discipline" autocomplete="off" value="<?php echo $discipline;?>" >
                        </div>

                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="form-group">
                          <label for="subcode">Cutural Efficiency</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="cutural_effciency" name="cutural_effciency" placeholder="Cutural Effciency" autocomplete="off" value="<?php echo $cutural_effciency;?>" >
                        </div>

                  </div>
            </div>




            </div>

            <p id="marksmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="submarkssavebtn">Update</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Updating...</span>
                      
                     
                  </div>

                     </form>

              <div class="response_msg" id="marks_response_msg">