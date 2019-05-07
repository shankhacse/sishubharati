<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/uploadfee.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />    
  
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Upload Fees Info List</li>
      </ol>
    </section>

  <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Exam Paper Upload Fees</h3>
              <a href="<?php echo base_url();?>uploadfee/adduploadfees" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                       <div class="row">

                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <label for="FeesType" class="searchby">Select Term</label>
                       
                      </div>
                     <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                       
                           <select id="sel_term" name="sel_term" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            
                            <option value="first">First</option>
                            <option value="second">Second</option>
                            <option value="third">Third</option>
                        
                                                 
                              </select>
                      </div>
                     </div>

                    </div>
              <div class="datatalberes" style="overflow-x:auto;" id="uploadfeeslist">
                <center>
                <button type="button" class=" bg-purple btn-flat margin" style="text-transform: capitalize ;"> <?php echo $bodycontent['term'].' Term ';?></button>   
                </center> 
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Class</th>
                  <th>Amount</th>
                 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['uploadFeesData'] as $value) { 
           
                  ?>
          
          <tr>
            
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->classname; ?></td>
            <td><?php echo $value->amount; ?></td>
           
             <td>
             <button type="button" class="btn btn-sm btn-danger edituploadfeeamt" 
             data-toggle="modal" 
             data-target="#uplfeeeditModal" 
             data-detailsid="<?php echo $value->id;?>"
             data-classname="<?php echo $value->classname;?>"
             data-term="<?php echo $bodycontent['term'];;?>"
             data-mode ="EDITAMT" 
             data-amount="<?php echo $value->amount; ?>"
             
               ><i class="glyphicon glyphicon-edit"></i></button> 
           </td>
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
               
              </table>

              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->


    <!-- The Modal -->
<div class="modal" id="uplfeeeditModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="padding: 5px">
       <span class="label label-primary" style="background-color: #422095 !important;
font-size: 13px;">Edit Upload Paper Amount</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
              <table class="table table-striped table-bordered">
   
    <tbody>
     
      <tr><td>Term</td><td id="term"></td> </tr>
          <tr><td>Class</td><td id="classname"></td> </tr>
          <?php
              $attr = array("id"=>"updateUploadFeeForm","name"=>"updateUploadFeeForm");
              echo form_open('',$attr); ?>
              <tr><td>Amount</td><td><input type="text"  class="form-control custom_frm_input"  name="amount" id="amount"  placeholder="Enter Amount"  /> 
              
                <input type="hidden" id="uploadfeedtlid" class="form-control custom_frm_input"  name="uploadfeedtlid"   /> 
               

              </td> </tr>
              
        <?php echo form_close(); ?>
    </tbody>
  </table>
   <div class="response_msg" id="amt_response_msg">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="amtupd">Save changes</button>
      </div>

    </div>
  </div>
</div>

