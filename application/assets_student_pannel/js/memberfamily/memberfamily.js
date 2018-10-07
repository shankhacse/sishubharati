$(window).load(function(){
	var basepath = $("#basepath").val();
	getFamilyName(basepath);
});

$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	$('#memberFamilyList,#bloodPressureData').DataTable({
		"ordering": false,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search..."
		}
	});
	
	
	$('#relationship').selectpicker();
	$('.searchabledropdown').selectpicker();
	
	$('#collectiondate').datepicker({
		autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        forceParse: false
	}); 
	
	$('.datepicker').datepicker({
		autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        forceParse: false
	});
	
	$('.collectiontime').timepicker({
		defaultTime: '',
        minuteStep: 1
        });
	
	$("#reset-time").click(function(){
		$('#collectiontime').val("");
	})
	
	$("#memberfamilyForm").on("submit",function(event){
		event.preventDefault();
		//validateMemberFamily();
		if(validateMemberFamily()){
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/saveMemberFamily',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: $(this).serialize(),
				success:function(result){
					if(result.msg_code==0){
						$("#save-memberfamily-err").html(result.msg_data);
					}
					else if(result.msg_code==1){
						$("#membfamlysuccess").html(result.msg_data);
						$('#membersfamilySuccessModal').modal({backdrop: 'static', keyboard: false})  
						$("#membersfamilySuccessModal").modal('show');
					}
					else if(result.msg_code==2){
						$("#save-memberfamily-err").html(result.msg_data);
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
		}else{
			return false;
		}
	}); /*----END-----*/
	
	
	$("#membr-relatinship").on("change",function(){
		getFamilyName(basepath);
	});  
	
	
	// Blood Pressure Search
	$("#bpSearchForm").on("submit",function(event){
		event.preventDefault();
		
		$("#bpLoader").css("display","block");
		
		$.ajax({
			url:basepath + 'memberfamily/getBloodTestReport',
			type:'POST',
			dataType:'html',
			data:$(this).serialize(),
			success:function(res){
				$("#bpLoader").css("display","none");
				$("#bloodPressureList").html(res);
				$('#bloodPressureData').DataTable({
					"ordering": false,
					language: {
						search: "_INPUT_",
						searchPlaceholder: "Search..."
					}
				});
			},
			error:function (jqXHR, exception) {
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
		});
	});
	
	
	
	
	
	// Add Blood Pressure 
	$("#bloodPressureForm").on("submit",function(event){
		event.preventDefault();

		if(validateBloodPressure()){
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/saveBloodPressure',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: $(this).serialize(),
				success:function(result){
					if(result.msg_code==0){
						$("#bldpressure-err").html(result.msg_data);
					}
					else if(result.msg_code==1){
						$("#bldpressure-err").html("");
						$("#bpsavesuccessmsg").html(result.msg_data);
						$('#memFamlyBPsaveModal').modal({backdrop: 'static', keyboard: false})  
						$("#memFamlyBPsaveModal").modal('show');
					}
					else if(result.msg_code==2){
						$("#bldpressure-err").html(result.msg_data);
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
	
	
	// Edit Blood Pressure
	
	
	$("#editbloodPressureForm").on("submit",function(event){
		event.preventDefault();
	
		if(validateBloodPressure()){
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/updateBloodPresure',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: $(this).serialize(),
				success:function(result){
					if(result.msg_code==0){
						$("#bldpressureupd-err").html(result.msg_data);
					}
					else if(result.msg_code==1){
						$("#bldpressureupd-err").html("");
						$("#bpupdsuccessmsg").html(result.msg_data);
						$('#memFamlyBPeditModal').modal({backdrop: 'static', keyboard: false})  
						$("#memFamlyBPeditModal").modal('show');
					}
					else if(result.msg_code==2){
						$("#bldpressureupd-err").html(result.msg_data);
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
	
	
	/*--------------3---------------*/
	
	$("#blood-test").on("change",function(){
		var bloodtestid = $(this).val();
		
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/getBloodTestUnit',
				dataType: "html",
				//contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data:{bloodtestid:bloodtestid},
				success:function(result){
					$("#bloodTestUnit").html(result);
					//$('.searchabledropdown').selectpicker();
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
			});
	});
	
	$("#bloodTestForm").on("submit",function(event){
		event.preventDefault();
		//validateBloodTest();
		if(validateBloodTest()){
			
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/saveBloodTest',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data:$(this).serialize(),
				success:function(result){
					
					if(result.msg_code==0){
						$("#bldtest-err").html(result.msg_data);
					}
					else if(result.msg_code==1){
						$("#bldtest-err").html("");
						$("#bldtestsavesuccessmsg").html(result.msg_data);
						$('#memFamlyBloodTestsaveModal').modal({backdrop: 'static', keyboard: false})  
						$("#memFamlyBloodTestsaveModal").modal('show');
					}
					else if(result.msg_code==2){
						$("#bldtest-err").html(result.msg_data);
					}
					else{
						window.location.href= basepath + 'memberlogin';
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
					//alert(msg);  
				}
			});
			}
			else{
				alert("dasd");
				return false;
			}
			
	});
	
	
	$("#bloodTestSearchForm").on("submit",function(event){
		event.preventDefault();
		$("#bldtestLoader").css("display","block");
		$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/getBloodTestList',
				dataType: "html",
				//contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data:$(this).serialize(),
				success:function(result){
					$("#bldtestLoader").css("display","none");
					$("#bloodTestList").html(result);
					
					/*
						$('#bloodTestData').DataTable( {
							dom: 'Bfrtip',
							buttons: [
								'print'
							]
						} );*/
						
					
					var table = $('#bloodTestData').DataTable({
						"columnDefs": [
								{ "visible": false, "targets": 2 }
							],
							//"order": [[ 2, 'asc' ]],
							"ordering": false,
							"displayLength": 25,
							"drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(2, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background:#FF966C;color:#FFF;font-weight:600;font-size: 13px;"><td colspan="6"><span class="glyphicon glyphicon-star"></span> '+group+'</td></tr>'
										);
					 
										last = group;
									}
								} );
								
							}
							
						} );
						
 
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
					//alert(msg);  
				}
			});
		
	});
	
	
	
	
});




function getFamilyName(basepath)
{
		//var relationid = $(this).val();
		var relationid = $("#membr-relatinship").val();
		//alert(relationid);
		var relation= $("#membr-relatinship option:selected").text();
		$("#relation_text").val(relation);
		if(relation=="Self"){
			
			var notext = "";
			var optionVal = "";
				optionVal+='<select id="membr-family-name" name="membr-family-name" class="searchabledropdown form-control" data-show-subtext="true" data-live-search="true">';
				optionVal+='<option vlaue="">Member Self</option>'
				optionVal+='</select>';
			$("#memFamilyName").html(optionVal);
			$('.searchabledropdown').selectpicker();
			$('#membr-family-name').prop('disabled', 'disabled');
			 $("#memFamilyName .searchabledropdown .btn").css({
				 "background":"#E0E0E0",
				"cursor":"not-allowed"
			 });
		}
		else{
			var textname = "Name";
			$("label[for=membr-family-name]").text(textname);
			$('#membr-family-name').prop('disabled', false);
			$("#memFamilyName .searchabledropdown .btn").css({});
			 
			 
			 
			$.ajax({
				type: "POST",
				url: basepath + 'memberfamily/getMemberFamily',
				dataType: "html",
				//contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data:{relationid:relationid},
				success:function(result){
					$("#memFamilyName").html(result);
					$('.searchabledropdown').selectpicker();
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
			});
			
			
		}
}



function validateMemberFamily(){
	var relationship = $("#relationship").val();
	var name = $("#memfamilyname").val();
	var age = $("#memfamilyage").val();
	var bloodgrp = $("#memfamilybldgrp").val();
	
	var error = "";
	var up_icon = '<span class="glyphicon glyphicon-hand-up"></span>';
	$("#relationship , #memfamilyname , #memfamilyage").removeClass('validation-error');
	$("#save-memberfamily-err").html(error);
	
	if(relationship=="0"){
		error = up_icon+" Please select relationship";
		$("#relationship").addClass('validation-error');
		$("#save-memberfamily-err").html(error);
		return false;
	}
	if(name==""){
		error = up_icon+" Please enter family member's name";
		$("#memfamilyname").addClass('validation-error');
		$("#save-memberfamily-err").html(error);
		return false;
	}
	if(age==""){
		error = up_icon+" Please enter family member's age";
		$("#memfamilyage").addClass('validation-error');
		$("#save-memberfamily-err").html(error);
		return false;
	}
	if(age<0){
		error = up_icon+" Please enter family member's correct age";
		$("#memfamilyage").addClass('validation-error');
		$("#save-memberfamily-err").html(error);
		return false;
	}
	if(bloodgrp=="0"){
		error = up_icon+" Please select blood group";
		$("#memfamilybldgrp").addClass('validation-error');
		$("#save-memberfamily-err").html(error);
		return false;
	}
	return true;
}


function validateBloodPressure(){
	var relationshipId = $("#membr-relatinship").val();
	var relationText = $("#membr-relatinship option:selected").text();
	var familynameId = $("#membr-family-name").val();
	
	var systolic = $("#systolic").val();
	var diastolic = $("#diastolic").val();
	var pulserate = $("#pulserate").val();
	var collectiondate = $("#collectiondate").val();
	
	var error = "";
	var up_icon = '<span class="glyphicon glyphicon-hand-up"></span>';
	$("#membr-relatinship , #membr-family-name , #systolic , #diastolic , #pulserate , #collectiondate").removeClass('validation-error');
	$("#bldpressure-err").html(error);
	
	if(relationshipId=="0"){
		error = up_icon+" Please select relationship";
		$("#membr-relatinship").addClass('validation-error');
		$("#bldpressure-err").html(error);
		return false;
	}
	if(relationText!="Self"){
		if(familynameId=="0"){
			error = up_icon+" Please select name";
			$("#membr-family-name").addClass('validation-error');
			$("#bldpressure-err").html(error);
			return false;
		}
	}
	if(systolic==""){
		error = up_icon+" Please enter systolic value";
		$("#systolic").addClass('validation-error');
		$("#bldpressure-err").html(error);
		return false;
	}
	if(diastolic==""){
		error = up_icon+" Please enter diastolic value";
		$("#diastolic").addClass('validation-error');
		$("#bldpressure-err").html(error);
		return false;
	}
	if(pulserate==""){
		error = up_icon+" Please enter pulserate value";
		$("#pulserate").addClass('validation-error');
		$("#bldpressure-err").html(error);
		return false;
	}
	if(collectiondate==""){
		error = up_icon+" Please enter Collection Date";
		$("#collectiondate").addClass('validation-error');
		$("#bldpressure-err").html(error);
		return false;
	}
	
	return true;

}


	function validateBloodTest(){
	
		var relationshipId = $("#membr-relatinship").val();
		var relationText = $("#membr-relatinship option:selected").text();
		var familynameId = $("#membr-family-name").val();
		var bldtestid = $("#blood-test").val();
		var unitid = $("#blood-test-unit").val();
		var reading = $("#reading").val();
		var collectiondate = $("#bld-test-col-date").val();
		
		
		
		var error = "";
		var up_icon = '<span class="glyphicon glyphicon-hand-up"></span>';
		$("#membr-relatinship , #membr-family-name , #blood-test , #blood-test-unit , #reading , #bld-test-col-date").removeClass('validation-error');
		$("#bldtest-err").html(error);
		
		//alert(relationshipId);
		
			if(relationshipId=="0"){
				error = up_icon+" Please select relationship";
				$("#membr-relatinship").addClass('validation-error');
				$("#bldtest-err").html(error);
				return false;
			}
			
			if(relationText!="Self"){
				if(familynameId=="0"){ 
					error = up_icon+" Please select family name";
					$("#membr-family-name").addClass('validation-error');
					$("#bldtest-err").html(error);
					return false;
				}
			}
			if(bldtestid=="0"){
				error = up_icon+" Please select test";
				$("#blood-test").addClass('validation-error');
				$("#bldtest-err").html(error);
				return false;
			}
			if(unitid=="0"){
				error = up_icon+" Please select unit";
				$("#blood-test-unit").addClass('validation-error');
				$("#bldtest-err").html(error);
				return false;
			}
			if(reading==""){
				error = up_icon+" Please enter reading value";
				$("#reading").addClass('validation-error');
				$("#bldtest-err").html(error);
				return false;
			}
			if(collectiondate==""){
				error = up_icon+" Please select collection date";
				$("#bld-test-col-date").addClass('validation-error');
				$("#bldtest-err").html(error);
				return false;
			}
			
			return true;
			
			
			
			
	
	}

