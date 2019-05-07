<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/admission.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Students</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Students</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"ClassStudentListForm","name"=>"ClassStudentListForm");
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
              <button type="submit" class="btn btn-success formBtn" id="viewstudentlist">Search</button>
              </div>
                 </div>
                   <div class="row" style="margin-top:5px; ">

               <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn bg-purple" id="birthcertificate">View Birth  Certificate </button>
           
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadStudentList"> 
             

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->




<!-- Modal -->
<div class="modal fade" id="rolleditModal" tabindex="-1" role="dialog" aria-labelledby="rollEditModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document" style="margin-top: 170px;">
    <div class="modal-content">
      <div class="modal-header" style="padding: 5px">
       <span class="label label-primary" style="background-color: #422095 !important;
font-size: 13px;">Edit Roll No</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-striped table-bordered">
   
    <tbody>
      <tr><td>ID</td><td id="sid"></td> </tr>
      <tr><td>Name</td><td id="sname"></td> </tr>
          <tr><td>Class</td><td id="studentcls"></td> </tr>
          <?php
              $attr = array("id"=>"updateRollForm","name"=>"updateRollForm");
              echo form_open('',$attr); ?>
              <tr><td>Roll</td><td><input type="text" id="roll" class="form-control custom_frm_input"  name="roll" id="roll"  placeholder="Enter Roll"  /> 
                <input type="hidden" id="oldroll" class="form-control custom_frm_input"  name="oldroll"  /> 
                <input type="hidden" id="acdid" class="form-control custom_frm_input"  name="acdid"   /> 
                <input type="hidden" id="classid" class="form-control custom_frm_input"  name="classid" /> 

              </td> </tr>
              
        <?php echo form_close(); ?>
    </tbody>
  </table>
    <div class="response_msg" id="roll_response_msg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="rollupd">Save changes</button>
      </div>
    </div>
  </div>
</div>

