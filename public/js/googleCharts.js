// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':[ 'corechart', 'table', 'bar', 'controls', 'timeline'], 'language': 'es'});

// Analisis Histórico Leads
if(window.location.pathname.includes('/analisisHistorico')){

    $('.page-header').hide();
    $('#intro').removeClass('content');
    google.charts.setOnLoadCallback(function () {

    var loader = $('.loader');
    loader.show();
    //FILTERS
    //Select Clientes
    $.ajax({
      type: 'POST',
      url: '../Clientes/getClientesSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroCliente')
        .append($('<option>', { value : value['idCliente'] })
        .text(value['denominacion']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //Select Tipo Clientes
    $.ajax({
      type: 'POST',
      url: '../EstadoCliente/getEstadoClienteSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroEstadoCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroEstadoCliente')
        .append($('<option>', { value : value['idEstadoCliente'] })
        .text(value['estadoCliente']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    $('#filtroCliente').select2({
      placeholder: "Cliente"
    });
    $('#filtroEstadoCliente').select2({
      placeholder: "Estado"
    });
    setTimeout(function () {
      google.charts.setOnLoadCallback(drawAnalisisLeads('',[],[]));
      google.charts.setOnLoadCallback(drawAnalisisLeadsDesglose('',[],[]));
    },10);

    function drawAnalisisLeads(fecha, usuarios, clientes) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }
      if(usuarios != null){
        usuarios =  usuarios;
      } else {
        usuarios = [];
      }
      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }

      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../Analisis/getAnalisisHistorico',
        dataType: "json",
        data: {
          fecha:  fecha,
          usuarios:  usuarios,
          clientes:  clientes
        },
        async: false
      }).responseText;

      var data = new google.visualization.DataTable(jsonData);
      data.sort({column: 0, desc: true});

      var rows = data.getNumberOfRows();

      var dash = new google.visualization.Dashboard(document.getElementById('dashboardLeadsTabla'));

      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_leads_tabla',
        options: {
          filterColumnIndex: 0,
          ui:{label:'Estado Lead: ', labelStacking: 'horizontal'}
        }
      });

      var tableLeads = new google.visualization.ChartWrapper({
                'chartType': 'Table',
                'containerId': 'table_div_analisis_leads',
                'options': {
                  'width': '100%',
                  'height': 400,
                  'legend': 'none',
                  'colors': ['#4B4453', '#B0A8B9', '#00C0A3', '#845EC2', '#00896F'],
                  'title': 'Año Actual',
                  page: 'enable',
                  pageSize: 10,
                  pagingSymbols: {
                      prev: 'prev',
                      next: 'next'
                  },
                  pagingButtonsConfiguration: 'auto'
                }
      });

      var monthYearFormatter = new google.visualization.DateFormat({
        pattern: "dd-MM-yyy"
      });
      monthYearFormatter.format(data, 1);
      dash.bind([control], [ tableLeads]);
      dash.draw(data);

      let count = 0;

      // Add our selection handler.
      google.visualization.events.addListener(tableLeads, 'select', selectHandler);

      function selectHandler(e) {
        var selectedItem = tableLeads.getChart().getSelection()[0];
        var lead = data.getValue(selectedItem.row, 0);

        google.charts.setOnLoadCallback(drawAnalisisLeadsDesglose(fecha, usuarios, clientes));

      }
      // google.visualization.events.addListener(dash, 'ready', function () {
      //   loader.hide();
      // });

    }

    function drawAnalisisLeadsDesglose(fecha, clientes, estados, lead) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }
      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }
      if(estados != null){
        estados =  estados;
      } else {
        estados = [];
      }

      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../core/model/search/searchAnalisisClientesLeadsTablaDesglose.php',
        dataType: "json",
        data: {
          fecha:  fecha,
          gestores:  gestores,
          clientes:  clientes,
          sucursales:  sucursales,
          origenes:  origenes,
          marcas:  marcas
        },
        async: false
      }).responseText;

      var data = new google.visualization.DataTable(jsonData);
      data.sort({column: 0, desc: true});

      var rows = data.getNumberOfRows();

      var dash = new google.visualization.Dashboard(document.getElementById('dashboardLeadsTablaDesglose'));
      // Create a range slider, passing some options

      var initState= {selectedValues: []};
      if(!isNaN(parseInt(lead))){
        initState= {selectedValues: [lead]};
      }

      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_leads_tabla_desglose',
        options: {
          filterColumnIndex: 0,
          ui:{label:'Lead: ', labelStacking: 'horizontal'}
        },
        state: initState
      });


      var tableLeads = new google.visualization.ChartWrapper({
                'chartType': 'Table',
                'containerId': 'table_div_analisis_leads_desglose',
                'options': {
                  'width': '100%',
                  'height': 400,
                  'legend': 'none',
                  'colors': ['#4B4453', '#B0A8B9', '#00C0A3', '#845EC2', '#00896F'],
                  'title': 'Año Actual',
                  page: 'enable',
                  pageSize: 10,
                  pagingSymbols: {
                      prev: 'prev',
                      next: 'next'
                  },
                  pagingButtonsConfiguration: 'auto'
                }
      });

      var monthYearFormatter = new google.visualization.DateFormat({
        pattern: "dd-MM-yyy"
      });
      monthYearFormatter.format(data, 1);
      monthYearFormatter.format(data, 2);
      dash.bind([control], [ tableLeads]);
      dash.draw(data);

      let count = 0;

      google.visualization.events.addListener(dash, 'ready', function () {
        loader.hide();
      });

    }



    //FILTERS SEARCH

    $('.filtrosClientes').on('change', function() {
      loader.show();
      var fecha = $('#filtroFecha').val();
      var gestores = $('#filtroGestor').val();
      var clientes = $('#filtroCliente').val();
      var sucursales = $('#filtroSucursal').val();
      var origenes = $('#filtroOrigen').val();
      var marcas = $('#filtroMarca').val();

      setTimeout(function () {
        drawAnalisisLeads(fecha, gestores, clientes, sucursales, origenes, marcas);
        drawAnalisisLeadsDesglose(fecha, gestores, clientes, sucursales, origenes, marcas);
      },10);

    });
  });
}

// Analisis Clientes
else if(window.location.pathname.includes('/analisisClientes')){

    $('.page-header').hide();
    $('#intro').removeClass('content');
    let colors = ['#6596c1', '#BC5BAC', '#A12589', '#5B88AE', '#296091',   '#E19934', '#FFC87C',  '#b6d2ea' ];
    google.charts.setOnLoadCallback(function () {

    var loader = $('.loader');
    loader.show();
    //FILTERS


    //Select Clientes
    $.ajax({
      type: 'POST',
      url: '../Clientes/getClientesSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroCliente')
        .append($('<option>', { value : value['idCliente'] })
        .text(value['denominacion']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //Select Tipo Clientes
    $.ajax({
      type: 'POST',
      url: '../EstadoCliente/getEstadoClienteSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroEstadoCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroEstadoCliente')
        .append($('<option>', { value : value['idEstadoCliente'] })
        .text(value['estadoCliente']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    $('#filtroCliente').select2({
      placeholder: "Cliente"
    });
    $('#filtroEstadoCliente').select2({
      placeholder: "Estado"
    });

    setTimeout(function () {
      google.charts.setOnLoadCallback(drawAnalisisClientes('',[],[]));
      google.charts.setOnLoadCallback(drawAnalisisClientesMes('',[],[]));
    },10);

    function drawAnalisisClientes(fecha, clientes, estados) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }

      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }
      if(estados != null){
        estados =  estados;
      } else {
        estados = [];
      }
      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../Analisis/getAnalisisClientesEstados',
        dataType: "json",
        data: {
          fecha:  fecha,
          clientes:  clientes,
          estados:  estados
        },
        async: false
      }).responseText;

      var data = new google.visualization.DataTable(jsonData);

      var dash = new google.visualization.Dashboard(document.getElementById('dashboardClientesEstados'));
      // Create a range slider, passing some options
      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_clientes_estados',
        options: {
          filterColumnIndex: 0
        }
      });

      var thisYear = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_this_year',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Año'
                },
                view: {
                    columns: [0,1]
                }
      });

      var pastYear = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_past_year',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Año anterior'
                },
                view: {
                    columns: [0,2]
                }
      });

      var thisMonth = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_this_month',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Mes',
                  pieHole: 0.3
                },
                view: {
                    columns: [0,5]
                }
      });

      var pastMonth = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_past_month',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Mes anterior',
                  pieHole: 0.3
                },
                view: {
                    columns: [0,6]
                }
      });

      var today = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_today',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'colors': colors,
                  'legend': {position: 'left', textStyle: {fontSize: 7}},
                  'title': 'Día',
                  sliceVisibilityThreshold:0,
                  pieHole: 0.5
                },
                view: {
                    columns: [0,3]
                }
      });

      var yesterday = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_yesterday',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Día anterior',
                  pieHole: 0.5
                },
                view: {
                    columns: [0,4]
                }
      });

      dash.bind([control], [ thisYear, pastYear, thisMonth, pastMonth, today, yesterday]);
      dash.draw(data);

      google.visualization.events.addListener(dash, 'ready', function () {
        loader.hide();
      });

    }

    function drawAnalisisClientesMes(fecha, clientes, estados) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }

      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }
      if(estados != null){
        estados =  estados;
      } else {
        estados = [];
      }
      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../Analisis/getAnalisisClientes',
        dataType: "json",
        data: {
          fecha:  fecha,
          clientes:  clientes,
          estados:  estados
        },
        async: false
      }).responseText;

      var data = new google.visualization.DataTable(jsonData);
       //
      // console.log(data);


       var rows = data.getNumberOfRows();
       var rowsIdsEstados = [];

       var cols = data.getNumberOfColumns();
       var colsIdsEstados = [];
       for( let i = 0; i < cols-4; i ++ ){
         colsIdsEstados.push(i);
       }

       var colsIdsTablas = [];
       for( let i = 0; i < cols-4; i ++ ){
           colsIdsTablas.push(i);
       }
       colsIdsTablas.push(cols-4);
       colsIdsTablas.push(cols-3);
       colsIdsTablas.push(cols-2);
       colsIdsTablas.push(cols-1);

    //   console.log( colsIdsEstados);
       //

      var dash = new google.visualization.Dashboard(document.getElementById('dashboardClientesMeses'));
      // Create a range slider, passing some options
      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_clientes_meses',
        options: {
          filterColumnIndex: 0
        }
      });

      //Create a datatable
      var tableMeses = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_clientes_meses',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        view: {
          columns: colsIdsTablas,
          rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
        }
      });

      var tableDias = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_clientes_dias',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        view: {
          columns: colsIdsTablas,
          rows: [ 2,3,4,5,6,7,8,9,10,11,12]
        }
      });

      var tableYear = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_clientes_year',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        'allowHtml': true,
        view: {
          columns: colsIdsTablas,
          rows: [ 0,1]
        }
      });

      var meses = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          containerId: 'chart_div_clientes_meses',
          options: {
              title : 'Clientes mensuales',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              height: 300,
              width: '100%',
              'colors': colors,
              chartArea: {
                left:"5%", width:"90%",
              },
              legend: 'none',
              explorer: {},
              isStacked: true
          },
          view: {
            columns: colsIdsEstados,
            rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
          }
      });

      var dias  = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          containerId: 'chart_div_clientes_dias',
          options: {
              title : 'Clientes diarios',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              height: 300,
              width: '100%',
              'colors': colors,
              chartArea: {
                left:"5%", width:"70%"
              },
              legend: 'none',
              explorer: {},
              isStacked: true
          },
          view: {
            columns: colsIdsEstados,
            rows: [ 2,3,4,5,6,7,8,9,10,11,12]
          }
      });

      var tiemposMeses = new google.visualization.ChartWrapper({
          chartType: 'LineChart',
          containerId: 'chart_div_clientes_tiempos_meses',
          options: {
              title : 'Facturación Mensual',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              vAxis: {title: 'Horas'},
              height: 300,
              'colors': colors,
              width: '100%',
              chartArea: {
                left:"10%", width:"90%",
              },
              legend: 'none',
              explorer: {}
          },
          view: {
            columns: [0,cols-4,cols-3],
            rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
          }
      });

      var tiemposDias  = new google.visualization.ChartWrapper({
          chartType: 'LineChart',
          containerId: 'chart_div_clientes_tiempos_dias',
          options: {
              title : 'Facturación Diaria',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              vAxis: {title: 'Horas'},
              height: 300,
              'colors': colors,
              width: '100%',
              chartArea: {
                left:"10%", width:"90%"
              },
              legend: 'bottom',
              explorer: {}
          },
          view: {
            columns: [0,cols-4,cols-3],
            rows: [ 2,3,4,5,6,7,8,9,10,11,12]
          }
      });

      var formatter = new google.visualization.ColorFormat();
      formatter.addRange(null, 0, 'red', 'white',);
      formatter.addRange(0, null, 'green', 'white');
      formatter.format(data, cols-1);

      dash.bind([control], [ tableDias, tableMeses, tableYear, meses, dias, tiemposMeses, tiemposDias ]);
      dash.draw(data);

      google.visualization.events.addListener(dash, 'ready', function () {
        loader.hide();
      });

    }



    //FILTERS SEARCH

    $('.filtrosClientes').on('change', function() {
      loader.show();
      var fecha = $('#filtroFecha').val();
      var clientes = $('#filtroCliente').val();
      var estados = $('#filtroEstadoCliente').val();

      setTimeout(function () {
        drawAnalisisClientes(fecha, clientes, estados);
        drawAnalisisClientesMes(fecha, clientes, estados);
      },10);

    });


  });
}

// Analisis Clientes Agenda
else if(window.location.pathname.includes('/analisisAgenda')){

    $('.page-header').hide();
    $('#intro').removeClass('content');
    google.charts.setOnLoadCallback(function () {

    var loader = $('.loader');
    loader.show();
    //FILTERS


    //Select Usuarios
    $.ajax({
      type: 'POST',
      url: '../Usuarios/getUsuariosSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var usuarios = JSON.parse(data);
      $('#filtroUsuario').empty();

      $.each(usuarios, function(key, value) {
        $('#filtroUsuario')
        .append($('<option>', { value : value['idUsuario'] })
        .text(value['usuario']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //Select Clientes
    $.ajax({
      type: 'POST',
      url: '../Clientes/getClientesSelect',
      data: {}
    }).done(function(data){
      //   var linea = document.getElementById("idLineaNegocio");// Set selected
      var clientes = JSON.parse(data);
      $('#filtroCliente').empty();

      $.each(clientes, function(key, value) {
        $('#filtroCliente')
        .append($('<option>', { value : value['idCliente'] })
        .text(value['denominacion']));
      });
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //Select Tipo Acciones
    $.ajax({
      type: 'POST',
      url: '../TipoAcciones/getTipoAccionesSelect',
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
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    //Select Estado Acciones
    $.ajax({
      type: 'POST',
      url: '../EstadosAcciones/getEstadosAccionesSelect',
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
    }).fail(function(){
      alert('Hubo un error al cargar los datos.');
    });

    $('#filtroUsuario').select2({
      placeholder: "Usuario",
    });
    $('#filtroCliente').select2({
      placeholder: "Cliente"
    });
    $('#filtroEstadoAccion').select2({
      placeholder: "Estado"
    });
    $('#filtroTipoAccion').select2({
      placeholder: "Tipo de Acción"
    });

    setTimeout(function () {
      google.charts.setOnLoadCallback(drawAnalisisClientesAgenda('',[],[],[],[]));
      google.charts.setOnLoadCallback(drawAnalisisClientesAgendaMes('',[],[],[],[]));
    },10);

    function drawAnalisisClientesAgenda(fecha, usuarios, clientes, estados, tipos) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }

      if(usuarios != null){
        usuarios =  usuarios;
      } else {
        usuarios = [];
      }
      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }
      if(estados != null){
        estados =  estados;
      } else {
        estados = [];
      }
      if(tipos != null){
        tipos =  tipos;
      } else {
        tipos = [];
      }
      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../Analisis/getAnalisisAgendaEstados',
        dataType: "json",
        data: {
          fecha:  fecha,
          usuarios:  usuarios,
          clientes:  clientes,
          estados:  estados,
          tipos:  tipos
        },
        async: false
      }).responseText;

      let colors = [];
      if( jsonData.includes('progreso')){
        colors.push('#FFC107');
      }
      if( jsonData.includes('Finalizada')){
        colors.push('#00A65A');
      }
      if( jsonData.includes('Pendiente')){
        colors.push('#DD4B39');

      }

      if(colors.length == 0){
        colors = ['black'];
      }
      var data = new google.visualization.DataTable(jsonData);


       var rows = data.getNumberOfRows();
       var rowsIdsEstados = [];
       let color = ['#845EC2', '#C197FF','#00C9A7', '#005B44'];
       for( let i = 0; i < rows-3; i ++ ){
         colors.push(color[i]);
       }
       //
       // var rows = data.getNumberOfRows();
       // var rowsIdsMeses = [];
       // for( let i = 0; i < rows-4; i ++ ){
       //   rowsIdsMeses.push(i);
       // }
       //console.log( rowsIdsMeses);
      var dash = new google.visualization.Dashboard(document.getElementById('dashboardAccionesEstados'));
      // Create a range slider, passing some options
      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_acciones_estados',
        options: {
          filterColumnIndex: 0
        }
      });

      var thisYear = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_this_year',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Año'
                },
                view: {
                    columns: [0,1]
                }
      });

      var pastYear = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_past_year',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Año anterior'
                },
                view: {
                    columns: [0,2]
                }
      });

      var thisMonth = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_this_month',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Mes',
                  pieHole: 0.3
                },
                view: {
                    columns: [0,5]
                }
      });

      var pastMonth = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_past_month',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Mes anterior',
                  pieHole: 0.3
                },
                view: {
                    columns: [0,6]
                }
      });

      var today = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_today',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'colors': colors,
                  'legend': {position: 'left', textStyle: {fontSize: 7}},
                  'title': 'Día',
                  sliceVisibilityThreshold:0,
                  pieHole: 0.5
                },
                view: {
                    columns: [0,3]
                }
      });

      var yesterday = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div_yesterday',
                'options': {
                  'width': '100%',
                  'height': 200,
                  'legend': 'none',
                  'colors': colors,
                  'title': 'Día anterior',
                  pieHole: 0.5
                },
                view: {
                    columns: [0,4]
                }
      });

      dash.bind([control], [ thisYear, pastYear, thisMonth, pastMonth, today, yesterday]);
      dash.draw(data);

      google.visualization.events.addListener(dash, 'ready', function () {
        loader.hide();
      });

    }

    function drawAnalisisClientesAgendaMes(fecha, usuarios, clientes, estados, tipos) {

      if(fecha != null){
        fecha =  fecha;
      } else {
        fecha = '';
      }

      if(usuarios != null){
        usuarios =  usuarios;
      } else {
        usuarios = [];
      }
      if(clientes != null){
        clientes =  clientes;
      } else {
        clientes = [];
      }
      if(estados != null){
        estados =  estados;
      } else {
        estados = [];
      }
      if(tipos != null){
        tipos =  tipos;
      } else {
        tipos = [];
      }
      //Call to the server to get the data
      var jsonData = $.ajax({
        type: 'POST',
        url: '../Analisis/getAnalisisAgenda',
        dataType: "json",
        data: {
          fecha:  fecha,
          usuarios:  usuarios,
          clientes:  clientes,
          estados:  estados,
          tipos:  tipos
        },
        async: false
      }).responseText;

      var data = new google.visualization.DataTable(jsonData);
       //
      // console.log(data);


       var rows = data.getNumberOfRows();
       var rowsIdsEstados = [];

       var cols = data.getNumberOfColumns();
       var colsIdsEstados = [];
       for( let i = 0; i < cols-3; i ++ ){
         colsIdsEstados.push(i);
       }

       var colsIdsTablas = [];
       for( let i = 0; i < cols-3; i ++ ){
         if( i % 2 != 0 || i == 0 ){
           colsIdsTablas.push(i);
         }
       }
       colsIdsTablas.push(cols-3);
       colsIdsTablas.push(cols-2);
       colsIdsTablas.push(cols-1);

    //   console.log( colsIdsEstados);
       //

      var dash = new google.visualization.Dashboard(document.getElementById('dashboardAccionesMeses'));
      // Create a range slider, passing some options
      var control = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'control_div_analisis_acciones_meses',
        options: {
          filterColumnIndex: 0
        }
      });

      //Create a datatable
      var tableMeses = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_acciones_meses',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        view: {
          columns: colsIdsTablas,
          rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
        }
      });

      var tableDias = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_acciones_dias',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        view: {
          columns: colsIdsTablas,
          rows: [ 2,3,4,5,6,7,8,9,10,11,12]
        }
      });

      var tableYear = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'table_div_analisis_acciones_year',
        'options': {
          'width': '100%',
          'height': '100%',
          allowHtml: true,
          chartArea: {
            width: '80%'
          }
        },
        'allowHtml': true,
        view: {
          columns: colsIdsTablas,
          rows: [ 0,1]
        }
      });

      var meses = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          containerId: 'chart_div_acciones_meses',
          options: {
              title : 'Acciones mensuales',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              height: 300,
              width: '100%',
              chartArea: {
                left:"5%", width:"90%",
              },
              legend: 'none',
              explorer: {},
              isStacked: true
          },
          view: {
            columns: colsIdsEstados,
            rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
          }
      });

      var dias  = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          containerId: 'chart_div_acciones_dias',
          options: {
              title : 'Acciones diarias',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              height: 300,
              width: '90%',
              chartArea: {
                left:"5%", width:"90%"
              },
              legend: 'none',
              explorer: {},
              isStacked: true
          },
          view: {
            columns: colsIdsEstados,
            rows: [ 2,3,4,5,6,7,8,9,10,11,12]
          }
      });

      var tiemposMeses = new google.visualization.ChartWrapper({
          chartType: 'LineChart',
          containerId: 'chart_div_acciones_tiempos_meses',
          options: {
              title : 'Tiempo Medio por acción',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              vAxis: {title: 'Horas'},
              height: 300,
              width: '100%',
              chartArea: {
                left:"10%", width:"90%",
              },
              legend: 'none',
              explorer: {}
          },
          view: {
            columns: [0,cols-3],
            rows: [ 13,14,15,16,17,18,19,20,21,22,23,24]
          }
      });

      var tiemposDias  = new google.visualization.ChartWrapper({
          chartType: 'LineChart',
          containerId: 'chart_div_acciones_tiempos_dias',
          options: {
              title : 'Tiempo Medio por acción',
              tooltip: {trigger: 'selection'},
              hAxis: {
                  titleTextStyle: {
                      color: '#333'
                  },
              },
              vAxis: {title: 'Horas'},
              height: 300,
              width: '100%',
              chartArea: {
                left:"10%", width:"90%"
              },
              legend: 'none',
              explorer: {}
          },
          view: {
            columns: [0,cols-3],
            rows: [ 2,3,4,5,6,7,8,9,10,11,12]
          }
      });

      var formatter = new google.visualization.ColorFormat();
      formatter.addRange(null, 0, 'red', 'white',);
      formatter.addRange(0, null, 'green', 'white');
      formatter.format(data, cols-1);

      dash.bind([control], [ tableDias, tableMeses, tableYear, meses, dias, tiemposMeses, tiemposDias ]);
      dash.draw(data);

      google.visualization.events.addListener(dash, 'ready', function () {
        loader.hide();
      });

    }



    //FILTERS SEARCH

    $('.filtrosAcciones').on('change', function() {
      loader.show();
      var fecha = $('#filtroFecha').val();
      var usuarios = $('#filtroUsuario').val();
      var clientes = $('#filtroCliente').val();
      var estados = $('#filtroEstadoAccion').val();
      var tipos = $('#filtroTipoAccion').val();

      setTimeout(function () {
        drawAnalisisClientesAgenda(fecha, usuarios, clientes, estados, tipos);
        drawAnalisisClientesAgendaMes(fecha, usuarios, clientes, estados, tipos);
      },10);

    });


  });
}
