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
					<td id="tl" class="gridelement borderright borderbottom" onclick="window.ClickGrid('tl');"><div id="loader"></div></td>
					<td id="tm" class="gridelement borderleft borderright borderbottom" onclick="window.ClickGrid('tm');"><div id="loader"></div></td>
					<td id="tr" class="gridelement borderleft borderbottom" onclick="window.ClickGrid('tr');"><div id="loader"></div></td>
				</tr>
				<tr>
					<td id="cl" class="gridelement bordertop borderright borderbottom" onclick="window.ClickGrid('cl');"><div id="loader"></div></td>
					<td id="cm" class="gridelement bordertop borderbottom borderleft borderright" onclick="window.ClickGrid('cm');"><div id="loader"></div></td>
					<td id="cr" class="gridelement borderleft bordertop borderbottom" onclick="window.ClickGrid('cr');"><div id="loader"></div></td>
				</tr>
				<tr>
					<td id="bl" class="gridelement bordertop borderright" onclick="window.ClickGrid('bl');"><div id="loader"></div></td>
					<td id="bm" class="gridelement bordertop borderleft borderright" onclick="window.ClickGrid('bm');"><div id="loader"></div></td>
					<td id="br" class="gridelement borderleft bordertop" onclick="window.ClickGrid('br');"><div id="loader"></div></td>
				</tr>
			</table>
		</td>
		<td class="width50">
			Notes: You are always O, the hero you are fighting is always X.
			<br />
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