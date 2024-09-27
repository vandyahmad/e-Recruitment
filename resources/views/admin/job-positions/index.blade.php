@extends('template_admin.home')

@section('btn_url_add', route('admin.create_job_positions'))
@section('btn_add_label', 'Add New')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body table-responsive p-3">

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        <h2 class="text-center mb-3">Job Positions</h2>
        <table class="table table-hover" id='datatableJobPositions'>
          <thead>
            <tr>
              <th>Action</th>
              <th>Job Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jobPositions as $jobPosition)
            <tr class="table-sm">
              <td>
                <div class="btn-group d-inline">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tools
                  </button>
                  <div class="dropdown-menu dropdown-menu-open position-absolute">
                    <a href="{{ route('admin.edit_job_positions', $jobPosition->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                    <button class="btn btn-danger btn-hapus btn-sm dropdown-item" data-id="{{ $jobPosition->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $jobPosition->id }}"><i class="fa fa-user-times"></i> Delete</button>
                  </div>
                </div>
              </td>
              <td>{{ $jobPosition->name }}</td>
              <td>{{ $jobPosition->description }}</td>
            </tr>

            {{-- Modal for delete confirmation --}}
            <div id="DeleteModal-{{ $jobPosition->id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {{-- Modal content --}}
                <form action="{{ route('admin.destroy_job_positions', $jobPosition->id) }}" method="POST">
                  @csrf
                  @method('delete')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-center">Confirm Deletion</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <p class="text-center">Are you sure you want to delete this job position?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger" onclick="this.form.submit()" data-dismiss="modal">Yes, Delete</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<!-- /.row -->

@include('sweetalert::alert')

@endsection