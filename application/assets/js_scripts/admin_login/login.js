$(document).ready(function () {
	var baseurl =$("#baseurl").val();
	$(document).on("click","#loginBtn",function(e){
		e.preventDefault();
		
		if(loginRequired())
		{
			var formData = $("#admiLoginForm" ).serialize();
			formData = decodeURI(formData);
			 
			$("#verifying-account").css("display","block");
			$("#loginBtn").css("display","none");
			$.ajax({
				type: "POST",
				url: baseurl + 'administratorpanel/verifyLogin',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: {formDatas:formData},
				success: function (result) 
				{
					if(result.msg_status == 1)
					{
						window.location=baseurl + 'admindashboard';
					}
					else
					{
						$("#verifying-account").css("display","none");
						$("#loginBtn").css("display","block");
						$("#login_err").css("display","block").text(result.msg_data);
					}
				 
				},
				error: function (jqXHR, exception) {
					var msg = '';
					if (jqXHR.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else {
						msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
					alert(msg);
				}
			});
		}	
		
		
	});



	// teacher login


		$(document).on("click","#teacherloginBtn",function(e){
		e.preventDefault();
		
		if(loginRequiredTeacher())
		{
			var formData = $("#admiLoginForm" ).serialize();
			formData = decodeURI(formData);
			 
			$("#verifying-account").css("display","block");
			$("#loginBtn").css("display","none");
			$.ajax({
				type: "POST",
				url: baseurl + 'administratorpanel/teacherverifyLogin',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: {formDatas:formData},
				success: function (result) 
				{
					if(result.msg_status == 1)
					{
						window.location=baseurl + 'admindashboard';
					}
					else
					{
						$("#verifying-account").css("display","none");
						$("#loginBtn").css("display","block");
						$("#login_err").css("display","block").text(result.msg_data);
					}
				 
				},
				error: function (jqXHR, exception) {
					var msg = '';
					if (jqXHR.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else {
						msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
					alert(msg);
				}
			});
		}	
		
		
	});
	


}); 


function loginRequiredTeacher()
{
	var uname = $("#username").val();
	var pass = $("#password").val();
	var year = $("#year").val();
	
	$("#username,#password").removeClass("login_input_err");
	
	if(uname=="")
	{
		$("#username").focus().addClass("login_input_err");
		return false;	
	}
	if(pass=="")
	{
		$("#password").focus().addClass("login_input_err");
		return false;	
	}
	if(year=="0")
	{
		$("#year").focus().addClass("login_input_err");
		return false;	
	}
	
	return true;
	
}


function loginRequired()
{
	var uname = $("#username").val();
	var pass = $("#password").val();
	var year = $("#year").val();
	
	$("#username,#password").removeClass("login_input_err");
	
	if(uname=="")
	{
		$("#username").focus().addClass("login_input_err");
		return false;	
	}
	if(pass=="")
	{
		$("#password").focus().addClass("login_input_err");
		return false;	
	}
	if(year=="0")
	{
		$("#year").focus().addClass("login_input_err");
		return false;	
	}
	
	return true;
	
}
