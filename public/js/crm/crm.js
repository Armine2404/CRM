$(document).ready(function () {

  if (window.location.pathname.includes("/crm")) {


    //FILTERS
    //Select Usuarios
    $.ajax({
      type: 'POST',
      url: 'Usuarios/getUsuariosSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroUsuario').empty();

      $.each(clientes, function(key, value) {
        $('#filtroUsuario')
        .append($('<option>', { value : value['idUsuario'] })
        .text(value['usuario']));
      });

      $('#filtroUsuario').select2({
        placeholder: "Usuario",
      });

      $('#filtroUsuario').val( $('#usuario').val() ).change();              
      if( $('#rol').val() != 1 ){ //Si no es administrador
        $("#filtroUsuario").prop("disabled", true);
      }
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //FILTERS
    //Select Tipo Clientes
    $.ajax({
      type: 'POST',
      url: 'EstadoCliente/getEstadoClienteSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroTipoCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroTipoCliente')
        .append($('<option>', { value : value['idEstadoCliente'] })
        .text(value['estadoCliente']));
      });

      $('#filtroTipoCliente').select2({
        placeholder: "Tipo Cliente",
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //FILTERS
    //Select Estados Acciones
    $.ajax({
      type: 'POST',
      url: 'EstadosAcciones/getEstadosAccionesSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroEstadoAccion').empty();
      
      $.each(clientes, function(key, value) {
        $('#filtroEstadoAccion')
        .append($('<option>', { value : value['idEstadoAccion'] })
        .text(value['estadoAccion']));
      });

      $('#filtroEstadoAccion').select2({
        placeholder: "Estado",
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //FILTERS
    //Select Tipos Acciones
    $.ajax({
      type: 'POST',
      url: 'TipoAcciones/getTipoAccionesSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroTipoAccion').empty();

      $.each(clientes, function(key, value) {
        $('#filtroTipoAccion')
        .append($('<option>', { value : value['idTipoAccion'] })
        .text(value['tipoAccion']));
      });

      $('#filtroTipoAccion').select2({
        placeholder: "Tipo",
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    $('.notifi').on('click',function(){
      let id=$(this).attr('id');
      if(id=="pen"){
        //$("#filtroUsuario").val($("#usuario").val()).change();
        $("#filtroEstadoAccion").val(1);
        //cargarCalendario([], [1], [$("#usuario").val()], []);
      }else{
        //$("#filtroUsuario").val($("#usuario").val()).change();
        $("#filtroEstadoAccion").val(2);
        //cargarCalendario([],[2],[$('#usuario').val()],[]);
      }
      
    });
    //FILTROS
    $('.select_accion').off('change');
    $('.select_accion').on('change',function(){
      var filtroUsuario = $('#filtroUsuario').val();
      var filtroTipoCliente = $('#filtroTipoCliente').val();
      var filtroTipo = $('#filtroTipoAccion').val();
      var filtroEstado = $('#filtroEstadoAccion').val();
      //alert($(this).attr("id"));
      if ($(this).attr("id") === "filtroUsuario") {
        $.ajax({
          data: {
            idUsuario: filtroUsuario
          },
          type: "POST",
          url: "Crm/resetTareas",
          success: function (data) {
            console.log(data);
            data=JSON.parse(data);
            $('#tgPendientes').html(data['pendientes']);
            $("#tgWpendientes").css("width", data["penPorcentaje"] + "%");
            $("#tgPenPorcentaje").html(data["penPorcentaje"] + "% del Total");
            $("#tgProceso").html(data["proceso"]);
            $("#tgWproceso").css("width", data["proPorcentaje"] + "%");
            $("#tgProPorcentaje").html(data["proPorcentaje"] + "% del Total");
            $("#tgFinalizadas").html(data["finalizadas"]);
            $("#tgWfinalizadas").css("width", data["finPorcentaje"] + "%");
            $("#tgFinPorcentaje").html(data["finPorcentaje"] + "% del Total");
            $("#tgHoy").html(data["hoy"]);
            let porcentajeHoy = Math.round((((data["hoy"]  * 100)+ 1) / data["total"]));
            $("#tgWhoy").css("width",porcentajeHoy + "%");
            $("#tgHoyPorcentaje").html(porcentajeHoy+"% del Total");
          }
        });
      }

      //console.log( filtroUsuario+' - '+filtroTipoCliente+' - '+ filtroTipo+' - '+filtroEstado);
      cargarCalendario(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente);
    });

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

    var itemsCalendario = [];
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ["interaction", "dayGrid", "timeGrid", "list"],
      timeZone: "Europe/Madrid",
      locale: "es",
      defaultView: "dayGridMonth",
      editable: true,
      selectable: true,
      longPressDelay:0,
      allDaySlot: false,
      header: {
        right: "prevYear,prev,next,today,nextYear",
        center: "title",
        left: "timeGridDay,timeGridWeek,dayGridMonth,listWeek"
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
      /*events: function(info, successCallback, failureCallback) {
        alert(itemsCalendario);
      }, // request to load current events*/
      events: itemsCalendario,
      eventClick: function (info) {
        moment.locale("es");
        cargarSelect();
        // when some one click on any event
        $("#evento").val(info["event"]["_def"]["publicId"]);
        $.ajax({
          url: "Crm/getAccionUpdate",
          data: {
            id: info["event"]["_def"]["publicId"]
          },
          type: "POST",
          success: function (json) {
            //alert(json);
            let respuesta = JSON.parse(json);
            respuesta = respuesta[0];
            //console.log(respuesta);
            var start = respuesta["start"].split(" ");
            var startDate = start[0];         
            var startTime = start[1].substr(0,5);          
            var end = respuesta["end"].split(" ");
            var endDate = end[0];
            var endTime = end[1].substr(0,5);  
            $("#accionEdit").val(respuesta["accion"]);
            $("#startDateEdit").val(startDate);
            $("#startTimeEdit").val(startTime);
            $("#idUsuarioEdit option[value='" + respuesta["idUsuario"] + "']").attr("selected", true).change();
            $("#endDateEdit").val(endDate);
            $("#endTimeEdit").val(endTime);
            $("#idClienteEdit option[value='" + respuesta["idCliente"] + "']").attr("selected", true).change();
            $("#idEstadoAccionEdit option[value='" + respuesta["idEstadoAccion"] + "']").attr("selected", true).change();
            $("#idTipoAccionEdit option[value='" + respuesta["idTipoAccion"] + "']").attr("selected", true).change();
            endtime = moment(respuesta["end"]).locale(false).format("dddd,Do MMMM  YYYY, H:mm");
            starttime = moment(respuesta["start"]).locale(false).format("dddd,Do MMMM  YYYY, H:mm");
            var mywhen = starttime + " - " + endtime;
            $("#whenEdit").text(mywhen);
          }
        });
        setTimeout(function () {
          $("#calendarModal").modal();
        }, 1000);
      },
      select: function (info) {
        $("#cambioPersona").val("");
        let tipoGrid = info.view.type;
        moment.locale("es");
        // if (tipoGrid == "dayGridMonth") {
        //   calendar.changeView("timeGridDay", info.start);
        // } else {
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
          cargarSelect();
          $("#createEventModal").modal("toggle");
        // }
        // click on empty time slot
      },
      eventDrop: function (event, delta) {
        $("#cambioPersona").val("");
        // event drag and drop
        moment.locale("es");
        var idUsuario = $("#usuario").val();
        $.ajax({
          url: "Crm/updateAccionResize",
          data: {
            updateModal: 0,
            title: event["event"]["_def"]["title"],
            start: moment(event["event"]["_instance"]["range"]["start"])
            .utc()
            .format(),
            end: moment(event["event"]["_instance"]["range"]["end"])
            .utc()
            .format(),
            id: event["event"]["_def"]["publicId"],
            idUsuario: idUsuario
          },
          type: "POST",
          success: function (json) {
            calendar.refetchEvents();
          }
        });
      },
      eventResize: function (event) {
        $("#cambioPersona").val("");
        // resize to increase or decrease time of event
        console.log(event);
        moment.locale("es");
        var idUsuario = $("#usuario").val();
        $.ajax({
          url: "Crm/updateAccionResize",
          data: {
            updateModal: 0,
            title: event["event"]["_def"]["title"],
            start: moment(event["event"]["_instance"]["range"]["start"])
            .local(false)
            .format(),
            end: moment(event["event"]["_instance"]["range"]["end"])
            .local(false)
            .format(),
            id: event["event"]["_def"]["publicId"],
            idUsuario: idUsuario,
            log: 0
          },
          type: "POST",
          success: function (json) {
            calendar.refetchEvents();
          }
        });
      }
    });

    calendar.render();
    addEvents([],[],[ $('#usuario').val() ],[]);


    function addEvents(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente) {

      itemsCalendario = [];
      $.ajax({
        type: "POST",
        url: "Crm/getAcciones",
        data: {
          idUsuario:filtroUsuario,
          idTipoCliente:filtroTipoCliente,
          idTipo:filtroTipo,
          idEstado:filtroEstado
        }
      }).done(function (data) {
        data = JSON.parse(data);
        //var itemsCalendario = [];
        var i;
        var esLocale;
        moment.locale("es");
        for (i = 0; i < data.length; i++) {
          
          fechaHoraS = data[i].start.split(" ");
          fechaS = fechaHoraS[0].split("-");
          horaS = fechaHoraS[1].split(":");

          fechaHoraE = data[i].end.split(" ");
          fechaE = fechaHoraE[0].split("-");
          horaE = fechaHoraE[1].split(":");
          if (data[i].idEstadoAccion==1){
            backgroundColor="red";
            color = "white";
          }else if(data[i].idEstadoAccion==2){
            backgroundColor = "orange";
            color = "black";
          }else if(data[i].idEstadoAccion==3){
            backgroundColor = "green";
            color = "white";
          }
            
            itemsCalendario[i] = {
              id: data[i].idAccion,
              title: data[i].accion,
              //start: new Date(fechaS[0], fechaS[1], fechaS[2], horaS[0], horaS[1]),
              //end: new Date(fechaE[0], fechaE[1], fechaE[2], horaE[0], horaE[1]),
              start: moment(data[i].start).locale(false).format(),
              end: moment(data[i].end).locale(false).format(),
              backgroundColor: backgroundColor,
              borderColor: "black",
              textColor: color
            };
        }
        eventSources = calendar.getEventSources();
        eventSources[0].remove();
        calendar.addEventSource(itemsCalendario);
        calendar.refetchEvents();
        $.ajax({
          data: {
            idUsuario: $("#usuario").val()
          },
          type: "POST",
          url: "Crm/resetTareas",
          success: function (data) {
            //console.log(data);
            data = JSON.parse(data);
            $("#notTotal").html(parseInt(data["pendientes"])+parseInt(data["proceso"]));
            $("#notPendientes").html(data["pendientes"]);
            $("#notPenPorcentaje").html(data["penPorcentaje"] + "%");
            $("#notProceso").html(data["proceso"]);
            $("#notProPorcentaje").html(data["proPorcentaje"] + "%");
            $("#notHoy").html(data["hoy"]);
            let porcentajeHoy = Math.round((((data["hoy"]  * 100)+ 1) / data["total"]));
            $("#tgHoyPorcentaje").html(porcentajeHoy + "%");
          }
        });
      });
    }

    function cargarCalendario(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente){

          if(filtroTipo != null){
            filtroTipo =  filtroTipo;
          } else {
            filtroTipo = [];
          }
          if(filtroEstado != null){
            filtroEstado =  filtroEstado;
          } else {
            filtroEstado = [];
          }
          if(filtroUsuario != null){
            filtroUsuario =  filtroUsuario;
          } else {
            filtroUsuario = [];
          }
          if(filtroTipoCliente != null){
            filtroTipoCliente =  filtroTipoCliente;
          } else {
            filtroTipoCliente = [];
          }


          //console.log("despues2 " + itemsCalendario);

          addEvents(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente);
    }

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
      if(!confirm("SEGURO QUE QUIERES ELIMINAR EL EVENTO")){
        return false;
      }
      // delete event
      $("#calendarModal").modal("hide");
      var idAccion = $("#evento").val();
      //alert(eventID);
      $.ajax({		  
        type: "POST",
        url: "Crm/deleteAccion",
        data: {
          idAccion: idAccion
        },
        success: function (json) {
          var filtroUsuario = $("#filtroUsuario").val();
      		var filtroTipoCliente = $("#filtroTipoCliente").val();
      		var filtroTipo = $("#filtroTipoAccion").val();
      		var filtroEstado = $("#filtroEstadoAccion").val();
          cargarCalendario(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente);
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title:'Evento  Eliminado Correctamente!',
        })
        }
      });
    }

    function doSubmit() {
      // add event
      $("#createEventModal").modal("hide");
      var idCliente = $("#idCliente option:selected").val();
      var idTipoAccion = $("#idTipoAccion option:selected").val();
      var accion = $("#accion").val();
      var idEstadoAccion = $("#idEstadoAccion option:selected").val();

      var startDate = $("#startDate").val();
      var startTime = $("#startTime").val();
      var endDate = $("#endDate").val();
      var endTime = $("#endTime").val();
      var start = startDate + " " + startTime + ":00";
      var end = endDate + " " + endTime + ":00";
      var idUsuario = $("#usuario").val();

      //console.log(title + " " + startTime + " " + endtime);
      $.ajax({
        url: "Crm/agregar",
        data: {
          idCliente: idCliente,
          idTipoAccion: idTipoAccion,
          accion: accion,
          idEstadoAccion: idEstadoAccion,
          start: start,
          end: end,
          idUsuario: idUsuario
        },
        type: "POST",
        success: function (json) {
          var filtroUsuario = $("#filtroUsuario").val();
      		var filtroTipoCliente = $("#filtroTipoCliente").val();
      		var filtroTipo = $("#filtroTipoAccion").val();
      		var filtroEstado = $("#filtroEstadoAccion").val();
          cargarCalendario(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente);
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title:'Evento Creado Correctamente!',
        })
        }
      });
    }
    $('#addMensaje').on('click', function () {
      // add event
      $("#createEventModal").modal("hide");
      var idCliente = $("#idClienteEdit option:selected").val();
      var flashBack = $("#flashBack").val();
      var idAccion = $("#evento").val();
      var idUsuario = $("#usuario").val();
      //console.log(title + " " + startTime + " " + endtime);
      $.ajax({
        url: "Crm/addMensajeHistorico",
        data: {
          idAccion: idAccion,
          mensaje: flashBack,
          idCliente: idCliente,
          idUsuario: idUsuario
        },
        type: "POST",
        success: function (json) {
          eventSources = calendar.getEventSources();
          eventSources[0].remove();
          calendar.addEventSource(itemsCalendario);
          calendar.refetchEvents();
          $("#calendarModal").modal("toggle");
        }
      });
    });
    function doUpdate() {
      // add event
      $("#calendarModal").modal("hide");
      var idEstadoAccion = $("#idEstadoAccionEdit option:selected").val();
      var idTipoAccion = $("#idTipoAccionEdit option:selected").val();
      var accion = $("#accionEdit").val();
      // var start = $("#startTimeEdit").val();
      // var end = $("#endTimeEdit").val();
      var startDate = $("#startDateEdit").val();
      var startTime = $("#startTimeEdit").val();
      var endDate = $("#endDateEdit").val();
      var endTime = $("#endTimeEdit").val();
      var start = startDate + " " + startTime + ":00";
      var end = endDate + " " + endTime + ":00";
      var idCliente = $("#idClienteEdit option:selected").val();
      //var flashBack = $("#flashBack").val();
      var idAccion = $("#evento").val();
      var idUsuario = $("#idUsuarioEdit option:selected").val();
      //console.log(title + " " + startTime + " " + endtime);
      $.ajax({		 
        type: "POST",
        url: "Crm/updateAccion",
        data: {
          idAccion: idAccion,
          accion: accion,
          start:start,
          end:end,
          idEstadoAccion: idEstadoAccion,
          //flashBack: flashBack,
          idTipoAccion: idTipoAccion,
          idCliente: idCliente,
          idUsuario: idUsuario
        },
        success: function (data) {
			console.log(data);
          	var filtroUsuario = $("#filtroUsuario").val();
      		var filtroTipoCliente = $("#filtroTipoCliente").val();
      		var filtroTipo = $("#filtroTipoAccion").val();
      		var filtroEstado = $("#filtroEstadoAccion").val();
          cargarCalendario(filtroTipo,filtroEstado,filtroUsuario,filtroTipoCliente);     
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title:'Evento Modificado Correctamente!',
        })  
        }
      });
    }

    function cargarSelect() {
      $.ajax({
        url: "Crm/getClientes",
        data: {
          //idPersona: persona
        },
        type: "POST",
        success: function (data) {
          data = JSON.parse(data);
          let cadena = "<option value='' selected disabled>Selecciona Cliente</option>";
          for (let i = 0; i < data.length; i++) {
            const element = data[i];
            cadena +=
              '<option value="' +
              element["idCliente"] +
              '">' +
              element["denominacion"] +
              "</option>";
          }
          $("select[name='idCliente']").html(cadena);
        }
      });
      $.ajax({
        url: "Crm/getTipoAcciones",
        data: {
          //idPersona: persona
        },
        type: "POST",
        success: function (data) {
          data = JSON.parse(data);
          let cadena2 = "<option value='' selected disabled>Selecciona Tipo Accion</option>";
          for (let i = 0; i < data.length; i++) {
            const element2 = data[i];
            cadena2 +=
              '<option value="' +
              element2["idTipoAccion"] +
              '">' +
              element2["tipoAccion"] +
              "</option>";
          }
          $("select[name='idTipoAccion']").html(cadena2);
        }
      });
      $.ajax({
        url: "Crm/getEstadoAcciones",
        data: {
          //idPersona: persona
        },
        type: "POST",
        success: function (data) {
          data = JSON.parse(data);
          let cadena3 = "<option value='' selected disabled>Selecciona Estado Accion</option>";
          for (let i = 0; i < data.length; i++) {
            const element3 = data[i];
            cadena3 +=
              '<option value="' +
              element3["idEstadoAccion"] +
              '">' +
              element3["estadoAccion"] +
              "</option>";
          }
          $("select[name='idEstadoAccion']").html(cadena3);
        }
      });

      $.ajax({
        url: "Crm/getUsuario",
        data: {
          //idPersona: persona
        },
        type: "POST",
        success: function (data) {
          data = JSON.parse(data);
          let cadena5 = "<option value='' selected disabled>Selecciona Usuario</option>";
          for (let i = 0; i < data.length; i++) {
            const element2 = data[i];
            cadena5 +=
              '<option value="' +
              element2["idUsuario"] +
              '">' +
              element2["usuario"] +
              "</option>";
          }
          $("select[name='idUsuario']").html(cadena5);
        }
      });
    }

    $(".historico").on("click", function (info) {
      let idCliente = $("#idClienteEdit option:selected").val();
      $.ajax({
        url: "Crm/getHistorico",
        data: {
          idCliente: idCliente
        },
        type: "POST",
        success: function (data) {
          $("#timeLineBody").html(data);
          $("#timeLine").modal("toggle");
        }
      });
    });

   
  }
});
