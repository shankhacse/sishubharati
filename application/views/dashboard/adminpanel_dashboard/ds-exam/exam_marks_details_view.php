<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/exam.js"></script> 
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
<style type="text/css">
  .error-border{
    border: 1px solid red;
  }
  
   .file {
  visibility: hidden;
  position: absolute;
} 

  
</style>   
   
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Marks</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Details of marks</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"MarksDetailsForm","name"=>"MarksDetailsForm");
              echo form_open('',$attr); ?>
              <div class="row">
               
            <div class="col-md-4 ">
              <label for="classList" class="searchby"> Class </label> </div>
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
               
            <div class="col-md-4 ">
              <label for="classList" class="searchby"> Term </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_term" name="sel_term" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                     
                    <option value="first">First</option>
                    <option value="second">Second</option>
                    <option value="third">Third</option>
                            
                        </select>
                        </div>
                 
                  </div>
             
                </div>
               
            <p id="clssubcreatmsg" class="form_error"></p>
           
                 <div class="row">
                    <div class="col-md-offset-3 col-md-6 btnview">
              <button type="submit" class="btn btn-primary formBtn" >View Details</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadstudentList"> 
               <div class="datatalberes" >
             
             
              </div> 

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->




      <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="subject_marks" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="student_name"></h4></button>
        </div>
        <div class="modal-body" style="height: 500px;overflow-y: scroll;">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>  




        





