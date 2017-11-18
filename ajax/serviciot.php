<?php
if (strlen(session_id()) < 1)
	session_start();
require_once "../modelos/Serviciot.php";

$serviciot= new Serviciot();

$idserviciotecnico=isset($_POST["idserviciotecnico"])? limpiarCadena($_POST["idserviciotecnico"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$fecha_recepcion=isset($_POST["fecha_recepcion"])? limpiarCadena($_POST["fecha_recepcion"]):"";
$fecha_entrega=isset($_POST["fecha_entrega"])? limpiarCadena($_POST["fecha_entrega"]):"";
$idlugarrecepcion=isset($_POST["idlugarrecepcion"])? limpiarCadena($_POST["idlugarrecepcion"]):"";
$guia=isset($_POST["guia"])? limpiarCadena($_POST["guia"]):"";
$idestado=isset($_POST["idestado"])? limpiarCadena($_POST["idestado"]):"";
$idusuario=$_SESSION["idusuario"];
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':	

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagenes=$_POST["imagenactual"];
		}
		else{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' .end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/serviciotecnico/" . $imagen);
			}
		}			

		if(empty($idserviciotecnico)){
			$rspta=$serviciot->insertar($nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario,$imagen,$_POST["idproducto"],$_POST["cantidad"],$_POST["garantia"],$_POST["observaciones"]);

			echo $rspta ? "Caso servicio tecnico registrado" : "Caso servicio tecnico no se pudieron registrar todos los campos";
		}
		else{
			$rspta=$serviciot->editar($idserviciotecnico,$nombre,$tipo_documento,$num_documento,$telefono,$direccion,$email,$fecha_recepcion,$fecha_entrega,$idlugarrecepcion,$guia,$idestado,$idusuario);
			
			echo $rspta ? "Caso servicio tecnico actualizado" : "Caso servicio tecnico no se pudo actualizar todos los campos";		
		}
	break;

	case 'mostrar':
		$rspta=$serviciot->mostrar($idserviciotecnico);
		//Codificamos el resultado utilizando json
		echo json_encode($rspta);
	break;

	case 'eliminar':
		$rspta=$serviciot->eliminar($idserviciotecnico);
		//Codificamos el resultado utilizando json
		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $serviciot->listarDetalle($id);
		
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>             
                                    <th>Garantia</th>
                                    <th>Observaciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->garantia.'</td><td>'.$reg->observaciones.'</td></tr>';	
				}
		echo '<tfoot>
                <th></th>
                <th></th>
                <th></th> 
                <th></th>
                <th></th>                    
              </tfoot>';
	break;

	case 'listar':
	$rspta=$serviciot->listar();
	//Vamos a declarar un array
	$data= array();
	while ($reg=$rspta->fetch_object()){

		$data[]=array(
			"0"=>'<button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idserviciot.')"><i class="fa fa-pencil" aria-hidden="true"></i></button>'.' <button class="btn btn-danger btn-sm" onclick="eliminar('.$reg->idserviciot.')"><i class="fa fa-close"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->num_documento,
			"3"=>$reg->telefono,
			"4"=>$reg->direccion,
			"5"=>$reg->email,
			"6"=>$reg->fechar,
			"7"=>$reg->fecha_entrega,
			"8"=>$reg->lrecepcion,
			"9"=>$reg->estado,
			"10"=>$reg->guia,			
			"11"=>$reg->usuario
			);
		}
		$results = array(
			"sEcho"=>1,//Informacion para el datatables
			"iTotalRecords"=>count($data), //enviamos el total de registros al datatable
			"iTotalDispalyRecords"=>count($data), // enviamos el total de registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'selectLugar':
			require_once "../modelos/Lugarrecepcion.php";

			$lugarrecepcion = new Lugarrecepcion();
			$rspta = $lugarrecepcion->select();
			while ($reg = $rspta->fetch_object()){
							echo '<option value=' .$reg->idlugarrecepcion. '>' .$reg->nombre . '</option>';
						}
	break;

	case 'selectEstado':
			require_once "../modelos/Estado.php";

			$estado = new Estado();
			$rspta = $estado->select();
			while ($reg = $rspta->fetch_object()){
							echo '<option value=' .$reg->idestado. '>' .$reg->nombre . '</option>';
						}
	break;

	case 'listarProductos':
		require_once "../modelos/Producto.php";
		
		$producto=new Producto();

		$rspta=$producto->listarTodos();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idproducto.',\''.$reg->nombre.'\',)"><span class="fa fa-plus"></span></button>',
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
