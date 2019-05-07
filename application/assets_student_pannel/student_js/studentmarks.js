$(document).ready(function(){
	var basepath = $("#basepath").val();


	/*individuals student marksheet working on progress*/

   
    $(document).on("submit","#StudentMarksViewForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#StudentMarksViewForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadStudentMarksheet").html('');
          if (validateMarks()) {
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'studentdashboard/getStudentTermMarks',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentMarksheet").html(result);
                     $('.selectpicker').selectpicker();
                   
                    $(".dashboardloader").css("display","none");
                    
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

  });


        /*individuals student marksheet working on progress*/

   
    $(document).on("submit","#marksIndividualsForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#marksIndividualsForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadstudentList").html('');
          
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'studentdashboard/getStudentAllMarks',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentMarksheet").html(result);
                     $('.selectpicker').selectpicker();
                   
                    $(".dashboardloader").css("display","none");
                    
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
   

  });

   
    $(document).on("click","#exampaperview",function(event){
        event.preventDefault();

           var formDataserialize = $("#marksIndividualsForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadStudentMarksheet").html('');
          
            $(".dashboardloader").css("display","block");


            $.ajax({
                type: "POST",
                url: basepath+'studentdashboard/getStudentExamPapersAll',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentMarksheet").html(result);
                     $('.selectpicker').selectpicker();
                   
                    $(".dashboardloader").css("display","none");
                    
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
   

  });

});// end of document ready

function validateMarks()
{
    
	var term = $("#term").val();
   

	$("#markserr").text("").css("dispaly", "none").removeClass("form_error");

  
	if(term=="0")
	{
		$("#term").focus();
		$("#markserr")
		.text("Error : Select Term")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

   
	return true;
}