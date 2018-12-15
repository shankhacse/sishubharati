$(document).ready(function(){
    var basepath = $("#basepath").val();
$(".scbyname").css("display","none");

    /*student list by class*/

  
    $(document).on("submit","#StudentListResetPassForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#StudentListResetPassForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'studentaction/classStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentList").html(result);
                    $('.dataTables').DataTable();
                   
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

  $(document).on("click", ".passreset", function() {
		var studentid = $(this).data("studentid");
        var defaultpass = $(this).data("defaultpass");
        var rowid = $(this).data("rowid");
        
        var urlpath = basepath + 'studentaction/resetpassword';
          
            $("#reset_request_"+rowid).css('display', 'none');
            $("#loading_"+rowid).css('display', 'block');

            $.ajax({
                type: "POST",
                url: urlpath,
                data: {studentid:studentid,defaultpass:defaultpass},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					
					
                    $("#loading_"+rowid).css('display', 'none');
					$("#reset_done_"+rowid).css('display', 'block');
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

    }); 


     $(document).on("change", "#sel_type_searchby", function() {
         var sel_type = $("#sel_type_searchby").val();

         if (sel_type=='SID') {
             $(".scbyid").css("display","block");
             $(".scbyname").css("display","none");

         }else if(sel_type=='SNAME'){
             $(".scbyid").css("display","none");
             $(".scbyname").css("display","block");

         }

    });

       /* On select class select student name (certificate) */
    $(document).on("change", "#sel_classpayhis", function() {
        var val=$('#sel_classpayhis').val();

       
    $.ajax({
    type: "POST",
    url: basepath+'payment/getStudentName',
    data: {classid:val},
    
    success: function(data){
        $("#student_viewph").html(data);
        $('.selectpicker').selectpicker();
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



    });/*end ajax call*/

    });  

// For Payment History student by class working on progress 30.09.2018
    $(document).on("submit","#TcRequestForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TcRequestForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadStudentDetails").html("");
            $.ajax({
                type: "POST",
                url: basepath+'studentaction/getStudentInfo',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   $(".dashboardloader").css("display","none");
                    $("#loadStudentDetails").html(result);
                    /*$('.dataTables').DataTable({
                         "ordering": false
                    });*/
                   
                    
                    
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