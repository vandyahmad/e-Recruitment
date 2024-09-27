@extends('template_admin.home')
@section('title', 'Detail Pelamar')

@section('content')

<!-- Profile Page Styling -->
<style>
  .profile-header {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
  }

  .profile-section {
    margin-bottom: 20px;
  }

  .profile-label {
    font-weight: bold;
    color: #343a40;
  }

  .profile-data {
    color: #6c757d;
  }

  .profile-actions {
    margin-top: 15px;
  }

  .card-header p {
    font-size: 16px;
    font-weight: bold;
  }
</style>

<!-- Main Profile Section -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Profile Image and Actions -->
      <!-- <div class="col-md-3">
        <div class="card card-danger card-outline">
          <div class="card-body box-profile text-center">
            <img class="profile-user-img img-fluid img-circle"
              src="{{ asset('uploads/images/'.$userData->upload_foto)}}"
              alt="User profile picture" style="width: 120px; height: 120px;">

            <h3 class="profile-username text-center mt-2">{{$userData->nama_lengkap}}</h3>
            <p class="text-muted text-center">NIK: {{$userData->nik}}</p>

            
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <a href="{{ asset('uploads/files/'.$userData->upload_file)}}" class="btn btn-danger btn-block">
                  <b><i class="fas fa-file-pdf"></i> Download CV</b>
                </a>
              </li>
              <li class="list-group-item">
                <a href="{{ route('admin.cetak_form_interview', $userData->user_id) }}" class="btn btn-danger btn-block" target="_blank">
                  <b><i class="fas fa-print"></i> Cetak Form Interview</b>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div> -->

      <!-- Profile Information -->
      <div class="col-md-9">
        <div class="card card-solid">
          <div class="card-body">
            <!-- Personal Information Section -->
            <div class="profile-header">
              <h5><i class="fas fa-user"></i> Informasi Data Diri</h5>
            </div>

            <!-- Profile Details -->


            <div class="profile-section">
              <div class="form-group row">
                <img class="profile-user-img img-fluid img-circle"
                  src="{{ asset('uploads/images/'.$userData->upload_foto)}}"
                  alt="User profile picture" style="width: 120px; height: 120px;">
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">NIK</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->nik}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Nama Lengkap</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->nama_lengkap}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki'}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Tempat Lahir</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->tempat_lahir}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->tanggal_lahir}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Email</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->email}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">No. Telepon</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->no_hp}}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 profile-label">Pendidikan Terakhir</label>
                <div class="col-sm-9">
                  <p class="profile-data">{{$userData->pendidikan_terakhir}} {{$userData->jurusan}}, {{$userData->institusi}}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection