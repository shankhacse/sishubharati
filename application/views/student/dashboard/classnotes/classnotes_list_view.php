
<div class="panel panel-primary">
      <div class="panel-heading">Class Notes  </div>
<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
    <div class="table-responsive" style="overflow-x:auto;">
                
             <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:15%;">Description</th>
                  <th style="width:15%;">Filename</th>
                  <th style="width:15%;">Upload serial</th>
                  <th style="width:15%;">Upload Date</th>
             
                  <th>Download</th>
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['resultPublishdata'] as $value) { 
                  $status = "";
                 
        $uplodedFolder='class_notes';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->uploaded_file_desc; ?></td>
            <td><?php echo $value->user_file_name; ?></td>
            <td><?php echo $value->upload_srl_no; ?></td>
            <td><?php echo date("d M Y", strtotime($value->uploaded_on)); ?></td>
           
            
            
            
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


