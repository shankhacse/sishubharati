   <br><hr>
   <center>
    <span style="color:red;text-align:center;">Note: Generate Rank Before Print Marksheet.  </span>
    <span style="color:green;text-align:center;"> Print Settings:Browser :: Google Crome,Page:A4,Margins:none,Scale:100  </span><br><br>
     <a href="<?php echo base_url(); ?>marksheet/printMarksheetFront" class="btn btn-primary btn-xs" data-title="Pdf" target="_blank" >
                <span class="glyphicon glyphicon-print"></span> &nbsp;Marksheet Front Page
              </a> 

              <a href="<?php echo base_url(); ?>marksheet/printMarksheetbyClass/<?php echo $sel_class;?>" class="btn btn-success btn-xs" data-title="Pdf" target="_blank" >
                <span class="glyphicon glyphicon-print"></span>&nbsp; All Student Marksheet
              </a>
   </center> <hr><br>

    <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:20%;">Student ID</th>
                  <th style="width:20%;">Name</th>
                  <th style="width:10%;">Class</th>
                  <th style="width:10%;">Roll</th>
                  <th style="width:10%;">Gender</th>
                 
                  <th style="width:10%;" >Print</th>
                  
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
            <td align="center">
              <a href="<?php echo base_url(); ?>marksheet/printMarksheet/<?php echo $value->academic_id; ?>" class="btn btn-primary btn-xs" data-title="Pdf" target="_blank" >
                <span class="glyphicon glyphicon-print"></span>
              </a> 
            </td>
           
           
           
         
          </tr>
                    
                <?php $row++;
                  }

                ?>
             
                </tbody>
               
              </table>
            </div>