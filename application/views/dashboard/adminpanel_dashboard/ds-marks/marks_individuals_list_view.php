<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/marks.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
  <style type="text/css">
@media print
{
body * { visibility: hidden; }
#printcontent * { visibility: visible; }
#printcontent { position: absolute; top: 40px; left: 30px; }
}
</style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Marks of Student </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Marks of Student</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"marksIndividualsForm","name"=>"marksIndividualsForm");
              echo form_open('',$attr); ?>
                <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby">Search By </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_type_searchby" name="sel_type_searchby" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                        <option value="SID">Student ID</option>
                        <option value="SNAME">Student Name</option>
                       
                        </select>
                        </div>
                 
                  </div>
             
                </div>
              <div class="row scbyname">
            <div class="col-md-4 "><label for="classList" class="searchby"> Class </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_classpayhis" name="sel_classpayhis" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
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
             <div class="row scbyname">
            <div class="col-md-4 "><label for="classList" class="searchby">Student </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     <div id="student_viewph">
                       <select id="sel_student" name="sel_student" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                        
                        </select>
                        </div>
                        </div>
                 
                  </div>
             
                </div>
            <div class="row scbyid">
            <div class="col-md-4 "><label for="classList" class="searchby"> Student ID </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                         <select id="sel_student_id" name="sel_student_id" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['StudentIdList'])
                            {
                              foreach($bodycontent['StudentIdList'] as $value)
                              { ?>
                    <option value="<?php echo $value->academic_id; ?>"><?php echo $value->student_uniq_id ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
                 <div class="row">
                    <div class="col-md-offset-3 col-md-6 btnview">
              <button type="submit" class="btn btn-primary formBtn">View Exam Marks</button>
              <button type="button" class="btn btn-success formBtn" id="exampaperview" >View Exam Papers</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadStudentMarksheet"> 
              

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->







      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="paymenyhistory_info" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="title_info"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger closebtn" data-dismiss="modal" >Close</button>
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


