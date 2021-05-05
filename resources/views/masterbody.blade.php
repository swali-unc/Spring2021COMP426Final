@extends('master')

@push('Stylesheets')
<link href="/css/main.css" rel="stylesheet" type="text/css">
@endpush

@section('Body')
<table class="maxwidth">
	<tr>
		<td><a href="/">Home</a></td>
		<td></td>
	</tr>
</table>
@yield('PageContents')
@endsection