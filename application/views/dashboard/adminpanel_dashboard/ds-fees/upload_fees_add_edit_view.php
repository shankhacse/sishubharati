<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/uploadfee.js"></script> 
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

.chart-container {
    width: 80%;
    height: 480px;
    margin: 0 auto;
}

.pie-chart-container {
    height: 100px;
    width: 100px;
    float: left;
}
.row {
   margin-right: 71px;
margin-left: -78px;
}

.error-border{
  border:1px solid #F84F4F;
}
    </style> 
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Upload Fees</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Upload Fees</h3>
                 <a href="<?php echo base_url();?>uploadfee" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"UploadFeesForm","name"=>"UploadFeesForm");
              echo form_open('',$attr); ?>

              <input type="hidden" name="uploadfeesID" id="uploadfeesID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['FeesInfoEditdata']->fees_master_id;}else{echo "0";}?>" />
              
                  <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                <div class="box-body">
                 <div class="row">

                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <label for="FeesType" class="searchby">Select Term</label>
                       
                      </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                       
                           <select id="sel_term" name="sel_term" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="0">Select</option>
                            <option value="first">First</option>
                            <option value="second">Second</option>
                            <option value="third">Third</option>
                        
                                                 
                              </select>
                      </div>
                     </div>

                    </div>
                    

                 


                  
                  <?php 
                            if($bodycontent['classList'])
                            { $rowm=0;
                              foreach($bodycontent['classList'] as $classvalue)
                              { ?>

                  <div class="row">

                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <label for="FeesType" class="searchby">Paper Upload Fee (<?php echo $classvalue->name;?>)</label>
                      <input type="hidden" name="classid[]" value="<?php echo $classvalue->id;?>" >
                      </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                       
                         <input type="text" class="form-control forminputs removeerr tutionclass" id="uploadfee_<?php echo $rowm?>" name="uploadfee[]" autocomplete="off" placeholder="enter amount" onkeyup="numericFilter(this);"  />
                      </div>
                     </div>

                    </div>

                  <?php $rowm++;}}?>
                       
                 <input type="hidden" name="rownumfee" id="rownumfee" value="<?php echo $rowm;?>">

                  <p id="feesmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="feesavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="fees_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

