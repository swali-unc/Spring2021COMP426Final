@extends('masterbody')

@section('PageTitle','Relevant Streams')

@section('PageContents')
<div class="width95 center">
	<fieldset class="fsheader">
		<legend>Find streams relevant to our game!</legend>
		
		@foreach( $js->data as $s )
		<div class="stream">
			<img src="{!! $s->thumbnail_url !!}" class="streamimg" />
			<br />
			Watch <a href="https://twitch.tv/{!! $s->broadcaster_login !!}">{{ $s->display_name }}</a>
		</div>
		@endforeach
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection