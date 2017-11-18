<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Producto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO producto (nombre)
		VALUES ('$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idproducto,$nombre)
	{
		$sql="UPDATE producto SET nombre='$nombre'WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproducto)
	{
		$sql="SELECT * FROM producto WHERE idproducto='$idproducto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM producto";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros
	public function listarTodos()
	{
		$sql="SELECT * FROM producto";
		return ejecutarConsulta($sql);		
	}

}

?>