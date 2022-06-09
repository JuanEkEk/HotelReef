document.addEventListener("DOMContentLoaded", function () {
  // El div que almacena la agenda
  var calendarEl = document.getElementById("agenda");
  //   Instrucciones del calendario
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",

    height: "auto",
    width: "auto",

    headerToolbar: {
      left: "prev,today,next",
      center: "title",
      right: "dayGridMonth,listMonth",
      // timeGridDay,
    },
  });
  //   Ejecutar el calendario
  calendar.render();
});
