<?php 

    class Login extends Controllers{
        public function __construct()
        {
            session_start();

            if(isset($_SESSION['login']))
            {
                header('Location: '.base_url().'/dashboard');
            }
            parent::__construct();
        }
        public function login()
        {
            $data['page_tag'] = "Login - Tienda Virtual";
            $data['page_title'] = "Login";
            $data['page_name'] = "login";
            $data['page_functions_js'] = "functions_login.js";
           $this->views->getView($this,"login", $data);
        }


        public function loginUser(){
            if($_POST){
                if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos' );

                }else{

                    $strUsuario = strtolower(strClean($_POST['txtEmail']));
                    $strPassword = hash("SHA256", $_POST['txtPassword']);
                    $requestUser = $this->model->loginUser($strUsuario,$strPassword);
                    if(empty($requestUser)){
                        $arrResponse = array('status' => false, 'msg'=>'El usuario o constraseña es incorrecto.');
                    }else{
                        $arrData = $requestUser;
                        if($arrData['status'] == 1){
                            $_SESSION['idUser'] = $arrData['idpersona'];
                            $_SESSION['login'] = true;
                            $_SESSION['timeout'] = true;
                            $_SESSION['inicio'] = time();

                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);

                            sessionUser($_SESSION['idUser']);

                            $arrResponse = array('status'=> true, 'msg' => 'ok');
                        }else{
                            $arrResponse = array('status' => false, 'msg'=> 'Usuario inactivo');
                        }   
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function resetPass(){
            if($_POST){
                if(empty($_POST['txtEmailReset'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos' );
                }else{
                    $token = token();
                    $strEmail = strtolower(strClean($_POST['txtEmailReset']));
                    $arrData = $this->model->getUserEmail($strEmail);

                    if(empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'El usuario no existe.');
                    }else{
                        $idpersona = $arrData['idpersona'];
                        $nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

                        $url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;

                        $requestUpdate = $this->model->setTokenUser($idpersona,$token);

                        $dataUsuario = array('nombreUsuario' => $nombreUsuario,
                                                'emil' => $strEmail,
                                                'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
                                                'url_recovery' => $url_recovery);
                        if($requestUpdate){
                            $sendEmail = sendEmail($dataUsuario,'email_cambioPassword');

                            if($sendEmail){

                                $arrResponse = array('status' => true,
                                                'msg' =>'Se envio Email de Reset a tu correo');
                                }else{
                                    $arrResponse = array('status' => false,
                                                    'msg' =>'No es posible el reset, intenta mas tarde');
                                }
                        }else{
                                    $arrResponse = array('status' => false,
                                                    'msg' =>'No es posible el reset, intenta mas tarde');
                        }

                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        public function confirmUser (string $params){

            if(empty($params)){
                header('Location: '.base_url());
            }else{
                $arrParams = explode(',',$params);
                $strEmail = strClean($arrParams[0]);
                $strToken = strClean($arrParams[1]);

                $arrResponse = $this->model->getUsuario($strEmail,$strToken);
                if(empty($arrResponse)){
                    header("Location: ".base_url());
                }else{

                    $data['page_tag'] = "Cambiar constraseña";
                    $data['page_title'] = "Cambiar contraseña"; 
                    $data['page_name'] = "cambiar_contrasenia";
                    $data['email'] = $strEmail;
                    $data['token'] = $strToken;
                    $data['idpersona']= $arrResponse['idpersona'];
                    $data['page_functions_js'] = "functions_login.js";
                   $this->views->getView($this,"cambiar_password", $data);
                }
            }
            die();
        }

        public function setPassword(){
             if(empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtEmail']) ||
                    empty($_POST['txtToken']) || empty($_POST['txtPasswordConfirm'])){

                    $arrResponse = array('status' => false,
                    'msg' => 'Error de datos' );

                }else{

                    $intIdpersona = intval($_POST['idUsuario']);
                    $strPassword = $_POST['txtPassword'];
                    $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                    $strEmail = strClean($_POST['txtEmail']);
                    $strToken = strClean($_POST['txtToken']);
                    
                    //$arrData = $this->model->getUserEmail($strEmail);

                    if($strPassword != $strPasswordConfirm){
                        $arrResponse = array('status' => false,
                        'msg' => 'Las contraseñas no coinciden.');
                    }else{
                        $arrResponseUser = $this->model->getUsuario($strEmail,$strToken);
                        if(empty($arrResponseUser)){
                            $arrResponse = array('status' => false,
                                            'msg' => 'Error de datos.');
                        }else{
                            $strPassword = hash("SHA256",$strPassword);
                            $requestPass = $this->model->insertPasswordNew($intIdpersona,$strPassword);
                            if($requestPass){
                            $arrResponse = array('status' => true,
                                                'msg' =>'Contraseña actualizada con exito');
                            }else{
                                $arrResponse = array('status' => false,
                                                'msg' =>'No es posible realizar el cambio, intenta mas tarde');
                            }

                        }

                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>