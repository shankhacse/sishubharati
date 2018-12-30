$(document).ready(function(){
    var basepath = $("#basepath").val();


/*delete notice*/
   $(document).on("click", ".updtaboutusbtn", function() {
      var aboutusid = $(this).data("aboutusid");
      var columnname = $(this).data("columnname");
      var history = $("#history").val();
      var mission = $("#mission").val();
      var vision = $("#vision").val();
      var urlpath = basepath + 'aboutus/updateAboutus';
     
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {aboutusid:aboutusid,columnname:columnname,history:history,mission:mission,vision:vision},
      dataType: 'json',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
      success: function (result) {
        if(result.msg_status=1)
        {

          $("#save-msg-data").text(result.msg_data);
						
						$("#saveMsgModal").modal({"backdrop"  : "static",
							  "keyboard"  : true,
							  "show"      : true                    
							});
         // location.reload();
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
    }); /*end ajax call*/

    

    });

});// end of document ready