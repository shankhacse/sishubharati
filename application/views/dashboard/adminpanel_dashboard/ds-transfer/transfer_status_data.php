    <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:20%;">Student ID</th>
                  <th style="width:20%;">Name</th> 
                  <th style="width:10%;">From Class</th>
                  <th style="width:10%;">To Class</th>
                  <th style="width:10%;">From Session</th>
                  <th style="width:10%;">To Session</th>
                  <th style="width:10%;">Rank</th>
                  <th style="width:10%;">Status</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $row=1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_name; ?></td> 
            <td style="font-weight: bold;"><?php echo $value->frmclsname; ?></td>
            <td style="font-weight: bold;color: #B88412;"><?php echo $value->nxtclsname; ?></td>
            <td><?php echo $value->frmyear; ?></td>
            <td><?php echo $value->nxtyear; ?></td>
            <td><?php echo $value->rank; ?></td>
            <td><?php 
                if ($value->status=='P') {
                echo "<b style='color: #0B8;'>Pass";
               }else if($value->status=='F'){
                echo "<b style='color: #F01616;'>Fail";
               }?>
            </td>
            
            
           
           
         
          </tr>
                    
                <?php $row++;
                  }

                ?>
             
                </tbody>
               
              </table>
            </div>