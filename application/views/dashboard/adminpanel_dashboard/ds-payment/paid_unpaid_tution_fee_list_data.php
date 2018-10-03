
    <div class="datatalberes" style="overflow-x:auto;">
                 <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>Month</th>
                  <th width="10%">Paid/Unpaid</th>
                 
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($StudentList as $value) {

                /* echo "<pre>";
                 print_r($value);
                 echo "</pre>";*/

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['studentMasterData']->student_uniq_id; ?></td>
            <td><?php echo $value['studentMasterData']->student_name; ?></td>
            <td><?php echo $value['studentMasterData']->class_name; ?></td>
            <td><?php echo $value['studentMasterData']->class_roll; ?></td>
            <td><?php echo $month; ?></td>
            <td style="font-weight:bold;">
              <?php 
              if ($value['paidUnpaid']=='Paid') {
                echo '<b style="color: #39ad39;">'.$value['paidUnpaid'].'</b>'; 
                
              }else{
                 echo '<b style="color: #c2223b;">'.$value['paidUnpaid'].'</b>'; 
              }
             
              ?></td>
           
           
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>

            </div>