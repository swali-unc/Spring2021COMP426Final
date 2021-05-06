@extends('masterbody')

@section('PageTitle')
Scores for {{ $personname }}
@endsection

@section('PageContents')
<div class="width80 center">
	<fieldset class="fsheader">
		<legend>History for {{ $personname }}</legend>
		<table class="width95">
			<tr>
				<th>When</th>
				<th>Who</th>
				<th>Score</th>
				<th>Result</th>
			</tr>
			@foreach( $scores as $score )
			<tr>
				<td class="centertext">{{ date('Y-m-d H:i:s', strtotime( $score->createdate ) ) }}</td>
				<td class="centertext">{{ ($fs->GetFight( $score->fightid ))['name'] }}</td>
				<td class="centertext">{{ $score->score }}</td>
				<td class="centertext">
				@if( $score->score == 0 )
				LOST (+0)
				@elseif( $score->score < 10 )
				DRAW (+{{ $score->score }})
				@else
				WIN (+{{ $score->score }})
				@endif 
				</td>
			</tr>
			@endforeach
		</table>
	</fieldset>
	<fieldset class="fsfooter">
	</fieldset>
</div>
@endsection