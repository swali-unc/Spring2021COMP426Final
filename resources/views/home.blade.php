@extends('masterbody')

@section('PageTitle','Home Page')

@section('PageContents')
<div class="width80">
<fieldset class="fsheader">
	<legend>Welcome!</legend>
	<p>Welcome to AI Tic-Tac-Toe, where you can challenge several AI, compete for a high score list, and participate in all things competitive tic-tac-toe.<br /></p>
@if( $IsLoggedIn )
	<p>Start playing by clicking the <a href="/play">play</a> button!</p>
@else
	<p>If you wish to play, please <a href="/register">register</a> or <a href="/login">log in</a></p>
@endif
</fieldset>
<fieldset class="fsfooter">
</fieldset>
</div>
@endsection