  <hr>
   <button type="submit" class="btn btn-primary " onclick="printDiv('printableArea')" style="position: absolute;margin-left: 114px;margin-top: 20px;">
                <span class="glyphicon glyphicon-print"></span> &nbsp;Print All </button>
               &nbsp; 
               <a href="https://www.pdfaid.com/ExtractImages.aspx" target="_blank" style="margin-left: 96px;"><button type="submit" class="btn btn-warning "  style="position: absolute;margin-left: 114px;margin-top: 20px;">Export Images From Pdf</button></a>
               <a href="https://pdfcandy.com/extract-images.html" target="_blank" style="margin-left: 173px;"><button type="submit" class="btn btn-info "  style="position: absolute;margin-left: 114px;margin-top: 20px;">Export Images From Pdf</button></a>

    <div class="datatalberes" id="printableArea" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:10%;">Student ID</th>
                  <th style="width:10%;">Name</th>
                  <th style="width:10%;">Guardian's Name</th>
                  <th style="width:5%;">Class</th>
                  <th style="width:3%;">Roll</th>
                  <th style="width:5%;">Gender</th>
                  <th style="width:10%;">DOB</th>
                  <th style="width:5%;">Blood Group</th>
                  <th style="width:20%;">Address</th>
                  <th style="width:5%;">Contact No</th>
                  <th>Picture</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                       $uplodedFolder='admission_upload';
        if ($value->is_file_uploaded=='Y') {
           $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
        }else{
          if ($value->gender=="M") {
                   $download_link=base_url()."application/assets/images/male_avatar.jpg";
                 }elseif ($value->gender=="F") {
                    $download_link=base_url()."application/assets/images/female_blank_avatar.jpg";
                 } 

          
        }
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td style="text-transform: uppercase;"><?php echo $value->name; ?></td>
            <td><?php echo $value->father_name; ?></td>
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
              <td><?php echo $value->student_blood_group; ?></td>
              <td><?php echo $value->village."<br>".$value->address; ?></td>
              <td><?php echo $value->father_mobile; ?></td>
            <td align="center"> 
              <img src="<?php echo $download_link; ?>" class="profile_pic" style="width: 35mm;" />
              
            
            </td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
            </div>
            <!-- <input type="button" onclick="printDiv('printableArea')" value="print a div!" class="btn btn-warning formBtn" /> -->

            

<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>