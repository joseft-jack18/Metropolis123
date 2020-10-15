<!--importamos el js/producto.js -->
<script type="text/javascript" src="../js/producto.js?rev=<?php echo time();?>"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Productos
        <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Productos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingrese el dato a buscar">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2">
                            <button class="btn btn-success" style="width: 100%;" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i> Nuevo Producto</button>
                        </div>
                    </div>
                    <br><br>
                    <table id="tabla_productos" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Foto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Foto</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- modal Agregar -->
<div class="modal fade" id="modal_registro" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Registro de Productos</h3>        
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <label for="">ID Usuario</label>
            <input type="text" class="form-control" id="txtid" value="0" disabled>
        </div><br>
        <div class="col-lg-12">
            <label for="">Nombres Completos</label>
            <input type="text" class="form-control" id="txtnombres" placeholder="Ingrese sus nombres completos">
        </div><br>
      </div>
      <div class="modal-footer">
        <br><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" class="btn btn-success" onclick="RegistrarProducto()"><i class="fa fa-check-square-o"></i> Guardar</button>
      </div><br>
    </div>
  </div>
</div>
<!-- /.modal Agregar -->

<!-- modal Editar -->
<div class="modal fade" id="modal_editar" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Editar Usuario</h3>        
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <input type="hidden" class="form-control" id="txteid">
            <label for="">Nombres Completos</label>
            <input type="text" class="form-control" id="txtenombres" disabled>
        </div><br>
        <div class="col-lg-12">
            <label for="">Correo Electronico</label>
            <input type="email" class="form-control" id="txteemail">
        </div><br>
        <div class="col-lg-12">
            <label for="">Direccion</label>
            <input type="text" class="form-control" id="txtedireccion"><br>        
        </div>
      </div>
      <div class="modal-footer">
        <br><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" class="btn btn-success" onclick="ModificarUsuario()"><i class="fa fa-check-square-o"></i> Editar</button>
      </div><br>
    </div>
  </div>
</div>
<!-- /.modal Editar -->

<script>
    $(document).ready(function() {
        //$('#example').DataTable();
        ListarProductos();
    });
</script>