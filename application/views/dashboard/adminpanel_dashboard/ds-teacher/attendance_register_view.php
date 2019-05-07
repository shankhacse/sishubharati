<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/teacher.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />     
    <style>

.inline{
  #display: inline-block;
}
.inline + .inline{
  margin-left:10px;
}
.radio{
  color:#999;
  font-size:15px;
  position:relative;
}
.radio span{
  position:relative;
   padding-left:20px;
}
.radio span:after{
  content:'';
  width:15px;
  height:15px;
  border:3px solid;
  position:absolute;
  left:0;
  top:1px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
  box-sizing:border-box;
  -ms-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
}
.radio input[type="radio"]{
   cursor: pointer; 
  position:absolute;
  width:100%;
  height:100%;
  z-index: 1;
  opacity: 0;
  filter: alpha(opacity=0);
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
}
.radio input[type="radio"]:checked + span{
  color:#0B8;  
}
.radio input[type="radio"]:checked + span:before{
    content:'';
  width:5px;
  height:5px;
  position:absolute;
  background:#0B8;
  left:5px;
  top:6px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
}

.radiocol input[type="radio"]:checked + span{
  color:#F01616;  
}
.radiocol input[type="radio"]:checked + span:before{
    content:'';
  width:5px;
  height:5px;
  position:absolute;
  background:#F01616;
  left:5px;
  top:6px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
}


   
    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Register (Teacher/Non Staff)</li>
      </ol>
    </section>
<?php
  $curr_dt = date('d/m/Y');     
?>
    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Attendance (Teacher/Non Staff)</h3>
               <a href="<?php echo base_url();?>teacher/attendance" class="link_tab"><span class="glyphicon glyphicon-Plus"></span> Entry</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"TeacherAttendanceRegisterForm","name"=>"TeacherAttendanceRegisterForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> From </label> </div>
            <div class="col-md-4">
                     <div class="form-group">
                             <input type="text" id="fromdate" class="form-control custom_frm_input datepicker"  name="fromdate"  placeholder="" value="<?php echo $curr_dt;?>" />   
                                  </div>
                         
                 
                  </div>
             
                </div>

                 <div class="row">
                      <div class="col-md-4 "><label for="classList" class="searchby">To </label> </div>
                      <div class="col-md-4">
                                <div class="form-group">
                             <input type="text" id="todate" class="form-control custom_frm_input datepicker"  name="todate"  placeholder="" value="<?php echo $curr_dt;?>" />   
                                  </div>

                                   
                           
                      </div>
             
                </div>

                 <div class="row">
            <div class="col-md-4 "><label for="classList" class="searchby"> Name </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_teacher" name="sel_teacher" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['teacherList'])
                            {
                              foreach($bodycontent['teacherList'] as $value)
                              { ?>
                    <option value="<?php echo $value->teacher_id; ?>"><?php echo $value->name ; ?></option>
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
                       <p id="teacherattregmsg" class="form_error"></p>
              <button type="submit" class="btn btn-primary formBtn" id="viewblocllist">View</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div><br>
            <section id="loadteacherList"> 
             

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





