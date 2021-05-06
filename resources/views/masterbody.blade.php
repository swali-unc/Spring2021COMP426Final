@extends('master')

@push('Stylesheets')
<link href="/css/main.css" rel="stylesheet" type="text/css">
<link href="/css/jquery-ui.min.css" rel='stylesheet' type='text/css'>
@endpush

@push('Headers')
<script src="/js/jquery-ui.min.js"></script>
@endpush

@section('Body')
<table id="topbanner" class="maxwidth center centertext">
	<tr>
		<td id="webbanner" class="centertext center maxwidth">A.I. Tic-Tac-Toe</td>
	</tr>
</table>
@if(!empty($errormsg))
<table class="maxwidth center centertext">
	<tr>
		<td class="centertext center maxwidth alert">{{ $errormsg }}</td>
	</tr>
</table>
@endif
<table class="maxwidth center centertext evenwidth">
	<tr>
		<td class="center centertext"><a href="/">Home</a></td>
		@if($IsLoggedIn)
		<td class="center centertext"><a href="/logout">Logout</a></td>
		<td class="center centertext"><a href="/play">Play</a></td></td>
		@else
		<td class="center centertext"><a href="/login">Login</a></td>
		<td class="center centertext"><a href="/register">Register</a></td>
		@endif
		<td class="center centertext"><a href="/score">High Scores</a></td>
		@if($IsLoggedIn)
		<td class="center centertext">Logged in as: {{ $username }}
		@endif
	</tr>
</table>
<table id="maintable">
	<tr>
	<td>
@yield('PageContents')
	</td>
	</tr>
</table>
@endsection