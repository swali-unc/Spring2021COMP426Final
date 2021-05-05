@extends('master')

@push('Stylesheets')
<link href="/css/main.css" rel="stylesheet" type="text/css">
@endpush

@section('Body')
<table id="topbanner" class="maxwidth center centertext">
	<tr>
		<td id="webbanner" class="centertext center maxwidth">A.I. Tic-Tac-Toe</td>
	</tr>
</table>

<table class="maxwidth center centertext">
	<tr>
		<td class="center centertext"><a href="/">Home</a></td>
		@if($IsLoggedIn)
		<td class="center centertext"><a href="/logout">Logout</a></td>
		@else
		<td class="center centertext"><a href="/login">Login</a></td>
		<td class="center centertext"><a href="/register">Register</a></td>
		@endif
	</tr>
</table>
@yield('PageContents')
@endsection