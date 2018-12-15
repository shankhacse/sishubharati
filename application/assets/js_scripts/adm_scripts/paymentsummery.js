$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;
    //alert(basepath);
   // $( ".datepicker" ).datepicker();
    $( ".datepicker" ).datepicker({
       todayHighlight: true,
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'


    });

 /*student list by class*/

  
    $(document).on("submit","#paymentSummeryForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#paymentSummeryForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            

            if (validateSummery()) {
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'paymentsummery/paymentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadPaymentList").html(result);
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

       }//end of if block

    });


});//end of document ready

function validateSummery()
{
   
    var fromdt = $("#fromdt").val();
    var todt = $("#todt").val();
 

  

    $("#paysummsg").text("").css("dispaly", "none").removeClass("form_error");

   
    if(fromdt=="")
    {
        $("#fromdt").focus();
        $("#paysummsg")
        .text("Error : Select From Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    } 

     if(todt=="")
    {
        $("#todt").focus();
        $("#paysummsg")
        .text("Error : Select To Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    } 
   
 
    return true;
}