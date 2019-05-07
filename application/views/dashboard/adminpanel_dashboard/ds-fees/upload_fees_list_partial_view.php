 <div class="datatalberes" style="overflow-x:auto;">
                <center>
                <button type="button" class=" bg-purple btn-flat margin" style="text-transform: capitalize ;"> <?php echo $term.' Term ';?></button>   
                </center> 
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Class</th>
                  <th>Amount</th>
                 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $sl = 1;
                  foreach ($uploadFeesData as $value) { 
           
                  ?>
          
          <tr>
            
            <td><?php echo $sl++; ?></td>
            <td><?php echo $value->classname; ?></td>
            <td><?php echo $value->amount; ?></td>
           
                       <td>
             <button type="button" class="btn btn-sm btn-danger edituploadfeeamt" 
             data-toggle="modal" 
             data-target="#uplfeeeditModal" 
             data-detailsid="<?php echo $value->id;?>"
             data-classname="<?php echo $value->classname;?>"
             data-term="<?php echo $term;?>"
             data-mode ="EDITAMT" 
             data-amount="<?php echo $value->amount; ?>"
             
               ><i class="glyphicon glyphicon-edit"></i></button> 
           </td>
          </tr>
                    
                <?php
                  }

                ?>

                </tbody>
               
              </table>

              </div>