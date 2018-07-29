$(document).ready(function(){
    var basepath = $("#basepath").val();
    var rowNoUpload = 0;
    //alert(basepath);
    $( ".datepicker" ).datepicker();
        //Datemask dd/mm/yyyy
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

   $('.selectpicker').selectpicker();





    /* On select admission select class */
    $(document).on("change", "#admtype", function() {
        var val=$('select[name=admtype]').val();

       
    $.ajax({
    type: "POST",
    url: basepath+'admission/getClass',
    data: {admtypeid:val},
    
    success: function(data){
        $("#classview").html(data);
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



    });/*end ajax call*/

    });


     /* On select admission select class */
    $(document).on("change", "#sel_class", function() {
        var sel_class=$('select[name=sel_class]').val();

       
    $.ajax({
    type: "POST",
    url: basepath+'admission/getClassRoll',
    data: {classid:sel_class},
    
    success: function(data){
        
        $("#classroll").val(data);
        
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



    });/*end ajax call*/

    });



    /* submit admission form*/

 $(document).on('submit','#AdmissionForm',function(event)
    {
        event.preventDefault();
        if(validateAdmission())
        {   
        
        if(detailDocumentValidation())
        {
        
            
          
            var formData = new FormData($(this)[0]);
            $("#admsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'admission/saveStudent',
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
                        var addurl = basepath + "admission/addStudent";
                        var listurl = basepath + "admission";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#cls_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#admsavebtn").css({
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

          }  // end detail validation
        }   // end master validation
        
    });




// Add Document Detail
    $(document).on('click','.addDocument',function(){
        rowNoUpload++;
        $.ajax({
            type: "POST",
            url: basepath+'admission/adddetaildocument',
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

   $(document).on("click",".studentDocDtl",function(){

            var id = $(this).data("studentid");
            var mode = $(this).data("studentdtlmode");
            var studentname = $(this).data("studentname");
            var path = basepath+"admission/getDetailStudentModal";
            getDetailModalView(id,mode,studentname,path);
        });
    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 



 $('#studentlist').DataTable({
    
    "fixedHeader": {
            header: true,
            footer: true
        },
      
     "orderCellsTop": true,
   
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        "aaSorting": [],
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [0] /* 1st one, start by the right */
            }],
        initComplete: function () {
            this.api().columns([1,2,3,4]).every( function () {
                var column = this;
                var select = $('<select class="form_input_text selectpicker" data-live-search="true"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                $('.selectpicker').selectpicker('refresh');
            } );
            
        }

/*********************************/


});

  


 $('#studentlist tfoot tr').insertBefore($('#studentlist thead tr'));






}); // end of document ready


function validateAdmission()
{
    var adtype = $("#admtype").val();
    var sel_class = $("#sel_class").val();
    var dtadm = $("#dtadm").val();
    var studentname = $("#studentname").val();
    var studentgender = $("#studentgender").val();
    var studentdob = $("#studentdob").val();
    var category = $("#category").val();
    var bloodgroup = $("#bloodgroup").val();
 

  

    $("#admmsg").text("").css("dispaly", "none").removeClass("form_error");

    if(adtype=="0")
    {
       // $("#admtype").focus();
        $("#admmsg")
        .text("Error : Select Admission Type")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

     if(sel_class=="0")
    {
       // $("#admtype").focus();
        $("#admmsg")
        .text("Error : Select Class")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(dtadm=="")
    {
        $("#dtadm").focus();
        $("#admmsg")
        .text("Error : Select Admission Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(studentname=="")
    {
        $("#studentname").focus();
        $("#admmsg")
        .text("Error : Enter  Student Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(studentgender=="0")
    {
        $("#studentgender").focus();
        $("#admmsg")
        .text("Error : Select Gender")
        .addClass("form_error")
        .css("display", "block");
        return false;
    } 
    if(studentdob=="")
    {
        $("#studentdob").focus();
        $("#admmsg")
        .text("Error : Enter Student Birth Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    } 
    if(category=="0")
    {
        $("#category").focus();
        $("#admmsg")
        .text("Error : Enter Student Birth Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    } 
    if(bloodgroup=="0")
    {
        $("#category").focus();
        $("#admmsg")
        .text("Error : Select Blood Group")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
 
    return true;
}

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

        var filename = $(tdIDS2).val();

        $(tdIDS).removeAttr("title");
        $(tdIDS).css("background","inherit");

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
    });

    return isValid;
}

function getDetailModalView(id,mode,info,path)
{
     $.ajax({
            type: "POST",
            url: path,
            dataType: "html",
            data: {mid:id,mode:mode,info:info},
            success: function (result) {
               $("#detailListmodalView").html(result);
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