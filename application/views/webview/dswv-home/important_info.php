<script src="<?php echo base_url();?>application/web_assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>application/web_assets/js/bootstrap.min.js"></script> 
<section class="about_us_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="sub_banner_hdg">
                        <h3>Important Informations</h3>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <section>

        <div class="container">

  <?php
            if ($bodycontent['infoList']) {
                foreach ($bodycontent['infoList'] as $value) { 

        $uplodedFolder='importantinfo_upload';
        $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$value->random_file_name;
        
  ?>   
 <div class="row importent_box">



<div class="col-md-6 col-sm-6 info_box">
<h4><?php echo $value->title; ?>


<a href="<?php echo $download_link; ?>" download>
<button type="button" class="btn btn-outline-primary">
    <i class="fa fa-file"></i> Download Attachment
</button></a></h4>
</div>


</div> 
 <?php
}
}else{
  ?> 
 <div class="row importent_box">
<div class="col-md-6 col-sm-6 info_box">
 <h5>No record found.</h5>
</div>
</div>


   <?php
}
  ?> 
<!-- <div class="row importent_box">
<h3>NOTICE</h3>


<div class="col-md-6 col-sm-6 info_box">
<h4>Notice For class V</h4>



<button type="button" class="btn btn-outline-primary">
    <i class="fa fa-file"></i> Download Attachment
</button>
</div>


</div> -->

<!-- <div class="row importent_box">
<h3>Rules & Regulation </h3>


<div class="col-md-6 col-sm-6 info_box">
<h4> Basic rules & regulation </h4>



<button type="button" class="btn btn-outline-primary">
    <i class="fa fa-file"></i> Download Attachment
</button>
</div>


</div> -->


</div>
</section>