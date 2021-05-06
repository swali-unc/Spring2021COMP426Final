@extends('masterbody')

@section('PageTitle','Choose your fight')

@section('PageContents')
<div class="container">
	@foreach( $fighters as $fight )
		@if( $loop->index % 3 == 0 )
		<div class="row">
		@endif
			<div class="col3">
				<fieldset class="fsheader vh23">
					<legend>{!! $fight['name'] !!}</legend>
					<img src="{{ $fight['logo'] }}" class="floatleft fighterimg" />
					<p class="fighterquote">
						{!! $fight['taunts'][mt_rand(0,count($fight['taunts'])-1)] !!}
					</p>
				</fieldset>
				<fieldset class="fsfooter">
					<button>Challenge</button>
				</fieldset>
			</div>
		@if( $loop->index % 3 == 2 || $loop->last )
		</div>
		@endif
	@endforeach
</div>
@endsection