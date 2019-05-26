$(document).ready(function(){
	var basepath = $("#basepath").val();



	// Set Status
    $(document).on("click", ".autorizationstatus", function() {
		var uid = $(this).data("userid");
        var status = $(this).data("setstatus");
        var url = basepath + 'usercontrol/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});


