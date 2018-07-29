$(document).ready(function(){
	var basepath = $("#basepath").val();

	
	$(document).on('submit','#ClassForm',function(e){
		e.preventDefault();
	
		if(validateClass())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#ClassForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'classmaster/class_action';
            $("#clssavebtn").css('display', 'none');
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
                        var addurl = basepath + "classmaster/addclass";
                        var listurl = basepath + "classmaster";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#cls_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#clssavebtn").css({
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
    $(document).on("click", ".classstatus", function() {
		var uid = $(this).data("classid");
        var status = $(this).data("setstatus");
        var url = basepath + 'classmaster/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateClass()
{
    var adtype = $("#adtype").val();
	var classname = $("#classname").val();
    var codelength = $('#classcode').val().length;

	$("#classmsg").text("").css("dispaly", "none").removeClass("form_error");

    if(adtype=="")
    {
        $("#adtype").focus();
        $("#classmsg")
        .text("Error : Select Admission Type")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(classname=="")
	{
		$("#classname").focus();
		$("#classmsg")
		.text("Error : Enter Class Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(codelength!="2")
    {
        $("#classcode").focus();
        $("#classmsg")
        .text("Error : Enter Two Characters Class Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
