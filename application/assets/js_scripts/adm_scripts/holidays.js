$(document).ready(function(){
    var basepath = $("#basepath").val();
    $('#todate_div').hide();
    var rowNoUpload = 0;

    var mode = $("#mode").val();
  //  var check_range = $("#check_range").val();
    
    console.log(check_range);
    if(mode=='EDIT'){
     var check_range =$("#dtrange").is(":checked");

     if (check_range) {$('#todate_div').show();}
    }
    //alert(basepath);
   // $( ".datepicker" ).datepicker();
    $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });

$(document).on('submit','#HolidaysForm',function(e){
		e.preventDefault();
	
		if(validateHolidays())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#HolidaysForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'holidays/holidays_action';
            $("#holisavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 1) {
							
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "holidays/addholidays";
                        var listurl = basepath + "holidays";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#holi_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#holisavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
			
			
		}

	});
	// Set Status
    $(document).on("click", ".deleteholi", function() {
    	var holiid = $(this).data("holiid");
    	var urlpath = basepath + 'holidays/deleteHoliday';
    	if (confirmdelete()) {
    		$.ajax({
			type: "POST",
			url:  urlpath,
			data: {holiid:holiid},
			dataType: 'json',
			contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
			success: function (result) {
				if(result.msg_status=1)
				{
					location.reload();
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

    	}

		
      

    });


    $("#dtrange").change(function() {
    if(this.checked) {
        console.log("checked");
         $('#todate_div').show();
         $("#todatelebel").text("From Date");
    }else{
        console.log("notchecked");
         $('#todate_div').hide();
         $("#todatelebel").text("Date");
    }
   });

 });// end of document ready


function validateHolidays()
{
    
    var dtholiday = $("#dtholiday").val();
	var todtholiday = $("#todtholiday").val();
	var holititle = $("#holititle").val();
    var dtrange=$("#dtrange").is(":checked");
    

	$("#holimsg").text("").css("dispaly", "none").removeClass("form_error");

  
	if(dtholiday=="")
	{
		$("#dtholiday").focus();
		$("#holimsg")
		.text("Error : Select Date")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if (dtrange) {

        if(todtholiday=="")
        {
            $("#todtholiday").focus();
            $("#holimsg")
            .text("Error : Select To Date")
            .addClass("form_error")
            .css("display", "block");
            return false;
        }

    }

    if(holititle=="")
    {
        $("#holititle").focus();
        $("#holimsg")
        .text("Error : Enter Holiday Title")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}

function confirmdelete()
{
	return confirm("Are you sure to delete this entry?");
//	return confirm("Sorry ! Permission denied");
}