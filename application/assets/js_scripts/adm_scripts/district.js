

$(document).ready(function(){
	var basepath = $("#basepath").val();


	 $('#district').typeahead({

            source: function (query, result) {
                $.ajax({
                    url: basepath+"district/getDistrictAutocomplet",
					data: {query:query},            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });


	 $(document).on("change","#country",function(){
	 	var country = $(this).val();
	 	populateState(country,basepath);
	 });


	$(document).on('submit','#DistrictForm',function(e){
		e.preventDefault();
		
		if(validateDistrict())
		{
			$("#districtmsg").css("display","none")

			var formDataserialize = $("#DistrictForm" ).serialize();
			formDataserialize = decodeURI(formDataserialize);
			console.log(formDataserialize);

			var formData = {formDatas: formDataserialize};
			var type = "POST"; //for creating new resource
			var urlpath = basepath+'district/district_action';
			$("#districtsavebtn").addClass('nonclick');
			$.ajax({
				type: type,
	            url: urlpath,
	            data: formData,
	            dataType: 'json',
	            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
				success: function (result) {
				$("#districtsavebtn").removeClass('nonclick');		
				if(result.msg_status==1)
				{
					$("#district_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
					if(result.mode=="EDIT")
					{
						window.location.replace(basepath+"district");
					}
					else
					{
						$("#DistrictForm")[0].reset();
					}
					
					
				}
				if(result.msg_status==0)
				{
					$("#pincode_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}

				
				}, 
				error: function (jqXHR, exception) {
					var msg = '';
					}
				}); /*end ajax call*/
		}

	});


	$(document).on("click",".diststatus",function(){
		
		var uid = $(this).data("distid");
		var status = $(this).data("setstatus");
		
		$.ajax({
				type: "POST",
	            url:  basepath+'district/setStatus',
	            data: {uid:uid,setstatus:status},
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
	});

});

function validateDistrict()
{
	var country = $("#country").val();
	var state = $("#state").val();
	var district = $("#district").val();
	$("#districtmsg").css("display","block").text("");
	if(country=="0")
	{
		$("#districtmsg").text("Error : Select Country");
		return false;
	}
	if(state=="0")
	{
		$("#districtmsg").text("Error : Select State");
		return false;
	}
	if(district=="")
	{
		$("#district").focus();
		$("#districtmsg").text("Error : Enter District Name");
		return false;
	}
	return true;
}

function populateState(country,base)
{
	$.ajax({
		type: "POST",
	    url: base+"district/getStates",
	    data: {country:country},
	    dataType: 'html',
	  	success: function (result) {
			$("#states_dropdown").html(result);
			$('.selectpicker').selectpicker();
		}, 
		error: function (jqXHR, exception) 
		{
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