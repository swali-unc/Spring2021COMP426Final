@extends('masterbody')

@section('PageTitle','Login')

@section('PageContents')
<fieldset class="fsheader">
	{{ Form::open(['url'=>'/login','method'=>'post']) }}
	{{ Form::token() }}
	<table>
		<tr><td>Username:</td><td>{{ Form::text('username') }}</td></tr>
		<tr><td>Password:</td><td>{{ Form::password('password') }}</td></tr>
	</table>
	{{ Form::submit('Login!') }}
	{{ Form::close() }}
</fieldset>
<fieldset class="fsfooter">
</fieldset>
@endsection