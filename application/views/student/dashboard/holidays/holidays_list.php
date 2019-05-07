
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentdashboard.js"></script>
<div class="panel panel-primary">
      <div class="panel-heading">
                            Holiday List                     </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">

      <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Date</th>
                  <th>Holiday</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['holidaysList'] as $value) { 
                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php 

            if ($value->is_daterange=='Y') {
               echo date("d M Y", strtotime($value->date))." - ".date("d M Y", strtotime($value->todate));
            }else{
              echo date("d M Y", strtotime($value->date));
            }

           ?></td>
            <td><?php echo $value->title; ?></td>
            
            
            
     
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
               
              </table>
                
              

            

             

            </div>

 </div><!-- end of panel div-->


