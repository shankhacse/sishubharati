$(document).ready(function(){
	var basepath = $("#basepath").val();
  var rowNoUpload = 0;



	/*student list by class*/

   
    $(document).on("submit","#MarksEntryForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#MarksEntryForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadstudentList").html('');
          
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'exam/studentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
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
   

  });

  /* subject marks add model*/

  $(document).on('click','.addsubjectmarks',function(){
        var classid = $(this).data('classid');
        var classname = $(this).data('classname');
        var studentname = $(this).data('studentname');
        var academicid = $(this).data('academicid');
        var studentuniqid = $(this).data('studentuniqid');
        var mode = $(this).data('mode');
        var term = $(this).data('term');
       

        $.ajax({
            type: "POST",
            url: basepath+'exam/addSubjectmarks',
            dataType: "html",
            data: {classid:classid,mode:mode,term:term,academicid:academicid},
            success: function (result) {
                $("#student_name").html(studentname+" ("+studentuniqid+")");
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

 $(document).on('click','.editsubjectmarks',function(){
        var classid = $(this).data('classid');
        var classname = $(this).data('classname');
        var studentname = $(this).data('studentname');
        var academicid = $(this).data('academicid');
        var studentuniqid = $(this).data('studentuniqid');
        var mode = $(this).data('mode');
        var term = $(this).data('term');
        var marksmasterid = $(this).data('marksmasterid');
        
        $.ajax({
            type: "POST",
            url: basepath+'exam/editSubjectmarks',
            dataType: "html",
            data: {classid:classid,mode:mode,term:term,academicid:academicid,marksmasterid:marksmasterid},
            success: function (result) {
                $("#student_name").html(studentname+" ("+studentuniqid+")");
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

 /* add subject paper scan model*/


 $(document).on('click','.subjectpaper',function(){
        var classid = $(this).data('classid');
        var classname = $(this).data('classname');
        var studentname = $(this).data('studentname');
        var academicid = $(this).data('academicid');
        var studentuniqid = $(this).data('studentuniqid');
        var mode = $(this).data('mode');
        var term = $(this).data('term');
        var marksmasterid = $(this).data('marksmasterid');
        
        $.ajax({
            type: "POST",
            url: basepath+'exam/exampaperScan',
            dataType: "html",
            data: {classid:classid,mode:mode,term:term,academicid:academicid,marksmasterid:marksmasterid},
            success: function (result) {
                $("#student_name").html(studentname+" ("+studentuniqid+")");
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

// set total marks (written+oral)
      $(document).on('input','.obwrittenmarks,.oboralmarks',function(){
      //	
      
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
      //  var select_fulmarks=$(this).val();
      	if ($("#obtainwrittenmarks_"+rowDtlNo[1]).val()!="") {
      		 var written_marks= parseInt($("#obtainwrittenmarks_"+rowDtlNo[1]).val());
                     if (isNaN(written_marks)) {
                       written_marks=0;
                       }


      	}else{
      		var written_marks=0;
      	}
       
       if ($("#obtainoralmarks_"+rowDtlNo[1]).val()!="") {
       	 	var oral_marks=parseInt($("#obtainoralmarks_"+rowDtlNo[1]).val());
           
                    if (isNaN(oral_marks)) {
                       oral_marks=0;
                       }
       
       	}else{
       	 	var oral_marks=0;
       	}
       
        var total=written_marks+oral_marks;
        var totalfullmarks=$("#totalfullmarks_"+rowDtlNo[1]).val();

        $('#obtaintotalmarks_'+rowDtlNo[1]).val(total);

    $.ajax({
    type: "POST",
    url: basepath+'exam/getGrade',
    data: {totalmarks:total,totalfullmarks:totalfullmarks},
    
    success: function(data){
    	//alert(data);
        $('#grade_'+rowDtlNo[1]).val(data);
       
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


 /*save marks of student*/

 $(document).on('submit','#examMarksForm',function(e){
    e.preventDefault();
if (validateSubMarks()) {
  
     
      
            var formDataserialize = $("#examMarksForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'exam/saveExamMarks';
            $("#submarkssavebtn").css('display', 'none');
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
                         //location.reload();
                      
                        $('#subject_marks').modal('hide');
                        $('#MarksEntryForm').submit(); 
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

  });

    /*marks total student list by class*/

   
    $(document).on("submit","#MarksTotalForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#MarksTotalForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadstudentList").html('');
          
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'exam/marksTotalStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
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
   

  }); 

/* add special marks to student list by class*/

   
    $(document).on("click","#specialmarks",function(event){
        event.preventDefault();

           var formDataserialize = $("#MarksTotalForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadstudentList").html('');
          
            $(".dashboardloader").css("display","block");


            $.ajax({
                type: "POST",
                url: basepath+'exam/addspecialmarksStudentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadstudentList").html(result);
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
   

  }); 

// set grand total marks (first term+second term+third term+special marks)
      $(document).on('input','.specialmarks',function(){
      //    
      
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        //var special_marks=$(this).val();

         var firsttermpermarks= parseInt($("#firsttermpermarks_"+rowDtlNo[1]).val());
         var secondtermpermarks= parseInt($("#secondtermpermarks_"+rowDtlNo[1]).val());
         var thirdtermpermarks= parseInt($("#thirdtermpermarks_"+rowDtlNo[1]).val());
        if ($("#specialmarks_"+rowDtlNo[1]).val()!="") {
             var special_marks= parseInt($("#specialmarks_"+rowDtlNo[1]).val());
                     if (isNaN(special_marks)) {
                       special_marks=0;
                       }


        }else{
            var special_marks=0;
        }
       
        
       
        var grand_total=firsttermpermarks+secondtermpermarks+thirdtermpermarks+special_marks;
        

        $('#grandtotalmarks_'+rowDtlNo[1]).val(grand_total);
    
    
 });

/* save special marks*/

 $(document).on('submit','#specilaMarksForm',function(e){
    e.preventDefault();
if (validateSpecialMarks()) {
  
     
      
            var formDataserialize = $("#specilaMarksForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'exam/saveSpecialMarks';
            $("#submarkssavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                if(result.msg_status==1)
                {
                    $("#specialmarks_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    $("#loaderbtn").css('display', 'none');     
                    
                }
                if(result.msg_status==0)
                {
                    $("#specialmarks_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
                    $("#loaderbtn").css('display', 'none'); 
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

  });
/*  -------------------------- exam paper script -------------------------------------*/
// Add Document Detail
    $(document).on('click','.addDocument',function(){
        rowNoUpload++;
        $.ajax({
            type: "POST",
            url: basepath+'exam/adddetaildocument',
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



/* save sacn paper*/

    /* submit admission form*/

 $(document).on('submit','#paperscanForm',function(event)
    {
        event.preventDefault();
        if(1)
        {   
        
        if(detailDocumentValidation())
        {
        
            
          
            var formData = new FormData($(this)[0]);
            $("#paperscansavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
            $("#marks_response_msg").html('');

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'exam/saveScanExamPaper',
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    
               
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#paperscansavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });

                 if(result.msg_status==1)
                {
                    $("#marks_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
                    $("#loaderbtn").css('display', 'none');     
                    
                }
                if(result.msg_status==0)
                {
                    $("#marks_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
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
/*  ------------------------- end of exam paper script ----------------------------- */
/* term performance model*/
  $(document).on('click','.termparformance',function(){
        var marksmasterid = $(this).data('marksmasterid');
        var studentname = $(this).data('student');
        var studentuniqid = $(this).data('studentunqid');
        var term = $(this).data('term');
       

        $.ajax({
            type: "POST",
            url: basepath+'exam/termPerformanceData',
            dataType: "html",
            data: {marksmasterid:marksmasterid,studentname:studentname,term:term,studentuniqid:studentuniqid},
            success: function (result) {
                $("#stname").html(studentname+" ("+studentuniqid+")");
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

});//end of document ready



function validateSubMarks()
{
   // var sel_class = $("#sel_class").val();
    var rownum = $("#rownum").val();


    $("#marksmsg").text("").css("dispaly", "none").removeClass("form_error");
  

 for(var i=1;i<rownum;i++){
    
    var totalfullmarks = $("#totalfullmarks_"+i).val();
    var totwrittenmarks = $("#totwrittenmarks_"+i).val();
    var totoralmarks = $("#totoralmarks_"+i).val();

    var obtainwrittenmarks = $("#obtainwrittenmarks_"+i).val();
    var obtainoralmarks = $("#obtainoralmarks_"+i).val();
    var obtaintotalmarks = $("#obtaintotalmarks_"+i).val();

  
    $("#obtainwrittenmarks_"+i).removeClass("error-border");
    $("#obtainoralmarks_"+i).removeClass("error-border");
    $("#obtaintotalmarks_"+i).removeClass("error-border");
   
    
    if(obtainwrittenmarks=="")
    {   
     $("#marksmsg")
        .text("Error : Enter obtain written marks")
        .addClass("form_error")
        .css("display", "block");
        $("#obtainwrittenmarks_"+i).addClass('error-border');
        return false;
    }
    if(obtainoralmarks=="")
    {    
        $("#marksmsg")
        .text("Error : Enter obtain oral marks")
        .addClass("form_error")
        .css("display", "block");
        $("#obtainoralmarks_"+i).addClass('error-border');
        return false;
    }   
    if(obtaintotalmarks=="")
    {   
    
    $("#marksmsg")
        .text("Error : Enter total marks")
        .addClass("form_error")
        .css("display", "block");
        $("#obtaintotalmarks_"+i).addClass('error-border');
        return false;
    }

    if(parseInt(obtainwrittenmarks)>parseInt(totwrittenmarks))
    {   
     $("#marksmsg")
        .text("Error : Enter valid marks")
        .addClass("form_error")
        .css("display", "block");
        $("#obtainwrittenmarks_"+i).addClass('error-border');
        return false;
    }

    if(parseInt(obtainoralmarks)>parseInt(totoralmarks))
    {   
     $("#marksmsg")
        .text("Error : Enter valid marks")
        .addClass("form_error")
        .css("display", "block");
        $("#obtainoralmarks_"+i).addClass('error-border');
        return false;
    }
   
    
 }
   
 
    return true;
}


function validateSpecialMarks()
{
   // var sel_class = $("#sel_class").val();
    var rownum = $("#rownum").val();
    var maxspecialmarks=20;


    $("#specialmarksmsg").text("").css("dispaly", "none").removeClass("form_error");
  

 for(var i=1;i<rownum;i++){
    
    var specialmarks = $("#specialmarks_"+i).val();
   
  
    $("#specialmarks_"+i).removeClass("error-border");
   
   
    if(specialmarks=='')
    {   
     $("#specialmarksmsg")
        .text("Error : Enter special marks")
        .addClass("form_error")
        .css("display", "block");
        $("#specialmarks_"+i).addClass('error-border');
        return false;
    }

    if(parseInt(specialmarks)>parseInt(maxspecialmarks))
    {   
     $("#specialmarksmsg")
        .text("Error : Enter valid special marks")
        .addClass("form_error")
        .css("display", "block");
        $("#specialmarks_"+i).addClass('error-border');
        return false;
    }
   
    
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


