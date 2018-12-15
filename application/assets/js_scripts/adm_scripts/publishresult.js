$(document).ready(function(){
	var basepath = $("#basepath").val();

	

	// Set Status
    $(document).on("click", ".resultpublishstatus", function() {
		var uid = $(this).data("publishid");
        var status = $(this).data("setstatus");
        var url = basepath + 'publishresult/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});


