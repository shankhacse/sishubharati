<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/payment.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
    <style>
   
    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students List of Unpaid Admission Fee </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students List of Unpaid Admission Fee</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"UnpaidAdmListForm","name"=>"UnpaidAdmListForm");
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
            <section id="loadUnpaidAdmStudentList"> 
               <div class="datatalberes" style="overflow-x:auto;">
                  <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Roll</th>
                  <th>Father Name</th>
                  <th>Admission</th>
                  <th width="10%">Action</th>
                  
                </tr>
                </thead>
                <tbody>
               
                <?php 
                  $i = 1;
                  foreach ($bodycontent['unpaidStudentList'] as $value) {

                  //  echo $value['centerMasterData']->center_name;

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->class_name; ?></td>
            <td><?php echo $value->class_roll; ?></td>
            <td><?php echo $value->father_name; ?></td>
            <td><?php echo date("d M Y", strtotime($value->admission_dt));?></td>
            <td>
                <button type="button" class="btn btn-sm btn-danger ViewAdmMakePayment" data-toggle="modal" data-target="#makepayment_info" 
                data-studentid="<?php echo $value->student_uniq_id;?>" 
                data-academicid="<?php echo $value->academic_id;?>" 
                data-classname="<?php echo $value->class_name;?>" 
                data-classroll="<?php echo $value->class_roll;?>" 
                data-mode ="ADMFEE" 
                data-studentname="<?php echo $value->name; ?>" >Make Payment </button> 
            </td>
           
           
         
          </tr>
                    
                <?php
                  }

                ?>
             
                </tbody>
               
              </table>
             
               </div> 

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



      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="makepayment_info" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal" onclick="return redirectMe();">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="title_info"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" onclick="return redirectMe();">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>



<!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <p id="save-msg-data"></p>
      </div>
      <div class="modal-footer">

   <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" onclick="return redirectMe();">Close</button>
    
      </div>
    </div>

  </div>
</div>


