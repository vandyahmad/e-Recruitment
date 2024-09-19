@extends('template_admin.home')
@section('title', 'Job Vacancies')
@section('sub-judul', 'Job Vacancies')
@section('btn_url_add', route('vacancies.create'))
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
        <!-- <div class="btn-action d-flex justify-content-end">
                            <a class="btn btn-primary d-inline-block"><i class="fa fa-file"></i>
                                  Add
                            </a>
              </div> -->
        <!-- <div class="btn-action d-flex justify-content-end">
                <a class="btn btn-primary btn-cool-add d-inline-block"><i class="fa fa-plus-circle"></i> Add </a>
              </div> -->


        <table class="table table-hover" id='datatableJobVacancy'>
          <thead>
            <tr>
              <!-- <th>Job ID</th> -->
              <th>Action</th>
              <th>Job Title</th>
              <!-- <th>Job Description</th>
              <th>Job Requirement</th> -->
              <th>Job Location</th>
              <th>Job Company</th>
              <!-- <th>Job Branch</th> -->
              <th>Job Start Date</th>
              <th>Job End Date</th>
              <th>Applicants</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jobvacancies as $result)

            <tr class="table-sm">
              <!-- <td>{{ $result->id }}</td> -->

              <td>
                <div class="btn-group d-inline">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tools
                  </button>
                  <div class="dropdown-menu dropdown-menu-open position-absolute">

                    <a href="{{ route("vacancies.pelamar", ['vacancies' => $result->id] ) }}" class="dropdown-item"><i class="fa fa-user"></i> Applicant</a>
                    <a href="{{ route("vacancies.show", ['vacancies' => $result->id] ) }}" class="dropdown-item"><i class="fa fa-file"></i> Details</a>
                    <a href="{{ route("vacancies.edit", ['vacancies' => $result->id] ) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                    <button class="btn btn-danger btn-hapus btn-sm dropdown-item" data-id="{{ $result->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $result->id }}"><i class="fa fa-user-times"></i> Hapus</button>
                  </div>
                </div>
              </td>
              <td>{{ $result->job_title }}</td>
              <!-- <td>{!! $result->job_description !!}</td>
              <td>{!! $result->job_requirement !!}</td> -->
              <td>{{ $result->job_location }}</td>
              <td>{{ $result->job_company }}</td>
              <!-- <td>{{ $result->job_branch }}</td> -->
              <td class="text-center">{{ $result->job_start_date }}</td>
              <td class="text-center">
                @if (strtotime($result->job_end_date) < strtotime(now())) <strong style="color: red;">{{ $result->job_end_date }}</strong>
                  @elseif (strtotime($result->job_end_date) == strtotime(now()))
                  <strong>{{ $result->job_end_date }}</strong>
                  @else
                  <strong>{{ $result->job_end_date }}</strong>
                  @endif

              </td>

              <td class="text-center">
                <a href="{{ route("vacancies.pelamar", ['vacancies' => $result->id]) }}">
                  {{ count($result->pelamar) }}
                  </a>
              </td>

              <!-- <td>

                <div class="btn-action">
                  <a href="{{ route("vacancies.show", ['vacancies' => $result->id] ) }}" class="btn btn-info d-inline-block btn-sm"><i class="fa fa-file"></i>
                    Details
                  </a>
                  <a href="{{ route("vacancies.edit", ['vacancies' => $result->id] ) }}" class="btn btn-success d-inline-block btn-sm"><i class="fa fa-file"></i>
                    Edit
                  </a>
                  <button class="btn btn-danger btn-hapus btn-sm" data-id="{{ $result->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $result->id}}"><i class="fa fa-user-times"></i>
                    Delete
                  </button>
                </div>
              </td> -->
            </tr>

            {{-- modal untuk konfirmasi --}}

            <div id="DeleteModal-{{ $result->id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {{-- Content / Isi Modal --}}
                <form action="{{ route("vacancies.destroy", ['vacancies' => $result->id]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-center">Konfirmasi</h4>
                      <button type="button" class="close" data-dismiss="modal">
                        &times;</button>
                    </div>
                    <div class="modal-body">
                      <p class="text-center"> Anda yakin akan menghapus data ini ? </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">
                        Batalkan
                      </button>
                      <button type="submit" class="btn btn-danger" onclick="this.form.submit()" data-dismiss="modal">
                        Ya, Hapus</button>
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