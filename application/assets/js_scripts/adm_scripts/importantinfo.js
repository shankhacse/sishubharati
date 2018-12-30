$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;


   $('.selectpicker').selectpicker();

    /* submit admission form*/

      $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

      $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 


 $(document).on('submit','#informationForm',function(event)
    {
        event.preventDefault();
        if(validateInfo())
        {   
        
      
          
          
            var formData = new FormData($(this)[0]);
            $("#infosavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'importantinfo/saveInfo',
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
                        var addurl = basepath + "importantinfo/addInfo";
                        var listurl = basepath + "importantinfo";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#info_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#infosavebtn").css({
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

// Set Status
    $(document).on("click", ".infostatus", function() {
    var uid = $(this).data("infoid");
        var status = $(this).data("setstatus");
        var url = basepath + 'importantinfo/setStatus';
        setActiveStatus(uid, status, url);

    });

/*delete notice*/
   $(document).on("click", ".deleteinfo", function() {
      var infoid = $(this).data("infoid");
      var docid = $(this).data("docid");
      var urlpath = basepath + 'importantinfo/deleteInfo';
      if (confirminfodelete()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {infoid:infoid,docid:docid},
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

   // check upload size
     $("input[type='file']").on("change", function () {
     if(this.files[0].size > 500000) {
       alert("Please upload file less than 500KB. Thanks!!");
       $(this).val('');
     }
    });
     
});// end of document ready




function validateInfo()
{
    var infotitle = $("#infotitle").val();
    
    var filename = $("#fileName_0_1").val();


  

    $("#infomsg").text("").css("dispaly", "none").removeClass("form_error");



    if(infotitle=="")
    {
        $("#infotitle").focus();
        $("#infomsg")
        .text("Error : Enter Information Title")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

 
     if(filename=="")
    {
        $("#fileName_0_1").focus();
        $("#infomsg")
        .text("Error : Please Upload document")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
 
    return true;
}

function confirminfodelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}
