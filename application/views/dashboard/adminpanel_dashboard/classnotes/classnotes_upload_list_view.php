<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/classnotes.js"></script>     
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  
  <style type="text/css">
   .file {
  visibility: hidden;
  position: absolute;
} 


.modal {
  padding: 0 !important;
  text-align: center;
}
.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}
.modal .modal-dialog {
  text-align: left;
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  max-width: 90%;
}
.modal .close {
  position: absolute;
  right: 10px;
  color: black;
  text-shadow: none;
  font-size: 30px;
  line-height: 30px;
  top: 10px;
  opacity: 1;
}
.option_img{
height:200px;
width:160px;
border: 0.3em  solid #d4d4d4;
margin-top:10px;
}
.student_model{
padding:20px;
#box-shadow: 3px 3px 10px 1px rgba(95, 114, 146, 0.3);
}
.student_model h5
{
  font-family: "Gingham Variable", BlinkMacSystemFont, sans-serif;
  font-size: 15px;
  color:#1A5276;
}
@media screen and (max-width: 568px) {
.option_img{
width:100%;
height:auto;
}
}

.upper_div{
padding:20px;
margin:10px;
}
.image_box{
padding:20px


}
.image_box h3{
text-align: center;


}
.image_box img{
    margin-left: auto;
  margin-right: auto;
  display: block;
  }
  
  
  .custome_table tr{
  width:40%
  }

  .badge {

    padding: 1px 4px;

    background-color: #fff !important;

}


</style>
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class Notes Upload List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class Notes Upload Term List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:60%;">Class</th>
                  <th style="width:10%;">Session Year</th>
                  
                 
                 
                  <th style="width:10%;">Files</th>
                  <th style="width:20%;">Upload</th>
                  
                  <th style="width:20%;">View</th>
                  
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['classList'] as $value) { 
              			
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->classname; ?></td>
            <td><?php echo $value->year; ?></td>
						
						
						
           
            <td style="text-align: center;font-weight: bold;color: #ab12cb;"><?php echo $value->fileupload_count; ?> </td>
						<td style="text-align: center;">
        
               <a href="javascript:;" class="btn btn-warning btn-xs classnotespdf"
              data-toggle="modal" data-target="#result_list" 
              data-title="Edit"
              data-mode="Edit"
              data-classnoteid="<?php echo $value->id?>"
              data-classname="<?php echo $value->classname?>"
              data-year="<?php echo $value->year?>"
              >
          
               <span class="glyphicon glyphicon-cloud-upload"></span>
             Upload 
              
              </a>      
            </td>
              <td align="center" style="vertical-align:middle;padding:0;"> 
              <a href="<?php echo base_url(); ?>classnotes/addClassNotesList/<?php echo $value->id.'/'.$value->classname; ?>" class="btn btn-success btn-xs" data-title="Edit">
                <span class="glyphicon glyphicon-arrow-right"></span>
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
  <div class="modal fade bd-example-modal-lg" id="result_list" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="text-align:center;padding: 5px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="term_name"></h4></button>
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