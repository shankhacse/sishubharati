
$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	$('#dietry-managment-list').DataTable({
		"ordering": false,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search..."
		}
	});
	
	$("#dietaryManagmentForm").on("submit",function(event){
		event.preventDefault();
		if(validateAll()){
		$.ajax({
			type: "POST",
			url: basepath + 'dietary_management/addMemberDiet',
			dataType: "json",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			data: $(this).serialize(),
			success:function(result){
				if(result.msg_code==0){
					$("#submit-diet-err").css("color","#F95340");
					$("#submit-diet-err").html(result.msg_data);
				}
				else if(result.msg_code==1){
					$("#submit-diet-err").css("color","green");
					//$("#submit-diet-err").html(result.msg_data);
					$("#dietsuccessmsg").html(result.msg_data);
					//$("#dietaryManagmentForm")[0].reset();
					$('#dietsuccessModal').modal({backdrop: 'static', keyboard: false})  
					$("#dietsuccessModal").modal('show');
				}
				else if(result.msg_code==2){
					$("#submit-diet-err").css("color","#F95340");
					$("#submit-diet-err").html(result.msg_data);
				}
				else{
					window.location.href = basepath + 'memberlogin';
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
              //  alert(msg);  
            }
		});
		
		
		}
		else{
			return false;
		}
	});


	// get diet chart
	$(".diet-chart-btn").click(function(){
		var memberid = $(this).data('id');
		//alert(memberid);
		
		$.ajax({
			type: "POST",
			url :  basepath + 'dietary_management/getDietChart',
			dataType: "html",
			data:{memberid:memberid},
			success:function(res){
				$("#dietChartResult").html(res);
			}
			
		});
		
	});

	
}); /*--$(document) END*/


function validateAll(){
	
	if(!validateMemberDietOptions()){return false;}
	if(!validateMemberDietValue()){return false;}
	return true;
}

function validateMemberDietOptions(){
	var error = "";
	var up_icon = '<span class="glyphicon glyphicon-hand-up"></span>';
	$("#submit-diet-err").html(error);
	
	if($('input:radio[name="meal1"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 1 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal2"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 2 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal3"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 3 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal4"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 4 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal5"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 5 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal6"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 6 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal7"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 7 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	if($('input:radio[name="meal8"]').is(':checked')==false){
			error = up_icon+" Plese select Meal 8 option";
			$("#submit-diet-err").html(error);
			return false;
	}
	return true;
	
	
	
}

 function validateMemberDietValue(){
	var weight = $("#weight").val();
	var valerr = "";
	var up_icon2 = '<span class="glyphicon glyphicon-hand-up"></span>';
	$("#submit-diet-err").html(valerr);
	
	if(weight==""){
		valerr = up_icon2+" Please enter weight";
		$("#submit-diet-err").html(valerr);
		return false;
	}
	return true;
}

