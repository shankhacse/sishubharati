
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentdashboard.js"></script>
<div class="panel panel-primary">
      <div class="panel-heading">
                            Events List                     </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">

      <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Event Title</th>
                  <th>Place</th>
                  <th>Date</th>
                  <th>Time</th>
                 
                  <th>Poster</th>
                  
                  
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['EventsList'] as $value) { 
                  $status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag eventsstatus" data-setstatus="0" data-eventsid="'.$value->events_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag eventsstatus" data-setstatus="1" 
                      data-eventsid="'.$value->events_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
        $uplodedFolder='events_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->title; ?></td>
            <td><?php echo $value->event_place; ?></td>
            <td><?php echo date("d M Y", strtotime($value->event_date));?></td>
           
            <td><?php echo $value->event_time; ?></td>
           
            
            
            
            <td align="center"> 
              <img src="<?php echo $download_link; ?>" class="events_poster" />
            
            </td>
       
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
               
              </table>
                
              

            

             

            </div>

 </div><!-- end of panel div-->


