<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/notice.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Published Message</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Published Message</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="" style="overflow-x:auto;">
              <table class="table table-bordered table-striped " style="border-collapse: collapse !important;">
                <thead style="background-color:#cd558e;color:#fff;">
                <tr>
                  
                  <th style="width:10%;" >&nbsp;</th>
                  <th style="text-align:center;width:80%;" >Information</th>
                  <th style="text-align:center;width:10%;" >Visable Status</th>
                  <th style="text-align:center;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>

                  <?php

                  $status = "";
                    if($bodycontent['PublishMsgData']->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag pubmsgtatus" data-setstatus="0" data-pubmsgid="'.$bodycontent['PublishMsgData']->id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag pubmsgtatus" data-setstatus="1" 
                      data-pubmsgid="'.$bodycontent['PublishMsgData']->id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }


                  ?>
               
              

					<tr>
						<td style="font-weight: bold;color: #cd558e;">Message</td>
            <td><textarea name="message" id="message" style="width: 950px;height:35px;border: 2px solid #f2ecec;"><?php echo $bodycontent['PublishMsgData']->message?></textarea></td>
             <td><?php echo $status; ?></td>
						<td align="center">
             
            <button type="button" class="btn btn-primary updtaboutusbtn" style="
              " 
            data-dismiss="modal"
            data-pubmsgid="<?php echo $bodycontent['PublishMsgData']->id; ?>" 
            data-columnname="<?php echo "message" ?>" 
            >Update</button>      
            </td>
					</tr>

     
              			
              

                </tbody>
               
              </table>

              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->



    <!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 188px;">
      
      <div class="modal-body">
        <p id="save-msg-data" style="text-align: center;color: green;font-weight: bold;"></p>
      </div>
      <div class="modal-footer" style="padding: 7px;">

   
       <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="redirectMe('<?php echo base_url()?>','aboutus');">Close</button>
    
   
    
      </div>
    </div>

  </div>
</div>