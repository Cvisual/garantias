<?php
//inclusion de la base de datos
require "../config/Conexion.php";

Class estado
{
    //Implementamos nuestro constructor
    public function __construct()
    {


    }

	//Implementamos un metodo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM estado";
		return ejecutarConsulta($sql);
	}
  //Implementamos un metodo para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM estado";
		return ejecutarConsulta($sql);
	}
}


?>
