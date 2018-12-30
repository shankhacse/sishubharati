$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;



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
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'teacher/saveTeacher',
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
                        var addurl = basepath + "teacher/saveTeacher";
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
    var teacher = $("#teacher").val();
    var subject = $("#subject").val();
    var filename = $("#userFileName_0_1").val();


  

    $("#teachermsg").text("").css("dispaly", "none").removeClass("form_error");



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
    
 
    return true;
}

function confirmeventdelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}


