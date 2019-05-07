    
    <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:10%;">Student ID</th>
                  
                  <th style="width:20%;">Name</th>
                  <th style="width:10%;">Roll</th>
                  <th style="width:15%;">First Term</th>
                  <th style="width:15%;">Second Term</th>
                  <th style="width:15%;">Third Term</th>
                 
                  
                </tr>
                </thead>
                <tbody>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              
                <?php 
                  $i = 1;
                 
                  foreach ($studentList as $key => $value) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_name; ?></td>
            
            <td><?php echo $value->class_roll; ?></td>
            <td>
              <?php
            

               if($value->is_applicable_first_term_upload=='N') {
                ?>
              <a href="javascript:;" class="btn btn-danger btn-xs ViewPaperUploadMakePayment"
              data-toggle="modal" data-target="#makepaymentuploadpaper_info" 
              data-title="Add"
              data-mode="EPUFEE"
              data-term="first"
              data-classid="<?php echo $value->class_id?>"
              data-classname="<?php echo $classname?>"
              data-studentname="<?php echo $value->student_name; ?>"
              data-classroll="<?php echo $value->class_roll; ?>"
              data-academicid="<?php echo $value->academic_id; ?>"
              data-studentid="<?php echo $value->student_uniq_id; ?>">
             
              Make Payment
              </a>
              <?php }else{ ?>
              <a href="javascript:;" class="btn btn-success btn-xs" 
              >
             
              Payment Done
              </a>

       

            <?php } ?>
            </td>

            <td>
            
            </td>
             
             <td>
              
            </td>
            
            
           
           
         
          </tr>
                    
                <?php } ?>
             
                </tbody>
               
              </table>
            </div>

             
               
              </div>

              



          