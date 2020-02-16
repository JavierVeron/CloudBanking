@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
    <form>
    <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value='{{$usuario["name"]}}' required>
    </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" value='{{$usuario["email"]}}' required>
    </div>
    <div class="form-group">
    <label for="contrasena">Contraseña</label>
    <input type="password" class="form-control" id="contrasena" name="contrasena">
    </div>
    <div class="form-group">
    <label for="confirmar_contrasena">Confirmar Contraseña</label>
    <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena">
    </div>
    <div class="form-group">
    <input type="button" class="btn btn-primary" id="actualizarDatos" value="Actualizar Datos">
    </div>
    <div class="form-group" style="margin-top:50px;">
    <a href="#" id="eliminarUsuario" style="color:#000000; text-decoration:none;"><img src="{{asset('icons/trash.svg')}}" alt="Eliminar Usuario" width="32" height="32"> Eliminar Usuario</a>
    </div>
    </form>    
    </div>
  </div>
  <div class="row">
    <div class="col" id="message">&nbsp;</div>
  </div>
  <!-- Modal Form -->
  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="modalFormLabel">Eliminar Usuario</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
  <p>¿Está seguro que desea eliminar su Usuario?<br>(Esta acción no se puede deshacer).</p>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" id="aceptarForm">Aceptar</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
  </div>
  </div>
  </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$("#actualizarDatos").click(function() {
    if ($("#nombre").val() == "") {
        $("#message").html("<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>Debe completar el campo Nombre!</div>");
        return false;
    }

    if ($("#email").val() == "") {
        $("#message").html("<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>Debe completar el campo Email!</div>");
        return false;
    }

    if ($("#contrasena").val() != $("#confirmar_contrasena").val()) {
        $("#message").html("<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>Las Contraseñas ingresadas no coinciden!</div>");
        return false;
    }

    if ($("#contrasena").val() == "") {
      var datos = {nombre:$("#nombre").val(), email:$("#email").val(), id:{{$usuario["id"]}}};
    } else {
      var datos = {nombre:$("#nombre").val(), email:$("#email").val(), password:$("#contrasena").val(), id:{{$usuario["id"]}}};
    }

    $.ajax({
        type:'POST',
        url:'actualizarUsuario',
        data:datos,
        success:function(data){
          $("#message").html("<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>" + data.message + "</div>");
        }
    });
});

$("#eliminarUsuario").click(function() {
  $('#modalForm').modal("show");
});

$("#aceptarForm").click(function() {
  $.ajax({
    type:'POST',
    url:'eliminarUsuario/{{$usuario["id"]}}',
    data:{},
    success:function(data) {
      $("#message").html("<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>" + data.message + "</div>");
      $('#modalForm').modal("hide");
    }
  });
});
</script>
@endsection