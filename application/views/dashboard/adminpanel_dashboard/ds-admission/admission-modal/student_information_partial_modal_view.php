    <?php
            /*echo "<pre>";
            print_r($studentdata);
             echo "<pre>";*/
          
         
    ?>

    <style type="text/css">
       .upper_div tr:nth-child(odd) {
    background-color: #f9f9f9;

}
.middle_div tr:nth-child(odd) {
    background-color: #f9f9f9;
     
}

.low_div tr:nth-child(odd) {
    background-color: #f9f9f9;
    
}
    </style>
    <div class="row upper_div" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">
         <div class="student_model col-md-8">
     <div class="table-responsive">          
  <table class="table table-bordered">

   
    <tbody>
      <tr>
        <td>Date of Admission</td>
        <td><?php echo date("d M Y", strtotime($studentdata->admission_dt));?></td>
        
      </tr>
      <tr>
        <td>Entry Class</td>
        <td><?php echo $studentdata->entry_class;?></td>
        
      </tr>
      <tr>
        <td>Form Sl No.</td>
        <td><?php echo $studentdata->frm_slno;?></td>
        
      </tr>
      <tr>
        <td>Admission Class</td>
        <td><?php echo $studentdata->admission_class;?></td>
        
      </tr>
      <tr>
        <td>Current Class</td>
        <td><?php echo $studentdata->current_class;?></td>
        
      </tr><tr>
        <td>Class Roll</td>
        <td><?php echo $studentdata->class_roll;?></td>
        
      </tr><tr>
        <td>Gender</td>
        <td><?php 
        if ($studentdata->gender=="M") {
           echo "Male";
         }elseif ($studentdata->gender=="F") {
           echo "Female";
         } ?></td>
        
      </tr><tr>
        <td>Catagory</td>
        <td><?php echo $studentdata->student_category;?></td>
        
      </tr><tr>
        <td>Blood Group</td>
        <td><?php echo $studentdata->student_blood_group;?></td>
        
      </tr>
    <tr>
    <td>Date Of Birth</td>
        <td><?php echo date("d M Y", strtotime($studentdata->date_of_birth));?></td>
        
      </tr>
    </tbody>
  </table>
  </div>
     </div>
     <div class="col-md-4 image_box" style="text-align:center;">
     <?php

     if (!empty($documentDetailData)) {
       $src = base_url()."application/assets/ds-documents/".$uplodedFolder."/".$documentDetailData->random_file_name;
     }else{
       $src = base_url()."application/assets/images/admdashboard/imagenotavailable.png";
     }
      

     ?>
     <img src="<?php echo $src ;?>" align="middle"  class="option_img" >
    
    <button type="button" class="btn-xs bg-purple margin" >ID <?php echo $studentdata->student_uniq_id;?></button>
     </div></div>
     <hr>
     <div class="row" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">
     <div class="col-md-12">
<div class="table-responsive custome_table middle_div">          
  <table class="table table-bordered">
   
    <tbody>
      <tr>
        <td style="width: 39%;">Ration No</td>
        <td><?php echo $studentdata->ration_id;?></td>
        
      </tr>
    <tr>
        <td >Aadhar No</td>
        <td><?php echo $studentdata->aadhar_id;?></td>
        
      </tr>
    <tr>
        <td >Previous School</td>
        <td><?php echo $studentdata->previous_school;?></td>
        
      </tr>
    <tr>
        <td>Father's/Guardian's Name</td>
        <td><?php echo $studentdata->father_name;?></td>
        
      </tr><tr>
        <td>Education Qualification</td>
        <td><?php echo $studentdata->father_education;?></td>
        
      </tr><tr>
        <td>Occupation</td>
        <td><?php echo $studentdata->father_occu;?></td>
        
      </tr><tr>
        <td>Mobile</td>
        <td><?php echo $studentdata->father_mobile;?></td>
        
      </tr>
    <tr>
        <td>Mother's Name</td>
        <td><?php echo $studentdata->mother_name;?></td>
        
      </tr><tr>
        <td>Education Qualification</td>
        <td><?php echo $studentdata->mother_education;?></td>
        
      </tr><tr>
        <td>Occupation</td>
        <td><?php echo $studentdata->mother_occu;?></td>
        
      </tr><tr>
        <td>Mobile</td>
        <td><?php echo $studentdata->mother_mobile;?></td>
        
      </tr>
    </tbody>
  </table>
  </div>
     </div>
     </div><hr>
     
      <div class="row low_div" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">
     <div class="col-md-12">
<div class="table-responsive custome_table">          
  <table class="table table-bordered">
   
    <tbody>
      <tr>
        <td style="width: 39%;">District</td>
        <td><?php echo $studentdata->student_district;?></td>
        
      </tr>
    <tr>
        <td >Village</td>
        <td><?php echo $studentdata->village;?></td>
        
      </tr><tr>
        <td>Police Station</td>
        <td><?php echo $studentdata->police_station;?></td>
        
      </tr><tr>
        <td>Pin Code</td>
        <td><?php echo $studentdata->pincode;?></td>
        
      </tr><tr>
        <td>Contact Email</td>
        <td><?php echo $studentdata->email;?></td>
        
      </tr><tr>
        <td>Address</td>
        <td><?php echo $studentdata->address;?></td>
        
      </tr>
    
    </tbody>

  </table>
  </div>
     </div>
     </div>
        </div>

      