<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/importantinfo.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Important Information List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Important Information File List</h3>
              <a href="<?php echo base_url();?>importantinfo/addInfo" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Upload Date</th>
                  <th>Info Title</th>
                  <th>Status</th>
                  <th>Download</th>
                  <th style="text-align:right;width:10%;">Action</th>
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
						<td><?php echo $status; ?></td>
						
						
						
						<td align="center"> 
							<a href="<?php echo $download_link; ?>" download>
               <button type="button" class="btn btn-sm btn-primary">
                <span class="glyphicon glyphicon-download"></span> Download</button></a>
						
						</td>
            <td align="center"> 
            
              <a href="javascript:;" class="btn btn-danger btn-xs deleteinfo" 
              data-title="Delete"
              data-infoid="<?php echo $value->info_id;?>"
              data-docid="<?php echo $value->docid;?>"
              >
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            
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