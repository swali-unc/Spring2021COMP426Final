@extends('masterbody')

@section('PageTitle','Home Page')

@section('PageContents')
<div class="container">
	@for( $i = 0; $i < count($fighters); ++$i )
	@if( $i % 3 == 0 )
	<div class="row">
	@endif
		<div class="col3">
			<fieldset class="fsheader">
				<legend>{!! $fighters[i]['name'] !!}</legend>
				@php
					$qi = mt_rand(0,count($fighters[i]['taunts'])-1);
				@endphp
				<p class="fighterquote">
					{!! $fighters[i]['taunts'][$qi] !!}
				</p>
			</fieldset>
			<fieldset class="fsfooter">
				<button>Challenge</button>
			</fieldset>
		</div>
	@if( $i % 3 == 0 )
	</div>
	@endif
	@endfor
</div>
@endsection