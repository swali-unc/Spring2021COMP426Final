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
	<table>
		<tr>
			<td class="borderright borderbottom"></td>
			<td class="borderleft borderright borderbottom></td>
			<td class="borderleft borderbottom"></td>
		</tr>
		<tr>
			<td class="bordertop borderright borderbottom"></td>
			<td class="bordertop borderbottom borderleft borderright></td>
			<td class="borderleft bordertop borderbottom></td>
		</tr>
		<tr>
			<td class="bordertop borderright"></td>
			<td class="bordertop borderleft borderright"></td>
			<td class="borderleft bordertop"></td>
		</tr>
	</table>
</fieldset>
<fieldset class="fsfooter">
	
</fieldset>
@endsection