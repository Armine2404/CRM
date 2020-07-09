// (function ($) {
//   "use strict";

$(document).ready(function () {
    // ocultar y enseñar culumnas de tablas y cambiar el color
	$('a.toggle-viss').on('click', function () {
		if ($(this).attr('data-click-state') == 1) { 
			$(this).attr('data-click-state', 0);
			$(this).css('color', 'black')
		} else {
			$(this).attr('data-click-state', 1);
			$(this).css('color', 'red')
		}
	});
	$('a.roj').on('click', function () {
		if ($(this).attr('data-click-state') == 1) {
			$(this).attr('data-click-state', 0);
			$(this).css('color', 'red')
		} else {
			$(this).attr('data-click-state', 1);
			$(this).css('color', 'black')
		}
	});
	//  $.fn.dataTable.moment( "DD-MM-YYYY" );
	//$.fn.modal.Constructor.prototype.enforceFocus = $.noop;

	$('#ModalEdit').on('hidden.bs.modal', function () {
		$('#delete').trigger("reset");
		$('#edit').trigger("reset");
		$('#add').trigger("reset");
	});

	$('#ModalDelete').on('hidden.bs.modal', function () {
		$('#delete').trigger("reset");
		$('#edit').trigger("reset");
		$('#add').trigger("reset");
	});

	$('#ModalAdd').on('hidden.bs.modal', function () {
		$('#delete').trigger("reset");
		$('#edit').trigger("reset");
		$('#add').trigger("reset");
	});

	$('#ModalAdd').on('shown.bs.modal', function () {
		$('#add').trigger("reset");
	});


	// CLIENTES
	if (window.location.pathname.includes('/clientes')) {

		/* Añdir cajas de busqueda a las cabeceras */
		console.log('BUSCAMOS CLIENTES');
		$('#table_clientes thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let clientes = $('#table_clientes').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "Clientes/getClientes", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{

					targets: [0, 7, 8, 9, 10, 11, 12, 13, 14],
					"bVisible": false
				},
				{
					targets: 15,
					render: function (data, type, row, meta) {
						let edit = '<a href=""  data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="trtr  btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-denominacion="' + row[1] + '"><span class="fa fa-trash"></span></a>';
						return edit + " " + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_clientes').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-viss').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = clientes.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$('a.roj').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = clientes.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_clientes').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_clientes').DataTable();
		$('.modalAddBtn').off('click.datos');
		$('.modalAddBtn').on('click.datos', function () {
			//Select Roles
			$.ajax({
				type: 'POST',
				url: 'EstadoCliente/getEstadoClienteSelect',
				data: {}
			}).done(function (data) {
				console.log(data);
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var estado = JSON.parse(data);
				$.each(estado, function (key, value) {
					$('#selectEstado')
						.append($('<option>', {
								value: value['idEstadoCliente']
							})
							.text(value['estadoCliente']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});
		});

		// EDIT AND DELETE MODALS
		$('#table_clientes').on('click', '.edit', function () {

			var id = $(this).data('id');
			$('[name="id"]').val(id);

			//Search accion
			let url = 'Clientes/getCliente/' + id;
			$.ajax({
				type: 'POST',
				url: url,
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				//	console.log('DATOS ACCION:');
				data = JSON.parse(data);
				//	console.log(data);
				//Select Usuarios
				$.ajax({
					type: 'POST',
					url: 'EstadoCliente/getEstadoClienteSelect',
					data: {}
				}).done(function (data2) {
					//   var linea = document.getElementById("idLineaNegocio");// Set selected
					var estados = JSON.parse(data2);
					$('#selectEstadoEdit').empty();

					$.each(estados, function (key, value) {
						$('#selectEstadoEdit')
							.append($('<option>', {
									value: value['idEstadoCliente']
								})
								.text(value['estadoCliente']));
					});
					$('#selectEstadoEdit').val(data['idEstadoCliente']).change();
				}).fail(function () {
					alert('Hubo un error al cargar los datos.');
				});

				$('[name="denominacion"]').val(data['denominacion']);
				$('[name="direccion"]').val(data['direccion']);
				$('[name="cif"]').val(data['cif']);
				$('[name="poblacion"]').val(data['poblacion']);
				$('[name="provincia"]').val(data['provincia']);
				$('[name="codigoPostal"]').val(data['codigoPostal']);
				$('[name="telefono"]').val(data['telefono']);
				$('[name="contacto"]').val(data['contacto']);
				$('[name="email"]').val(data['email']);
				$('[name="cuentaBancaria"]').val(data['cuentaBancaria']);
				$('[name="facturado"]').val(data['facturado']);
				$('[name="objetivo"]').val(data['objetivo']);
				if (data['fechaAlta'] != null) {
					$('[name="fechaAlta"]').val(data['fechaAlta']);
				}
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});
		});
		$('#table_clientes').on('click', '.delete', function () {
			var idCliente = $(this).data('id');
			var denominacion = $(this).data('denominacion');

			$('[name="id"]').val(idCliente);
			$('[name="denominacion"]').val(denominacion);
		});
	}
	// END CLIENTES

	// ESTADO CLIENTES
	else if (window.location.pathname.includes('/estadoCliente')) {

		/* Añdir cajas de busqueda a las cabeceras */
		console.log('BUSCAMOS ESTADOS CLIENTES');
		$('#table_esclientes thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let estadoCliente = $('#table_esclientes').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "EstadoCliente/getEstadoCliente", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{

					targets: [0],
					"bVisible": false
				},
				{
					targets: 2,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" data-estado="' + row[1] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-estado="' + row[1] + '"  ><span class="fa fa-trash"></span></a>';
						return edit + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that.search(this.value).draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_esclientes').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = estadoCliente.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_esclientes').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_esclientes').DataTable();
		// EDIT AND DELETE MODALS
		$('#table_esclientes').on('click', '.edit', function () {


			var id = $(this).data('id');
			var estado = $(this).data('estado');
			$('[name="id"]').val(id);
			$('[name="estado"]').val(estado);

		});
		$('#table_esclientes').on('click', '.delete', function () {
			var id = $(this).data('id');
			var estado = $(this).data('estado');


			$('[name="id"]').val(id);
			$('[name="estado"]').val(estado);
		});
	}
	// END ESTADO CLIENTES

	// USUARIOS
	else if (window.location.pathname.includes('/usuarios')) {

		/* Añdir cajas de busqueda a las cabeceras */
		$('#table_usuarios thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let usuarios = $('#table_usuarios').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "usuarios/getUsuariosTabla", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{
					targets: [0, 1],
					"bVisible": false
				},
				{
					targets: 6,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" data-rol="' + row[1] + '"  data-user="' + row[2] + '"  data-email="' + row[3] + '"  data-pass="' + row[5] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-user="' + row[2] + '"  ><span class="fa fa-trash"></span></a>';
						return edit + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_usuarios').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = usuario.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_usuario').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_usuarios').DataTable();
		$('.modalAddBtn').off('click.datos');
		$('.modalAddBtn').on('click.datos', function () {
			//Select Roles
			$.ajax({
				type: 'POST',
				url: 'Roles/getRolesSelect',
				data: {}
			}).done(function (data) {
				var roles = JSON.parse(data);
				$('#selectRol').empty();
				$.each(roles, function (key, value) {
					$('#selectRol')
						.append($('<option>', {
								value: value['idRol']
							})
							.text(value['nombreRol']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});
		});

		// EDIT AND DELETE MODALS
		$('#table_usuarios').on('click', '.edit', function () {

			var rol = $(this).data('rol');
			var id = $(this).data('id');
			$('[name="id"]').val(id);
			var user = $(this).data('user');
			$('[name="usuario"]').val(user);
			var email = $(this).data('email');
			$('[name="email"]').val(email);
			var pass = $(this).data('pass');
			$('[name="passEdit"]').val(pass);
			//Select Roles
			$.ajax({
				type: 'POST',
				url: 'Roles/getRolesSelect',
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var roles = JSON.parse(data);

				$('#selectRolEdit').empty();
				$.each(roles, function (key, value) {
					$('#selectRolEdit')
						.append($('<option>', {
								value: value['idRol']
							})
							.text(value['rol']));
				});
				$('#selectRolEdit').val(rol).change();
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});


		});
		$('#table_usuarios').on('click', '.delete', function () {
			var idUsuario = $(this).data('id');
			var usuario = $(this).data('user');

			$('[name="id"]').val(idUsuario);
			$('[name="usuario"]').val(usuario);
		});
	}
	// END USUARIOS

	// ROLES
	else if (window.location.pathname.includes('/roles')) {

		/* Añdir cajas de busqueda a las cabeceras */
		console.log('BUSCAMOS ROLES');
		$('#table_roles thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let roles = $('#table_roles').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "roles/getRoles", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{

					targets: [0],
					"bVisible": false
				},
				{
					targets: 2,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" data-rol="' + row[1] + '"><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-rol="' + row[1] + '" ><span class="fa fa-trash"></span></a>';

						if (row[0] != 1 && row[0] != 2) {
							return edit + deleteRow;
						}
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_roles').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = roles.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_roles').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_roles').DataTable();
		$('#table_roles').on('click', '.edit', function () {


			var id = $(this).data('id');
			var rol = $(this).data('rol');
			$('[name="id"]').val(id);
			$('[name="rol"]').val(rol);

		});
		$('#table_roles').on('click', '.delete', function () {
			var id = $(this).data('id');
			var rol = $(this).data('rol');

			$('[name="id"]').val(id);
			$('[name="rol"]').val(rol);

		});

	}
	// END ROLES

	// ACCIONES
	else if (window.location.pathname.includes('/acciones')) {

		/* Añdir cajas de busqueda a las cabeceras */
		$('#table_acciones thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let acciones = $('#table_acciones').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "Acciones/getAccionesTabla", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{
					targets: [0, 1, 2, 3, 4],
					"bVisible": false
				},
				{
					targets: 14,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-tipo="' + row[7] + '" ><span class="fa fa-trash"></span></a>';
						return edit + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_acciones').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = acciones.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$('a.toggle-vis').on('click', function () {
			if ($(this).attr('data-click-state') == 1) {
				$(this).attr('data-click-state', 0);
				$(this).css('color', 'black')
			} else {
				$(this).attr('data-click-state', 1);
				$(this).css('color', 'red')
			}
		});


		$.fn.dataTable.ext.errMode = 'none';
		$('#table_acciones').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();

		$('#table_acciones').DataTable();

		$('.modalAddBtn').off('click.datos');
		$('.modalAddBtn').on('click.datos', function () {

			//Select Usuarios
			$.ajax({
				type: 'POST',
				url: 'Usuarios/getUsuariosSelect',
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var usuarios = JSON.parse(data);
				$('#selectUsuario').empty();

				$.each(usuarios, function (key, value) {
					$('#selectUsuario')
						.append($('<option>', {
								value: value['idUsuario']
							})
							.text(value['usuario']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});

			//Select Clientes
			$.ajax({
				type: 'POST',
				url: 'Clientes/getClientesSelect',
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var clientes = JSON.parse(data);
				$('#selectCliente').empty();

				$.each(clientes, function (key, value) {
					$('#selectCliente')
						.append($('<option>', {
								value: value['idCliente']
							})
							.text(value['denominacion']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});

			//Select Tipo Acciones
			$.ajax({
				type: 'POST',
				url: 'TipoAcciones/getTipoAccionesSelect',
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var tipo_acciones = JSON.parse(data);
				$('#selectTipoAccion').empty();

				$.each(tipo_acciones, function (key, value) {
					$('#selectTipoAccion')
						.append($('<option>', {
								value: value['idTipoAccion']
							})
							.text(value['tipoAccion']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});

			//Select Estado Acciones
			$.ajax({
				type: 'POST',
				url: 'EstadosAcciones/getEstadosAccionesSelect',
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				var estado_acciones = JSON.parse(data);
				$('#selectEstadoAccion').empty();

				$.each(estado_acciones, function (key, value) {
					$('#selectEstadoAccion')
						.append($('<option>', {
								value: value['idEstadoAccion']
							})
							.text(value['estadoAccion']));
				});
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});
		});

		// EDIT AND DELETE MODALS
		$('#table_acciones').on('click', '.edit', function () {


			var id = $(this).data('id');
			$('[name="id"]').val(id);

			//Search accion
			let url = 'Acciones/getAccion/' + id;
			$.ajax({
				type: 'POST',
				url: url,
				data: {}
			}).done(function (data) {
				//   var linea = document.getElementById("idLineaNegocio");// Set selected
				//	console.log('DATOS ACCION:');
				data = JSON.parse(data);
				//	console.log(data);
				//Select Usuarios
				$.ajax({
					type: 'POST',
					url: 'Usuarios/getUsuariosSelect',
					data: {}
				}).done(function (data2) {
					//   var linea = document.getElementById("idLineaNegocio");// Set selected
					var usuarios = JSON.parse(data2);
					$('#selectUsuarioEdit').empty();

					$.each(usuarios, function (key, value) {
						$('#selectUsuarioEdit')
							.append($('<option>', {
									value: value['idUsuario']
								})
								.text(value['usuario']));
					});
					$('#selectUsuarioEdit').val(data['idUsuario']).change();
				}).fail(function () {
					alert('Hubo un error al cargar los datos.');
				});

				//Select Clientes
				$.ajax({
					type: 'POST',
					url: 'Clientes/getClientesSelect',
					data: {}
				}).done(function (data2) {
					//   var linea = document.getElementById("idLineaNegocio");// Set selected
					var clientes = JSON.parse(data2);
					$('#selectClienteEdit').empty();

					$.each(clientes, function (key, value) {
						$('#selectClienteEdit')
							.append($('<option>', {
									value: value['idCliente']
								})
								.text(value['denominacion']));
					});
					$('#selectClienteEdit').val(data['idCliente']).change();
				}).fail(function () {
					alert('Hubo un error al cargar los datos.');
				});

				//Select Tipo Acciones
				$.ajax({
					type: 'POST',
					url: 'TipoAcciones/getTipoAccionesSelect',
					data: {}
				}).done(function (data2) {
					//   var linea = document.getElementById("idLineaNegocio");// Set selected
					var tipo_acciones = JSON.parse(data2);
					$('#selectTipoAccionEdit').empty();

					$.each(tipo_acciones, function (key, value) {
						$('#selectTipoAccionEdit')
							.append($('<option>', {
									value: value['idTipoAccion']
								})
								.text(value['tipoAccion']));
					});
					$('#selectTipoAccionEdit').val(data['idTipoAccion']).change();
				}).fail(function () {
					alert('Hubo un error al cargar los datos.');
				});

				//Select Estado Acciones
				$.ajax({
					type: 'POST',
					url: 'EstadosAcciones/getEstadosAccionesSelect',
					data: {}
				}).done(function (data2) {
					//   var linea = document.getElementById("idLineaNegocio");// Set selected
					var estado_acciones = JSON.parse(data2);
					$('#selectEstadoAccionEdit').empty();

					$.each(estado_acciones, function (key, value) {
						$('#selectEstadoAccionEdit')
							.append($('<option>', {
									value: value['idEstadoAccion']
								})
								.text(value['estadoAccion']));
					});
					$('#selectEstadoAccionEdit').val(data['idEstadoAccion']).change();
				}).fail(function () {
					alert('Hubo un error al cargar los datos.');
				});
				$('[name="accion"]').val(data['accion']);
				if (data['created'] != null) {
					$('[name="created"]').val(data['created'].replace(' ', 'T'));
				}
				if (data['start'] != null) {
					$('[name="start"]').val(data['start'].replace(' ', 'T'));
				}
				if (data['end'] != null) {
					$('[name="end"]').val(data['end'].replace(' ', 'T'));
				}
				if (data['done'] != null) {
					$('[name="done"]').val(data['done'].replace(' ', 'T'));
				}
			}).fail(function () {
				alert('Hubo un error al cargar los datos.');
			});
		});
		$('#table_acciones').on('click', '.delete', function () {
			var idAccion = $(this).data('id');
			var tipo = $(this).data('tipo');
			var texto = idAccion + ' - ' + tipo;

			$('[name="id"]').val(idAccion);
			$('[name="accion"]').val(texto);
		});

	}
	// END ACCIONES

	// ESTADOS ACCIONES
	else if (window.location.pathname.includes('/estadosAcciones')) {

		/* Añdir cajas de busqueda a las cabeceras */
		$('#table_esAcciones thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let estadosAcciones = $('#table_esAcciones').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "EstadosAcciones/getEstadosAcciones", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{
					targets: [0],
					"bVisible": false
				},
				{
					targets: 2,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '" data-estado="' + row[1] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '" data-estado="' + row[1] + '" ><span class="fa fa-trash"></span></a>';
						return edit + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_esAcciones').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = estadosAcciones.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_esAcciones').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_esAcciones').DataTable();
		// EDIT AND DELETE MODALS
		$('#table_esAcciones').on('click', '.edit', function () {


			var id = $(this).data('id');
			var estado = $(this).data('estado');
			$('[name="id"]').val(id);
			$('[name="estado"]').val(estado);

		});
		$('#table_esAcciones').on('click', '.delete', function () {
			var id = $(this).data('id');
			var estado = $(this).data('estado');


			$('[name="id"]').val(id);
			$('[name="estado"]').val(estado);
		});
	}
	// END ESTADOS ACCIONES

	// TIPO ACCIONES
	else if (window.location.pathname.includes('/tipoAcciones')) {

		/* Añdir cajas de busqueda a las cabeceras */
		console.log('BUSCAMOS ESTADOS CLIENTES');
		$('#table_tipAcciones thead th').each(function () {
			var title = $(this).text();
			$(this).html(title + '</br><input type="text" class="col-search-input" style="margin-top:10px;" placeholder="" />');
		});

		let tipoAcciones = $('#table_tipAcciones').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "TipoAcciones/getTipoAcciones", // ../Controlador/funcion
			"info": false,
			"language": {
				"url": "datatables/Languages/Spanish.json"
			},
			"columnDefs": [{
					targets: [0],
					"bVisible": false
				},
				{
					targets: 2,
					render: function (data, type, row, meta) {
						let edit = '<a href="" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-warning btn-sm edit"' +
							' data-id="' + row[0] + '"  data-tipo="' + row[1] + '" ><span class="fa fa-edit"></span></a>';
						let deleteRow = '<a href="" data-toggle="modal" data-target="#ModalDelete"  class="btn btn-danger btn-sm delete"' +
							' data-id="' + row[0] + '"  data-tipo="' + row[1] + '" ><span class="fa fa-trash"></span></a>';
						return edit + deleteRow;
					}

				},
				{
					className: "dt-center",
					targets: ["_all"]
				}
			],
			'responsive': true,
			'dom': 'lBfrtip',
			/* codigo para ejecutar la busqueda por columna de la tabla */
			'initComplete': function () {
				var api = this.api();
				// Apply the search
				api.columns().every(function () {
					var that = this;
					$('input', this.header()).on('keyup change', function () {
						if (that.search() !== this.value) {
							that
								.search(this.value)
								.draw();
						}
					});
				});
			},
			"buttons": [{
					"extend": 'excelHtml5',
					"text": '<i class="fas fa-file-excel" style="color:green;"></i>',
					"titleAttr": 'Exportar a Excel',
					"className": 'btn btn-success',
					format: {
						body: function (data, row, column, node) {
							data = $('<p>' + data + '</p>').text();
							data = data.replace('.', '')
							return $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
						}
					}
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
					"titleAttr": 'Copiar filas'
				}
			]

		});


		$('#table_tipAcciones').css('visibility', 'visible');

		//Hide-show datatable columns
		$('a.toggle-vis').on('click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = tipoAcciones.column($(this).attr('data-column'));
			// Toggle the visibility
			column.visible(!column.visible());
		});
		$.fn.dataTable.ext.errMode = 'none';
		$('#table_tipAcciones').on('error.dt', function (e, settings, techNote, message) {
			console.log('An error has been reported by DataTables: ', message);
		}).DataTable();
		$('#table_tipAcciones').DataTable();
		$('#table_tipAcciones').on('click', '.edit', function () {


			var id = $(this).data('id');
			var tipo = $(this).data('tipo');
			$('[name="id"]').val(id);
			$('[name="tipo"]').val(tipo);

		});
		$('#table_tipAcciones').on('click', '.delete', function () {
			var id = $(this).data('id');
			var tipo = $(this).data('tipo');

			$('[name="id"]').val(id);
			$('[name="tipo"]').val(tipo);
		});

	}
	// END TIPO ACCIONES
	// END ROLES


});
// }) ;