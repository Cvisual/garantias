<?php
//inclusion de la base de datos
require "../config/Conexion.php";

Class Mayorista {
    //Implementamos nuestro constructor
    public function __construct()
    {


    }

	//implementamos unmetodo para insertar registros
	public function insertar($nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario,$imagen,$idproducto,$cantidad,$garantia,$observaciones)
	{		
		$sql="INSERT INTO mayorista (nombre,tipo_documento,num_documento,telefono,direccion,email,fecha_recepcion,fecha_entrega,idlugarrecepcion,guia,idestado,idusuario,imagen)
		VALUES('$nombre','$tipo_documento','$num_documento','$telefono','$direccion','$email','$fecha_recepcion','$fecha_entrega','$idlugarrecepcion','$guia','$idestado','$idusuario','$imagen')";
		//return ejecutarConsulta($sql);
		//print_r($sql);
		$idmayoristanew=ejecutarConsulta_retornarID($sql);		

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idproducto)){
			$sql_detalle = "INSERT INTO detallemayorista(idmayorista,idproducto,cantidad,garantia,observaciones) VALUES ('$idmayoristanew','$idproducto[$num_elementos]','$cantidad[$num_elementos]','$garantia[$num_elementos]','$observaciones[$num_elementos]')";
			//Ejecutar consulta ($sql_detalle);
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;			
			//print_r($sql_detalle);
		}

		return $sw;		
	}

	public function editar ($idmayorista,$nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario){

		$sql="UPDATE mayorista SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',telefono='$telefono',direccion='$direccion',email='$email',fecha_recepcion='$fecha_recepcion',fecha_entrega='$fecha_entrega',idlugarrecepcion='$idlugarrecepcion',guia='$guia',idestado='$idestado',idusuario='$idusuario' WHERE idmayorista='$idmayorista'";		
		ejecutarConsulta($sql);
		//print_r($sql);
	}
	
	//Implementamos un metodo para anular registros
	public function eliminar($idmayorista){

		$sql="DELETE FROM mayorista WHERE idmayorista='$idmayorista'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un metodo para mostrar los datos de un registro a modificar
	public function mostrar($idmayorista){

		$sql="SELECT m.idmayorista, m.nombre, m.tipo_documento, m.num_documento, m.telefono, m.direccion, m.email, DATE(m.fecha_recepcion) as fechar, m.fecha_entrega, l.nombre as lrecepcion,  m.guia, e.idestado, e.nombre as estado, u.idusuario, u.nombre as usuario, m.imagen FROM mayorista m INNER JOIN lugarrecepcion l ON m.idlugarrecepcion=l.idlugarrecepcion INNER JOIN estado e ON m.idestado=e.idestado INNER JOIN usuario u ON m.idusuario=u.idusuario WHERE m.idmayorista='$idmayorista'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idmayorista){

		$sql="SELECT dm.idmayorista,p.idproducto,p.nombre,dm.cantidad,dm.garantia,dm.observaciones FROM detallemayorista dm INNER JOIN producto p ON dm.idproducto=p.idproducto where dm.idmayorista='$idmayorista'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un metodo para listar los registros
	public function listar(){

		$sql="SELECT m.idmayorista, m.nombre, m.tipo_documento, m.num_documento, m.telefono, m.direccion, m.email, DATE(m.fecha_recepcion) as fechar, m.fecha_entrega, l.nombre as lrecepcion,  m.guia, e.idestado, e.nombre as estado, u.idusuario, u.nombre as usuario, m.imagen FROM mayorista m INNER JOIN lugarrecepcion l ON m.idlugarrecepcion=l.idlugarrecepcion INNER JOIN estado e ON m.idestado=e.idestado INNER JOIN usuario u ON m.idusuario=u.idusuario ORDER BY m.idmayorista desc";
		return ejecutarConsulta($sql);
	}
}


?>
