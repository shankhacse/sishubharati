<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/classsubject.js"></script>  
<style type="text/css">
  .subst{background-color: #ef7a25 !important;}

  .fmarks {
    
    color: #ef7a25;
    
    background-color: #fff;
    
}

.btnpad{
  padding: 0px 5px;
}
</style>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admindashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subject details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class wise subject details</h3>
              <a href="<?php echo base_url();?>classsubject" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th style="width:10%;">Class</th>
                  <th style="width:65%;">Subjects (full marks)</th>
                
               
                  <th style="text-align:right;width:10%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['classsubjectList'] as $value) { 
              	
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value['classasignmasterData']->classname; ?></td>
					
						
						<td><?php 

                  foreach ($value['subjectMarksData'] as $submarksdata) { ?>
                   
                  <button class="label label-warning subst"><?php echo $submarksdata->subject; ?>
                    <span class="badge fmarks"><?php echo $submarksdata->subject_full_marks; ?></span>
                  </button>
                <?php  }
             ?>
              
            </td>
						<td align="center"> 
						  <a href="javascript:;" class="btn btn-success btn-xs subjectinfo"
              data-toggle="modal" data-target="#class_subject_info" 
              data-title="Add"
              data-mode="Add"
              data-classname="<?php echo $value['classasignmasterData']->classname; ?>"
              data-clssubmstid="<?php echo $value['classasignmasterData']->id; ?>">
              <span class="glyphicon glyphicon-plus"></span>
              </a>

              <a href="javascript:;" class="btn btn-primary btn-xs subjectinfo"
              data-toggle="modal" data-target="#class_subject_info" 
              data-title="Edit"
              data-mode="Edit"
              data-classname="<?php echo $value['classasignmasterData']->classname; ?>"
              data-clssubmstid="<?php echo $value['classasignmasterData']->id; ?>">
              <span class="glyphicon glyphicon-edit"></span>
              </a>

              <a href="javascript:;" class="btn btn-danger btn-xs subjectinfo"
              data-toggle="modal" data-target="#class_subject_info" 
              data-title="Delete"
              data-mode="Delete"
              data-classname="<?php echo $value['classasignmasterData']->classname; ?>"
              data-clssubmstid="<?php echo $value['classasignmasterData']->id; ?>">
                <span class="glyphicon glyphicon-remove"></span>
						  </a>
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




        <!-- Modal -->
  <div class="modal fade bd-example-modal-md" id="class_subject_info" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="class_name"></h4></button>
        </div>
        <div class="modal-body">
        <div id="detail_information_view"></div>




        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>