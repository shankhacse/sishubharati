    
    <button type="button" class=" bg-purple btn-flat margin"><?php echo $classname;?></button>
   
    <div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                  
                <tr>
               
                  <th style="width:5%;">Sl</th>
                  <th style="width:10%;">Class</th>
                  <th style="width:10%;">Student ID</th>
                  
                  <th style="width:20%;">Name</th>
                  <th style="width:5%;">Roll</th>
                  <th style="width:10%;">First Term Total</th>
                  <th style="width:10%;">Second Term Total</th>
                  <th style="width:10%;">Third Term Total</th>
                  
                 
                  
                </tr>
                </thead>
                <tbody>
              
                 <input type="hidden" name="classsubID" id="classsubID" value="0" />
              
                  <input type="hidden" name="mode" id="mode" value="ADD" />
              
                <?php 
                  $i = 1;
                 
                  foreach ($studentList as $key => $value) {

                    

                  
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $classname;?></td>
            <td><?php echo $value->student_uniq_id; ?></td>
            <td><?php echo $value->student_name; ?></td>
            
            <td><?php echo $value->class_roll; ?></td>
            <td><?php echo $value->first_term_total; ?></td>
            <td><?php echo $value->second_term_total; ?></td>
            <td><?php echo $value->third_term_total; ?></td>
        

            
             
            
            
            
           
           
         
          </tr>
                    
                <?php } ?>
             
                </tbody>
               
              </table>
            </div>

             
               
              </div>

              



          