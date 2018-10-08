$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
 $(".scbyname").css("display","none");
  $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });


//view payment history details by payment id
$(document).on('click','.viewPaymentDtlData',function(){
        var paymentid = $(this).data('paymentid');
        var paymentfor = $(this).data('paymentfor');
        var billno = $(this).data('billno');
        

        $.ajax({
            type: "POST",
            url: basepath+'studentdashboard/getBillDetailData',
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



  });//end of document ready