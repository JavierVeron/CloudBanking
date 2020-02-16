<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Cloud Banking - {{$jumboTitle}}</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#444444;">
	<div class="collapse navbar-collapse">
		<a class="navbar-brand" href="{{route('index')}}" title="Cloud Banking"><img src="{{asset('icons/cloud-fill.svg')}}" alt="Cloud Banking" width="32" height="32"> Cloud Banking</a>
		<ul class="navbar-nav mr-auto">
		<li class="nav-item {{Request::is('index') ? 'active' : ''}}"><a class="nav-link" href="{{route('index')}}">Home</a></li>
		<li class="nav-item {{Request::is('balance') ? 'active' : ''}}"><a class="nav-link" href="{{route('balance')}}">Balance</a></li>
		<li class="nav-item {{Request::is('pago-de-servicios') ? 'active' : ''}}"><a class="nav-link" href="{{route('pago-de-servicios')}}">Pago de Servicios</a></li>
		<li class="nav-item {{Request::is('inversiones') ? 'active' : ''}}"><a class="nav-link" href="{{route('inversiones')}}">Inversiones</a></li>
		</ul>
	</div>
	<form method="post" action="{{route('logout')}}">
		<?php
		use Illuminate\Support\Facades\Auth;

		$user = Auth::user();
		?>
		<p style="color:#FFFFFF;"><a href="{{route('user')}}" title="Datos del Usuario" style="color:#FFFFFF; text-decoration:none;"><img src="{{asset('icons/person-fill.svg')}}" alt="Datos del Usuario" width="32" height="32"> Hola, <b>{{$user["name"]}}</b></a> <input type="submit" class="btn btn-danger" value="Cerrar Sesión" title="Cierra la Sesión actual" style="margin-left:20px;"></p>
	</form>
</nav>
</header>
<div class="jumbotron jumbotron-fluid">
   <div class="container">
       <h1 class="display-4">{{$jumboTitle}}</h1>
       <p class="lead">{{$jumboDesc}}</p>
   </div>
</div>
@yield('content')
<footer style="padding-top:120px;">
<div style="background-color:#EFEFEF; padding:20px;">
<div class="container">
<div class="row">
<div class="col-sm text-left"><img src="{{asset('icons/cloud-fill.svg')}}" alt="Cloud Banking" width="32" height="32" title="Cloud Banking"> Cloud Banking</a> | ¿CÓMO SUMAR PUNTOS? </div>
<div class="col-sm text-right"><img src="{{asset('images/facebook.png')}}" alt="Facebook" width="24" height="24" title="Facebook"> <img src="{{asset('images/instagram.png')}}" alt="Instagram" width="24" height="24" title="Instagram"> <img src="{{asset('images/twitter.png')}}" alt="Twitter" width="24" height="24" title="Twitter"> <img src="{{asset('images/youtube.png')}}" alt="YouTube" width="24" height="24" title="YouTube"></div>
</div>
</div>
</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>