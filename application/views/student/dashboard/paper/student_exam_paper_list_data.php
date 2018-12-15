
    <div class="datatalberes" id="printableArea" style="overflow-x:auto;"><center>
      <?php 
      if($studentInfo){
      ?>
       
      <button type="button" class="btn-xs bg-maroon margin"><h4 class="modal-title" id="student_name">Student Name : <?php echo $studentInfo->student_name;?></h4></button>
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="student_name">Class : <?php echo $studentInfo->class_name;?></h4></button>
      <button type="button" class="btn-xs bg-yellow margin"><h4 class="modal-title" id="student_name">Roll : <?php echo $studentInfo->class_roll;?></h4></button>
    <?php }?>

     <h2 style="color: #1e8292;text-decoration: underline;"><?php echo $term;?> Term</h2></center>
      
        <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Subject</th>
                  <th>Download</th>
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($term_papers as $value) { 
                  
        $uplodedFolder='exam_papers_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->uploaded_file_desc; ?></td>
            
            
            
            <td align="center"> 
              <a href="<?php echo $download_link; ?>" download>
               <button type="button" class="btn btn-sm btn-primary">
                <span class="glyphicon glyphicon-download"></span> Download</button></a>
            
            </td>
            
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
               
              </table>

              
             

               
             

              
            </div>

          <!--   <input type="button" class="btn btn-primary btn-md" onclick="printDiv('printableArea')" value="print marks!" /> -->