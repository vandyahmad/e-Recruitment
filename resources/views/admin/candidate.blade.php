@extends('template_admin.home')
@section('title', 'Candidate List')
@section('sub-judul', 'Candidate List')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama Lengkap</th>
              <th>Jenis Kelamin</th>
              <th>Status Kawin</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($candidate as $result)

            <tr class="clickable-row" data-href="{{ route("admin.show_candidate", ['candidate' => $result->id] ) }}">
              <td>{{ $result->nik }}</td>
              <td>{{ $result->nama_lengkap }}</td>
              <td>{{ $result->jenis_kelamin }}</td>
              <td>{{ $result->status_kawin }}</td>
              <td>

                <div class="btn-action">
                  <a href="{{ route("admin.show_candidate", ['candidate' => $result->id] ) }}" class="btn btn-primary d-inline-block"><i class="fa fa-file"></i>
                    Show
                  </a>
                  <button class="btn btn-danger btn-hapus" data-id="{{ $result->id }}" data-toggle="modal" data-target="#DeleteModalCandidate-{{ $result->id}}"><i class="fa fa-user-times"></i>
                    Hapus
                  </button>
                </div>
              </td>
            </tr>

            {{-- modal untuk konfirmasi --}}

            <div id="DeleteModalCandidate-{{ $result->id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {{-- Content / Isi Modal --}}
                <form action="{{ route("admin.destroy_candidate", ['candidate' => $result->id]) }}" method="POST">
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


{{ $candidate->links() }}


@endsection