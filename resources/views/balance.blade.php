@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <table class="table table-hover">
        <thead>
        <tr>
        <th class="text-center">Fecha</th>
        <th class="text-center">Descripción</th>
        <th class="text-center">Importe</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($balance as $item)
          <tr>
          <td class="text-center">{{date('d-m-Y', strtotime($item->Fecha))}}</td> 
          <td class="text-left">{{$item->Desc}}</td>
          <td class="text-center">{{$item->Importe}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="row" style="margin-top:50px;">
      <div class="col text-center alert alert-secondary" role="alert"><b>Cuentas - Saldos Totales</b></div>
    </div>
    <div class="row">
       <div class="col text-center alert alert-dark" role="alert">Pesos:<br><b>$ {{$saldo->peso}}</b></div>
       <div class="col text-center alert alert-dark" role="alert">Dólares:<br><b>u$s {{$saldo->dolar}}</b></div>
       <div class="col text-center alert alert-dark" role="alert">Euros:<br><b>€ {{$saldo->euro}}</b></div>
    </div>
</div>
@endsection