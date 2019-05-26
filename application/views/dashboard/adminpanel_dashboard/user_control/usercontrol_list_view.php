<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/usercontrol.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Admin User List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-responsive table-bordered table-striped" style="border-collapse: collapse !important;">
                <thead>
                <tr style="background: #cd558e;color: #FFF;">
                  <th style="width:10%;">Sl</th>
                  <th style="width:10%;">Username</th>
                  <th style="width:10%;">Authorization</th>
                  <th style="width:10%;">Role</th>
                  
                  
              
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['userList'] as $value) { 
              			$status = "";


                    if ($value->usertype=='Superadmin' || $value->usertype=='Developer') {

                      $status = '<div class="status_dv"><span class="label label-success status_tag" style="background-color: #7400a6 !important;" >Always </span></div>';

                    }else{



                         if($value->is_active=="Y")
                        {
                          $status = '<div class="status_dv "><span class="label label-success status_tag autorizationstatus" data-setstatus="N" data-userid="'.$value->id.'"><span class="glyphicon glyphicon-ok"></span> Yes</span></div>';
                        }
                        else
                        {
                          $status = '<div class="status_dv"><span class="label label-danger status_tag autorizationstatus" data-setstatus="Y" 
                          data-userid="'.$value->id.'"><span class="glyphicon glyphicon-remove"></span> No</span></div>';
                        }



                    }
              		
              		?>

					<tr>
						<td><?php echo $value->id; ?></td>
            <td><?php echo $value->username; ?></td>

						<td><?php echo $status; ?></td>
            <td style="font-weight: bold;color: #d6741e;"><?php echo $value->usertype; ?></td>
					
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