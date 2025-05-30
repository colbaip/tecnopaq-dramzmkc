<?php 
    class Nosotros extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            getPermisos(MPAGINAS);
        }
        public function nosotros()
        {
            $pageContent = getPageRout('nosotros');

            if(empty($pageContent)){
                header("Location: ".base_url());
            }else{
                $data['page_tag'] = NOMBRE_EMPRESA;
                $data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
                $data['page_name'] = $pageContent['titulo'];
                $data['page'] = $pageContent;
                // dep($data['page']);
                // die();
               $this->views->getView($this,"nosotros", $data);
            }
        }


    }
?>