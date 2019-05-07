
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/studentdashboard.js"></script>
<div class="panel panel-primary">
      <div class="panel-heading">
                            Notice List                     </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">
                
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Publish Date</th>
                  <th>Academic Year</th>
                  <th>Notice Title</th>
          
                  <th>Download</th>
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['NoticeList'] as $value) { 
                  $status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag noticestatus" data-setstatus="0" data-noticeid="'.$value->notice_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag noticestatus" data-setstatus="1" 
                      data-noticeid="'.$value->notice_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
        $uplodedFolder='notice_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo date("d M Y", strtotime($value->publish_dt));?></td>
            <td><?php echo $value->academic_year; ?></td>
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



      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="paymenyhistory_info" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="title_info"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" >Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>