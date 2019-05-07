$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');


/*rank wise student list by class*/

   
    $(document).on("submit","#TemperRankForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TemperRankForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'temperrank/classStudentListRankWise',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentList").html(result);
                 
                   
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


 $(document).on('submit','#UpdateTemperRankForm',function(e){
		e.preventDefault();
	

			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#UpdateTemperRankForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'temperrank/UpdateTemperStudentRank';
            $("#saverank").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
				if(result.msg_status==1)
				{
					
         $("#ranksave_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
				$('#TemperRankForm').submit();
                }
				if(result.msg_status==0)
				{
					$("#ranksave_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}	 

					 $("#loaderbtn").css('display', 'none');
					// window.location.replace(basepath+"generaterank");
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
			
			
	

	});

 $(document).on("input", ".temprank", function() {
 var all_list = $("input[name='rank[]']")
              .map(function(){return $(this).val();}).get();

             var duplicates_list = [];
    var unique_list = [];
    $.each(all_list, function(key, value){
            if($.inArray(value, unique_list ) == -1){
                unique_list.push(value);
            }else{
                if($.inArray(value, duplicates_list ) == -1){
                    duplicates_list.push(value);
                }
            }
    });
    console.log(duplicates_list);
   
    $("#saverank").css('display', 'block');
    for(var i=0;i<all_list.length;i++){
       $("#temp_rank_"+i).removeClass("error-border");
      if(jQuery.inArray(all_list[i], duplicates_list) != -1) {
       console.log("temp_rank_"+i);
       $("#temp_rank_"+i).addClass("error-border");
       $("#saverank").css('display', 'none');

}
}


});



});

//end of document ready


function confirmrankdelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}