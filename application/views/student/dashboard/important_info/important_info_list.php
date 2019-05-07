
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentdashboard.js"></script>
<div class="panel panel-primary">
      <div class="panel-heading">
                            Important Informationnfo List                     </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">
                
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Upload Date</th>
                  <th>Info Title</th>
                 
                  <th>Download</th>
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['infoList'] as $value) { 
                  $status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag infostatus" data-setstatus="0" data-infoid="'.$value->info_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag infostatus" data-setstatus="1" 
                      data-infoid="'.$value->info_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
        $uplodedFolder='importantinfo_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
             <td><?php echo date("d M Y", strtotime($value->created_on));?></td>
           
            <td><?php echo $value->title; ?></td>
           
            
            
            
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

 </div><!-- end of panel div-->


