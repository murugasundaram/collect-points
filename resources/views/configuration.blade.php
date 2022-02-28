@extends('layouts.master')

@section('css')
  <script>
  $(function() {
    $( "#sortable" ).sortable();
  });
</script>
@endsection
@section('content')
<div class="container-lg">
	<div class="row">
		<div class="col-sm-12">
		<h4>Configuration</h4>
	</div>
	<div class="col-sm-12 text-muted">
		Set the order of the users that will be displayed on the progress screen
	</div>
	</div>
<div class="row mt-3">
	<ul class="list-group w-50 sortable user-sort-list" id="sortable">
		@foreach($allUser as $user)
		  <li style="cursor: move;" class="list-group-item ui-state-default" data-user="{{ $user->id }}"> 
		  	<i class="icon icon-2xl mt-5 mb-2 cil-menu"></i> 
		  	<span class="pl-2"> {{ $user->nick_name }} </span>
		  </li>
		@endforeach
	</ul>
</div>
<div class="row mt-3">
	<button class="btn btn-success" onclick="saveTheOrder()">Save</button>
</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	function saveTheOrder() {
		let data = []
		
		$('.user-sort-list > li').each(function(){
			data.push($(this).data('user'))
			
		})

		$.ajax({
            url: '{{route("save_config")}}',
            type: 'POSt',
            data: {'data' : data},
            success: function(response) {
              if(!response.error) {
              	window.alert('Configuration saved successfully!');
              }
            }
        });

		console.log(data)
	}
</script>
@endsection


