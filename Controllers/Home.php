<?php 
    require_once("Models/Traits/TCategorias.php");
    require_once("Models/Traits/TProducto.php");

    class Home extends Controllers{
        use TCategoria, TProducto;
        public function __construct()
        {
            parent::__construct();
            session_start();
        }
        public function home()
        {
            //dep($this->selectProductos());
            //exit;
            $data['page_tag'] = NOMBRE_EMPRESA;
            $data['page_title'] = NOMBRE_EMPRESA;
            $data['page_name'] = NOMBRE_EMPRESA;
            $data['slider'] = $this->getCategoriasT(CAT_SLIDER);
            $data['banner'] = $this->getCategoriasT(CAT_BANNER);
            $data['productos'] = $this->getProductosT();
           $this->views->getView($this,"home", $data);
        }


    }
?>