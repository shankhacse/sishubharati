$(document).ready(function(){
	var basepath = $("#basepath").val();

	   /*student list by class*/

  
    $(document).on("submit","#ResetRollForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#ResetRollForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'resetroll/classStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentList").html(result);
                   // $('.dataTables').DataTable();
                   
                    $(".dashboardloader").css("display","none");
                    
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

/* reset role of active student rank wise */
 $(document).on('submit','#ResetRollData',function(e){
		e.preventDefault();
	

			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#ResetRollData").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'resetroll/resetRollByRank';
            $("#updroll").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                	
				if(result.msg_status==1)
				{
					
                   $("#updroll_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
				}
				if(result.msg_status==0)
				{
					$("#updroll_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}	 

					 $("#loaderbtn").css('display', 'none');
					// window.location.replace(basepath+"generaterank");
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
			
			
	

	});




});//end of document ready