    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">District ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">District </h3>
                 <a href="<?php echo base_url();?>district" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"DistrictForm","name"=>"DistrictForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="districtID" id="districtID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['DistrictEditdata']->distID;}else{echo "0";}?>" />
                    <input type="hidden" name="districtMode" id="districtMode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="country">Country</label> 
                    <select id="country" name="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="0">Select</option>
                      <?php 
                      if($bodycontent['countryList'])
                      {
                        foreach($bodycontent['countryList'] as $countrylist)
                        { ?>
                            <option value="<?php echo $countrylist->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['DistrictEditdata']->countryID==$countrylist->id){echo "selected";}else{echo "";}}else{if($countrylist->id==101){echo "selected";}else{echo "";}}?> ><?php echo $countrylist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  <div class="form-group">
                      <label for="state">State</label> 
                      <div id="states_dropdown">
                        <select id="state" name="state" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                           <?php 
                            if($bodycontent['stateList'])
                            {
                              foreach($bodycontent['stateList'] as $statelist)
                              { ?>
                                  <option value="<?php echo $statelist->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['DistrictEditdata']->state_id==$statelist->id){echo "selected";}else{echo "";}}else{if($statelist->id==41){echo "selected";}else{echo "";}}?> ><?php echo $statelist->name; ?></option>
                      <?php   }
                            }
                            ?>


                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="district">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="district" name="district" placeholder="Enter District Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['DistrictEditdata']->districtname;}?>" >
                  </div>

                  <p id="districtmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="districtsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="district_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

