<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/notice.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notice & Update List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notice & Update List</h3>
              <a href="<?php echo base_url();?>notice/addNotice" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Publish Date</th>
                  <th>Academic Year</th>
                  <th>Notice Title</th>
                  <th>Status</th>
                  <th>Download</th>
                  <th style="text-align:right;width:10%;">Action</th>
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
						<td><?php echo $status; ?></td>
						
						
						
						<td align="center"> 
							<a href="<?php echo $download_link; ?>" download>
               <button type="button" class="btn btn-sm btn-primary">
                <span class="glyphicon glyphicon-download"></span> Download</button></a>
						
						</td>
            <td align="center"> 
            
              <a href="javascript:;" class="btn btn-danger btn-xs deletenotice" 
              data-title="Delete"
              data-noticeid="<?php echo $value->notice_id;?>"
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