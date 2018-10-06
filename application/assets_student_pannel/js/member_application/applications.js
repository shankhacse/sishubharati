$(document).ready(function(){
	var basepath = $("#basepath").val();
	$('#request-from-date , #request-to-date').datepicker({
            autoclose: true,
			todayHighlight: true,
            format: 'dd-mm-yyyy',
			forceParse: false
		});
	
	$("#supporting-document").on("change",function(){
		var file_name = $(this).val().replace(/([^\\]*\\)*/,'');
		$("#supporting-file-info").html(file_name);
	});
	
	
	$("#applicationExtForm").on("submit",function(event){
		event.preventDefault();
		//validateApplicationExtForm();
		if(validateApplicationExtForm()){
		 var formData = new FormData($(this)[0]);
		$.ajax({
				type: "POST",
				url: basepath + 'applications/applicationExtension',
				dataType: "json",
				processData: false,
				contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
				data: formData,
				success:function(result){
					if(result.msg_code==0){
						$("#apllication-ext-error").css("color","#F95340");
						$("#apllication-ext-error").html(result.msg_data);
					}
					else if(result.msg_code==1){
						 $("#apllication-ext-error").css( "color", "green" )
						 $("#apllication-ext-error").html(result.msg_data);
						 $("#supporting-file-info").html("");
						 $("#applicationExtForm")[0].reset();
					}
					else if(result.msg_code==2){
						$("#apllication-ext-error").css("color","#F95340");
						$("#apllication-ext-error").html(result.msg_data);
					}
					else{
						window.location.href = basepath + 'memberlogin';
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
              //  alert(msg);  
            }
		});
		}else{
			return false;
		}
		
	});
	
	
});

	function validateApplicationExtForm(){
		var request_frm_dt = $("#request-from-date").val();
		var request_to_date = $("#request-to-date").val();
		var datevalidate =  /^\d{1,2}-\d{2}-\d{4}$/;
		
		var error = "";
		var up_icon = '<span class="glyphicon glyphicon-hand-up"></span>';
		$("#request-from-date , #request-to-date ").removeClass('validation-error');
		$("#apllication-ext-error").html(error);
		
		if(request_frm_dt==""){
			error = up_icon+" Request From (Date) is required";
			$("#request-from-date").addClass('validation-error');
			$("#apllication-ext-error").html(error);
			return false;
		}
		if(datevalidate.test(request_frm_dt)==false){
			error = up_icon+" Request From (Date) is not valid";
			$("#request-from-date").addClass('validation-error');
			$("#apllication-ext-error").html(error);
			return false;
		}
		
		if(request_to_date==""){
			error = up_icon+" Request To (Date) is required";
			$("#request-to-date").addClass('validation-error');
			$("#apllication-ext-error").html(error);
			return false;
		}
		if(datevalidate.test(request_to_date)==false){
			error = up_icon+" Request To (Date) is not valid";
			$("#request-to-date").addClass('validation-error');
			$("#apllication-ext-error").html(error);
			return false;
		}
		return true;
	}

function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}