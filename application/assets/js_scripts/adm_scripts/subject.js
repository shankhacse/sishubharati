$(document).ready(function(){
	var basepath = $("#basepath").val();

	
	$(document).on('submit','#SubjectForm',function(e){
		e.preventDefault();
	
		if(validateSubject())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#SubjectForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'subject/subject_action';
            $("#subsavebtn").css('display', 'none');
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
                        var addurl = basepath + "subject/addsubject";
                        var listurl = basepath + "subject";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#sub_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#subsavebtn").css({
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
    $(document).on("click", ".subjectstatus", function() {
		var uid = $(this).data("subjectid");
        var status = $(this).data("setstatus");
        var url = basepath + 'subject/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateSubject()
{
    
	var subjectname = $("#subjectname").val();
    var codelength = $('#subcode').val().length;

	$("#submsg").text("").css("dispaly", "none").removeClass("form_error");

  
	if(subjectname=="")
	{
		$("#subjectname").focus();
		$("#submsg")
		.text("Error : Enter Subject Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(codelength!="3")
    {
        $("#subcode").focus();
        $("#submsg")
        .text("Error : Enter Three Characters Subject Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
