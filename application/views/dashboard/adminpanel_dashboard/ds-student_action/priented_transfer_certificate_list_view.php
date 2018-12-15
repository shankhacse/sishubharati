<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/studentaction.js"></script> 
<style type="text/css">
  .fmarks{
    background: #fff;
    color: #f39c12;
  }
</style>
<script type="text/javascript">
  $('.dataTables').DataTable();
</script>    
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Priented Transfer Certificate Student List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables " style="border-collapse: collapse !important;font-size: 16px;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Last Class</th>
                  <th>Session</th>
                  <th>Certificate Print Date</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['studentList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->studentname; ?></td>
            <td><?php echo $value->currentclass; ?></td>
            <td><?php echo $value->session_year; ?></td>
            <td><?php echo date('d-m-Y', strtotime($value->created_on)); ?></td>
						
						
						
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