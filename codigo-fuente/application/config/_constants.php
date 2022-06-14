<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Constantes del proyecto
|--------------------------------------------------------------------------
*/
//Ruta del logotipo de la empresa
define('LOGOTIPO', '/assets/images/misc/logo.png');
// Titulo de la ventana del navegador
define('TITULO_NAVEGADOR', 'AGROCISA');
/*Constante que se utiliza para asignar el id de la función Editar del proceso Validación de Prospectos*/
define('VALIDACION_PROSPECTOS', 1205);
/*Constante que se utiliza para asignar el id de la función Editar del proceso Devolución de Anticipos a Clientes*/
define('DEVOLUCION_ANTICIPOS_CLIENTES', 1278);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Cuentas por Pagar)*/
define('AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR', 1312);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Maquinaria)*/
define('AUTORIZAR_ORDENES_COMPRA_MAQUINARIA', 1440);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Refacciones)*/
define('AUTORIZAR_ORDENES_COMPRA_REFACCIONES', 1515);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Cotizaciones 
 *(módulo Maquinaria)*/
define('AUTORIZAR_COTIZACIONES_MAQUINARIA', 1453);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Pedidos 
 *(módulo Maquinaria)*/
define('AUTORIZAR_PEDIDOS_MAQUINARIA', 1458);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Vales de Caja Chica 
 *(módulo Caja)*/
define('AUTORIZAR_VALES_CAJA_CHICA_CAJA', 1481);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Proveedores
 *(módulo Cuentas por pagar)*/
define('AUTORIZAR_PROVEEDORES', 1769);
/*Constante que se utiliza para asignar el id de la cuenta base*/
define('CUENTA_BASE', 1);
/*Constante que se utiliza para asignar el id de la moneda: peso mexicano*/
define('MONEDA_BASE', 1);
/*Constante que se utiliza para asignar el tipo de cambio de la moneda: peso mexicano*/
define('TIPO_CAMBIO_MONEDA_BASE', 1);
/*Constante que se utiliza para asignar el código de la moneda: peso mexicano*/
define('CODIGO_MONEDA_BASE', 'MXN');
/*Constante que se utiliza para asignar el id del método de pago: una sola exhibición */
define('METODO_PAGO_BASE', 1);

/*Constante que se utiliza para asignar el id del método de pago: pago en parcialidades o diferido */
define('METODO_PAGO_PPD', 3);
/*Constante que se utiliza para asignar el id del tipo de relación: CFDI por aplicación de anticipo */
define('TIPO_RELACION_BASE', 7);
/*Constante que se utiliza para asignar el id de la forma de pago: aplicación de anticipos*/
define('FORMA_PAGO_APLICACION_ANTICIPO', 20);
/*Constante que se utiliza para asignar el id de la forma de pago: efectivo */
define('FORMA_PAGO_EFECTIVO', 1);
/*Constante que se utiliza para asignar el id de la forma de pago: cheque nominativo */
define('FORMA_PAGO_CHEQUE', 2);
/*Constante que se utiliza para asignar el id de la forma de pago: transferencia electrónica */
define('FORMA_PAGO_TRANSFERENCIA', 3);
/*Constante que se utiliza para asignar el id de la forma de pago: por definir */
define('FORMA_PAGO_POR_DEFINIR', 22);
/*Constante que se utiliza para asignar el id del uso del CFDI: por definir */
define('USO_CFDI_BASE', 1);
/*Constante que se utiliza para asignar el id de la primer lista de precios*/
define('REFACCION_LISTA_PRECIOS_BASE', 1);
/*Constante que se utiliza para asignar el id del primer motivo de suspensión*/
define('MOTIVO_SUSPENSION_BASE', 1);
/*Constante que se utiliza para asignar el id deL módulo de maquinaria*/
define('MODULO_MAQUINARIA', 1);
/*Constante que se utiliza para asignar el id del módulo de refacciones*/
define('MODULO_REFACCIONES', 2);
/*Constante que se utiliza para asignar el id del módulo de servicio*/
define('MODULO_SERVICIO', 3);
/*Constantes que se utilizan para la paginación de registros*/
//Número máximo de intentos de inicio de sesión
define('INTENTOS_MAXIMOS', 5);
//Número de elementos para la paginación (per_page)
define('PAGINACION_ELEMENTOS', 10);
//Límite de elementos para el autocomplete
define('LIMITE_AUTOCOMPLETE', 5);
/*Constante que se utiliza para el porcentaje de IVA*/
define('PORCENTAJE_IVA', 1.16);
define('IVA', 0.16);
/*Constantes que se utiliza para asignar el valor de la moneda de pagos*/
define('MONEDA_PAGOS', 'XXX');
/*Constantes que se utiliza para asignar el valor del tipo de cambio de pagos*/
define('TIPO_CAMBIO_PAGOS', 0);
/*Constantes que se utiliza para asignar el valor máximo del tipo de cambio*/
define('TIPO_CAMBIO_MAXIMO', 99.9999);
/*Constante que se utiliza para asignar el número de decimales a rendondear  en los movimientos de refacciones y ordenes de compra de refacciones (para visualizar)*/
define('NUM_DECIMALES_MOSTRAR_REFACCIONES',4);

/*Constante que se utiliza para asignar el número de decimales a rendondear en el módulo cuentas por pagar (para visualizar)*/
define('NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR', 2);

/*Constante que se utiliza para asignar el número de decimales a rendondear en el módulo servicio (para visualizar)*/
define('NUM_DECIMALES_MOSTRAR_SERVICIO', 2);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en ordenes de compra de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_PRECIO_UNIT_OC_REFACCIONES',4);
define('NUM_DECIMALES_DESCUENTO_UNIT_OC_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_OC_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_OC_REFACCIONES',4);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en movimientos de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_DESCUENTO_UNIT_MOV_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_PRECIO_UNIT_MOV_REFACCIONES',2);


/*Constantes que se utilizan para asignar el número de decimales a rendondear en requisicón de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_PRECIO_UNIT_REQ_REFACCIONES',2);
define('NUM_DECIMALES_DESCUENTO_UNIT_REQ_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_REQ_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_REQ_REFACCIONES',4);


/*Constantes que se utilizan para asignar el número de decimales a rendondear en ordenes de compra (cuentas por pagar)
(para guardar en la BD) */
define('NUM_DECIMALES_CANTIDAD_OC_CUENTAS_PAGAR',5);
define('NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR',5);
define('NUM_DECIMALES_DESCUENTO_UNIT_OC_CUENTAS_PAGAR',2);
define('NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR',4);
define('NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR',4);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en trabajos foráneos (servicio)
(para guardar en la BD) */
define('NUM_DECIMALES_CANTIDAD_TF_SERVICIO',5);
define('NUM_DECIMALES_COSTO_UNIT_TF_SERVICIO',5);
define('NUM_DECIMALES_DESCUENTO_UNIT_TF_SERVICIO',2);
define('NUM_DECIMALES_IVA_UNIT_TF_SERVICIO',4);
define('NUM_DECIMALES_IEPS_UNIT_TF_SERVICIO',4);
define('NUM_DECIMALES_PRECIO_UNIT_TF_SERVICIO',2);



/*Constantes que se utilizan para hacer el llamado al servicio Web Factura CFDI*/
/*define('WS_USUARIO', 'ENE0201GAG');
define('WS_CONTRASENA', '973C3rr3o');
define('WS_URL_CFDI', 'https://v33.facturacfdi.mx/WSForcogsaService?wsdl');
//Servicio para Cancelación
define('WS_URL_CFDI_CANCELAR', 'https://v33.facturacfdi.mx/WSCancelacionService?wsdl');
//Contraseña de la llave privada del certificado de sellado
define('CONTRASENA_LLAVE_PRIVADA', 'Agrocisa123');
//Código de éxito en la cancelación de un CFDI
define('CODIGO_EXITO_CANCELACION', '201');*/


/*Constantes de prueba que se utilizan para hacer el llamado al servicio Web Factura CFDI*/
define('WS_USUARIO', 'pruebasWS');
define('WS_CONTRASENA', 'pruebasWS');
//Servicio para Timbrado
define('WS_URL_CFDI', 'http://dev33.facturacfdi.mx/WSForcogsaService?wsdl');
//Servicio para Cancelación
define('WS_URL_CFDI_CANCELAR', 'https://v33.facturacfdi.mx/WSCancelacionService?wsdl');
//Contraseña de la llave privada del certificado de sellado
define('CONTRASENA_LLAVE_PRIVADA', 'Agrocisa123');
//Código de éxito en la cancelación de un CFDI
define('CODIGO_EXITO_CANCELACION', '201');



/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_refacciones_internas*/
define('ENTRADA_REFACCIONES_INTERNAS', 1);
define('ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER', 2);
define('ENTRADA_REFACCIONES_INTERNAS_POR_AJUSTE', 3);
define('SALIDA_REFACCIONES_INTERNAS', 11);
define('SALIDA_REFACCIONES_INTERNAS_POR_AJUSTE', 12);

/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_refacciones*/
define('ENTRADA_REFACCIONES_COMPRA', 1);
define('ENTRADA_REFACCIONES_DEVOLUCION_FACTURA', 2);
define('ENTRADA_REFACCIONES_DEVOLUCION_TALLER', 3);
define('ENTRADA_REFACCIONES_TRASPASO', 4);
define('ENTRADA_REFACCIONES_AJUSTE', 5);
define('SALIDA_REFACCIONES_TALLER', 11);
define('SALIDA_REFACCIONES_CONSUMO_INTERNO', 12);
define('SALIDA_REFACCIONES_TRASPASO', 13);
define('SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR', 14);
define('SALIDA_REFACCIONES_AJUSTE', 15);
define('SALIDA_REFACCIONES_VENTA', 16);


/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_maquinaria*/
define('ENTRADA_MAQUINARIA_COMPRA', 1);
define('ENTRADA_MAQUINARIA_TRASPASO', 2);
define('ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA', 3);
define('SALIDA_MAQUINARIA_VENTA', 11);
define('SALIDA_MAQUINARIA_TRASPASO', 12);
define('SALIDA_MAQUINARIA_DEMOSTRACION', 13);
define('SALIDA_MAQUINARIA_VALIDACION', 14);
define('SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR', 15);
define('SALIDA_MAQUINARIA_INTERNA', 16);
define('SALIDA_MAQUINARIA_POR_AJUSTE', 17);


/*Constantes que se utilizan para asignar la clave y unidad SAT de un descuento*/
define('CLAVE_SAT_DESCUENTO', '84111506');
define('UNIDAD_SAT_DESCUENTO', 'ACT');
define('CLAVE_SAT_CARGO', '84111506');
define('UNIDAD_SAT_CARGO', 'ACT');


/*Constantes que se utilizan para asignar los datos del SAT correspondientes a los gastos de paquetería*/
define('CLAVE_PRODUCTO_SAT_GASTOS_PAQUETERIA', '78121500');
define('CLAVE_UNIDAD_SAT_GASTOS_PAQUETERIA', 'ACT');
define('UNIDAD_SAT_GASTOS_PAQUETERIA', 'ACTIVIDAD');
define('DESCRIPCION_SAT_GASTOS_PAQUETERIA', 'EMPAQUE');
define('CONCEPTO_SAT_GASTOS_PAQUETERIA', 'GASTOS DE PAQUETERIA');
define('DESCUENTO_GASTOS_PAQUETERIA', '0.000000');
define('IEPS_GASTOS_PAQUETERIA', '0.00000000');
define('PORCENTAJE_IVA_GASTOS_PAQUETERIA', '0.160000');
define('FACTOR_IVA_GASTOS_PAQUETERIA', 'Tasa');
define('IMPUESTO_IVA_GASTOS_PAQUETERIA', '002');


/*Constantes que se utilizan para asignar los datos del SAT correspondientes a los gastos de servicio*/
define('CLAVE_PRODUCTO_SAT_GASTOS_SERVICIO', '78121500');
define('CLAVE_UNIDAD_SAT_GASTOS_SERVICIO', 'ACT');
define('UNIDAD_SAT_GASTOS_SERVICIO', 'ACTIVIDAD');
define('DESCRIPCION_SAT_GASTOS_SERVICIO', 'EMPAQUE');
define('CONCEPTO_SAT_GASTOS_SERVICIO', 'GASTOS DE SERVICIO');
define('DESCUENTO_GASTOS_SERVICIO', '0.000000');
define('IEPS_GASTOS_SERVICIO', '0.00000000');
define('PORCENTAJE_IVA_GASTOS_SERVICIO', '0.160000');
define('FACTOR_IVA_GASTOS_SERVICIO', 'Tasa');
define('IMPUESTO_IVA_GASTOS_SERVICIO', '002');


/*Constantes que se utilizan para el archivo PDF*/
//Título
define('HEADER_PDF', "AGROCISA");
//Tipo de letra
define('TIPO_LETRA_PDF', "arial");
//Tamaño de letra para el encabezado 
define('TAMANO_LETRA_ENCABEZADO_PDF', 12);
//Tamaño de letra para el título 
define('TAMANO_LETRA_TITULO_PDF', 10);
//Tamaño de letra para el subtitulo
define('TAMANO_LETRA_SUBTITULO_PDF', 8);
//Tamaño de letra para el título de la tabla
define('TAMANO_LETRA_TITULO_TABLA_PDF', 7);
//Tamaño de letra para el pie de página
define('TAMANO_LETRA_PIE_PAGINA_PDF', 6);
//Tipos de fuente
define('LETRA_NORMAL', '');
define('LETRA_NEGRITA', 'B');
define('LETRA_CURSIVA', 'I');
/*Restauración de colores y fuentes de la tabla del reporte PDF
 *Se utilizan en las funciones $pdf->SetFillColor y $pdf->SetDrawColor
 *(color de fondo (cabecera) y lineas de la tabla)
*/
define('COLOR_FONDO_R', 0);
define('COLOR_FONDO_G', 51);
define('COLOR_FONDO_B', 160);


//Color de texto
define('COLOR_TEXTO', 255);

/*Color de relleno para las celdas del archivo XLS*/
define('COLOR_RELLENO_CELDA', '0033A0');
define('COLOR_RELLENO_CELDA_ROJO', 'DA291C');

/*Correo de configuración que se utiliza para enviar email */
define('CORREO_CONFIGURACION', 'nvaldez@zonahs.com.mx');
