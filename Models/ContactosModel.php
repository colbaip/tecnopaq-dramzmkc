<?php 

class ContactosModel extends Mysql{

	public function selectContactos()
	{
		$sql = "SELECT idcontacto, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
				FROM contacto ORDER BY idcontacto DESC";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensaje(int $idmensaje)
	{
		$sql = "SELECT idcontacto, nombre, email, mensaje, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
				FROM contacto WHERE idcontacto = {$idmensaje}";
		$request = $this->select_all($sql);
		return $request;
	}


}
 ?>