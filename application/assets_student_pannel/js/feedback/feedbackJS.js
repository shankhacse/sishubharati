/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(".dietCounselling").on("change",function(){
		var dietCouncelling = $(this).val();
		if(dietCouncelling=="Yes"){
			$("#dietCouncellingOpt").fadeIn(200);
		}
		else{
			$("#dietCouncellingOpt").fadeOut(200);
		}
	});
	
	$(".receivExchart").on("change",function(){
		var receiveExChart = $(this).val();
		if(receiveExChart=="Yes"){
			$("#exerciseChartOption").fadeIn(200);
		}
		else{
			$("#exerciseChartOption").fadeOut(200);
		}
	});
	
	$(".frondeskReceivCall").on("change",function(){
		var receiveCall = $(this).val();
		if(receiveCall=="Yes"){
			$("#receivedCallOpts").fadeIn(200);
		}
		else{
			$("#receivedCallOpts").fadeOut(200);
		}
	});
	
	
	
	
	 $("#feddBackForm").on("submit", function(event) {
		event.preventDefault();
		
		$.ajax({
            type: "POST",
            url: basepath + 'feedback/submitFeedback',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: $(this).serialize(),
            success: function (result) {
               if(result.status_code==1){
				    $("#feedbackMsg").css("color","#057505");
				    $("#feedbackMsg").html(result.status_msg);
					$('#feddBackForm')[0].reset();
			   }
			  else if(result.status_code==2){
				   $("#feedbackMsg").css("color","#F94003");
				   $("#feedbackMsg").html(result.status_msg);
			   }
			   else if(result.msg_code==500){
                    window.location.href = basepath + 'memberlogin';
                }
            }, error: function (jqXHR, exception) {
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
		
		 
	 });
	
	
});

