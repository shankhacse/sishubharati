<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/holidays.js"></script> 
<style type="text/css">
  .fmarks{
    background: #fff;
    color: #f39c12;
  }
</style>    
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grade List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">grade List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="" style="overflow-x:auto;">
              <table class="table table-bordered table-striped " style="border-collapse: collapse !important;font-size: 16px;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Full Marks</th>
                  <th>Marks Range</th>
                  <th>Grade</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['gradeList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td>
              <button class="label label-warning subst">
                <span class="badge fmarks"> <?php echo $value->fullmarks; ?></span>
                  </button>
             </td>
						<td><?php echo $value->from_marks." - ".$value->to_marks; ?></td>
						<td style="font-weight: bold;color: #2c76b5;" ><?php echo $value->grade; ?></td>
            <td><?php echo $value->status; ?></td>
						
						
						
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