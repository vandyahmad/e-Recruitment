@extends('user.profile-pelamar')
@section('content')

<div class="top-shadow"></div>
<div class="inner-page">
    <div class="slider-item" style="background-image: url('assets/images/slider_3.jpg');">
    </div>
</div>
<!-- END slider -->
{{-- CONTENT FORM --}}

<body>
    <div class="container-fluid" id="grad1">
        <div class="card user-details-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="col-md-12 text-center"> Formulir Data Pelamar</h1>
                        <hr>

                        <form style="margin:50px;" action="{{ route('UsersData.store')}} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ auth()->user()->name}}" placeholder="Masukkan Nama Lengkap">
                                        @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">Nomor Induk Kependudukan</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik')}}" placeholder="Masukkan NIK anda">
                                        @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><br>
                                        <div class="custom-control-inline custom-radio ml-4">
                                            <input type="radio" class="custom-control-input" name="jenis_kelamin" id="laki_laki" value="L" {{old('jenis_kelamin')=='L'?'checked':''}}>
                                            <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="custom-control-inline custom-radio ml-4">
                                            <input type="radio" class="custom-control-input" name="jenis_kelamin" id="perempuan" value="P" {{old('jenis_kelamin')=='P'?'checked':''}}>
                                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                                        </div>
                                        @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir')}}" placeholder="Masukkan tempat lahir">
                                                @error('tempat_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror " id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir')}}" placeholder="Masukkan tanggal lahir">
                                                @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                            <option value="Khonghucu" {{ old('agama') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                        </select>
                                        @error('agama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Preferensi Lokasi</label>
                                        <select name="pref_location" class="form-control pref-location" data-placeholder="Pilih Lokasi" style="width: 100% ;">
                                            @foreach($cities as $city)
                                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pref_location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan alamat tempat tinggal saat ini">{{old('alamat')}}</textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror " id="email" name="email" value="{{ auth()->user()->email}}" readonly placeholder="Masukkan email ">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">Nomor Handphone / WhatsApp</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror " id="no_hp" name="no_hp" value="{{ old('no_hp')}}" placeholder="Masukkan nomor yang dapat dihubungi">
                                        @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir')}}" placeholder="Masukkan Pendidikan Terakhir">
                            <small>* Mohon Sertakan Nama Sekolah </small>
                            @error('pendidikan_terakhir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div> -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                            <option value="" disabled selected>Pilih Pendidikan</option>
                                            <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA/sederajat</option>
                                            <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" placeholder="Masukkan jurusan pendidikan anda">
                                        @error('jurusan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="institusi">Institusi</label>
                                        <input type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" name="institusi" placeholder="Masukkan nama sekolah/universitas">
                                        @error('institusi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai">IPK/Nilai Akhir</label>
                                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" placeholder="Masukkan IPK/nilai akhir anda">
                                        @error('nilai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="upload_foto">Upload Foto Profile</label>
                                        <div class="custom-file">
                                            <input type="file" id="upload_foto" name="upload_foto" accept="image/*" class="custom-file-input @error('upload_foto') is-invalid @enderror">
                                            <label class="custom-file-label col-md-12" for="upload_foto" onchange="$ ('#upload_foto').val($(this).val());">
                                                {{ $user->upload_foto ?? 'Upload Foto'}}
                                            </label>
                                            <small>* Upload Foto harus berukuran 3x4 serta Latar Belakang berwarna Merah atau Biru.</small>
                                            @error('upload_foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="upload_file">Upload File</label>
                                <div class="custom-file">
                                    <input type="file" id="upload_file" name="upload_file" class="custom-file-input @error('upload_file') is-invalid @enderror" onchange="FileName()">
                                    <label id='upload_file_name' class="custom-label col-md-12" for="upload_file">Upload File</label>
                                    <small>* Upload File ini diperuntukan untuk Identitas Diri berupa Data Scan (KTP, Ijazah, Sertifikat yang dilegalisir, SKCK, Surat Keterangan Sehat) yang dijadikan Satu File dengan Format PDF.</small>
                                    @error('upload_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
</body>
@endsection