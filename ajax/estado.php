<?php
require_once "../modelos/Estado.php";

$estado=new Estado();

switch ($_GET["op"]){

	case 'listar':
	$rspta=$estado->listar();
	//Vamos a declarar un array
	$data= array();

	while ($reg=$rspta->fetch_object()){
		$data[]=array(
      "0"=>$reg->nombre
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
