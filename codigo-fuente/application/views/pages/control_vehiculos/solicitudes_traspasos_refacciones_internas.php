  <div id="SolicitudesTraspasosRefaccionesInternasControlVehiculosContent">  
        <!--Barra de herramientas-->
        <div class="panel-toolbar">
            <!--Diseño del formulario de Búsquedas-->
            <form class="form-horizontal" id="frmBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos" action="#" method="post" tabindex="-5" 
                  onsubmit="return(false)">
                <div class="row">
                    <!--Fecha inicial-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos">Fecha inicial</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos'>
                                    <input class="form-control" 
                                            id="txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                            name= "strFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Fecha final-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos">Fecha final</label>
                            </div>
                            <div class="col-md-12">
                                <div class='input-group date' id='dteFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos'>
                                    <input class="form-control" 
                                            id="txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                            name= "strFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Descripción-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos">Descripción</label>
                            </div>
                            <div class="col-md-12">
                                <input  class="form-control" id="txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                        name="strBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos" type="text" value="" tabindex="1" placeholder="Ingrese descripción" maxlength="250">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!--Estatus-->
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos">Estatus</label>
                            </div>
                            <div class="col-md-12">
                                <select class="form-control" id="cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                        name="strEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos" tabindex="1">
                                    <option value="TODOS">TODOS</option>
                                    <option value="ACTIVO">ACTIVO</option>s
                                    <option value="PARCIALMENTE SURTIDO">PARCIALMENTE SURTIDO</option>
                                    <option value="SURTIDO">SURTIDO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--Mostrar detalles de los registros en el reporte PDF--> 
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <div class="checkbox">
                            <label id="label-checkbox">
                                <input class="form-control" id="chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                       name="strImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" type="checkbox"
                                       value="" tabindex="1">
                                </input>
                                <span  class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                Imprimir detalles
                            </label>
                        </div>
                    </div>
                    <!--Botones-->
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <div id="ToolBtns" class="btn-group">
                            <!--Buscar registros-->
                            <button class="btn btn-primary" id="btnBuscar_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                    onclick="paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();" 
                                    title="Buscar coincidencias" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <!--Dar de alta un nuevo registro-->
                            <button class="btn btn-info" id="btnNuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                    title="Nuevo registro" tabindex="1" disabled> 
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </button>   
                            <!--Generar PDF con el listado de registros-->
                            <button class="btn btn-default"  id="btnImprimir_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                    onclick="reporte_solicitudes_traspasos_refacciones_internas_control_vehiculos();" 
                                    title="Imprimir reporte general en PDF" tabindex="1" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button>
                            <!--Descargar archivo XLS con el listado de registros-->
                            <button class="btn btn-success"  id="btnDescargarXLS_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                    onclick="descargar_xls_solicitudes_traspasos_refacciones_internas_control_vehiculos();" title="Descargar reporte general en XLS" tabindex="1" disabled>
                                <span class="fa fa-file-excel-o"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form><!--Cierre del formulario-->
        </div><!--Cierre de barra de herramientas-->
        <!--Estilo que se utiliza para mostrar los nombres de las columnas de la tabla en el dispositivo móvil -->
        <style>
            @media (max-width: 480px) 
            {
                /*
                Definir columnas de la tabla solicitudes de traspaso
                */
                td.movil.a1:nth-of-type(1):before {content: "Folio"; font-weight: bold;}
                td.movil.a2:nth-of-type(2):before {content: "Fecha"; font-weight: bold;}
                td.movil.a3:nth-of-type(3):before {content: "Estatus"; font-weight: bold;}
                td.movil.a4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

                /*
                Definir columnas de la tabla detalles de la solicitud de traspaso
                */
                td.movil.b1:nth-of-type(1):before {content: "Código"; font-weight: bold;}
                td.movil.b2:nth-of-type(2):before {content: "Descripción"; font-weight: bold;}
                td.movil.b3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
                td.movil.b4:nth-of-type(4):before {content: "Acciones"; font-weight: bold;}

                /*
                Definir columnas de los totales (acumulados) de la tabla detalles de la solicitud de traspaso
                */
                td.movil.t1:nth-of-type(1):before {content: ""; font-weight: bold;}
                td.movil.t2:nth-of-type(2):before {content: ""; font-weight: bold;}
                td.movil.t3:nth-of-type(3):before {content: "Cantidad"; font-weight: bold;}
            }
        </style>
        <!--Panel que contiene la tabla con los registros encontrados-->
        <div class="panel-content">
            <div class="container-fluid">
                <!-- Diseño de la tabla-->
                <table class="table-hover movil" id="dg_solicitudes_traspasos_refacciones_internas_control_vehiculos">
                    <thead class="movil">
                        <tr class="movil">
                            <th class="movil">Folio</th>
                            <th class="movil">Fecha</th>
                            <th class="movil">Estatus</th>
                            <th class="movil" id="th-acciones" style="width:11em;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="movil"></tbody>
                    <script id="plantilla_solicitudes_traspasos_refacciones_internas_control_vehiculos" type="text/template"> 
                    {{#rows}}
                        <tr class="movil {{estiloRegistro}}">   
                            <td class="movil a1">{{folio}}</td>
                            <td class="movil a2">{{fecha}}</td>
                            <td class="movil a3">{{estatus}}</td>
                            <td class="td-center movil a4"> 
                                <!--Editar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionEditar}}"  
                                        onclick="editar_solicitudes_traspasos_refacciones_internas_control_vehiculos({{solicitud_traspaso_refacciones_internas_id}},'Editar')"  title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <!--Ver registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionVerRegistro}}"  
                                        onclick="editar_solicitudes_traspasos_refacciones_internas_control_vehiculos({{solicitud_traspaso_refacciones_internas_id}},'Ver')"  title="Ver">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                <!--Generar PDF con los datos del registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionImprimir}}"  
                                        onclick="reporte_registro_solicitudes_traspasos_refacciones_internas_control_vehiculos({{solicitud_traspaso_refacciones_internas_id}});"  title="Imprimir"><span class="glyphicon glyphicon-print"></span>
                                </button>
                                <!--Desactivar registro-->
                                <button class="btn btn-default btn-xs {{mostrarAccionDesactivar}}" 
                                        onclick="cambiar_estatus_solicitudes_traspasos_refacciones_internas_control_vehiculos({{solicitud_traspaso_refacciones_internas_id}}, '{{estatus}}')" title="Desactivar">
                                    <span class="glyphicon glyphicon-ban-circle"></span>
                                </button>
                                <!--Restaurar registro-->
                                <button class="btn btn-default  btn-xs {{mostrarAccionRestaurar}}" 
                                        onclick="cambiar_estatus_solicitudes_traspasos_refacciones_internas_control_vehiculos({{solicitud_traspaso_refacciones_internas_id}},'{{estatus}}')"  
                                        title="Restaurar">
                                    <span class="fa fa-exchange"></span>
                                </button>
                            </td>
                        </tr>
                        {{/rows}}
                        {{^rows}}
                        <tr class="movil"> 
                            <td class="movil" colspan="5"> No se encontraron resultados.</td>
                        </tr> 
                        {{/rows}}
                    </script>
                </table>
                <br>
                <!--Diseño de la paginación-->
                <div class="row">
                    <!--Páginas-->
                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12" id="pagLinks_solicitudes_traspasos_refacciones_internas_control_vehiculos"></div>
                    <!--Número de registros encontrados-->
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                        <button class="btn btn-default btn-sm disabled pull-right">
                            <strong id="numElementos_solicitudes_traspasos_refacciones_internas_control_vehiculos">0</strong> encontrados
                        </button>
                    </div>
                </div> <!--Cierre del diseño de la paginación-->
            </div><!--#container-fluid-->
        </div><!--Cierre del contenedor de la tabla-->

        <!-- Diseño del modal-->
        <div id="SolicitudesTraspasosRefaccionesInternasControlVehiculosBox" class="ModalBody">
            <!--Título-->
            <div id="divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos"  class="ModalBodyTitle">
            <h1>Solicitud a Almacén</h1>
            </div>
            <!--Contenido-->
            <div class="ModalBodyContent">
                <!--Diseño del formulario-->
                <form id="frmSolicitudesTraspasosRefaccionesInternasControlVehiculos" method="post" action="#" class="form-horizontal" role="form" 
                      name="frmSolicitudesTraspasosRefaccionesInternasControlVehiculos"  onsubmit="return(false)" autocomplete="off">
                    <div class="row">
                        <!-- Folio -->
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta que se utiliza para recuperar el id del registro seleccionado-->
                                    <input id="txtSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                           name="intSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                           type="hidden" value="" />
                                    <label for="txtFolio_solicitudes_traspasos_refacciones_internas_control_vehiculos">Folio</label>
                                </div>
                                <div class="col-md-12">
                                    <input  class="form-control" id="txtFolio_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            name="strFolio_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            type="text" value="" placeholder="Autogenerado" disabled />
                                </div>
                            </div>
                        </div>
                        <!-- Fecha -->
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos">Fecha</label>
                                </div>
                                <div id="divFechaMsjValidacion" class="col-md-12">
                                    <div class='input-group date' id='dteFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos'>
                                        <input class="form-control" 
                                                id="txtFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                                name= "strFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                type="text"  value="" tabindex="1" placeholder="Ingrese fecha" maxlength="10"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Observaciones -->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos">Observaciones</label>
                                </div>  
                                <div class="col-md-12">
                                    <input  class="form-control" 
                                            id="txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            name="strObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                            type="text" value="" tabindex="1" placeholder="Ingrese observaciones" maxlength="250" />            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <!-- Caja de texto oculta para asignar el número de registros de la tabla detalles--> 
                                    <input id="txtNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                           name="intNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" type="hidden" value="">
                                    </input>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Detalles de la solicitud a almacén</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="row">
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <!-- Caja de texto oculta para recuperar el id de la  refacción seleccionada-->
                                                                <input id="txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                       name="intRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                       type="hidden" value="">
                                                                </input>
                                                                <label for="txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">
                                                                    Código
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        name="strCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese código" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Autocomplete que contiene las refacciones activas-->
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">
                                                                    Descripción
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control" 
                                                                        id="txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        name="strDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        type="text" value="" tabindex="1" 
                                                                        placeholder="Ingrese descripción" maxlength="250" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Cantidad-->
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-10">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">
                                                                    Cantidad
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input  class="form-control cantidad_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        id="txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        name="intCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                        type="text" value="" tabindex="1"
                                                                        placeholder="Ingrese cantidad" maxlength="14" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Botón agregar-->
                                                    <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2">
                                                        <button class="btn btn-primary btn-toolBtns pull-right" 
                                                                id="btnAgregar_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos" 
                                                                onclick="agregar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos();" 
                                                                title="Agregar" tabindex="1"> 
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Div que contiene la tabla con los detalles encontrados-->
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="row">
                                                    <!-- Diseño de la tabla-->
                                                    <table class="table-hover movil" id="dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">
                                                        <thead class="movil">
                                                            <tr class="movil">
                                                                <th class="movil">Código</th>
                                                                <th class="movil">Descripción</th>
                                                                <th class="movil">Cantidad</th>
                                                                <th class="movil" id="th-acciones" style="width:10em;">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="movil"></tbody>
                                                        <tfoot class="movil">
                                                            <tr class="movil">
                                                                <td class="movil t1">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="movil t2"></td>
                                                                <td  class="movil t3">
                                                                    <strong id="acumCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">0.00</strong>
                                                                </td>
                                                                <td class="movil"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <br>
                                                    <div class="row">
                                                        <!--Número de registros encontrados-->
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                            <button class="btn btn-default btn-sm disabled pull-right">
                                                                <strong id="numElementos_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos">0</strong> encontrados
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--Botones de acción (barra de tareas)-->
                    <div class="btn-group row footerModal">
                        <div class="col-md-12">
                            <!--Guardar registro-->
                            <button class="btn btn-success" id="btnGuardar_solicitudes_traspasos_refacciones_internas_control_vehiculos"  
                                    onclick="validar_solicitudes_traspasos_refacciones_internas_control_vehiculos();"  title="Guardar" tabindex="2" disabled>
                                <span class="fa fa-floppy-o"></span>
                            </button>
                            <!--Generar PDF con los datos del registro-->
                            <button class="btn btn-default" 
                                    id="btnImprimirRegistro_solicitudes_traspasos_refacciones_internas_control_vehiculos"  
                                    onclick="reporte_registro_solicitudes_traspasos_refacciones_internas_control_vehiculos('');"  
                                    title="Imprimir" tabindex="3" disabled>
                                <span class="glyphicon glyphicon-print"></span>
                            </button>
                            <!--Desactivar registro-->
                            <button class="btn btn-default" id="btnDesactivar_solicitudes_traspasos_refacciones_internas_control_vehiculos"  
                                    onclick="cambiar_estatus_solicitudes_traspasos_refacciones_internas_control_vehiculos('', 'ACTIVO');"  title="Desactivar" tabindex="4" disabled>
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </button>
                            <!--Restaurar registro-->
                            <button class="btn btn-default" id="btnRestaurar_solicitudes_traspasos_refacciones_internas_control_vehiculos"  
                                    onclick="cambiar_estatus_solicitudes_traspasos_refacciones_internas_control_vehiculos('','INACTIVO');"  title="Restaurar" tabindex="5" disabled>
                                <span class="fa fa-exchange"></span>
                            </button>
                            <!--Cerrar modal-->
                            <button class="btn  btn-cerrar"  id="btnCerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos"
                                    type="reset" aria-hidden="true" onclick="cerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos();" 
                                    title="Cerrar"  tabindex="6">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                </form><!--Cierre del formulario-->
            </div><!--Cierre del contenido-->
        </div><!--Cierre del modal-->
    </div><!--#SolicitudesTraspasosRefaccionesInternasControlVehiculosContent -->

    <!--Javascript con las funciones del formulario-->
    <script type="text/javascript">
        /*******************************************************************************************************************
        Funciones del formulario principal
        *********************************************************************************************************************/
        //Variables que se utilizan para la paginación de registros
        var intPaginaSolicitudesTraspasosRefaccionesInternasControlVehiculos = 0;
        var strUltimaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos = "";
        //Variables que se utilizan para la búsqueda de registros
        var dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos = "";
        var dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos = "";
        //Variable que se utiliza para asignar objeto del modal
        var objSolicitudesTraspasosRefaccionesInternasControlVehiculos = null;

        //Permisos  de acceso del usuario (Acciones Generales)
        function permisos_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Hacer un llamado al método del controlador para regresar los permisos de acceso
            $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/get_permisos_acceso',
            { 
                strPermisosAcceso: $('#txtAcciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()
            },
            function(data){
                //Si existen permisos de acceso del usuario para este proceso
                if (data.row)
                {
                    //Asignar a la variable la cadena concatenada con los permisos de acceso
                    //del usuario ejemplo:NUEVO|GUARDAR|ELIMINAR...
                    var strPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos = data.row;
                    //Separar la cadena 
                    var arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos = strPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos.split('|');

                    //Hacer recorrido para habilitar las acciones (botones) a las que tiene permiso el usuario
                    for (var i=0; i < arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos.length; i++)
                    {
                        //Habilitar Acción si se cuenta con  permiso de acceso
                        if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='NUEVO')//Si el indice es NUEVO
                        {
                            //Habilitar el control (botón nuevo)
                            $('#btnNuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                        //Si el indice es GUARDAR ó EDITAR (modificar)
                        else if((arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='GUARDAR') || (arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='EDITAR'))
                        {
                            //Habilitar el control (botón guardar)
                            $('#btnGuardar_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='BUSCAR')//Si el indice es BUSCAR
                        {
                            //Habilitar el control (botón buscar)
                            $('#btnBuscar_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                        }
                        else if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='CAMBIAR ESTATUS')//Si el indice es CAMBIAR ESTATUS
                        {
                            //Habilitar los siguientes controles
                            $('#btnDesactivar_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                            $('#btnRestaurar_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REPORTE')//Si el indice es IMPRIMIR REPORTE (general)
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimir_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='IMPRIMIR REGISTRO')//Si el indice es IMPRIMIR REGISTRO
                        {
                            //Habilitar el control (botón imprimir)
                            $('#btnImprimirRegistro_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                        else if(arrPermisosSolicitudesTraspasosRefaccionesInternasControlVehiculos[i]=='DESCARGAR XLS')//Si el indice es DESCARGAR XLS
                        {
                            //Habilitar el control (botón descargar XLS)
                            $('#btnDescargarXLS_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
                        }
                    }//Cerrar for
                }
            },
            'json');
        }

        //Función para la búsqueda de registros
        function paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos() 
        {

            //Concatenar datos para la nueva búsqueda
            var strNuevaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos =($('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+$('#txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+$('#cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+$('#txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());

            //Verificar si hubo cambios en la búsqueda
            if(strNuevaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos != strUltimaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos)
            {
                intPaginaSolicitudesTraspasosRefaccionesInternasControlVehiculos = 0;
                strUltimaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos = strNuevaBusquedaSolicitudesTraspasosRefaccionesInternasControlVehiculos;
            }

            
            //Hacer un llamado al método del controlador para regresar listado de registros
            $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/get_paginacion',
                    { //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                      dteFechaInicial: $.formatFechaMysql($('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()),
                      dteFechaFinal: $.formatFechaMysql($('#txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()),
                      strEstatus:  $('#cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(),
                      strBusqueda: $('#txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(),
                      intPagina: intPaginaSolicitudesTraspasosRefaccionesInternasControlVehiculos,
                      strPermisosAcceso: $('#txtAcciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()
                    },
                    function(data){
                        $('#dg_solicitudes_traspasos_refacciones_internas_control_vehiculos tbody').empty();
                        var tmpSolicitudesTraspasosRefaccionesInternasControlVehiculos = Mustache.render($('#plantilla_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(),data);
                        $('#dg_solicitudes_traspasos_refacciones_internas_control_vehiculos tbody').html(tmpSolicitudesTraspasosRefaccionesInternasControlVehiculos);
                        $('#pagLinks_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(data.paginacion);
                        $('#numElementos_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(data.total_rows);
                        intPaginaSolicitudesTraspasosRefaccionesInternasControlVehiculos = data.pagina;
                    },
            'json');
        }

        //Función para cargar el reporte general en PDF
        function reporte_solicitudes_traspasos_refacciones_internas_control_vehiculos() 
        {
            //Asignar valores para la búsqueda de registros
            dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());
            dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());

            //Si no existe fecha inicial
            if(dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos == '')
            {
                dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos = '0000-00-00';
            }

            //Si no existe fecha final
            if(dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos == '')
            {
                dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos =  '0000-00-00';
            }

            //Si el checkbox incluir detalles se encuentra seleccionado (marcado)
            if ($('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').is(':checked')) {
                //Asignar SI para incluir detalles en el reporte
                $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('SI');
            }
            else
            { 
               //Asignar NO para  no incluir detalles en el reporte
               $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('NO');
            }

            //Hacer un llamado al método del controlador para generar reporte PDF
            window.open("control_vehiculos/solicitudes_traspasos_refacciones_internas/get_reporte/"+dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos+"/"+dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos+"/"+
                $('#cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+"/"+
                $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+"/"+
                $('#txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());
        }

        //Función para cargar el reporte de un registro en PDF
        function reporte_registro_solicitudes_traspasos_refacciones_internas_control_vehiculos(id) 
        {
            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Si no existe id, significa que se realizará la impresión desde el modal
            if(id == '')
            {
                intID = $('#txtSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();
            }
            else
            {
                intID = id;
            }

            //Hacer un llamado al método del controlador para generar reporte PDF
            window.open("control_vehiculos/solicitudes_traspasos_refacciones_internas/get_reporte_registro/"+intID);
        }

        //Función para descargar el archivo XLS
        function descargar_xls_solicitudes_traspasos_refacciones_internas_control_vehiculos() 
        {
            //Asignar valores para la búsqueda de registros
            dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());
            dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos =  $.formatFechaMysql($('#txtFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());

            //Si no existe fecha inicial
            if(dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos == '')
            {
                dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos = '0000-00-00';
            }

            //Si no existe fecha final
            if(dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos == '')
            {
                dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos =  '0000-00-00';
            }
            
            
            //Si el checkbox incluir detalles se encuentra seleccionado (marcado)
            if ($('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').is(':checked')) {
                //Asignar SI para incluir detalles en el archivo
                $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('SI');
            }
            else
            { 
               //Asignar NO para  no incluir detalles en el archivo
               $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('NO');
            }

            //Hacer un llamado al método del controlador para generar (y descargar) archivo XLS
            window.open("control_vehiculos/solicitudes_traspasos_refacciones_internas/get_xls/"+dteFechaInicialSolicitudesTraspasosRefaccionesInternasControlVehiculos+"/"+dteFechaFinalSolicitudesTraspasosRefaccionesInternasControlVehiculos+"/"+
                $('#cmbEstatusBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+"/"+
                $('#chbImprimirDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()+"/"+
                $('#txtBusqueda_solicitudes_traspasos_refacciones_internas_control_vehiculos').val());
        }

        

        /*******************************************************************************************************************
        Funciones del modal
        *********************************************************************************************************************/
        // Función para limpiar los campos del formulario
        function nuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Incializar formulario
            $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos')[0].reset();
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_solicitudes_traspasos_refacciones_internas_control_vehiculos();
            //Limpiar cajas de texto ocultas
            $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos').find('input[type=hidden]').val('');
            //Asignar la fecha actual
            $('#txtFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(fechaActual()); 
             //Eliminar los datos de la tabla detalles del movimiento
            $('#dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos tbody').empty();
            $('#acumCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html('0.00');
            $('#numElementos_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(0);
            //Quitar clases del div para poder tomar el color correspondiente al estatus del registro
            $('#divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeClass("estatus-NUEVO");
            $('#divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeClass("estatus-ACTIVO");
            $('#divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeClass("estatus-INACTIVO");
            $('#divEncabezadoModal_requisiciones_refacciones_servicio').removeClass("estatus-PARCIALMENTE_SURTIDO")
            $('#divEncabezadoModal_requisiciones_refacciones_servicio').removeClass("estatus-SURTIDO");
            //Habilitar todos los elementos del formulario
            $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos').find('input, textarea, select').removeAttr('disabled','disabled');
            //Habilitar botón Agregar
            $('#btnAgregar_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').removeAttr('disabled');
            //Deshabilitar las siguientes cajas de texto
            $('#txtFolio_solicitudes_traspasos_refacciones_internas_control_vehiculos').attr("disabled", "disabled");
            $("#txtCostoUnitario_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos").attr('disabled','disabled');
            //Mostrar los siguientes botones
            $("#btnGuardar_solicitudes_traspasos_refacciones_internas_control_vehiculos").show();
            //Ocultar los siguientes botones
            $("#btnImprimirRegistro_solicitudes_traspasos_refacciones_internas_control_vehiculos").hide();
            $("#btnDesactivar_solicitudes_traspasos_refacciones_internas_control_vehiculos").hide();
            $("#btnRestaurar_solicitudes_traspasos_refacciones_internas_control_vehiculos").hide();
        }

        //Función que se utiliza para cerrar el modal
        function cerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            try {
                //Cerrar modal
                objSolicitudesTraspasosRefaccionesInternasControlVehiculos.close();
                //Enfocar caja de texto 
                $('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                
            }
            catch(err) {}
        }

        //Función que se utiliza para mostrar los mensajes de los campos obligatorios del formulario
        function validar_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Hacer un llamado a la función para limpiar los mensajes de error 
            limpiar_mensajes_solicitudes_traspasos_refacciones_internas_control_vehiculos();
            //Validación del formulario de campos obligatorios
            $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos')
                .bootstrapValidator({   excluded: [':disabled'],
                                        container: 'popover',
                                        feedbackIcons: {
                                            valid: 'glyphicon glyphicon-ok',
                                            invalid: 'glyphicon glyphicon-remove',
                                            validating: 'glyphicon glyphicon-refresh'
                                        },
                                        fields: {
                                            strFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos: {
                                                validators: {
                                                    notEmpty: {message: 'Seleccione una fecha'}
                                                }
                                            },
                                            intNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos: {
                                                validators: {
                                                    callback: {
                                                        callback: function(value, validator, $field) {
                                                            //Verificar que existan detalles
                                                            if(parseInt(value) === 0 || value === '')
                                                            {
                                                                return {
                                                                    valid: false,
                                                                    message: 'Agregar al menos un detalle para esta solicitud a almacén.'
                                                                };
                                                            }
                                                            return true;
                                                        }
                                                    }
                                                }
                                            },
                                            strCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            strDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos:{
                                                excluded: true  // Ignorar (no valida el campo)    
                                            },
                                            intCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos: {
                                                excluded: true  // Ignorar (no valida el campo)    
                                            }
                                        }
                                    });
            //Variable que se utiliza para asignar el objeto bootstrapValidator
            var bootstrapValidator_solicitudes_traspasos_refacciones_internas_control_vehiculos = $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos').data('bootstrapValidator');
            bootstrapValidator_solicitudes_traspasos_refacciones_internas_control_vehiculos.validate();
            //Si se cumplen las reglas de validación
            if(bootstrapValidator_solicitudes_traspasos_refacciones_internas_control_vehiculos.isValid())
            {
                //Hacer un llamado a la función para guardar los datos del registro
                guardar_solicitudes_traspasos_refacciones_internas_control_vehiculos();
            }
            else 
                return;
        }

        //Función para limpiar mensajes de validación del formulario
        function limpiar_mensajes_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            try
            {
                $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos').data('bootstrapValidator').resetForm();

            }
            catch(err) {}
        }

        //Función para guardar o modificar los datos de un registro
        function guardar_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Obtenemos el objeto de la tabla detalles
            var objTabla = document.getElementById('dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que obtendrán los datos de la tabla
            var arrRefaccionID = [];
            var arrCodigos = [];
            var arrDescripciones = [];
            var arrCantidades = [];

            //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Variables que se utilizan para asignar valores del detalle
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                var intCantidad =  $.reemplazar(objRen.cells[2].innerHTML, ",", "");
              
                //Asignar valores a los arrays
                arrRefaccionID.push(objRen.getAttribute('id'));
                arrCodigos.push(objRen.cells[0].innerHTML);
                arrDescripciones.push(objRen.cells[1].innerHTML);
                arrCantidades.push(intCantidad);
            }

            //Hacer un llamado al método del controlador para guardar los datos del registro
            $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/guardar',
                    { 
                        //Datos de la solicitud de traspaso
                        intSolicitudTraspasoRefaccionesInternasID: $('#txtSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(),
                        //Hacer un llamado a la función para cambiar el formato de la fecha a año-mes-día
                        dteFecha: $.formatFechaMysql($('#txtFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos').val()),
                        strObservaciones: $('#txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(),
                        intProcesoMenuID: $('#txtProcesoMenuID_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(),
                        //Datos de los detalles
                        strRefaccionID: arrRefaccionID.join('|'),
                        strCodigos: arrCodigos.join('|'),
                        strDescripciones: arrDescripciones.join('|'),
                        strCantidades: arrCantidades.join('|')

                    },
                    function(data) {
                        if (data.resultado)
                        {   
                            //Hacer un llamado a la función para cerrar modal
                            cerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                            //Hacer llamado a la función  para cargar  los registros en el grid
                            paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();   
                        }

                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                        mensaje_solicitudes_traspasos_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
                    },
            'json');
        }

        //Función para mostrar mensaje de éxito o error
        function mensaje_solicitudes_traspasos_refacciones_internas_control_vehiculos(tipoMensaje, mensaje)
        {
            //Si el tipo de mensaje es error 
            if(tipoMensaje == 'error')
            { 
                //Indicar al usuario el mensaje de error
                new  $.Zebra_Dialog(mensaje, 
                              {'type': 'error',
                               'title': 'Error'
                              });
            }
            else if(tipoMensaje == 'informacion')
            { 
                //Indicar al usuario el mensaje de información
                new $.Zebra_Dialog(mensaje, {
                                'type': 'information',
                                'title': 'Información',
                                'buttons': [{caption: 'Aceptar',
                                             callback: function () {
                                                //Enfocar caja de texto
                                                $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                                             }
                                            }]
                              });
            }
            else
            {
                //Indicar al usuario el mensaje de éxito
                new $.Zebra_Dialog(mensaje, 
                              {'type': 'confirmation',
                               'title': 'Éxito',
                               'buttons': false,
                               'modal': false,
                               'auto_close': 2000
                              });
            }
        }

        // Función para cambiar el estatus del registro seleccionado
        function cambiar_estatus_solicitudes_traspasos_refacciones_internas_control_vehiculos(id, estatus)
        {
            //Variable que se utiliza para asignar el id del registro
            var intID = 0;
            //Si no existe id, significa que se realizará la modificación desde el modal
            if(id == '')
            {
                intID = $('#txtSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();

            }
            else
            {
                intID = id;
            }

             //Si el estatus del registro es ACTIVO
            if(estatus == 'ACTIVO')
            {

                //Preguntar al usuario si desea desactivar el registro
                new $.Zebra_Dialog('<strong>¿Está seguro que desea desactivar el registro?</strong>',
                             {'type':     'question',
                              'title':    'Solicitud a Almacén',
                              'buttons':  ['Aceptar', 'Cancelar'],
                              'onClose':  function(caption) {
                                            if(caption == 'Aceptar')
                                            {
                                              //Hacer un llamado al método del controlador para cambiar el estatus a INACTIVO
                                              $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/set_estatus',
                                                     {intSolicitudTraspasoRefaccionesInternasID: intID,
                                                      strEstatus: estatus
                                                     },
                                                     function(data) {
                                                        if(data.resultado)
                                                        {
                                                            //Hacer llamado a la función  para cargar  los registros en el grid
                                                            paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();

                                                            //Si el id del registro se obtuvo del modal
                                                            if(id == '')
                                                            {
                                                                //Hacer un llamado a la función para cerrar modal
                                                                cerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos();     
                                                            }
                                                        }
                                                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                                                        mensaje_solicitudes_traspasos_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
                                                     },
                                                    'json');
                                            }
                                          }
                              });
            }
            else
            {
                //Hacer un llamado al método del controlador para cambiar el estatus a ACTIVO
                $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/set_estatus',
                     {intSolicitudTraspasoRefaccionesInternasID: intID,
                      strEstatus: estatus
                     },
                     function(data) {
                        if (data.resultado)
                        {
                            //Hacer llamado a la función para cargar  los registros en el grid
                            paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();

                            //Si el id del registro se obtuvo del modal
                            if(id == '')
                            {
                                //Hacer un llamado a la función para cerrar modal
                                cerrar_solicitudes_traspasos_refacciones_internas_control_vehiculos();     
                            }
                        }
                        //Hacer un llamado a la función para mostrar mensaje que corresponde al tipo 
                        mensaje_solicitudes_traspasos_refacciones_internas_control_vehiculos(data.tipo_mensaje, data.mensaje);
                     },
                     'json');
            }

        }

        //Función para regresar los datos (al formulario) del registro seleccionado
        function editar_solicitudes_traspasos_refacciones_internas_control_vehiculos(id, tipoAccion)
        {
            //Hacer un llamado al método del controlador para regresar los datos del registro
            $.post('control_vehiculos/solicitudes_traspasos_refacciones_internas/get_datos',
                   {intSolicitudTraspasoRefaccionesInternasID:id
                   },
                   function(data) {
                        //Si hay datos del registro
                        if(data.row)
                        {
                            //Hacer un llamado a la función para limpiar los campos del formulario
                            nuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                           //Asignar estatus y reemplazar cadena vacia por '_'
                            var strEstatus = data.row.estatus;
                            strEstatus = strEstatus.replace(" ", "_");
                            //Variable que se utiliza para asignar las acciones del grid view
                            var strAccionesTabla = '';

                            //Recuperar valores
                            $('#txtSolicitudTraspasoRefaccionesInternasID_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(data.row.solicitud_traspaso_refacciones_internas_id);
                            $('#txtFolio_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(data.row.folio);
                            $('#txtFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(data.row.fecha);
                            $('#txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(data.row.observaciones);
                              //Dependiendo del estatus cambiar el color del encabezado 
                            $('#divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos').addClass("estatus-"+strEstatus);
                            //Mostrar botón Imprimir  
                            $("#btnImprimirRegistro_solicitudes_traspasos_refacciones_internas_control_vehiculos").show();

                            //Si el tipo de acción corresponde a Ver
                            if(tipoAccion == 'Ver')
                            {
                                //Deshabilitar todos los elementos del formulario
                                $('#frmSolicitudesTraspasosRefaccionesInternasControlVehiculos').find('input, textarea, select').attr('disabled','disabled');
                                //Ocultar los siguientes botones
                                $("#btnGuardar_solicitudes_traspasos_refacciones_internas_control_vehiculos").hide();

                                //Si el estatus del registro es INACTIVO
                                if(strEstatus == 'INACTIVO')
                                {
                                    //Mostrar botón Restaurar
                                    $("#btnRestaurar_solicitudes_traspasos_refacciones_internas_control_vehiculos").show();
                                }
                            }
                            else
                            {
                                strAccionesTabla =  "<button class='btn btn-default btn-xs' title='Editar'" +
                                                    " onclick='editar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(this)'>" + 
                                                     "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                     " onclick='eliminar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(this)'>" + 
                                                     "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                     "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                     "<span class='glyphicon glyphicon-arrow-down'></span></button>";

                                //Mostrar el botón Desactivar
                                $("#btnDesactivar_solicitudes_traspasos_refacciones_internas_control_vehiculos").show();
                            }


                            //Mostramos los detalles del registro
                            for (var intCon in data.detalles) 
                            {
                                //Obtenemos el objeto de la tabla
                                var objTabla = document.getElementById('dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

                                //Insertamos el renglón con sus celdas en el objeto de la tabla
                                var objRenglon = objTabla.insertRow();
                                var objCeldaCodigo = objRenglon.insertCell(0);
                                var objCeldaDescripcion = objRenglon.insertCell(1);
                                var objCeldaCantidad = objRenglon.insertCell(2);
                                var objCeldaAcciones = objRenglon.insertCell(3);

                                //Asignar valores
                                objRenglon.setAttribute('class', 'movil');
                                objRenglon.setAttribute('id', data.detalles[intCon].refaccion_id);
                                objCeldaCodigo.setAttribute('class', 'movil b1');
                                objCeldaCodigo.innerHTML = data.detalles[intCon].codigo;
                                objCeldaDescripcion.setAttribute('class', 'movil b2');
                                objCeldaDescripcion.innerHTML = data.detalles[intCon].descripcion;
                                objCeldaCantidad.setAttribute('class', 'movil b3');
                                objCeldaCantidad.innerHTML = formatMoney(data.detalles[intCon].cantidad, 2, '');
                                objCeldaAcciones.setAttribute('class', 'td-center movil b4');
                                objCeldaAcciones.innerHTML =strAccionesTabla;
                            }

                            //Hacer un llamado a la función para calcular totales de la tabla
                            calcular_totales_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
                            var intFilas = $("#dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos tr").length - 2;
                            $('#numElementos_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(intFilas);
                            $('#txtNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(intFilas);
                          
                            //Abrir modal
                            objSolicitudesTraspasosRefaccionesInternasControlVehiculos = $('#SolicitudesTraspasosRefaccionesInternasControlVehiculosBox').bPopup({
                                                           appendTo: '#SolicitudesTraspasosRefaccionesInternasControlVehiculosContent', 
                                                           contentContainer: 'SolicitudesTraspasosRefaccionesInternasControlVehiculosM', 
                                                           zIndex: 2, 
                                                           modalClose: false, 
                                                           modal: true, 
                                                           follow: [true,false], 
                                                           followEasing : "linear", 
                                                           easing: "linear", 
                                                           modalColor: ('#F0F0F0')});

                            //Enfocar caja de texto
                            $('#txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                        }
                   },
                   'json');
        }

        
        
        /*******************************************************************************************************************
        Funciones de la tabla detalles
        *********************************************************************************************************************/
        //Función para agregar renglón a la tabla
        function agregar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Obtenemos los datos de las cajas de texto
            var intRefaccionID = $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();
            var strCodigo = $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();
            var strDescripcion = $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();
            var intCantidad = $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val();
           
            //Obtenemos el objeto de la tabla
            var objTabla = document.getElementById('dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

            //Validamos que se capturaron datos
            if (intRefaccionID == '' || strCodigo == '')
            {
                //Enfocar caja de texto
                $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
            }
            else if (intRefaccionID == '' || strDescripcion == '')
            {
                //Enfocar caja de texto
                $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
            }
            else if (intCantidad == '')
            {
                //Enfocar caja de texto
                $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
            }
            else
            {
                //Convertir cadena de texto a número decimal
                intCantidad = parseFloat($.reemplazar(intCantidad, ",", ""));
                
                //Limpiamos las cajas de texto
                $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
              
                //Revisamos si existe el ID proporcionado, si es así, editamos los datos
                if (objTabla.rows.namedItem(intRefaccionID))
                {
                   
                    objTabla.rows.namedItem(intRefaccionID).cells[2].innerHTML = formatMoney(intCantidad, 2, '');
                }
                else
                {

                    //Insertamos el renglón con sus celdas en el objeto de la tabla
                    var objRenglon = objTabla.insertRow();
                    var objCeldaCodigo = objRenglon.insertCell(0);
                    var objCeldaDescripcion = objRenglon.insertCell(1);
                    var objCeldaCantidad = objRenglon.insertCell(2);
                    var objCeldaAcciones = objRenglon.insertCell(3);
                    
                    //Asignar valores
                    objRenglon.setAttribute('class', 'movil');
                    objRenglon.setAttribute('id', intRefaccionID);
                    objCeldaCodigo.setAttribute('class', 'movil b1');
                    objCeldaCodigo.innerHTML = strCodigo;
                    objCeldaDescripcion.setAttribute('class', 'movil b2');
                    objCeldaDescripcion.innerHTML = strDescripcion;
                    objCeldaCantidad.setAttribute('class', 'movil b3');
                    objCeldaCantidad.innerHTML = formatMoney(intCantidad, 2, '');
                    objCeldaAcciones.setAttribute('class', 'td-center movil b4');
                    objCeldaAcciones.innerHTML = "<button class='btn btn-default btn-xs' title='Editar'" +
                                                 " onclick='editar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(this)'>" + 
                                                 "<span class='glyphicon glyphicon-edit'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs' title='Eliminar'" +
                                                 " onclick='eliminar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(this)'>" + 
                                                 "<span class='glyphicon glyphicon-trash'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs up' title='Subir'>" + 
                                                 "<span class='glyphicon glyphicon-arrow-up'></span></button>" + 
                                                 "<button class='btn btn-default btn-xs down' title='Bajar'>" + 
                                                 "<span class='glyphicon glyphicon-arrow-down'></span></button>";
                    
                }

                //Hacer un llamado a la función para calcular totales de la tabla
                calcular_totales_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                
                //Enfocar caja de texto
                $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                
            }

            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos tr").length - 2;
            $('#numElementos_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(intFilas);
            $('#txtNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(intFilas);
        }

        //Función para regresar los datos (al formulario) del renglón seleccionado
        function editar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(objRenglon)
        {
            //Asignar los valores a las cajas de texto
            $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.getAttribute("id"));
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[0].innerHTML);
            $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[1].innerHTML);
            $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(objRenglon.parentNode.parentNode.cells[2].innerHTML);
            //Enfocar caja de texto
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
        }

        //Función para quitar renglón de la tabla
        function eliminar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos(objRenglon)
        {
            //Obtener el indice del objeto renglón que se envía
            var intRenglon = objRenglon.parentNode.parentNode.rowIndex;
            
            //Eliminar el renglón indicado
            document.getElementById("dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos").deleteRow(intRenglon);

            //Hacer un llamado a la función para calcular totales de la tabla
            calcular_totales_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos();
            
            //Asignar el número de filas de la tabla (se quitan la primera y la última fila por que corresponden al encabezado de la tabla y al acumulado (total))
            var intFilas = $("#dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos tr").length - 2;
            $('#numElementos_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(intFilas);
            $('#txtNumDetalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(intFilas);

            //Enfocar caja de texto
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
        }

        //Función para calcular totales de la tabla
        function calcular_totales_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos()
        {
            //Obtenemos el objeto de la tabla 
            var objTabla = document.getElementById('dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').getElementsByTagName('tbody')[0];

            //Inicializamos las variables que se utilizan para los acumulados
            var intAcumUnidades = 0;

            //Recorrer los renglones de la tabla para obtener los valores
            for (var intRen = 0, objRen; objRen = objTabla.rows[intRen]; intRen++) 
            {
                //Incrementar acumulados
                //Hacer un llamado a la función para reemplazar ',' por cadena vacia
                intAcumUnidades += parseFloat($.reemplazar(objRen.cells[2].innerHTML, ",", ""));
            }

            //Convertir total de unidades a 2 decimales
            intAcumUnidades = formatMoney(intAcumUnidades, 2, '');

            //Asignar los valores
            $('#acumCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').html(intAcumUnidades);
            
        }

        //Controles o Eventos del Modal
        $(document).ready(function() 
        {
            /*******************************************************************************************************************
            Controles correspondientes al modal
            *********************************************************************************************************************/
            //Validar campos decimales (no hay necesidad de poner '.')
            $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').numeric();
          
            /*Asignar formatCurrency (formato Moneda) a la clase para cambiar el formato de la cantidad
             * por ejemplo: 10 será 10.00*/
            $('.cantidad_solicitudes_traspasos_refacciones_internas_control_vehiculos').blur(function(){
                $('.cantidad_solicitudes_traspasos_refacciones_internas_control_vehiculos').formatCurrency({ roundToDecimalPlace: 2 });
            });

            //Agregar datepicker para seleccionar fecha
            $('#dteFecha_solicitudes_traspasos_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
          
    
            //Autocomplete para recuperar los datos de una refacción
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'codigo'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(ui.item.data);
                      //Separar datos del valor devuelto en el autocomplete (devuelve un arreglo)
                      var arrDatos = ui.item.value.split(" - ");
                      //Asignar código
                      ui.item.value = arrDatos[0];
                     $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(arrDatos[1]);
                      //Enfocar caja de texto
                     $("#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos").focus();
                 },
                 open: function() {
                     $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                   },
                   close: function() {
                     $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                   },
                 minLength: 1
            });

            //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '' ||
                   $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                   $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                   $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                }

            });

            //Autocomplete para recuperar los datos de una refacción
            $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').autocomplete({
                  source: function( request, response ) {
                     //Limpiar caja de texto que hace referencia al id del registro 
                     $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                     $.ajax({
                       //Hacer un llamado al método del controlador para regresar las coincidencias encontradas
                       url: "refacciones/refacciones/autocomplete",
                       type: "post",
                       dataType: "json",
                       data: {
                         strDescripcion: request.term,
                         strTipo: 'descripcion'
                       },
                       success: function( data ) {
                         response( data );
                       }
                     });
                 },
                 select: function( event, ui ) {
                    //Asignar id del registro seleccionado
                    $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(ui.item.data);
                    //Separar datos del valor devuelto en el autocomplete (devuelve un arreglo)
                    var arrDatos = ui.item.value.split(" - ");
                    //Asignar descripción
                    ui.item.value = arrDatos[1];
                    $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val(arrDatos[0]);
                    //Enfocar caja de texto
                    $("#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos").focus();

                 },
                 open: function() {
                     $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                   },
                   close: function() {
                     $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                   },
                 minLength: 1
            });

            //Verificar que exista id de la refacción cuando pierda el enfoque la caja de texto
            $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focusout(function(e){
                //Si no existe id de la refacción
                if($('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '' ||
                   $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '')
                { 
                   //Limpiar contenido de las siguientes cajas de texto
                   $('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                   $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                   $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val('');
                }

            });


            //Función para mover renglones arriba y abajo en la tabla
            $('#dg_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('click','button.btn',function(){
                //Asignar renglón mas cercano
                var row = $(this).closest('tr');
                //Bajar renglón
                if ($(this).hasClass('btn-default btn-xs down'))
                {
                    //Pasar al siguiente renglón
                    row.next().after(row);
                }
                else if($(this).hasClass('btn-default btn-xs up'))//Subir renglón
                {
                    //Pasar al renglón de arriba
                    row.prev().before(row);
                }
                
            });

            //Validar que exista código de la refacción cuando se pulse la tecla enter 
            $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe código de la refacción
                    if($('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '' || $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCodigo_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                    }
                }
            });

            //Validar que exista descripción de la refacción cuando se pulse la tecla enter 
            $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe descripción de la refacción
                    if($('#txtRefaccionID_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '' || $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtDescripcion_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                    }
                    else
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                    }
                }
            });

            //Validar que exista cantidad cuando se pulse la tecla enter 
            $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('keypress', function (e) {
                if(e.which === 13 )
                {
                    //Si no existe cantidad
                    if($('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').val() == '')
                    {
                        //Enfocar caja de texto
                        $('#txtCantidad_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
                    }
                    else
                    {
                        //Hacer un llamado a la función para agregar renglón a la tabla
                        agregar_renglon_detalles_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                    }
                }
            });

           

            /*******************************************************************************************************************
            Controles correspondientes al formulario principal
            *********************************************************************************************************************/
            //Agregar a las siguientes cajas de texto el datepicker para seleccionar fecha
            $('#dteFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY'});
            $('#dteFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').datetimepicker({format: 'DD/MM/YYYY',
                                                                                                                useCurrent: false});
            //Deshabilitar los días posteriores a la fecha final
            $('#dteFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
                $('#dteFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').data('DateTimePicker').minDate(e.date);
            });

            //Deshabilitar los días anteriores a la fecha inicial
            $('#dteFechaFinalBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('dp.change', function (e) {
                $('#dteFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').data('DateTimePicker').maxDate(e.date);
            });
            

            //Paginación de registros
            $('#pagLinks_solicitudes_traspasos_refacciones_internas_control_vehiculos').on('click','a',function(event){
                event.preventDefault();
                intPaginaSolicitudesTraspasosRefaccionesInternasControlVehiculos = $(this).attr('href').replace('/','');
                //Hacer llamado a la función  para cargar  los registros en el grid
                paginacion_solicitudes_traspasos_refacciones_internas_control_vehiculos();
            });

            //Abrir modal cuando se de clic en el botón
            $('#btnNuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos').bind('click', function(e) {
                e.preventDefault();
                //Hacer un llamado a la función para limpiar los campos del formulario
                nuevo_solicitudes_traspasos_refacciones_internas_control_vehiculos();
                //Cambiar color del encabezado (de esta manera el usuario identificara que se trata de un nuevo registro)
                $('#divEncabezadoModal_solicitudes_traspasos_refacciones_internas_control_vehiculos').addClass("estatus-NUEVO");
                //Abrir modal
                objSolicitudesTraspasosRefaccionesInternasControlVehiculos = $('#SolicitudesTraspasosRefaccionesInternasControlVehiculosBox').bPopup({
                                               appendTo: '#SolicitudesTraspasosRefaccionesInternasControlVehiculosContent', 
                                               contentContainer: 'SolicitudesTraspasosRefaccionesInternasControlVehiculosM', 
                                               zIndex: 2, 
                                               modalClose: false, 
                                               modal: true, 
                                               follow: [true,false], 
                                               followEasing : "linear", 
                                               easing: "linear", 
                                               modalColor: ('#F0F0F0')});

                //Enfocar caja de texto
                $('#txtObservaciones_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
            });

            //Enfocar caja de texto
            $('#txtFechaInicialBusq_solicitudes_traspasos_refacciones_internas_control_vehiculos').focus();
            //Hacer un llamado a la función para obtener los permisos de acceso
            permisos_solicitudes_traspasos_refacciones_internas_control_vehiculos();

        });
    </script>