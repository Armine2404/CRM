$(document).ready(function () {
   
    $("#btnBuscadorClientes").on("click", function (e) {
        e.preventDefault();
        var cliente1 = $('#exampleFormControlSelect1').val();
        var cliente2 = $('#exampleFormControlSelect2').val();
        var cliente3 = $('#exampleFormControlSelect3').val();
        var cliente4 = $('#exampleFormControlSelect4').val();
  //console.log(criterios);
    // enviamos por ajax al controlador clientes/buscadorClientes los datos del formulario para la busqueda
    $.ajax({
        type: "POST",
        url: "BuscadorClientes/resultSearchCustomers",
        data: {
          cliente1:cliente1,cliente2:cliente2,cliente3:cliente3,cliente4:cliente4
        },
        success: function (response) {
            $("#respuesta").html(response);
          //alert("Esto es lo que llega");
         // $("#respuesta").html("aqui estamos");
          
        }
      }); // end of ajax
    
     
  }); // end of click



   
}); // end of ready
