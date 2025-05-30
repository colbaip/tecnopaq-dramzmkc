<?php 
	class Prueba extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			getPermisos(MPAGINAS);
		}

		public function servicios()
		{
			$pageContent = getPageRout('prueba');
			if(empty($pageContent)){
				header("Location: ".base_url());
			}else{
				$data['page_tag'] = NOMBRE_EMPRESA;
				$data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
				$data['page_name'] = $pageContent['titulo'];
				$data['page'] = $pageContent;
				$this->views->getView($this,"prueba",$data);  
			}
		}

	}
 ?>