<!DOCTYPE html>
<html>
<head>
	<title>{{ $name }}| Adegbulugbe Timilehin</title>
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/bootstrapv4/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/css/all.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/styles/app.css')}}">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
	 <div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			PortFolio
		</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav ml-auto">
		<!-- Authentication Links -->
		@guest
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
			</li>
			@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
			@endif
		@else
			<li class="nav-item">
				<a class="nav-link" href="{{url('/notes')}}">Notes</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{url('/contacts')}}">Contact</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{url('/meetings')}}">Meeting</a>
			</li> 
			<li class="nav-item dropdown">
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('logout') }}"
					onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
		@endguest
	      
	    </ul>
	  </div>
	  </div>
	</nav>