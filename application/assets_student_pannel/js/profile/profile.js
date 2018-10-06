/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    var basepath = $("#basepath").val();
	//alert("fads");
    
     $("#frmPersonalia").on("submit", function(event) {
         event.preventDefault();
         //var data = $(this).serialize();
                   
        $.ajax({
            type: "POST",
            url: basepath + 'profile/UpadatePersonalia',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: $(this).serialize(),
            success: function (result) {
                if (result.msg_code == 0) {
                    $("#msgdivsuccess").hide();
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);

                } else if(result.msg_code == 2) {
                    $("#msgdivsuccess").hide();
                    $("#msgdiv").show();
                    $("#msgText").html(result.msg_data);
                }else if(result.msg_code == 1){
                    $("#msgdiv").hide();
                    $("#msgdivsuccess").show();
                    $("#successmsgText").html(result.msg_data);
                } else if(result.msg_code==500){
                    window.location.href = basepath + 'memberlogin';
                }
            }, error: function (jqXHR, exception) {
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
        });
       });
    
    $(document).on('click', '#errorclose', function () {
        $("#msgdiv").hide();
    });
     $(document).on('click', '#successclose', function () {
        $("#msgdivsuccess").hide();
    });
    
    //ajax file uplaod
    $('#imagefile').on('change', function (event) {
            event.preventDefault();

           var form = $('#formnamememberImg')[0];
           var formData = new FormData(form);
           $("#loadergif").show();
           //alert(this.files[0].size);//2097152 bytes
            if(this.files[0].size<=2097152){
            $.ajax({
                url : basepath+"profile/uploadProfilePicture", // the action from the upload form
                type : 'post',
                data : formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType : 'json',
                success : function(response) {
                    if(response.msg_code==200){
                        var path =basepath+"application/assets/images/Profilepicture/"+response.msg_data;
                        $(".profileimg").attr("src",path);
                        $("#loadergif").hide();
                    }else if(response.msg_code==400){
                        $("#msgdivImage").show();
                        $("#ImagemsgText").html(response.msg_data);
                        $("#loadergif").hide();
                    }else if(response.msg_code==500){
                         window.location.href = basepath + 'memberlogin';
                    }
                }, error: function (jqXHR, exception) {
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
            });
            }else{
                $("#msgdivImage").show();
                $("#ImagemsgText").html("Image size limit :2Mb.Please try another. ");
                $("#loadergif").hide();
            }
        });

    
    
    
   $(document).on('click', '#errorImageclose', function () {
        $("#msgdivImage").hide();
    }); 
    
    
    $('#dateofbirth').datepicker({
            autoclose: true,
			todayHighlight: true,
            format: 'dd-mm-yyyy',
			forceParse: false
		});
    
    
});//end
