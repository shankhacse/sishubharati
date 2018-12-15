$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
 $(".scbyname").css("display","none");
  
 $(document).on("change", "#sel_type_searchby", function() {
         var sel_type = $("#sel_type_searchby").val();

         if (sel_type=='SID') {
             $(".scbyid").css("display","block");
             $(".scbyname").css("display","none");

         }else if(sel_type=='SNAME'){
             $(".scbyid").css("display","none");
             $(".scbyname").css("display","block");

         }

    });


       /* On select class select student name (payment history) */
    $(document).on("change", "#sel_classpayhis", function() {
        var val=$('#sel_classpayhis').val();

       
    $.ajax({
    type: "POST",
    url: basepath+'marks/getStudentName',
    data: {classid:val},
    
    success: function(data){
        $("#student_viewph").html(data);
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


   	/*individuals student marksheet working on progress*/

   
    $(document).on("submit","#marksIndividualsForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#marksIndividualsForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadstudentList").html('');
          
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'marks/getStudentAllMarks',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentMarksheet").html(result);
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

/* student individuals term paper document*/

/* add special marks to student list by class*/

   
    $(document).on("click","#exampaperview",function(event){
        event.preventDefault();

           var formDataserialize = $("#marksIndividualsForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
             $("#loadStudentMarksheet").html('');
          
            $(".dashboardloader").css("display","block");


            $.ajax({
                type: "POST",
                url: basepath+'marks/getStudentExamPapers',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadStudentMarksheet").html(result);
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

}); // end of document ready

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}