<script src="<?php echo base_url();?>application/web_assets/perfect_gallery/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 

<!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<section class="about_us_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub_banner_hdg">
                        <h3>Result List  </h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
<section>
<div class="container" style="overflow-x:auto">
<div class="row header holiday_table" style="text-align:center;color:green">
<h3> <?php echo $bodycontent['term'].' Term -'.$bodycontent['year'];?></h3>
</div>
<br><br>
<table id="myTable" class="table table-striped table-bordered table-responsive table-hover" >  
          <thead>
                <tr>
                  <th style="width:10%;">Sl No.</th>
                  <th style="width:15%;">Description</th>
                 
                  <th style="width:15%;">Upload Date</th>
             
                  <th>View</th>
                  <th>Download</th>
                 
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['resultPublishdata'] as $value) { 
                  $status = "";
                 
        $uplodedFolder='resultlist_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
                  ?>

                  

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->uploaded_file_desc; ?></td>
           
            <td><?php echo date("d M Y", strtotime($value->uploaded_on)); ?></td>
           
           
            <td><a href="<?php echo $download_link; ?>" target="_blank" class="btn btn-sm btn-warning">view</a></td>
            
            <td align="center"> 
              <a href="<?php echo $download_link; ?>" download>
               <button type="button" class="btn btn-sm btn-primary">
                <span class="glyphicon glyphicon-download"></span> Download</button></a>
            
            </td>
           
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
      </table>  
    </div>

</section>

    <!-- <script>
    $(document).ready(function(){
    $('#myTable').dataTable();
    });
    </script> -->