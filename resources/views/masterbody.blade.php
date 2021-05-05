@extends('master')

@push('Stylesheets')
<link href="/css/main.css" rel="stylesheet" type="text/css">
@endpush

@section('Body')
<table class="maxwidth center centertext">
	<tr>
		<td>A.I. Tic-Tac-Toe</td>
	</tr>
</table>

<table class="maxwidth">
	<tr>
		<td><a href="/">Home</a></td>
		@if($IsLoggedIn)
		<td><a href="/logout">Logout</a></td>
		@else
		<td><a href="/login">Login</a></td>
		<td><a href="/register">Register</a></td>
		@endif
	</tr>
</table>
@yield('PageContents')
@endsection