@extends('masterbody')

@section('PageTitle','High Scores List')

@push('OnLoadJS')
$('#searchname').autocomplete({
	source: '/search/suggest',
	minLength: 3
});
@endpush

@section('PageContents')
<div class="width80 center">
	<fieldset class="fsheader">
		<legend>Find a user</legend>
		{{ Form::open(['url'=>'/search','method'=>'post']) }}
		{{ Form::token() }}
		Search for a user: <input type="text" name="searchname" id="searchname" /><br />
		{{ Form::submit('Search') }}
		{{ Form::close() }}
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
<div class="width80 center">
	<fieldset class="fsheader">
		<legend>High Scores List</legend>
		<table class="width95">
			<tr>
				<th>Position</th>
				<th>Username</th>
				<th>Score</th>
			</tr>
			@foreach( $scores as $score )
			<tr>
				<td class="centertext">#{{ $loop->index+1 }}</td>
				<td class="centertext"><a href="/score/user/{{ $score->userid }}">{{ $score->username }}</a></td>
				<td class="centertext">{{ $score->totalscore }}</td>
			</tr>
			@endforeach
		</table>
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection