<?php

/* Descripción. helper para generar la plantilla de los reportes con fpdf (encabezado y pie de pagina) 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* helper funcion ayuda a definir los margenes tipografía y creación del footer y números de pagína */

//Incluir la clase modelo de empresas (para recuperar los datos de la empresa y mostrarlos en el encabezado del PDF)
include_once(APPPATH . 'models/administracion/Empresas_model.php');
//Incluir la clase modelo de sucursales (para recuperar los datos de la sucursal que esta logeada en el sistema
//y mostrarlos en el encabezado del PDF)
include_once(APPPATH . 'models/administracion/Sucursales_model.php');

class PDF extends FPDF {
    //Variable que se utiliza para el identificador de la sucursal logeada 
    var $intSucursalID;
    //Variable que se utiliza para la descripción del reporte
    var $strLinea1;
    //Variable que se utiliza para la segunda descripción del reporte
    var $strLinea2;
    //Variable que se utiliza para la tercera descripción del reporte
    var $strLinea3;
    //Variable que se utiliza para la cuarta descripción del reporte
    var $strLinea4;
    //Variable que se utiliza para la quinta descripción del reporte
    var $strLinea5;
    //Array con la información de la segunda descripción del reporte
    var $arrDatosLinea2;
    //Variables que se utilizan para la primer cabecera de la tabla
    //Array con la información de la cabecera (titulos columnas) de la tabla
    var $arrCabecera;
    //Array con el ancho de las columnas de la tabla
    var $arrAnchura;
    //Array con la alineación de cada título del encabezado de la tabla
    var $arrAlineacion;
    //Variables que se utilizan para la segunda cabecera de la tabla
    //Array con la información de la cabecera (titulos columnas) de la tabla
    var $arrCabecera2;
    //Array con el ancho de las columnas de la tabla
    var $arrAnchura2;
    //Array con la alineación de cada título del encabezado de la tabla
    var $arrAlineacion2;
    //Variables que se utilizan para la tecera cabecera de la tabla
    //Array con la información de la cabecera (titulos columnas) de la tabla
    var $arrCabecera3;
    //Array con el ancho de las columnas de la tabla
    var $arrAnchura3;
    //Array con la alineación de cada título del encabezado de la tabla
    var $arrAlineacion3;
    //Variable que se utiliza para recuperar el nombre del usario que esta logeado en el sistema 
    // y así saber quien imprimio el reporte 
    var $strUsuario;
    //Variable que se utiliza para recuperar el nombre del usario de creación
    var $strUsuarioCreacion;
    //Variable que se utiliza para recuperar la fecha de creación
    var $dteFechaCreacion;
    //Variable que se utiliza para incluir membrete de la hoja 
    var $strIncluirMembrete;
     //Variable que se utiliza para cambiar el tipo de letra de la tabla
    var $strTipoLetraTabla;
    //Variable que se utiliza para cambiar el valor de la abscisa SetX();
    var $intValorAbscisa;
    //Constructor de la clase
    function _constructor() {
        $this->intSucursalID = 0;
        $this->strUsuario = '';
        $this->strUsuarioCreacion = '';
        $this->dteFechaCreacion = '';
        $this->strLinea1 = '';
        $this->strLinea2 = '';
        $this->strLinea3 = '';
        $this->strLinea4 = '';
        $this->strLinea5 = '';
        $this->strIncluirMembrete = '';
        $this->strTipoLetraTabla = '';
        $this->intValorAbscisa = '';
        $this->arrDatosLinea2 = array();
        $this->arrCabecera = array();
        $this->arrAnchura = array();
        $this->arrAlineacion = array();
        $this->arrCabecera2 = array();
        $this->arrAnchura2 = array();
        $this->arrAlineacion2 = array();
        $this->arrCabecera3 = array();
        $this->arrAnchura3 = array();
        $this->arrAlineacion3 = array();
    }

    //Pie de página
    function Footer() {
       
        //Si se cumple la sentencia mostrar membrete en la hoja 
        if($this->strIncluirMembrete == 'SI' || $this->strIncluirMembrete == '')
        {
            $this->SetTextColor(0); //establece el color de texto
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont(TIPO_LETRA_PDF, LETRA_CURSIVA, TAMANO_LETRA_PIE_PAGINA_PDF);
            //Establecer el color de fondo para la línea
            $this->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
            $this->Line(10, 280, 200, 280); //dibuja una linea para separar la informacion del pie de pagina
            //Seleccionar la fecha en español
            setlocale(LC_ALL,"es_ES");
            //Asignar fecha actual Ejemplo: 09/08/2017
            $dteFecha=strftime("%d/%m/%Y");
            //Cadena concatenada con la fecha y hora actual (a se utiliza para 
            //antes del mediodía, despues del mediodía, am o pm (minúsculas))
            $dteFecha=$dteFecha.' '.date("h:i:s a");

            //Si existe usuario de creación (reporte individual)
            if($this->strUsuarioCreacion != '')
            {
                //Concatenar datos del pie de pagina
                $strPiePagina = 'IMPRESO: '.$dteFecha.'    CAPTURO: '.$this->strUsuarioCreacion;
                $strPiePagina .= '    FECHA DE CAPTURA: '.$this->dteFechaCreacion;
            }
            else //(reporte general)
            {   
                //Concatenar datos del pie de pagina
                $strPiePagina = 'Impresión: '.$dteFecha.'    Usuario: '.$this->strUsuario;
            }

            //se crea una cadena con acentos y tildes correctamente para colocarlo en el pie de pagina
            $this->Cell(0, 10, utf8_decode($strPiePagina), 0, 0, 'L'); //coloca el pie de pagina al lado izquierdo
            //Imprime el numero de paginas
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'R'); // el parametro {nb} es generado por una funcion llamada AliasNbPages 
            $this->AliasNbPages(); //funcion que calcula el numero de paginas
       }
    }

     //Encabezado
     function Header() {
        //Si se cumple la sentencia mostrar membrete en la hoja 
        if($this->strIncluirMembrete == 'SI' || $this->strIncluirMembrete == '')
        {
            $this->SetTextColor(0); //establece el color de texto
            //Se crea una instancia de la clase modelo (empresas) 
            $otdModelEmpresas = new  Empresas_model();

            //Se crea una instancia de la clase modelo (sucursales) 
            $otdModelSucursales = new Sucursales_model();

            //Seleccionar los datos de la empresa que coincide con el identificador 
            $otdEmpresa = $otdModelEmpresas->buscar();

            //Seleccionar los datos de la sucursal que coincide con el identificador 
            $otdSucursal = $otdModelSucursales->buscar($this->intSucursalID);

            //Inserta un Logo en la esquina superior izquierda
            $this->Image('assets/images/misc/logo.jpg', 10, 10, 45, 15);
            //Selecciona un nuevo tipo de fuente para el encabezado del documento
            $this->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
            //Asignar posición para escribir razón social
            $intPosY=$this->GetY();
            $intPosX = 57;
            $this->SetXY($intPosX,$intPosY);
            //Razón social de la empresa
            $this->MultiCell(0, 5,utf8_decode($otdEmpresa->razon_social), 0, 'L');
            $this->Ln(1);//Espacios entre lineas
            //Asignar posición para escribir nombre de la sucursal
            $intPosY=$this->GetY();
            $this->SetXY($intPosX,$intPosY);
            //Selecciona un nuevo tipo de fuente para el encabezado del documento
            $this->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
           
            //Nombre de la sucursal
            $this->MultiCell(0, 5,utf8_decode('SUC. '.$otdSucursal->nombre), 0, 'L');
            $this->Ln(1);//Espacios entre lineas
        }

        //Escribir la descripción del reporte en caso de que exista
        if($this->strLinea1 !='')
        {
            $this->Ln(10); //Espacios entre lineas
            //Selecciona un nuevo tipo de fuente para el encabezado del documento
            $this->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
            //Escribe la cadena concatenada con la descripción del reporte
            $this->MultiCell(0, 5,$this->strLinea1, 0, 'C');
        }
        
        //Escribir la segunda descripción del reporte en caso de que exista
        if($this->strLinea2 !='' OR $this->arrDatosLinea2 != NULL)
        {
            $this->Ln(1); //Espacios entre lineas
            //Si existen datos en el array correspondientes a la segunda línea
            if($this->arrDatosLinea2)
            {
                //Recorre el array de encabezados para crearlos
                for ($intCont = 0; $intCont < count($this->arrDatosLinea2); $intCont++)
                {
                    
                    //Escribe la cadena concatenada con la descripción del reporte
                    $this->MultiCell(0, 5, $this->arrDatosLinea2[$intCont], 0, 'L');
                }

            }
            else
            {
                //Escribe la cadena concatenada con la  segunda descripción del reporte
                $this->MultiCell(0, 5,$this->strLinea2, 0, 'C');
            }
           
        }

        //Escribir la tercera descripción del reporte en caso de que exista
        if($this->strLinea3 !='')
        {
            $this->Ln(1); //Espacios entre lineas
            //Escribe la cadena concatenada con la tercera descripción del reporte
            $this->MultiCell(0, 5,$this->strLinea3, 0, 'C');
        }

        //Escribir la cuarta descripción del reporte en caso de que exista
        if($this->strLinea4 !='')
        {
            $this->Ln(1); //Espacios entre lineas
            //Escribe la cadena concatenada con la cuarta descripción del reporte
            $this->MultiCell(0, 5,$this->strLinea4, 0, 'C');
        }

        //Escribir la quinta descripción del reporte en caso de que exista
        if($this->strLinea5 !='')
        {
            $this->Ln(1); //Espacios entre lineas
            //Escribe la cadena concatenada con la quinta descripción del reporte
            $this->MultiCell(0, 5,$this->strLinea5, 0, 'C');
        }

       
        $this->Ln(5); //Espacios entre lineas

        //Primer cabecera de la tabla
        //Asigna el tipo y tamaño de letra para la cabecera de la tabla
        $this->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        //Establecer el color de fondo para la cabecera
        $this->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        $this->SetTextColor(COLOR_TEXTO); //establece el color de texto
        $this->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        //Recorre el array de titulos de encabezado para crearlos
        for ($intCont = 0; $intCont < count($this->arrCabecera); $intCont++)
        {
            //inserta los titulos de la cabecera
            $this->Cell($this->arrAnchura[$intCont], 7, $this->arrCabecera[$intCont], 1, 0, 
                        $this->arrAlineacion[$intCont], TRUE);
        }//Cierre de for

        //Segunda cabecera de la tabla
        //Si existe segunda cabecera
        if($this->arrCabecera2)
        {
            $this->Ln(); //Deja un salto de línea
            //Recorre el array de titulos de encabezado para crearlos
            for ($intCont = 0; $intCont < count($this->arrCabecera2); $intCont++)
            {
                //inserta los titulos de la cabecera
                $this->Cell($this->arrAnchura2[$intCont], 7, $this->arrCabecera2[$intCont], 1, 0, 
                            $this->arrAlineacion2[$intCont], TRUE);
            }//Cierre de for

        }//Cierre de verificación de la cabecera

        //Si existe segunda cabecera
        if($this->arrCabecera3)
        {
            $this->Ln(); //Deja un salto de línea
            //Recorre el array de titulos de encabezado para crearlos
            for ($intCont = 0; $intCont < count($this->arrCabecera3); $intCont++)
            {
                //inserta los titulos de la cabecera
                $this->Cell($this->arrAnchura3[$intCont], 7, $this->arrCabecera3[$intCont], 1, 0, 
                            $this->arrAlineacion3[$intCont], TRUE);
            }//Cierre de for

        }//Cierre de verificación de la cabecera
       
        $this->SetTextColor(0);  //establece el color de texto negro
        $this->Ln(); //Deja un salto de linea
    }

    /** LOS SIGUIENTES METODOS SE ENCARGAN DE REALIZAR MARCA DE AGUA */
    var $angle=0;
    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,$x,$y,$w,$h);
        $this->Rotate(0);
    }

    /** LOS SIGUIENTES METODOS SE ENCARGAN DE REALIZAR UN AJUSTE RENGLON POR RENGLON DEL ANCHO DE COLUMNA Y SALTOS DE LINEAS */
    var $widths;
    var $aligns;

    function SetWidths($w) {
        //establece el ancho de las columnas
        $this->widths = $w;
    }
    
    
    
    function SetAligns($a) {
        //Establece el conjunto de alineaciones de columnas
        $this->aligns = $a;
    }

   //Función que se útiliza para crear la tabla para  los reportes  del sistema
    function Row($arrDatos, $arrAlineacion,  $strTipoCelda = NULL, 
                 $strCambiarTamLetra = NULL, $bolBorde = FALSE, $strTipoReporte = '') {
        /**
         * $arrDatos        Datos que se van a mostrar en la tabla
         * $arrAlineacion   Alineación de cada columna de datos en la tabla
         * $strTipoCelda    Tipo de celda
         * $bolBorde        Indica si se debe dibujar el borde de la celda
         * $strTipo         Tipo de reporte
         * $arrAlineacionTitulos   Alineación de cada título del encabezado de la tabla
         * $strCambiarTamLetra     Indica si se debe cambiar el tamaño de la letra
         */

        //Asignar la altura de la celda
        $h = 4;

        //Variable que se utiliza para asignar el tamaño de la letra
        $intTamLetra = TAMANO_LETRA_TITULO_TABLA_PDF;
        //Si se desea cambiar el tamaño de la letra (más pequeña)
        if($strCambiarTamLetra == 'SI')
        {
            $intTamLetra = TAMANO_LETRA_PIE_PAGINA_PDF;
        }


        //Calcular la altura de la fila
        $nb = 0;
        for ($i = 0; $i < count($arrDatos); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $arrDatos[$i]));

        //Si el tipo de celda es diferente de ClippedCell
        if($strTipoCelda != 'ClippedCell')
        {
            //Ajustar altura de la celda
            $h = $h * $nb;
        }
        
        //Emitir un salto de página en primer lugar si es necesario
        if ($this->CheckPageBreak($h) == TRUE) 
        {
            $this->Ln(1); //deja un espacio
        }

        $this->SetTextColor(0); //establecer el color de texto por defecto
        //Si el reporte tiene renglón con totales
        if($this->strTipoLetraTabla == 'Negrita')
        {
             //establece el tipo y tamaño de letra para la información de la tabla
              $this->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra); 
        }
        else
        {
              //establece el tipo y tamaño de letra para la información de la tabla
              $this->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra); 
        }


         //Si el reporte tiene renglón con totales
        if($this->intValorAbscisa != '')
        {
            //Cambiar valor de la abscisa
            $this->SetX($this->intValorAbscisa);
        }

       
        //Dibuja las celdas de la fila
        for ($i = 0; $i < count($arrDatos); $i++) {
            //Ancho de la columna
            $w = $this->widths[$i];
            //Alineación de la columna
            $a = $arrAlineacion[$i];


            //Guardar la posición actual
            $x = $this->GetX();
            $y = $this->GetY();

            //Asignar cadena de texto
            $strDato = $arrDatos[$i];
            //Si no existen detalles
            if($bolBorde)
            {
              //Dibuje la frontera (borde de la tabla)
              $this->Rect($x, $y, $w, $h);
            }

            //Asignar posición actual de la ordenada
            $intPosY = $this->GetY();

            //Si se cumple la sentencia
            if($this->strTipoLetraTabla != 'Negrita')
            {
                //Buscar palabra |Negrita -> para cambiar el volumen de la fuente a bold
                $strCoincidencia = strpos($strDato, '|Negrita');
            
                //Si no existe coincidencia
                if ($strCoincidencia === FALSE) 
                {
                     //establece el tipo y tamaño de letra para la información de la tabla
                     $this->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra); 
                }
                else
                {
                    //establece el tipo y tamaño de letra para la información de la tabla
                    $this->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra); 
                }

                //Reemplazar |Negrita  por cadena vacia
                $strDato =  str_replace ('|Negrita', '',  $strDato);
            }


            //Buscar palabra |VerificarNumero-> para cambiar el color del texto 
            $strCoincidenciaVerNumero = strpos($strDato, '|VerificarNumero');
            //Si no existe coincidencia
            if ($strCoincidenciaVerNumero === FALSE) 
            {
                $this->SetTextColor(0); //establecer el color de texto por defecto
            }
            else //Verificar valor númerico
            {

                //Reemplazar $  por cadena vacia
                $intCantidad = str_replace("$", "", $strDato);
                //Reemplazar $  por cadena vacia
                $intCantidad = str_replace(",", "", $intCantidad);

                //Si la cantidad es menor que cero
                if($intCantidad < 0)
                {
                    $this->SetTextColor(255,0,0); //establecer el color de texto rojo
                }

                //Reemplazar |VerificarNumero  por cadena vacia
                $strDato =  str_replace ('|VerificarNumero', '',  $strDato);
                
            }

           
            //Dependiendo del tipo de celda imprimir el texto
            if($strTipoCelda == 'ClippedCell')
            {
                //Hacer un llamado a la función para ajustar texto al tamaño de la celda
                //Nota: se utiliza esta función porque el texto no se muestra cuando el tipo de celda es ClippedCell
                //$this->drawTextBox($strDato, $w, 4, $a);
                $this->ClippedCell($w, 4, $strDato, 0, 0,  $a);
            }
            else
            {
                //Imprime el texto
                $this->MultiCell($w, 4,  $strDato, 0, $a);
            }
          
            //Pone la posición a la derecha de la celda
            $this->SetXY($x + $w, $y);

             
        }
        //Ir a la siguiente línea
        $this->Ln($h);

    }

    function CheckPageBreak($h) {
       
        //Si la altura h provocaría un desbordamiento, añadir una nueva página inmediatamente
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            
            $this->AddPage($this->CurOrientation,'','','','');
        
        
            return TRUE;
        }
    }

    function NbLines($w, $txt) {
        //Calcula el número de líneas de un MultiCell de la anchura w tomada
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                }
                else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }


     //***** Ajustar texto de la Celda (cell) *************
    //***********************************************************
    /**
     * Dibuja texto dentro de un cuadro definido por ancho = w, altura = h, y alinea
     * el texto verticalmente dentro del cuadro ($ valign = M / B / T para medio, inferior o superior)
     * También, alinea el texto horizontalmente ($ align = L / C / R / J para izquierda, centrado, derecha o justificado)
     * drawTextBox utiliza drawRows
     *
     */
    function drawTextBox($strText, $w, $h, $align='L', $valign='M', $border=FALSE)
    {
        $xi=$this->GetX();
        $yi=$this->GetY();
        
        $hrow=$this->FontSize;
        $textrows=$this->drawRows($w,$hrow,$strText,0,$align,0,0,0);
        $maxrows=floor($h/$this->FontSize);
        $rows=min($textrows,$maxrows);

        $dy=0;
        if (strtoupper($valign)=='M')
            $dy=($h-$rows*$this->FontSize)/2;
        if (strtoupper($valign)=='B')
            $dy=$h-$rows*$this->FontSize;

        $this->SetY($yi+$dy);
        $this->SetX($xi);

        $this->drawRows($w,$hrow,$strText,0,$align,FALSE,$rows,1);

        if ($border)
            $this->Rect($xi,$yi,$w,$h);
    }

    function drawRows($w, $h, $txt, $border=0, $align='J', $fill=FALSE, $maxline=0, $prn=0)
    {
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $b=0;
        if($border)
        {
            if($border==1)
            {
                $border='LTRB';
                $b='LRT';
                $b2='LR';
            }
            else
            {
                $b2='';
                if(is_int(strpos($border,'L')))
                    $b2.='L';
                if(is_int(strpos($border,'R')))
                    $b2.='R';
                $b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
            }
        }
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $ns=0;
        $nl=1;
        while($i<$nb)
        {
            //Obtener siguiente caracter
            $c=$s[$i];
            if($c=="\n")
            {
                //Salto de línea explícito
                if($this->ws>0)
                {
                    $this->ws=0;
                    if ($prn==1) $this->_out('0 Tw');
                }
                if ($prn==1) {
                    $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
                }
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border && $nl==2)
                    $b=$b2;
                if ( $maxline && $nl > $maxline )
                    return substr($s,$i);
                continue;
            }
            if($c==' ')
            {
                $sep=$i;
                $ls=$l;
                $ns++;
            }
            $l+=$cw[$c];
            if($l>$wmax)
            {
                //Salto de línea automático
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                    if($this->ws>0)
                    {
                        $this->ws=0;
                        if ($prn==1) $this->_out('0 Tw');
                    }
                    if ($prn==1) {
                        $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
                    }
                }
                else
                {
                    if($align=='J')
                    {
                        $this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                        if ($prn==1) $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                    }
                    if ($prn==1){
                        $this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
                    }
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border && $nl==2)
                    $b=$b2;
                if ( $maxline && $nl > $maxline )
                    return substr($s,$i);
            }
            else
                $i++;
        }
        //Última parte
        if($this->ws>0)
        {
            $this->ws=0;
            if ($prn==1) $this->_out('0 Tw');
        }
        if($border && is_int(strpos($border,'B')))
            $b.='B';
        if ($prn==1) {
            $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
        }
        $this->x=$this->lMargin;
        return $nl;
    }

    //************** Fin del código para ajustar texto *****************
    //******************************************************************

    //JUSTIFICAR WRITE HTML
    var $flowingBlockAttr;

    function saveFont()
    {

        $saved = array();

        $saved[ 'family' ] = $this->FontFamily;
        $saved[ 'style' ] = $this->FontStyle;
        $saved[ 'sizePt' ] = $this->FontSizePt;
        $saved[ 'size' ] = $this->FontSize;
        $saved[ 'curr' ] =& $this->CurrentFont;

        return $saved;

    }

    function restoreFont( $saved )
    {

        $this->FontFamily = $saved[ 'family' ];
        $this->FontStyle = $saved[ 'style' ];
        $this->FontSizePt = $saved[ 'sizePt' ];
        $this->FontSize = $saved[ 'size' ];
        $this->CurrentFont =& $saved[ 'curr' ];

        if( $this->page > 0)
            $this->_out( sprintf( 'BT /F%d %.2f Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );

    }

    function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 )
    {

        // cell width in points
        $this->flowingBlockAttr[ 'width' ] = $w * $this->k;

        // line height in user units
        $this->flowingBlockAttr[ 'height' ] = $h;

        $this->flowingBlockAttr[ 'lineCount' ] = 0;

        $this->flowingBlockAttr[ 'border' ] = $b;
        $this->flowingBlockAttr[ 'align' ] = $a;
        $this->flowingBlockAttr[ 'fill' ] = $f;

        $this->flowingBlockAttr[ 'font' ] = array();
        $this->flowingBlockAttr[ 'content' ] = array();
        $this->flowingBlockAttr[ 'contentWidth' ] = 0;

    }

    function finishFlowingBlock()
    {

        $maxWidth =& $this->flowingBlockAttr[ 'width' ];

        $lineHeight =& $this->flowingBlockAttr[ 'height' ];

        $border =& $this->flowingBlockAttr[ 'border' ];
        $align =& $this->flowingBlockAttr[ 'align' ];
        $fill =& $this->flowingBlockAttr[ 'fill' ];

        $content =& $this->flowingBlockAttr[ 'content' ];
        $font =& $this->flowingBlockAttr[ 'font' ];

        // set normal spacing
        $this->_out( sprintf( '%.3f Tw', 0 ) );

        // print out each chunk

        // the amount of space taken up so far in user units
        $usedWidth = 0;

        foreach ( $content as $k => $chunk )
        {

            $b = '';

            if ( is_int( strpos( $border, 'B' ) ) )
                $b .= 'B';

            if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
                $b .= 'L';

            if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
                $b .= 'R';

            $this->restoreFont( $font[ $k ] );

            // if it's the last chunk of this line, move to the next line after
            if ( $k == count( $content ) - 1 )
                $this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
            else
                $this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );

            $usedWidth += $this->GetStringWidth( $chunk );

        }

    }



     function WriteFlowingBlock( $s )
    {

        // width of all the content so far in points
        $contentWidth =& $this->flowingBlockAttr[ 'contentWidth' ];

        // cell width in points
        $maxWidth =& $this->flowingBlockAttr[ 'width' ];

        $lineCount =& $this->flowingBlockAttr[ 'lineCount' ];

        // line height in user units
        $lineHeight =& $this->flowingBlockAttr[ 'height' ];

        $border =& $this->flowingBlockAttr[ 'border' ];
        $align =& $this->flowingBlockAttr[ 'align' ];
        $fill =& $this->flowingBlockAttr[ 'fill' ];

        $content =& $this->flowingBlockAttr[ 'content' ];
        $font =& $this->flowingBlockAttr[ 'font' ];

        $font[] = $this->saveFont();
        $content[] = '';

        $currContent =& $content[ count( $content ) - 1 ];

        // where the line should be cutoff if it is to be justified
        $cutoffWidth = $contentWidth;

        // for every character in the string
        for ( $i = 0; $i < strlen( $s ); $i++ )
        {

            // extract the current character
            $c = $s{ $i };

            // get the width of the character in points
            $cw = $this->CurrentFont[ 'cw' ][ $c ] * ( $this->FontSizePt / 1000 );

            if ( $c == ' ' )
            {

                $currContent .= ' ';
                $cutoffWidth = $contentWidth;

                $contentWidth += $cw;

                continue;

            }

            // try adding another char
            if ( $contentWidth + $cw > $maxWidth )
            {

                // won't fit, output what we have
                $lineCount++;

                // contains any content that didn't make it into this print
                $savedContent = '';
                $savedFont = array();

                // first, cut off and save any partial words at the end of the string
                $words = explode( ' ', $currContent );

                // if it looks like we didn't finish any words for this chunk
                if ( count( $words ) == 1 )
                {

                    // save and crop off the content currently on the stack
                    $savedContent = array_pop( $content );
                    $savedFont = array_pop( $font );

                    // trim any trailing spaces off the last bit of content
                    $currContent =& $content[ count( $content ) - 1 ];

                    $currContent = rtrim( $currContent );

                }

                // otherwise, we need to find which bit to cut off
                else
                {

                    $lastContent = '';

                    for ( $w = 0; $w < count( $words ) - 1; $w++)
                        $lastContent .= "{$words[ $w ]} ";

                    $savedContent = $words[ count( $words ) - 1 ];
                    $savedFont = $this->saveFont();

                    // replace the current content with the cropped version
                    $currContent = rtrim( $lastContent );

                }

                // update $contentWidth and $cutoffWidth since they changed with cropping
                $contentWidth = 0;

                foreach ( $content as $k => $chunk )
                {

                    $this->restoreFont( $font[ $k ] );

                    $contentWidth += $this->GetStringWidth( $chunk ) * $this->k;

                }

                $cutoffWidth = $contentWidth;

                // if it's justified, we need to find the char spacing
                if( $align == 'J' )
                {

                    // count how many spaces there are in the entire content string
                    $numSpaces = 0;

                    foreach ( $content as $chunk )
                        $numSpaces += substr_count( $chunk, ' ' );

                    // if there's more than one space, find word spacing in points
                    if ( $numSpaces > 0 )
                        $this->ws = ( $maxWidth - $cutoffWidth ) / $numSpaces;
                    else
                        $this->ws = 0;

                    $this->_out( sprintf( '%.3f Tw', $this->ws ) );

                }

                // otherwise, we want normal spacing
                else
                    $this->_out( sprintf( '%.3f Tw', 0 ) );

                // print out each chunk
                $usedWidth = 0;

                foreach ( $content as $k => $chunk )
                {

                    $this->restoreFont( $font[ $k ] );

                    $stringWidth = $this->GetStringWidth( $chunk ) + ( $this->ws * substr_count( $chunk, ' ' ) / $this->k );

                    // determine which borders should be used
                    $b = '';

                    if ( $lineCount == 1 && is_int( strpos( $border, 'T' ) ) )
                        $b .= 'T';

                    if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
                        $b .= 'L';

                    if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
                        $b .= 'R';

                    // if it's the last chunk of this line, move to the next line after
                    if ( $k == count( $content ) - 1 )
                        $this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
                    else
                    {

                        $this->Cell( $stringWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 0, $align, $fill );
                        $this->x -= 2 * $this->cMargin;

                    }

                    $usedWidth += $stringWidth;

                }

                // move on to the next line, reset variables, tack on saved content and current char
                $this->restoreFont( $savedFont );

                $font = array( $savedFont );
                $content = array( $savedContent . $s{ $i } );

                $currContent =& $content[ 0 ];

                $contentWidth = $this->GetStringWidth( $currContent ) * $this->k;
                $cutoffWidth = $contentWidth;

            }

            // another character will fit, so add it on
            else
            {

                $contentWidth += $cw;
                $currContent .= $s{ $i };

            }

        }

    }

}

//fin de la clase
?>
