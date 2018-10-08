$(document).ready(function () {

	var baseurl =$("#baseurl").val();
	 $(document).on('submit','#contactForm',function(event)
    {
        event.preventDefault();
		
		if(1)
		{
			var formDataserialize = $("#contactForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
			 
			
			$.ajax({
				type: "POST",
				url: baseurl + 'home/saveContact',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: formData,
				success: function (result) 
				{
					alert(result.msg_data);
					$("#contactForm")[0].reset();
					/*$("#save-msg-data").text(result.msg_data);
						
						$("#saveMsgModal").modal({"backdrop"  : "static",
							  "keyboard"  : true,
							  "show"      : true                    
							});
						$("#ContactForm")[0].reset();*/
				 
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




