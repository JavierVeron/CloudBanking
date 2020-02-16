@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form>
            <div class="form-group">
            <select class="form-control" id="nombre" name="nombre" required>
            @foreach ($servicios as $servicio)
            <option value="{{$servicio->Nombre}}">{{$servicio->Nombre}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="importe">Importe</label>
            <input type="number" class="form-control" id="importe" name="importe" min="1" required>
            </div>
            <div class="form-group">
            <input type="button" class="btn btn-primary" id="pagarServicio" value="Pagar Servicio">
            </div>
            </form>    
        </div>
    </div>
    <div class="row">
        <div class="col" id="message">&nbsp;</div>
    </div>
    <div class="row" style="margin-top:100px;">
        <div class="col text-center alert alert-dark" role="alert">Pesos:<br><b>$ {{$saldo->peso}}</b></div>
        <div class="col text-center alert alert-dark" role="alert">Dólares:<br><b>u$s {{$saldo->dolar}}</b></div>
        <div class="col text-center alert alert-dark" role="alert">Euros:<br><b>€ {{$saldo->euro}}</b></div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$("#pagarServicio").click(function() {
    if ($("#importe").val() <= 0) {
        $("#message").html("<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>Debe completar el campo Importe!</div>");
        return false;
    }

    $.ajax({
        type:'POST',
        url:'pago-de-servicios/pago',
        data:{nombre:$("#nombre").val(), importe:$("#importe").val()},
        success:function(data) {
          $("#message").html(data.message);
        }
    });
});
</script>
@endsection