$(document).ready(function() {

function barChart(data){
	console.log("entered:",data)
	var ctx = document.getElementById('myChart').getContext('2d');
	ctx.canvas.width = 100;
	ctx.canvas.height = 100;
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: ['Red', 'Blue'],
	        datasets: [{
	            label: '# of Votes',
	            data: [5, data.length],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.2)',
	                'rgba(255, 159, 64, 0.2)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
}

//your code here
  $("#tempi").click(function(){
    $.ajax({
    	url: "php/get_data.php",
    	success: function(response){
    		barChart(jQuery.parseJSON(response))
    	},
    	error: function(){
    		console.log("no response");
    	}
    })
  })



});
