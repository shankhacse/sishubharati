$(document).ready(function(){
	var basepath = $("#wbbasepath").val();

    //startCenterSlider();

    $(document).on("keydown",".pinsearch",function(){
        var path = basepath+'home/getPincodeAutocomplet';
        getAutoComplete('chkout_user_pin',path); // commonutilfunc.js
    });

    $(document).on("keydown",".statesearch",function(){
        var path = basepath+'autosearch/searchstates';
        getAutoComplete('chkout_user_state',path); // commonutilfunc.js
    });

    $(document).on("click","#search_more_btn_sbm",function(){
       var search = $("#searchInvestigation").serialize();
       window.location.href=basepath+'searchquery?'+search;
    });

    $(document).on("change",".addmore_testfrmmodal #sel_investigation",function(){
       var selected_test = $(this).val();
        var selected_test_text = $("#sel_investigation :selected").text();
        var dynamic_test = '';
        dynamic_test+='<li>';
        dynamic_test+='<input type="hidden" name="tests[]" class="investigation_code" value="'+selected_test+'"/>'
        dynamic_test+='<input type="hidden" name="name[]" class="name" value="'+selected_test_text+'"/>'
        dynamic_test+= selected_test_text;
        dynamic_test+=' <a href="javascript:;" class="clear_selected_test" data-mode="More" > <i class="fa fa-times" style="color:#FFF;"></i></a></li>';
        
        if(selected_test.length>0)
        {
            $("#selected_items_ul").append(dynamic_test);
        }

        
        
        $("#sel_investigation").val('default');
        $("#sel_investigation").selectpicker("refresh");
        

        refreshInvestigation(basepath);
    });


    $(document).on("click","#add_more_test",function(){
        var formDataserialize = $("#usearched_form").serialize();
        formDataserialize = decodeURI(formDataserialize);
        var formData = {formDatas: formDataserialize};

    	$.ajax({
           type: "POST",
            url: basepath+"searchquery/addmoretest",
            data: formData,
            dataType: 'html',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            success: function (result) {
                $("#addorremovetestmodal").modal({
                     "backdrop"  : "static",
                    "keyboard"  : true,
                    "show"      : true                    
                });
                $("#addorremoveContainer").html(result);
                $('.selectpicker').selectpicker();
                
                $("#add-remove-head").text("Get More Test");
                

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

    /*----checkout-----*/

     $(document).on("click",".checkout_tests",function(){
       var search = $("#searchInvestigation").serialize();
       window.location.href=basepath+'searchquery?'+search;
    });




    $(document).on("click",".centertiming",function(){
       // var 
        var centreid = $(this).data('centerid');
        $.ajax({
           type: "POST",
            url: basepath+"searchquery/getCentertiming",
            data: {centreid:centreid},
            dataType: 'html',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            success: function (result) {
               
                $("#wb_search_q_modal").modal({
                     "backdrop"  : "static",
                     "keyboard"  : true,
                     "show"      : true                    
                });
                $("#wb_search_q_modal_container").html(result);
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

    $(document).on("click",".sorthighlight",function(){
        var sfrom =  $(this).data("sfrom");
        var sfromid =  $(this).attr("id");
      
        $(".sorthighlight").removeClass("sort_highlight");
        $("#"+sfromid).addClass("sort_highlight");
    });




    var $divs = $("div.testlistSearch");

    $('#sortprice').on('click', function () {
        $('#sortnearest').html('<i class="fa fa-sort" aria-hidden="true"></i> Nearest');
         var sortorder =  $('#sortprice').data("sortorder");
         var alphabeticallyOrderedDivs;
        if(sortorder=="ASC")
        {    $('#sortprice').html('Price <i class="fa fa-sort-desc" aria-hidden="true"></i>');
            $('#sortprice').data('sortorder',"DESC"); //setter
            alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
                var val1 = parseFloat($(a).find(".finalprice_tst").val());
                var val2 = parseFloat($(b).find(".finalprice_tst").val());

           // return $(a).find(".finalprice_tst").val() > $(b).find(".finalprice_tst").val();
             return val1 > val2;
             });
        }
        else
        {
            $('#sortprice').html('Price <i class="fa fa-sort-asc" aria-hidden="true"></i>');
            $('#sortprice').data('sortorder',"ASC"); //setter
            alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
                var val1 = parseFloat($(a).find(".finalprice_tst").val());
                var val2 = parseFloat($(b).find(".finalprice_tst").val());
                 return val1 < val2;
                //return $(a).find(".finalprice_tst").val() < $(b).find(".finalprice_tst").val();
            });
        }
        
        $("#sortedresult").html(alphabeticallyOrderedDivs);
    });

    $('#sortnearest').on('click', function () {

        $('#sortprice').html('<i class="fa fa-sort" aria-hidden="true"></i> Price');
         var sortorder =  $('#sortnearest').data("sortorder");
         var alphabeticallyOrderedDivs;
        if(sortorder=="ASC")
        {   $('#sortnearest').html('Nearest <i class="fa fa-sort-desc" aria-hidden="true"></i>');
            $('#sortnearest').data('sortorder',"DESC"); //setter
            alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
                var val1 = parseFloat($(a).find(".center_distance_km").val());
                var val2 = parseFloat($(b).find(".center_distance_km").val());
                return val1 > val2;
            });
        }
        else
        {
            $('#sortnearest').html('Nearest <i class="fa fa-sort-asc" aria-hidden="true"></i>');
            $('#sortnearest').data('sortorder',"ASC"); //setter
            alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
                 var val1 = parseFloat($(a).find(".center_distance_km").val());
                 var val2 = parseFloat($(b).find(".center_distance_km").val());
                 return val1 < val2;
            });
        }
        
        $("#sortedresult").html(alphabeticallyOrderedDivs);
    });


});


