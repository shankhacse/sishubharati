$(document).ready(function(){

var basepath = $("#basepath").val();


	   /*student list by class*/

  
    $(document).on("submit","#TransferForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TransferForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'transferstudent/classStudentListToTransfer',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentList").html(result);
                   // $('.dataTables').DataTable();
                   $('.selectpicker').selectpicker();
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




    /* save next session transfer data*/

     $(document).on("click","#transferSave",function(event){
        event.preventDefault();

            var formDataserialize = $("#TransferDataForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            if(chkvalidation()){
            $("#transferSave").css("display","none");	
            $("#loaderbtn").css("display","block");
            
            $.ajax({
                type: "POST",
                url: basepath+'transferstudent/transfer_action',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                $("#loaderbtn").css("display","none");
             	if(result.msg_status==1)
				{
					
                   $("#transfer_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
				}
				if(result.msg_status==0)
				{
					$("#transfer_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}	  
              
                window.location.replace(basepath+"transferstudent");

                    
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

      }//end of validation

    });


/*transfer student list by class*/

  
    $(document).on("submit","#TransferStatusForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TransferStatusForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'transferstudent/TransferStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentList").html(result);
                     $('.dataTables').DataTable({
                         "dom": 'Bfrtip',
                            "buttons": [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ],
                         "ordering": false,
                         "bPaginate": false
                    });
                  // $('.selectpicker').selectpicker();
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


});//end of document ready




   function chkvalidation(){

	
	var next_sel_class = $("#next_sel_class").val();
	var next_sel_session = $("#next_sel_session").val();
	
	$("#transfer_err_msg").css("display","none").text("");



    if(next_sel_class=="0")
    {
        $("#transfer_err_msg").css("display","block").text("Error : Select transfer to next class");
        return false;
    }

    if(next_sel_session=="0")
    {
        $("#transfer_err_msg").css("display","block").text("Error : Select transfer to next session");
        return false;
    }
    
    return true;
}
	