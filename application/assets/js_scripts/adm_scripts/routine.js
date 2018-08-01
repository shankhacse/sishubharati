$(document).ready(function(){
	var basepath = $("#basepath").val();
$('.selectpicker').selectpicker({dropupAuto: false});
	
	$(document).on('submit','#RoutineForm',function(e){
		e.preventDefault();
	
		if(validateRoutine())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#RoutineForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'routine/saveRoutine';
            $("#routinesavebtn").css('display', 'none');
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
                        var addurl = basepath + "routine/addroutine";
                        var listurl = basepath + "routine";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#routinemsg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#routinesavebtn").css({
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



     // For Listing Routine by Class
    $(document).on("submit","#RoutineListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#RoutineListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'routine/getRoutineList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadroutineList").html(result);
                    $('.dataTables').DataTable({
                         "ordering": false
                    });
                   
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
	

});



function validateRoutine()
{
    var sel_class = $("#sel_class").val();
    var rownum = $("#rownum").val();


    $("#routinemsg").text("").css("dispaly", "none").removeClass("form_error");
     $("#clserr").removeClass("error-border");
    if(sel_class=="0")
    {
       // $("#admtype").focus();
        $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#clserr").addClass('error-border');
        return false;
    }

 for(var i=0;i<rownum;i++){
    
    var sel_subfirst = $("#sel_subfirst_"+i).val();
    var sel_subsecond = $("#sel_subsecond_"+i).val();
    var sel_subthird = $("#sel_subthird_"+i).val();
    var sel_subfourth = $("#sel_subfourth_"+i).val();
    var sel_subfifth = $("#sel_subfifth_"+i).val();
    var sel_subsixth = $("#sel_subsixth_"+i).val();
    $("#sel_subfirsterr_"+i).removeClass("error-border");
    $("#sel_subseconderr_"+i).removeClass("error-border");
    $("#sel_subthirderr_"+i).removeClass("error-border");
    $("#sel_subfourtherr_"+i).removeClass("error-border");
    $("#sel_subfiftherr_"+i).removeClass("error-border");
    $("#sel_subsixtherr_"+i).removeClass("error-border");
    
    if(sel_subfirst=="0")
    {   
     $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subfirsterr_"+i).addClass('error-border');
        return false;
    }
    if(sel_subsecond=="0")
    {    
        $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subseconderr_"+i).addClass('error-border');
        return false;
    }   
    if(sel_subthird=="0")
    {   
    
    $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subthirderr_"+i).addClass('error-border');
        return false;
    }
    if(sel_subfourth=="0")
    {   
     $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subfourtherr_"+i).addClass('error-border');
        return false;
    } 
    if(sel_subfifth=="0")
    {  
      $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subfiftherr_"+i).addClass('error-border');
        return false;
    } 
    if(sel_subsixth=="0")
    {    $("#routinemsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subsixtherr_"+i).addClass('error-border');
        return false;
    }

 }
   
 
    return true;
}