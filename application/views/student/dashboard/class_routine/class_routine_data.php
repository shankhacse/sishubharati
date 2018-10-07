

    <div class="table-responsive" style="overflow-x:auto;">
      <button type="button" class="btn btn-outline btn-success btn-md btn-block"><?php echo "Routine ".$bodycontent['studentClass']."-".$bodycontent['year'];?></button><hr>
              <table id="dataTable" class="table table-bordered table-striped " style="border-collapse: collapse !important;">
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
                 
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['routineList'] as $key => $value) { 
              		
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
						
						
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>

            </div>