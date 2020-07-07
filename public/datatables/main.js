$(document).ready(function() {
    $('#example').DataTable( {
        "dom": 'lBfrtip',
    "buttons": [
        {
            "extend": 'excelHtml5',
            "text": '<i class="fas fa-file-excel" style="color:green;"></i>',
            "titleAttr": 'Exportar a Excel',
            "className": 'btn btn-success'
        },
        {
            "extend": 'pdfHtml5',
            "text": '<i class="fas fa-file-pdf" style="color:red;"></i>',
            "titleAttr": 'Exportar a PDF',
            "className": 'btn btn-danger'
        },
        {
            "extend": 'print',
            "text": '<i class="fas fa-print" style="color:blue;"></i>',
            "titleAttr": 'Imprimir',
            "className": 'btn btn-info'
        },
        {
            "extend": 'copy',
            "text": '<i class="fas fa-copy" style="color:black;"></i>',
            "titleAttr" : 'Copiar filas'
        }
        
    ]
       
    } );
} );
