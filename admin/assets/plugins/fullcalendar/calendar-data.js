if ($("#events").length > 0) {
  document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("events");
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: "dayGridMonth",
      
      headerToolbar: {
        start: "title",
        center: "dayGridMonth,dayGridWeek,dayGridDay",
        end: "custombtn",
      },
      customButtons: {
        custombtn: {
          text: "Add New Event",
          click: function () {
            var myModal = new bootstrap.Modal(
              document.getElementById("add_event")
            );
            myModal.show();
          },
        },
      },
      eventClick: function (info) {
        var modalTitle = document.getElementById("eventTitle");
        modalTitle.textContent = info.event.title;

        var eventModal = new bootstrap.Modal(
          document.getElementById("eventModal")
        );
        eventModal.show();
      },
    });
    calendar.render();
  });
}

if ($("#calendar").length > 0) {
  document.addEventListener("DOMContentLoaded", function () {
    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      },

      height: 500,
      contentHeight: 580,
      aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

      views: {
        dayGridMonth: { buttonText: "month" },
        timeGridWeek: { buttonText: "week" },
        timeGridDay: { buttonText: "day" },
      },

      initialView: "dayGridMonth",
      initialDate: TODAY,

      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      navLinks: true,
      
    });

    calendar.render();
  });
}
