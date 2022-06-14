
	<div class="abs" id="wrapper">
		<div class="abs" id="desktop">
		</div>
	</div>
	<div class="abs" id="bar_bottom">
		<!-- Mostrar  botón de inicio (al dar clic se muestra el menú de la sucursal seleccionada)-->
		<a class="float_left MainIcon" href="#" id="StartMenuBtn">
			<i class="fa fa-home"></i>
		</a>
		<!-- Mostrar  botón de escritorio (sirve para abrir o cerrar ventanas activas)-->
		<!--<div id="Helpers">
			<a class="btn MenuIcon" href="#" id="show_desktop" title="Mostrar Escritorio">
				<i class="fa fa-desktop"></i>
			</a>
		</div>-->
		<!-- Mostrar pestaña con la descripción de la ventana (catálogo, reporte o proceso) abierta-->
		<div id="WindowsContainer" class="col-sm-5 col-md-6 col-lg-7 col-xs-1">
			<ul id="dock"></ul>
		</div>
		<!-- Mostrar reloj-->
		<div id="clock"></div>
		<!-- Mostrar mensajes-->
		<div id="Comments">
			<a id="MensajeriaModular" class="btn MenuIcon MenuAccess" tag="PRINCIPAL" data-toggle="popover" href="administracion/mensajes" title="Mensajes"  >
				<i id="IconMensajes"></i>
			</a>
		</div>
		<!-- Mostrar en el combobox el listado de sucursales a las que tiene acceso el usuario-->
		<div id="Assitant" class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
			<select id="cmbSucursalID_Home" name="intSucursalID_Home" class="form-control"></select>
		</div>
	</div><!-- /bar_bottom -->

	<!-- Formulario genérico que se utiliza para generar reportes PDF/XLS-->
	 <form id="frmReporteGenerico" action="" target="_blank" method="post" hidden>
		 	<!--Div que contendrá los inputs que se enviaran al controlador-->
		 	<div id="divDatosReporte"></div>	      
	 </form>

	<!-- /.Plantilla para cargar las sucursales en el combobox-->  
	<script id="sucursales_Home" type="text/template">
		<option value="0">Seleccione una sucursal</option>
		{{#sucursales}}
		<option value="{{value}}">{{nombre}}</option>
		{{/sucursales}} 
	</script>
	<!-- Javascript con las funciones del formulario-->
	<script type="text/javascript">
		//Regresar sucursales activas del usuario para cargarlas en el combobox
		function cargar_sucursales_home()
		{
			//Hacer un llamado al método del controlador para regresar las sucursales del usuario que se encuentran activas 
			$.post('administracion/sucursales/get_combo_box/home', {},
				function(data)
				{
					$('#cmbSucursalID_Home').empty();
					var temp = Mustache.render($('#sucursales_Home').html(), data);
					$('#cmbSucursalID_Home').html(temp);
					//Variable que se utiliza para asignar el id de la sucursal que se seleccionó antes de recargar la página
					var intSucursalID_Home = '<?php echo $this->session->userdata('sucursal_id') ?>';
					//Asignar id de la sucursal (que se guardó como variable de sesión para evitar perder valor y así mostrar el menú correspondiente)
					$('#cmbSucursalID_Home').val(intSucursalID_Home);
				},
				'json');
		}

		//Función que se utiliza para cargar menú de la sucursal seleccionada
		function cargar_menu_home()
		{
			//Hacer un llamado al método del controlador para cargar menú
			$.ajax({url: 'desktop/get_menu',
					type: 'POST',
					data: {},
					success: function(data) {
						$('.sf-menu').empty();
						$('.sf-menu').append(data);
						jQuery('ul.sf-menu').superfish({
							delay: 0
						});
					}
			});
		}

		


		//Controles o Eventos del bar_bottom
		$(document).ready(function() {
			//---- Script para la búsqueda del menú (cargar el menú de la sucursal seleccionada)
			$('#cmbSucursalID_Home').change(function(event){
				//Hacer un llamado al método del controlador para asignar el id de la sucursal seleccionada como variable de sesión, de esta manera se evitará perder el valor de la sucursal al momento de recargar la página. 
				$.ajax({url:'desktop/set_sucursal',
						type: 'POST',
						data: {intSucursalID:$('#cmbSucursalID_Home').val()},
						success: function(data) {
							//Recargar página con la finalidad de cerrar ventanas abiertas (como: catálogos, reportes, etc.) de la sucursal anterior
							location.reload();
						}
				});
			});
			//Hacer un llamado a la función para cargar sucursales en el combobox 
			cargar_sucursales_home();
			//Hacer un llamado a la función para cargar menú de la sucursal (seleccionada)
			cargar_menu_home();
		});
	</script>