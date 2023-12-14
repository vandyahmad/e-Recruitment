@extends('user.profile-pelamar')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row col-md-6 ">
        <div class="container-fluid" id="grad1">
            <div class="card user-details-card">
                <div class="card-body">
                    <h1 class="col-md-12 text-center"> Job Application Submit </h1>
                    <hr>

                    <form style="margin:50px;" action="{{ route('pelamars.store')}} " method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="minat_karir">Posisi yang ingin anda apply</label>
                            <select class="form-control @error('minat_karir') is-invalid @enderror" name="minat_karir" id="minat_karir">
                                <option value="" disabled selected>Pilih job vacancy</option>
                                @foreach ($jobVacancies as $jobVacancy)
                                @if (strtotime($jobVacancy->job_end_date) >= strtotime(now()))
                                <option value="{{ $jobVacancy->id }}">
                                    {{ $jobVacancy->job_title }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error('minat_karir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                            <label for="upload_file">Upload File</label>
                            <div class="custom-file">
                                <input type="file" id="upload_file" name="upload_file" class="custom-file-input @error('upload_file') is-invalid @enderror">
                                <label class="custom-file-label col-md-12" for="upload_file" onchange="$   ('upload_file').val($this).val();">
                                    {{ $user->upload_file ?? 'Upload File Anda'}}
                                </label>
                                <small>* Upload File ini diperuntukan untuk Identitas Diri berupa Data Scan (KTP, Ijazah, Sertifikat yang dilegalisir, SKCK, Surat Keterangan Sehat) yang dijadikan Satu File dengan Format PDF.</small>
                                @error('upload_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group mt-5 text-center">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
</body>
@endsection