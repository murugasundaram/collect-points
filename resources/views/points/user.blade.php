@extends('layouts.auth')

@section('css')
<script type="text/javascript" src="{{ url('js/jquery-te-1.4.0.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('css/jquery-te-1.4.0.css') }}">
<script>
  $(function() {
    $("textarea").jqte();
    $('.jqte_toolbar').addClass('d-none');
  });
</script>
@endsection

@section('content')
<div class="container">



<!-- jquery-te-1.4.0.min -->
	
  <div class="row justify-content-center">

  	@if(session('success'))
  	<div class="w-75 alert alert-success alert-dismissible fade show" role="alert">
	   {{ session('success') }}
	   <span class="float-right" style="cursor: pointer;" data-dismiss="alert" aria-label="Close">X</span>
	</div>
	@endif

  	<div class="w-75 mb-3">
  		<a class="ml-3 btn btn-primary" target="_blank" href="{{ route('view_progress') }}">Today's Progress</a>
  		<a class="ml-3 btn btn-dark" target="_blank" href="#">My History</a>
  		
  	</div>
  	
  	<div class="card w-75 mb-3">
	  <div class="card-body">
	    <h2 class="card-title"> Hello, {{ Auth::user()->name }}!! 
	    	<a class="mr-3 btn btn-danger rounded-pill float-right" href="{{ route('logout') }}" 
	    	onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
	    	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
		</h2>
	    <p class="card-text">Aww yeah, you successfully get into the collect points application. Here you can post your today's progress. You can see your history of one month. you can see the today's progress of others too.</p>
	    <p class="card-text"><h5>Please update your progress of {{ date('M d, Y') }}</h5> </p>

	    <form id="progress-form" method="POST" action="{{ route('update_points') }}">
	    	@csrf
	    	<textarea class="form-control" rows="10" name="progress">{{ $points }}</textarea>
	    	@if(Auth::user()->is_support_admin)
	    	<div>
	    		<h5>Support Tickets</h5>
	    		<textarea class="form-control" rows="10" name="supportTkt">{{ $st }}</textarea>
	    	</div>
	    	@endif
	    	

	    <p class="mt-4">
	    	<a class="btn float-right btn-success" href="{{ route('update_points') }}" onclick="event.preventDefault(); document.getElementById('progress-form').submit();">Submit</a>
	    	<!-- <button class="btn float-right btn-success" type="submit">submit</button> -->
	    </p>
	    	
	    </form>
	    
	    
	  </div>
	</div>
  </div>
</div>

@endsection

@section('javascript')

@endsection
