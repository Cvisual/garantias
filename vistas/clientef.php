<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])){
  header("Location: login.html");
}else {
require 'header.php';
if ($_SESSION['cliente final']==1)
{
?>
     <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"><button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive " id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensend table-hover ">
                          <thead>
                            <th>Opciones</th>
                            <th>Cliente</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Email</th>                            
                            <th>Fecha Recepcion</th>
                            <th>Fecha Entrega</th>
                            <th>Lugar de Recepcion</th>
                            <th>Estado</th>
                            <th>Guia</th>                          
                            <th>Usuario</th>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Cliente</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Email</th>                           
                            <th>Fecha Recepcion</th>
                            <th>Fecha Entrega</th>
                            <th>Lugar de Recepcion</th>
                            <th>Estado</th>
                            <th>Guia</th>                            
                            <th>Usuario</th>
                          </tfoot>
                        </table>
                    </div>
                   <!--formulario registro -->
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                      <div id="formContent">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                         
                          <h1 style="text-align: center;"><strong>FORMATO ÚNICO DE GARANTIA CLIENTE FINAL</strong></h1>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Cliente:</label>
                          <input type="hidden" name="idclientefinal" id="idclientefinal">
                          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre"  maxlength="100" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Tipo de documento:</label>
                          <select name="tipo_documento" id="tipo_documento" class="form-control"> 
                            <option value="">Seleccione una opcion</option>
                            <option value="Cedula">cedula</option>
                            <option value="Nit">Nit</option>
                            <option value="Rut">Rut</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Número de cedula:</label>
                          <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Número de cedula"  maxlength="20" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Teléfono:</label>
                          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono"  maxlength="20" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Dirección:</label>
                          <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion"  maxlength="50"required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Email:</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email"  maxlength="100"required>
                        </div>                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Fecha de Recepcion:</label>
                          <input type="date" class="form-control" name="fecha_recepcion" id="fecha_recepcion">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Fecha de Entrega:</label>
                          <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Lugar de Recepcion:</label>
                          <select name="idlugarrecepcion" id="idlugarrecepcion" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>                                                
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Estado:</label>
                          <select name="idestado" id="idestado" class="form-control selectpicker" data-live-search="true" required ></select>
                        </div>               
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" id="guiadiv"> 
                          <label>Guia:</label>
                          <input type="text" class="form-control" name="guia" id="guia">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <br>
                            <a data-toggle="modal" href="#myModal">           
                              <button id="agregarProducto" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Productos</button>
                            </a>
                          </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                          <table id="detalles" class="table table-striped table-bordered table-condensend table-hover">
                            <thead style="background-color:#34618F; color:#fff;">                              
                              <th class="col-lg-1">Opciones</th>
                              <th class="col-lg-3">Producto</th>
                              <th class="col-lg-1">Cantidad</th>
                              <th class="col-lg-1">Garantia</th>
                              <th class="col-lg-4">Observaciones</th>                              
                            </thead>                            
                            <tbody>                            
                            </tbody>
                          </table>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <label>Imagen:</label>
                          <input type="file" class="form-control" name="imagen" >
                          <input type="hidden" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuestra">
                        </div>                                                 
                        </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>  &nbsp; 
                            <button class="btn btn-danger" onclick="cancelarform()" type="button" id="cancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            &nbsp;
                            <button class="btn btn-success" type="button" id="imprimir"><i class="fa fa-print"></i> Imprimir</button>
                          </div>
                        </div>
                      </form>
                     
                    <!--Fin formulario registro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Producto</h4>
        </div>
        <div class="modal-body">
          <table id="tblproductos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>                
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
                <th>Nombre</th>                
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
  <?php
  }
  else
  {
    require 'noacceso.php';
  }
  require 'footer.php';
  ?>
  <script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
  <script type="text/javascript" src="scripts/clientef.js"></script>
  <?php
  }
  ob_end_flush();
  ?>
