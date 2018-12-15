 <html>
    <head>
        <title>Bill Receipt</title>
          <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  
   <script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
        <style>
 @media print {    
body {
  -webkit-print-color-adjust: exact !important;
}
}
      div.page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
       
        }

      div.page[size="A4"] {  
        width: 21cm;
        height: 29.7cm;
      } 
        body{
        width: 21cm;
        height: 29.7cm;
       
        /* change the margins as you want them to be. */
   } 
            .demo {
                border:1px solid #C0C0C0;
                border-collapse:collapse;
                padding:5px;
            }
            .demo th {
                border:1px solid #C0C0C0;
                padding:4px;
                background:#F0F0F0;
                font-family:Verdana, Geneva, sans-serif;
                font-size:10pt !important;
                font-weight:bold;
            }
            .demo td {
                border:1px solid #C0C0C0;
                padding:4px;
                font-family:Verdana, Geneva, sans-serif;
                font-size:10pt !important;    

            }
            .break{
                page-break-after: always;
            }
      .th_formt{
        font-size:10px;
      }
      .outer{
        padding:30px;
        border:2px solid gray;
        width: 800px;
        color:blue;

      }
        .break{
                page-break-after: always;
            }
        </style>
      
    </head>
    <body>


 <div class="outer page"  data-size="A4" id="printableArea" >
  <center>
    <img src="<?php echo base_url();?>application/web_assets/images/logo.png" width="50" height="50" class="logo_pic" alt=""><br>
            <b style="font-size: 20px;">Pandaveswar Sishu Bharati Vidya Mandir</b><br>
          Address:-Vill+P.O:-Pandaveswar,Burdwan(W.B),Pin -713346<br>
          Estd:2nd April 2004<br>
          VIDE MEMO NO:-237-SE(EE)RTE-92/2016
            
       </center><hr>
        <div style="padding:10px 0 5px 0;"></div>
        <table width="100%" class="demo table table-bordered table-striped">
             <thead>
                <tr><th width="25%"></th>
                <th width="25%"></th>
                <th style="font-weight: bold;" width="25%"></th>
                <th width="25%"></th>
                
              </tr></thead>
                <tbody>
                    <tr><td>Student Name</td><td><?php echo $studentInfo->student_name;?></td>
                      <td>Student ID</td><td><?php echo $studentInfo->student_uniq_id;?></td> </tr>
                    <tr><td>Class</td><td><?php echo $studentInfo->class_name;?></td> 
                      <td>Roll</td><td><?php echo $studentInfo->class_roll;?></td></tr>
                  <tr><td>Payment Date</td><td><?php echo date('d-M-Y', strtotime($paymentdate));?></td><td>Bill No</td><td><?php echo $billno;?></td></tr>
                     </tbody>
        </table>
<div style="padding:2px 0 20px 0;"><center>
  <button type="button" class="btn-xs bg-green margin"><h4 class="modal-title" id="title_info"><?php
  if ($payment_for=='ADM') {
   echo "Admission ";
  }elseif ($payment_for=='SES') {
    echo "Session ";
  }elseif ($payment_for=='MON') {
    echo "Monthly ";
  }

  ?>Fees Details</h4></button></center>
</div>
     <table class="table table-bordered demo" style="font-family:Verdana, Geneva, sans-serif;">
              <thead>
                <th width="5%">SL</th>
                <th width="75%">Particulars with Naration</th>
                <th width="20%"  >Amount Rs.</th>
              </thead>
                <tbody>
                    <?php
                          $totalamount=0;
                          $sl=1;
                          foreach ($billDetails as $value) {

                          $totalamount=$totalamount+$value->amount;

                          
                        
                     ?>
                    <tr>
                      <td><?php echo $sl++;?></td>
                      <td><?php echo $value->payment_desc;?></td>
                      <td style="text-align:right;"><?php 
                      if ($payment_for=='MON') {
                            echo $value->amount-$fine_amount;
                          }else{
                      echo $value->amount;
                    }
                      ?></td> 
                    </tr>
                    <?php if($fine_amount>0){?>
                    <tr>
                      <td><?php echo $sl++;?></td>
                      <td><?php echo "Fine";?></td>
                      <td style="text-align:right;"><?php echo $fine_amount;?></td>
                    </tr><?php }?>
                    
                    <?php 
                      }

                    ?>
                 <tr style="background-color: #e2e2e2;font-weight: bold;">
                   <td></td><td>Total Amount</td><td style="text-align:right;"><?php echo number_format($totalamount,2);?></td>
                 </tr>
                </tbody>
              </table>


            <div style="padding:35px 0 20px 0;">
              <table width="100%">
              <tr>
                <td width="10%" style="font-weight: bold;">Rupees:-</td>
                <td width="70%" style="text-decoration: underline;">
                  <?php
                    echo $this->payment_method_call_view->no_to_words($totalamount)." only";
                  ?>
                </td>
                
                <td width="20%" >Signature </td>
              </tr>
              </table>
        

           

</div>
</div>



</body>
</html>


