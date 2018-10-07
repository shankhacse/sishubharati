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

.profile_img{
  height:250px;
  width: 200px;
  margin-top:70px;
  margin-bottom:5px;
}
    </style>
    
    
    <div class="panel panel-primary">
      <div class="panel-heading">
                            Profile Information - <?php echo $bodycontent['studentdata']->name;?>
                        </div>
    <div class="row upper_div" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">


      <div class="col-md-3 image_box" style="text-align:center;">
           <?php

           if (!empty($bodycontent['documentDetailData'])) {
             $src = base_url()."application/assets/ds-documents/".$bodycontent['uplodedFolder']."/".$bodycontent['documentDetailData']->random_file_name;
           }else{
             $src = base_url()."application/assets/images/admdashboard/imagenotavailable.png";
           }
            

           ?>
           <img src="<?php echo $src ;?>" align="middle"  class="profile_img" style="border: 6px solid #c6d5da;" >
         
          
           </div>

  


     <div class="table-responsive custome_table " style="padding: 5%;">          
  <table class="table table-bordered" >

   
    <tbody>
      <tr>
        <td>Student ID</td>
        <td><button type="button" class="btn-xs btn-info margin" ><?php echo $bodycontent['studentdata']->student_uniq_id;?></button></td>
        
      </tr>
      <tr>
        <td>Date of Admission</td>
        <td><?php echo date("d M Y", strtotime($bodycontent['studentdata']->admission_dt));?></td>
        
      </tr>
   
      <tr>
        <td>Current Class</td>
        <td><?php echo $bodycontent['studentdata']->current_class;?></td>
        
      </tr><tr>
        <td>Class Roll</td>
        <td><?php echo $bodycontent['studentdata']->class_roll;?></td>
        
      </tr><tr>
        <td>Gender</td>
        <td><?php 
        if ($bodycontent['studentdata']->gender=="M") {
           echo "Male";
         }elseif ($bodycontent['studentdata']->gender=="F") {
           echo "Female";
         } ?></td>
        
      </tr><tr>
        <td>Catagory</td>
        <td><?php echo $bodycontent['studentdata']->student_category;?></td>
        
      </tr><tr>
        <td>Blood Group</td>
        <td><?php echo $bodycontent['studentdata']->student_blood_group;?></td>
        
      </tr>
    <tr>
    <td>Date Of Birth</td>
        <td><?php echo date("d M Y", strtotime($bodycontent['studentdata']->date_of_birth));?></td>
        
      </tr>
    </tbody>
  </table>
  </div>
     </div>
     
     <hr>
     <div class="row" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">
     <div class="col-md-12">
<div class="table-responsive custome_table middle_div">          
  <table class="table table-bordered" style="">
   
    <tbody>
      <tr>
        <td style="width: 39%;">Ration No</td>
        <td><?php echo $bodycontent['studentdata']->ration_id;?></td>
        
      </tr>
    <tr>
        <td >Aadhar No</td>
        <td><?php echo $bodycontent['studentdata']->aadhar_id;?></td>
        
      </tr>
    <tr>
        <td >Previous School</td>
        <td><?php echo $bodycontent['studentdata']->previous_school;?></td>
        
      </tr>
    <tr>
        <td>Father's/Guardian's Name</td>
        <td><?php echo $bodycontent['studentdata']->father_name;?></td>
        
      </tr><tr>
        <td>Education Qualification</td>
        <td><?php echo $bodycontent['studentdata']->father_education;?></td>
        
      </tr><tr>
        <td>Occupation</td>
        <td><?php echo $bodycontent['studentdata']->father_occu;?></td>
        
      </tr><tr>
        <td>Mobile</td>
        <td><?php echo $bodycontent['studentdata']->father_mobile;?></td>
        
      </tr>
    <tr>
        <td>Mother's Name</td>
        <td><?php echo $bodycontent['studentdata']->mother_name;?></td>
        
      </tr><tr>
        <td>Education Qualification</td>
        <td><?php echo $bodycontent['studentdata']->mother_education;?></td>
        
      </tr><tr>
        <td>Occupation</td>
        <td><?php echo $bodycontent['studentdata']->mother_occu;?></td>
        
      </tr><tr>
        <td>Mobile</td>
        <td><?php echo $bodycontent['studentdata']->mother_mobile;?></td>
        
      </tr>
    </tbody>
  </table>




  </div>
     </div>
     </div><hr>
     
      <div class="row low_div" style="font-family: Verdana, Geneva, sans-serif;color: #1d9dcb;">
     <div class="col-md-12">
<div class="table-responsive custome_table">          
  <table class="table table-bordered" style="">
   
    <tbody>
      <tr>
        <td style="width: 39%;">District</td>
        <td><?php echo $bodycontent['studentdata']->student_district;?></td>
        
      </tr>
    <tr>
        <td >Village</td>
        <td><?php echo $bodycontent['studentdata']->village;?></td>
        
      </tr><tr>
        <td>Police Station</td>
        <td><?php echo $bodycontent['studentdata']->police_station;?></td>
        
      </tr><tr>
        <td>Pin Code</td>
        <td><?php echo $bodycontent['studentdata']->pincode;?></td>
        
      </tr><tr>
        <td>Contact Email</td>
        <td><?php echo $bodycontent['studentdata']->email;?></td>
        
      </tr><tr>
        <td>Address</td>
        <td><?php echo $bodycontent['studentdata']->address;?></td>
        
      </tr>
    
    </tbody>

  </table>
  </div>
     </div>
     </div>
        </div>

      
      </div><!--end of panel-->
   
  