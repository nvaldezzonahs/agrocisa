<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo TITULO_NAVEGADOR ?></title>
		<base href="<?php echo ucwords($this->session->userdata('base_url')) ?>" />

		<!-- Estilos -->
		<link rel="stylesheet" href="assets/css/reset.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css"/>
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css"/>
		<link rel="stylesheet" href="assets/css/superfish.css" />
		<link rel="stylesheet" href="assets/css/superfish-vertical.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrapValidator.min.css" />
		<link rel="stylesheet" href="assets/css/zebra_dialog.min.css" />
		<link rel="stylesheet" href="assets/css/ui.fancytree.min.css" />
		<link rel="stylesheet" href="assets/css/barloading.css" />
		<!-- Estilo Principal -->
		<link rel="stylesheet" href="assets/css/movil.css" />

		<!-- Scripts -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/jquery-ui.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/moment-es.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script> 
		<script src="assets/js/bootstrapValidator.min.js"></script>
		<script src="assets/js/mustache.js"></script>
		<script src="assets/js/jquery.bpopup.js"></script>
		<script src="assets/js/modernizr.custom.js"></script>
		<script src="assets/js/jquery.dlmenu.js"></script>
		<script src="assets/js/superfish.min.js"></script>
		<script src="assets/js/zebra_dialog.min.js"></script>
		<script src="assets/js/jquery.numeric.js"></script>
		<script src="assets/js/jquery.letras.min.js"></script>
		<script src="assets/js/jquery.formatCurrency.min.js"></script>
		<script src="assets/js/jquery.formatCurrency.all.js"></script>
		<script src="assets/js/jquery.fancytree.min.js"></script>
		<script src="assets/js/funciones_zonahs.js"></script>
		<script src="assets/js/movil.js"></script>
		<script src="assets/js/upload.js"></script>
		<script src="assets/js/json2.js"></script>
		<script src="assets/js/loader.js"></script>
		<script src="assets/js/jspdf.debug.js"></script>
		<script src="assets/js/rgbcolor.js"></script> 
    	<script src="assets/js/canvg.js"></script>
	</head>
	<body>
		<header>
			<div class="container-fluid">
				<!-- Mostrar  botón de inicio (al dar clic se muestra el menú de la sucursal seleccionada)-->
				<div class="pull-left">
					<a href="#" id="MainMenu" class="dl-trigger">
						<i class="fa fa-home"></i>
					</a>
				</div>
				<!-- Mostrar en el combobox el listado de sucursales a las que tiene acceso el usuario-->
				<div id="Assitant" class="col-sm-2 col-md-2 col-lg-2 col-xs-7">
					<select id="cmbSucursalID_Movil" name="intSucursalID_Movil" class="form-control"></select>
				</div>
				<!-- Mostrar mensajes-->
				<div class="pull-left">
					<a href="administracion/mensajes" id="MensajeriaModular" class="dl-trigger">
						<i id="IconMensajes"></i>
					</a>
				</div>
			</div>
		</header>
		
		<!-- Formulario genérico que se utiliza para generar reportes PDF/XLS-->
		<form id="frmReporteGenerico" action="" target="_blank" method="post" hidden>
			<!--Div que contendrá los inputs que se enviaran al controlador-->
			<div id="divDatosReporte"></div>	      
		</form>

		<!-- Se abren DIVS para cargar las ventanas en los móviles y se cierra en el archivo NAV -->
		<div id="FakeWindow">
			<div class="FakeWindowContainer">
				<div class="FakeWindowHeader">
					<h3 class="Title" id="Titulo">
						<i class="fa fa-laptop"></i>
						<?php echo $strTitulo ?>
					</h3>
				</div>
				<div class="FakeWindowContent">
					<?php echo $strPermisos; ?>
					<?php echo $strProcesoMenuID; ?>

					