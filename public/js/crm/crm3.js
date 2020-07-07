$(document).ready(function () {
  //alert("carga .js");
  if (window.location.pathname.includes("/crm")) {
    alert("carga .js dentro del pathname.includes('/crm')");
    //cargaLeadsCard();
    moment.lang("es", {
      months: "Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre".split(
        "_"
      ),
      monthsShort: "Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.".split(
        "_"
      ),
      weekdays: "Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado".split(
        "_"
      ),
      weekdaysShort: "Dom._Lun._Mar._Mier._Jue._Vier._Sab.".split("_"),
      weekdaysMin: "Do_Lu_Ma_Mi_Ju_Vi_Sa".split("_")
    });

    var calendarEl = document.getElementById("calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ["interaction", "dayGrid", "timeGrid", "list"],
      timeZone: "Europe/Madrid",
      locale: "es",
      defaultView: "dayGridMonth",
      editable: true,
      selectable: true,
      allDaySlot: false,
      header: {
        right: "prevYear,prev,next,today,nextYear",
        center: "title",
        left: "timeGridDay,timeGridTwoWeeks,dayGridMonth"
      },
      views: {
        timeGridDay: {
          columnHeaderFormat: {
            weekday: "short",
            month: "numeric",
            day: "numeric",
            omitCommas: true
          }
        },
        timeGridTwoWeeks: {
          type: "timeGrid",
          columnHeaderFormat: {
            weekday: "short",
            month: "numeric",
            day: "numeric",
            omitCommas: true
          },
          duration: {
            days: 14
          },
          buttonText: "2 Semanas"
        }
      },
     events: "../Crm/getAcciones", // request to load current events

      eventClick: function (info) {
        moment.locale("es");
        // when some one click on any event
        $("#eventID").val(info["event"]["_def"]["publicId"]);
        $.ajax({
          url: "../core/model/search/searchAgenda/searchDatosModalEdit.php",
          data: {
            id: info["event"]["_def"]["publicId"]
          },
          type: "POST",
          success: function (json) {
            //alert(json);
            let respuesta = JSON.parse(json);
            console.log(respuesta);
            $("#titleEdit").val(respuesta["title"]);
            $(
              "#tipoClienteEdit option[value='" +
                respuesta["idRolPersona"] +
                "']"
            ).attr("selected", true);
            $(
              "#idComercialEdit option[value='" + respuesta["comercial"] + "']"
            ).attr("selected", true);
            $.ajax({
              url:
                "../core/model/search/searchAgenda/searchSelectClienteTarea.php",
              type: "POST",
              data: {
                idComercial: respuesta["comercial"],
                tipo: respuesta["idRolPersona"]
              },
              success: function (respuesta) {
                //console.log(respuesta);
                $("#idClienteEdit").html(respuesta);
              },
              error: function () {
                console.log("No se ha podido obtener la información");
              }
            });
            endtime = moment(respuesta["end"])
              .locale(false)
              .format("dddd,Do MMMM  YYYY, h:mm");
            starttime = moment(respuesta["start"])
              .locale(false)
              .format("dddd,Do MMMM  YYYY, h:mm");
            var mywhen = starttime + " - " + endtime;
            $("#modalWhen").text(mywhen);
            $(
              "#estadoTareaEdit option[value='" +
                respuesta["estadoEvento"] +
                "']"
            ).attr("selected", true);
            $(
              "#estadoClienteEdit option[value='" +
                respuesta["estadoContacto"] +
                "']"
            ).attr("selected", true);
            $("#idActividadEdit").val(respuesta["tarea"]);
            setTimeout(function () {
              $("#estadoClienteAnterior").val(respuesta["estadoContacto"]);
              $(
                "#idClienteEdit option[value='" + respuesta["persona"] + "']"
              ).attr("selected", true);
              $("#cambioPersona").val(respuesta["persona"]);
            }, 700);
            setTimeout(function () {
              $(".select2").select2();
            }, 800);
          }
        });
        setTimeout(function () {
          $("#calendarModal").modal();
        }, 800);
      },
      select: function (info) {
        $("#cambioPersona").val("");
        let tipoGrid = info.view.type;
        moment.locale("es");
        if (tipoGrid == "dayGridMonth") {
          calendar.changeView("timeGridDay", info.start);
        } else {
          endtime = moment(info.endStr)
            .locale(false)
            .format("dddd,Do MMMM  YYYY, h:mm");
          starttime = moment(info.startStr)
            .locale(false)
            .format("dddd,Do MMMM  YYYY, h:mm");
          var mywhen = starttime + " - " + endtime;
          start = moment(info.startStr)
            .locale(false)
            .format("YYYY-MM-DD h:mm:ss");
          end = moment(info.endStr).locale(false).format("YYYY-MM-DD h:mm:ss");
          $("#createEventModal #startTime").val(start);
          $("#createEventModal #endTime").val(end);
          $("#createEventModal #when").text(mywhen);
          $("#createEventModal").modal("toggle");
        }
        // click on empty time slot
      },
      eventDrop: function (event, delta) {
        $("#cambioPersona").val("");
        // event drag and drop
        moment.locale("es");
        $.ajax({
          url: "../core/model/gestionAgenda/crudAgenda.php",
          data: {
            action: "update",
            updateModal: 0,
            title: event["event"]["_def"]["title"],
            start: moment(event["event"]["_instance"]["range"]["start"])
              .locale(false)
              .format(),
            end: moment(event["event"]["_instance"]["range"]["end"])
              .locale(false)
              .format(),
            id: event["event"]["_def"]["publicId"]
          },
          type: "POST",
          success: function (json) {
            //alert(json);
          }
        });
      },
      eventResize: function (event) {
        $("#cambioPersona").val("");
        // resize to increase or decrease time of event
        console.log(event);
        moment.locale("es");
        $.ajax({
          url: "../core/model/gestionAgenda/crudAgenda.php",
          data: {
            action: "update",
            updateModal: 0,
            title: event["event"]["_def"]["title"],
            start: moment(event["event"]["_instance"]["range"]["start"])
              .locale(false)
              .format(),
            end: moment(event["event"]["_instance"]["range"]["end"])
              .locale(false)
              .format(),
            id: event["event"]["_def"]["publicId"]
          },
          type: "POST",
          success: function (json) {
            //alert(json);
          }
        });
      }
    });

    calendar.render();

    $("#submitButton").on("click", function (e) {
      // add event submit
      // We don't want this to act as a link so cancel the link action
      e.preventDefault();
      doSubmit(); // send to form submit function
    });

    $("#deleteButton").on("click", function (e) {
      // delete event clicked
      // We don't want this to act as a link so cancel the link action
      e.preventDefault();
      doDelete(); /*send data to delete function*/
    });

    $("#updateButton").on("click", function (e) {
      // delete event clicked
      // We don't want this to act as a link so cancel the link action
      e.preventDefault();
      doUpdate(); /*send data to delete function*/
    });
    $("button[data-dismiss='modal']").on("click", function (e) {
      // delete event clicked
      // We don't want this to act as a link so cancel the link action
      e.preventDefault();
    });

    function doDelete() {
      // delete event
      $("#calendarModal").modal("hide");
      var eventID = $("#eventID").val();
      //alert(eventID);
      $.ajax({
        url: "../core/model/gestionAgenda/crudAgenda.php",
        data: {
          action: "delete",
          id: eventID
        },
        type: "POST",
        success: function (json) {
          //alert(json)
          if (json == 1) calendar.refetchEvents();
          else return false;
          //cargaLeadsCard();
        }
      });
    }

    function doSubmit() {
      // add event
      $("#createEventModal").modal("hide");
      var title = $("#title").val();
      var startTime = $("#startTime").val();
      var endTime = $("#endTime").val();
      var idComercial = $("#idComercial option:selected").val();
      var nomComercial = $("#idComercial option:selected").html();
      var idPersona = $("#idCliente option:selected").val();
      var tipoPersona = $("#tipoCliente option:selected").val();
      var estadoTarea = $("#estadoTarea option:selected").val();
      var estadoCliente = $("#estadoCliente").html();
      var tarea = $("#idActividad").val();
      //console.log(title + " " + startTime + " " + endtime);
      $.ajax({
        url: "../core/model/gestionAgenda/crudAgenda.php",
        data: {
          action: "add",
          title: title,
          start: startTime,
          end: endTime,
          idComercial: idComercial,
          idPersona: idPersona,
          tipoPersona: tipoPersona,
          estadoTarea: estadoTarea,
          tarea: tarea,
          nomComercial: nomComercial,
          estadoCliente: estadoCliente
        },
        type: "POST",
        success: function (json) {
          moment.locale("es");
          calendar.addEvent({
            id: json.id,
            backgroundColor: json.color,
            title: title,
            start: moment(startTime).locale(false).format(),
            end: moment(endTime).locale(false).format()
          });
          //cargaLeadsCard();
        }
      });
    }

    function doUpdate() {
      // add event
      $("#createEventModal").modal("hide");
      var estadoPersona = $("#estadoClienteEdit option:selected").val();
      var estadoTarea = $("#estadoTareaEdit option:selected").val();
      var flashBack = $("#flashBack").val();
      var eventID = $("#eventID").val();
      var anterior = $("#estadoClienteAnterior").val();
      //console.log(title + " " + startTime + " " + endtime);
      $.ajax({
        url: "../core/model/gestionAgenda/crudAgenda.php",
        data: {
          action: "update",
          updateModal: 1,
          estadoAnteriorPersona: anterior,
          estadoTarea: estadoTarea,
          estadoPersona: estadoPersona,
          flashBack: flashBack,
          idEvento: eventID
        },
        type: "POST",
        success: function (json) {
          $("#calendarModal").modal("toggle");
          calendar.refetchEvents();
        }
      });
    }

   /* $(".historico").on("click", function (info) {
      let persona = $("#cambioPersona").val();
      $.ajax({
        url: "../core/model/search/searchAgenda/searchTimeLine.php",
        data: {
          idPersona: persona
        },
        type: "POST",
        success: function (data) {
          $("#timeLineBody").html(data);
          $("#timeLine").modal("toggle");
        }
      });
    });
*/
/*
    function cargaLeadsCard() {
      $.ajax({
        url: "../core/model/search/searchAgenda/searchNumEventos.php",
        success: function (json) {
          json = JSON.parse(json);
          $("#frios").html(json.frios);
          $("#templados").html(json.templados);
          $("#calientes").html(json.calientes);
          $("#clientes").html(json.clientes);
          $("#numPendientes").html(json.pendientes);
        }
      });
    }
  */
    /**CARGA DE SELECT DE COMERCIALES SEGUN LA PERSONA LOGADA */
  /*  $.ajax({
      url: "../core/model/search/searchAgenda/searchSelectComercialTarea.php",
      type: "POST",
      success: function (respuesta) {
        //console.log(respuesta);
        $("#idComercial").html(respuesta);
        $("#idComercialEdit").html(respuesta);
      },
      error: function () {
        console.log("No se ha podido obtener la información");
      }
    });
*/
    /** FIN CARGA COMERCIALES */
 /*   $("#idCliente").on("change", function () {
      let temp = $(this).children("option:selected").data("estado");
      console.log($(this).children("option:selected").attr("id"));
      let sujeto = $("#tipoCliente").children("option:selected").val();
      if (temp == "Frio") {
        $("#estadoCliente").css("background-color", "Blue");
      } else if (temp == "Templado") {
        $("#estadoCliente").css("background-color", "Orange");
      } else if (temp == "Caliente") {
        $("#estadoCliente").css("background-color", "Red");
      }
      $("#cambioPersona").val($(this).children("option:selected").val());
      $("#estadoCliente").html(temp);
    });
*/
 /*   $("#idComercial").on("change", function () {
      let idComercial = $(this).val();
      let sujeto = $("#tipoCliente").children("option:selected").val();

      $.ajax({
        url: "../core/model/search/searchAgenda/searchSelectClienteTarea.php",
        type: "POST",
        data: {
          idComercial: idComercial,
          tipo: sujeto
        },
        success: function (respuesta) {
          //console.log(respuesta);
          $("#idCliente").html(respuesta);

          $("#filaClientes").show();
          if (sujeto == "Cliente") {
            $("#filaClientesEstado").hide();
          } else {
            $("#filaClientesEstado").show();
          }
        },
        error: function () {
          console.log("No se ha podido obtener la información");
        }
      });
    });*/
  }
});
