$(document).ready(function(){
	var basepath = $("#basepath").val();



	//alert("test");



function admindashboarddata() {
	

      $.ajax({
				type: "POST",
				url: basepath+'admindashboard/DashboardCalender',
				dataType: "json",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: {},
				
				success: function (result) {
					//alert(result.month);
				$("#month").html(result.month);	
				$("#year").html(result.year);	
				$("#day").html(result.day);	
				$("#time").html(result.time);	
					

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

	}

//makeTimer();
	setInterval(function() { admindashboarddata(); }, 1000);
	




});  //end of document end


