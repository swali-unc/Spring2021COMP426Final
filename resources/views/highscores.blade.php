@extends('masterbody')

@section('PageTitle','High Scores List')

@section('PageContents')
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
				<td class="centertext">{{ $score->username }}</td>
				<td class="centertext">{{ $score->totalscore }}</td>
			</tr>
			@endforeach
		</table>
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection