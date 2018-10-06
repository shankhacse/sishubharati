$(document).ready(function () {
alert();
    var basepath = $("#basepath").val();
    $("#memeberlogin").click(function () {
        var mobile = $("#member").val() || "";
        var pwd = $("#pwd").val() || "";

		$(".memeberlogin").css("display","none");
		$(".verifying-account").css("display","block");
		
        $.ajax({
            type: "POST",
            url: basepath + 'memberlogin/login',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {mobile: mobile, pwd: pwd},
            success: function (result) {
                if (result.msg_code == 0) {
					$(".memeberlogin").css("display","block");
					$(".verifying-account").css("display","none");
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);
					

                } else if(result.msg_code == 3) {
					$(".memeberlogin").css("display","block");
					$(".verifying-account").css("display","none");
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);
                }else if(result.msg_code == 1){
                    window.location=basepath + 'memberdashboard';
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

    });

    $(document).on('click', '.glyphicon-remove', function () {
        $("#msgdiv").hide();
    });
}); 