<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/aboutus.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About Us</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">About Us</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="" style="overflow-x:auto;">
              <table class="table table-bordered table-striped " style="border-collapse: collapse !important;">
                <thead style="background-color:#cd558e;color:#fff;">
                <tr>
                  
                  <th style="width:10%;" >&nbsp;</th>
                  <th style="text-align:center;width:80%;" >Information</th>
                  <th style="text-align:center;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              

					<tr>
						<td style="font-weight: bold;padding-top: 70px;color: #cd558e;">History</td>
            <td><textarea name="history" id="history" style="width: 950px;height:200px;border: 2px solid #f2ecec;"><?php echo $bodycontent['aboutUsData']->history?></textarea></td>
						<td align="center">
            <button type="button" class="btn btn-primary updtaboutusbtn" style="
               margin-top: 75px;" 
            data-dismiss="modal"
            data-aboutusid="<?php echo $bodycontent['aboutUsData']->id; ?>" 
            data-columnname="<?php echo "History" ?>" 
            >Update</button>      
            </td>
					</tr>

          <tr>
          <td style="font-weight: bold;padding-top: 70px;color: #cd558e;">Mission</td>
            <td><textarea name="mission" id="mission" style="width: 950px;height:200px;border: 2px solid #f2ecec;"><?php echo $bodycontent['aboutUsData']->mission?></textarea></td>
            <td align="center">
              <button type="button" class="btn btn-primary updtaboutusbtn" style="
               margin-top: 75px;"
            data-dismiss="modal"
            data-aboutusid="<?php echo $bodycontent['aboutUsData']->id; ?>" 
            data-columnname="<?php echo "Mission" ?>" 
            >Update</button>
            </td>
          </tr>

          <td style="font-weight: bold;padding-top: 70px;color: #cd558e;">Vision</td>
            <td><textarea name="vision" id="vision" style="width: 950px;height:200px;border: 2px solid #f2ecec;"><?php echo $bodycontent['aboutUsData']->vision?></textarea></td>
            <td align="center">
               <button type="button" class="btn btn-primary updtaboutusbtn" style="
               margin-top: 75px;"
            data-dismiss="modal"
            data-aboutusid="<?php echo $bodycontent['aboutUsData']->id; ?>" 
            data-columnname="<?php echo "Vision" ?>" 
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