@extends('master')

@section('page')
				
	<div class="col-md-2 nav-side">
		{!! Insider\iNUtil::portlet(Insider\Concept\Facades\WebPage::getMenu('portlet')) !!}
		@yield('portlet')
	</div>
		
	<div class="col-md-10">
		@yield('content')
	</div>
			
@endsection
