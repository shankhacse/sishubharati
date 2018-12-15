    <div class="datatalberes" style="overflow-x:auto;">
       

                
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Roll</th>
                  <th>Grand Total</th>
                  <th>Rank</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $rank=1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->studentname; ?></td>
            <td><?php echo $value->class_roll; ?></td>
          
            <td><?php echo $value->grand_total; ?></td>
            <td style="font-weight: bold;font-weight: bold;color: #0e4e8c;font-size: 16px;"><?php echo $value->rank;?></td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
               <div class="response_msg" id="ranksave_response_msg">
              <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
          <a href="javascript:;" class="btn btn-danger btn-sm deleteclassrank" 
              data-title="Delete"
              data-rankmasterid="<?php echo $rank_master_id;?>"
              >
               Delete Rank
              </a>
              </div>
                 </div>

                 
           

             <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Save Rank</span>
            <br>
            </div>