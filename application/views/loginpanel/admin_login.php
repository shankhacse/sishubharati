<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sishubharati | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/plugins/iCheck/square/blue.css">
  <!-- Admin Custom Style -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    
 
  </style>
</head>
<body class="hold-transition login-page bimg">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:;"><b><span style="color: #1394c8;">Sishubharati</span></b> ADMIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

   <!-- <form action="<?php echo base_url()?>administratorpanel/verifyLogin" method="post"> -->
	<?php
	$attr = array("id"=>"admiLoginForm","name"=>"admiLoginForm");
	echo form_open('administratorpanel/verifyLogin',$attr); ?>
      <div class="form-group has-feedback">
        <input type="hidden" id="baseurl" value="<?php echo base_url(); ?>"/>
        <input type="text" class="form-control " placeholder="Username" name="username" id="username" autocomplete="off" required="true"/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control " placeholder="Password" name="password" id="password" autocomplete="false" required="true"/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
     
        <select class="form-control " name="year" id="year">
          <option value="0">Select year</option>
          <?php 
            foreach ($year as $value) {?>
            <option value="<?php echo $value->session_id;?>"><?php echo $value->year?></option>
            <?php }?>
        </select>
        <span class="glyphicon glyphicons glyphicons-chevron-down"></span>
      </div>
	  
	  <div class="row">
		<div class="col-xs-12">
			<div id="verifying-account" style="width: 100%; clear: both; display: none;">
				<img src="<?php echo base_url();?>application/assets/images/verify_logo.gif" style="margin-left:auto;margin-right:auto;display:block;">
				<p style="text-align:center;color:#055E87;letter-spacing:1px;">Verifying your account.Please wait...</p>
		 </div>
		</div>
	  </div>
	  
      <div class="row">
        <div class="col-xs-8">
      <!--     <div class="checkbox icheck">
        <label>
          <input type="checkbox"> Remember Me
        </label>
      </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="loginBtn">Sign In</button>
        </div>
		
        <!-- /.col -->
      </div>
	  
	 
    <?php echo form_close();?>
	
	<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
	<!--   <a href="#">I forgot my password</a><br> -->
		
		<div class="row">
			<p style="text-align:center;background: #e94747;color: #FFF;padding: 10px;margin-top: 22px;display:none;" id="login_err"></p>
		</div>
   </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>application/assets/sishubharati_theme/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>application/assets/js_scripts/admin_login/login.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
