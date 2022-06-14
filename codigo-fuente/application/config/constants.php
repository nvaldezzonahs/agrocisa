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
define('TITULO_NAVEGADOR', 'AGROCISA - Especialistas en tu éxito');
/*Constante que se utiliza para asignar el id de la función Editar del proceso Validación de Prospectos*/
define('VALIDACION_PROSPECTOS', 1004);
/*Constante que se utiliza para asignar el id de la función Editar del proceso Devolución de Anticipos a Clientes*/
define('DEVOLUCION_ANTICIPOS_CLIENTES', 1152);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Cuentas por Pagar)*/
define('AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR', 1090);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra Especiales 
 *(módulo Cuentas por Pagar)*/
define('AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR', 1728);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Maquinaria)*/
define('AUTORIZAR_ORDENES_COMPRA_MAQUINARIA', 183);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra 
 *(módulo Refacciones)*/
define('AUTORIZAR_ORDENES_COMPRA_REFACCIONES', 407);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra Combustibles
 *(módulo Control de Vehículos)*/
define('AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS', 1759);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Ordenes de Compra
 *(módulo Servicio)*/
define('AUTORIZAR_ORDENES_COMPRA_SERVICIO', 1835);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Cotizaciones 
 *(módulo Maquinaria)*/
define('AUTORIZAR_COTIZACIONES_MAQUINARIA', 276);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Pedidos 
 *(módulo Maquinaria)*/
define('AUTORIZAR_PEDIDOS_MAQUINARIA', 288);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Vales de Caja Chica 
 *(módulo Caja)*/
define('AUTORIZAR_VALES_CAJA_CHICA_CAJA', 924);
/*Constante que se utiliza para asignar el id de la función Autorizar del proceso Proveedores
 *(módulo Cuentas por pagar)*/
define('AUTORIZAR_PROVEEDORES', 1071);
/*Constante que se utiliza para asignar el id de la cuenta base*/
define('CUENTA_BASE', 1);
/*Constante que se utiliza para asignar el id de la moneda: Peso mexicano*/
define('MONEDA_BASE', 1);
/*Constante que se utiliza para asignar el tipo de cambio de la moneda: Peso mexicano*/
define('TIPO_CAMBIO_MONEDA_BASE', 1);
/*Constante que se utiliza para asignar el código de la moneda: Peso mexicano*/
define('CODIGO_MONEDA_BASE', 'MXN');
/*Constante que se utiliza para asignar el id del método de pago: Una sola exhibición */
define('METODO_PAGO_BASE', 1);
/*Constante que se utiliza para asignar el id del método de pago: Pago en parcialidades o diferido */
define('METODO_PAGO_PPD', 2);
/*Constante que se utiliza para asignar el id del tipo de relación: CFDI por aplicación de anticipo */
define('TIPO_RELACION_BASE', 7);
/*Constante que se utiliza para asignar el id de la forma de pago: Efectivo */
define('FORMA_PAGO_EFECTIVO', 1);
/*Constante que se utiliza para asignar el id de la forma de pago: Cheque nominativo */
define('FORMA_PAGO_CHEQUE', 2);
/*Constante que se utiliza para asignar el id de la forma de pago: Transferencia electrónica */
define('FORMA_PAGO_TRANSFERENCIA', 3);
/*Constante que se utiliza para asignar el id de la forma de pago: Tarjeta de crédito */
define('FORMA_PAGO_TARJETA_CREDITO', 4);
/*Constante que se utiliza para asignar el id de la forma de pago: Monedero electrónico */
define('FORMA_PAGO_MONEDERO', 5);
/*Constante que se utiliza para asignar el id de la forma de pago: Compensación */
define('FORMA_PAGO_COMPENSACION', 12);
/*Constante que se utiliza para asignar el id de la forma de pago: Tarjeta de débito */
define('FORMA_PAGO_TARJETA_DEBITO', 18);
/*Constante que se utiliza para asignar el id de la forma de pago: Aplicación de anticipos*/
define('FORMA_PAGO_APLICACION_ANTICIPO', 20);
/*Constante que se utiliza para asignar el id de la forma de pago: por definir */
define('FORMA_PAGO_POR_DEFINIR', 22);
/*Constante que se utiliza para asignar el id del documento de pago: enganche */
define('DOCUMENTO_PAGO_ENGANCHE', 1);
/*Constante que se utiliza para asignar el id del documento de pago: pagaré */
define('DOCUMENTO_PAGO_PAGARE', 2);
/*Constante que se utiliza para asignar el id del documento de pago: contado */
define('DOCUMENTO_PAGO_CONTADO', 7);
/*Constante que se utiliza para asignar el id del uso del CFDI: por definir */
define('USO_CFDI_BASE', 22);

/*Constante que se utiliza para asignar el id del uso del CFDI: pagos */
define('USO_CFDI_PAGO', 24);

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
/*Constante que se utiliza para asignar el id del tipo de concepto: Servicios maquinaria pesada fintegra */
define('CONCEPTO_TIPO_SMPI', 1);
/*Constante que se utiliza para asignar el id del tipo de concepto: Comisión por venta de seguros */
define('CONCEPTO_TIPO_CVS', 2);
/*Constante que se utiliza para asignar el id del tipo de concepto: Recuperación de gastos inversiones */
define('CONCEPTO_TIPO_RGI', 3);
/*Constante que se utiliza para asignar el id del tipo de concepto: Venta de activo fijo  (transmisión de propiedad) */
define('CONCEPTO_TIPO_VAFTP', 4);
/*Constante que se utiliza para asignar el id del tipo de concepto: Venta de activo fijo (indemnización aseguradora) */
define('CONCEPTO_TIPO_VAFIA', 5);
/*Constante que se utiliza para asignar el id del tipo de concepto: Ingresos por cobro de intereses */
define('CONCEPTO_TIPO_ICI', 6);

/*Constante que se utiliza para asignar el id del porcentaje retención ISR: 1.25% */
define('PORCENTAJE_ISR_BASE', 1);

/*Constante que se utiliza para asignar el id del régimen fiscal: Régimen Simplificado de Confianza */
define('REGIMEN_FISCAL_RESICO', 23);

/*Constantes que se utilizan para asignar el id de las cuentas bancarias extranjeras */
define('CUENTA_BANCARIA_BBVAUSD', 3);
define('CUENTA_BANCARIA_BANAMEXUSD', 8);

/*Constante que se utiliza para asignar el id de la sucursal: La Barca */
define('SUCURSAL_LABARCA', 1);
/*Constante que se utiliza para asignar el id de la sucursal: Penjamo */
define('SUCURSAL_PENJAMO', 2);
/*Constante que se utiliza para asignar el id de la sucursal: La Piedad */
define('SUCURSAL_LAPIEDAD', 3);
/*Constante que se utiliza para asignar el id de la sucursal: Morelia */
define('SUCURSAL_MORELIA', 4);
/*Constante que se utiliza para asignar el id de la sucursal: Poncitlan */
define('SUCURSAL_PONCITLAN', 5);
/*Constante que se utiliza para asignar el id de la sucursal: EXPO Agrocisa */
define('SUCURSAL_EXPOAGROCISA', 6);
/*Constante que se utiliza para asignar el id de la sucursal: EXPO CNH */
define('SUCURSAL_EXPOCNH', 7);

/*Constante que se utiliza para asignar la descripción del tipo de gasto: Vigilancia Y Seguridad */
define('GASTO_TIPO_GADMINVIGSEG', "'VIGILANCIA Y SEGURIDAD'");


/*Constante que se utiliza para asignar la descripción del tipo de gasto: Fletes y Acarreos */
define('GASTO_TIPO_FLETESACARREOS', "'FLETES Y ACARREOS'");

/*Constantes que se utilizan para la paginación de registros*/
//Número máximo de intentos de inicio de sesión
define('INTENTOS_MAXIMOS', 5);
//Número de elementos para la paginación (per_page)
define('PAGINACION_ELEMENTOS', 15);
//Límite de elementos para el autocomplete
define('LIMITE_AUTOCOMPLETE', 10);
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
define('NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR', 4);

/*Constante que se utiliza para asignar el número de decimales a rendondear en el módulo servicio (para visualizar)*/
define('NUM_DECIMALES_MOSTRAR_SERVICIO', 4);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en ordenes de compra de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_PRECIO_UNIT_OC_REFACCIONES',4);
define('NUM_DECIMALES_DESCUENTO_UNIT_OC_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_OC_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_OC_REFACCIONES',4);


/*Constantes que se utilizan para asignar el número de decimales a rendondear en cotizaciones de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_PRECIO_UNIT_COT_REFACCIONES',2);
define('NUM_DECIMALES_DESCUENTO_UNIT_COT_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_COT_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_COT_REFACCIONES',4);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en movimientos de refacciones (para guardar en la BD) */
define('NUM_DECIMALES_COSTO_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_DESCUENTO_UNIT_MOV_REFACCIONES',2);
define('NUM_DECIMALES_IVA_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_IEPS_UNIT_MOV_REFACCIONES',4);
define('NUM_DECIMALES_PRECIO_UNIT_MOV_REFACCIONES',2);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en requisición de refacciones (para guardar en la BD) */
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

/*Constantes que se utilizan para asignar el número de decimales a rendondear en anticipos a proveedores (cuentas por pagar)
(para guardar en la BD) */
define('NUM_DECIMALES_SUBTOTAL_AP_CUENTAS_PAGAR',5);
define('NUM_DECIMALES_IVA_AP_CUENTAS_PAGAR',4);
define('NUM_DECIMALES_IEPS_AP_CUENTAS_PAGAR',4);

/*Constantes que se utilizan para asignar el número de decimales a rendondear en trabajos foráneos (servicio)
(para guardar en la BD) */
define('NUM_DECIMALES_CANTIDAD_TF_SERVICIO',5);
define('NUM_DECIMALES_COSTO_UNIT_TF_SERVICIO',5);
define('NUM_DECIMALES_DESCUENTO_UNIT_TF_SERVICIO',2);
define('NUM_DECIMALES_IVA_UNIT_TF_SERVICIO',4);
define('NUM_DECIMALES_IEPS_UNIT_TF_SERVICIO',4);
define('NUM_DECIMALES_PRECIO_UNIT_TF_SERVICIO',2);


/*Constantes que se utilizan para asignar el número de decimales a rendondear en ordenes de compra de servicio (para guardar en la BD) */
define('NUM_DECIMALES_CANTIDAD_OC_SERVICIO',5);
define('NUM_DECIMALES_PRECIO_UNIT_OC_SERVICIO',5);
define('NUM_DECIMALES_DESCUENTO_UNIT_OC_SERVICIO',2);
define('NUM_DECIMALES_IVA_UNIT_OC_SERVICIO',4);
define('NUM_DECIMALES_IEPS_UNIT_OC_SERVICIO',4);

/*Constante que se utiliza para asignar el id del tipo de servicio: Orden de reparación*/
define('TIPO_SERVICIO_ORDEN_REP', 1);
/*Constante que se utiliza para asignar el id del tipo de servicio: Garantía*/
define('TIPO_SERVICIO_GARANTIA', 2);
/*Constante que se utiliza para asignar el id del tipo de servicio: Pre entrega */
define('TIPO_SERVICIO_PREENTREGA', 3);
/*Constante que se utiliza para asignar el id del tipo de servicio: PEPS */
define('TIPO_SERVICIO_PEPS', 4);
/*Constante que se utiliza para asignar el id del tipo de servicio: Servicio interno */
define('TIPO_SERVICIO_INTERNO', 5);
/*Constante que se utiliza para asignar el id del tipo de servicio: Servicio interno taller */
define('TIPO_SERVICIO_TALLER', 6);
/*Constante que se utiliza para asignar el id del tipo de servicio: Servicio interno ventas */
define('TIPO_SERVICIO_VENTAS', 7);
/*Constante que se utiliza para asignar el id del tipo de servicio: trabajo foráneo*/
define('TIPO_SERVICIO_TRABAJO_FORANEO', 11);
/*Constante que se utiliza para asignar el id del tipo de servicio: facturación (trabajo foráneo interno)*/
define('TIPO_SERVICIO_FACTURACION', 21);
/*Constante que se utiliza para asignar el id de la tasa de IEPS: rango*/
define('SAT_TASA_CUOTA_IEPS_RANGO', 19);

/*Constante que se utiliza para asignar el id del tipo de servicio interno: Servicio interno vehículos*/
define('TIPO_SERVICIO_INTERNO_VEHICULOS', 1);
/*Constante que se utiliza para asignar el id del tipo de servicio interno: Servicio interno maquinaria*/
define('TIPO_SERVICIO_INTERNO_MAQUINARIA', 2);

/*Constante que se utiliza para asignar el id del motivo de cancelación: Comprobante emitido con errores con relación*/
define('MOTIVO_CANCELACION_RELACIONCFDI', 1);

/*Constante que se utiliza para asignar el id del proceso: Anticipos (para generar póliza de anticipos desde traspasos de caja a bancos)*/
define('PROCESOID_ANTICIPOS', 198);

/*Constante que se utiliza para asignar el id del proceso: Recibos de ingreso (para generar póliza de anticipos desde traspasos de caja a bancos)*/
define('PROCESOID_RECIBOS_INGRESO', 215);

/*Constante que se utiliza para asignar el id del proceso: Recibo interno de anticipo (para generar póliza de anticipos no fiscales desde traspasos de caja a bancos)*/
define('PROCESOID_ANTICIPOSNOFISCALES', 342);

/*Constante que se utiliza para asignar el id del proceso: Recepción de pagos (para generar póliza de pagos)*/
define('PROCESOID_PAGOS', 197);

/*Constante que se utiliza para asignar el id del proceso: Pólizas de abono (para generar póliza de aplicación)*/
define('PROCESOID_POLIZAS_ABONO', 334);



/*Constante que se utiliza para asignar el id del departamento: Administración*/
define('DEPTO_ADMINISTRACION', 17);


/*Constante que se utiliza para indicar al usuario el número de días vigentes del certificado*/
define('DIAS_CERTIFICADO',30);

/*Constantes que se utilizan para los mensajes de acción*/
define('TIPO_MSJ_ERROR', 'error');
define('TIPO_MSJ_EXITO', 'éxito');
define('MSJ_GUARDAR', 'El registro se guardó correctamente.');
define('MSJ_ERROR_GUARDAR', 'Ocurrió un error al guardar, vuelva a intentarlo.');
define('MSJ_CAMBIAR_ESTATUS', 'El estatus se cambió correctamente.');
define('MSJ_ELIMINAR', 'El registro se eliminó correctamente.');
define('MSJ_ERROR_ELIMINAR', 'Ocurrió un error al eliminar, vuelva a intentarlo.');
define('MSJ_AUTORIZAR', 'El registro se autorizó correctamente.');
define('MSJ_RECHAZAR', 'El registro se rechazó correctamente.');
define('MSJ_GENERAR_FOLIO', 'No es posible generar el folio, comuníquese con el administrador.');
define('MSJ_CANCELACION',  'La cancelación se realizó correctamente.');
define('MSJ_ERROR_CUENTA_CONTABLE', 'No existe cuenta contable de la sucursal.');
define('MSJ_ERROR_POLIZA', 'No existe información para generar póliza (no se cumple con los requisitos).');
define('MSJ_ERROR_REGIMEN_FISCAL', 'No existe régimen fiscal (no será posible timbrar el registro), favor de ir al catálogo de Clientes y proporcionarlo.');


/*Constante que se utiliza para asignar el nombre del dueño de la empresa*/
define('NOMBRE_DUENO_EMPRESA','CARLOS VIDAL PLASCENCIA CAMACHO');
/*Constante que se utiliza para asignar el horario (lunes a viernes)*/
define('HORARIO_NORMAL_EMPRESA','09:00 AM a las 6:00 PM');
/*Constante que se utiliza para asignar el horario del día sábado*/
define('HORARIO_SABADO_EMPRESA','9:00 AM a 2:00 PM.');


/*Constantes que se utilizan para hacer el llamado al servicio Web Factura CFDI*/
/*define('WS_USUARIO', 'ENE0201GAG');
define('WS_CONTRASENA', '973C3rr3o');
define('WS_URL_CFDI', 'https://v33.facturacfdi.mx/WSForcogsaService?wsdl');
//Servicio para Cancelación versio 3.3*/
/*define('WS_URL_CFDI_CANCELAR', 'https://v33.facturacfdi.mx/WSCancelacionService?wsdl');
//Contraseña de la llave privada del certificado de sellado
define('CONTRASENA_LLAVE_PRIVADA', 'Agrocisa123');
//Código de éxito en la cancelación de un CFDI
define('CODIGO_EXITO_CANCELACION', '201');*/


//Servicio para Cancelación versio 4.0*/
/*define('WS_URL_CFDI_CANCELAR', 'https://v33.facturacfdi.mx/WSCancelacion40Service?wsdl');
//Contraseña de la llave privada del certificado de sellado
define('CONTRASENA_LLAVE_PRIVADA', 'Agrocisa123');
//Código de éxito en la cancelación de un CFDI
define('CODIGO_EXITO_CANCELACION', '201');*/


//Servicio para Cancelación versio 4.0 (pruebas)
define('WS_URL_CFDI_CANCELAR', 'http://dev33.facturacfdi.mx:80/WSCancelacion40Service?wsdl');
//Contraseña de la llave privada del certificado de sellado
define('CONTRASENA_LLAVE_PRIVADA', '12345678a');
//Código de éxito en la cancelación de un CFDI
define('CODIGO_EXITO_CANCELACION', '201');

/*Constantes de prueba que se utilizan para hacer el llamado al servicio Web Factura CFDI*/

define('WS_USUARIO', 'pruebasWS');
define('WS_CONTRASENA', 'pruebasWS');
define('WS_URL_CFDI', 'http://dev33.facturacfdi.mx/WSForcogsaService?wsdl');

/*Constante que se utiliza para asignar el id de la exportación: 01- No aplica*/
define('EXPORTACION_BASE', 1);

/*Constante que se utiliza para asignar el id del objeto de impuesto: 02- Sí objeto de impuesto*/
define('OBJETOIMP_BASE', 2);

/*Constante que se utiliza para asignar el id del objeto de impuesto: 01- No objeto de impuesto*/
define('OBJETOIMP_PAGO', 1);



/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_refacciones_internas*/
//Entradas
define('ENTRADA_REFACCIONES_INTERNAS_TRASPASO', 1);
define('ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER', 2);
define('ENTRADA_REFACCIONES_INTERNAS_POR_AJUSTE', 3);
//Salidas
define('SALIDA_REFACCIONES_INTERNAS', 11);
define('SALIDA_REFACCIONES_INTERNAS_POR_AJUSTE', 12);
define('SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO', 13);

/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_refacciones*/
//Entradas
define('ENTRADA_REFACCIONES_COMPRA', 1);
define('ENTRADA_REFACCIONES_DEVOLUCION_FACTURA', 2);
define('ENTRADA_REFACCIONES_DEVOLUCION_TALLER', 3);
define('ENTRADA_REFACCIONES_TRASPASO', 4);
define('ENTRADA_REFACCIONES_AJUSTE', 5);
//Salidas
define('SALIDA_REFACCIONES_TALLER', 11);
define('SALIDA_REFACCIONES_CONSUMO_INTERNO', 12);
define('SALIDA_REFACCIONES_TRASPASO', 13);
define('SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR', 14);
define('SALIDA_REFACCIONES_AJUSTE', 15);
define('SALIDA_REFACCIONES_VENTA', 16);
define('SALIDA_REFACCIONES_TRASPASO_VEHICULAR', 17);

/*Constantes que se utilizan para identificar los tipos de movimientos de la tabla movimientos_maquinaria*/
//Entradas
define('ENTRADA_MAQUINARIA_COMPRA', 1);
define('ENTRADA_MAQUINARIA_TRASPASO', 2);
define('ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA', 3);
define('ENTRADA_MAQUINARIA_AJUSTE', 4);
//Salidas
define('SALIDA_MAQUINARIA_VENTA', 11);
define('SALIDA_MAQUINARIA_TRASPASO', 12);
define('SALIDA_MAQUINARIA_DEMOSTRACION', 13);
define('SALIDA_MAQUINARIA_VALIDACION', 14);
define('SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR', 15);
define('SALIDA_MAQUINARIA_INTERNA', 16);
define('SALIDA_MAQUINARIA_POR_AJUSTE', 17);

/*Constantes que se utilizan para asignar la clave y unidad SAT correspondientes a las notas de crédito digitales*/
define('CLAVE_PRODUCTO_SAT_NCREDITO', '84111506');
define('CLAVE_UNIDAD_SAT_NCREDITO', 'ACT');
define('UNIDAD_SAT_NCREDITO', 'ACTIVIDAD');

/*Constantes que se utilizan para asignar los datos del SAT correspondientes a las notas de cargo digitales*/
define('CLAVE_PRODUCTO_SAT_NCARGO', '84111506');
define('CLAVE_UNIDAD_SAT_NCARGO', 'ACT');
define('UNIDAD_SAT_NCARGO', 'ACTIVIDAD');

/*Constantes que se utilizan para asignar los datos del SAT correspondientes a los anticipos*/
define('CLAVE_PRODUCTO_SAT_ANTICIPO', '84111506');
define('CLAVE_UNIDAD_SAT_ANTICIPO', 'ACT');
define('UNIDAD_SAT_ANTICIPO', 'ACTIVIDAD');


/*Constantes que se utilizan para asignar la clave y unidad SAT correspondientes a las notas de crédito servicio*/
define('CLAVE_PRODUCTO_SAT_NCREDITO_SERV', '84111506');
define('CLAVE_UNIDAD_SAT_NCREDITO_SERV', 'ACT');
define('UNIDAD_SAT_NCREDITO_SERV', 'ACTIVIDAD');


/*Constantes que se utilizan para asignar los datos del SAT correspondientes a los gastos de paquetería*/
define('CLAVE_PRODUCTO_SAT_GASTOS_PAQUETERIA', '78102203');
define('CLAVE_UNIDAD_SAT_GASTOS_PAQUETERIA', 'ACT');
define('UNIDAD_SAT_GASTOS_PAQUETERIA', 'ACTIVIDAD');
define('CLAVE_OBJETOIMP_SAT_GASTOS_PAQUETERIA', '02');
define('CONCEPTO_OBJETOIMP_SAT_GASTOS_PAQUETERIA', '02 - Sí objeto de impuesto');
define('DESCRIPCION_SAT_GASTOS_PAQUETERIA', 'CARGO POR ENVÍO DE MERCANCÍA');
define('CONCEPTO_SAT_GASTOS_PAQUETERIA', 'CARGO POR ENVÍO DE MERCANCÍA');
define('DESCUENTO_GASTOS_PAQUETERIA', '0.000000');
define('IEPS_GASTOS_PAQUETERIA', '0.00000000');
define('PORCENTAJE_IVA_GASTOS_PAQUETERIA', '0.160000');
define('FACTOR_IVA_GASTOS_PAQUETERIA', 'Tasa');
define('IMPUESTO_IVA_GASTOS_PAQUETERIA', '002');

/*Constantes que se utilizan para asignar los datos del SAT correspondientes a los gastos de servicio*/
define('CLAVE_PRODUCTO_SAT_GASTOS_SERVICIO', '81141601');
define('CLAVE_UNIDAD_SAT_GASTOS_SERVICIO', 'E48');
define('UNIDAD_SAT_GASTOS_SERVICIO', 'UNIDAD DE SERVICIO');
define('CLAVE_OBJETOIMP_SAT_GASTOS_SERVICIO', '02');
define('CONCEPTO_OBJETOIMP_SAT_GASTOS_SERVICIO', '02 - Sí objeto de impuesto');


define('DESCRIPCION_SAT_GASTOS_SERVICIO', 'GASTOS DE SERVICIO');
define('CONCEPTO_SAT_GASTOS_SERVICIO', 'GASTOS DE SERVICIO');
define('DESCUENTO_GASTOS_SERVICIO', '0.000000');
define('IEPS_GASTOS_SERVICIO', '0.00000000');
define('PORCENTAJE_IVA_GASTOS_SERVICIO', '0.160000');
define('FACTOR_IVA_GASTOS_SERVICIO', 'Tasa');
define('IMPUESTO_IVA_GASTOS_SERVICIO', '002');
define('SAT_TASA_CUOTA_IVA_ID', 2);

/**Constantes que se utilizan para asignar los datos de la Tasa de IVA cero*/
define('SAT_TASA_CUOTA_IVA_CERO_ID', 1);
define('PORCENTAJE_IVA_CERO', '0.000000');



/*Constantes que se utilizan para asignar los datos del SAT correspondientes a la información Aduanera*/
define('NUMERO_PEDIMENTO_INFORMACION_ADUANERA', '18  16  1634  8009277');
define('CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA', 'TH-084|TH-088|TH-109|TH-110|TH-116|TH-117|TH-118|TH-119');
define('NUMERO_PEDIMENTO_INFORMACION_ADUANERA_DOS', '19  16  3450  9000336');
define('CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_DOS', 'WG-030|WG-048|WG-002|WG-029|WG-003|WG-016|WG-044|WG-042');
define('NUMERO_PEDIMENTO_INFORMACION_ADUANERA_TRES', '19  48  3861  9040957');
define('CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_TRES', 'VNB4713902|VNB3317278|VNB3559902|VNB3958278|VNB3970002|VNB4059402|VNB4060978|VNB4061702|VNB4061978|VNB4073178|VNB4077378|VNB3322498|VNB3957678|VNB3957778|VNB3957978|VNB3958078|VNB3958178|VNB4423078|VNB2333798|VNB4955878|VNB4955978|VNB4956078|VNB4956178|VNB3967365|VNB4064578|VNB4064678|VNB4064778|VNB5000802');


/*Constante que se utiliza para asignar la descripción de la cuenta: 602*/
define('DESCRIPCION_CUENTA_602', "'GASTOS DE VENTA'");
define('CUENTA_GASTOS_VENTA', "'602'");

/*Constante que se utiliza para asignar la descripción de la cuenta: 603*/
define('DESCRIPCION_CUENTA_603', "'GASTOS DE ADMINISTRACION'");
define('CUENTA_GASTOS_ADMINISTRACION', "'603'");

/*Constante que se utiliza para asignar la descripción de la cuenta: 701*/
define('DESCRIPCION_CUENTA_701', "'GASTOS FINANCIEROS'");
define('CUENTA_GASTOS_FINANCIEROS', "'701'");



/*Constantes que se utilizan para el archivo PDF*/
//Título
define('HEADER_PDF', "AGROCISA - Especialistas en tu éxito");
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

//Posición de la ordenada para emitir un salto de página (CheckPageBreak)
define('POSY_SALTO_PAGINA', 260);


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

//Arreglo se utiliza para recorrer todas las cuentas a considerar para la póliza de cierre
define ('ARR_POLIZA_CIERRE', '400|401|402|403|500|501|502|503|505|600|602|603|607|611|612|613|700|701|702|703|704');
