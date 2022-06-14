jQuery(document).ready(function() {
	//Icono de home en el menú principal
	$("#MainMenu").click(function(e){
		e.preventDefault();
		//Verificar estado del menú
		if ($('div.StartMenu:visible').length) {
			$('div.StartMenu').hide();
		}
		else {
			$('div.StartMenu').show();
			$('div.ToolsMenu').hide();
		}
		return false;
	});

	$('#cmbSucursalID_Movil').change(function(event){
		//Hacer un llamado al método del controlador para asignar el id de la sucursal seleccionada como variable de sesión
		$.ajax({url:'movil/set_sucursal',
				type: 'POST',
				data: {intSucursalID:$('#cmbSucursalID_Movil').val()},
				success: function(data) {
					//Redireccionar a la página principal del sistema (con la finalidad de cerrar ventanas abiertas de la sucursal anterior)
					location.href = 'movil';
				}
		});
	});

	//Regresar sucursales activas del usuario para cargarlas en el combobox
	function cargar_sucursales_movil(intSucursalID = 0)
	{
		//Hacer un llamado al método del controlador para regresar las sucursales del usuario que se encuentran activas 
		$.ajax({
				type: 'GET',
				url: 'administracion/sucursales/get_combo_box/home',
				dataType: 'json',
				success: function(data) {
					$('#cmbSucursalID_Movil').append('<option value="0">Seleccione una sucursal</option>');
					//Hacer recorrido para agregar sucursales del usuario en el combobox 
					$.each(data.sucursales, function(key, registro) {
						//Agregar opción en el combobox
						$('#cmbSucursalID_Movil').append('<option value='+registro.value+'>'+registro.nombre+'</option>');
					});
					//Asignar id de la sucursal (que se guardó como variable de sesión para evitar perder valor y así mostrar el menú correspondiente)
					$('#cmbSucursalID_Movil').val(intSucursalID);
				},
				error: function(data) {
					alert('error');
				}
		});
	}

	//Función que se utiliza para cargar menú de la sucursal seleccionada
	function cargar_menu_movil()
	{
		//Hacer un llamado al método del controlador para cargar menú
		$.ajax({url: 'movil/get_menu',
				type: 'POST',
				data: {},
				success: function(data) {
					$('.dl-menu').empty();
					$('.dl-menu').append(data);
					$('#dl-menu').dlmenu();
				}
		});
	}

	/*Hacer un llamado al método del controlador para regresar el número de mensajes nuevos del usuario
      por un intervalo de tiempo.
    */
    setInterval( function() {
        /*Hacer un llamado al método del controlador para regresar el número de mensajes nuevos del usuario,
          *de esta manera se cambiará el icono del mensaje*/
        $.ajax({url: 'administracion/mensajes/get_mensajes_nuevos',
            	type: 'POST',
            	data: {},
	            success: function(data) {
	              //Si hay datos
	                    if(data.row)
	                    {
	                      //Quitar clases del icono mensaje
			              $('#IconMensajes').removeClass("fa fa-envelope mensajes-NUEVOS")
			              $('#IconMensajes').removeClass("fa fa-envelope-open");
	              
	                      //Si hay nuevos mensajes para el usuario
	                      if(data.row.total_mensajes_nuevos > 0)
	                      { 
	                        //Agregar icono de mensaje cerrado
	                        $('#IconMensajes').addClass("fa fa-envelope mensajes-NUEVOS");
	                      }
	                      else
	                      {
	                        //Agregar icono de mensaje abierto
	                        $('#IconMensajes').addClass("fa fa-envelope-open");
	                      }
	                    }
	        	}
        	});
    },1000);

	//Hacer un llamado al método del controlador para regresar el id de la sucursal seleccionada
	$.ajax({
			url: 'movil/get_sucursal',
			success: function(data) {
				//Hacer un llamado a la función para cargar sucursales en el combobox 
				cargar_sucursales_movil(data);
				//Si el id de la sucursal es mayor que cero (existe sucursal seleccionada)
				if (data > 0) {
					//Hacer un llamado a la función para cargar menú
					cargar_menu_movil();
				}
			}
	});
});