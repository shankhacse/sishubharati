
function getAutoComplete(id,path)
{
	$('#'+id).typeahead({

            source: function (query, result) {
                $.ajax({
                    url: path,
					data: {query:query},            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });	
}

function detailDocumentValidation(doctype,userfile)
{
    var isValid = true;
    $('.'+doctype).each(function() 
    {
        var doctype_id = $(this).attr('id');
        var docTypeIDS = doctype_id.split("_");
        var docTypeVal = $(this).val();
        console.log(doctype_id);

        var tdIDS = "#"+doctype+"_"+docTypeIDS[1]+"_"+docTypeIDS[2];
        var tdIDS2 = "#"+userfile+"_"+docTypeIDS[1]+"_"+docTypeIDS[2];

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

function setActiveStatus(uid,status,path)
{
	
	$.ajax({
			type: "POST",
			url:  path,
			data: {uid:uid,setstatus:status},
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

function checkExistance(id,path,res)
{
    var query = $("#"+id).val();
    var isexist = false;
    $.ajax({
        url : path,
        type: "POST",
        dataType:'json',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
        data : {query:query},
        success: function(result) {
            if(result.msg_status==1)
            {
                $("#"+res).css("display","block").text(result.msg_data);
                isexist = true;
            }
            else
            {
                 $("#"+res).css("display","none").text("");
                isexist = false;
            }
              
            },
            async:false
            
        });
    
    return isexist; 

}

function populateDropdown(id,path,reponseID)
{
    $.ajax({
        type: "POST",
        url: path,
        data: {id:id},
        dataType: 'html',
        success: function (result) {
            $("#"+reponseID).html(result);
            $('.selectpicker').selectpicker();
        }, 
        error: function (jqXHR, exception) 
        {
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

