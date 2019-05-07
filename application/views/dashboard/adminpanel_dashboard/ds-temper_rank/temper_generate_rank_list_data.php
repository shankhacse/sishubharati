   <style type="text/css">
     .error-border {
    border: 1px solid red;
    
}
   </style> 

    <div class="datatalberes" style="overflow-x:auto;">
       
             <?php
              $attr = array("id"=>"UpdateTemperRankForm","name"=>"UpdateTemperRankForm");
              echo form_open('',$attr); ?>
                
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th style="width:10%;">Student ID</th>
                  <th style="width:20%;">Name</th>
                  <th style="width:5%;">Roll</th>
                  <th style="width:20%;">Grand Total</th>
                  <th style="width:10%;">Temper Rank</th>
                  <th style="width:10%;">Original Rank</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  $rank=1;
                  $row=0;
                  foreach ($studentList as $key => $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->studentname; ?></td>
            <td><?php echo $value->class_roll; ?></td>
          <input type="hidden" name="rank_details_id[]" value="<?php echo $value->rank_details_id;?>">
            <td><?php echo $value->grand_total; ?></td>
            <td style="font-weight: bold;font-weight: bold;color: #0e4e8c;font-size: 16px;" >
              <input type="text" class="form-control forminputs temprank" name="rank[]" value="<?php echo $value->rank;?>" id="temp_rank_<?php echo $row++;?>" style="width:60%" >
              </td>

            <td style="font-weight: bold;font-weight: bold;color: #0e4e8c;font-size: 16px;"><?php echo $value->original_rank;?></td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
                 <div class="response_msg" id="ranksave_response_msg">
              <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-warning formBtn" id="saverank">Update Rank</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

             <span class="btn btn-warning formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Update Rank</span>
            <br>

             <?php echo form_close(); ?>