@extends('masterbody')

@section('PageTitle','Relevant Streams')

@section('PageContents')
<div class="width95 center">
	<fieldset class="fsheader">
		<legend>Find streams relevant to our game!</legend>
		
		<table class="maxwidth">
		@foreach( $js->data as $s )
		@if( $loop->index % 5 == 0 )
		<tr>
		@endif
		<td>
		<div class="stream">
			<img src="{!! $s->thumbnail_url !!}" class="streamimg" />
			<br />
			Watch <a href="https://twitch.tv/{!! $s->broadcaster_login !!}">{{ $s->display_name }}</a>
			@if( $s->is_live )
			<br />
			<span class="alert">Live Now!</span>
			@endif
		</div>
		</td>
		@if( $loop->index % 5 == 4 || $loop->last )
		</tr>
		@endif
		@endforeach
		</table>
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection