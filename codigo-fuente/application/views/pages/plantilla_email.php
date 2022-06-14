<html>
	<body>
		<div class="panel-content">
			<div class="container-fluid">
				<!-- Diseño de la tabla-->
				<table width="100%">
					<!--Logotipo de la empresa-->
					<tr bgcolor= "#E3E3E3"  height="150">
						<td align="center">
							<img src="<?php echo base_url(LOGOTIPO) ?>" alt="Logotipo <?php echo TITULO_NAVEGADOR ?>"/>
						</td>
					</tr>
					<!--Título (asunto)-->
					<tr bgcolor= "#F8F9FB" height="120">
						<td style="font-size:48px; font-family:impact; text-align: center;">
							<strong><?php  echo  $strTitulo; ?></strong>
						</td>
					</tr>
					<!--Mensaje-->
					<tr bgcolor= "#EDEEF0" height="120">
						<td  style="font-size:20px; text-align: justify;">
							<strong><?php  echo  $strComentarios; ?></strong>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>


