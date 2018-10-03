$(document).ready(function () {

	
	for (var i = 0; i < 2; i++) {
		
	
	var ctx = $("#pie-chartcanvas_1");
	alert(ctx);
	var absent=40;
	var present=70;


	var data = {
		labels : ["Absent","Present",],
		datasets : [
			{
				label : "TeamB score",
				data : [absent,present],
				backgroundColor : [
                    
                    "#E9967A",
                    "#9ACD32"
                ],
                borderColor : [
                   
                    "#D88569",
                    "#89BC21"
                ],
                borderWidth : [1, 1]
			}
		]

	};

	var options = {
		title : {
			display : true,
			position : "top",
			text : "Pie Chart",
			fontSize : 18,
			fontColor : "#111"
		},
		legend : {
			display : false,
			position : "bottom"
		}
	};



	var chart = new Chart( ctx, {
		type : "pie",
		data : data,
		options : options
	});
	
}

});