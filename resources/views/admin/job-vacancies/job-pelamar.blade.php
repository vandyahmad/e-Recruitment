@extends('template_admin.home')
@section('title', 'Daftar Pelamar')

@section('content')
<!-- Include DataTables CSS -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->

<div class="d-flex justify-content-center">
  <div class="row col-md-12 ">
    <div class="container-fluid" id="grad1">
      <div class="card user-details-card">
        <div class="card-body">
          <div class="row justify-content-center mb-3">
            <h2><strong>Daftar Pelamar</strong></h2>
          </div>
          <div class="card-body table-responsive-sm p-0">
            <table class="table table-bordered table-hover" id="datatablePelamar">
              <thead class="thead-light text-center">
                <tr>
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
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->id }}</a></td>
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->nik }}</a></td>
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->nama_lengkap }}</a></td>
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->UserData->pendidikan_terakhir }} {{ $applicant->UserData->jurusan }}, {{ $applicant->UserData->institusi }}</a></td>
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->job_vacancy['job_title'] }}</a></td>
                  <td><a href="{{ route('admin.activity_pelamar', $applicant->id) }}">{{ $applicant->status }}</a></td>
                  <td><a href="{{ route('admin.show_pelamar', ['pelamar' => $applicant->id]) }}">{{ $applicant->created_at }}</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables JS -->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

<!-- Initialize DataTable -->
<script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#datatablePelamar').DataTable({
      "pageLength": 25, // Default number of entries per page
      "order": [[0, 'desc']], // Sort by the first column (ID)
      "dom": '<"top"lf>rt<"bottom"ip><"clear">' // Customize table controls layout
    });
  });
</script>

@endsection
