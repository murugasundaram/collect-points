@extends('layouts.auth')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="card w-75 mb-3">
			<div class="card-title mt-5 ml-5">
				<h1>Today's Progress {{ date('M d, Y') }}
					<a class="mr-3 btn btn-primary rounded-pill float-right" href="#" onclick="event.preventDefault();">Download</a>
				 </h1>
			</div>
	  		<div class="card-body">
	  			<div>
	  				<div class="ml-4">-------------------------------------------</div>
	  				@if($st)
	  				<div class="ml-4">
		  				<strong> Today Support Tickets </strong>
		  			</div>
		  			<div class="ml-4 ">
		  				{!! $st !!}
		  			</div>
		  			@else
		  			<div class="ml-4">
		  				<strong>There is no Support Tickets today</strong>
		  			</div>
		  			@endif
	  				<div class="ml-4 mb-3">-------------------------------------------</div>
	  			</div>
	  			@foreach($progress as $pro)
	  			<div>
	  				<div class="ml-4">
		  				({{$pro->nick_name}})
		  			</div>
		  			<div class="ml-4 mb-3">
		  				{!! $pro->points ? $pro->points : 'Leave' !!}
		  			</div>
	  			</div>
	  			@endforeach
	  		</div>
	  	</div>
	</div>
</div>


@endsection