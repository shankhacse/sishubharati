$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');


/*rank wise student list by class*/

   
    $(document).on("submit","#GenerateRankForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#GenerateRankForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'generaterank/classStudentListRankWise',
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


 $(document).on('submit','#GeneratedRankDataForm',function(e){
		e.preventDefault();
	

			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#GeneratedRankDataForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'generaterank/saveStudentRank';
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


 /*delete ranks of class*/
   $(document).on("click", ".deleteclassrank", function() {
      var rankmasterid = $(this).data("rankmasterid");
     
      var urlpath = basepath + 'generaterank/deleteClassRank';
      if (confirmrankdelete()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {rankmasterid:rankmasterid},
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

      }

    
      

    });

});//end of document ready


function confirmrankdelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}