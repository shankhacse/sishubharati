$(document).ready(function(){
	var basepath = $("#basepath").val();

	
	$(document).on('submit','#UploadFeesForm',function(e){
		e.preventDefault();

		if(validateUploadFees())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#UploadFeesForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'uploadfee/saveFees';
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
                        var addurl = basepath + "uploadfee/adduploadfees";
                        var listurl = basepath + "uploadfee";
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
	
	


//on change payment history
$(document).on('change','#sel_term',function(){
        var sel_term = $("#sel_term").val();

        $("#uploadfeeslist").html('');
        $(".dashboardloader").css("display","block");
        $.ajax({
            type: "POST",
            url: basepath+'uploadfee/getUploadFeesByTerm',
            dataType: "html",
            data: {sel_term:sel_term},
            success: function (result) {
              $(".dashboardloader").css("display","none");
               $("#uploadfeeslist").html(result);
                 $('.dataTables').DataTable();
                
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


    /* edit class roll of student*/

    $(document).on('click','.edituploadfeeamt',function(){
        var detailsid = $(this).data('detailsid');
        var classname = $(this).data('classname');
        var mode = $(this).data('mode');
        var term = $(this).data('term');
        var amount = $(this).data('amount');
      

         $('#term').html(term);
         $('#classname').html(classname);

         $('#amount').val(amount);
         $('#uploadfeedtlid').val(detailsid);
        
      
    });



 // Listing Student for attendance
    $(document).on("click","#amtupd",function(event){
        event.preventDefault();
        var amount = $("#amount").val();
        $("#amt_response_msg").html('');
        if(amount!='')
        {
            var formDataserialize = $("#updateUploadFeeForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
           
          
            $.ajax({
                type: "POST",
                url: basepath+'uploadfee/UpdateUploadFeeIndviduals',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                    
                 if(result.msg_status==1)
                {
                    
         $("#amt_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
               location.reload();
             
                }
                if(result.msg_status==0)
                {
                    $("#amt_response_msg").html('<span class="glyphicon glyphicon-remove"></span>'+result.msg_data);
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
                       // alert(msg);  
                    }
                }); /*end ajax call*/

        }

    });
   

});// end of document ready


 function validateUploadFees()
    { 
        var sel_term = $("#sel_term").val();
        var rownumfee = $("#rownumfee").val();

    $("#feesmsg").text("").css("dispaly", "none").removeClass("form_error");

            if(sel_term=="0")
                        {   
                         $("#feesmsg")
                            .text("Error : Select Term")
                            .addClass("form_error")
                            .css("display", "block");
                            $("#sel_term").addClass('error-border');
                            return false;
              }


         for(var i=0;i<rownumfee;i++){
   
             var uploadfee = $("#uploadfee_"+i).val();
             
             $("#uploadfee_"+i).removeClass("error-border");
             if(uploadfee=="")
                {   
                 $("#feesmsg")
                    .text("Error : Enter  amount")
                    .addClass("form_error")
                    .css("display", "block");
                    $("#uploadfee_"+i).addClass('error-border');
                    return false;
                }
        }



return true;
}


