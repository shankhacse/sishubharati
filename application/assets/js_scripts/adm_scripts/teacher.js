$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;
    $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });
    //Timepicker
    $('.timepickers').timepicker({
        //defaultTime: '08:00 AM',
        defaultTime: '',
        minuteStep: 1
        });

    //Datemask dd/mm/yyyy
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

 $("#nonstaff_view").hide();
        // chech view by
    $(document).on("change", "#view_by", function() {
       var view_by = $("#view_by").val();

       if (view_by=='T') {
         $("#teacher_view").show();
         $("#nonstaff_view").hide();
       }else{
         $("#nonstaff_view").show();
         $("#teacher_view").hide();
       }

    });


    /* submit admission form*/

      $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

      $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 

      $(document).on('change','.fileName',function(){
       
        
        var newfileName = $("#fileName_0_1")[0].files[0].name;
        var prvVal = $("#prvFilename__0_1").val();

        if(newfileName!=prvVal)
        {
            $("#isChangedFile_0_1").val('Y');
        }

    });

 $(document).on('submit','#teacherForm',function(event)
    {
        event.preventDefault();
        if(validate())
        {   
 
            var formData = new FormData($(this)[0]);
            $("#teachersavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
            var sel_emptype = $("#sel_emptype").val();

            if(sel_emptype=='TEACHER'){

            }else{

            }
            var urlink=basepath+'teacher/saveTeacher'
    
        $.ajax({
                type: "POST",
                url: urlink,
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    
                    if (result.msg_status == 1) {
                            
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "teacher/addTeacher";
                        var listurl = basepath + "teacher";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#teacher_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#teachersavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });
                  
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

        }   // end master validation
        
    });

 $("input[type='file']").on("change", function () {
  var derault_profile_src = $("#derault_profile_src").val();

     if(this.files[0].size > 500000) {
       alert("Please upload file less than 500KB. Thanks!!");
       $(this).val('');
       $('#profile_img').attr('src',derault_profile_src);
     }else{
       readURL(this);
     }
    });

// Set Status
    $(document).on("click", ".teacherstatus", function() {
    var uid = $(this).data("teacherid");
        var status = $(this).data("setstatus");
        var url = basepath + 'teacher/setStatus';
        setActiveStatus(uid, status, url);

    });



         // Listing Student for attendance
    $(document).on("submit","#TeacherAttendanceForm",function(event){
        event.preventDefault();
        var validate=false;
        var sel_emptype = $("#view_by").val();
        var sel_teacher = $("#sel_teacher").val();
        var sel_nonstaff = $("#sel_nonstaff").val();
        console.log(sel_emptype);
        if (sel_emptype=='T') {
             if(sel_teacher>0){validate=true;}else{validate=false;}
         }else{
             if(sel_nonstaff>0){validate=true;}else{validate=false;}
         }
                

        if(validate)
        {
            var formDataserialize = $("#TeacherAttendanceForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
           $("#loadteacherdetails").html('');
            $.ajax({
                type: "POST",
                url: basepath+'teacher/getTeacherDetails',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadteacherdetails").html(result);
                     /*$('.dataTables').DataTable({
                         "ordering": false
                    });*/
                     $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap',
                     'setDate': 'today'

                    });

                       //Timepicker
                        $('.timepickers').timepicker({
                            //defaultTime: '08:00 AM',
                            defaultTime: '',
                            minuteStep: 1
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

 $(document).on('submit','#teacherAttendanceEntry',function(event)
    {
        event.preventDefault();
        if(validateAttendance())
        {   
        
      
          
          
            var formData = new FormData($(this)[0]);
            $("#teacherattsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'teacher/saveAttendance',
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    
                    if (result.msg_status == 1) {
                            
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "teacher/attendance";
                        var listurl = basepath + "teacher/register";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#teacheratt_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#teacherattsavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });
                  
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

        }   // end master validation
        
    });



  // Listing Student for attendance register
    $(document).on("submit","#TeacherAttendanceRegisterForm",function(event){
        event.preventDefault();

        if(validateRegister())
        {
            var formDataserialize = $("#TeacherAttendanceRegisterForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");
              $("#loadteacherList").html('');

            $.ajax({
                type: "POST",
                url: basepath+'teacher/getTeacherAttendanceList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadteacherList").html(result);
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




/*delete subject of a class*/
   $(document).on("click", ".deleteattteacher", function() {
      var teacherattid = $(this).data("attid");
     
      var urlpath = basepath + 'teacher/deleteTeacherAttendance';
      if (confirmeventdeleteteacheratt()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {teacherattid:teacherattid},
      dataType: 'json',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
      success: function (result) {
        if(result.msg_status=1)
        {
         // location.reload();
         $("#TeacherAttendanceRegisterForm").submit();
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


});// end of document ready


/* Preview Impage in Imagebox*/

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();


    reader.onload = function(e) {
      $('#profile_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

function validate()
{
    var sel_emptype = $("#sel_emptype").val();
    var teacher = $("#teacher").val();
    var teacherdob = $("#teacherdob").val();
    var subject = $("#subject").val();
    var filename = $("#userFileName_0_1").val();
    


  

    $("#teachermsg").text("").css("dispaly", "none").removeClass("form_error");

    if(sel_emptype=="0")
    {
        $("#sel_emptype").focus();
        $("#teachermsg")
        .text("Error : Select Employee Type")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(teacher=="")
    {
        $("#teacher").focus();
        $("#teachermsg")
        .text("Error : Enter Teacher Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }


    if(subject=="")
    {
        $("#subject").focus();
        $("#teachermsg")
        .text("Error : Enter Teacher Subject")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
  

    if(filename=="")
    {
        $("#fileName_0_1").focus();
        $("#teachermsg")
        .text("Error : Please Upload Profile Picture")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(teacherdob=="")
    {
        $("#teacherdob").focus();
        $("#teachermsg")
        .text("Error : Enter Teacher Date of Birth")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
 
    return true;
}

function confirmeventdelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}

function confirmeventdeleteteacheratt()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}


function validateAttendance()
{
    
    var attdate = $("#attdate").val();
    var intime = $("#intime").val();
    var outtime = $("#outtime").val();





    $("#teacherattmsg").text("").css("dispaly", "none").removeClass("form_error");



    if(attdate=="")
    {
        $("#attdate").focus();
        $("#teacherattmsg")
        .text("Error : Enter Attendance Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

   if(intime=="")
    {
        //$("#intime").focus();
        $("#teacherattmsg")
        .text("Error : Enter In time")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(outtime=="")
    {
       // $("#outtime").focus();
        $("#teacherattmsg")
        .text("Error : Enter Out time")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
 
    return true;
}


function validateRegister()
{
    
    var fromdate = $("#fromdate").val();
    var todate = $("#todate").val();






    $("#teacherattregmsg").text("").css("dispaly", "none").removeClass("form_error");



    if(fromdate=="")
    {
        $("#fromdate").focus();
        $("#teacherattregmsg")
        .text("Error : Enter From Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(todate=="")
    {
        $("#todate").focus();
        $("#teacherattregmsg")
        .text("Error : Enter To Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
 
    return true;
}




