@extends('layouts.master')

@section('content')
<div class="container-lg">
	<div class="row">
		<div class="col-sm-12">
		<h4>Today Progress Status ({{ date('M d, Y') }})</h4>
	</div>
	</div>
<div class="row mt-3">
  @foreach($allUser as $user)
  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="fs-4 fw-semibold"></div>
        <div><strong>{{ $user->nick_name }}</strong></div>
        <div class="progress progress-thin my-2">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ $user->exist_id ? 100 : 0 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div><small class="text-medium-emphasis">{{ $user->exist_id ? 'Submitted' : 'Yet to submit' }}</small>
      </div>
    </div>
  </div>
  @endforeach
</div>
</div>
@endsection


