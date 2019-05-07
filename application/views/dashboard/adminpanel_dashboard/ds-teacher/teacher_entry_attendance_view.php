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
        <li class="active">Entry attendance (Teacher/Non Staff) </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Entry attendance (Teacher/Non Staff)</h3>
               <a href="<?php echo base_url();?>teacher/register" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"TeacherAttendanceForm","name"=>"TeacherAttendanceForm");
              echo form_open('',$attr); ?>

                                <div class="row">
                      <div class="col-md-4 "><label for="monthList" class="searchby">View By</label> </div>
                      <div class="col-md-4">
                               <div class="form-group">
                     
                     
                       <select id="view_by" name="view_by" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="T">Teacher</option>
                        <option value="N">Non Staff</option>
                        </select>
                        </div>

                                   
                           
                      </div>
             
                </div>
              <div class="row" id="teacher_view">
            <div class="col-md-4 "><label for="classList" class="searchby"> Teacher </label> </div>
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
                    <option value="<?php echo $value->teacher_id; ?>"><?php echo $value->name.'('.$value->teacher_uniq_id.')' ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>

                    <div class="row" id="nonstaff_view">
            <div class="col-md-4 "><label for="classList" class="searchby"> Non Staff </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_nonstaff" name="sel_nonstaff" class="form-control selectpicker"
                        data-actions-box="true" data-live-search="true" >
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['nonstaffList'])
                            {
                              foreach($bodycontent['nonstaffList'] as $value)
                              { ?>
                    <option value="<?php echo $value->teacher_id; ?>"><?php echo $value->name.'('.$value->teacher_uniq_id.')' ; ?></option>
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
            <section id="loadteacherdetails"> 
             

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





