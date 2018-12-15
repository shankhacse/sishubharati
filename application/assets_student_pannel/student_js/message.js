$(document).ready(function(){
	var basepath = $("#basepath").val();

$(document).on('submit','#SendMessageForm',function(event)
	{


		event.preventDefault();
		if(validatemsg())
		{	
		

			var formDataserialize = $("#SendMessageForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
			
	
		$.ajax({
				type: "POST",
				url: basepath+'studentdashboard/sendMessage',
			

			dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: formData,
				
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

function validatemsg()
{
	
	
	var message = $("#message").val();
	
	

	$("#message").removeClass("error-border");
	if(message=="")
	{ 
		$("#message").addClass('error-border');
		$("#message").focus();
		$(".password-validation-err").text("Enter message");
		return false;
	}
	


	return true;
}

function redirectStudentMessage()
{
var basepath = $("#basepath").val();
var redirectto='studentdashboard/message';
window.location.href=basepath+redirectto;
}