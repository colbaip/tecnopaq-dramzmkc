<?php 
    require_once("Models/Traits/TCategorias.php");
    require_once("Models/Traits/TProducto.php");
    require_once("Models/Traits/TTipoPago.php");
    require_once("Models/Traits/TCliente.php");

    class Carrito extends Controllers{
        use TCategoria, TProducto, TTipoPago, TCliente;
        public function __construct()
        {
            parent::__construct();
            session_start();
        }
        public function carrito()
        {
            //dep($this->selectProductos());
            //exit;
            $data['page_tag'] = NOMBRE_EMPRESA.' - Carrito';
            $data['page_title'] = NOMBRE_EMPRESA.' - Carrito';
            $data['page_name'] = 'carrito';
           $this->views->getView($this,"carrito", $data);
        }

        public function procesarpago()
        {
            if(empty($_SESSION['arrCarrito'])){
                header("Location: ".base_url());
                die();
            }
            // if(isset($_SESSION['login'])){
            //     $this->setDetalleTemp();
            // }
            // $infoOrden = $this->getPedido(3);
            // $dataEmailOrden = array('pedido' => $infoOrden);
            // $mail = getFile("Template/Email/confirmar_orden",$dataEmailOrden);
            // dep($mail);

            $data['page_tag'] = NOMBRE_EMPRESA.' - Procesar Pago';
            $data['page_title'] = NOMBRE_EMPRESA.' - Procesar Pago';
            $data['page_name'] = 'procesarpago';
            $data['tiposPago'] = $this->getTiposPagoT();
            // dep($data['tiposPago']);
            // exit;
            $this->views->getView($this,"procesarpago", $data);
        }

        // public function setDetalleTemp()
        // {
        //     $sid = session_id();
        //     $arrPedido = array('idcliente'=> $_SESSION['idUser'],
        //                         'idtransaccion'=> $sid,
        //                         'productos'=> $_SESSION['arrCarrito']
        //                       );
        //     $this->insertDetalleTemp($arrPedido);
        // }

    }
?>