$(document).ready(function(){
	var basepath = $("#wbbasepath").val();

	$(document).on("keydown","#srch_pincode",function(){
        var path = basepath+'home/getPincodeAutocomplet';
        getAutoComplete('srch_pincode',path); // commonutilfunc.js

         // refreshInvestigation(basepath);
        //$("#selected_items_ul").empty();
    });

    /*
	$(document).on("blur","#srch_pincode",function(){
		var pcode = $(this).val();
		var path = basepath+'home/getInvestigationsbyPin';
      
        $.ajax({
            type: "POST",
            url:path,
            dataType: "html",
            data: {pcode:pcode},
            success: function (result) {
                $("#drpdwn_investigation").html(result);
               $('#sel_investigation').selectpicker("show");
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
        }); 

    });

    */


    $(document).on("click","#add_investigation",function(){
    	var selected_test = $("#sel_investigation").val();
    	var selected_test_text = $("#sel_investigation :selected").text();

    	var dynamic_test = '';
       


    	dynamic_test+='<li>';
      /*  dynamic_test+='<input type="hidden" name="tests[]" class="investigation_code" value="'+selected_test+'"/>' */
    	dynamic_test+='<input type="hidden" name="name[]" class="name" value="'+selected_test_text+'"/>'
    	dynamic_test+= selected_test_text;
    	dynamic_test+=' <a href="javascript:;" class="clear_selected_test" data-mode="First" > <i class="fa fa-times" style="color:#FFF;"></i></a></li>';
    	
    	if(selected_test.length>0)
    	{
    		$("#selected_items_ul").append(dynamic_test);
    	}

    	
    	
    	$("#sel_investigation").val('default');
		$("#sel_investigation").selectpicker("refresh");
    	

		refreshInvestigation(basepath);

    });

    $(document).on('click','.clear_selected_test', function(){
        var mode = $(this).data('mode');
       if(mode=="More")
       {
            var lengths = ($('input[name="name[]"]').length);
           if(lengths>1)
           {
            $(this).parent().remove();
           }
       }
       else
       {
        $(this).parent().remove();
       }
    	
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