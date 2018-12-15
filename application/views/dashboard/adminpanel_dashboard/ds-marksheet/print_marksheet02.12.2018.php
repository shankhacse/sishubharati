

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
        max-width: 29.7cm;
        max-height: 21cm;
       
        /* change the margins as you want them to be. */
   } 
   
  

  

   #outerdiv{
    background-color:#fff; 
    border:.5px solid #0d5360;
    margin:.5cm;
    width: 28.3cm;
    height: 19.5cm;
    color: #0d5360;
    float: left;


   }
    #studentinfo{
      width: 28cm;
      height: .5cm;
      #border: 1px solid green;
      color: #833e3e;
    }
    #upperdiv{
    background-color:#fff;
    color:#036;
    #border:2px solid #095098;
    margin:10px;
    margin-top:15px;
    width:27.5cm;
    height: 10cm;
    float: left;
    

   }
   #lowerdiv{
    background-color:#fff;
    color:#036;
    #border:2px solid #095098;
    margin:10px;
    margin-top:10px;
    width:27.5cm;
    height: 7cm;
    #float: left;
     }
     #term1{
    background-color:#fff;
    #border:2px solid green;
    width:9cm;
    height: 9cm;
    float: left;
    padding:1px;
    margin-top: 20px;
    }
     #term2{
    background-color:#fff;
    #border:2px solid red;
    width:9cm;
    height: 9cm;
    float: left;
    padding:1px;
    margin-top: 20px;
    }
    #term3{
    background-color:#fff;
    #border:2px solid blue;
    width:9cm;
    height: 9cm;
    float: left;
    margin-top: 20px;
    }

    #performance{
    background-color:#fff;
    #border:2px solid green;
    width:9cm;
    height: 7cm;
    float: left;
    padding:1px;
   
    }
    #sign{
    background-color:#fff;
    #border:2px solid red;
    width:9cm;
    height: 7cm;
    float: left;
    padding:1px;
    }
    #promotion{
    background-color:#fff;
    #border:2px solid blue;
    width:9cm;
    height: 7cm;
    float: left;
    }

   table, th, td {
   border:1px solid #0d5360;
  }
  table {
    border-collapse: collapse;
    margin-left:15px;
   }
   #stinfotab {
    #border:1px solid #fff;
    #text-align: center;
    margin-top: 10px;
    margin-left: 10px;
    font-size:18px;
   }
  @media print {
    pre, blockquote {page-break-inside: avoid;}
    } 
   @media print{@page {size: landscape}}
   @page { margin: 0;}
   p {
    line-height: 1.5;
  }
  .textal{
    text-align: center;
  }


   </style>

</head>

<body onload="window.print()">

        <div id="outerdiv">
		        <div id="studentinfo">
              <table width="100%" id="stinfotab" border="0" style="border: 3px solid #fff;">
                <tr >
                  <td width="30%" style="border: 3px solid #fff;">&nbsp;&nbsp;&nbsp;Name : <?php echo $studentInfo->student_name;?></td>
                  <td width="20%" style="border: 3px solid #fff;">&nbsp;Class : <?php echo $studentInfo->class_name;?></td> 
                  <td width="20%" style="border: 3px solid #fff;">Roll : <?php echo $studentInfo->class_roll;?></td>
                  <td width="20%" style="border: 3px solid #fff;">ID : <?php echo $studentInfo->student_uniq_id;?></td>
                </tr>
              </table>
            
            </div>

            <div id="upperdiv">

                  <div id="term1">

                        <div class="container">
            
                          <table  width="95%" >
                            <thead>
                              <tr> <th colspan="8" style="font-weight:bold;">First Term</th></tr>
                               <tr><th rowspan="2" width="30%" style="font-weight:normal;">Subject</th> 
                                   <th colspan="3" style="font-weight:normal;">F.M</th> 
                                
                                    <th colspan="4" style="font-weight:normal;">Marks Obtained</th>
                               </tr>
                               <tr>
                                <td width="8%" class="textal">W</td>
                                <td width="8%" class="textal">O</td>
                                <td width="14%" class="textal">T</td>
                                 <td width="10%">Written</td>
                                 <td width="10%">Oral</td>
                                 <td width="10%">Total</td>
                                 <td width="10%">Grade</td>
                               </tr>
                            </thead>
                            <tbody>
                               <?php
                               if ($first_term_marks) {
                              
                              foreach ($first_term_marks as $first_term_marks) {

                              ?>
                              <tr>
                                <td><?php echo $first_term_marks->subject;?></td>
                                <td><?php echo $first_term_marks->full_written_marks;?></td>
                                <td><?php 
                                        if ($first_term_marks->full_oral_marks!='0') {
                                           echo $first_term_marks->full_oral_marks;
                                        }
                               
                                ?></td>
                                <td><?php echo $first_term_marks->full_marks;?></td>
                                <td class="textal"><?php echo $first_term_marks->obtain_written_marks;?></td>
                                <td class="textal"><?php 
                                if ($first_term_marks->obtain_oral_marks!='0') {
                                  echo $first_term_marks->obtain_oral_marks;
                                }
                                
                                ?></td>
                                <td class="textal"><?php echo $first_term_marks->obtain_total_marks;?></td>
                                <td>&nbsp;&nbsp;<?php echo $first_term_marks->grade;?></td> 
                                
                              </tr>
                              <?php } }?>
                             
                           <tr style="font-weight: bold">
                             <td colspan="4">Grand Total</td>
                             <td colspan="4" style="text-align: center;">
                               <?php echo $academicData->first_term_total;?>
                             </td>
                           </tr>   
                            </tbody>
                          </table>
                        </div>
                    
                  </div>
                  <div id="term2">
                        <div class="container">
<div id="waterMark" style="position:absolute;margin-left:2.4cm;margin-top: 5.6cm;opacity: 0.2;">
<img src="<?php echo base_url();?>application/web_assets/images/logo.png" width=180 height=180 border=0>
</div>
                          
            
                          <table  width="95%" >
                            <thead>
                              <tr> <th colspan="8" style="font-weight:bold;">Second Term</th></tr>
                               <tr><th rowspan="2" width="30%" style="font-weight:normal;">Subject</th> 
                                   <th colspan="3" style="font-weight:normal;">F.M</th> 
                                
                                    <th colspan="4" style="font-weight:normal;">Marks Obtained</th>
                               </tr>
                               <tr>
                                <td width="8%" class="textal">W</td>
                                <td width="8%" class="textal">O</td>
                                <td width="14%" class="textal">T</td>
                                 <td width="10%">Written</td>
                                 <td width="10%">Oral</td>
                                 <td width="10%">Total</td>
                                 <td width="10%">Grade</td>
                               </tr>
                            </thead>
                            <tbody>
                               <?php
                               if ($second_term_marks) {
                              
                              foreach ($second_term_marks as $second_term_marks) {

                              ?>
                              <tr>
                                 <td><?php echo $second_term_marks->subject;?></td>
                                  <td><?php echo $second_term_marks->full_written_marks;?></td>
                                  <td><?php 
                                  if ($second_term_marks->full_oral_marks!='0') {
                                     echo $second_term_marks->full_oral_marks;
                                  }
                                 
                                  ?></td>
                                  <td><?php echo $second_term_marks->full_marks;?></td>
                                  
                                  <td class="textal"><?php echo $second_term_marks->obtain_written_marks;?></td>
                                  <td class="textal"><?php 
                                  if ($second_term_marks->obtain_oral_marks!='0') {
                                     echo $second_term_marks->obtain_oral_marks;
                                  }
                                 
                                  ?></td>
                                  <td class="textal"><?php echo $second_term_marks->obtain_total_marks;?></td>
                                  <td >&nbsp;&nbsp;<?php echo $second_term_marks->grade;?></td>
                              </tr>
                            <?php } }?>
                              
                              <tr style="font-weight: bold">
                             <td colspan="4">Grand Total</td>
                             <td colspan="4" style="text-align: center;">
                               <?php echo $academicData->second_term_total;?>
                             </td>
                           </tr> 
                            </tbody>
                          </table>
                        </div>
                  </div>
                  <div id="term3">
                        <div class="container">
            
                          <table  width="95%" >
                            <thead>
                              <tr> <th colspan="8" style="font-weight:bold;">Third Term</th></tr>
                               <tr><th rowspan="2" width="30%" style="font-weight:normal;">Subject</th> 
                                   <th colspan="3" style="font-weight:normal;">F.M</th> 
                                
                                    <th colspan="4" style="font-weight:normal;">Marks Obtained</th>
                               </tr>
                               <tr>
                                <td width="8%" class="textal">W</td>
                                <td width="8%" class="textal">O</td>
                                <td width="14%" class="textal">T</td>
                                 <td width="10%">Written</td>
                                 <td width="10%">Oral</td>
                                 <td width="10%">Total</td>
                                 <td width="10%">Grade</td>
                               </tr>
                            </thead>
                            <tbody>
                               <?php
                               if ($third_term_marks) {
                              
                              foreach ($third_term_marks as $third_term_marks) {

                              ?>
                              <tr>
                                 <td><?php echo $third_term_marks->subject;?></td>
                                <td><?php echo $third_term_marks->full_written_marks;?></td>
                                <td><?php 
                                if ($third_term_marks->full_oral_marks!='0') {
                                   echo $third_term_marks->full_oral_marks;
                                }
                                ?></td> 
                                <td><?php echo $third_term_marks->full_marks;?></td>
                                <td class="textal"><?php echo $third_term_marks->obtain_written_marks;?></td>
                                <td class="textal"><?php 
                                      if ($third_term_marks->obtain_oral_marks!='0') {
                                         echo $third_term_marks->obtain_oral_marks;
                                      }
                               
                                ?></td>
                                <td class="textal"><?php echo $third_term_marks->obtain_total_marks;?></td>
                                <td>&nbsp;&nbsp;<?php echo $third_term_marks->grade;?></td>
                              </tr>
                              <?php } }?>
                               <tr style="font-weight: bold">
                             <td colspan="4">Grand Total</td>
                             <td colspan="4" style="text-align: center;">
                               <?php echo $academicData->third_term_total;?>
                             </td>
                           </tr>
                            </tbody>
                          </table>
                        </div>
                  </div>
		        
		  	    </div>


		  	    <div id="lowerdiv">
              <div id="performance">
                      
            <div class="container">
                          <table  width="75%" style="text-align: center;" >
                            <thead>
                              <tr> <th colspan="5" style="font-weight:bold;">Performance </th></tr>
                               <tr > 
                                <th style="font-weight:normal;">Term</th>
                                <th style="font-weight:normal;">Attendance</th>
                                <th style="font-weight:normal;">Sporting</th>
                                <th style="font-weight:normal;">Discipline</th>
                                
                                <th style="font-weight:normal;">Cultural<br>Efficiency</th>
                               </tr>
                            </thead>
                            <tbody>
                              <tr style="height:1.5cm;">
                                <td>First</td>
                                <td><?php echo $attendanceT1;?></td>
                                <td><?php echo $sportingT1;?></td>
                                <td><?php echo $disciplineT1;?></td>
                                <td><?php echo $cultural_efficiencyT1;?></td>
                               </tr>
                                <tr style="height:1.5cm;">
                                <td>Second</td>
                                <td><?php echo $attendanceT2;?></td>
                                <td><?php echo $sportingT2;?></td>
                                <td><?php echo $disciplineT2;?></td>
                                <td><?php echo $cultural_efficiencyT2;?></td>
                               </tr>
                               <tr style="height:1.5cm;">
                                <td>Third</td>
                                <td><?php echo $attendanceT3;?></td>
                                <td><?php echo $sportingT3;?></td>
                                <td><?php echo $disciplineT3;?></td>
                                <td><?php echo $cultural_efficiencyT3;?></td>
                               </tr>
                             <tr style="height:1.4cm;">
                                <td colspan="5"></td>
                               </tr>
                              
                            </tbody>
                          </table> 
                    
      </div>
            </div>
              </div>

              <div id="sign">
                  <div class="container">
                          <table  width="95%" >
                            <thead>
                             
                               <tr > 
                                <th style="font-weight:normal;">Sign of H/M</th>
                                <th style="font-weight:normal;">Sign of Parents</th>
                               
                               </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="textal" style="font-weight: bold;">3<sup>rd</sup> Term</td>
                                <td class="textal" style="font-weight: bold;">3<sup>rd</sup> Term</td>
                                
                               </tr>
                                <tr style="height:2cm;">
                                <td></td>
                                <td></td>
                                
                               </tr>
                               <tr style="height:1.5cm;">
                                <td colspan="2" style="border-bottom: 0px;">
                                  
                                </td>
                               </tr>

                               <tr style="height:1.5cm;">
                                <td colspan="2" style="text-align: center;border-top: 0px;">
                                  <hr width="50%">
                                  <span style="border-top:1px;">Sign of Director</span>
                                </td>
                               </tr>
                               <tr style="height:1.3cm;">
                                <td colspan="2"></td>
                               </tr>

                               
                             
                              
                            </tbody>
                          </table> 
                    
      </div>

              </div>

              <div id="promotion">

                   <div class="container">
                          <table  width="95%" style="text-align: center;" >
                            <thead>
                             
                               <tr > 
                                <th style="font-weight:normal;">Name of 1<sup>st</sup> Boy / Girl</th>
                                <th style="font-weight:normal;">Remarks of Class<br>Teacher & Sign</th>
                               
                               </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="textal" rowspan="2" style=""><?php echo $topper_name;?></td>
                                <td class="textal" style="font-weight: bold;">1<sup>st</sup> Term</td>
                                
                               </tr>

                                <tr style="height:1cm;">
                                
                                <td></td>
                                
                               </tr>

                               <tr style="height:.5cm;">
                                <td style="font-weight: bold;border-bottom: 0px;">Final Score</td>
                                <td style="font-weight: bold;">2<sup>nd</sup> Term</td>
                               </tr>
                              
                               <tr style="height:1cm;">
                                <td style="border-top: 0px;"><?php echo $grand_total;?></td>
                                <td></td>
                               </tr>

                                <tr style="height:.5cm;">
                                <td style="font-weight: bold;border-bottom: 0px;">Rank</td>
                                <td style="font-weight: bold;">3<sup>rd</sup> Term</td>
                               </tr>
                               
                               <tr style="height:1cm;">
                                <td style="border-top: 0px;"><?php echo $rank;?></td>
                                <td></td>
                               
                               </tr>

                                <tr style="height:.5cm;">
                                <td style="font-weight: bold;border-bottom: 0px;">Promoted to Class</td>
                                <td style="border-bottom: 0px;"></td>
                               </tr>
                               
                               <tr style="height:1cm;">
                                <td style="border-top: 0px;"></td>
                                <td  style="border-top: 0px;"></td>
                               
                               </tr>



                              
                               

                               
                             
                              
                            </tbody>
                          </table> 
                    
      </div>
                
              </div>

			
		  	    </div>

	 
		</div>
	
</body>
  
</html>


