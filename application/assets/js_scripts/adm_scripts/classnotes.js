$(document).ready(function(){
	var basepath = $("#basepath").val();
    var rowNoUpload = 0;

 


     /* add subject paper scan model*/


 $(document).on('click','.classnotespdf',function(){
        var classnoteid = $(this).data('classnoteid');
        var mode = $(this).data('mode');
        var classname = $(this).data('classname');
        var year = $(this).data('year');

        
        $.ajax({
            type: "POST",
            url: basepath+'classnotes/ClassnoteListUploadview',
            dataType: "html",
            data: {classnoteid:classnoteid,mode:mode,classname:classname,year:year},
            success: function (result) {
                $("#term_name").html(classname+" - "+year);
                $("#detail_information_view").html(result);
                $('.selectpicker').selectpicker();
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
    $(document).on("click", ".resultpublishstatus", function() {
		var uid = $(this).data("publishid");
        var status = $(this).data("setstatus");
        var url = basepath + 'publishresult/setStatus';
        setActiveStatus(uid, status, url);

    });


    	// Set Status wesite publish list
    $(document).on("click", ".webpublishstatus", function() {
		var uid = $(this).data("publishid");
        var status = $(this).data("setstatus");
        var url = basepath + 'publishresult/setStatusWebPublish';
        setActiveStatus(uid, status, url);

    });


    /*  -------------------------- class notes upload script -------------------------------------*/
// Add Document Detail
    $(document).on('click','.addDocument',function(){
        rowNoUpload++;
        $.ajax({
            type: "POST",
            url: basepath+'classnotes/adddetaildocument',
            dataType: "html",
            data: {rowNo:rowNoUpload},
            success: function (result) {

                $("#detail_Document table").css("display","block"); 
                $("#detail_Document table tbody").append(result);   

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
    }); // End Document Detail

    // Delete Table Row

    $(document).on('click','.delDocType',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        $("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
    });
    
    $(document).on('change','.fileName',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var IDSNo = rowDtlNo[1]+"_"+rowDtlNo[2];
        //var inpID = "#isChangedFile_"+rowDtlNo[1]+"_"+rowDtlNo[2];
        
        var newfileName = $("#fileName_"+IDSNo)[0].files[0].name;
        var prvVal = $("#prvFilename_"+IDSNo).val();

        if(newfileName!=prvVal)
        {
            $("#isChangedFile_"+IDSNo).val('Y');
        }

    });

    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
   
    $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 





    /* submit admission form*/

 $(document).on('submit','#classnotesForm',function(event)
    {
        event.preventDefault();
        if(1)
        {   
        
        if(detailDocumentValidation())
        {
        
            
          
            var formData = new FormData($(this)[0]);
            $("#classnotessavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
            $("#classnotes_response_msg").html('');

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'classnotes/saveClassNotes',
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    
               
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#classnotessavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });

                 if(result.msg_status==1)
                {
                    $("#classnotes_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    $("#loaderbtn").css('display', 'none');     
                    
                }
                if(result.msg_status==0)
                {
                    $("#classnotes_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
                    $("#loaderbtn").css('display', 'none'); 
                }

                 location.reload();
                  
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

          }  // end detail validation
        }   // end master validation
        
    });
	

}); // end of document ready



function detailDocumentValidation()
{
    var isValid = true;
    $('.docType').each(function() 
    {
        var doctype_id = $(this).attr('id');
        var docTypeIDS = doctype_id.split("_");
        var docTypeVal = $(this).val();
        console.log(doctype_id);

        var tdIDS = "#docType_"+docTypeIDS[1]+"_"+docTypeIDS[2];
        var tdIDS2 = "#userFileName_"+docTypeIDS[1]+"_"+docTypeIDS[2];
        var tdIDS3 = "#fileDesc_"+docTypeIDS[1]+"_"+docTypeIDS[2];

        var filename = $(tdIDS2).val();
        var subject = $(tdIDS3).val();

        $(tdIDS).removeAttr("title");
        $(tdIDS).css("background","inherit");

        $(tdIDS2).removeAttr("title");
        $(tdIDS2).css("background","inherit");

        $(tdIDS3).removeAttr("title");
        $(tdIDS3).css("background","inherit");

        if(docTypeVal==0)
        {
            $(tdIDS).attr("title","Select Doc Type");
            $(tdIDS).css("background","#FFD2D2");

            isValid = false;
        }

        if(filename=="")
        {
            $(tdIDS2).attr("title","Select Document");
            $(tdIDS2).css("background","#FFD2D2");

            isValid = false;
        }

        if(subject=="")
        {
            $(tdIDS3).attr("title","Enter Subject");
            $(tdIDS3).css("background","#FFD2D2");

            isValid = false;
        }
    });

    return isValid;
}


