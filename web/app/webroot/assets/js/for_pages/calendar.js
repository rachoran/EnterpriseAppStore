(function() {
	$(function() {
		$.ajax({
		type: 'GET',
		url: env.baseUrl + 'AdminApi/calendarData',
		success: function(json) {
			var jsonData = JSON.parse(json);
			if (jsonData.data) {
				$('#calendar p').remove();
				var calendar, d, date, m, y;
				date = new Date();
				d = date.getDate();
				m = date.getMonth();
				y = date.getFullYear();
				
				return calendar = $("#calendar").fullCalendar({
					header: {
						left: "prev,next today",
						center: "title",
						//right: "month,agendaWeek,agendaDay"
						right: ""
					},
					selectable: false,
					selectHelper: false,
					select: function(start, end, allDay) {
					
					},
					editable: false,
					events: jsonData.data
				});
			}			
		}});
	});
}).call(this);
