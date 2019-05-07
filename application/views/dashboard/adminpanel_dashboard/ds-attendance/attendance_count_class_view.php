<script src="<?php echo base_url(); ?>application/assets/js_scripts/chart/Chart.min.js"></script>

<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/attendance.js"></script> 

<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Details
</li>
      </ol>
    </section>
<?php
  $curr_dt = date('d/m/Y');     
?>
    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Attendance Details
</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"AttendanceCountForm","name"=>"AttendanceCountForm");
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
                
                 <div class="row" id="month_view">
                      <div class="col-md-4 "><label for="monthList" class="searchby">Month</label> </div>
                      <div class="col-md-4">
                               <div class="form-group">
                     
                     
                       <select id="sel_month" name="sel_month" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        
                          <?php 
                            if($bodycontent['monthList'])
                            {
                              foreach($bodycontent['monthList'] as $value)
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
            <section id="loadstudentList"> 
             

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





