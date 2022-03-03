@extends('layouts.auth')

@section('css')
<style type="text/css">
	p {
		margin-bottom: 1px;
	}
</style>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="w-75 mb-3">
			<h2 class="">Your Progress History
				@if(Auth::user()->role == 1)
				<a class="btn btn-primary btn-sm float-right" href="{{ route('view_dash') }}">Dashboard</a>
				@endif
				<a class="btn btn-dark btn-sm float-right mr-2" href="{{ route('get_points') }}">Go Back</a>
			</h2>
		</div>
		@foreach($history as $his)
		<div class="card w-75 mb-3">
			<div class="card-title mt-5 ml-5">
				<h5> {{ date('M d, Y (l)', strtotime($his->as_on_date)) }} </h5>
			</div>
	  		<div class="card-body">
	  			
		  			<div class="ml-4 mb-3">
		  				{!! $his->points ? $his->points : 'Leave' !!}
		  			</div>
	  			
	  		</div>
	  	</div>
	  	@endforeach
	</div>
</div>
@endsection