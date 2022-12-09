@extends('layouts.master')

@section('css')
@endsection

@section('content')
<div class="container-lg">
	<div class="row">
		<div class="col-sm-12">
			<h4>Password Management</h4>
		</div>
		<div class="col-sm-12 text-muted">
			Reset the user password and send a notification to user with new password
		</div>
	</div>

	<div class="row mt-3">
		<div class="card" style="width: 50%">
		  <div class="card-body">

		  	<div id="updateUserNameId" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  
			</div>
		    
		    <div class="mt-3">
		    	<label class="form-label"><strong>Please Select a user</strong> </label>
		    	<select id="userDrop" class="form-select" aria-label="Default select example">
				  <option value="0" selected>-- Select the user --</option>
				  @foreach($users as $user)
				  <option value="{{ $user->id }}">
				  	<span>{{ $user->nick_name }}</span>
				  	<span>({{ $user->email }})</span>
				  </option>
				  @endforeach
				</select>
		    </div>

		    <div class="mt-3">
			  <label class="form-label"> <strong>Password</strong> </label>
			  <input type="password" class="form-control" id="password" >
			</div>

			<div class="form-check mt-3">
			  <input class="form-check-input" type="checkbox" value="" id="notifyUser">
			  <label class="form-check-label" for="notifyUser">
			    Notify the user about the password change
			  </label>
			</div>
		    
			<div class="mt-3">
			    <button onclick="clearThePassData()" class="btn btn-secondary">Clear</button>
			    <button onclick="saveThePassData()" class="btn btn-success">Save</button>
			</div>
		  </div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){

	})

	function clearThePassData() {
		$('#password').val("");
		$('#userDrop').val(0).change();
		$('#notifyUser').prop('checked', false);
	}

	function saveThePassData() {
		var _pass = $('#password').val();
		var _userDrop = $('#userDrop').val();
		var _notifyUser = $('#notifyUser').is(':checked');

		if(_pass == "" || _userDrop == 0) {
			alert("Please fill all the informations to proceed furthur");
			return false;
		} else {
			$.ajax({
	            url: '{{route("save_password_config")}}',
	            type: 'POST',
	            data: {_pass : _pass, _userDrop : _userDrop , _notifyUser : _notifyUser},
	            success: function(response) {
	              if(!response.error) {
	              	$('#updateUserNameId').html(response.msg)
	              	$('#updateUserNameId').removeClass('d-none')
	              	setTimeout(function(){
	              		$('#updateUserNameId').addClass('d-none')
	              	}, 3000);
	              	clearThePassData();
	              }
	            }
	        });
		}

		console.log(_pass,_userDrop,_notifyUser)
	}
</script>
@endsection


