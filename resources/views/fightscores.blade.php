@extends('masterbody')

@section('PageTitle')
Top scores for fighter- {{ $fighter['name'] }}
@endsection

@section('PageContents')
<div class="width80 center">
	<fieldset class="fsheader">
		<legend>High Scores List for {{ $fighter['name'] }}</legend>
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