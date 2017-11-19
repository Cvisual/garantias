  <?php 
require_once "../modelos/Producto.php";

$producto = new Producto();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	
		if (empty($idproducto)){
			$rspta=$producto->insertar($nombre);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$producto->editar($idproducto,$nombre);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;


	case 'mostrar':
		$rspta=$producto->mostrar($idproducto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$producto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-info btn-sm" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil" aria-hidden="true"></i></button>',
 				"1"=>$reg->nombre
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>