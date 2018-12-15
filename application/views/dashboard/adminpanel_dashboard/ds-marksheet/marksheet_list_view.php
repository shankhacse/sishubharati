<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/marksheet.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Print Marksheet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Print Marksheet</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"PrintMarksheetForm","name"=>"PrintMarksheetForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Class </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_class" name="sel_class" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                          <?php 
                            if($bodycontent['classList'])
                            {
                              foreach($bodycontent['classList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
            

                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary formBtn" id="viewblocllist">View</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadStudentList"> 
               <div class="datatalberes" style="overflow-x:auto;">
             <!--  <table id="dataTable" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
               <thead>
               <tr>
                 <th style="width:10%;">Sl</th>
                 <th>Name</th>
                 <th>Mobile</th>
                 <th>Group Coordinator</th>
                 <th>Block</th>
                 <th>Village</th>
                 <th>Panchayat</th>
                 <th style="width:30%;">Address</th>
                 <th>Pin</th>
                 <th>Aadhar No.</th>
                 <th>Voter No</th>
                 <th style="width:10%;">Status</th>
                 <th style="text-align:right;width:5%;">Action</th>
               </tr>
               </thead>
               <tbody>
              
               <?php 
                 $i = 1;
                 foreach ($bodycontent['nqppList'] as $key => $value) { 
                   $status = "";
                   if($value->active==1)
                   {
                     $status = '<div class="status_dv "><span class="label label-success status_tag nqpppstatus" data-setstatus="0" data-nqppid="'.$value->nqppid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                   }
                   else
                   {
                     $status = '<div class="status_dv"><span class="label label-danger status_tag nqppstatus" data-setstatus="1" 
                     data-nqppid="'.$value->nqppid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                   }
                 ?>
             
                       <tr>
                         <td><?php echo $i++; ?></td>
                         <td><?php echo $value->nqppname; ?></td>
                         <td><?php echo $value->nqppmobile; ?></td>
                         <td><?php echo $value->cordinatorname; ?></td>
                         <td><?php echo $value->blockname; ?></td>
                         <td><?php echo $value->village; ?></td>
                         <td><?php echo $value->panchayat; ?></td>
                         <td style="width:30%;"><?php echo $value->full_address; ?></td>
                         <td><?php echo $value->pin_code; ?></td>
                         <td><?php echo $value->aadhar_no; ?></td>
                         <td><?php echo $value->voter_id; ?></td>
                         <td><?php echo $status; ?></td>
                         <td align="center"> 
                           <a href="<?php echo base_url(); ?>nqpp/addnqpp/<?php echo $value->nqppid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
                             <span class="glyphicon glyphicon-pencil"></span>
                           </a>
                         </td>
                       </tr>
                   
               <?php
                 }
             
               ?>
             
               </tbody>
              
             </table>
             
                         </div> -->

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->



<!-- Modal -->
<div class="modal fade" id="hubpinlistmodal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:0px;">
        <h5 class="modal-title" >Pin Assigned with <span id="hubname"></span></h5>
      </div>
      <div class="modal-body" id="pinassigned_detail"></div>
      <div class="modal-footer" style="border-top:0px;">
            <button class="btn btn-default modalbtn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


