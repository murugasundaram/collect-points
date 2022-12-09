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
			<h4>Projects</h4>
			<span class="text-muted">Manage the team projects at one place</span>
		</div>
		<div class="col-sm-6 text-end">
			<button onclick="addNewProject()" class="btn btn-outline-primary">Add Projct</button>
		</div>
	</div>

	<div class="row mt-3">
		<div class="card" style="width: 50%">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr class="no-top-border">
							<th scope="col">#</th>
							<th scope="col">Project Name</th>
							<th scope="col">Status</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($projects as $key => $project)
						<tr data-proj="{{ $project->id }}">
							<td>{{ $key + 1 }}</td>
							<td class="proj-name">{{ $project->name }}</td>
							<td>{{ !$project->deleted ? 'Active' : 'Not Active' }}</td>
							<td> 
								<span>
									<a href="javascript:void(0)" data-id="{{ $project->id }}" onclick="editThisProject(this)">Edit</a>
								</span>
								<span> | </span>
								<span>
									@if(!$project->deleted)
									<a class="text-danger" href="javascript:void(0)" data-id="{{ $project->id }}" data-val="1" onclick="deleteThisProject(this)">Delete</a>
									@else
									<a class="text-success" href="javascript:void(0)" data-id="{{ $project->id }}" data-val="0" onclick="deleteThisProject(this)">Make Active</a>
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
	        <h5 class="modal-title modal-user-title">Add new Project</h5>
	        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<label class="form-label"><strong>Project Name</strong></label>
	        <input class="form-control form-control-sm" type="text" id="modal-proj-name" placeholder="Name of the project" value="">

	        <input class="form-control form-control-sm mt-3" type="hidden" id="modal-proj-id" value="">
	        <input class="form-control form-control-sm mt-3" type="hidden" id="modal-proj-type" value="">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success" onclick="saveThisProject()">Save</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	function editThisProject(element) {
		var _proj_id = $(element).data('id');
		var _data_proj = $('[data-proj='+_proj_id+']');
		var _proj_name = _data_proj.find('.proj-name').text();
		
		$('#modal-proj-name').val(_proj_name)
		$('#modal-proj-id').val(_proj_id)
		$('#modal-proj-type').val("update")

		$('#staticBackdrop').modal('show')
	}

	function addNewProject() {
		$('#modal-proj-name').val("")
		$('#modal-proj-id').val("")
		$('#modal-proj-type').val("create")

		$('#staticBackdrop').modal('show')
	}

	function saveThisProject() {
		var _proj_name = $('#modal-proj-name').val()
		var _proj_id = $('#modal-proj-id').val()
		var _proj_type = $('#modal-proj-type').val()

		$.ajax({
            url: '{{route("save_project_info")}}',
            type: 'POST',
            data: { id : _proj_id, type : _proj_type, name : _proj_name },
            success: function(response) {
            	$('#staticBackdrop').modal('hide')
            	window.location.reload()
            }
        });
	}

	function deleteThisProject(element) {
		var _proj_id = $(element).data('id');
		var _delete_val = $(element).data('val');

		$.ajax({
            url: '{{route("save_project_info")}}',
            type: 'POST',
            data: { id : _proj_id, type : 'delete', value : _delete_val },
            success: function(response) {
            	window.location.reload()
            }
        });
	}
</script>
@endsection


