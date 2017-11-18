<?php

require 'header.php';

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Escritorio </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="small-box bg-aqua">
                              <div class="inner text-center">
                                <h4 style="font-size:17px;">
                                <!--  <strong>S/ <?php echo $totalc; ?></strong>-->
                                </h4>
                                <a  class="link" href="mayorista.php">
                                  <p id="titulo">Mayoristas</p>
                                <i class="fa fa-briefcase fa-5x iconos" aria-hidden="true"></i>
                                </a>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="mayorista.php" class="small-box-footer">Mayoristas  <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="small-box bg-green">
                              <div class="inner text-center">
                                <h4 style="font-size:17px;">
                                  <!--<strong>S/ <?php echo $totalv; ?></strong>-->
                                </h4>
                                <a class="link" href="serviciot.php">
                                  <p id="titulo">Servicio Técnico</p><i class="fa fa-cogs fa-5x iconos" aria-hidden="true"></i>
                                </a>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="serviciot.php" class="small-box-footer">Servicio Tecnico  <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="small-box bg-red">
                              <div class="inner text-center">
                                <h4 style="font-size:17px;">
                                  <!--<strong>S/ <?php echo $totalv; ?></strong>-->
                                </h4>
                                <a class="link" href="clientef.php">
                                  <p id="titulo">Cliente Final</p>
                                <i class="fa fa-user fa-5x iconos" aria-hidden="true"></i>
                                </a>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="clientef.php" class="small-box-footer">Cliente Final  <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
require 'footer.php';
?>
