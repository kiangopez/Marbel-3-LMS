$(document).ready(function () {
  var calendar = $("#calendar").fullCalendar({
    editable: true,
    header: {
      left: "prev, next today",
      center: "title",
      right: "month, agendaWeek, agendaDay",
    },
    events: "../admin/load-calendar.php",
    selectable: true,
    selectHelper: true,
    select: function (start, end, allDay) {
      var title = prompt("Enter event title:");
      if (title) {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
          url: "../admin/add-event.php",
          type: "POST",
          data: { title: title, start: start, end: end },
          success: function () {
            calendar.fullCalendar("refetchEvents");
            alert("Added Successfully");
          },
        });
      }
    },
    editable: true,
    eventResize: function (event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "../admin/update-event.php",
        type: "POST",
        data: { title: title, start: start, end: end, id: id },
        success: function () {
          calendar.fullCalendar("refetchEvents");
          alert("Event Updated");
        },
      });
    },
    eventDrop: function (event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "../admin/update-event.php",
        type: "POST",
        data: { title: title, start: start, end: end, id: id },
        success: function () {
          calendar.fullCalendar("refetchEvents");
          alert("Event Updated");
        },
      });
    },
    eventClick: function (event) {
      if (confirm("Are you sure you want to remove it?")) {
        var id = event.id;
        $.ajax({
          url: "../admin/delete-event.php",
          type: "POST",
          data: { id: id },
          success: function () {
            calendar.fullCalendar("refetchEvents");
            alert("Event Deleted");
          },
        });
      }
    },
  });
});
