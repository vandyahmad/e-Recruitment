<div class="container-fluid" id="grad1">
    <div class="card user-details-card">
        <div class="card-body">
            <div class="row justify-content-center mt-3 mb-3">
                <h2><strong>Your Profile Data</strong></h2>
            </div>

            @if($profile)
            <div class="row">
                <div class="col-md-12 mx-0">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{ asset('uploads/images/' . $profile->upload_foto) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">
                            <h5 class="card-title mt-3"><b>{{ $profile->nama_lengkap }}</b></h5>
                        </div>
                    </div>
                    <form action="{{ route('UsersData.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_lengkap" class="font-weight-bold">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $profile->nama_lengkap }}" placeholder="Masukkan Nama Lengkap">
                                            @error('nama_lengkap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nik" class="font-weight-bold">Nomor Induk Kependudukan</label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $profile->nik }}" placeholder="Masukkan NIK anda">
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
                                            <label class="font-weight-bold">Jenis Kelamin</label><br>
                                            <div class="custom-control-inline custom-radio ml-4">
                                                <input type="radio" class="custom-control-input" name="jenis_kelamin" id="laki_laki" value="L" {{$profile->jenis_kelamin=='L'?'checked':''}}>
                                                <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                                            </div>
                                            <div class="custom-control-inline custom-radio ml-4">
                                                <input type="radio" class="custom-control-input" name="jenis_kelamin" id="perempuan" value="P" {{$profile->jenis_kelamin=='P'?'checked':''}}>
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
                                                    <label for="tempat_lahir" class="font-weight-bold">Tempat Lahir</label>
                                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $profile->tempat_lahir }}" placeholder="Masukkan tempat lahir">
                                                    @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir</label>
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror " id="tanggal_lahir" name="tanggal_lahir" value="{{ $profile->tanggal_lahir }}" placeholder="Masukkan tanggal lahir">
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
                                            <label for="agama" class="font-weight-bold">Agama</label>
                                            <select class="form-control" id="agama" name="agama">
                                                <option value="" disabled selected>Pilih Agama</option>
                                                <option value="Islam" {{ $profile->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ $profile->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ $profile->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ $profile->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Budha" {{ $profile->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                <option value="Khonghucu" {{ $profile->agama == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
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
                                            <label for="pref_location" class="font-weight-bold">Preferensi Lokasi</label>
                                            <select name="pref_location" class="form-control pref-location" data-placeholder="Pilih Lokasi" style="width: 100%;">
                                                @foreach($cities as $city)
                                                <option value="{{ $city->name }}" {{ $profile->pref_location == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
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


                                <!-- <div class="form-group">
                                    <label for="alamat">Alamat </label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan alamat tempat tinggal saat ini">{{ $profile->alamat }}</textarea>
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div> -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold">Email</label>
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
                                            <label for="no_hp" class="font-weight-bold">Nomor Handphone / WhatsApp</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror " id="no_hp" name="no_hp" value="{{ $profile->no_hp }}" placeholder="Masukkan nomor yang dapat dihubungi">
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
                                            <label for="pendidikan_terakhir" class="font-weight-bold">Pendidikan Terakhir</label>
                                            <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                                <option value="" disabled selected>Pilih Pendidikan</option>
                                                <option value="SMA" {{ $profile->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA/sederajat</option>
                                                <option value="D3" {{ $profile->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                                <option value="S1" {{ $profile->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2" {{ $profile->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3" {{ $profile->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
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
                                            <label for="jurusan" class="font-weight-bold">Jurusan</label>
                                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ $profile->jurusan }}" placeholder="Masukkan jurusan pendidikan anda">
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
                                            <label for="institusi" class="font-weight-bold">Institusi</label>
                                            <input type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" name="institusi" value="{{ $profile->institusi }}" placeholder="Masukkan institusi pendidikan anda">
                                            @error('institusi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nilai" class="font-weight-bold">Nilai Akhir</label>
                                            <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ $profile->nilai }}" placeholder="Masukkan nilai akhir anda">
                                            @error('nilai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="upload_foto" class="font-weight-bold">Update Foto</label>
                                            <div class="custom-file">
                                                <input type="file" id="upload_foto" name="upload_foto" accept="image/*" class="custom-file-input @error('upload_foto') is-invalid @enderror">

                                                <label class="custom-file-label col-md-12" for="upload_foto" onchange="$ ('#upload_foto').val($(this).val());">
                                                    {{ $profile->upload_foto ?? 'Upload Foto'}}
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
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="upload_file" class="font-weight-bold">Update CV</label>
                                            <div class="custom-file">
                                                <input type="file" id="upload_file" name="upload_file" class="custom-file-input @error('upload_file') is-invalid @enderror" onchange="updateFileName()">
                                                <label class="custom-label col-md-12" for="upload_file" id="fileLabel">
                                                    {{ $profile->upload_file ?? 'Upload File'}}
                                                </label>
                                                <small>*Upload file CV berupa PDF.</small>
                                                @error('upload_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="row mb-5">
                <div class="col-md-12 mx-0">
                    <h5 class="card-title text-center">Anda belum mengisi data pelamar. Klik tombol dibawah untuk melengkapi data pelamar</h5>
                    <div class="mt-5 text-center">
                        <a href="{{ route('UsersData.create') }}" class="btn btn-success">Isi Data</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>