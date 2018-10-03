$(document).ready(function(){
	var basepath = $("#basepath").val();

	$("#FeesForm")[0].reset();
	$(document).on('submit','#FeesForm',function(e){
		e.preventDefault();
	
		if(validateFeesInfo())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#FeesForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'feesinfo/saveFees';
            $("#feesavebtn").css('display', 'none');
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
                        var addurl = basepath + "feesinfo/addfeesinfo";
                        var listurl = basepath + "feesinfo";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#fees_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#feesavebtn").css({
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
    $(document).on("keyup", ".tutionclass", function() {
		var feesradio=$("input[name='feesradio']:checked").val();
        var id = $(this).attr('id');
        var rownummonthfee = $("#rownummonthfee").val();
        var mnthval = $("#"+id).val();
        

        if (feesradio=='same') {
                 for(var i=0;i<rownummonthfee;i++){

            $('#monthlytution_'+i).val(mnthval);
         }

        }
        
         
   
    });


   

});


 function validateFeesInfo()
    { 
        var admissionfee = $("#admissionfee").val();
        var rownum = $("#rownum").val();
        var rownummonthfee = $("#rownummonthfee").val();

    $("#feesmsg").text("").css("dispaly", "none").removeClass("form_error");

            if(admissionfee=="")
                        {   
                         $("#feesmsg")
                            .text("Error : Enter Admission Amount")
                            .addClass("form_error")
                            .css("display", "block");
                            $("#admissionfee").addClass('error-border');
                            return false;
              }

         for(var i=0;i<rownum;i++){
   
             var amount = $("#amount_"+i).val();
             var feestype = $("#feestype_"+i).val();
             $("#amount_"+i).removeClass("error-border");
             if(amount=="")
                {   
                 $("#feesmsg")
                    .text("Error : Enter "+feestype+" Amount")
                    .addClass("form_error")
                    .css("display", "block");
                    $("#amount_"+i).addClass('error-border');
                    return false;
                }
        }

         for(var i=0;i<rownummonthfee;i++){
   
             var monthlytution = $("#monthlytution_"+i).val();
             
             $("#monthlytution_"+i).removeClass("error-border");
             if(monthlytution=="")
                {   
                 $("#feesmsg")
                    .text("Error : Enter monthly tution amount")
                    .addClass("form_error")
                    .css("display", "block");
                    $("#monthlytution_"+i).addClass('error-border');
                    return false;
                }
        }



return true;
}


