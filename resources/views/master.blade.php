<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('PageTitle')</title>

        <!-- Styles -->
        @stack('Stylesheets')
        
        <!--  Additional Headers -->
		<script src="{{ URL::asset('/js/jquery-3.6.0.min.js') }}"></script>
		<script src="{{ URL::asset('/js/app.js') }}"></script>
		<script src="{{ URL::asset('/js/main.js') }}"></script>
        @stack('Headers')
        
        <!--  OnLoad -->
        <script>
		function OnLoadFunction() {
			@stack('OnLoadJS')
			ApplySmoothScrolling();
		}
		</script>
    </head>
    <body onload="OnLoadFunction();">
		<!-- Main body contents -->
    	@yield('Body')
    	<!--  End Main Body -->
    </body>
</html>
