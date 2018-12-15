$(document).ready(function(){
    var basepath = $("#basepath").val();


     /* Update subject full marks*/
$(document).on('click','.repltmsgbtn',function(){
       
        var msgid = $(this).data('msgid');
        var i = $(this).data('rownum');
       
        var reply = $("#reply_"+i).val();
        
      

        $.ajax({
            type: "POST",
            url: basepath+'message/replyMessage',
            dataType: "html",
            data: {msgid:msgid,reply:reply},
            success: function (result) {
               //$("#AttendanceRegisterForm").submit();
               location.reload();
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
    });

});// end of document ready