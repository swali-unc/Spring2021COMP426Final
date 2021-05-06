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
				<td>{{ $loop->index+1 }}</td>
				<td>{{ $score->username }}</td>
				<td>{{ $score->totalscore }}</td>
			</tr>
			@endforeach
		</table>
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection