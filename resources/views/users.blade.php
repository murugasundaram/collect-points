@extends('layouts.master')

@section('css')
<style type="text/css">
	.no-top-border th {
		border-top: 0px solid black;
	}
</style>
@endsection

@section('content')
<div class="container-lg">
	<div class="row">
		<div class="col-sm-6">
			<h4>User Management</h4>
			<span class="text-muted">Create new users and update the user informations</span>
		</div>
		<div class="col-sm-6 text-end">
			<button onclick="addNewUser()" class="btn btn-outline-primary">Add User</button>
		</div>
	</div>

	<div class="row mt-3">
		<div class="card" style="width: 100%">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr class="no-top-border">
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Nick Name</th>
							<th scope="col">Email</th>
							<th scope="col">Status</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $user)
						<tr data-user="{{ $user->id }}">
							<td>{{ $key + 1 }}</td>
							<td class="user-name">{{ $user->name }}</td>
							<td class="user-nick-name">{{ $user->nick_name }}</td>
							<td class="user-email">{{ $user->email }}</td>
							<td>{{ !$user->deleted ? 'Active' : 'Not Active' }}</td>
							<td> 
								<span>
									<a href="javascript:void(0)" data-id="{{ $user->id }}" onclick="editThisUser(this)">Edit</a>
								</span>
								<span> | </span>
								<span>
									@if(!$user->deleted)
									<a class="text-danger" href="javascript:void(0)" data-id="{{ $user->id }}" data-val="1" onclick="deleteThisUser(this)">Delete</a>
									@else
									<a class="text-success" href="javascript:void(0)" data-id="{{ $user->id }}" data-val="0" onclick="deleteThisUser(this)">Make Active</a>
									@endif
								</span>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div> 
		</div> 
	</div>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title modal-user-title">Add new user</h5>
	        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<label class="form-label"><strong>Name</strong></label>
	        <input class="form-control form-control-sm" type="text" id="modal-user-name" placeholder="Name of the user" value="">

	        <label class="form-label mt-3"><strong>Nick Name</strong></label>
	        <input class="form-control form-control-sm" type="text" id="modal-user-nick" placeholder="Nick name of the user" value="">

	        <label class="form-label mt-3"><strong>Email Address</strong></label>
	        <input class="form-control form-control-sm" type="text" id="modal-user-email" placeholder="Email address of the user" value="">

	        <input class="form-control form-control-sm mt-3" type="hidden" id="modal-user-id" value="">
	        <input class="form-control form-control-sm mt-3" type="hidden" id="modal-user-type" value="">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success" onclick="saveThisUser()">Save</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	function editThisUser(element) {
		var _user_id = $(element).data('id');
		var _data_user = $('[data-user='+_user_id+']');
		var _user_name = _data_user.find('.user-name').text();
		var _user_nick_name = _data_user.find('.user-nick-name').text();
		var _user_email = _data_user.find('.user-email').text();

		$('#modal-user-name').val(_user_name)
		$('#modal-user-nick').val(_user_nick_name)
		$('#modal-user-email').val(_user_email)
		$('#modal-user-id').val(_user_id)
		$('#modal-user-type').val("update")

		$('#staticBackdrop').modal('show')
	}

	function addNewUser() {
		$('#modal-user-name').val("")
		$('#modal-user-nick').val("")
		$('#modal-user-email').val("")
		$('#modal-user-id').val("")
		$('#modal-user-type').val("create")

		$('#staticBackdrop').modal('show')
	}

	function saveThisUser() {
		var _user_name = $('#modal-user-name').val()
		var _user_nick_name = $('#modal-user-nick').val()
		var _user_email = $('#modal-user-email').val()
		var _user_id = $('#modal-user-id').val()
		var _user_type = $('#modal-user-type').val()

		$.ajax({
            url: '{{route("save_user_info")}}',
            type: 'POST',
            data: { id : _user_id, type : _user_type, name : _user_name, nick_name : _user_nick_name, email : _user_email },
            success: function(response) {
            	$('#staticBackdrop').modal('hide')
            	window.location.reload()
            }
        });
	}

	function deleteThisUser(element) {
		var _user_id = $(element).data('id');
		var _delete_val = $(element).data('val');

		$.ajax({
            url: '{{route("save_user_info")}}',
            type: 'POST',
            data: { id : _user_id, type : 'delete', value : _delete_val },
            success: function(response) {
            	window.location.reload()
            }
        });
	}
</script>
@endsection


