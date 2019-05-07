

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
   	#margin-top: 1cm;
    font-family:Apple Chancery, cursive;
    font-style: italic;
   }
   .sign_contant{
   	margin-top:.5cm;
   	#border: 1px solid green;
   	height: 2.5cm;

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
    font-size:14px;
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
          
          
           
       <br><br><hr><br>
		
       <b style="font-family:Apple Chancery, cursive;font-size:40px;text-align: center;color:#663300;">Leaving Certificate</b>
        </center>
		<div class="main_contant" >
      <div id="waterMark" style="position:absolute;margin-left:6cm;margin-top: 2.5cm;opacity: 0.2;">
<img src="<?php echo base_url();?>application/web_assets/images/logo.png" width=180 height=180 border=0>
</div>
<?php  
if($needpicture=="Y"){?>
   <div class="row" style="border: 1px solid red">
    
    <div class="col-md-2" style="margin-left: 13.5cm;"> 

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


       <span style=";color:#663300;">
         	
                 <table style="width: 100%;"  >
                      <tr>
                            <td >1. Name Of The Student :  <input type="text" class="inputdata" value="<?php echo $studentname;?>" style="width: 410px;">
                            </td>
                      </tr>
                       <tr>
                           <td> 2. Fathers's Name : <input type="text" class="inputdata" value="<?php echo $fathername;?>" style="width: 455px;">
                           </td>
                      </tr>
                      <tr>
                          <td> 3. Mother's Name :  <input type="text" class="inputdata" style="width: 457px;" value="<?php echo $mothetname;?>" >
                          </td>
                      </tr>
                      <tr>
                        <td>4. Address: Village: <input type="text" class="inputdata" style="width: 220px;" value="<?php echo $village;?>" >
                         &nbsp;P.S : <input type="text" class="inputdata" style="width: 187px;" value="<?php echo $police_station;?>" >
                        </td>
                        </tr>
                       <tr>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;Dist :
                          <input type="text" class="inputdata"  style="width: 230px;" value="<?php echo $districname;?>" >
                          &nbsp;&nbsp;State:&nbsp;
                          <input type="text" class="inputdata" style="width: 237px;" value="<?php echo $statename;?>" >
                        </td>
                      </tr>
                      <tr>
                         <td>5. Nationality:
                          <input type="text" class="inputdata" style="width: 180px;" value="<?php echo $nationality;?>" >
                          &nbsp;&nbsp;6. Category:
                          <input type="text" class="inputdata" style="width: 204px;" value="<?php echo $category;?>" >
                        </td>
                      </tr>

                      <tr>
                        <td >7. Date of admission in the school:
                          <input type="text" class="inputdata"  style="width: 105px;" value="<?php echo $admission_dt;?>" >
                          &nbsp; &nbsp;in class <input type="text" class="inputdata"  style="width: 159px;" value="<?php echo $admission_class;?>" >
                        </td>
                      </tr>
                      <tr>
                        <td >8. Date of birth according to Admission Register:
                          <input type="text" class="inputdata"  style="width: 230px;" value="<?php echo $date_of_birth;?>" >
                         
                        </td>
                      </tr>

                       <tr>
                        <td >9. Class in which the student studies last:
                          <input type="text" class="inputdata"  style="width: 289px;" value="<?php echo $current_class;?>" >
                         
                        </td>
                      </tr>
                      <tr>
                        <td >10. School/Board/Annual Examination last taken with the result <input type="text" class="inputdata" style="width: 120px;">
                          &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="inputdata"  style="width: 575px;" value="<?php echo $last_exam;?>" ></td>
                      </tr>

                       <tr>
                        <td >11. Subjects studies:
                          <input type="text" class="inputdata" style="width: 440px;" value="<?php echo $subjects;?>" >
                         
                        </td>
                      </tr>

                         <tr>
                        <td >12. Wheather qualified for promotion to higher class
                          <input type="text" class="inputdata" style="width: 199px;" value="<?php echo $ispromote;?>" > <br>
                          &nbsp; &nbsp; &nbsp;if,so ,to which class: <input type="text" class="inputdata"  style="width: 417px;" value="<?php echo $promotion;?>" >
                         
                        </td>
                      </tr>
                       <tr>
                        <td >13. Month up to which the school due paid
                          <input type="text" class="inputdata" style="width:280px;" value="<?php echo $lastpaid;?>" >
                         
                        </td>
                      </tr>

                        <tr>
                        <td >14. Games played /Extra curricular activities in which the student took part<br> 
                          &nbsp;&nbsp;&nbsp;&nbsp;(Mention achievment level there in):
                          <input type="text" class="inputdata"  style="width:305px;" value="<?php echo $games;?>" > 
                         
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">15. General conduct:
                          <input type="text" class="inputdata" style="width:441px;" value="<?php echo $gencon;?>"" > 
                         
                        </td>
                      </tr>


                        <tr>
                        <td >16. Date of application for certificate:
                          <input type="text" class="inputdata"  style="width:305px;" value="<?php echo $dtaplcertificate;?>" > 
                         
                        </td>
                      </tr>
                       <tr>
                        <td >17.Date of issue of certificate:
                          <input type="text" class="inputdata"  style="width:360px;" value="<?php echo $issuedate;?>" >
                         
                        </td>
                      </tr>

                       <tr>
                        <td >18.Reason for leaving school: 
                          <input type="text" class="inputdata" style="width:382px;" value="<?php echo $leavingreason;?>" >
                         
                        </td>
                      </tr>

                          <tr>
                        <td >19.Marks Of identification
                          <input type="text" class="inputdata"  style="width:400px;" value="<?php echo $identification;?>" >
                         
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">20.Any other remarks
                          <input type="text" class="inputdata" style="width:430px;" value="<?php echo $otherremarks;?>" >
                         
                        </td>
                      </tr>







                    </table>
       	
       </span>

		</div>
		

 

  	  </div>
      <div class="sign_contant" style="padding:70px 0 2px 0;" >
       <div style=";height: 50px"><?php if($needsign=='Y'){?>
          <img class="sign" src="<?php echo base_url();?>application/assets/images/asim_sign.png" alt="sign"> <?php }?>
       </div>
        <div style="width: 44%;float: left;margin-top: 0cm;margin-left: 20px;">
          Date : &nbsp;<?php if($needsign=='Y'){echo $printdate;}?>
        </div>
        <div style="width:48%;float: left;margin-top: 0cm;text-align: right; ">
         
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


