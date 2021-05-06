<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Prevent cache as pages dynamically change  -->
        <meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="cache-control" content="no-store" />
		<meta http-equiv="cache-control" content="must-revalidate" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

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
