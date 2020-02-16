@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <table class="table table-hover">
    <thead>
    <tr>
    <th class="text-center">Empresa</th>
    <th class="text-center">Acciones</th>
    <th class="text-center">Valor de Acción</th>
    <th class="text-right">Compra-Venta de Acción</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($inversiones as $inversion)
      <tr>
      <td class="text-center">{{ $inversion->Empresa }}</td>
      <td class="text-center">{{ $inversion->Acciones }}</td>
      <td class="text-center">{{ $inversion->Valor }}</td>
      <td class="text-right"><input type="button" class="btn btn-primary" value="Comprar" title="Comprar {{$inversion->Empresa}}" onclick="abrirForm('Comprar', '{{$inversion->Empresa}}');"> <input type="button" class="btn btn-success" value="Vender" title="Vender {{$inversion->Empresa}}" onclick="abrirForm('Vender', '{{$inversion->Empresa}}');"></td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
  <div class="row" style="margin-top:100px;">
     <div class="col text-center alert alert-dark" role="alert">Pesos:<br><b>$ {{$saldo->peso}}</b></div>
     <div class="col text-center alert alert-dark" role="alert">Dólares:<br><b>u$s {{$saldo->dolar}}</b></div>
     <div class="col text-center alert alert-dark" role="alert">Euros:<br><b>€ {{$saldo->euro}}</b></div>
  </div>
  <!-- Modal Form -->
  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="modalFormLabel"></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
  <form>
  <div class="form-group">
  <label for="acciones">Acciones:</label>
  <input type="number" class="form-control" id="acciones" name="acciones" value="100" min="1" max="10000">
  <input type="hidden" id="operacion" name="operacion" value="">
  <input type="hidden" id="moneda" name="moneda" value="">
  </div>
  </form>
  <div id="message">&nbsp;</div>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" id="aceptarForm">Aceptar</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelarForm">Cancelar</button>
  </div>
  </div>
  </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
function abrirForm(operacion, moneda) {
  $('#operacion').val(operacion);
  $('#modalFormLabel').html("<p>" + operacion + ": <b>" + moneda + "</b></p>");
  $('#moneda').val(moneda);
  $("#aceptarForm").show();
  $("#cancelarForm").text("Cancelar");
  $('#modalForm').modal("show");
}

$("#aceptarForm").click(function() {
  var datos = {operacion:$("#operacion").val(), moneda:$("#moneda").val(), acciones:$("#acciones").val()};

  if ($("#operacion").val() == "Comprar") {
    var url = 'inversiones/comprar';
  } else {
    var url = 'inversiones/vender';
  }

  $.ajax({
    type:'POST',
    url:url,
    data:datos,
    success:function(data) {
      $("#message").html(data.message);
      $("#message").show();
      $("#aceptarForm").hide();
      $("#cancelarForm").text("Cerrar");
    }
  });
});

$("#cancelarForm").click(function() {
  $("#message").hide();
  $("#modalForm").modal("hide");
});
</script>
@endsection