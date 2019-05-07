$(document).ready(function(){
	var basepath = $("#basepath").val();

$(document).on('submit','#teacherpasswordUpdateForm',function(event)
	{


		event.preventDefault();
		if(validate())
		{	
		
	
		
			var formData = $("#teacherpasswordUpdateForm" ).serialize();
			formData = decodeURI(formData);
			
	
		$.ajax({
				type: "POST",
				url: basepath+'changepassword/UpdatepasswordTeacher',
			

			dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {formDatas:formData},
				
				success: function (result) {
					
					
					
					if(result.msg_status==1)
					{
						$("#save-msg-data").text(result.msg_data);
						$("#saveMsgModal").modal({"backdrop"  : "static",
							  "keyboard"  : true,
							  "show"      : true                    
							});
						
						//$("#passwordUpdateForm")[0].reset();
					
						
						
						
					}
					if(result.msg_status==0)
					{
						$("#save-msg-data").text(result.msg_data);
						$("#saveMsgModal").modal({"backdrop"  : "static",
							  "keyboard"  : true,
							  "show"      : true                    
							});
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
				   // alert(msg);  
				}
			}); /*end ajax call*/

		 
		}	// end master validation
		
	});


});

function validate()
{
	
	
	var cur_pass = $("#cur_pass").val();
	var password = $("#password").val();
	var cpass = $("#cpass").val();
	

	$("#cur_pass,#password,#cpass").removeClass("error-border");
	if(cur_pass=="")
	{ 
		$("#cur_pass").addClass('error-border');
		$("#cur_pass").focus();
		$(".password-validation-err").text("Enter Current Password");
		return false;
	}
	if(password=="")
	{ 
		$("#password").addClass('error-border');
		$("#password").focus();
	    $(".password-validation-err").text("Enter New Password");	
		return false;
	}

	if(cpass=="")
	{ 
		$("#cpass").addClass('error-border');
		$("#cpass").focus();
		$(".password-validation-err").text("Enter Confirm Password");
		
		return false;
	}

	if(password!=cpass)
	{ 
		$("#cpass").addClass('error-border');
		$("#cpass").focus();
		$(".password-validation-err").text("Confirm Password Not Matched");
		
		return false;
	}
	

	

	return true;
}

function redirectStudentDashnoard()
{
var basepath = $("#basepath").val();
var redirectto='changepassword/teacher';
window.location.href=basepath+redirectto;
}