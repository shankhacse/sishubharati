<script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 

  <!-- <script src="<?php echo base_url();?>application/web_assets/js/bootstrap-select.min.css"></script>  -->
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/> 
<section class="about_us_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub_banner_hdg">
                        <h3>Notice And Update</h3>
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
<!-- <div class="row">
     <div class="row-fluid col-md-3">
      <select class="selectpicker" data-show-subtext="true" data-live-search="true"  multiple data-max-options="2">
        <option data-subtext="Rep California">Tom Foolery</option>
        <option data-subtext="Sen California">Bill Gordon</option>
        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
        <option data-subtext="Rep Alabama">Mario Flores</option>
        <option data-subtext="Rep Alaska">Don Young</option>
        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
      </select>
      </div>
     

     <div class="row-fluid col-md-3">
       
      <select class="selectpicker"  data-live-search="true" >
        <option >2018</option>
        <option>2019</option>
        <option >2020</option>
        
      </select>
      </div><div class="row-fluid col-md-3">
       
      <select class="selectpicker"  data-live-search="true" >
        <option >January</option>
        <option>February</option>
        <option >March</option>
        
      </select>
      </div>

      <div class="col-md-3" id='search-box'>
<form action='#' id='search-form' method='get' target='_top'>
<input id='search-text' name='q' placeholder='Search Box' type='text'/>
<button id='search-button' type='submit'><span>Search</span></button>
</form>
</div>

 </div> -->



     <div class="row">
<?php 
if ($bodycontent['NoticeList']) {
  
foreach ($bodycontent['NoticeList'] as  $value) {
 
  $uplodedFolder='notice_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
?>
<div class="notice_box">
<h4 style="text-transform:capitalize;"><?php echo $value->title; ?> (<?php echo $value->academic_year; ?>)</h4>
<span>Publish Date : <?php echo date("d M Y", strtotime($value->publish_dt));?></span>   
 <!-- <span class="type_news"><i class="fa fa-shield"></i> Result</span> -->
 <hr class="style3">

<a href="<?php echo $download_link; ?>" download>
               <button type="button" class="btn btn-sm btn-outline-primary">
                <span class="glyphicon glyphicon-download"></span> Download</button></a>
<!-- <button type="button" class="btn btn-outline-primary">
    <i class="fa fa-file"></i> Download
</button> -->
</div> 

<?php }
}else{
  echo '<h3>Notice and update not available right now.   </h3>';
}

?>

</div>
</div>
    </section>