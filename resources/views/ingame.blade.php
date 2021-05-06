@extends('masterbody')

@section('PageTitle','FIGHT!')

@push('Headers')
<script src="/js/axios.min.js"></script>
<script src="/js/fight.js" type='module'></script>
@endpush

@push('Stylesheets')
<link href="/css/fight.css" rel="stylesheet" type="text/css">
@endpush

@section('PageContents')
<fieldset class="fsheader">
	<table class="gridtable">
		<tr>
			<td class="gridelement borderright borderbottom"></td>
			<td class="gridelement borderleft borderright borderbottom"></td>
			<td class="gridelement borderleft borderbottom"></td>
		</tr>
		<tr>
			<td class="gridelement bordertop borderright borderbottom"></td>
			<td class="gridelement bordertop borderbottom borderleft borderright"></td>
			<td class="gridelement borderleft bordertop borderbottom"></td>
		</tr>
		<tr>
			<td class="gridelement bordertop borderright"></td>
			<td class="gridelement bordertop borderleft borderright"></td>
			<td class="gridelement borderleft bordertop"></td>
		</tr>
	</table>
</fieldset>
<fieldset class="fsfooter">
	<img src="{{ $fighter['logo'] }}" class="floatleft fighterimg" />
	<p id="quote" class="fighterquote">
		{!! $fighter['taunts'][mt_rand(0,count($fighter['taunts'])-1)] !!}
	</p>
</fieldset>
@endsection