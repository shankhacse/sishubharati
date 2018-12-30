$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;

 $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });
   $('.selectpicker').selectpicker();

    /* submit admission form*/

      $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

      $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 


 $(document).on('submit','#EventsForm',function(event)
    {
        event.preventDefault();
        if(validateEvents())
        {   
        
      
          
          
            var formData = new FormData($(this)[0]);
            $("#eventssavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'events/saveEvents',
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
                        var addurl = basepath + "events/addEvents";
                        var listurl = basepath + "events";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#notice_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#eventssavebtn").css({
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
    $(document).on("click", ".eventsstatus", function() {
    var uid = $(this).data("eventsid");
        var status = $(this).data("setstatus");
        var url = basepath + 'events/setStatus';
        setActiveStatus(uid, status, url);

    });

/*delete notice*/
   $(document).on("click", ".deleteevent", function() {
      var eventid = $(this).data("eventid");
      var docid = $(this).data("docid");
      var urlpath = basepath + 'events/deleteEvent';
      if (confirmeventdelete()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {eventid:eventid,docid:docid},
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




function validateEvents()
{
    var eventstitle = $("#eventstitle").val();
    var eventplace = $("#eventplace").val();
    var eventdate = $("#eventdate").val();
    var eventtime = $("#eventtime").val();
    var filename = $("#fileName_0_1").val();


  

    $("#eventsmsg").text("").css("dispaly", "none").removeClass("form_error");



    if(eventstitle=="")
    {
        $("#eventstitle").focus();
        $("#eventsmsg")
        .text("Error : Enter Event Title")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

  if(eventplace=="")
    {
        $("#eventplace").focus();
        $("#eventsmsg")
        .text("Error : Enter Event Place")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(eventdate=="")
    {
        $("#eventdate").focus();
        $("#eventsmsg")
        .text("Error : Select Event Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(eventtime=="")
    {
        $("#eventtime").focus();
        $("#eventsmsg")
        .text("Error : Select Event Time")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(filename=="")
    {
        $("#fileName_0_1").focus();
        $("#eventsmsg")
        .text("Error : Please Upload Event Poster")
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


