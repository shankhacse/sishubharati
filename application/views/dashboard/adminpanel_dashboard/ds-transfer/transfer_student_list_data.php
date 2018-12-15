      <?php
              $attr = array("id"=>"TransferDataForm","name"=>"TransferDataForm");
              echo form_open('',$attr); ?>
              <hr>
              <?php if ($studentList) { ?>
      <div class="box-body">
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:20%;">Student ID</th>
                  <th style="width:20%;">Name</th>
                  
                  <th style="width:10%;">Roll</th>
                  <th style="width:10%;">Grand Total</th>
                  <th style="width:10%;">Rank</th>
                  <th style="width:10%;">Action</th>
                  
                  
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $row=0;
                  $newroll=1;
                  
                  
                  foreach ($studentList as $key => $value) {

               

                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->studentname; ?></td>
          
            <td style="font-weight: bold;color: #de741a;"><?php echo $value->class_roll; ?></td>
              
            <td style="font-weight: bold;" >
              <input type="hidden" name="student_uniq_id[]" value="<?php echo $value->student_uniq_id; ?>">
              <input type="hidden" name="rank[]" value="<?php echo $value->rank; ?>">
             
              <?php echo $value->grand_total; ?>
            </td>
            <td style="font-weight: bold;color: #124bbf;"><?php echo $value->rank; ?></td>
            <td align="center">
                <div class="maxl">
                    <label class="radio inline"> 
                        <input type="radio" class="selstudent" name="chkstudent[<?php echo $row;?>]" value="P" checked>
                        <span> Pass </span> 
                     </label>
                    <label class="radio radiocol inline"> 
                        <input type="radio" class="selstudent" name="chkstudent[<?php echo $row;?>]" value="F">
                        <span>Fail </span> 
                    </label>
                  </div>
            </td>
            
         
           
         
          </tr>
                    
                <?php $row++;$newroll++;
                  }

              

                ?>
            
         
                </tbody>
               
              </table>










           

               
            <br>
           
            </div>

            
            <div class="row">
            <div class="col-md-1 "><label for="classList" class="searchby"> From </label></div>
            <div class="col-md-2 ">
                <div class="form-group">
                     
                     
                       <select id="from_sel_class" name="from_sel_class" class="form-control selectpicker">
                        
                         <option value="<?php echo $from_class_id;?>"><?php echo $frm_class_name;?></option>
                        </select>
                        </div>
            </div>
            <div class="col-md-2">

                      <div class="form-group">
                     
                     
                       <select id="from_sel_session" name="from_sel_session" class="form-control selectpicker">
                        
                         <option value="<?php echo $frm_session_id;?>"><?php echo $frm_session_year;?></option>
                        </select>
                        </div>
                 
                  </div>

 <div class="col-md-2">
  <img src="<?php echo base_url();?>application/assets/images/admdashboard/transfer.png"
                style="margin-left:auto;margin-right:auto;display:block;width: 30px;" />
 </div>

             <div class="col-md-1 "><label for="classList" class="searchby"> To </label></div>      
            <div class="col-md-2">

                      <div class="form-group">
                     
                     
                       <select id="next_sel_class" name="next_sel_class" class="form-control selectpicker"
                        >
                        
                         <option value="0">Select Class</option>
                         <?php if($nextClassMasterData){?>
                      <option value="<?php echo $nextClassMasterData->id;?>"><?php echo $nextClassMasterData->name;?></option>
                         <?php }?>
                        </select>
                        </div>
                 
                  </div>
                  <div class="col-md-2">

                      <div class="form-group">
                     
                     
                       <select id="next_sel_session" name="next_sel_session" class="form-control selectpicker"
                        >
                        
                         <option value="0">Select Session</option>
                         <?php if($nextSessionYearData){?>
                      <option value="<?php echo $nextSessionYearData->session_id;?>"><?php echo $nextSessionYearData->year;?></option>
                         <?php }?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>


                <p id="transfer_err_msg" class="form_error"></p>
                <div class="response_msg" id="transfer_response_msg" style="margin-top: 50px;">
                
    <div class="form-group row" style="margin-top:20px;" id="transferSavediv">
      <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="transferSave" style="display: inline-block;width:200px;">Transfer</button>
            </div>
    </div>

    <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;width:200px;"><i class="fa fa-spinner rotating" aria-hidden="true"></i>&nbsp;Transfer </span>


         


          </div><?php }else{echo "<center><b>&nbsp;No Record Found</b></center>";}?>

             <?php echo form_close(); ?>