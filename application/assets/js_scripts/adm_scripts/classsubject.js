$(document).ready(function(){
    var basepath = $("#basepath").val();
 

   $('.selectpicker').selectpicker();



/*subject list by class*/

   
    $(document).on("submit","#ClassSubjectForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#ClassSubjectForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadsubjectList").html('');
            if (validateSelectSubject()) {
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'classsubject/classSubjectList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadsubjectList").html(result);
                     $('.selectpicker').selectpicker();
                   
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

          }//end if

       

    });



// set written and oral marks
      $(document).on('change','.sfullmarks',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var select_fulmarks=$('#sel_fullmarks_'+rowDtlNo[2]).val();
        var written_marks,oral_marks;
        var sel_wr=$('#sel_wr_'+rowDtlNo[2]).val();

        $('#sel_writtenmarks_'+rowDtlNo[2]).val("");
        $('#sel_oralmarks_'+rowDtlNo[2]).val("");

              if (select_fulmarks==100) {
                if (sel_wr=='wo') {
                    written_marks=80;
                    oral_marks=20;
                }else{
                    written_marks=100;
                    oral_marks=0;
                }
                  
                  $('#sel_writtenmarks_'+rowDtlNo[2]).val(written_marks);
                  $('#sel_oralmarks_'+rowDtlNo[2]).val(oral_marks);

              }else if (select_fulmarks==50) {
                   if (sel_wr=='wo') {
                    written_marks=40;
                    oral_marks=10;
                }else{
                    written_marks=50;
                    oral_marks=0;
                }
                  $('#sel_writtenmarks_'+rowDtlNo[2]).val(written_marks);
                  $('#sel_oralmarks_'+rowDtlNo[2]).val(oral_marks);


              }else if (select_fulmarks==25) {
                   if (sel_wr=='wo') {
                    written_marks=25;
                    oral_marks=0;
                }else{
                    written_marks=25;
                    oral_marks=0;
                }
                  $('#sel_writtenmarks_'+rowDtlNo[2]).val(written_marks);
                  $('#sel_oralmarks_'+rowDtlNo[2]).val(oral_marks);


              }
       
    });



  /* save subject into class*/

  $(document).on('submit','#classSubjectSaveForm',function(e){
    e.preventDefault();

    
      if(validateSubjectMarks())
      {
      
      //$("#district").removeAttr("disabled");
            var formDataserialize = $("#classSubjectSaveForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'classsubject/saveClassSubject';
            $("#clssubjectsavebtn").css('display', 'none');
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
                        var addurl = basepath + "classsubject";
                        var listurl = basepath + "classsubject/subjectList";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
          else {
                        $("#clssubmsg").text(result.msg_data);
                    }
          
                    $("#loaderbtn").css('display', 'none');
          
                    $("#clssubjectsavebtn").css({
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




  /* save single subject into class*/

  $(document).on('submit','#classSingleSubjectSaveForm',function(e){
    e.preventDefault();
if (validateSingleSubject()) {
    if(validateSubjectMarks())
    {
      
      //$("#district").removeAttr("disabled");
            var formDataserialize = $("#classSingleSubjectSaveForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'classsubject/saveSingleSubjectClass';
            $("#clssubjectsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
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
            });//end of ajax call
      
      
    }

  }

  });

  /* class subject edit model*/

  $(document).on('click','.subjectinfo',function(){
        var clssubmstid = $(this).data('clssubmstid');
        var classname = $(this).data('classname');
        var mode = $(this).data('mode');
       

        $.ajax({
            type: "POST",
            url: basepath+'classsubject/getSubjectDetails',
            dataType: "html",
            data: {clssubmstid:clssubmstid,mode:mode},
            success: function (result) {
                $("#class_name").html(classname);
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

  /* Update subject full marks*/
$(document).on('click','.updtsubjectfmarksbtn',function(){
       
        var assdtlid = $(this).data('assdtlid');
        var i = $(this).data('rownum');
       
        var sel_subfmarks = $("#sel_fullmarks_"+i).val();
        var sel_subwmarks = $("#sel_writtenmarks_"+i).val();
        var sel_subomarks = $("#sel_oralmarks_"+i).val();
        var sel_wr = $("#sel_wr_"+i).val();
      

        $.ajax({
            type: "POST",
            url: basepath+'classsubject/updateSubjectFullMarks',
            dataType: "html",
            data: {assdtlid:assdtlid,sel_subfmarks:sel_subfmarks,
              sel_subwmarks:sel_subwmarks,sel_subomarks:sel_subomarks,sel_wr:sel_wr},
            success: function (result) {
               //$("#AttendanceRegisterForm").submit();
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
    });


/*delete subject of a class*/
   $(document).on("click", ".dltsubjectbtn", function() {
      var assdtlid = $(this).data("assdtlid");
     
      var urlpath = basepath + 'classsubject/deleteSubject';
      if (confirmsubjectdelete()) {
        $.ajax({
      type: "POST",
      url:  urlpath,
      data: {assdtlid:assdtlid},
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

}); // end of document ready


function validateSelectSubject()
{
  
 
   var sel_subject = $('#sel_subject').val().length;

  $("#clssubcreatmsg").text("").css("dispaly", "none").removeClass("form_error");

  
  if(sel_subject=="0")
  {
    $("#sel_subject").focus();
    $("#clssubcreatmsg")
    .text("Error : Select Subjects")
    .addClass("form_error")
        .css("display", "block");
    return false;
  }

  
  return true;
}


function validateSubjectMarks()
{
   // var sel_class = $("#sel_class").val();
    var rownum = $("#rownum").val();
//alert(rownum);

    $("#clssubmsg").text("").css("dispaly", "none").removeClass("form_error");
  

 for(var i=1;i<rownum;i++){
    
    var sel_subfmarks = $("#sel_fullmarks_"+i).val();
    var sel_subwmarks = $("#sel_writtenmarks_"+i).val();
    var sel_subomarks = $("#sel_oralmarks_"+i).val();

  
    $("#sel_subfmarkserr_"+i).removeClass("error-border");
    $("#sel_subwmarkserr_"+i).removeClass("error-border");
    $("#sel_subomarkserr_"+i).removeClass("error-border");
   
    
    if(sel_subfmarks=="0")
    {   
     $("#clssubmsg")
        .text("Error : Select Full Marks")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subfmarkserr_"+i).addClass('error-border');
        return false;
    }
    if(sel_subwmarks=="")
    {    
        $("#clssubmsg")
        .text("Error : Enter written marks")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subwmarkserr_"+i).addClass('error-border');
        return false;
    }   
    if(sel_subomarks=="")
    {   
    
    $("#clssubmsg")
        .text("Error : Enter oral marks")
        .addClass("form_error")
        .css("display", "block");
        $("#sel_subomarkserr_"+i).addClass('error-border');
        return false;
    }
   
    
 }
   
 
    return true;
}



function confirmsubjectdelete()
{
  return confirm("Are you sure to delete this entry?");
//  return confirm("Sorry ! Permission denied");
}


function validateSingleSubject()
{
  
 
   var sel_subject = $('#sel_subject').val();

  $("#clssubmsg").text("").css("dispaly", "none").removeClass("form_error");

  
  if(sel_subject=="0")
  {
    $("#sel_subject").focus();
    $("#clssubmsg")
    .text("Error : Select Subject")
    .addClass("form_error")
        .css("display", "block");
    return false;
  }

  
  return true;
}
