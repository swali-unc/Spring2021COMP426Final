@extends('masterbody')

@section('PageTitle','Login to comp426 twitter')

@push('Headers')
<script src="/js/axios.min.js"></script>
<script src="/js/comptwitterapi.js" type='module'></script>
<script src="/js/twitterlogin.js" type='module'></script>
@endpush

@push('OnLoadJS')
	
@endpush

@push('Stylesheets')
@endpush

@section('PageContents')
<div class="width80 center">
	<fieldset class="fsheader">
		<form id="login-form">
			<table>
			<tr>
				<td>Username:</td>
				<td><input id="email" type="email" name="email" title="email" placeholder="Email" required autofocus /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input id="password" type="password" name="password" title="password" placeholder="Password" required /></td>
			</tr>
			</table>
			<button type="submit" onclick="window.AttemptLogin();">Login</button>
		</form>
	</fieldset>
	<fieldset class="fsfooter">
		<div id="message" class="textleft"></div>
	</fieldset>
</div>
@endsection