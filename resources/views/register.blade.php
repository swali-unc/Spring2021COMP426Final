@extends('masterbody')

@section('PageTitle','New Account Registration')

@section('PageContents')
<fieldset class="fsheader">
	{{ Form::open(['url'=>'/register','method'=>'post']) }}
	{{ Form::token() }}
	<table>
		<tr><td>Username:</td><td>{{ Form::text('username') }}</td></tr>
		<tr><td>Password:</td><td>{{ Form::password('password') }}</td></tr>
	</table>
	{{ Form::submit('Register!') }}
	{{ Form::close() }}
</fieldset>
<fieldset class="fsfooter">
</fieldset>
@endsection