<?php 

	class Paginas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MPAGINAS);
		}

		public function Paginas()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Paginas";
			$data['page_title'] = "PAGINAS SITIO WEB <small>Tienda Virtual</small>";
			$data['page_name'] = "Paginas";
			$data['page_functions_js'] = "functions_paginas.js";
			$this->views->getView($this,"paginas",$data);
		}

		public function getPaginas(){

			if($_SESSION['permisosMod']['r']){
               
                    $arrData = $this->model->selectPaginas();
					//  dep($arrData);
					//  exit;
					 for ($i=0; $i < count($arrData); $i++){
                        $btnView ='';
                        $btnEdit ='';
                        $btnDelete ='';
						$urlPage= base_url()."/".$arrData[$i]['ruta'];

                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<a class="btn btn-info btn-sm" href="'.$urlPage.'" target="_blanck" 
                                    title="Ver Pagina"><i class="fas fa-eye"></i> </a>';
                    }                  
                    if($_SESSION['permisosMod']['u']){
                                $btnEdit = '<a class="btn btn-info btn-sm" href="'.base_url().'/paginas/editar/'.$arrData[$i]['idpagina'].'" target="_blanck" 
                                    title="Editar Pagina"><i class="fas fa-pencil-alt"></i> </a>';
                    }
                    if($_SESSION['permisosMod']['d']){
                        
                                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelPagina('.$arrData[$i]['idpagina'].')"
                                    title="Eliminar Pagina"><i class="fas fa-trash-alt"></i> </button>';                  
                    }
                    $arrData[$i]['opcion'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                
            }
            die();
		}

		public function editar($idpagina)
        {
                //dep($_POST);
                //die();
				if(empty($_SESSION['permisosMod']['u'])){
					header("Location:".base_url().'/dashboard');
				}
			    $idpagina = intval($idpagina);
				if($idpagina > 0){
					$data['page_tag'] = "Actualizar Pagina";
					$data['page_title'] = "PAGINAS <small>Tienda Virtual</small>";
					$data['page_name'] = "actualizar-pagina";
					$data['page_functions_js'] = "functions_paginas.js";
					$infoPage = getInfoPage($idpagina);

					if(empty($infoPage)){
						header("Location:".base_url().'/paginas');
					}else{
						$data['infoPage'] = $infoPage;
					}
					$this->views->getView($this,"editarpagina",$data);

				}else{
					header("Location:".base_url().'/paginas');
				}
			die();
        }


		public function delPagina(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					//Eliminar de la DB
					$intIdPagina = intval($_POST['idPagina']);
					$requestDelete = $this->model->deletePagina($intIdPagina);
					if($requestDelete){
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la pagina');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la pagina');
					}
				
				    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
			}
			die();		
		}

		public function setPagina(){
			// if($_SESSION['permisosMod']['w']){

                //exit();
                if($_POST) {
					
					//dep($_POST);
					//dep($_FILES);
					
                    if(empty($_POST['txtTitulo']) || empty($_POST['txtContenido']) || empty($_POST['listEstado']) )
                    {
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    }else{
                        $intIdPagina = empty($_POST['idpagina']) ? 0 : intval($_POST['idpagina']);
                        $strTitulo =  strClean($_POST['txtTitulo']);
                        $strContenido = strClean($_POST['txtContenido']);
                        $intStatus = intval($_POST['listEstado']);
                        
                        $ruta = strtolower(clear_cadena($strTitulo));
                        $ruta = str_replace(" ","-",$ruta);

                        $foto           = $_FILES['foto'];
                        $nombre_foto    = $foto['name'];
                        $type           = $foto['type'];
                        $url_temp       = $foto['tmp_name'];
                        $imgPortada     = '';
						$request = "";
						

                        if($nombre_foto != ''){
                            $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
                        }

                        if($intIdPagina == 0)
                        {
                            //Crear
						
							$option = 1;
							$request = $this->model->insertPagina(	$strTitulo, 
																	$strContenido,
																	$imgPortada, 
																	$ruta,
																	$intStatus);
                        }else{
                            //Actualizar
							if($_SESSION['permisosMod']['u']){				
								if($nombre_foto == ''){
								    if($_POST['foto_actual'] != '' && $_POST['foto_remove'] == 0){
								        $imgPortada = $_POST['foto_actual'];
								    }
								}

								$request = $this->model->updatePagina($intIdPagina,$strTitulo, $strContenido,$imgPortada,$intStatus);
								$option = 2;
							}
                        }
                        if($request > 0 )
                        {
								if($option == 1)
								{
									 $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
									 if($nombre_foto !=''){ uploadImage($foto,$imgPortada); }

								}else{
									$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
        							if($nombre_foto !=''){ uploadImage($foto,$imgPortada); }
									if(($nombre_foto =='' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] !='') ||
									($nombre_foto != '' && $_POST['foto_actual'] != ''))
									{ 
										deleteFile($_POST['foto_actual']);
									}
								}
                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                // }
			}	
			die();
		}

		public function crear(){
			if(empty($_SESSION['permisosMod']['w'])){
				header("Location:".base_url().'/dashboard');
			}
	
			$data['page_tag'] = "Crear página";
			$data['page_title'] = "CREAR PÁGINA <small>Tienda Virtual</small>";
			$data['page_name'] = "crear-pagina";
			$data['page_functions_js'] = "functions_paginas.js";
			$this->views->getView($this,"crearpagina",$data);
		
			die();
		}
	
	
    }

?>