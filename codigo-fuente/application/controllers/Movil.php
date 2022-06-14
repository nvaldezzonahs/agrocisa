<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movil extends CI_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de usuario
		$this->load->model('seguridad/usuarios_model', 'usuario');
		//Cargamos el modelo de procesos
		$this->load->model('seguridad/procesos_model', 'procesos');
	}

	//Método principal del controlador.
	public function index()
	{	
		//Comprobando variable de sesión
		if ($this->agent->is_mobile())
		{
			//Si el usuario ha iniciado sesión
			if ($this->session->userdata('usuario_id'))
			{
				$arrDatos['strTitulo'] = TITULO_NAVEGADOR;
				$arrDatos['strPermisos'] = '';
				$arrDatos['strProcesoMenuID'] = '';
				$this->load->view("movil/header", $arrDatos); //Carga la cabecera de la pagina
				$this->load->view("pages/contabilidad/vigencia_certificado"); //Carga la vista vigencia del certificado
				$this->load->view("movil/nav"); //Carga el menu de la pagina
				$this->load->view("pages/footer"); //Carga pie de pagina
			}
			else
			{
				//Redireccionar a la página login
				redirect('login', 'refresh');
			}
		}
		else
		{
			//Cargar vista del escritorio 
			redirect('desktop', 'refresh');
		}
	}

	//Método para asignar id de la sucursal seleccionada a la variable de sesión sucursal_id
	public function set_sucursal()
	{
		//Variable que se utiliza para asignar el id de la surcursal 
		$intSucursalID = $this->input->post('intSucursalID');
		//Asignar el id de la sucursal como variable de sesión
		$this->session->set_userdata('sucursal_id', $intSucursalID);
	}

	//Método para regresar id de la sucursal seleccionada
	public function get_sucursal()
	{
		//Asignar el id de la sucursal como variable de sesión
		echo $this->session->userdata('sucursal_id');
	}

	//Función para cargar el menú que le corresponde al usuario
	public function get_menu()
	{
		//Seleccionar los permisos de acceso que tiene el usuario en la sucursal seleccionada
		$otdPermisos = $this->usuario->get_permisos($this->session->userdata('usuario_id'), $this->session->userdata('sucursal_id'));
		if ($otdPermisos)
		{
			//Separar los ID de los subprocesos a los que tiene acceso el usuario y guardarlos en un arreglo
			$arrPermisos = explode('|', $otdPermisos->permisos);
			//Obtener arreglo con el menú
			$arrMenu = $this->cargar_menu(0, $arrPermisos);
			//Variable para guardar el nombre del módulo que se está imprimiendo
			$strModulo = "";
			//Variable para guardar el nivel del menú
			$strNivel = "";
			//Recorrer las opciones del menú para imprimirlas
			foreach ($arrMenu as $rowMenu)
			{
				//Asigna el nombre del módulo cuando el proceso no tenga padre
				if ($rowMenu["PadreID"] == 0)
				{
					$strModulo = $rowMenu["Descripcion"];
				}
				//Si se cambia de nivel en el menú, cerrar las etiquetas correspondientes
				if (($strNivel <> "") && ($strNivel <> $rowMenu["MenuNivel"]))
				{
					//Se toma el valor del último nivel que no tuvo hijos (NIVEL 1, NIVEL 2, ..., NIVEL X)
					$intNivAnt = substr($strNivel, 6) + 0;
					//Se toma el valor del nivel actual
					$intNivAct = substr($rowMenu["MenuNivel"], 6) + 0;
					//Se cierran las etiquetas necesarias según el número de niveles que se haya descendido
					for ($intCon=$intNivAct; $intCon < $intNivAnt; $intCon++)
					{
						echo '</ul></li>';
					}
					//Reiniciamos el nivel
					$strNivel = "";
				}
				//Si el proceso tiene hijos, no es una pantalla de trabajo, se abre la opción del menú
				if ($rowMenu["Hijos"] > 0)
				{
					echo '<li>
							<a href="#" >'.$rowMenu["Descripcion"].'</a>
							<ul class="dl-submenu">';
				}
				else
				{
					//Separar el módulo del proceso para asignarlo como sufijo
					list($strMod, $strCon) = explode("/", $rowMenu["RutaAcceso"]);
					//Asignamos en una variable los parámetros que necesitamos para manejar los permisos del usuario
					//Titulo del modal
					$strParametros = $rowMenu["Descripcion"].'-'.$strModulo.'||';
					//Sufijo para asignar el nombre al contenedor de los permisos
					$strParametros.= strtolower($strCon.'_'.$strMod).'||';
					//Permisos del usuario
					$strParametros.= $rowMenu["Permisos"].'||';
				    //ID del proceso
					$strParametros.=  $rowMenu["ProcesoID"];
					$strParametros = $this->encrypt->encode($strParametros);
					$strParametros = str_replace(array('+', '/', '='), array('-', '_', '~'), $strParametros);
					$strParametros = $rowMenu["RutaAcceso"].'/index/'.$strParametros;
					//Si es una pantalla de trabajo, se asignan las variables necesarias así como el nivel donde se encontró
					echo '<li>
							<a id="'.str_replace(' ', '', $rowMenu["ProcesoID"]).'" 
							   class="MenuAccess"
							   href="'.$strParametros.'" >'.$rowMenu["Descripcion"].'
							</a>
						  </li>';
					//Asignamos el nivel en el que se encuentra la pantalla de trabajo
					$strNivel = $rowMenu["MenuNivel"];
				}
			}
			//Si quedaron niveles abiertos, se cierran
			if ($strNivel <> "")
			{
				//Se toma el valor del último nivel que no tuvo hijos (NIVEL 1, NIVEL 2, ..., NIVEL X)
				$intNivAnt = substr($strNivel, 6) + 0;
				//Se toma el valor del nivel actual
				$intNivAct = substr($rowMenu["MenuNivel"], 6) + 0;
				//Se cierran las etiquetas necesarias según el número de niveles que se haya descendido
				for ($intCon=$intNivAct; $intCon < $intNivAnt; $intCon++)
				{
					echo '</ul></li>';
				}
			}
		}
	}

	//Función para cargar el menú que le corresponde al usuario
	public function cargar_menu($intProcesoID, $arrPermisos, $arrMenu = NULL)
	{
		//Definimos el arreglo que nos servirá para agregar las opciones del menú
		$arrTemp = array("ProcesoID"=>0,
						 "PadreID"=>0,
						 "Descripcion"=>'',
						 "RutaAcceso"=>'',
						 "MenuNivel"=>'',
						 "Permisos"=>'',
						 "Hijos"=>0);
		//Seleccionar los procesos hijos del proceso enviado
		$otdProcesos = $this->procesos->get_procesos_hijos($intProcesoID);
		//Recorrer los procesos hijos
		foreach ($otdProcesos as $rowPro)
		{
			//Obtener los subprocesos registrados para el proceso
			$objSubprocesos = $this->procesos->get_subprocesos($rowPro->proceso_id);
			//Variable para concatenar los subprocesos a los que se tiene acceso
			$strPermisos = '';
			foreach ($objSubprocesos as $rowSub)
			{
				//Si el subproceso se encuentra en los permisos del usuario
				if (in_array($rowSub->subproceso_id, $arrPermisos))
				{
					//Si es la primera vez que entra, se actualizan los datos del arreglo
					if ($strPermisos == '')
					{
						$arrTemp["ProcesoID"] = $rowPro->proceso_id;
						$arrTemp["PadreID"] = $intProcesoID;
						$arrTemp["Descripcion"] = $rowPro->descripcion;
						$arrTemp["RutaAcceso"] = $rowPro->ruta_acceso;
						$arrTemp["MenuNivel"] = $rowPro->menu_nivel;
						$arrTemp["Hijos"] = $rowPro->hijos;
					}
					//Se concatena el permiso a la variable
					$strPermisos.= $rowSub->funcion."|";
				}
			}

			//Si el usuario tiene al menos un permiso de acceso, se agrega el menú
			if ($strPermisos <> '')
			{
				//Quitar el último simbolo concatenado |
				$strPermisos = substr($strPermisos, 0, -1);
				//Asignar los permisos al arreglo
				$arrTemp["Permisos"] = $strPermisos;
				//Agregar el arreglo al menú
				$arrMenu[] = $arrTemp;
			}
			$arrMenu = $this->cargar_menu($rowPro->proceso_id, $arrPermisos, $arrMenu);
		}
		return $arrMenu;
	}
}