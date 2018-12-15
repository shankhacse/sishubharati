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


 $(document).on('submit','#GalleryForm',function(event)
    {
        event.preventDefault();
        if(validateImage())
        {   
        
      
          
          
            var formData = new FormData($(this)[0]);
            $("#gallerysavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'gallery/saveImage',
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
                        var addurl = basepath + "gallery/addImage";
                        var listurl = basepath + "gallery";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#gallery_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#gallerysavebtn").css({
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
   $(document).on("click", ".deleteimage", function() {
      var galleryid = $(this).data("galleryid");
      var docid = $(this).data("docid");
      var urlpath = basepath + 'gallery/deleteGallery';
      if (confirmimagedelete()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {galleryid:galleryid,docid:docid},
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
});// end of document ready




function validateImage()
{
    var album = $("#album").val();
    
    var filename = $("#fileName_0_1").val();


  

    $("#gallerymsg").text("").css("dispaly", "none").removeClass("form_error");



    if(album=="0")
    {
        $("#album").focus();
        $("#gallerymsg")
        .text("Error : Select album")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

 
    if(filename=="")
    {
        $("#fileName_0_1").focus();
        $("#gallerymsg")
        .text("Error : Please Upload an Image")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
 
    return true;
}

function confirmimagedelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}


