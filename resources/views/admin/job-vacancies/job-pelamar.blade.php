@extends('template_admin.home')
@section('title', 'Daftar Pelamar')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
<div class="d-flex justify-content-center">
  <div class="row col-md-12 ">
    <div class="container-fluid" id="grad1">
      <div class="card user-details-card">
        <div class="card-body">
          <div class="row justify-content-center mb-3">
            <h2><strong>Daftar Pelamar</strong></h2>
          </div>
          <!-- <div class="d-flex mb-3 justify-content-end">
            <input type="text">
            <button type="submit" class="btn btn-outline-secondary btn-sm ml-1">Search</button>
          </div> -->
          <div class="card-body table-responsive-sm p-0">
            <table class="table table-bordered table-hover" id='datatablePelamar'>
              <thead class="thead-light text-center">
                <tr>
                  <!-- <th>Aksi</th> -->
                  <th>ID</th>
                  <th>NIK</th>
                  <th>Nama Lengkap</th>
                  <th>Pendidikan Terakhir</th>
                  <th>Minat Karir</th>
                  <th>Status</th>
                  <th>Tanggal Apply</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($applicants as $applicant)
                <tr class="clickable-row">
                  <!-- <td>
                    <div class="btn-group d-inline">
                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                      </button>
                      <div class="dropdown-menu dropdown-menu-open position-absolute">
                        <button class="btn btn-success btn-proceed btn-sm dropdown-item" data-id="{{ $applicant->id }}" data-toggle="modal" data-target="#ProceedModal-{{ $applicant->id }}"><i class="fa fa-cogs"></i> Proses</button>
                        <a href="{{ route('admin.activity_pelamar', $applicant->id) }}" class="dropdown-item"><i class="fa fa-paper-plane"></i> Activity</a>
                        <a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id] ) }}" class="dropdown-item"><i class="fa fa-file"></i> Detail</a>
                        <button class="btn btn-danger btn-hapus btn-sm dropdown-item" data-id="{{ $applicant->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $applicant->id }}"><i class="fa fa-user-times"></i> Hapus</button>
                      </div>
                    </div>
                  </td> -->
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->id }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->nik }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->nama_lengkap }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->pendidikan_terakhir }} {{ $applicant->UserData->jurusan }}, {{ $applicant->UserData->institusi }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->job_vacancy['job_title'] }}</a></td>
                  <td><a href="{{ route('admin.activity_pelamar', $applicant->id) }}">{{ $applicant->status }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $applicant->id]) }}">{{ $applicant->created_at }}</a></td>

                </tr>

                {{-- modal untuk konfirmasi --}}

                <div id="DeleteModal-{{ $applicant->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    {{-- Content / Isi Modal --}}
                    <form action="{{ route("admin.destroy_pelamar", ['pelamar' => $applicant->id]) }}" method="POST">
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

                <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                <!-- Include jQuery library (if not already included) -->

                <script>
                  $(document).ready(function() {
                    // Your JavaScript code here
                    $('#submitForm-{{ $applicant->id }}').on('click', function(event) {
                      event.preventDefault();

                      var formData = $('#proceedForm-{{ $applicant->id }}').serialize();
                      $.ajax({
                        type: "POST",
                        url: "{{ route('admin.process_pelamar') }}",
                        data: formData,
                        success: function(response) {
                          console.log(response);
                          if (response.success) {
                            location.reload();
                          }
                          // $('#ProceedModal-{{ $applicant->id }}').modal('hide');
                          // toast(response,'success');
                        },
                        error: function(error) {
                          console.log(error);
                        }
                      });
                    });
                  });
                </script>
                </body>

                </html>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll(".clickable-row");

    rows.forEach(row => {
      row.addEventListener("click", function() {
        const href = row.getAttribute("data-href");
        if (href) {
          window.location.href = href;
        }
      });
    });
  });
</script>





@endsection