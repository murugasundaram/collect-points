@extends('layouts.master')

@section('css')
<style type="text/css">
	.redirectToMap {
		cursor: pointer;
	}

	.redirectToMap :hover {
		background-color: rgb(60 75 100);
		color: white;
	}
</style>
@endsection

@section('content')
<div class="container-lg">
	<div class="row">
		<div class="col-sm-6">
			<h4>Mapping of the Projects</h4>
			<span class="text-muted">Please choose the projects that you want to assign the users who are working with that</span>
		</div>
	</div>

	<div class="row mt-4">
		@foreach($projects as $project)
		<div data-id="{{ $project->id }}" class="col-sm-3 col-lg-3 redirectToMap">
			<div class="card mb-4" style="--cui-card-cap-bg: #3b5998">
				<div class="card-header position-relative d-flex justify-content-center align-items-center" style="height: 120px">
					<strong>{{ $project->name }}</strong>
				</div>
				<div class="card-body row text-center">
					<div class="col">
						<div class="fs-5 fw-semibold">89k</div>
						<div class="text-uppercase text-medium-emphasis small">Members</div>
					</div>
					<div class="vr"></div>
					<div class="col">
						<div class="fs-5 fw-semibold">{{ $allUserCount }}</div>
						<div class="text-uppercase text-medium-emphasis small">All Users</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$('.redirectToMap').on('click', function(){
			window.location.href += '/'+$(this).data('id')
		})
	})
</script>
@endsection


