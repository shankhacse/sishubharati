

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	
	<link rel="stylesheet" type="text/css" href="" />	

	<!--[if lt IE 7]>
		<style type="text/css">
			#wrapper { height:100%; }
		</style>
	<![endif]-->
	
	<style>

	html,body{
        max-width: 21cm;
        max-height: 29cm;
       
        /* change the margins as you want them to be. */
   } 
   .main_contant{

   	padding: 20px;
   	#border: 1px solid red;
   	height: 13.7cm;
   	margin-top: 1cm;
    font-family:Apple Chancery, cursive;
    font-style: italic;
   }
   .sign_contant{
   	#margin-top:.5cm;
   	#border: 1px solid green;
   	height: 2cm;

   }

   .infodata{
   	font-weight: bold;
   	text-transform: capitalize;
    font-style: italic;
    font-family:Apple Chancery, cursive;

   }

   .inputdata{
   	border: 0px;
    border-bottom: 1px dotted #663300;
    #font-weight: bold;
    font-size:20px;
    color:#663300;
    text-transform: capitalize;
    text-align: center;
    font-style: italic;
    font-family:Apple Chancery, cursive;

   }

     .sign {
    position: relative;
    width: 85px;
    float: right;
    height: 30px;
    margin-right: 140px;
    #border:1px solid gray;
    margin-top: 18px;
    }

   .breakpage { 
  page-break-after: always; 
}
 #@media print{@page {size: portrait}}
   @page { margin: 0;}

	 </style>
   
   




	
	
</head>





<body>

 		 

<div style=" padding:20px; margin:30px; margin-top:10px;background-color:#fff; border:2px solid #036;margin-top:1cm;height: 26.7cm;">

   
   
        <div style=" margin-left:0px; margin-top:2px; background-color:#fff;color:#036;">
		<center>
    <img src="<?php echo base_url();?>application/web_assets/images/logo.png" width="50" height="50" class="logo_pic" alt=""><br>
            <b style="font-size: 24px;">Pandaveswar Sishu Bharati Vidya Mandir</b><br>
             <b style="font-size: 16px;"> Affiliated by West Bengal Board of Secondary Education</b><br>
             (VIDE MEMO NO:-237-SE(EE)RTE-92/2016)<br>
          Pandaveswar::Paschim Bardhaman(W.B)::Estd:2nd April 2004<br>
          
          
           
       <br><br><hr><br><br>
		
       <b style="font-family:Apple Chancery, cursive;font-size:40px;text-align: center;color:#663300;">Character certificate</b>
        </center>
		<div class="main_contant" >
      <div id="waterMark" style="position:absolute;margin-left:6cm;margin-top: 2.5cm;opacity: 0.2;">
<img src="<?php echo base_url();?>application/web_assets/images/logo.png" width=180 height=180 border=0>
</div>
<?php  
if($needpicture=="Y"){?>
   <div class="row">
    
    <div class="col-md-2" style="margin-left: 12cm;"> 

                    <?php


                       $uplodedFolder='admission_upload';
        if ($studentdata->is_file_uploaded=='Y') {
           $download_link=base_url()."application/assets/ds-documents/".$uplodedFolder."/".$studentdata->random_file_name;
        }else{
          if ($studentdata->gender=="M") {
                   $download_link=base_url()."application/assets/images/male_avatar.jpg";
                 }elseif ($studentdata->gender=="F") {
                    $download_link=base_url()."application/assets/images/female_blank_avatar.jpg";
                 } 

          
        }


                    ?>
                    <div class="student_picture" style="width: 135px;height:161px;border: 2px solid #036;">
                             <!--  <img id="profile_img" src="/sishubharati/application/assets/images/blank-avatar.jpg" alt="Profile Picture" style="width:140px;height:160px;"> -->
                               <img src="<?php echo $download_link; ?>" class="profile_pic" style="width: 35.5mm;height: 42.5mm;" />

                              <input id="derault_profile_src" name="derault_profile_src" value="/sishubharati/application/assets/images/blank-avatar.jpg" type="hidden">
                              
                            </div>
                                
                    </div>
     
   </div>
<?php }?>

<br>
       <span style="font-size:20px;color:#663300;">
         	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         	This is to certify that  
         	<input type="text" class="inputdata" value="<?php echo $studentname;?>" style="width: 369px;">
         	
         		
         	<?php echo $sondaughter;?> of (Mother's Name) 
          <?php if($sondaughter=='Son'){?>
         	<input type="text" class="inputdata" value="<?php echo $mothetname;?>" style="width: 396px;">
         <?php }else{?>
            <input type="text" class="inputdata" value="<?php echo $mothetname;?>" style="width: 337px;">
          <?php }?>
         	
         	(Fathers's Name)
         	<input type="text" class="inputdata" value="<?php echo $fathername;?>" style="width: 460px;">

         	 has been bonafied student of Pandaveswar Sishu Bharati Vidya Mandir for last
         	<input type="text" class="inputdata" value="<?php echo $years;?>" style="width: 180px;">
         	 
         	years.  <br>
          <?php echo $heshe;?> was very obedient , sincere and hardworking. 
         	

         	According to the school Records, <?php echo $hisher;?> Date of Birth is 
			<input type="text" class="inputdata" value="<?php echo $dob;?>" style="width: 125px;">.
         	

			   <?php echo $heshe;?> bears a good moral character. <?php echo $hisherb;?> behaviour was good with teachers and students.
			   <br><br><br>

			   I wish all success and prosperity in <?php echo $hisher;?> life.
       	
       </span>

		</div>


 

  	  </div>

             <div class="sign_contant" >
       <div style=";height: 50px;"><?php if($needsign=='Y'){?>
          <img class="sign" src="<?php echo base_url();?>application/assets/images/asim_sign.png" alt="sign"> <?php }?>
       </div>
        <div style="width: 45%;float: left;margin-left: 10px;">
          Date : &nbsp;<?php if($needsign=='Y'){echo $printdate;}?>
        </div>
        <div style="width:48%;float: left;text-align: right;">
          Signature of the Headmaster/Headmistress
        </div>
      
      
    </div>

	 
	</div>
	


	
		<!-- <div class="breakpage"></div> -->
              

</body>
  
</html>

 <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>


