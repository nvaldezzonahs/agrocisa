<!--Mostrar panel de progreso-->
<div id="loader-wrapper">
	<div id="loader"></div>
	<div class="loader-section section-left"></div>
	<div class="loader-section section-right"></div>
</div>

<!--Contenedor del formulario-->
<div id="login">
	<div class="loginbox">
		<div class="row">
			<div class="col-md-12">
				<img class="logo" src="assets/images/misc/logo.png" />
			</div>
		</div>
		<!--Diseño del formulario-->
		<form id="frmLogin" method="post" action="<?php echo base_url()?>login/iniciar_sesion" role="form" class="form-horizontal"  onsubmit="return(false)">
			<!--Contenido-->
			<div class="FormContainer">
				<!--Usuario-->
				<div class="form-group">
					<div class="col-md-12">
						<!-- Campo oculto que se utiliza para asignar el id del usuario en caso de que exista (de esta manera se iniciará sesión)-->
						<input type="hidden" id="txtUsuarioID" name="intUsuarioID" value="" />
						<!-- Campo oculto que se utiliza para asignar la lista de ips recuperadas-->
						<input type="hidden" id="txtListaIPs" name="strListaIps" value="" />
						<label for="txtUsuario">Usuario</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control" tabindex="1" id="txtUsuario" name="strUsuario" />
					</div>
				</div>
				<!--Contraseña-->
				<div class="form-group">
					<div class="col-md-12">
						<label for="txtContrasena">Contraseña</label>
					</div>
					<div class="col-md-12">
						<input type="password" class="form-control" tabindex="1" id="txtContrasena" name="strContrasena" />
					</div>
				</div>
			</div><!--Cierre del contenido--> 
			<div class="form-group">
				<div class="col-xs-3 col-xs-offset-4">
					<!--Botón para acceder al sistema-->
					<button id="btnIngresar" tabindex="2" type="submit">Acceder</button>
				</div>
			</div>
		</form>
	</div><!-- /#loginbox -->
</div><!-- /#login -->

<!-- Script para Obtener la IP (privada del equipo) referencia http://net.ipcalf.com/-->
<script>
	var strListaIP='';
	// NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
	var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;


	if (RTCPeerConnection) (function () {
								var rtc = new RTCPeerConnection({iceServers:[]});
								if (1 || window.mozRTCPeerConnection)
								{      // FF [and now Chrome!] needs a channel/stream to proceed
									rtc.createDataChannel('', {reliable:false});
								};
								rtc.onicecandidate = function (evt)
								{
									// convert the candidate to SDP so we can run it through our general parser
									// see https://twitter.com/lancestout/status/525796175425720320 for details
									if (evt.candidate) grepSDP("a="+evt.candidate.candidate);
								};
								rtc.createOffer(function (offerDesc)
												{
													grepSDP(offerDesc.sdp); 
													rtc.setLocalDescription(offerDesc);
												}, 
												function (e) { console.warn("offer failed", e); });
								var addrs = Object.create(null);
								addrs["0.0.0.0"] = false;
								function updateDisplay(newAddr)
								{
									if (newAddr in addrs) return;
									else addrs[newAddr] = true;
									var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; });
									//Asignar a la variable IP´s encontradas (IPv4 del adaptador de LAN conexión e  IP FÍSICA)
									strListaIP=displayAddrs.join("IP fisica") || "n/a";
									var strPalabra="IP fisica";
									var intNumeroCa=strPalabra.length;
									//Si existe la palabra en la cadena
									//separar datos de la lista donde la segunda dirección ip
									//es la dirección física ejemplo:'192.168.56.1IP fisica192.168.1.252'
									if (strListaIP.indexOf(strPalabra)!=-1)
									{
										/**
										 * Cortar la cadena hasta la palabra IP fisica ejemplo:'192.168.56.1IP fisica'
										 * para asignar a la caja de texto la (segunda)ip  que en este caso  es la IPv4 del adaptador de LAN conexión 
										 * de red inalámbrica
										 * Asignar la posición actual de la palabra IP fisica en la cadena ejemplo: 
										 * En la cadena:192.168.56.1IP fisica 192.168.1.252 
										 * la posición de la palabra es 12
										 */
										var intPosicionPalabra=strListaIP.indexOf(strPalabra);
										/**
										 * Quitar los caracteres de la cadena que se encuentran antes de la posición de la palabra 
										 * ejemplo:192.168.56.1 esta antes de IP fisica da como resultado IP fisica 192.168.1.252 
										 */
										var strResultado = strListaIP.slice(intPosicionPalabra);
										//Quitar los caracteres de la palabra  da como resultado 192.168.1.252 
										strResultado=strResultado.slice(intNumeroCa);
										$('#txtListaIPs').val(strResultado);
									}
									//Si la ip no es la física
									if($('#txtListaIPs').val()=="")
									{
										//Asignar la IPv4 del adaptador de LAN conexión
										$('#txtListaIPs').val(strListaIP);
									}
								//document.getElementById('list').textContent = displayAddrs.join(" or perhaps ") || "n/a";
								}
								function grepSDP(sdp)
								{
									var hosts = [];
									sdp.split('\r\n').forEach(function (line)
															  { // c.f. http://tools.ietf.org/html/rfc4566#page-39
																if (~line.indexOf("a=candidate"))
																{     // http://tools.ietf.org/html/rfc4566#section-5.13
																	var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
																	addr = parts[4],
																	type = parts[7];
																	if (type === 'host') updateDisplay(addr);
																}
																else if (~line.indexOf("c="))
																{       // http://tools.ietf.org/html/rfc4566#section-5.7
																	var parts = line.split(' '),
																	addr = parts[2];
																	updateDisplay(addr);
																}
															  });
								}
							})();
	else
	{
		document.getElementById('list').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
		document.getElementById('list').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically";
	}
</script>

<!--Javascript con las funciones del formulario-->
<script type="text/javascript">
	$("#frmLogin")
		.bootstrapValidator({
			container: 'popover',
			message: 'Este valor no es válido',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				strUsuario: {
					validators: {
						notEmpty: {
							message: 'Escriba el nombre de usuario'
						}
					}
				},
				strContrasena: {
					validators: {
						notEmpty: {
							message: 'Escriba la contraseña'
						}
					}
				}
			}
		})
		.on('success.form.bv', function(e)
		{
			e.preventDefault();
			var postData = $(this).serializeArray();
			var formURL = $(this).attr("action");

			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data) 
				{
					//Si el mensaje obtenido es igual a éxito, los datos del usuario son correctos
					if (data.state === 'éxito')
					{
						//Redireccionar a la página principal del sistema
						location.href = data.pagina;
					}
					else if (data.state === 'exceso_intentos')//Si el usuario a excedido el número de intentos permitidos (suspender usuario)
					{
						//Indicar al usuario que se a execedido de intentos permitidos para ingresar al sistema
						new $.Zebra_Dialog(data.mensaje, {
								'type': 'error',
								'title': data.titulo,
								'buttons': [{caption: 'Aceptar',
											 callback: function () {
												//Hacer un llamado a la función para limpiar los campos del formulario
												nuevo();
											 }
											}]
							});
					}
					else if (data.state === 'error')
					{	
						//Indicar al usuario el mensaje de error
						new $.Zebra_Dialog(data.mensaje, {
								'type': 'error',
								'title': data.titulo,
								'buttons': false,
								'modal': false,
								'auto_close': 2000
							});
						//Hacer un llamado a la función para limpiar los campos del formulario
						nuevo();
					}
					else
					{
						//Recargar página
						location.reload();
					}
				}
			});
		});
	

	//Función para limpiar los campos del formulario
	function nuevo()
	{
		//Limpiar datos del formulario
		$("#frmLogin")[0].reset();
		$("#frmLogin").data('bootstrapValidator').resetForm(true);
		$("#txtUsuario").focus();
	}

	//Controles o Eventos del formulario
	$(document).ready(function()
	{
		$('input:text:visible:first', this).focus(); //Localiza el primer elemento y le hace Focus
	});
</script>