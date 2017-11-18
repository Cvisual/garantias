<?php
require_once "../modelos/Lugarrecepcion.php";

$lugarrecepcion=new Lugarrecepcion();

switch ($_GET["op"]){

	case 'listar':
	$rspta=$lugarrecepcion->listar();
	//Vamos a declarar un array
	$data= array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->idlugarrecepcion,
      "1"=>$reg->nombre,
      "2"=>$reg->telefono,
      "3"=>$reg->direccion
			);
		}
		$results = array(
			"sEcho"=>1,//Informacion para el datatables
			"iTotalRecords"=>count($data), //enviamos el total de registros al datatable
			"iTotalDispalyRecords"=>count($data), // enviamos el total de registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;
}


?>
