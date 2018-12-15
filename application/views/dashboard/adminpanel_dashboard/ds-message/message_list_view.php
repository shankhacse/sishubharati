<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/message.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Message List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Message List</h3>
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="" style="overflow-x:auto;">
              <table class="table table-bordered table-striped " style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th style="width:10%;">Student ID</th>
                  <th style="width:35%;">Message From Student /Parents</th>
                  <th style="width:10%;">Date</th>
                  <th style="width:20%;">Reply</th>
                  <th style="width:10%;">Reply Date</th>
                 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;$row=1;
              		foreach ($bodycontent['messageList'] as $value) { 
              		?>

					<tr>
						<td><?php echo $i++;?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_message; ?></td>
            <td><?php echo date("d M Y", strtotime($value->created_on)); ?></td>
            <td>
              <div id="replyerr_<?php echo $row?>">
                 <textarea type="text" class="form-control" name="reply[]" id="reply_<?php echo $row?>" ><?php echo $value->admin_reply; ?></textarea>
              </div>
             </td>
            <td><?php 
            if ($value->admin_reply_date!='') {
               echo date("d M Y", strtotime($value->admin_reply_date));
            }
            ?></td>
            <td>
              <?php
              if ($value->is_replied=='N') {
            
              ?>
              <button type="button" class="btn btn-danger repltmsgbtn" 
            data-dismiss="modal"
            data-msgid="<?php echo $value->id; ?>" 
            data-rownum="<?php echo $row; ?>" 
            >Reply</button>
            <?php }else{?>
            <button type="button" class="btn btn-success repltmsgbtn" 
            data-dismiss="modal"
            data-msgid="<?php echo $value->id; ?>" 
            data-rownum="<?php echo $row; ?>" 
            >Reply</button>
          <?php }?>
            </td>
         
					</tr>
              			
              	<?php
              		$row++;}

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