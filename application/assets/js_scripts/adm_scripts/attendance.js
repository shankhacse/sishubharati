$(document).ready(function(){
	var basepath = $("#basepath").val();
       $('#datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap',
                     'setDate': 'today'

                    });

var view_by = $("#view_by").val();
 if (view_by=='M') {
        $("#month_view").show();
       }else{
        $("#month_view").hide();
       }

	 // Listing Student for attendance
    $(document).on("submit","#AttendanceForm",function(event){
        event.preventDefault();

        if(1)
        {
            var formDataserialize = $("#AttendanceForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'attendance/getStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
                     /*$('.dataTables').DataTable({
                         "ordering": false
                    });*/
                     $('#datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap',
                     'setDate': 'today'

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

        }

    });


$(document).on('submit','#StudentAttendanceForm',function(e){
		e.preventDefault();
	
		if(chkvalidation())
		{
			
			//$("#district").removeAttr("disabled");
            var formDataserialize = $("#StudentAttendanceForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'attendance/saveAttendance';
            $("#attendanceSave").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
            $("#attmsg").css("display","none").text("");

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
                        var addurl = basepath + "attendance/addattendance";
                        var listurl = basepath + "attendance";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
						$("#attmsg").css('display', 'block');
                        $("#attmsg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#attendanceSave").css({
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

 // Listing Student for attendance register
    $(document).on("submit","#AttendanceRegisterForm",function(event){
        event.preventDefault();

        if(1)
        {
            var formDataserialize = $("#AttendanceRegisterForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'attendance/getRegisterStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
                     /*$('.dataTables').DataTable({
                         "ordering": false
                    });*/
                     $('#datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap',
                     'setDate': 'today'

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

        }

    });
/* Attendance Update model*/
$(document).on('click','.updtAttendance',function(){
        var attdetid = $(this).data('attdetid');
        var attstatus = $(this).data('attstatus');
        var student = $(this).data('student');
        var studentunqid = $(this).data('studentunqid');
       
        $('#attdetailsid').val(attdetid);
        $('#stname').html(student);
        $('input:radio[name="attUpdt"][value="' +attstatus+ '"]').attr('checked',true);
    });

/* Update Attendance of student*/
$(document).on('click','#updtAttendancebtn',function(){
        var attdetailsid = $("#attdetailsid").val();
        var attUpdt = $("input[name='attUpdt']:checked").val();
   
        $.ajax({
            type: "POST",
            url: basepath+'attendance/updateAttendance',
            dataType: "html",
            data: {attdetailsid:attdetailsid,attUpdt:attUpdt},
            success: function (result) {
               $("#AttendanceRegisterForm").submit();
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

 // Listing Student for attendance percentage
    $(document).on("submit","#AttendancePercentageForm",function(event){
        event.preventDefault();

        if(1)
        {
            var formDataserialize = $("#AttendancePercentageForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'attendance/getPescentageStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
                     /*$('.dataTables').DataTable({
                         "ordering": false
                    });*/
                     $('#datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap',
                     'setDate': 'today'

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

        }

    });

/*attendance details model*/
$(document).on('click','.viewattendainfo',function(){
        var studentid = $(this).data('studentid');
        var studentname = $(this).data('studentname');
        var selectclass = $(this).data("selectclass");
        var selectmonth = $(this).data("selectmonth");

        $.ajax({
            type: "POST",
            url: basepath+'attendance/getAttendanceDetailStudent',
            dataType: "html",
            data: {studentid:studentid,studentname:studentname,selectclass:selectclass,selectmonth:selectmonth},
            success: function (result) {
                $("#st_name").html(studentname);
                $("#detail_information_view").html(result);
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

    // Set Status
    $(document).on("change", "#view_by", function() {
       var view_by = $("#view_by").val();

       if (view_by=='M') {
        $("#month_view").show();
       }else{
        $("#month_view").hide();
       }

    });


  }); //end of document ready

function chkvalidation(){


     var attendance_date = $("#datepicker").val();
	
	
    if(attendance_date=="")
    {
        $("#attendance_manual_err_msg").css("display","block").text("Error : Select Attendance Date");
        return false;
    }
    $("#attendance_manual_err_msg").css("display","none").text("");
    return true;
}