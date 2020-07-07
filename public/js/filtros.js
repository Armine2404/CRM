

function guardamosFiltrosTablas() {
  $('.filtroColumna').off('change');
  $('.filtroColumna').on('change', function () {
    console.log(this);
    let id = $(this).attr('id');
    let val = $(this).val();
    console.log('LOCAL STORAGE INPUT: ' + id + ' - ' + val);
    localStorage.setItem(id, val);
  });
}

//Escribimos filtro tabla
function escribimosFiltrosTablas(tabla) {
  //columnas
  let columnas = tabla['context'][0]['aoColumns'];

  var archive = [];
  for (var i = 0; i < localStorage.length; i++) {

    if (localStorage.key(i).toUpperCase().includes('FILTRO')) {

      archive[i] = localStorage.getItem(localStorage.key(i));

      if ($('#' + localStorage.key(i)).length && archive[i] != "") {
        // it exists
        console.log('Hay filtro');
        console.log(localStorage.key(i) + ' - ' + archive[i]);

        for (let j = 0; j < columnas.length; j++) {
          if (columnas[j].sTitle.includes(localStorage.key(i))) {
            console.log('Hay columna');
            console.log(j + ' - ' + columnas[j].sTitle);
            $('#' + localStorage.key(i)).val(archive[i]);
            tabla.column(j).search(archive[i]).draw();
            $('#' + localStorage.key(i)).click();
          }
        }
      }
    }
  }
  console.log('Lo Buscamos');
}


function guardamosFiltrosSelect() {
  $('.filtros_select').on('change');
  $('.filtros_select').on('change', function () {
    let id = $(this).attr('id');
    let val = $(this).val();
    console.log('LOCAL STORAGE INPUT: ' + id + ' - ' + val);
    localStorage.setItem(id, val);
  });
}

//Escribimos filtro tabla
function escribimosFiltrosSelect() {

  var archive = [];
  for (var i = 0; i < localStorage.length; i++) {

    if (localStorage.key(i).toUpperCase().includes('FILTRO')) {

      archive[i] = localStorage.getItem(localStorage.key(i));
      console.log(localStorage.key(i) + ' - ' + archive[i]);

      if ($('#' + localStorage.key(i)).length && archive[i] != "") {
        // it exists
        console.log('Hay filtro');
        //  console.log(localStorage.key(i)+' - '+archive[i]+' - '+$('#'+localStorage.key(i)).is('select'));
        let vars = archive[i].split(',');
        console.log(vars);
        for (let v = 0; v < vars.length; v++) {
          if (Number(vars[v]) != NaN) {
            v = Number(vars[v]);
          }
          //$('#'+localStorage.key(i)).val(vars[v]).change();
        }
        console.log("$('#" + localStorage.key(i) + "')");
        console.log(vars);
        $('#' + localStorage.key(i)).val(vars).change();
      }
    }
  }
  console.log('Lo Buscamos');
}
