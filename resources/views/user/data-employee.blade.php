<!-- <head>
    <title> Kelengkapan Data Karyawan </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
    </script>
</head> -->



<div class="container">
    <div class="mb-5">
        <h2> Kelengkapan Data Karyawan </h2>
    </div>
    <form id="form" action="{{ route('Employee.update', $profile->employee->user_id) }}" method="POST" enctype="multipart/form-data">
        <ul id="progressbar">
            <li class="active" id="step1" style="width: 50%;">
                <strong> Data Profile </strong>
            </li>
            <!-- <li id="step2" style="width: 31%;"> <strong> Data Keluarga </strong> </li> -->
            <li id="step2" style="width: 50%;"> <strong> Dokumen Karyawan </strong> </li>
        </ul>
        <!-- <div class="progress">
                <div class="pbar"> </div>
            </div> <br> -->
        <fieldset id="next-step-1">
            <div class="container-fluid" id="grad1">
                <div class="card user-details-card">
                    <div class="card-body">
                        <div class="row justify-content-center mt-3 mb-3">
                            <h2><strong>Biodata Karyawan</strong></h2>
                            <hr style="width: 90%;">
                        </div>
                        <div class="row">
                            <div class="col-md-12 mx-0">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('uploads/images/' . $profile->employee->upload_foto) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">
                                        <h3 class="card-title mt-3"><b>{{ $profile->employee->nama_lengkap }}</b></h3>
                                        <hr style="width: 25%;">
                                        <h7 class="card-title">NIP : {{ $profile->employee->nip }}</h7>
                                    </div>
                                </div>

                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_lengkap"><b>Nama Lengkap</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $profile->employee->nama_lengkap }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nik"><b>Nomor Induk Kependudukan</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $profile->employee->nik }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tempat_lahir"><b>Tempat Lahir</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $profile->employee->tempat_lahir }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir"><b>Tanggal Lahir</b><span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror " id="tanggal_lahir" name="tanggal_lahir" value="{{ $profile->employee->tanggal_lahir }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="agama"><b>Agama</b><span class="text-danger">*</span></label>
                                                    <select class="form-control" id="agama" name="agama">
                                                        <option value="" disabled selected>Pilih Agama</option>
                                                        <option value="Islam" {{ $profile->employee->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                        <option value="Kristen" {{ $profile->employee->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                        <option value="Katolik" {{ $profile->employee->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                        <option value="Hindu" {{ $profile->employee->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                        <option value="Budha" {{ $profile->employee->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                        <option value="Khonghucu" {{ $profile->employee->agama == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><b>Jenis Kelamin</b></label><span class="text-danger">*</span><br>
                                                    <div class="custom-control-inline custom-radio ml-4">
                                                        <input type="radio" class="custom-control-input" name="jenis_kelamin" id="laki_laki" value="L" {{$profile->employee->jenis_kelamin=='L'?'checked':''}}>
                                                        <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                                                    </div>
                                                    <div class="custom-control-inline custom-radio ml-4">
                                                        <input type="radio" class="custom-control-input" name="jenis_kelamin" id="perempuan" value="P" {{$profile->employee->jenis_kelamin=='P'?'checked':''}}>
                                                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><b>Status Perkawinan</b><span class="text-danger">*</span></label>
                                                    <select name="status_kawin" class="form-control status_kawin" data-placeholder="" style="width: 100%;">
                                                        <option value="" disabled selected>-- Pilih --</option>
                                                        <option value="Menikah" {{ old('status_kawin', $profile->status_kawin) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                                        <option value="Belum Menikah" {{ old('status_kawin', $profile->status_kawin) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                                        <option value="Cerai" {{ old('status_kawin', $profile->status_kawin) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                                        <option value="Cerai, Menikah Lagi" {{ old('status_kawin', $profile->status_kawin) == 'Cerai, Menikah Lagi' ? 'selected' : '' }}>Cerai, Menikah Lagi</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><b>Status PTKP</b><span class="text-danger">*</span></label>
                                                    <select name="status_ptkp" class="form-control status_ptkp" data-placeholder="" style="width: 100%;">
                                                        <option value="" disabled selected>-- Pilih --</option>
                                                        <option value="TK/0" {{ old('status_ptkp', $profile->employee->status_ptkp) == 'TK/0' ? 'selected' : '' }}>TK/0</option>
                                                        <option value="K/0" {{ old('status_ptkp', $profile->employee->status_ptkp) == 'K/0' ? 'selected' : '' }}>K/0</option>
                                                        <option value="K/1" {{ old('status_ptkp', $profile->employee->status_ptkp) == 'K/1' ? 'selected' : '' }}>K/1</option>
                                                        <option value="K/2" {{ old('status_ptkp', $profile->employee->status_ptkp) == 'K/2' ? 'selected' : '' }}>K/2</option>
                                                        <option value="K/3" {{ old('status_ptkp', $profile->employee->status_ptkp) == 'K/3' ? 'selected' : '' }}>K/3</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><b>Golongan Darah</b></label><span class="text-danger">*</span><br>
                                                    <select class="form-control" id="gol_darah" name="gol_darah">
                                                        <option value="" disabled selected>-- Pilih --</option>
                                                        <option value="A" {{ old('gol_darah', $profile->employee->gol_darah) == 'A' ? 'selected' : '' }}>A</option>
                                                        <option value="B" {{ old('gol_darah', $profile->employee->gol_darah) == 'B' ? 'selected' : '' }}>B</option>
                                                        <option value="AB" {{ old('gol_darah', $profile->employee->gol_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                                        <option value="O" {{ old('gol_darah', $profile->employee->gol_darah) == 'O' ? 'selected' : '' }}>O</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_ibu">Nama Ibu Kandung</label>
                                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ $profile->employee->nama_ibu }}" placeholder="">

                                                        <span class="invalid-feedback" role="alert"></span>
                                                    </div>
                                                </div> -->
                                        </div>

                                        <!-- <div class="form-group">
                                                <label for="alamat">Alamat </label>
                                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan alamat tempat tinggal saat ini">{{ $profile->employee->alamat }}</textarea>
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div> -->

                                        <!-- Alamat KTP -->
                                        <div class="card card-body" style="background-color: #f8f9fa">
                                            <div class="form-group text-center">
                                                <label><strong>Alamat KTP</strong><span class="text-danger">*</span></label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label for="jalan_ktp">Jalan :</label>
                                                    <input type="text" class="form-control" id="jalan_ktp" name="jalan_ktp" value="{{old('jalan_ktp', $profile->jalan_ktp ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="no_rumah_ktp">No :</label>
                                                    <input type="text" class="form-control" id="no_rumah_ktp" name="no_rumah_ktp" value="{{ old('no_rumah_ktp', $profile->no_rumah_ktp ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="rt_ktp">RT:</label>
                                                    <input type="text" class="form-control" id="rt_ktp" name="rt_ktp" value="{{ old('rt_ktp', $profile->rt_ktp ?? '') }}" required maxlength="3">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="rw_ktp">RW:</label>
                                                    <input type="text" class="form-control" id="rw_ktp" name="rw_ktp" value="{{ old('rw_ktp', $profile->rw_ktp ?? '') }}" required maxlength="3">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="kel_ktp">Kelurahan:</label>
                                                    <input type="text" class="form-control" id="kel_ktp" name="kel_ktp" value="{{ old('kel_ktp', $profile->kel_ktp ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="kec_ktp">Kecamatan:</label>
                                                    <input type="text" class="form-control" id="kec_ktp" name="kec_ktp" value="{{ old('kec_ktp', $profile->kec_ktp ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="kota_ktp">Kota:</label>
                                                    <input type="text" class="form-control" id="kota_ktp" name="kota_ktp" value="{{ old('kota_ktp', $profile->kota_ktp ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="prov_ktp">Provinsi:</label>
                                                    <input type="text" class="form-control" id="prov_ktp" name="prov_ktp" value="{{ old('prov_ktp', $profile->prov_ktp ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="kode_pos_ktp">Kode Pos:</label>
                                                    <input type="text" class="form-control" id="kode_pos_ktp" name="kode_pos_ktp" value="{{ old('kode_pos_ktp', $profile->kode_pos_ktp ?? '') }}" required maxlength="5">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alamat Domisili -->
                                        <div class="card card-body" style="background-color: #f8f9fa">
                                            <div class="form-group mt-4 text-center">
                                                <label><strong>Alamat Domisili</strong><span class="text-danger">*</span></label>
                                            </div>
                                            <input type="hidden" name="sama_dengan_ktp" value="no">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sama_dengan_ktp" name="sama_dengan_ktp" value="yes" {{ old('sama_dengan_ktp', $profile->sama_dengan_ktp ?? 'no') == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sama_dengan_ktp">Sama dengan alamat KTP</label>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label for="jalan_domisili">Jalan:</label>
                                                    <input type="text" class="form-control" id="jalan_domisili" name="jalan_domisili" value="{{ old('jalan_domisili', $profile->jalan_domisili ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="no_rumah_domisili">No:</label>
                                                    <input type="text" class="form-control" id="no_rumah_domisili" name="no_rumah_domisili" value="{{ old('no_rumah_domisili', $profile->no_rumah_domisili ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="rt_domisili">RT:</label>
                                                    <input type="text" class="form-control" id="rt_domisili" name="rt_domisili" value="{{ old('rt_domisili', $profile->rt_domisili ?? '') }}" required maxlength="3">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="rw_domisili">RW:</label>
                                                    <input type="text" class="form-control" id="rw_domisili" name="rw_domisili" value="{{ old('rw_domisili', $profile->rw_domisili ?? '') }}" required maxlength="3">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="kel_domisili">Kelurahan:</label>
                                                    <input type="text" class="form-control" id="kel_domisili" name="kel_domisili" value="{{ old('kel_domisili', $profile->kel_domisili ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="kec_domisili">Kecamatan:</label>
                                                    <input type="text" class="form-control" id="kec_domisili" name="kec_domisili" value="{{ old('kec_domisili', $profile->kec_domisili ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="kota_domisili">Kota:</label>
                                                    <input type="text" class="form-control" id="kota_domisili" name="kota_domisili" value="{{ old('kota_domisili', $profile->kota_domisili ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="prov_domisili">Provinsi:</label>
                                                    <input type="text" class="form-control" id="prov_domisili" name="prov_domisili" value="{{ old('prov_domisili', $profile->prov_domisili ?? '') }}" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="kode_pos_domisili">Kode Pos:</label>
                                                    <input type="text" class="form-control" id="kode_pos_domisili" name="kode_pos_domisili" value="{{ old('kode_pos_domisili', $profile->kode_pos_domisili ?? '') }}" required maxlength="5">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"><b>Email</b><span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror " id="email" name="email" value="{{ auth()->user()->email}}" readonly placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_hp"><b>Nomor Handphone / WhatsApp</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror " id="no_hp" name="no_hp" value="{{ $profile->employee->no_hp }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_kk"><b>No. Kartu Keluarga</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" name="no_kk" value="{{ $profile->employee->no_kk }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_npwp"><b>No. NPWP</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_npwp') is-invalid @enderror" id="no_npwp" name="no_npwp" value="{{ $profile->employee->no_npwp }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_bpjs_kesehatan"><b>No. BPJS Kesehatan</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_bpjs_kesehatan') is-invalid @enderror" id="no_bpjs_kesehatan" name="no_bpjs_kesehatan" value="{{ $profile->employee->no_bpjs_kesehatan }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_bpjs_ketenagakerjaan"><b>No. BPJS Ketenagakerjaan</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_bpjs_ketenagakerjaan') is-invalid @enderror" id="no_bpjs_ketenagakerjaan" name="no_bpjs_ketenagakerjaan" value="{{ $profile->employee->no_bpjs_ketenagakerjaan }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="row"> -->
                                        <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="no_sim"><b>No. SIM A/C</b></label>
                                                        <input type="text" class="form-control @error('no_sim') is-invalid @enderror" id="no_sim" name="no_sim" value="{{ $profile->employee->no_sim }}" placeholder="">
                                                        <span class="invalid-feedback" role="alert">
                                                        </span>
                                                    </div>
                                                </div> -->
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label for="sim_a"><b>SIM A</b></label>
                                                <input type="text" class="form-control  @error('sim_a') is-invalid @enderror"" id=" sim_a" name="sim_a" value="{{ old('sim_a', $profile->sim_a) }}" minlength="14" maxlength="16">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="sim_b"><b>SIM B</b></label>
                                                <input type="text" class="form-control  @error('sim_b') is-invalid @enderror"" id=" sim_b" name="sim_b" value="{{ old('sim_a', $profile->sim_b) }}" minlength="14" maxlength="16">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="sim_c"><b>SIM C</b></label>
                                                <input type="text" class="form-control  @error('sim_c') is-invalid @enderror"" id=" sim_c" name="sim_c" value="{{ old('sim_a', $profile->sim_c) }}" minlength="14" maxlength="16">
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_bank"><b>Nama Bank Untuk Payroll</b><span class="text-danger">*</span></label>
                                                    <select class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" name="nama_bank">
                                                        @if($profile->employee->company_code == 'ECO')
                                                        <option value="BCA" {{ old('nama_bank', $profile->employee->nama_bank) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                        @elseif($profile->employee->company_code == 'TBI')
                                                        <option value="" disabled selected>Select Bank</option>
                                                        <option value="BCA" {{ old('nama_bank', $profile->employee->nama_bank) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                        <option value="MANDIRI" {{ old('nama_bank', $profile->employee->nama_bank) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                                        @elseif($profile->employee->company_code == 'PEST')
                                                        <option value="MANDIRI" {{ old('nama_bank', $profile->employee->nama_bank) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                                        @else
                                                        <option value="" disabled selected>Select Bank</option>
                                                        <option value="BCA" {{ old('nama_bank', $profile->employee->nama_bank) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                        <option value="MANDIRI" {{ old('nama_bank', $profile->employee->nama_bank) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                                        @endif
                                                    </select>
                                                    @error('nama_bank')
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
                                                    <label for="no_rekening"><b>No. Rekening</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ $profile->employee->no_rekening }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_rekening"><b>Rekening Atas Nama</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nama_rekening') is-invalid @enderror" id="nama_rekening" name="nama_rekening" value="{{ $profile->employee->nama_rekening }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pendidikan_terakhir"><b>Pendidikan Terakhir</b><span class="text-danger">*</span></label>
                                                    <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                                        <option value="" disabled selected>Pilih Pendidikan</option>
                                                        <option value="SMA" {{ $profile->employee->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA/sederajat</option>
                                                        <option value="D3" {{ $profile->employee->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                                        <option value="S1" {{ $profile->employee->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                                                        <option value="S2" {{ $profile->employee->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                                                        <option value="S3" {{ $profile->employee->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
                                                    </select>
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jurusan"><b>Jurusan</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ $profile->employee->jurusan }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="institusi"><b>Institusi</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" name="institusi" value="{{ $profile->employee->institusi }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nilai"><b>Nilai Akhir</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ $profile->employee->nilai }}" placeholder="">
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="upload_foto"><b>Update Foto</b><span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" id="upload_foto" name="upload_foto" accept="image/*" class="custom-file-input @error('upload_foto') is-invalid @enderror">

                                                        <label class="custom-file-label col-md-12" for="upload_foto" onchange="$ ('#upload_foto').val($(this).val());">
                                                            {{ $profile->employee->upload_foto ?? 'Upload Foto'}}
                                                        </label>

                                                        <small>*Upload foto berukuran 3x4</small>
                                                        <span class="invalid-feedback" role="alert">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="upload_file"><b>Update CV</b><span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" id="upload_file" name="upload_file" class="custom-file-input @error('upload_file') is-invalid @enderror" onchange="updateFileName()">
                                                        <label class="custom-label col-md-12" for="upload_file" id="fileLabel">
                                                            {{ $profile->employee->upload_file ?? 'Upload File'}}
                                                        </label>
                                                        <small>*Upload CV berupa PDF.</small>
                                                        <span class="invalid-feedback" role="alert">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div> -->

                            </div>
                        </div>
                        <div id="error-messages-biodata" class="text-danger"></div>
                    </div>
                </div>
            </div>
            <input type="button" name="next-step" id="next-step-1" class="next-step" value="Next Step" />
        </fieldset>

        <!-- <fieldset id="next-step-2">
                <div class="container-fluid" id="grad1">
                    <div class="card user-details-card">
                        <div class="card-body">
                            <div class="row justify-content-center mt-3 mb-3">
                                <h2><strong>Data Keluarga Karyawan</strong></h2>
                            </div>
                            @csrf
                            @method('PUT')
                            <div id="family-data-container">
                                @foreach($employee_families as $index => $employee_family)
                                <div class="card family-data-card" data-index="{{ $index }}">
                                    <div class="card-body">
                                        <h4 class="card-title">Data Keluarga {{ $index + 1 }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hubungan_fam_{{ $index }}">Hubungan Keluarga</label>
                                                    <select class="form-control @error('hubungan_fam.' . $index) is-invalid @enderror" id="hubungan_fam_{{ $index }}" name="hubungan_fam[{{ $index }}]">
                                                        <option value="" disabled selected>Pilih Hubungan Keluarga</option>
                                                        <option value="Anak" {{ $employee_family->hubungan_fam == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                                        <option value="Anak" {{ $employee_family->hubungan_fam == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                                        <option value="Suami" {{ $employee_family->hubungan_fam == 'Suami' ? 'selected' : '' }}>Suami</option>
                                                        <option value="Istri" {{ $employee_family->hubungan_fam == 'Istri' ? 'selected' : '' }}>Istri</option>
                                                        <option value="Anak" {{ $employee_family->hubungan_fam == 'Anak' ? 'selected' : '' }}>Anak</option>
                                                        <option value="Anak" {{ $employee_family->hubungan_fam == 'Kerabat' ? 'selected' : '' }}>Kerabat</option>
                                                    </select>
                                                    @error('hubungan_fam.' . $index)
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
                                                    <label for="nama_fam_{{ $index }}">Nama</label>
                                                    <input type="text" class="form-control @error('nama_fam.' . $index) is-invalid @enderror" id="nama_fam_{{ $index }}" name="nama_fam[{{ $index }}]" value="{{ $employee_family->nama_fam }}" placeholder="">
                                                    @error('nama_fam.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nik_fam_{{ $index }}">NIK</label>
                                                    <input type="text" class="form-control @error('nik_fam.' . $index) is-invalid @enderror" id="nik_fam_{{ $index }}" name="nik_fam[{{ $index }}]" value="{{ $employee_family->nik_fam }}" placeholder="">
                                                    @error('nik_fam.' . $index)
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
                                                    <label for="tempat_lahir_fam_{{ $index }}">Tempat Lahir</label>
                                                    <input type="text" class="form-control @error('tempat_lahir_fam.' . $index) is-invalid @enderror" id="tempat_lahir_fam_{{ $index }}" name="tempat_lahir_fam[{{ $index }}]" value="{{ $employee_family->tempat_lahir_fam }}" placeholder="">
                                                    @error('tempat_lahir_fam.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir_fam_{{ $index }}">Tanggal Lahir</label>
                                                    <input type="date" class="form-control @error('tanggal_lahir_fam.' . $index) is-invalid @enderror" id="tanggal_lahir_fam_{{ $index }}" name="tanggal_lahir_fam[{{ $index }}]" value="{{ $employee_family->tanggal_lahir_fam }}" placeholder="">
                                                    @error('tanggal_lahir_fam.' . $index)
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
                                                    <label for="pendidikan_terakhir_fam_{{ $index }}">Pendidikan Terakhir</label>
                                                    <input type="text" class="form-control @error('pendidikan_terakhir_fam.' . $index) is-invalid @enderror" id="pendidikan_terakhir_fam_{{ $index }}" name="pendidikan_terakhir_fam[{{ $index }}]" value="{{ $employee_family->pendidikan_terakhir_fam }}" placeholder="">
                                                    @error('pendidikan_terakhir_fam.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pekerjaan_fam_{{ $index }}">Pekerjaan</label>
                                                    <input type="text" class="form-control @error('pekerjaan_fam.' . $index) is-invalid @enderror" id="pekerjaan_fam_{{ $index }}" name="pekerjaan_fam[{{ $index }}]" value="{{ $employee_family->pekerjaan_fam }}" placeholder="">
                                                    @error('pekerjaan_fam.' . $index)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat_fam_{{ $index }}">Alamat </label>
                                            <textarea class="form-control @error('alamat_fam_' . $index . '') is-invalid @enderror" id="alamat_fam_{{ $index }}" rows="3" name="alamat_fam[{{ $index }}]" placeholder="">{{ $employee_family->alamat_fam }}</textarea>
                                            @error('alamat_fam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="family_ids[{{ $index }}]" value="{{ $employee_family->id }}">
                                        <input type="hidden" name="emergency_contact_ids[{{ $index }}]" id="emergency_contact_ids_{{ $index }}" value="{{ $employee_family->emergency_contact }}">

                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="emergency-contact-select">Emergency Contact</label>
                                <select class="form-control" id="emergency-contact-select" name="emergency_contact">
                                    <option value="" disabled selected>Select Emergency Contact</option>
                                </select>
                            </div>
                        </div>
                        <div id="error-messages-family" class="text-danger"></div>
                        <div class="text-center">
                            <button type="button" id="add-family-data" class="btn btn-primary mt-3 mb-3"><i class="fas fa-plus"></i> Tambah Data</button>
                        </div>
                    </div>
                </div>
                <input type="button" name="next-step" class="next-step" value="Next Step" />
                <input type="hidden" id="employeeId" value="{{ $profile->employee->id }}">
                <input type="button" name="pre-step" class="pre-step" value="Prev Step" />
            </fieldset> -->

        <fieldset id="next-step-2">
            <div class="container-fluid" id="grad1">
                <div class="card user-details-card">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div id="dokumen-data-container">
                            <div class="row justify-content-center mt-3 mb-3">
                                <h2><strong>Dokumen Karyawan</strong></h2>
                            </div>
                            @foreach($employee_documents as $employeeDocument)
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center mb-5">Mohon lengkapi dokumen-dokumen dibawah ini</h6>

                                    <div class="form-group">
                                        <label for="doc_ktp"><b>Upload KTP</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_ktp" name="doc_ktp" accept="image/*" class="custom-file-input @error('doc_ktp') is-invalid @enderror" value="{{ $employeeDocument->doc_ktp }}">
                                            <label class="custom-file-label col-md-12" for="doc_ktp">
                                                {!! $employeeDocument && $employeeDocument->doc_ktp ? $employeeDocument->doc_ktp . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_npwp"><b>Upload NPWP</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_npwp" name="doc_npwp" accept="image/*" class="custom-file-input @error('doc_npwp') is-invalid @enderror" value="{{ $employeeDocument->doc_npwp }}">
                                            <label class="custom-file-label col-md-12" for="doc_npwp">
                                                {!! $employeeDocument && $employeeDocument->doc_npwp ? $employeeDocument->doc_npwp . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_kk"><b>Upload Kartu Keluarga</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_kk" name="doc_kk" accept="image/*" class="custom-file-input @error('doc_kk') is-invalid @enderror" value="{{ $employeeDocument->doc_kk }}">
                                            <label class="custom-file-label col-md-12" for="doc_kk">
                                                {!! $employeeDocument && $employeeDocument->doc_kk ? $employeeDocument->doc_kk . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="doc_sim"><b>Upload SIM</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_sim" name="doc_sim" accept="image/*" class="custom-file-input @error('doc_sim') is-invalid @enderror" value="{{ $employeeDocument->doc_sim }}">
                                            <label class="custom-file-label col-md-12" for="doc_sim">
                                                {!! $employeeDocument && $employeeDocument->doc_sim ? $employeeDocument->doc_sim . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>

                                            <span class="invalid-feedback" role="alert">
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_buku_rekening"><b>Upload Buku Rekening</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_buku_rekening" name="doc_buku_rekening" accept="image/*" class="custom-file-input @error('doc_buku_rekening') is-invalid @enderror" value="{{ $employeeDocument->doc_buku_rekening }}">
                                            <label class="custom-file-label col-md-12" for="doc_buku_rekening">
                                                {!! $employeeDocument && $employeeDocument->doc_buku_rekening ? $employeeDocument->doc_buku_rekening . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_paklaring"><b>Upload Paklaring</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_paklaring" name="doc_paklaring" accept="image/*" class="custom-file-input @error('doc_paklaring') is-invalid @enderror" value="{{ $employeeDocument->doc_paklaring }}">
                                            <label class="custom-file-label col-md-12" for="doc_paklaring">
                                                {!! $employeeDocument && $employeeDocument->doc_paklaring ? $employeeDocument->doc_paklaring . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_ijazah_terakhir"><b>Upload Ijazah Terakhir</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_ijazah_terakhir" name="doc_ijazah_terakhir" accept="image/*" class="custom-file-input @error('doc_ijazah_terakhir') is-invalid @enderror" value="{{ $employeeDocument->doc_ijazah_terakhir }}">
                                            <label class="custom-file-label col-md-12" for="doc_ijazah_terakhir">
                                                {!! $employeeDocument && $employeeDocument->doc_ijazah_terakhir ? $employeeDocument->doc_ijazah_terakhir . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_transkrip_nilai"><b>Upload Transkrip Nilai</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_transkrip_nilai" name="doc_transkrip_nilai" accept="image/*" class="custom-file-input @error('doc_transkrip_nilai') is-invalid @enderror" value="{{ $employeeDocument->doc_transkrip_nilai }}">
                                            <label class="custom-file-label col-md-12" for="doc_transkrip_nilai">
                                                {!! $employeeDocument && $employeeDocument->doc_transkrip_nilai ? $employeeDocument->doc_transkrip_nilai . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_bpjs_kesehatan"><b>Upload Kartu BPJS Kesehatan</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_bpjs_kesehatan" name="doc_bpjs_kesehatan" accept="image/*" class="custom-file-input @error('doc_bpjs_kesehatan') is-invalid @enderror" value="{{ $employeeDocument->doc_bpjs_kesehatan }}">
                                            <label class="custom-file-label col-md-12" for="doc_bpjs_kesehatan">
                                                {!! $employeeDocument && $employeeDocument->doc_bpjs_kesehatan ? $employeeDocument->doc_bpjs_kesehatan . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_bpjs_ketenagakerjaan"><b>Upload Kartu BPJS Ketenagakerjaan</b><span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_bpjs_ketenagakerjaan" name="doc_bpjs_ketenagakerjaan" accept="image/*" class="custom-file-input @error('doc_bpjs_ketenagakerjaan') is-invalid @enderror" value="{{ $employeeDocument->doc_bpjs_ketenagakerjaan }}">
                                            <label class="custom-file-label col-md-12" for="doc_bpjs_ketenagakerjaan">
                                                {!! $employeeDocument && $employeeDocument->doc_bpjs_ketenagakerjaan ? $employeeDocument->doc_bpjs_ketenagakerjaan . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_surat_nikah"><b>Upload Surat Nikah</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_surat_nikah" name="doc_surat_nikah" accept="image/*" class="custom-file-input @error('doc_surat_nikah') is-invalid @enderror" value="{{ $employeeDocument->doc_surat_nikah }}">
                                            <label class="custom-file-label col-md-12" for="doc_surat_nikah">
                                                {!! $employeeDocument && $employeeDocument->doc_surat_nikah ? $employeeDocument->doc_surat_nikah . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_surat_vaksin"><b>Upload Surat Vaksin</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_surat_vaksin" name="doc_surat_vaksin" accept="image/*" class="custom-file-input @error('doc_surat_vaksin') is-invalid @enderror" value="{{ $employeeDocument->doc_surat_vaksin }}">
                                            <label class="custom-file-label col-md-12" for="doc_surat_vaksin">
                                                {!! $employeeDocument && $employeeDocument->doc_surat_vaksin ? $employeeDocument->doc_surat_vaksin . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_akta_kelahiran_anak_1"><b>Upload Akta Kelahiran Anak 1</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_akta_kelahiran_anak_1" name="doc_akta_kelahiran_anak_1" accept="image/*" class="custom-file-input @error('doc_akta_kelahiran_anak_1') is-invalid @enderror" value="{{ $employeeDocument->doc_akta_kelahiran_anak_1 }}">
                                            <label class="custom-file-label col-md-12" for="doc_akta_kelahiran_anak_1">
                                                {!! $employeeDocument && $employeeDocument->doc_akta_kelahiran_anak_1 ? $employeeDocument->doc_akta_kelahiran_anak_1 . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_akta_kelahiran_anak_2"><b>Upload Akta Kelahiran Anak 2</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_akta_kelahiran_anak_2" name="doc_akta_kelahiran_anak_2" accept="image/*" class="custom-file-input @error('doc_akta_kelahiran_anak_2') is-invalid @enderror" value="{{ $employeeDocument->doc_akta_kelahiran_anak_2 }}">
                                            <label class="custom-file-label col-md-12" for="doc_akta_kelahiran_anak_2">
                                                {!! $employeeDocument && $employeeDocument->doc_akta_kelahiran_anak_2 ? $employeeDocument->doc_akta_kelahiran_anak_2 . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_akta_kelahiran_anak_3"><b>Upload Akta Kelahiran Anak 3</b></label>
                                        <div class="custom-file">
                                            <input type="file" id="doc_akta_kelahiran_anak_3" name="doc_akta_kelahiran_anak_3" accept="image/*" class="custom-file-input @error('doc_akta_kelahiran_anak_3') is-invalid @enderror" value="{{ $employeeDocument->doc_akta_kelahiran_anak_3 }}">
                                            <label class="custom-file-label col-md-12" for="doc_akta_kelahiran_anak_3">
                                                {!! $employeeDocument && $employeeDocument->doc_akta_kelahiran_anak_3 ? $employeeDocument->doc_akta_kelahiran_anak_3 . ' <i class="fas fa-check"></i>' : '--Pilih File--' !!}
                                            </label>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" name="next-step" class="next-step" value="Next Step" />
            <input type="hidden" id="employeeId" value="{{ $profile->employee->id }}">
            <input type="button" name="pre-step" class="pre-step" value="Prev Step" />
        </fieldset>

        <fieldset id="next-step-3">
            <div class="container-fluid" id="grad1">
                <div class="card user-details-card">
                    <div class="card-body">
                        <div class="finish">
                            <h5 class="text-center">Terimakasih telah melengkapi data anda</h5>
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" name="pre-step" class="pre-step" value="Back" />
            <input type="button" value="Home" class="next-step" onclick="window.location.href='/detail-profile'" />
        </fieldset>
        <!-- </form> -->
    </form>
</div>
<script>
    $(document).ready(function() {
        var currentGfgStep, nextGfgStep, preGfgStep;
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;
        setProgressBar(current);

        $(".next-step").click(function() {
            var form = $(this).closest('form'); // Get the parent form of the button
            var currentFieldset = $(this).closest('fieldset'); // Get the current fieldset
            var progressBar = $("#progressbar");

            if (currentFieldset.attr('id') === "next-step-1") {
                // Submit the form data via AJAX for step 1
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        if (response.success) {
                            moveToNextStep(currentFieldset, progressBar);
                        } else {
                            BiodatadisplayErrors(form, response.errors);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Mohon isi data dengan lengkap',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                // } else if (currentFieldset.attr('id') === "next-step-2") {
                //     var employeeId = $('#employeeId').val();
                //     $.ajax({
                //         type: 'POST',
                //         url: '{{ route("EmployeeFamily.update", ":id") }}'.replace(':id', employeeId),
                //         data: form.serialize(), // Serialize form data
                //         success: function(response) {
                //             // console.log(response);
                //             if (response.success) {
                //                 moveToNextStep(currentFieldset, progressBar);
                //                 // addEmployeeDocument();
                //             } else {
                //                 FamilydisplayErrors(form, response.errors);
                //             }
                //         },
                //         error: function(xhr, status, error) {
                //             console.error(xhr.responseText);
                //         }
                //     });
            } else if (currentFieldset.attr('id') === "next-step-2") {
                var employeeId = $('#employeeId').val();
                var formData = new FormData(form[0]); // Create a FormData object from the form
                $.ajax({
                    type: 'POST',
                    url: '{{ route("EmployeeDocument.update", ":id") }}'.replace(':id', employeeId),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            });
                            moveToNextStep(currentFieldset, progressBar);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: 'Mohon lengkapi dokumen anda',
                            });
                            DocDisplayErrors(form, response.errors);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        $(".pre-step").click(function() {
            currentGfgStep = $(this).parent();
            preGfgStep = $(this).parent().prev();
            $("#progressbar li").eq($("fieldset").index(currentGfgStep)).removeClass("active");
            preGfgStep.show();
            currentGfgStep.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;
                    currentGfgStep.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    preGfgStep.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(currentStep) {
            var percent = parseFloat(100 / steps) * current;
            percent = percent.toFixed();
            $(".pbar").css("width", percent + "%");
        }

        function moveToNextStep(currentFieldset, progressBar) {
            currentGfgStep = currentFieldset;
            nextGfgStep = currentFieldset.next();
            progressBar.find("li").eq($("fieldset").index(nextGfgStep)).addClass("active");
            nextGfgStep.show();
            currentGfgStep.animate({
                opacity: 0
            }, {
                step: function(now) {
                    var opacity = 1 - now;
                    currentGfgStep.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    nextGfgStep.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
        }

        function displayErrors(form, errors) {
            // Clear previous errors
            form.find('.error-messages').html('');
            $.each(errors, function(index, value) {
                var field = form.find('[name="' + index + '"]');
                // console.log(value);
                field.next('.error-messages').html('<div class="text-danger">' + value + '</div>');
            });
        }

        function FamilydisplayErrors(form, errors) {
            // Clear previous errors
            $('#error-messages-family').html('');
            // var field = form.find('[name="nama_fam[4]"]');
            // field.next('#error-messages-family').html('<div class="text-danger">' + errors[0] + '</div>');
            $.each(errors, function(index, value) {
                // console.log(index);
                // var field = form.find('[name="' +value+ index + '"]');
                // console.log('FamilydisplayErrors');
                // field.next('#error-messages-family').append('<div class="text-danger">' + value + '</div>');
                // console.log(field);
                $('#error-messages-family').append('<div class="text-danger">' + value + '</div>');
            });
        }

        function BiodatadisplayErrors(form, errors) {
            // Clear previous errors
            $('.invalid-feedback').html('');
            $('.form-control').removeClass('is-invalid'); // Remove previous error classes

            $.each(errors, function(index, value) {
                var field = form.find('[name="' + index + '"]');
                // console.log('Field:', field); // Debug: Log the field being processed
                if (field.length > 0) {
                    field.addClass('is-invalid'); // Add bootstrap's is-invalid class to the field
                    field.next('.invalid-feedback').html('<div class="text-danger">' + value + '</div>');
                }
            });
        }

        function DocDisplayErrors(form, errors) {
            // Clear previous errors
            $('.invalid-feedback').html('');
            $('.form-control, .custom-file-input').removeClass('is-invalid'); // Remove previous error classes

            $.each(errors, function(index, value) {
                var field = form.find('[name="' + index + '"]');
                if (field.length > 0) {
                    field.addClass('is-invalid'); // Add bootstrap's is-invalid class to the field
                    if (field.hasClass('custom-file-input')) {
                        // For custom file inputs
                        console.log(value);
                        field.closest('.custom-file').find('.invalid-feedback').html('<div class="text-danger">' + value + '</div>');
                    } else {
                        // For other inputs
                        field.next('.invalid-feedback').html('<div class="text-danger">' + value + '</div>');
                    }
                }
            });
        }


        var familyIndex = $('.family-data-card').length;
        var initialEmergencyContact = null;

        $('#add-family-data').click(function() {
            var newFamilyData = `
            <div class="card family-data-card" data-index="${familyIndex}">
                <div class="card-body">
                    <h4 class="card-title">Data Keluarga ${familyIndex + 1}</h4>
                    <div class="row">
                        <button type="button" class="btn btn-danger btn-sm delete-family-data" data-index="${familyIndex}" style="position: absolute; top: 5px; right: 5px;">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hubungan_fam_${familyIndex}">Hubungan Keluarga</label>
                                <select class="form-control" id="hubungan_fam_${familyIndex}" name="hubungan_fam[${familyIndex}]">
                                    <option value="" disabled selected>Pilih Hubungan Keluarga</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_fam_${familyIndex}">Nama</label>
                                <input type="text" class="form-control" id="nama_fam_${familyIndex}" name="nama_fam[${familyIndex}]" placeholder="">
                                <div class="error-messages"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik_fam_${familyIndex}">NIK</label>
                                <input type="text" class="form-control" id="nik_fam_${familyIndex}" name="nik_fam[${familyIndex}]" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_fam_${familyIndex}">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir_fam_${familyIndex}" name="tempat_lahir_fam[${familyIndex}]" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_fam_${familyIndex}">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir_fam_${familyIndex}" name="tanggal_lahir_fam[${familyIndex}]" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_terakhir_fam_${familyIndex}">Pendidikan Terakhir</label>
                                <input type="text" class="form-control" id="pendidikan_terakhir_fam_${familyIndex}" name="pendidikan_terakhir_fam[${familyIndex}]" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_fam_${familyIndex}">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan_fam_${familyIndex}" name="pekerjaan_fam[${familyIndex}]" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_fam_${familyIndex}">Alamat</label>
                        <textarea class="form-control" id="alamat_fam_${familyIndex}" name="alamat_fam[${familyIndex}]"></textarea>
                    </div>

                    <!-- Hidden input for emergency contact -->
                    <input type="hidden" name="emergency_contact_ids[${familyIndex}]" id="emergency_contact_ids_${familyIndex}" value="no">

                </div>
            </div>`;

            $('#family-data-container').append(newFamilyData);
            updateEmergencyContactDropdown();
            familyIndex++;
        });

        // Delete family data form
        $('#family-data-container').on('click', '.delete-family-data', function() {
            var index = $(this).data('index');
            $(`.family-data-card[data-index="${index}"]`).remove();
            familyIndex--;
            $('#add-family-data').prop('disabled', false); // Enable the add button after deletion
            updateEmergencyContactDropdown();
        });

        // Update emergency contact dropdown
        function updateEmergencyContactDropdown() {
            var dropdown = $('#emergency-contact-select');
            dropdown.empty();
            dropdown.append('<option value="" disabled>Select Emergency Contact</option>');
            $('.family-data-card').each(function() {
                var index = $(this).data('index');
                var name = $(`#nama_fam_${index}`).val() || `Data Keluarga ${index + 1}`;

                var isSelected = $(`#emergency_contact_ids_${index}`).val() === 'yes';
                // console.log(`Index: ${index}, Name: ${name}, isSelected: ${isSelected}`);
                // console.log($(`#emergency_contact_ids${index}`).val());
                dropdown.append(`<option value="${index}" ${isSelected ? 'selected' : ''}>${name}</option>`);
            });

            setInitialEmergencyContact();
        }

        function setInitialEmergencyContact() {
            var dropdown = $('#emergency-contact-select');
            $('.family-data-card').each(function() {
                var index = $(this).data('index');
                var emergencyContactElement = $(`#emergency_contact_${index}`);
                if (emergencyContactElement.length) {
                    var isEmergencyContact = emergencyContactElement.val() === 'yes';
                    // console.log(`Index: ${index}, Emergency Contact Value: ${emergencyContactElement.val()}`);
                    if (isEmergencyContact) {
                        var name = $(`#nama_fam_${index}`).val() || `Data Keluarga ${index + 1}`;
                        dropdown.val(index); // Set the selected value in the dropdown
                        dropdown.find('option:selected').text(`${name} (Yes)`);
                    }
                } else {
                    // console.log(`Element with ID #emergency_contact_${index} not found.`);
                }
            });
        }

        updateEmergencyContactDropdown();
        setInitialEmergencyContact();

        $('#emergency-contact-select').change(function() {
            var selectedIndex = $(this).val();
            $('[id^="emergency_contact_"]').val('no');
            if (selectedIndex) {
                $(`#emergency_contact_${selectedIndex}`).val('yes');
            }
        });


        // Show selected file name in the input field's label
        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).siblings('.custom-file-label').text(inputFile.files[0].name);
        });


        // var documentIndex = 0;
        // $('#add-document-data').click(function() {
        //     addEmployeeDocument();
        //     documentIndex++;
        // });

        // function addEmployeeDocument() {
        //     var newDocumentData = `
        // <div class="row">
        //     <div class="col-md-6">
        //         <div class="form-group">
        //             <label for="doc_ktp_${documentIndex}">Upload KTP</label>
        //             <input type="file" class="form-control" id="doc_ktp_${documentIndex}" name="doc_ktp[${documentIndex}]">
        //         </div>
        //     </div>
        // </div>
        // <div class="row">
        //     <div class="col-md-6">
        //         <div class="form-group">
        //             <label for="doc_npwp_${documentIndex}">Upload NPWP</label>
        //             <input type="file" class="form-control" id="doc_npwp_${documentIndex}" name="doc_npwp[${documentIndex}]">
        //         </div>
        //     </div>
        // </div>
        // <div class="row">
        //     <div class="col-md-6">
        //         <div class="form-group">
        //             <label for="doc_kk_${documentIndex}">Upload KK</label>
        //             <input type="file" class="form-control" id="doc_kk_${documentIndex}" name="doc_kk[${documentIndex}]">
        //         </div>
        //     </div>
        // </div>
        // `;

        //     $('#document-data-container').append(newDocumentData);

        //     documentIndex++;
        // }
    });

    document.getElementById('sama_dengan_ktp').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('jalan_domisili').value = document.getElementById('jalan_ktp').value;
            document.getElementById('no_rumah_domisili').value = document.getElementById('no_rumah_ktp').value;
            document.getElementById('rt_domisili').value = document.getElementById('rt_ktp').value;
            document.getElementById('rw_domisili').value = document.getElementById('rw_ktp').value;
            document.getElementById('kel_domisili').value = document.getElementById('kel_ktp').value;
            document.getElementById('kec_domisili').value = document.getElementById('kec_ktp').value;
            document.getElementById('kota_domisili').value = document.getElementById('kota_ktp').value;
            document.getElementById('prov_domisili').value = document.getElementById('prov_ktp').value;
            document.getElementById('kode_pos_domisili').value = document.getElementById('kode_pos_ktp').value;
        } else {
            document.getElementById('jalan_domisili').value = '';
            document.getElementById('no_rumah_domisili').value = '';
            document.getElementById('rt_domisili').value = '';
            document.getElementById('rw_domisili').value = '';
            document.getElementById('kel_domisili').value = '';
            document.getElementById('kec_domisili').value = '';
            document.getElementById('kota_domisili').value = '';
            document.getElementById('prov_domisili').value = '';
            document.getElementById('kode_pos_domisili').value = '';
        }
    });
</script>