@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card-deck mb-3">
    <div class="col text-center" style="color:#EEEEEE; text-shadow:1px 1px 2px black; background-image:url(images/dinero.jpg); background-repeat:no-repeat; background-position:center center; background-size:cover; padding:10px;">
		<div class="row">
			<div class="col">Pesos:<br><b>$ {{$saldo->peso}}</b></div>
			<div class="col">Dólares:<br><b>u$s {{$saldo->dolar}}</b></div>
			<div class="col">Euros:<br><b>€ {{$saldo->euro}}</b></div>
		</div>
  	</div>
  </div>
  <div class="card-deck mb-3 text-center" style="margin-top:25px;">
    <div class="card mb-4 shadow-sm" style="height:240px; color:#FFFFFF; text-shadow:1px 1px 2px black; background-image:url({{asset('images/balance.jpg')}}); background-repeat:no-repeat; background-position:center center; background-size:cover;">
      <div class="card-body">
        <h3 class="card-title pricing-card-title">Balance</h3>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Mirá como vienen sus cuentas: Ingresos y Egresos</li>
        </ul>
          <a href="balance"><button type="button" class="btn btn-primary">Ver Situación Económica</button></a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm" style="height:240px; color:#FFFFFF; text-shadow:1px 1px 2px black; background-image:url({{asset('images/pago-de-servicios.jpg')}}); background-repeat:no-repeat; background-position:center center; background-size:cover;">
      <div class="card-body">
        <h3 class="card-title pricing-card-title">Pago de Servicios</h3>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Pagá todo lo que necesites desde la comodidad de tu casa</li>
        </ul>
          <a href="pago-de-servicios"><button type="button" class="btn btn-primary">Pagar Servicios</button></a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm" style="height:240px; color:#FFFFFF; text-shadow:1px 1px 2px black; background-image:url({{asset('images/inversiones.jpg')}}); background-repeat:no-repeat; background-position:center center; background-size:cover;">
      <div class="card-body">
        <h3 class="card-title pricing-card-title">Inversiones</h3>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Duplicá tus ahorros en el mercado financiero</li>
        </ul>
          <a href="inversiones"><button type="button" class="btn btn-primary">Invertir</button></a>
      </div>
    </div>
  </div>
</div>
@endsection