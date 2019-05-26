
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
                  <th>Title</th>
                  <th style="width:15%;">Document</th>
                  <th>view</th>
                  <th>Download</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      foreach ($bodycontent['documentDetailData'] as $key => $value) {
      
                          $download_link = base_url()."application/assets/ds-documents/".$bodycontent['uplodedFolder']."/".$value->random_file_name;
                          $file_name = explode('.',$value->random_file_name);
                          $file_extension = $file_name[1];
                        //  echo $file_extension;
                          if($file_extension=="jpg" || $file_extension=="JPG" || $file_extension=="jpeg" || $file_extension=="JPEG" || $file_extension=="png" || $file_extension=="PNG" || $file_extension=="gif")
                          {
                            $src = base_url()."application/assets/ds-documents/".$bodycontent['uplodedFolder']."/".$value->random_file_name;
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
                              <img src="<?php echo $src; ?>" class="facility_icon_list" style="width: 35mm;" />    
                          <?php  
                          }
                          else{echo "";}
                          ?>
                        </td>
                       <!--  <td><?php echo $org_file_name; ?></td> -->
                        <td><a href="<?php echo $download_link; ?>" target="_blank" class="btn btn-sm btn-warning">view</a></td>
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


