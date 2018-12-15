

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
   	margin-top:.5cm;
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
		
       <b style="font-family:Apple Chancery, cursive;font-size:40px;text-align: center;color:#663300;">Transfer Certificate</b>
        </center><br>
		<div class="main_contant" >
      <div id="waterMark" style="position:absolute;margin-left:6cm;margin-top: 2.5cm;opacity: 0.2;">
<img src="<?php echo base_url();?>application/web_assets/images/logo.png" width=180 height=180 border=0>
</div>
       <span style="font-size:20px;color:#663300;">
         	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         	This is certify that  
         	<input type="text" class="inputdata" value="<?php echo $studentname;?>" style="width: 396px;">
         	
         		
         	<?php echo $sondaughter;?> of (Mother's Name) 
          <?php if($sondaughter=='Son'){?>
         	<input type="text" class="inputdata" value="<?php echo $mothetname;?>" style="width: 396px;">
         <?php }else{?>
            <input type="text" class="inputdata" value="<?php echo $mothetname;?>" style="width: 337px;">
          <?php }?>
         	
         	(Fathers's Name)
         	<input type="text" class="inputdata" value="<?php echo $fathername;?>" style="width: 460px;">

         	Joined this school in class
         	<input type="text" class="inputdata" value="<?php echo $admclassname;?>" style="width: 180px;">
         	 
         	on 
         	<input type="text" class="inputdata" value="<?php echo $admissiondt;?>" style="width: 165px;">

         	According to the school Records, <?php echo $hisher;?> Date of Birth is 
			<input type="text" class="inputdata" value="<?php echo $dob;?>" style="width: 125px;">
         	

         	Nationality 
         	
         	<input type="text" class="inputdata" value="<?php echo $nationality;?>" style="width: 200px;">
         	State
			<input type="text" class="inputdata" value="<?php echo $state;?>" style="width: 254px;">
         	
         	District 
         	<input type="text" class="inputdata" value="<?php echo $district;?>" style="width: 220px;">
            Village 
          <input type="text" class="inputdata" value="<?php echo $village;?>" style="width: 254px;">
         	

         	Wheather the pupil belongs to
         	
			<input type="text" class="inputdata" value="<?php echo $caste;?>" style="width: 277px;">
         	 Caste.
			<br><br>

			<?php echo $heshe;?> was studying in class 
			
			<input type="text" class="inputdata" value="<?php echo $currentclass;?>" style="width: 277px;">

			 , the school session
			 <input type="text" class="inputdata" value="<?php echo $session;?>" style="width: 277px;">
			
			   bears a good moral character. <?php echo $hisherb;?> behaviour was good with teachers and students.
			   <br><br><br>

			   I wish all success and prosperity in <?php echo $hisher;?> life.
       	
       </span>

		</div>
		<div class="sign_contant" >
			
				<div style="width: 48%;float: left;margin-top: 1cm;">
					Date : 
				</div>
				<div style="width:48%;float: left;margin-top: 1cm;text-align: right;">
					Signature of the Headmaster/Headmistress
				</div>
			
			
		</div>

 

  	  </div>

	 
	</div>
	


	
		<!-- <div class="breakpage"></div> -->
              

</body>
  
</html>

 <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>


