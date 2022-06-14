
//Función que se utiliza para cambiar el formato de la fecha a año-mes-día 
jQuery.formatFechaMysql = function(fecha){
	//Asignar fecha
	var strFecha = fecha;
	//Si existe fecha 
	if(strFecha != '')
	{
		//Seperar cadena para obtener día/mes/año
		var arrFecha = fecha.split("/");
		//Cambiar formato de la fecha a año-mes-día para poder guardarla en la bd
		strFecha = arrFecha[2]+'-'+arrFecha[1]+'-'+arrFecha[0];
	}
	//Regresar fecha
    return strFecha;
}


//Función que se utiliza para remover (quitar) las clases del encabezado (div) de un modal
jQuery.removerClasesEncabezado = function(campoID)
{
    //Quitar clases del div para poder tomar el color correspondiente al estatus del registro
    $('#'+campoID).removeClass("estatus-NUEVO");
    $('#'+campoID).removeClass("estatus-ACTIVO");
    $('#'+campoID).removeClass("estatus-INACTIVO");
    $('#'+campoID).removeClass("estatus-SUSPENDIDO");
    $('#'+campoID).removeClass("estatus-FINALIZADO");
    $('#'+campoID).removeClass("estatus-FACTURADO");
    $('#'+campoID).removeClass("estatus-AUTORIZADO");
    $('#'+campoID).removeClass("estatus-RECHAZADO");
    $('#'+campoID).removeClass("estatus-PARCIAL");
    $('#'+campoID).removeClass("estatus-PARCIALMENTE_SURTIDO");
    $('#'+campoID).removeClass("estatus-SURTIDO");
    $('#'+campoID).removeClass("estatus-TIMBRAR");
    $('#'+campoID).removeClass("estatus-NO_APLICADA");
    $('#'+campoID).removeClass("estatus-PARCIALMENTE_APLICADO");
    $('#'+campoID).removeClass("estatus-APLICADO");
    $('#'+campoID).removeClass("estatus-PEDIDO");
    $('#'+campoID).removeClass("estatus-REMISION");
    $('#'+campoID).removeClass("estatus-ABIERTA");
    $('#'+campoID).removeClass("estatus-CERRADA");
    $('#'+campoID).removeClass("estatus-CANCELADA");
    $('#'+campoID).removeClass("estatus-CERRADO");
     
}


//Función que se utiliza para imprimir un reporte PDF/XLS
jQuery.imprimirReporte = function(objDatos)
{   
    //Limpiar el div base
    $('#divDatosReporte').empty();
    //Agregar atributos acción que contiene la URL
    $('#frmReporteGenerico').attr('action', objDatos.url);
    //Hacer recorrido de los datos que se enviaran al controlador
    $.each(objDatos.data, function( key, value ) {
      //Agregar input con el valor obtenido del filtro
      $('#divDatosReporte').append($('<input>', { 
       value: value,
       name : key       
     }));
    });

    //Ejecutar submit
    $('#frmReporteGenerico').submit();

}

        
//Función que se utiliza para reemplazar varias comas (o cualquier letra) dentro de una dena de texto
//(se utiliza para reemplazar ',' de una cantidad con formato moneda)
jQuery.reemplazar = function(text, busca, reemplaza)
{
    while (text.toString().indexOf(busca) != -1)
    {
       text = text.toString().replace(busca,reemplaza);
    }
    return text;
}


//Función que se utiliza para cambiar XML a JSON
jQuery.xmlToJson= function(xml) 
{
    
    // Create the return object
    var obj = {};

    if (xml.nodeType == 1) { // element
        // do attributes
        if (xml.attributes.length > 0) {
        obj["@attributes"] = {};
            for (var j = 0; j < xml.attributes.length; j++) {
                var attribute = xml.attributes.item(j);
                obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
            }
        }
    } else if (xml.nodeType == 3) { // text
        obj = xml.nodeValue;
    }

    // do children
    if (xml.hasChildNodes()) {
        for(var i = 0; i < xml.childNodes.length; i++) {
            var item = xml.childNodes.item(i);
            var nodeName = item.nodeName;
            if (typeof(obj[nodeName]) == "undefined") {
                obj[nodeName] = $.xmlToJson(item);
            } else {
                if (typeof(obj[nodeName].push) == "undefined") {
                    var old = obj[nodeName];
                    obj[nodeName] = [];
                    obj[nodeName].push(old);
                }
                obj[nodeName].push($.xmlToJson(item));
            }
        }
    }
    return obj;
}


//Función que se utiliza para incrementar días a una fecha
jQuery.sumarDiasFecha = function(dias, fecha)
{  
    //Variable que se utiliza para regresar fecha con el incremento de días
    var dteFechaResultado = '';
    //Asignar valores a las siguientes variables
    var intDias = parseInt(dias);
    var dteFecha = fecha;

    //Si existen días
    if(intDias > 0)
    {
        //Extraer datos de la fecha por ejemplo:15/01/2018
        var strFecha = dteFecha.split("/");
        //Donde [0]-Dia, [1]-Mes y [2]-Anio ejemplo:2018-01-15
        dteFecha = strFecha[2]+'-'+strFecha[1]+'-'+strFecha[0];
        //Reemplazar fecha por las barras inclinadas (/) 
        dteFecha = dteFecha.replace("-", "/").replace("-", "/"); 
        //Convertir texto a formato de fecha
        dteFecha= new Date(dteFecha);
        
        //Extraemos los valores de la fecha por separado
        var intAnio=dteFecha.getFullYear();//Año de 4 digitos
        var intMes= dteFecha.getMonth()+1;// Mes
        var intDia= dteFecha.getDate();// dia
          
        //Sumamos el número de días de crédito a la fecha
        dteFecha.setDate(dteFecha.getDate()+intDias);

        //Extraemos los valores de la fecha por separado
        var intAnioMod=dteFecha.getFullYear();//Año de 4 digitos
        var intMesMod= dteFecha.getMonth()+1;// Mes
        var intDiaMod= dteFecha.getDate(); //Día del mes
          
        //Si la longitud de digitos es menor a 2, le agregamos el cero a la izquierda
        if(intMesMod.toString().length < 2)
        {
            intMesMod = "0".concat(intMesMod);        
        }    

        //Si la longitud de digitos es menor a 2, le agregamos el cero a la izquierda.
        if(intDiaMod.toString().length < 2)
        {
            intDiaMod = "0".concat(intDiaMod);        
        }
        
        //Asignar datos de la fecha con el incremento de días
        dteFechaResultado = intDiaMod+"/"+intMesMod+"/"+intAnioMod;
      
    }
    else
    {
        //Asignar fecha sin el incremento de días
        dteFechaResultado = dteFecha;
    }

    //Regresar fecha
    return dteFechaResultado;
}

//Función que se utiliza para calcular la diferencia de días entre dos fechas
jQuery.diferenciaDiasFechas = function(fechaInicio, fechaFinal)
{  
    //Variable que se utiliza para regresar días de diferencia
    var intDias = 0;

    //Asignar valores a las siguientes variables
    var dteFechaInicial = moment(fechaInicio);
    var dteFechaFinal = moment(fechaFinal);

    //Calcular diferencia de días
    intDias = dteFechaFinal.diff(dteFechaInicial, 'days');

    //Regresar diferencia de días
    return intDias;
}



//Función que se utiliza para comparar dos fechas
jQuery.compararFechas = function(fechaInicio, fechaFinal)
{  
    //Asignar valores a las siguientes variables
    var dteFechaInicio = document.getElementById(fechaInicio).value;
    var dteFechaFin = document.getElementById(fechaFinal).value;

    //Variable que se utiliza para regresar fecha máxima
    var dteFecha = dteFechaFin;

    //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
    var dteFechaInicioFormat = $.formatFechaMysql(dteFechaInicio);
    dteFechaInicioFormat = moment(dteFechaInicioFormat);

    var dteFechaFinFormat  = $.formatFechaMysql(dteFechaFin);
    dteFechaFinFormat = moment(dteFechaFinFormat);

    //Si se cumple la sentencia
    if (dteFechaFinFormat < dteFechaInicioFormat) 
    {
        //Asignar fecha inicial porque es mayor que la fecha final
        dteFecha = dteFechaInicio;
    }

    //Regresar fecha máxima
    return dteFecha;
}

//Función que se utiliza para calcular la fecha de vencimiento  (incrementarle los días de crédito a la fecha) 
jQuery.calcularFechaVencimiento = function(arrCamposID){


    //Variable que se utiliza para asignar la fecha de la (orden de compra/factura)
    var dteFecha = $(arrCamposID.fecha).val();
    //Variable que se utiliza para asignar fecha de vencimiento
    var dteFechaVencimiento = '';
    //Variable que se utiliza para asignar las condiciones de pago
    var strCondicionesPago = $(arrCamposID.condicionesPago).val();
    //Variable que se utiliza para asignar el tipo de cálculo
    var strTipo = arrCamposID.tipo;
    //Variable que se utiliza para asignar los días de crédito / días a incrementar
    var intDias = parseInt($(arrCamposID.diasCredito).val());

    //Verificar si la condición de pago es crédito
    if((strCondicionesPago === 'CREDITO' && intDias > 0) || 
       (strTipo === 'VENCIMIENTO' && intDias > 0))
    {
        //Hacer un llamado a la función para incrementar días a la fecha
        dteFechaVencimiento = $.sumarDiasFecha(intDias, dteFecha);
    }
    else
    {
        //Asignar fecha del registro
        dteFechaVencimiento = dteFecha;
    }

    //Asignar fecha de vencimiento
    $(arrCamposID.fechaVencimiento).val(dteFechaVencimiento);
}


//Función que se utiliza para calcular diferencia de días entre dos fechas
jQuery.calcularDias = function(arrCamposID){

    //Variable que se utiliza para asignar los días calculados
    var intDias = '';
    //Variable que se utiliza para asignar la fecha inicial con formato año-mes-día
    var dteFechaInicial = '';
    //Variable que se utiliza para asignar la fecha final con formato año-mes-día
    var dteFechaFinal  = '';

    //Si no existe fecha inicial
    if($(arrCamposID.fechaInicial).val() == '')
    {   
        //Asignar la fecha actual
        $(arrCamposID.fechaInicial).val(fechaActual());
    }

    //Si existe rango de fechas
    if($(arrCamposID.fechaInicial).val() != '' && $(arrCamposID.fechaFinal).val() != '')
    {
        //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
        dteFechaInicial =  $.formatFechaMysql($(arrCamposID.fechaInicial).val());
        dteFechaFinal =  $.formatFechaMysql($(arrCamposID.fechaFinal).val());

        //Hacer un llamado a la función para obtener la diferencia de días entre dos fechas
        intDias = $.diferenciaDiasFechas(dteFechaInicial, dteFechaFinal);
    }

    //Asignar días
    $(arrCamposID.dias).val(intDias);
}


//Función que se utiliza para desglosar el IVA de un gasto (paquetería/servicio/entre otros)
jQuery.desglosarIvaGasto = function(arrCamposID){

    //Si existe importe del gasto
    if($(arrCamposID.gasto).val() != '')
    { 
        //Variable que se utiliza para asignar el IVA desglosado
        var intGastoIva = 0;
        //Variable que se utiliza para asignar el subtotal desglosado
        var intGastoSubtotal = 0;
            //Variable que se utiliza para asignar el total del gasto que le corresponde a la tasa
        var intGastoTasa = 0;
        
        //Asignar importe del gasto
        var intGasto = parseFloat($.reemplazar($(arrCamposID.gasto).val(), ",", ""));
       
        //Calcular subtotal
        intGastoSubtotal =  intGasto / arrCamposID.porcentajeIva;
        //Redondear cantidad a dos decimales
        intGastoSubtotal = intGastoSubtotal.toFixed(2);
        intGastoSubtotal = parseFloat(intGastoSubtotal);
        
        //Calcular IVA
        intGastoIva = parseFloat(intGastoSubtotal * arrCamposID.iva);

        //Redondear cantidad a 4 decimales
        intGastoIva =  intGastoIva.toFixed(4);;
        intGastoIva =   parseFloat(intGastoIva);

        //Calcular el total del gasto por su tasa (que se va a guardar en la BD)
        intGastoTasa = intGastoSubtotal + intGastoIva;

        //Verificar que el abono que le corresponde a la tasa no sea distinto al que se ingresa
        if(intGastoTasa != intGasto)
        {
            //Calcular precio nuevamente para evitar más decimales 
            intGastoIva = intGasto - intGastoSubtotal;
            intGastoIva = intGastoIva.toFixed(4);
            intGastoIva = parseFloat(intGastoIva);
        }

        //Asignar valorea a las siguientes cajas de texto
        $(arrCamposID.gastoSubtotal).val(intGastoSubtotal);
        $(arrCamposID.gastoIva).val(intGastoIva);

    }
    else
    {
        $(arrCamposID.gastoSubtotal).val('');
        $(arrCamposID.gastoIva).val('');
    }
}


//Función que se utiliza para regresar la fecha actual
var fechaActual = function(primerDia){
	var dteFecha = new Date();
    var dd = dteFecha.getDate();
    var mm = dteFecha.getMonth()+1; //Enero es 0
    var yyyy = dteFecha.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 

    //Si se cumple la sentencia (regresar el primer día del mes)
    if(primerDia == '01')
    {
        //La fecha actual será 01/mes/año
        dteFecha = '01/'+mm+'/'+yyyy;
    }
    else
    {
        //La fecha actual será dia/mes/año
        dteFecha = dd+'/'+mm+'/'+yyyy;
    }

    //Regresar fecha actual
    return dteFecha;
}


var fechaActualA = function(primerDia){
   /* var dteFecha = new Date();
    var dd = dteFecha.getDate();
    var mm = dteFecha.getMonth()+1; //Enero es 0
    var yyyy = dteFecha.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 

   
    //Si se cumple la sentencia (regresar el primer día del mes)
    if(primerDia == '01')
    {
        //La fecha actual será 01/mes/año
        dteFecha = '01/'+mm+'/'+yyyy;
    }
    else
    {
        //La fecha actual será dia/mes/año
        dteFecha = dd+'/'+mm+'/'+yyyy;
    }*/

    dteFecha = '31/12/2021';

    //Regresar fecha actual
    return dteFecha;
}
//Función que se utiliza para regresar la fecha actual solo incluyendo mes y año MM/YYYY
var fechaActualMesAnio = function(){
    var dteFecha = new Date();

    var mm = dteFecha.getMonth()+1; //Enero es 0
    var yyyy = dteFecha.getFullYear();
 
    if(mm<10) {
        mm='0'+mm
    } 

    //La fecha actual será dia/mes/año
    dteFecha = mm+'/'+yyyy;
    //Regresar fecha actual
    return dteFecha;
}

//Función que se utiliza para regresar el año actual
var anioActual = function(){
    var dteFecha = new Date();
    var strAnio = dteFecha.getFullYear();
    //Regresar año actual
    return strAnio;
}

function formatMoney(number, places, symbol, thousand, decimal) {
    number = number || 0;
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "$";
    thousand = thousand || ",";
    decimal = decimal || ".";
    var negative = number < 0 ? "-" : "",
        i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

//Función que se utiliza para regresar la hora actual
var horaActual = function(segundos){

    var dteFecha = new Date();
    var hours = dteFecha.getHours();
    var minutes = dteFecha.getMinutes();
    var seconds = dteFecha.getSeconds();
    var suffix = 'AM';

    // AM or PM?
    if (hours >= 12) {
      suffix = 'PM';
    }

    // Convert to 12-hour.
    if (hours > 12) {
      hours = hours - 12;
    }
    else if (hours === 0) {
      // Display 12:XX instead of 0:XX.
      hours = 12;
    }

    // Leading zero, if needed.
    if (minutes < 10) {
      minutes = '0' + minutes;
    }

    if (seconds<=9)
    {
        seconds="0"+seconds;
    }
        
    //change font size here to your desire
    if(segundos !== undefined){
        hora = hours+":"+minutes+" "+suffix;
    }
    else{
        hora = hours+":"+minutes+":"+seconds+" "+suffix;
    }    
        
    return hora;
}

//Función que se utiliza para regresar la hora actual sin segundos HH:MM
var horaActualSinSegundos = function(segundos){

    var dteFecha = new Date();
    var hours = dteFecha.getHours();
    var minutes = dteFecha.getMinutes();
    var suffix = 'AM';

    // AM or PM?
    if (hours >= 12) {
      suffix = 'PM';
    }

    // Convert to 12-hour.
    if (hours > 12) {
      hours = hours - 12;
    }
    else if (hours === 0) {
      // Display 12:XX instead of 0:XX.
      hours = 12;
    }

    // Leading zero, if needed.
    if (minutes < 10) {
      minutes = '0' + minutes;
    }

    hora = hours+":"+minutes+" "+suffix;   
        
    return hora;
}

//Función para convertir de AM/PM a 24 horas
var convertirHora12a24 = function(hora) {
   //Asignar hora con formato AM/PM (12 horas)
   var strHora = hora;

    //Si existe hora 
    if(strHora != '')
    {
        //Asignar hora para convertirla a formato 24 horas
        strHora = moment(hora, ["h:mm:ss A"]);
        //Regresar hora convertida a formato 24 horas 
        return strHora.format("HH:mm:ss");
    }
    else
    {
        //Regresar cadena vacia para evitar errores
        return strHora;
    }
}

//Función que se utiliza para validar la dirección de correo electrónico
jQuery.validarCorreoElectronico = function(campoID)
{
    //Asignar id del campo
    var correo = document.getElementById(campoID);
    //Expresión regular que se utiliza para validar dirección de correo electrónico
    var strEmailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Si existe correo
    if(correo.value != '')
    {
        //Si la dirección de correo electrónico no es válida
        if (!strEmailRegex.test(correo.value))
        {
           return false;
        }
    }
   
    return true;
}


/*
 * Función que se utiliza para agregar ceros a la izquierda de un número
 * campoID - id de la caja de texto en la que queremos poner ceros a la izquierda
 * ceros - es el número de dígitos que tendrá el número resultante
*/
jQuery.agregarCeros = function(campoID, ceros)
{ 
    //Asignar id del campo
    var codigo = document.getElementById(campoID);
    //Si existe número
    if(codigo.value != '')
    {
         //Convertir número en una cadena 
        var numero = codigo.value.toString();
        //Mientras la longitud sea menor al número de ceros
        while(numero.length < ceros)
        {
            //Concatenar al número el incremento de ceros
            numero = "0" + numero;
        }
        
        //Asignar número con ceros a la izquierda
        codigo.value = numero;
    }
   
}

/*Función para verificar la descripción de una cuenta, en caso de que contenga '-' separar y concatenar  
 * sus datos (primer_nivel, segundo_nivel, tercer_nivel y cuarto_nivel) por ejemplo: 100 00 00 00000  - CLIENTES LA BARCA 
 devolverá 100000000000 
 */
jQuery.concatenarCtaContable = function(descripcion, campoID)
{
     //Asignar id del campo
    var cuentaContable = document.getElementById(campoID);
    //Variable que se utiliza para asignar descripción de la cuenta
    var strDescripcion = descripcion;
    //Variable que se utiliza para concatenar los datos (cuenta, sub_cuenta, sub_sub_cuenta) de la cuenta contable
    var strCuentaConcat = '';

    //Búscar caracter en la descripción de la cuenta
    if(strDescripcion.indexOf('-') != -1)
    {
        //Separar cadena de texto 
        var arrDatosCuenta = strDescripcion.split("-");
        //Variable que se utiliza para concatenar los datos de la cuenta
        strCuentaConcat = arrDatosCuenta[0];
    }
    else
    {
        //Asignar cuenta contable
        strCuentaConcat = strDescripcion;
    }

    //Asignar valor a la caja de texto
    cuentaContable.value =  $.reemplazar(strCuentaConcat, " ", "");
}


/*
* Función para obtener una letra aleatoria de la A-Z
*/
var letraAleatoria = function()
{

    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZ";
    var string_length = 1;
    var randomstring = '';

    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }

    return randomstring;

}

/*
* Función para regresar clave de autorización
*/
var claveAutorizacion = function()
{
    //Variable que se utiliza para asignar clave 
    var strClave = "";

    //Obtener fecha atual
    var fecha = fechaActual();
    var res_fecha = fecha.split("/"); 
    var dia = parseInt(res_fecha[0]);
    var mes = parseInt(res_fecha[1]);
    var anio = parseInt(res_fecha[2]);
    //Obtener hora actual
    var hora = horaActual();
    var res_hora = hora.split(":");
    var hora = parseInt(res_hora[0]);
    var minuto = parseInt(res_hora[1]);
    var segundo = parseInt(res_hora[2]);
    var numero = dia+mes+anio+hora+minuto+segundo;
    var letra = letraAleatoria();

    //Asignar clave de autorización
    strClave  = numero+letra;

    //Regresar clave de autorización
    return strClave;

}

//Este metado es para abilitar los inputs o disabilitar los input
jQuery.habilitar_deshabilitar_campos = function(data){    
    data.rows.forEach(function (element, index){                
        $(element).prop(data.attribute, data.bool)  
    });

}
