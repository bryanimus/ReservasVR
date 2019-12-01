<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','Reservas')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{asset('js/app.js')}}" defer></script>
    <script src="{{asset('js/Scripts.js')}}" defer></script>

    @yield('styles')
</head>
<body>
	<div id="app" class="d-flex flex-column h-screen justify-content-between">
		<header>
			@include('partials.nav')
			@include('partials.session-status')
		</header>
		<main class="py-4">
			@yield('content')
		</main>
		<footer class="bg-white text-black-50 text-center py-3 shadow">
			{{ config('app.name') }} | Copyright @ {{ date('Y') }}
		</footer>
	</div>
	@yield('scripts')
</body>
</html>