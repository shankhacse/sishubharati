  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/holidays.js"></script> 
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Holiday ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Holiday </h3>
                 <a href="<?php echo base_url();?>holidays" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"HolidaysForm","name"=>"HolidaysForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
             

                  <div class="form-group">
                    <input type="hidden" name="holidaysID" id="holidaysID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HolidaysEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                  
                     <label>Date </label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datepicker" id="dtholiday" name="dtholiday" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo date("d/m/Y",strtotime($bodycontent['HolidaysEditdata']->date));}else{echo date('d/m/Y');}  ?>">
                  </div>

                  
                        <div class="form-group">
                          <label for="subcode">Title</label>
                          <input type="text"   class="form-control forminputs removeerr typeahead " id="holititle" name="holititle" placeholder="Enter Holiday Title" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HolidaysEditdata']->title; } ?>" >
                        </div>
                 

                  <p id="holimsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="holisavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="holi_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

