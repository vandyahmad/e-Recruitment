@extends('template_admin.home')
@section('title', 'Detail Pelamar')

@section('content')
<!-- CARD ID -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-danger card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('uploads/images/'.$pelamar->userData->upload_foto)}}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{$pelamar->userData->nama_lengkap}}</h3>

            <p class="text-muted text-center">NIK.<a>{{$pelamar->userData->nik}}</a></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <a href="{{ asset('uploads/files/'.$pelamar->userData->upload_file)}}" class="btn btn-danger btn-block"><b><i class="fas fa-print"></i> CV Pelamar</b></a>
              </li>
              @if($userData->form_interview == 'unprocessed')
              <li class="list-group-item">
                <a href="{{route('admin.cetak_pelamar', ['pelamar'=>$pelamar->id])}}" class="btn btn-danger btn-block" target="_blank"><b><i class="fas fa-print"></i> Export to PDF</b></a>
              </li>
              @else
              <li class="list-group-item">
                <a href="{{ route('admin.cetak_form_interview', $userData->user_id) }}" class="btn btn-danger btn-block" target="_blank"><b><i class="fas fa-print"></i> Form Interview</b></a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>

      <!-- Kolom Biodata -->
      <div class="col-md-9">
        <div class="card card-solid">
          <div class="card-body pb-0">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><b>Informasi Data Diri Calon Pelamar</b></li>
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label class=" col-sm-2">NIK</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->nik}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->nama_lengkap}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->jenis_kelamin =='P' ? 'Perempuan' : 'Laki-laki' }}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Tempat Lahir</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->tempat_lahir}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Tanggal Lahir</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->tanggal_lahir}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Alamat</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->alamat}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Email</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->email}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">No.Telepon</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->no_hp}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Pendidikan Terakhir</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->userData->pendidikan_terakhir}} {{$pelamar->userData->jurusan}}, {{$pelamar->userData->institusi}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Applied</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$pelamar->job_vacancy->job_title}}</label>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection