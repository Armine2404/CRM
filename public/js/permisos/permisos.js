$(document).ready(function () {
    // creamos un array para recoger los datos de los checkbox de la pantalla actualizacion permisos
    $("#btnPermisos").on("click", function () {
        let valoresCheck = [];
    $("input[type=checkbox]").each(function (index, check) {
      if (this.checked) {
        valoresCheck[index] = [check.name, "ver"];
      } else {
        valoresCheck[index] = [check.name, "ocultar"];
      }
    });
   //console.log(valoresCheck);
    // enviamos por ajax al controlador permisos los datos para que actualice el fichero

    $.ajax({
        type: "POST",
        url: "Permisos/actualizarPermisos",
        data: {
          valoresCheck: valoresCheck,
        },
        success: function (response) {
         // alert(response);
           // ventana de alerta avisando que los permisos se han actualizado con exito
          Swal.fire({
            icon: 'success',
            //title: response,
            text: response,
            //footer: '<a href>Why do I have this issue?</a>'
          })
        },
        error: function (error) {
                       // ventana de alerta avisando que los permisos se han actualizado con exito
          Swal.fire({
            icon: 'success',
            //title: response,
            text: 'no se han actualizado los datos',
            //footer: '<a href>Why do I have this issue?</a>'
          })
        }
      });
    
     
  });



   
});
