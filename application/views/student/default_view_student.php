<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shshu bharati student zone</title>

       <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- data table css -->
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/dataTables.bootstrap.min.css" rel="stylesheet">  
    
    <!-- Custom CSS --
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS --
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/plugins/morris.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/plugins/metis-menu.css" rel="stylesheet">
    <!-- Custom Fonts --
    
    <!--slider
     <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/slider.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Style -->
    
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/metisMenu.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/morris.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/magic-check.css" rel="stylesheet">
    

    
    
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/style.css" rel="stylesheet">
    <!-- Bootstrap datepicker -->
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/bootstrap-timepicker.min.css" rel="stylesheet">
    <!-- Bootstrap datepicer end -->
    
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />-->
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/bootstrapselect.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets_student_pannel/css/jquery.bxslider.css" rel="stylesheet" />
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/jquery.js"></script>
    <!--for temporary  add file from folder-->
    <!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>-->

    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrap-confirmation.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/dataTbleBootstrap.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrapselect.min.js"></script>
    
     <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/metisMenu.min.js"></script>
     <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/raphael.min.js"></script>
     <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/morris.min.js"></script>
     <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/sb-admin-2.js"></script>
     <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/jquery.bxslider.js"></script>
         <!-- <script src="<?php echo base_url(); ?>application/assets_student_pannel/js/bootstrap-slider.js"></script>-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SHSHU BHARATI</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
               
               
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>logout/studentlogout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
       <?php 
        
        if(sizeof($leftmenu)>0)
        {
            
            foreach($leftmenu as $firstlevel)
            {
                if(sizeof($firstlevel['secondLevelMenu'])>0)
                { ?>
                    
                    <li class="treeview">
                      <a href="javascript:;">
                        <i class="fa fa-share"></i> <span><?php echo $firstlevel['FirstLevelMenuData']->std_menu_name; ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="nav nav-second-level">
                        
                        <?php 
                            foreach($firstlevel['secondLevelMenu'] as $second_lvl)
                            {
                                /* echo "<pre>";
                                    print_r($second_lvl);
                                echo "</pre>"; */
                                
                                if(sizeof($second_lvl['thirdLevelMenu'])>0){    
                        ?>
                        
                        <li class="treeview">
                          <a href="javascript:;"><i class="fa fa-long-arrow-right" style="padding-right:4%;"></i> <?php echo $second_lvl['secondLevelMenuData']->std_menu_name; ?>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                          <?php 
                            foreach($second_lvl['thirdLevelMenu'] as $third_lvl){ 
                                    
                            ?>
                          
                            <li><a href="<?php echo base_url().$third_lvl['thirdLevelMenuData']->std_menu_link; ?>"><i class="fa fa-circle-o" style="padding-right:4%;"></i> <?php echo $third_lvl['thirdLevelMenuData']->adm_menu_name; ?></a></li>
                            
                          
                            
                            <?php 
                            }
                            ?>
                            
                            
                          </ul>
                        </li>
                        
                        
                        <?php 
                                }
                                else
                                {
                                    echo '<li><a href="'.base_url().$second_lvl['secondLevelMenuData']->std_menu_link.'"><i class="fa fa-circle-o" style="padding-right:4%;"></i>'.$second_lvl['secondLevelMenuData']->std_menu_name.'</a></li>';
                                }
                            }
                        ?>
                      </ul>
                    </li>
                        
            <?php
                        
                }
                else
                {
                    echo '<li><a href="'.base_url().$firstlevel['FirstLevelMenuData']->std_menu_link.'"><i class="fa fa-circle-o text-aqua"></i> <span>'.$firstlevel['FirstLevelMenuData']->std_menu_name.'</span></a></li>';
                }
                
            }
        }
        
        ?>
                        
                       

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
             <!--content  inserted here--->
         
         <?php if($bodyview)  : ?>  
    
                
        <?php $this->load->view($bodyview); ?>
 
 
         <?php
           endif; 
          ?>
           
          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  
    
 
   <script>
        $(document).ready(function(){
      $('.slider1').bxSlider({
            slideWidth: 1000,
            minSlides: 1,
            maxSlides: 1,
            slideMargin: 10
      });
      
      $('.fatPerTransformation item:first').addClass('active');
});

        $('.dataTables').DataTable();
    </script>

</body>

</html>
