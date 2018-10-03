$(document).ready(function(){
	var basepath = $("#basepath").val();

	
	$(document).on('submit','#QualificationForm',function(e){
		e.preventDefault();
	
		if(validate())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#QualificationForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'qualification/qualification_action';
            $("#qulsavebtn").css('display', 'none');
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
                        var addurl = basepath + "qualification/addqualification";
                        var listurl = basepath + "qualification";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#qul_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#qulsavebtn").css({
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
  /*  $(document).on("click", ".classstatus", function() {
		var uid = $(this).data("classid");
        var status = $(this).data("setstatus");
        var url = basepath + 'classmaster/setStatus';
        setActiveStatus(uid, status, url);

    });*/

	

});

function validate()
{
    var qualification = $("#qualification").val();
	
	$("#qualificationmsg").text("").css("dispaly", "none").removeClass("form_error");

    if(qualification=="")
    {
        $("#qualification").focus();
        $("#qualificationmsg")
        .text("Error : Enter Qualification Type")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	

   
	return true;
}
