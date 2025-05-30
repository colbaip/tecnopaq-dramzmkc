<?php 
    #require_once("CategoriasModel.php");

    class PaginasModel extends Mysql
    {
        private $intIdPagina;
        private $strTitulo;
        private $strContenido;
        private $intStatus;
        private $srtRuta;
        private $strImagen;

        public function __construct()
        {
           parent::__construct();
           #$this->objCategoria = new CategoriasModel();
        }

        public function selectPaginas(){
            $sql = "SELECT idpagina, titulo, DATE_FORMAT(datecreate,'%d/%m/%Y') as fecha, ruta, status
                    FROM pagina
                    WHERE status !=0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertPagina(string $titulo, string $contenido, string $portada, string $ruta, int $status){
            $this->strTitulo = $titulo;
            $this->strContenido = $contenido;
            $this->strImagen = $portada;
            $this->strRuta = $ruta;
            $this->intStatus = $status;
            $sql = "SELECT * FROM pagina WHERE ruta = '{$this->strRuta}'";
            $request = $this->select_all($sql);
            if(empty($request)){
                $query_insert  = "INSERT INTO pagina(titulo,
                                                    contenido,
                                                    portada,
                                                    ruta,
                                                    status) 
                                  VALUES(?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                $this->strContenido,
                                $this->strImagen,
                                $this->strRuta,
                                $this->intStatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = 0;
            }
            return $return;
        }
    

        public function updatePagina(int $idpagina, string $titulo, string $contenido, string $portada, int $status){

            $this->intIdPagina = $idpagina;
            $this->strTitulo = $titulo;
            $this->strContenido = $contenido;
            $this->strImagen = $portada;
            $this->intStatus = $status;

            $sql  = "UPDATE pagina SET titulo = ?, contenido = ?, portada = ?, status = ? WHERE idpagina = $this->intIdPagina ";
      
            $arrData = array(
                                    $this->strTitulo,
                                    $this->strContenido,
                                    $this->strImagen,
                                    $this->intStatus);
			
			$request = $this->update($sql,$arrData);
        	return $request;
        }


        public function deletePagina(int $idpagina){
            $this->intIdPagina = $idpagina;
            $sql = "UPDATE pagina SET status = ? WHERE idpagina = $this->intIdPagina ";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            return $request;
        }
    }

?>