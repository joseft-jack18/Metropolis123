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
          <form id="agregar_producto">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Codigo</label>
                                <input type="text" class="form-control" id="txtcodigo" name="txtcodigo"><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control" id="txtdescripcion" name="txtdescripcion" placeholder="Ingrese la descripcion"><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Marca</label>
                                <input type="text" class="form-control" id="txtmarca" name="txtmarca" placeholder="Ingrese la marca"><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Tipo</label>
                                <select id="txttipo" name="txttipo" class="form-control">
                                    <option value="A">Accesorios</option>
                                    <option value="C">Cables de Luz</option>
                                    <option value="L">Luces y Flourescentes</option>
                                </select><br>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control" id="txtimg" name="txtimg" accept="image/*"><br>
                        <img src="../Admin/dist/img/box.png" width="255" id="imgproducto">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label for="">Precio Unitario</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input type="number" class="form-control" id="txtprecio" name="txtprecio" placeholder="0.00">
                </div>
            </div>
            <div class="col-lg-6">
                <label for="">Cantidad</label>
                <input type="number" class="form-control" id="txtcantidad" name="txtcantidad" placeholder="0"><br>
            </div>
            <div class="col-lg-12">
                <input name="boton" type="hidden" value="guardar">
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <br><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="LimpiarRegistro()"><i class="fa fa-times"></i> Cancelar</button>
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" class="form-control" id="txtecodigo"><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control" id="txtedescripcion" disabled><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Marca</label>
                                <input type="text" class="form-control" id="txtemarca" disabled><br>
                            </div><br>
                            <div class="col-lg-12">
                                <label for="">Tipo</label>
                                <input type="text" class="form-control" id="txtetipo" disabled><br>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Imagen</label>
                        <img src="../Admin/dist/img/box.png" width="255" id="imgeproducto">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label for="">Precio Unitario</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input type="number" class="form-control" id="txteprecio">
                </div>
            </div>
            <div class="col-lg-6">
                <label for="">Cantidad</label>
                <input type="number" class="form-control" id="txtecantidad"><br>
            </div>
      </div>
      <div class="modal-footer">
        <br><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" class="btn btn-success" onclick="ModificarProducto()"><i class="fa fa-check-square-o"></i> Editar</button>
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