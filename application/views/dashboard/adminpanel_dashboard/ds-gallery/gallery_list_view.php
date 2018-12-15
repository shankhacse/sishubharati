<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/gallery.js"></script>   
<style type="text/css">
  
  .img_poster {
    width: 100px;
    height: 70px;
    border-radius: 10%;
    border: 1px solid #989898;
}
</style>  
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Events List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Image List</h3>
              <a href="<?php echo base_url();?>gallery/addImage" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Upload Date</th>
                  <th>Album</th>
                 
                  <th>Image</th>
                  
                  
                  <th style="text-align:right;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['imageList'] as $value) { 
              		
        $uplodedFolder='gallery_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

              		

					<tr>
			<td><?php echo $i++; ?></td>
            <td><?php echo date("d M Y", strtotime($value->created_on));?></td>
            <td><?php echo $value->album; ?></td>
           
						
						
						
						<td align="center"> 
							<img src="<?php echo $download_link; ?>" class="img_poster" />
						
						</td>
            <td align="center"> 
            
              <a href="javascript:;" class="btn btn-danger btn-xs deleteimage" 
              data-title="Delete"
              data-galleryid="<?php echo $value->gallery_id;?>"
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