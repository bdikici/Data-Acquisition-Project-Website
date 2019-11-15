$(document).ready(function() {

function barChart(data){

	//convert elements to int

	data[1] = data[1].map(function (x) { 
  		return parseInt(x, 10); 
	});


	var ctx = document.getElementById('myChart').getContext('2d');
	ctx.canvas.width = 300;
	ctx.canvas.height = 400;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: data[0],
	        datasets: [{
	            label: '# of Bookings',
	        	lineTension: 0,        
				fill: false,
				borderColor: "#7FFFD4",
				backgroundColor: "#7FFFD4",
				pointBackgroundColor: "#55bae7",
				pointBorderColor: "#55bae7",
				pointHoverBackgroundColor: "#55bae7",
				pointHoverBorderColor: "#55bae7",
	            data: data[1],
	        }]
	    },
	    options: {
	    	maintainAspectRatio: false,
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true,
	                    suggestedMax: Math.max.apply(Math, data[1]) + 3
	                }
	            }]
	        }
	    }
	});
}

//your code here
$.ajax({
	url: "php/fetch_data.php",
	data: {action: 'booking_last20'},
	type: "post",
	success: function(response){
		console.log(response);
		barChart(jQuery.parseJSON(response))
	},
	error: function(){
		console.log("no response");
	}
})




});
