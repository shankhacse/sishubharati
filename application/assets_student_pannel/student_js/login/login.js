$(document).ready(function () {

    var basepath = $("#basepath").val();
    $("#studentlogin").click(function () {
        var studentid = $("#studentid").val() || "";
        var pwd = $("#pwd").val() || "";
      
      if (loginValidation()) {
		$(".studentlogin").css("display","none");
		$(".verifying-account").css("display","block");
		
        $.ajax({
            type: "POST",
            url: basepath + 'studentlogin/login',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {studentid: studentid, pwd: pwd},
            success: function (result) {
                if (result.msg_code == 0) {
					$(".studentlogin").css("display","block");
					$(".verifying-account").css("display","none");
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);
					

                } else if(result.msg_code == 3) {
					$(".studentlogin").css("display","block");
					$(".verifying-account").css("display","none");
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);
                }else if(result.msg_code == 1){
                    window.location=basepath + 'studentdashboard';
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
                alert(msg);
            }
        });

    }//end of if

    });

    $(document).on('click', '.glyphicon-remove', function () {
        $("#msgdiv").hide();
    });
}); 



function loginValidation()
{
    var studentid = $("#studentid").val();
    var pass = $("#pwd").val();
    
    
    $("#studentid,#pwd").removeClass("login_input_err");
    
    if(studentid=="")
    {
        $("#studentid").focus().addClass("login_input_err");
        return false;   
    }
    if(pass=="")
    {
        $("#pwd").focus().addClass("login_input_err");
        return false;   
    }
    
    
    return true;
    
}