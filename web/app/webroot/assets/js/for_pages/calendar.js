(function() {
	$(function() {
		$.ajax({
		type: 'GET',
		url: env.baseUrl + 'AdminApi/calendarData',
		success: function(json) {
			return false;
			$('#calendar p').remove();
			var calendar, d, date, m, y;
			date = new Date();
			d = date.getDate();
			m = date.getMonth();
			y = date.getFullYear();
			
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
			
			return calendar = $("#calendar").fullCalendar({
				header: {
					left: "prev,next today",
					center: "title",
					right: "month,agendaWeek,agendaDay"
				},
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					var title;
					title = prompt("Event Title:");
					if (title) {
						calendar.fullCalendar("renderEvent", {
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true);
					}
					return calendar.fullCalendar("unselect");
				},
				editable: false,
				events: eventsData
			});
		}});
	});
}).call(this);
