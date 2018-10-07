 <!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
<title>Sishubharati - Student Login</title>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!--<link href="<?php echo base_url(); ?>application/assets_student_pannel/css/bootstrap.min.css" rel="stylesheet">-->
<link href="<?php echo base_url(); ?>application/assets_student_pannel/css/login.css" rel="stylesheet" type="text/css"  />
	<!-- jQuery 3 -->
 <script src="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/jquery/dist/jquery.min.js"></script> 
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>application/assets/sishubharati_theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets_student_pannel/student_js/login/login.js"></script>

</head>
<body>


<div class="container-fluid">
	<div class="row custom-login-row">
		<div class="col-md-3 login-text-box"></div>
	<div class="col-md-6 login-text-box">
		<div class="login-icon">
			<img src="<?php echo base_url(); ?>application/assets_student_pannel/images/logo.png" />
		</div>
		
		<div class="sishu-title-box">
           
			<h4 class="sishu-title">SISHU BHARATI</h4>
			<p class="sishu-catchline">VIDYA MANDIR</p>
		</div>
		
		<div class="login-text">
			
		</div>
	</div>
	</div>
	<div class="row custom-login-row">
		<div class="col-md-3 login-form-container"></div>
	<div class="col-md-6 login-form-container">
		
		<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
		<div class="alert alert-danger error" role="alert" style="display:none;" id="msgdiv">
			<div id="msgText"></div>
			<span class="glyphicon glyphicon-remove" aria-hidden="true" style="float: right;margin-top: -19px;cursor: pointer;"></span>
		</div>
		
		<label><b>Student ID</b></label>
		<input type="text" placeholder="PSB000001" class="form-control custom-input" name="studentid" id="studentid" required>

		<label><b>Password</b></label>
		<input type="password" placeholder="Enter your password" class="form-control custom-input" name="pwd" id="pwd" required />
                <p class="help-block">Your default password is your date of birth (e.g.1990-12-31).</p>

		<button type="submit" id="studentlogin" class="custom-button studentlogin">Login</button>
		
		  <span class="psw"><a href="<?php echo base_url(); ?>">Back</a></span> 
		 
		 
		 <div class="verifying-account" style="width:100%;clear:both;display:none;">
			<img src="<?php echo base_url();?>application/assets_student_pannel/images/reload.gif" style="margin-left:auto;margin-right:auto;display:block;"/>
			<p style="text-align:center;color:#F66434;letter-spacing:1px;">Verifying your account.Please wait...</p>
		 </div>
	</div>
	</div>
		
	</div>
</div>




</body>
</html>