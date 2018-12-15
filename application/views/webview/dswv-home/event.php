<script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 

  <!-- <script src="<?php echo base_url();?>application/web_assets/js/bootstrap-select.min.css"></script>  -->
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/> 
<section class="about_us_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub_banner_hdg">
                        <h3>Events</h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

 <!--  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap-select.min.js"></script>
  -->
 
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<section class="notice_board_bg">
<div class="container">

     
<div class="row">
<div class="col-md-3">
 <!--  <div class="row-fluid search_event">
     <select class="selectpicker" data-show-subtext="true" data-live-search="true"  multiple data-max-options="2">
       <option data-subtext="Rep California">Tom Foolery</option>
       <option data-subtext="Sen California">Bill Gordon</option>
       <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
       <option data-subtext="Rep Alabama">Mario Flores</option>
       <option data-subtext="Rep Alaska">Don Young</option>
       <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
     </select>
     </div>
 
     <div class="row-fluid ">
      
     <select class="selectpicker"  data-live-search="true" >
       <option >2018</option>
       <option>2019</option>
       <option >2020</option>
       
     </select>
     </div> -->
</div>
<div class="col-md-9">

<?php
        if ($bodycontent['EventsList']) {
          foreach ($bodycontent['EventsList'] as $value) { 
          $uplodedFolder='events_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
?>
<div class="event_box">
<h4><?php echo $value->title; ?></h4>
<!-- <span><i class="fa fa-clock-o"></i>10AM, 28 July 2018</span> --><hr class="style3">

<div class="col-md-6">
  <img src="<?php echo $download_link;?>" class="event_img" >
</div><div class="col-md-6"><br>
<h4>Date : <?php echo date("d M Y", strtotime($value->event_date));?>
  <br>Time: <?php echo $value->event_time; ?> 
</h4><br>
<h4>Venue: <?php echo $value->event_place; ?></h4><br>
<!-- <p >Organized: By AFS</p> --><br>

</div>
</div>


<?php
}
}else{
  echo "<h3>Upcomming Event Details Comming soon...</h3>";
}
?>

</div>
</div>
</div>
    </section>