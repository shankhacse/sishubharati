 <!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
 <link href="<?php echo base_url(); ?>application/assets/css/bootstrap.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>application/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>application/assets/css/login.css" rel="stylesheet" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js/login/login.js"></script>

</head>
<body>
<!--
   <div class="imgcontainer">
    <img src="<?php echo base_url(); ?>application/assets/images/icon256.png" alt="Avatar" class="avatar">
  </div>

<div class="container">
 <input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>

 <div class="alert alert-danger" role="alert" style="display:none;" id="msgdiv">
     <div id="msgText"></div>
     <span class="glyphicon glyphicon-remove" aria-hidden="true" style="float: right;margin-top: -19px;cursor: pointer;"></span>
 </div>
 
 
 <label><b>Mobile</b></label>
    <input type="text" placeholder="Enter mobile" class="form-control" name="member" id="member" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" class="form-control" name="pwd" id="pwd" required>

    <button type="submit" id="memeberlogin">Login</button>
    <input type="checkbox" checked="checked"> Remember me
	
</div>

  <div class="container" style="background-color:#f1f1f1">
    
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
--> 

<div class="container-fluid">
	<div class="row custom-login-row">
	<div class="col-md-6 login-text-box">
		<div class="login-icon">
			<img src="<?php echo base_url(); ?>application/assets/images/member-login-icon2.png" />
		</div>
		<div class="login-text">
			<p>Maecenas quam elit, condimentum nec volutpat non, sodales in sem. Aenean laoreet urna porta lacinia pellentesque. Nulla libero risus, fermentum in tortor ut, convallis sollicitudin tortor. </p>
		</div>
	</div>
	<div class="col-md-6 login-form-container">
		
		<input type="hidden" value="<?php echo base_url(); ?>" id="basepath"></input>
		<div class="alert alert-danger error" role="alert" style="display:none;" id="msgdiv">
			<div id="msgText"></div>
			<span class="glyphicon glyphicon-remove" aria-hidden="true" style="float: right;margin-top: -19px;cursor: pointer;"></span>
		</div>
		
		<label><b>Mobile</b></label>
		<input type="text" placeholder="Enter mobile" class="form-control custom-input" name="member" id="member" required>

		<label><b>Password</b></label>
		<input type="password" placeholder="Enter Password" class="form-control custom-input" name="pwd" id="pwd" required>

		<button type="submit" id="memeberlogin" class="custom-button">Login</button>
		<input type="checkbox" checked="checked" ><span class="remeber-me"> Remember me</span>
		 <span class="psw"><a href="#"> Forgot password?</a></span>
	</div>
	</div>
	
	
	
</div>




</body>
</html>