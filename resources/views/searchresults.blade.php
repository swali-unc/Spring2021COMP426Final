@extends('masterbody')

@section('PageTitle')
Search for: {{ $term }}
@endsection

@section('PageContents')
<div class="width80 center">
	<fieldset class="fsheader">
		<legend>Search Results</legend>
		@if( count( $rows ) == 0 )
		Your search yielded zero results.
		@else
		@foreach( $rows as $row )
		<a href="/score/user/{{ $row->id }}">{{ $row->username }}</a><br />
		@endforeach
		@endif
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection