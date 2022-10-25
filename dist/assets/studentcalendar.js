$(document).ready(function () {
  var calendar = $("#calendar").fullCalendar({
    header: {
      left: "prev, next today",
      center: "title",
      right: "month, agendaWeek, agendaDay",
    },
    events: "../admin/load-calendar.php",
  });
});
