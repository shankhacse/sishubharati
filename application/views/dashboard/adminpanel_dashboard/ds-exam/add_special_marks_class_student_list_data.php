   <form class="form-area" name="specilaMarksForm" id="specilaMarksForm" enctype="multipart/form-data"> 
    
    <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
   <span style="color:red;font-weight: bold;">Note: Add all Term marks before add special marks</span>
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th style="width:10%;">Student ID</th>
                  
                  <th style="width:10%;">Name</th>
                  <th style="width:5%;">Roll</th>
                  <th style="width:10%;" colspan="2">First Term Total</th>
                  <th style="width:5%;">20%</th>
                  <th style="width:10%;" colspan="2">Second Term Total</th>
                  <th style="width:5%;">20%</th>
                  <th style="width:10%;" colspan="2">Third Term Total</th>
                  <th style="width:5%;">60%</th>
                  <th style="width:10%;">Special Marks</th>
                  <th style="width:10%;">Grand Total</th>
                 
                  
                </tr>
                </thead>
                <tbody>
              
                
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              
                <?php 
                  $i = 1;
                  $row=1;
                  foreach ($studentList as $key => $value) {

             $first_term_per=$this->method_call_view->calculatepercentage($value->first_term_total,20);
             $second_term_per=$this->method_call_view->calculatepercentage($value->second_term_total,20);
             $third_term_per=$this->method_call_view->calculatepercentage($value->third_term_total,60);

                  
                  ?>
       
          <tr>
            <td><?php echo $i++; ?>
            <input type="hidden" name="academic_id[]" id="academic_id_<?php echo $row?>" value="<?php echo $value->academic_id;?>" />  
            </td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_name; ?></td>
            
            <td><?php echo $value->class_roll; ?></td>
            <td><?php echo $value->first_term_total; ?> </td>
            <td class="pinfo">
              <?php if($value->first_term_data=='Y'){?>
            <a href="javascript:;" class="termparformance"
            data-toggle="modal" 
            data-target="#performanceModal"  
            data-marksmasterid="<?php echo $value->first_term_master_id; ?>"
            data-term="First"
            data-student="<?php echo $value->student_name; ?>"
            data-studentunqid="<?php echo $value->student_uniq_id; ?>"
            > <span class="glyphicon glyphicon-info-sign"></span></a>
          <?php } ?>
            </td>

            <td class="tbl"><?php echo $first_term_per;?>
              <input type="hidden" class="form-control numchk" name="firsttermpermarks[]" id="firsttermpermarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $first_term_per; ?>" readonly / ></td>

            <td><?php echo $value->second_term_total; ?> </td>
            <td class="pinfo"> 
              <?php if($value->second_term_data=='Y'){?>
            <a href="javascript:;"  class="termparformance"
            data-toggle="modal" 
            data-target="#performanceModal"  
            data-marksmasterid="<?php echo $value->second_term_master_id; ?>"
            data-term="Second"
            data-student="<?php echo $value->student_name; ?>"
            data-studentunqid="<?php echo $value->student_uniq_id; ?>"
            > <span class="glyphicon glyphicon-info-sign"></span></a>
          <?php }?>
            </td>

            <td class="tbl"><?php echo $second_term_per;?>
           <input type="hidden" class="form-control numchk" name="secondtermpermarks[]" id="secondtermpermarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $second_term_per; ?>" readonly / >   
            </td>
            <td><?php echo $value->third_term_total; ?></td>
            <td class="pinfo"> 
              <?php if($value->third_term_data=='Y'){?>
            <a href="javascript:;"  class="termparformance"
            data-toggle="modal" 
            data-target="#performanceModal"  
            data-marksmasterid="<?php echo $value->third_term_master_id; ?>"
            data-term="Third"
            data-student="<?php echo $value->student_name; ?>"
            data-studentunqid="<?php echo $value->student_uniq_id; ?>"
            > <span class="glyphicon glyphicon-info-sign"></span></a>
          <?php }?>
            </td>
            <td class="tbl"><?php echo $third_term_per;?>
           <input type="hidden" class="form-control numchk" name="thirdtermpermarks[]" id="thirdtermpermarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $third_term_per; ?>" readonly / >   
            </td>
            <td>
              <div id="specialmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control specialmarks numchk" name="specialmarks[]" id="specialmarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $value->special_marks; ?>" / >
              </div>
              </td>
            <td class="tbl">
              <div id="grandtotalmarkserr_<?php echo $row?>">
                 <input type="text" class="form-control specialmarks numchk tbl" name="grandtotalmarks[]" id="grandtotalmarks_<?php echo $row?>" onkeyup="numericFilter(this)" value="<?php echo $value->grand_total; ?>" readonly / >
              </div>
              </td>

            
             
           
           
         
          </tr>
                    
                <?php $row++;} ?>
             <input type="hidden" name="rownum" id="rownum" value="<?php echo $row;?>">
                </tbody>
               
              </table>
            </div>

             
               
             <p id="specialmarksmsg" class="form_error"></p>
<?php if($studentList){?>
                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="submarkssavebtn">Save</button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                      
                     
                  </div>
                <?php }?>

                     </form>

              <div class="response_msg" id="specialmarks_response_msg">


<?php
//$marks=175;
//$persentage=20;
//$this->method_call_view->calculatepercentage($marks,$persentage);
?>

<!-- Modal -->
<div id="performanceModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 200px;">
      <div class="modal-header" style="padding:7px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center>
         <table>
          <tr>
            <td id="stname" style="font-size: 15px;color: #c43cda;font-weight: bold;"></td>
          </tr>
        </table></center>
      </div>
      <div class="modal-body" >
       
        <div  id="detail_information_view" style="margin-top: 10px;">
                  
          
         </div>
      </div>
      <div class="modal-footer" style="padding: 5px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding: 2px 9px;" >Close</button>
      </div>
    </div>

  </div>
</div>

              



          