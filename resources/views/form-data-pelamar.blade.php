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
                                            <input type="radio" class="custom-control-input " name="jenis_kelamin" id="laki_laki" value="L" {{old('jenis_kelamin')=='L'?'checked':''}}>
                                            <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="custom-control-inline custom-radio ml-4">
                                            <input type="radio" class="custom-control-input" name="jenis_kelamin" id="perempuan" value="P" {{old('jenis_kelamin')=='P'?'checked':''}}>
                                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                                        </div>
                                        @error('jenis_kelamin')
                                        <span class="invalid-feedback2" role="alert">
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
                                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir')}}" placeholder="Pilih tanggal lahir">
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
                                        <span class="invalid-feedback2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Preferensi Penempatan Kerja</label>
                                        <select id="pref_location" name="pref_location" class="form-control pref-location" data-placeholder="Pilih Lokasi" style="width: 100%;">
                                            <option value="" disabled selected>Pilih Lokasi</option>
                                            @foreach($cities as $city)
                                            <option value="{{ $city->name }}" {{ old('pref_location') == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pref_location')
                                        <span class="invalid-feedback2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Ganti ke halaman form interview -->
                            <!-- <div class="form-group">
                                <label for="alamat">Alamat </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan alamat tempat tinggal saat ini">{{old('alamat')}}</textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div> -->



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
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp')}}" placeholder="Masukkan nomor yang dapat dihubungi">
                                        </div>
                                        @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                            <option value="" disabled selected>Pilih Pendidikan</option>
                                            <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                            <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                            <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA/sederajat</option>
                                            <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="D4" {{ old('pendidikan_terakhir') == 'D4' ? 'selected' : '' }}>D4</option>
                                            <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <span class="invalid-feedback2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan')}}" placeholder="Masukkan jurusan pendidikan anda">
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
                                        <input type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" name="institusi" value="{{ old('institusi')}}" placeholder="Masukkan nama sekolah/universitas">
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
                                        <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai')}}" placeholder="Masukkan IPK/nilai akhir anda">
                                        @error('nilai')
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
                                        <label for="upload_foto">Upload Foto Profile</label>
                                        <div class="custom-file">
                                            <input type="file" id="upload_foto" name="upload_foto" accept="image/*" class="custom-file-input @error('upload_foto') is-invalid @enderror">
                                            <label class="custom-file-label col-md-12" for="upload_foto" onchange="$ ('#upload_foto').val($(this).val());">
                                                {{ $user->upload_foto ?? 'Upload Foto'}}
                                            </label>
                                            <small>*Upload foto berukuran 3x4</small>
                                            @error('upload_foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upload_file">Upload CV</label>
                                        <div class="custom-file">
                                            <input type="file" id="upload_file" name="upload_file" class="custom-file-input @error('upload_file') is-invalid @enderror" onchange="FileName()">
                                            <label id='upload_file_name' class="custom-label col-md-12" for="upload_file">Upload File</label>
                                            <small>*Upload file CV berupa PDF.</small>
                                            @error('upload_file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5 mb-3">
                                <button type="submit" class="btn btn-success btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('no_hp').addEventListener('input', function(e) {
            let value = e.target.value;
            if (value.startsWith('0')) {
                e.target.value = value.substring(1);
            }
        });
    </script>

    @include('sweetalert::alert')
</body>
@endsection