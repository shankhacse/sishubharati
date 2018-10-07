<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/subject.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contact List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Contact List</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th style="width:10%;">Name</th>
                  <th style="width:10%;">Email</th>
                 
                  <th style="width:10%;">Phone</th>
                  <th style="width:10%;">Contact Date</th>
                  <th style="width:60%;">Message</th>
                  
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['contactList'] as $value) { 
              ?>

					<tr>
            <td><?php echo $i; ?></td>
						<td><?php echo $value->name; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->phone; ?></td>  
            <td><?php echo date("d M Y", strtotime($value->created_on));?></td>
						<td><?php echo $value->message; ?></td>
						
				
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