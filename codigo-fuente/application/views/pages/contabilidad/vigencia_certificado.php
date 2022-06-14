	


	<!--Javascript-->
	<script type="text/javascript">

		//Función para regresar los días vigentes del certificado (a punto de caducar)
		function get_dias_vigencia_certificado_contabilidad()
		{
			//Hacer un llamado al método del controlador para regresar la vigencia del certificado
			$.post('contabilidad/certificados/get_vigencia',
			       {
			       },
			       function(data) {
			        	//Si la vigencia del certificado esta por terminar 
			            if(data.mensaje)
			            {
			            	//Indicar al usuario el mensaje de vigencia
			            	new $.Zebra_Dialog({
								    source: {
								        inline: '<strong>'+data.mensaje+'</strong>'
								    },
								    title: 'Vigencia del certificado'
								});
			       	    }
			       },
			       'json');
		}


		//Controles o Eventos
		$(document).ready(function() 
		{
			//Hacer un llamado a la función para verificar los días vigentes del certificado
			get_dias_vigencia_certificado_contabilidad();

		});
	</script>