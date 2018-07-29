$(document).ready(function(){
	var basepath = $("#wbbasepath").val();

	$(document).on("keydown","#srch_pincode",function(){
        var path = basepath+'home/getPincodeAutocomplet';
        getAutoComplete('srch_pincode',path); // commonutilfunc.js

         // refreshInvestigation(basepath);
        //$("#selected_items_ul").empty();
    });

   


    $(document).on("click","#add_more_test",function(){
        var formDataserialize = $("#usearched_form").serialize();
        formDataserialize = decodeURI(formDataserialize);
        var formData = {formDatas: formDataserialize};

    	$.ajax({
           type: "POST",
            url: basepath+"searchquery/addmoretest",
            data: formData,
            dataType: 'json',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            success: function (result) {
                console.log(result);
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

    $(document).on('click','.clear_selected_test', function(){
    	$(this).parent().remove();
  		refreshInvestigation(basepath);
	});


    $(document).on('submit','#searchInvestigation', function(e){
       e.preventDefault();
       //var pcode = $("#srch_pincode").val();
       //var tests = $("input[name=i]").serialize();
       var search = $("#searchInvestigation").serialize();
       //var encoded = encodeURIComponent(tests);
        window.location.href=basepath+'searchquery?'+search;
      
       /* $.get(basepath+'searchquery?'+tests,function(data){
 
        });*/
    });

});


function refreshInvestigation(basepath)
{
	var formDataserialize = $("#searchInvestigation" ).serialize();
			formDataserialize = decodeURI(formDataserialize);
			console.log(formDataserialize);

			var formData = {formDatas: formDataserialize};
			var type = "POST"; //for creating new resource
			var urlpath = basepath+'home/repopulateInvestigation';

		$.ajax({
           type: type,
	        url: urlpath,
	        data: formData,
	        dataType: 'html',
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            success: function (result) {
                console.log(result);
                $("#drpdwn_investigation").html(result);
                $('.selectpicker').selectpicker();
               


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