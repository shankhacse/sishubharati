<script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
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
                        <h3>Holiday List </h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
<section>
<div class="container" style="overflow-x:auto">
<div class="row header holiday_table" style="text-align:center;color:green">
<h3>Holiday List - <?php echo $bodycontent['year'];?></h3>
</div>
<br><br>
<table id="myTable" class="table table-striped table-bordered table-responsive table-hover" >  
        <thead>  
          <tr>  
              
            <th>Date</th>  
            <th>Day</th>  
            <th>Purpose</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php
          foreach ($bodycontent['holidays'] as  $value) {
          
          ?>
          <tr>  
           
            <td><?php echo date("d M Y", strtotime($value->date));?></td>  
            <td><?php echo date("D", strtotime($value->date));?></td>  
            <td><?php echo $value->title?></td>  
          </tr>  
         
        <?php }?>
         
        </tbody>  
      </table>  
    </div>

</section>

    <!-- <script>
    $(document).ready(function(){
    $('#myTable').dataTable();
    });
    </script> -->