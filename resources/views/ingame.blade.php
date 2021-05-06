@extends('masterbody')

@section('PageTitle','FIGHT!')

@push('Headers')
<script src="/js/axios.min.js"></script>
<script src="/js/fightapi.js" type='module'></script>
<script src="/js/fightsystem.js" type='module'></script>
@endpush

@push('OnLoadJS')
	
@endpush

@push('Stylesheets')
<link href="/css/fight.css" rel="stylesheet" type="text/css">
@endpush

@section('PageContents')
<div class="center width80">
<fieldset class="fsheader">
	<table class="maxwidth">
		<tr>
		<td class="width50">
			<table class="gridtable">
				<tr>
					<td id="tl" class="gridelement borderright borderbottom"></td>
					<td id="tm" class="gridelement borderleft borderright borderbottom"></td>
					<td id="tr" class="gridelement borderleft borderbottom"></td>
				</tr>
				<tr>
					<td id="cl" class="gridelement bordertop borderright borderbottom"></td>
					<td id="cm" class="gridelement bordertop borderbottom borderleft borderright"></td>
					<td id="cr" class="gridelement borderleft bordertop borderbottom"></td>
				</tr>
				<tr>
					<td id="bl" class="gridelement bordertop borderright"></td>
					<td id="bm" class="gridelement bordertop borderleft borderright"></td>
					<td id="br" class="gridelement borderleft bordertop"></td>
				</tr>
			</table>
		</td>
		<td class="width50">
			<div id="errors">
			</div>
			<br />
			<div id="statusmsg">
			</div>
		</td>
		</tr>
	</table>
</fieldset>
<fieldset class="fsfooter">
	<img src="{{ $fighter['logo'] }}" class="floatleft fighterimg" />
	<p id="quote" class="fighterquote lefttext">
		{!! $fighter['taunts'][mt_rand(0,count($fighter['taunts'])-1)] !!}
	</p>
</fieldset>
</div>
@endsection