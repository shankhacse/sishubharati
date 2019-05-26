<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/importantinfo.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class Notes List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notes List - <?php echo $bodycontent['classname']?></h3>
              <a href="<?php echo base_url();?>classnotes" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD Notes</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
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


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->