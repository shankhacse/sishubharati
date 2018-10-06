<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/events.js"></script>   
<style type="text/css">
  
  .events_poster {
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
              <h3 class="box-title">Events List</h3>
              <a href="<?php echo base_url();?>events/addEvents" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Event Title</th>
                  <th>Place</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Poster</th>
                  
                  
                  <th style="text-align:right;width:10%;">Action</th>
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
						<td><?php echo $status; ?></td>
						
						
						
						<td align="center"> 
							<img src="<?php echo $download_link; ?>" class="events_poster" />
						
						</td>
            <td align="center"> 
            
              <a href="javascript:;" class="btn btn-danger btn-xs deleteevent" 
              data-title="Delete"
              data-eventid="<?php echo $value->events_id;?>"
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