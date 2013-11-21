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
				
				var eventsData = jsonData.data;
				for (var i = 0; i < eventsData.length; i++) {
					eventsData[i].start = new Date(eventsData[i].start * 1000);
					eventsData[i].end = new Date(eventsData[i].end * 1000);
				}
/*
				var eventsData = [
					{
						title: "iSpeedtest",
						start: new Date(y, m, d + 1, 19, 0),
						end: new Date(y, m, d + 1, 22, 30),
						allDay: false
					}, {
						title: "Barclays demo",
						start: new Date(y, m, 28),
						end: new Date(y, m, 29),
						url: env.baseUrl + 'users/edit/10/yo'
					}
				];
*/
				
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
