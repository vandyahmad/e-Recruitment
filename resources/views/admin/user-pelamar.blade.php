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
            <h3><strong>Daftar Pelamar</strong></h3>
          </div>
          <div class="card-body table-responsive-sm p-0">
            <table class="table table-bordered table-hover" id="datatablePelamar">
              <thead class="thead-light text-center">
                <tr>
                  <th>Aksi</th>
                  <th>ID</th>
                  <th>NIK</th>
                  <th>Nama Lengkap</th>
                  <th>Pendidikan Terakhir</th>
                  <th>Pekerjaan Terakhir</th>
                  <th>Tanggal Keluar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userPelamars as $user)
                <tr class="clickable-row">
                  <td>
                    <div class="btn-group d-inline">
                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: x-small;">
                        Tools
                      </button>
                      <div class="dropdown-menu dropdown-menu-open position-absolute">
                        <a href="https://wa.me/62{{$user->no_hp}}" class="dropdown-item" target="_blank"><i class="fa fa-phone-alt"></i> Contact/WA</a>
                        <a href="{{ route('admin.show_user_pelamar', ['id' => $user->user_id] ) }}" class="dropdown-item"><i class="fa fa-file"></i> Detail</a>
                      </div>
                    </div>
                  </td>
                  <td>{{ $user->user_id }}</td>
                  <td>{{ $user->nik }}</td>
                  <td>{{ $user->nama_lengkap }}</td>
                  <td>{{ $user->pendidikan_terakhir }} {{ $user->jurusan }}, {{ $user->institusi }}</td>
                  @if ($user->jabatan == null)
                    <td> - </td>
                  @else
                    <td><b>{{ $user->jabatan }}</b> di <b>{{ $user->nama_perusahaan }}</b></td>
                  @endif
                  <td>{{ $user->tanggal_keluar }}</td>
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


<!-- Initialize DataTable -->
<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#datatablePelamar').DataTable({
      "pageLength": 25,
      "columnDefs": [{
          "orderable": false,
          "targets": 0
        } // Disable ordering for column 0
      ],
      "order": [
        [1, 'desc'] // Default order by column 1 (second column) in ascending order
      ],
      "dom": '<"top"lf>rt<"bottom"ip><"clear">' // Customize table controls layout
      // Other DataTables options...
    });
  });
</script>

@endsection