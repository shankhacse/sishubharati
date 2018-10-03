    <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>Gender</th>
                  <th>DOB</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo $value->class_roll; ?></td>
               <td><?php 
                if ($value->gender=="M") {
                   echo "Male";
                 }elseif ($value->gender=="F") {
                   echo "Female";
                 } ?>
                   
                 </td>
            <td><?php echo date("d M Y", strtotime($value->date_of_birth));?></td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
            </div>