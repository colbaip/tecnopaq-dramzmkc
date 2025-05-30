<?php 

	class Contactos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MCONTACTOS);
		}

		public function Contactos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Contactos";
			$data['page_title'] = "MENSAJE CONTACTO <small>Tienda Virtual</small>";
			$data['page_name'] = "contactos";
			$data['page_functions_js'] = "functions_contactos.js";
			$this->views->getView($this,"contactos",$data);
		}

		public function getContactos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectContactos();
                for ($i=0; $i < count($arrData) ; $i++) { 
                    $btnView = '';
                    if($_SESSION['permisosMod']['r']){
                            $btnView = '<button class="btn btn-info btn-sm modalViewMensaje" onClick="fntViewMensaje('.$arrData[$i]['idcontacto'].')" 
                                        title="Ver Mensaje"><i class="fas fa-eye"></i> </button>';
                    }
                    $arrData[$i]['opcion'] = '<div class="text-center">'.$btnView.'</div>';
                }
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getMensaje($idmensaje){

			if($_SESSION['permisosMod']['r']){
                $idmensaje = intval($idmensaje);
                if($idmensaje > 0 ) {
                    $arrData = $this->model->selectMensaje($idmensaje);

                    if(empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                    //dep($arrResponse);
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                    //dep($arrData);
                }
            }
            die();
		}

	}
?>