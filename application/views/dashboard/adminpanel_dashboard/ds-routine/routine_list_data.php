    <div class="datatalberes" style="overflow-x:auto;">
              <table id="dataTable" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                        <th>Week Day</th>
                        <th>First</th>
                        <th>Second</th>
                        <th>Third</th>
                        <th>Break</th>
                        <th>Fourth</th>
                        <th>Fifth</th>
                        <th>Sixth</th>
                 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($routineList as $key => $value) { 
              		
              		?>

					<tr>
						
            <td><?php echo $value->days_name; ?></td>
            <td><?php echo $value->first_cls_sub; ?></td>
            <td><?php echo $value->second_cls_sub; ?></td>
            <td><?php echo $value->third_cls_sub; ?></td>
            <td><?php  ?></td>
            <td><?php echo $value->fourth_cls_sub; ?></td>
            <td><?php echo $value->fifth_cls_sub; ?></td>
						<td><?php echo $value->sixth_cls_sub; ?></td>
						
						<td align="center"> 
							<a href="<?php echo base_url(); ?>routine/addroutine/<?php echo $value->id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
            </td>
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>

            </div>