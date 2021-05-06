@extends('masterbody')

@section('PageTitle','New Account Registration')

@section('PageContents')
<div class="width80 center">
<fieldset class="fsheader">
	<legend>Register</legend>
	Create your user account here.<br />
	Note usernames must be at least 3 letters long, and alphanumeric.<br />
	
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
</div>
@endsection