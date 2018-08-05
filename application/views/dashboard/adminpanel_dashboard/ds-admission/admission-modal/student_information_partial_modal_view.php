<div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Student Documents</h4>
    </div>
    <div class="modal-body">
    <?php 
      if($documentDetailData)
      {
       /*echo "<pre>";
       print_r($documentDetailData);
       echo "<pre>";*/
        ?>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $studentname; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Title</th>
                  <th>Document</th>
                  <th>Download</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      foreach ($documentDetailData as $key => $value) {
        
                          $download_link = base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                          $file_name = explode('.',$value->random_file_name);
                          $file_extension = $file_name[1];
                          //echo $file_extension;
                          if($file_extension=="jpg" || $file_extension=="jpeg" || $file_extension=="png" || $file_extension=="gif")
                          {
                            $src = base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                            $org_file_name = "<a href='".$download_link."' download>".$value->user_file_name."</a>" ;
                          }
                          else
                          {
                            $org_file_name = "<a href='".$download_link."' download>".$value->user_file_name."</a>" ;

                            if($file_extension=="pdf")
                            {
                              $src = base_url()."application/assets/UploadedDocs/pdf_img.png";
                            }
                            elseif($file_extension=="docx" || $file_extension=="doc")
                            {
                              $src = base_url()."application/assets/UploadedDocs/docx_img.png";
                            }
                            elseif($file_extension=="txt")
                            {
                              $src = base_url()."application/assets/UploadedDocs/txt_img.png";
                            }
                            elseif($file_extension=="xls")
                            {
                              $src = base_url()."application/assets/UploadedDocs/xls_img.png";
                            }

                          }
                ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value->document_type; ?></td>
                        <td>
                          <?php 
                          
                          if(isset($value->random_file_name))
                          { ?>
                              <img src="<?php echo $src; ?>" class="facility_icon_list" />    
                          <?php  
                          }
                          else{echo "";}
                          ?>
                        </td>
                        <td><?php echo $org_file_name; ?></td>
                      </tr>
                      <?php
                          }

                      ?>
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
  
      <?php
        }
     
    ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
     
    </div>
</div>