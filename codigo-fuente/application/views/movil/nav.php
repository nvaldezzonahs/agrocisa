
			<!-- Se cierran DIVS para cargar las ventanas en los móviles, se abrieron en el archivo HEADER -->
			</div>
			<div class="FakeWindowFooter"></div>
		</div>
	</div>
	<div class="StartMenu">
		<!--Mostrar logotipo de la empresa-->
		<div class="CompanyInfo">
			<img class="UserImg" src="assets/images/misc/logo.png" />
		</div>
		<!--Mostrar  menu de la sucursal seleccionada-->
		<div class="ContentMenu">
			<div id="dl-menu" class="dl-menuwrapper">
				<ul class="dl-menu"></ul>
			</div>
		</div>  
		<!--Mostrar botones para cambiar contraseña y cerrar sesión-->
		<div class="StartFooter">
			<!--Mostrar usuario que ha iniciado la sesión-->
			<label class="lbl-usuario"><?php echo $this->session->userdata('usuario') ?></label>
			<!--Mostrar botón para cerrar sesión-->
			<a href="index.php/login/cerrar_sesion" title="Cerrar sesión"><i class="fa fa-sign-out fa-fw"></i></a>
			<!--Mostrar botón para cambiar contraseña-->
			<a id="CambiarContrasena" class="MenuAccess" href="seguridad/cambiar_contrasena" title="Cambiar contraseña">
				<i class="fa fa-cog"></i>
			</a>
		</div>   
	</div>
