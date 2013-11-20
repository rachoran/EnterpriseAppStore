$(function() {

	$('.dynamicsparkline').sparkline([10, 8, 5, 7, 5, 4, 1, 10, 8, 12, 7, 7, 4, 5, 8, 8, 7, 7, 11, 5, 9, 12, 7, 7, 4, 5, 8, 8], {
		type: 'line',
		lineColor: '#89b1e4',
		fillColor: '#d7e8fc'
	});
	
	$('.dynamicbars').sparkline([5, 6, 7, 2, 0, -4, -2, 4, 1, 10, 8, 12, 7, -2, 4, 8], {
		type: 'bar',
		barColor: '#89b1e4',
		negBarColor: '#c76868'
	});
	
	$(".knob").knob({
		thickness: '.05',
		font: "Open Sans",
		bgColor: "#E7E2DC",
		readOnly: true
	});
  
	$.ajax({
		type: 'GET',
		url: env.baseUrl + 'AdminApi/platformDownloads',
		success: function(json) {
			$('#areachart p').remove();
			var chartData = JSON.parse(json);
			var options = {
				element: 'areachart',
				behaveLikeLine: true,
				data: chartData.data,
				xkey: "x",
				//ykeys: ["a", "b", "c", "d"],
				ykeys: ["a", "b"],
				//labels: ["iOS", "Android", "Windows 8", "Web Clips"],
				labels: ["iOS", "Android"],
				lineColors: ["#61a9dc", "#71c280", "#df6064", "#8963ac", "#1abc9c", "#34495e", "#9b59b6", "#e74c3c"]
			};
			
			Morris.Area(options);
		}
	});
		
	

  Morris.Donut({
    element: 'piechart',
    data: [
      {label: 'iPhone', value: 40 },
      {label: 'Android', value: 38 },
      {label: 'Win 8', value: 17 },
      {label: 'Other', value: 5 }
    ],
    colors: ["#61a9dc", "#71c280", "#df6064", "#8963ac"],
    formatter: function (y) { return y + "%" }
  });




  Morris.Bar({
    element: 'topsellers_barchart',
    data: [
      {device: '3G', geekbench: 137},
      {device: '3GS', geekbench: 275},
      {device: '4', geekbench: 380},
      {device: '4S', geekbench: 655},
      {device: '5', geekbench: 1571}
    ],
    xkey: 'device',
    ykeys: ['geekbench'],
    labels: ['Geekbench'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto'
  });

});