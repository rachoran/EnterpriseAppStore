(function() {
  $(function() {
    var calendar, d, date, m, y;
    date = new Date();
    d = date.getDate();
    m = date.getMonth();
    y = date.getFullYear();
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
          }, true);
        }
        return calendar.fullCalendar("unselect");
      },
      editable: true,
      events: [
        {
          title: "iDeviant",
          start: new Date(y, m, 1)
        }, {
          title: "Ford",
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2)
        }, {
          id: 999,
          title: "Pockupation",
          start: new Date(y, m, d - 3, 16, 0),
          allDay: false
        }, {
          id: 999,
          title: "iJenkins",
          start: new Date(y, m, d + 4, 16, 0),
          allDay: false
        }, {
          title: "Calpol",
          start: new Date(y, m, d, 10, 30),
          allDay: false
        }, {
          title: "StickerTag",
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false
        }, {
          title: "iSpeedtest",
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false
        }, {
          title: "Barclays demo",
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: "http://google.com/"
        }
      ]
    });
  });

}).call(this);
