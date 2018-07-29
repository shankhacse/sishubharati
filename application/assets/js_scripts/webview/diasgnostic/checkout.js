$(document).ready(function() {
    var basepath = $("#wbbasepath").val();

    // jQuery time
    // 
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;


    $(document).on("click", ".next", function() {
        var step = $(this).data("stepverify");
        //  alert(step);
        if (step == "step1") {
            if (!validateStep1()) { return false; }
        }
        if (step == "step2") {
            if (!validateStep2()) { return false; }
        }


        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        var step = $(this).data("stepverify");


        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({ 'left': left, 'opacity': opacity });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });


    });



    $(".previous").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'left': left });
                previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity, 'position': 'absolute' });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });



    //terms & conditions
    $(document).on("click", "#agreeTermsChk", function() {

         if(this.checked) {
                var isagree = $('#agreeTermsChk').is(":checked");
                $("#verifyphone").css("display", "none");
                $("#verifyphBlckBtn").css("display", "none");

                var delvrydate = $("#dateofTest").val();
                if (isValidDate(delvrydate)) {
                    $("#verifyphone").css("display", "block");
                    $("#dateoftesterr").css("display", "none");
                   

                } else {
                    $("#dateoftesterr").css("display", "block");
                    $("#verifyphone").css("display", "none");
                    $("#verifyphBlckBtn").css("display", "none");

                }
        }else{

             $("#verifyphone").css("display", "none");
        }

    });

    //verify
    $(document).on("click", "#verifyphone,#resendotp", function() {
        
       // $(".otpblock").css("display", "block");
        
         
        var master_phone = $("#master_phone").val();

       // alert(master_phone);
        var formDataserialize = $("#checkoutForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            // console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'checkout/createotp';

          
if (validationphone()) { 
     $("#verifyphone").css("display", "none");
     $("#verifyphBlckBtn").css("display", "none");
     $("#placeorder_loading").css("display", "block");
           
            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.status == 1) {
                       // console.log("Success Block");
                        // alert(basepath + "checkout/orderplacesuccess");
                      //  window.location.href = basepath + "checkout/invoice/" + result.uorderid;
                    $(".otpblock").css("display", "block");
                      
                    } else {

                    $("#erralready_registerphone").css("display", "block");
                    }
                    $("#placeorder_loading").css("display", "none");
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            }); /*end ajax call*/
} //end of validation


    });



  $(document).on("click", "#submitotp", function() {
        

        var otp_verify = $("#otp_verify").val();

     
    $("#otp_verify").removeClass("errcls");
    $("#otp_verify").removeClass("errborder");

    
    if (otp_verify == "") {
        $("#errcus_otp").addClass("errcls");
        $("#otp_verify").addClass("errborder");
        return false;
    }

        var formDataserialize = $("#checkoutForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            // console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'checkout/verifyotp';

          

     $("#verifyphone").css("display", "none");
     $("#verifyphBlckBtn").css("display", "none");
     $("#placeorder_loading").css("display", "block");
           
            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.status == 1) {
                      $(".otpblock").css("display", "none");
                      $('#master_phone').attr('readonly', true);
                      $("#verifyphBlckBtn").css("display", "block");
                   
                      
                    } else {

                    //commented for bypass otp 15.06.2018

                     /*$("#verifyphBlckBtn").css("display", "none");
                     $(".otpblock").css("display", "block");
                     $("#otpstatus").text("OTP not Matched");*/



                    // active for bypass otp
                     $(".otpblock").css("display", "none");
                      $('#master_phone').attr('readonly', true);
                      $("#verifyphBlckBtn").css("display", "block");    



                    }
                    $("#placeorder_loading").css("display", "none");
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            }); /*end ajax call*/



    });



/*******************************************************************/
    $(document).on("keyup", "#dateofTest", function() {
        $(".delivery_date").text("");
    });

    $(document).on("keyup", "#cusdob", function() {
        $("#cusage").val("");
    });
    $(document).on("keyup", "#cusage", function() {
        $("#cusdob").val("");
    });

    $(document).on("blur", "#chkout_user_pin", function() {

        var pincode = $("#chkout_user_pin").val();
        $("#pinvalid_err").text("");
        $("#pinvalid_err").css("display", "none");
        $.ajax({
            type: "POST",
            url: basepath + "checkout/getDetailsPinInfo",
            dataType: "json",
            data: { pincode: pincode },
            success: function(result) {
                $("#pinvalid_err").removeClass("errcls");
                $("#chkout_user_pin").removeClass("errborder");

                if (result.pincodeID > 0) {
                    $("#pinvalid_err").text("");
                    $("#pinvalid_err").css("display", "none");
                    $("#chkout_user_state").val(result.statename);
                } else {
                    $("#pinvalid_err").addClass("errcls");
                    $("#pinvalid_err").css("display", "block");
                    $("#pinvalid_err").text("Not a valid pincode");
                    $("#chkout_user_pin").addClass("errborder");
                }
            },
            error: function(jqXHR, exception) {
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
        });


    });




    // Deliver date
    $(document).on("keyup", "#dateofTest", function() {
        $("#dateoftesterr").css("display", "none");
        $("#dateofTest").removeClass("validate_err");
        var isagree = $('#agreeTermsChk').is(":checked");
        var dateVal = $("#dateofTest").val();
        if (isValidDate(dateVal)) {
            var path = basepath + 'checkout/getTestDeliveryDates';
            var formDataserialize = $("#checkoutForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = { formDatas: formDataserialize };


            $.ajax({
                type: "POST",
                url: path,
                dataType: "json",
                data: formData,
                success: function(result) {
                    $.each(result, function(i, data) {
                        if (data.deliveryDate.length > 0) {
                            $("#deliverDt_" + i).html("<br>Delivery Date : " + data.deliveryDate);
                            $("#deliverDate_" + i).val(data.deliveryDate);
                            //alert(data.deliveryDate);
                        }


                    });
                    if (isagree) {
                        $("#verifyphone").css("display", "block");
                        $("#verifyphBlckBtn").css("display", "block");
                    }

                },
                error: function(jqXHR, exception) {
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
            });


        } else {
            // alert("not valid date");
            $("#dateofTest").addClass("validate_err");
        }

    });



    $(document).on("submit", "#checkoutForm", function(event) {
        event.preventDefault();

        if (validateStep3()) {
            var formDataserialize = $("#checkoutForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            // console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'checkout/orderDetails';

            $("#placeorder_loading").css("display", "block");

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.status == 1) {
                        console.log("Success Block");
                        // alert(basepath + "checkout/orderplacesuccess");
                        window.location.href = basepath + "checkout/invoice/" + result.uorderid;
                    } else {

                    }
                    $("#placeorder_loading").css("display", "none");
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            }); /*end ajax call*/
        }


    });


    // success -----------------
    /*
    $(document).on("click", "#order_print_slip", function() {
        // printDiv("#orderprintscreen");
        var uiod = $("#uoid").val();
        $.ajax({
            type: "POST",
            url: basepath + "checkout/getInvoicePrint",
            dataType: "html",
            data: { uiod: uiod },
            success: function(result) {
                printDiv(result);
            },
            error: function(jqXHR, exception) {
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
        });
    }); */

});

function printDiv(data) {



    // var divToPrint = document.getElementById("orderprintscreen");
    // newWin = window.open("");
    // newWin.document.write(divToPrint.outerHTML);
    // newWin.print();
    // newWin.close();

    var mywindow = window.open('', 'my div', 'height=400,width=800');
    //mywindow.document.write('<html><head><title></title>');
    // mywindow.document.write('<link rel="stylesheet" href="localhost/diagnostic/application/assets/css/webview/webview_style.css" type="text/css" />');
    //  mywindow.document.write('</head><body>');
    mywindow.document.write(data);
    // mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.print();
}


function validateStep1() {
    var cmast_nm = $("#name").val();
    var master_phn = $("#master_phone").val();

    $("#errcus_name,#errcus_mphone").removeClass("errcls");
    $("#name,#master_phone").removeClass("errborder");

    if (cmast_nm == "") {
        $("#errcus_name").addClass("errcls");
        $("#name").addClass("errborder");
        return false;
    }
    if (master_phn == "") {
        $("#errcus_mphone").addClass("errcls");
        $("#master_phone").addClass("errborder");
        return false;
    }

    return true;
}

function validateStep2() {
    var cusname = $("#cusname").val();
    //var cusdob = $("#cusdob").val();
    //var age = $("#age").val();
    var cusemail = $("#cusemail").val();
    var patientphone = $("#patientphone").val();
    var email_validate = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    $("#errcustmr_name,#errcustmr_email,#errcustmr_pphone").removeClass("errcls");
    $("#cusname,#cusemail,#patientphone").removeClass("errborder");

    if (cusname == "") {
        $("#errcustmr_name").addClass("errcls");
        $("#cusname").addClass("errborder");
        return false;
    }

    if (patientphone == "") {
        $("#errcustmr_pphone").addClass("errcls");
        $("#patientphone").addClass("errborder");
        return false;
    }

    if (cusemail.length > 0) {
        if (email_validate.test(cusemail) == false) {
            $("#errcustmr_email").addClass("errcls");
            $("#cusemail").addClass("errborder");
            return false;
        }
    }

    return true;
}

function validateStep3() {
    //  var cusname = $("#address_info_name").val();
    //  var cusphone = $("#address_info_phone").val();
    var cuspin = $("#chkout_user_pin").val();
    var cusaddress = $("#full_address").val();
    var chkstate = $("#chkout_user_state").val();

    $("#erraddr_cust,#erraddr_phone,#pinvalid_err,#erraddr_fulladd").removeClass("errcls");
    $("#address_info_name,#address_info_phone,#chkout_user_pin,#full_address").removeClass("errborder");

    /*
    if (cusname == "") {
        $("#erraddr_cust").addClass("errcls");
        $("#address_info_name").addClass("errborder");
        return false;
    }
    if (cusphone == "") {
        $("#erraddr_phone").addClass("errcls");
        $("#address_info_phone").addClass("errborder");
        return false;
    }
    */

    if (cusaddress == "") {
        $("#erraddr_fulladd").addClass("errcls");
        $("#full_address").addClass("errborder");
        return false;
    }
    if (cuspin == "") {
        $("#pinvalid_err").addClass("errcls");
        $("#chkout_user_pin").addClass("errborder");
        $("#pinvalid_err").text("Enter Pincode");
        return false;
    }
    if (chkstate == "") {
        $("#pinvalid_err").addClass("errcls");
        $("#chkout_user_pin").addClass("errborder");
        //$("#pinvalid_err").text("Enter Pincode");
        return false;
    }

    return true;
}




function isValidDate(txtDate)

{

    var currVal = txtDate;

    if (currVal == '')

        return false;



    //Declare Regex 

    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;

    var dtArray = currVal.match(rxDatePattern); // is format OK?



    if (dtArray == null)

        return false;



    //Checks for mm/dd/yyyy format.

    dtMonth = dtArray[3];

    dtDay = dtArray[1];

    dtYear = dtArray[5];



    if (dtMonth < 1 || dtMonth > 12)

        return false;

    else if (dtDay < 1 || dtDay > 31)

        return false;

    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)

        return false;

    else if (dtMonth == 2)

    {

        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));

        if (dtDay > 29 || (dtDay == 29 && !isleap))

            return false;

    }

    return true;

}

function validationphone() {
  
    var name = $("#name").val();
    var master_phone = $("#master_phone").val();
    


    $("#name").removeClass("errcls");
    $("#name").removeClass("errborder");

    
    if (name == "") {
        $("#errcus_name").addClass("errcls");
        $("#name").addClass("errborder");
        return false;
    }

     if (master_phone == "") {
        $("#errcus_mphone").addClass("errcls");
        $("#master_phone").addClass("errborder");
        return false;
    }
    
 

    return true;
}