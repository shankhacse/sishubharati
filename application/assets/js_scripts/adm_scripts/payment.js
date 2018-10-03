$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
 $(".scbyname").css("display","none");
  $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });


 // For Listing Unpaid Admission Fees student by class
    $(document).on("submit","#UnpaidAdmListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#UnpaidAdmListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadUnpaidAdmStudentList").html("");
            $.ajax({
                type: "POST",
                url: basepath+'payment/getUnpaidAdmFeeListbyClass',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadUnpaidAdmStudentList").html(result);
                    $('.dataTables').DataTable({
                         "ordering": false
                    });
                   
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

 // For Listing Unpaid Session Fees student by class
    $(document).on("submit","#UnpaidSesListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#UnpaidSesListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");


            $.ajax({
                type: "POST",
                url: basepath+'payment/getUnpaidSesFeeListbyClass',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadUnpaidSesStudentList").html(result);
                    $('.dataTables').DataTable({
                         "ordering": false
                    });
                   
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


//make admission fee payment
$(document).on('click','.ViewAdmMakePayment',function(){
        var studentid = $(this).data('studentid');
        var academicid = $(this).data('academicid');
        var studentname = $(this).data('studentname');
        var classname = $(this).data('classname');
        var classroll = $(this).data('classroll');
        var mode = $(this).data("mode");

        $.ajax({
            type: "POST",
            url: basepath+'payment/getDetailsForPayment',
            dataType: "html",
            data: {studentid:studentid,studentname:studentname,
            	academicid:academicid,classname:classname,classroll:classroll,mode:mode},
            success: function (result) {
                $("#title_info").html("Admission Fees Details");
                $("#detail_information_view").html(result);
                  $( ".datepicker" ).datepicker({
       
			       changeMonth: true,
			       changeYear: true,
			       format: 'dd/mm/yyyy'

			    });
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


//make session fee payment
$(document).on('click','.ViewSesMakePayment',function(){
        var studentid = $(this).data('studentid');
        var academicid = $(this).data('academicid');
        var studentname = $(this).data('studentname');
        var classname = $(this).data('classname');
        var classroll = $(this).data('classroll');
        var mode = $(this).data("mode");

        $.ajax({
            type: "POST",
            url: basepath+'payment/getDetailsForPayment',
            dataType: "html",
            data: {studentid:studentid,studentname:studentname,
            	academicid:academicid,classname:classname,classroll:classroll,mode:mode},
            success: function (result) {
                $("#title_info").html("Session Fees Details");
                $("#detail_information_view").html(result);
                  $( ".datepicker" ).datepicker({
       
			       changeMonth: true,
			       changeYear: true,
			       format: 'dd/mm/yyyy'

			    });
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



 // For save admission payment 
    $(document).on("submit","#PaymentAdmForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#PaymentAdmForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            
              if (validationAdmFee()) {

               $("#admpaysavebtn").css("display","none");
               $(".loaderbtn").css("display","block");
               $("#loadUnpaidAdmStudentList").html("");
               $(".closebtn").attr("disabled", true);

            $.ajax({
                type: "POST",
                url: basepath+'payment/savepayAdmissionFee',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {

                    $(".loaderbtn").css("display","none");
                   
                    $("#admpaymsg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    
                    $(".closebtn").attr("disabled", false);
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

       }//enf of validation

    });



 // For save session payment working on 26.09.2018
    $(document).on("submit","#PaymentSessionForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#PaymentSessionForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            
              if (validationSesFee()) {

               $("#sespaysavebtn").css("display","none");
               $(".loaderbtn").css("display","block");
               $("#loadUnpaidSesStudentList").html("");
               $(".closebtn").attr("disabled", true);

            $.ajax({
                type: "POST",
                url: basepath+'payment/savepaySessionFee',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {

                    $(".loaderbtn").css("display","none");
                   
                    $("#sespaymsg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    
                    $(".closebtn").attr("disabled", false);
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

       }//enf of validation

    });



 // For Listing Tution fee student by class working on progress 28.09.2018
    $(document).on("submit","#TutionFeeListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TutionFeeListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadTutionFeeStudentList").html("");
            $.ajax({
                type: "POST",
                url: basepath+'payment/getStudentListForTutionFeebyClass',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   $(".dashboardloader").css("display","none");
                    $("#loadTutionFeeStudentList").html(result);
                    $('.dataTables').DataTable({
                         "ordering": false
                    });
                   
                    
                    
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

//make monthly tution fee payment working on 28.09.2018
$(document).on('click','.ViewTutionMakePayment',function(){
        var studentid = $(this).data('studentid');
        var academicid = $(this).data('academicid');
        var studentname = $(this).data('studentname');
        var classname = $(this).data('classname');
        var classroll = $(this).data('classroll');
        var mode = $(this).data("mode");

        $.ajax({
            type: "POST",
            url: basepath+'payment/getDetailsForPayment',
            dataType: "html",
            data: {studentid:studentid,studentname:studentname,
                academicid:academicid,classname:classname,classroll:classroll,mode:mode},
            success: function (result) {
                $("#title_info").html("Monthly Tution Fees Details");
                $("#detail_information_view").html(result);
                  $( ".datepicker" ).datepicker({
       
                   changeMonth: true,
                   changeYear: true,
                   format: 'dd/mm/yyyy'

                });
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
        }); /*end ajax call*/
    });




/*change total amount on fine amount*/

$(document).on('keyup','#fine_amt_tution',function(){
var fine_amt = $("#fine_amt_tution").val();
var monthly_fee = $("#monthly_fee").val();

var total_amtount=parseInt(fine_amt)+parseInt(monthly_fee);

$("#total_amt").html(total_amtount);
});





 // For save monthly tution payment working on 28.09.2018
    $(document).on("submit","#PaymentTutionForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#PaymentTutionForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            
              if (validationTutionFee()) {

               $("#tutpaysavebtn").css("display","none");
               $(".loaderbtn").css("display","block");
               $("#loadTutionFeeStudentList").html("");
               $(".closebtn").attr("disabled", true);

            $.ajax({
                type: "POST",
                url: basepath+'payment/savepayTutionFee',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {

                    $(".loaderbtn").css("display","none");
                   
                    $("#tutpaymsg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    
                    $(".closebtn").attr("disabled", false);
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

       }//enf of validation

    });


// For Payment History student by class working on progress 30.09.2018
    $(document).on("submit","#PaymentHistoryForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#PaymentHistoryForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadStudentPaymentHistory").html("");
            $.ajax({
                type: "POST",
                url: basepath+'payment/getStudentPaymentHistory',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   $(".dashboardloader").css("display","none");
                    $("#loadStudentPaymentHistory").html(result);
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

       /* On select class select student name (payment history) */
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


//view payment history details by payment id
$(document).on('click','.viewPaymentDtlData',function(){
        var paymentid = $(this).data('paymentid');
        var paymentfor = $(this).data('paymentfor');
        var billno = $(this).data('billno');
        

        $.ajax({
            type: "POST",
            url: basepath+'payment/getBillDetailData',
            dataType: "html",
            data: {paymentid:paymentid,paymentfor:paymentfor,billno:billno},
            success: function (result) {
                $("#title_info").html("Bill Details");
                $("#detail_information_view").html(result);
                  $( ".datepicker" ).datepicker({
       
                   changeMonth: true,
                   changeYear: true,
                   format: 'dd/mm/yyyy'

                });
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
        }); /*end ajax call*/
    });




// For paid unpaid list
    $(document).on("submit","#paidUnpaidTutionFeeForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#paidUnpaidTutionFeeForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadPaidUnpaidStudentList").html("");
            $.ajax({
                type: "POST",
                url: basepath+'payment/getPaidUnpaidTutionFee',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   $(".dashboardloader").css("display","none");
                    $("#loadPaidUnpaidStudentList").html(result);
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


function validationAdmFee()
{
    
    var payment_dt = $("#payment_dt").val();
   

    $("#admpaymsg").text("").css("dispaly", "none").removeClass("form_error");

  
    if(payment_dt=="")
    {
        $("#payment_dt").focus();
        $("#admpaymsg")
        .text("Error : Select Payment Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

   
    return true;
}


function redirectMe()
{
var basepath = $("#basepath").val();
var redirectto='payment';
window.location.href=basepath+redirectto;
}   

function redirectSessionFee()
{
var basepath = $("#basepath").val();
var redirectto='payment/unpaidSessionFee';
window.location.href=basepath+redirectto;
}
function redirectTutionFee()
{
var basepath = $("#basepath").val();
var redirectto='payment/tutionfee';
window.location.href=basepath+redirectto;
}
function validationSesFee()
{
    
    var payment_dt = $("#payment_dt").val();
   

    $("#sespaymsg").text("").css("dispaly", "none").removeClass("form_error");

  
    if(payment_dt=="")
    {
        $("#payment_dt").focus();
        $("#sespaymsg")
        .text("Error : Select Payment Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

   
    return true;
}


function validationTutionFee()
{
    
    var sel_month = $("#sel_month").val();
    var payment_dt = $("#payment_dt").val();
   

    $("#tutpaymsg").text("").css("dispaly", "none").removeClass("form_error");

      if(sel_month=="0")
    {
        $("#sel_month").focus();
        $("#tutpaymsg")
        .text("Error : Select Payment For Month")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(payment_dt=="")
    {
        $("#payment_dt").focus();
        $("#tutpaymsg")
        .text("Error : Select Payment Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

   
    return true;
}