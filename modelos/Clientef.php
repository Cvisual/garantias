<?php
//inclusion de la base de datos
require "../config/Conexion.php";

Class Clientef {
    //Implementamos nuestro constructor
    public function __construct()
    {


    }

	//implementamos unmetodo para insertar registros
	public function insertar($nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario,$imagen,$idproducto,$cantidad,$garantia,$observaciones)
	{		
		$sql="INSERT INTO clientefinal (nombre,tipo_documento,num_documento,telefono,direccion,email,fecha_recepcion,fecha_entrega,idlugarrecepcion,guia,idestado,idusuario,imagen)
		VALUES('$nombre','$tipo_documento','$num_documento','$telefono','$direccion','$email','$fecha_recepcion','$fecha_entrega','$idlugarrecepcion','$guia','$idestado','$idusuario','$imagen')";
		//return ejecutarConsulta($sql);
		//print_r($sql);
		$idclientefinalnew=ejecutarConsulta_retornarID($sql);		

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idproducto)){
			$sql_detalle = "INSERT INTO detalleclientef(idclientefinal,idproducto,cantidad,garantia,observaciones) VALUES ('$idclientefinalnew','$idproducto[$num_elementos]','$cantidad[$num_elementos]','$garantia[$num_elementos]','$observaciones[$num_elementos]')";
			//Ejecutar consulta ($sql_detalle);
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;			
			//print_r($sql_detalle);
		}

		return $sw;		
	}

	public function editar ($idclientefinal,$nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario,$imagen){

		$sql="UPDATE clientefinal SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',telefono='$telefono',direccion='$direccion',email='$email',fecha_recepcion='$fecha_recepcion',fecha_entrega='$fecha_entrega',idlugarrecepcion='$idlugarrecepcion',guia='$guia',idestado='$idestado',idusuario='$idusuario', imagen='$imagen' WHERE idclientefinal='$idclientefinal'";		
		ejecutarConsulta($sql);
		//print_r($sql);
	}
	
	//Implementamos un metodo para anular registros
	public function eliminar($idclientefinal){

		$sql="DELETE FROM clientefinal WHERE idclientefinal='$idclientefinal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un metodo para mostrar los datos de un registro a modificar
	public function mostrar($idclientefinal){

		$sql="SELECT m.idclientefinal, m.nombre, m.tipo_documento, m.num_documento, m.telefono, m.direccion, m.email, DATE(m.fecha_recepcion) as fechar, m.fecha_entrega, l.nombre as lrecepcion,  m.guia, e.idestado, e.nombre as estado, u.idusuario, u.nombre as usuario, m.imagen FROM clientefinal m INNER JOIN lugarrecepcion l ON m.idlugarrecepcion=l.idlugarrecepcion INNER JOIN estado e ON m.idestado=e.idestado INNER JOIN usuario u ON m.idusuario=u.idusuario WHERE m.idclientefinal='$idclientefinal'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idclientefinal){

		$sql="SELECT ds.idclientefinal,p.idproducto,p.nombre,ds.cantidad,ds.garantia,ds.observaciones FROM detalleserviciot ds INNER JOIN producto p ON ds.idproducto=p.idproducto where ds.iddetalleserviciot='$iddetalleserviciot'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un metodo para listar los registros
	public function listar(){

		$sql="SELECT m.idclientefinal, m.nombre, m.tipo_documento, m.num_documento, m.telefono, m.direccion, m.email, DATE(m.fecha_recepcion) as fechar, m.fecha_entrega, l.nombre as lrecepcion,  m.guia, e.idestado, e.nombre as estado, u.idusuario, u.nombre as usuario, m.imagen FROM clientefinal m INNER JOIN lugarrecepcion l ON m.idlugarrecepcion=l.idlugarrecepcion INNER JOIN estado e ON m.idestado=e.idestado INNER JOIN usuario u ON m.idusuario=u.idusuario ORDER BY m.idclientefinal desc";
		return ejecutarConsulta($sql);
	}
}


?>
