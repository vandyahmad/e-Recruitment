@extends('user.profile-pelamar')
@section('user-content')

<body style="overflow-x: auto;">
    <div class="container-fluid" id="grad1">
        <div class="card user-details-card">
            <div class="card-body">
                <div class="row justify-content-center mt-3 mb-3">
                    <h2><strong>Form Interview</strong></h2>
                </div>

                <ul id="progressbar" style="margin-left: -40px;">
                    <li class="active" id="step1" style="width:20%;"><strong> Identitas Diri </strong></li>
                    <li id="step2" style="width: 20%;"> <strong> Data Keluarga </strong> </li>
                    <li id="step3" style="width: 20%;"> <strong> Riwayat Pendidikan </strong> </li>
                    <li id="step4" style="width: 20%;"> <strong> Riwayat Pekerjaan </strong> </li>
                    <li id="step5" style="width: 20%;"> <strong> Pertanyaan Singkat</strong> </li>
                </ul>

                <!-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->


                <form id="form-interview">
                    @csrf

                    <fieldset id="next-step-1" style="display: block;">
                        <div class="form-section card">
                            <div class="card-body">

                                <h5 class="card-header text-center mb-3"><strong>IDENTITAS DIRI</strong></h5>
                                <!-- <div class="form-group">
                                    <label for="info_lowongan">Sumber info lowongan:</label>
                                    <select class="form-control" id="info_lowongan" name="info_lowongan" required>
                                        <option value="" disabled {{ old('info_lowongan', $userData->info_lowongan) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                        <option value="Referensi" {{ old('info_lowongan', $userData->info_lowongan) == 'Referensi' ? 'selected' : '' }}>Referensi</option>
                                        <option value="Website" {{ old('info_lowongan', $userData->info_lowongan) == 'Website' ? 'selected' : '' }}>Website</option>
                                        <option value="Linkedin" {{ old('info_lowongan', $userData->info_lowongan) == 'Linkedin' ? 'selected' : '' }}>Linkedin</option>
                                        <option value="JobStreet" {{ old('info_lowongan', $userData->info_lowongan) == 'JobStreet' ? 'selected' : '' }}>JobStreet</option>
                                        <option value="Telegram" {{ old('info_lowongan', $userData->info_lowongan) == 'Telegram' ? 'selected' : '' }}>Telegram</option>
                                        <option value="Instagram" {{ old('info_lowongan', $userData->info_lowongan) == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                        <option value="Lainnya" {{ old('info_lowongan', $userData->info_lowongan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="nama_panggilan">Nama Panggilan:</label>
                                    <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan', $userData->nama_panggilan) }}" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tinggi_badan">Tinggi Badan:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan', $userData->tinggi_badan) }}" required min="50" max="300">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="berat_badan">Berat Badan:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" value="{{ old('berat_badan', $userData->berat_badan) }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="status_kawin">Status Perkawinan:</label>
                                        <select class="form-control" id="status_kawin" name="status_kawin" required>
                                            <option value="" disabled {{ old('status_kawin', $userData->status_kawin) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                            <option value="Menikah" {{ old('status_kawin', $userData->status_kawin) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Belum Menikah" {{ old('status_kawin', $userData->status_kawin) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                            <option value="Cerai" {{ old('status_kawin', $userData->status_kawin) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                            <option value="Cerai, Menikah Lagi" {{ old('status_kawin', $userData->status_kawin) == 'Cerai, Menikah Lagi' ? 'selected' : '' }}>Cerai, Menikah Lagi</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="warga_negara">Warga negara:</label>
                                        <select class="form-control" id="warga_negara" name="warga_negara" required>
                                            <option value="" disabled {{ old('warga_negara', $userData->warga_negara) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                            <option value="WNI" {{ old('warga_negara', $userData->warga_negara) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                            <option value="WNA" {{ old('warga_negara', $userData->warga_negara) == 'WNA' ? 'selected' : '' }}>WNA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="sim_a">SIM A:</label>
                                        <input type="text" class="form-control" id="sim_a" name="sim_a" value="{{ old('sim_a', $userData->sim_a) }}" minlength="14" maxlength="16">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="sim_b">SIM B:</label>
                                        <input type="text" class="form-control" id="sim_b" name="sim_b" value="{{ old('sim_b', $userData->sim_b) }}" minlength="14" maxlength="16">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="sim_c">SIM C:</label>
                                        <input type="text" class="form-control" id="sim_c" name="sim_c" value="{{ old('sim_c', $userData->sim_c) }}" minlength="14" maxlength="16">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat_tinggal">Rumah yang ditinggali:</label>
                                        <select class="form-control" id="tempat_tinggal" name="tempat_tinggal" required>
                                            <option value="" disabled {{ old('tempat_tinggal', $userData->tempat_tinggal) == '' ? 'selected' : ''}}>-- Pilih --</option>
                                            <option value="Milik Sendiri" {{ old('tempat_tinggal', $userData->tempat_tinggal) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                            <option value="Milik Orang Tua" {{ old('tempat_tinggal', $userData->tempat_tinggal) == 'Milik Orang Tua' ? 'selected' : '' }}>Milik Orang Tua</option>
                                            <option value="Sewa" {{ old('tempat_tinggal', $userData->tempat_tinggal) == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kendaraan">Jenis Kendaraan:</label>
                                        <select class="form-control" id="kendaraan" name="kendaraan" required>
                                            <option value="" disabled {{ old('kendaraan', $userData->kendaraan) == '' ? 'selected' : ''}}>-- Pilih --</option>
                                            <option value="Motor" {{ old('kendaraan', $userData->kendaraan) == 'Motor' ? 'selected' : '' }}>Motor</option>
                                            <option value="Mobil" {{ old('kendaraan', $userData->kendaraan) == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                            <option value="Tidak Punya" {{ old('kendaraan', $userData->kendaraan) == 'Tidak Punya' ? 'selected' : '' }}>Tidak Punya</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Alamat KTP -->
                                <div class="card card-body" style="background-color: #f8f9fa">
                                    <div class="form-group text-center">
                                        <label><strong>Alamat KTP</strong></label>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label for="jalan_ktp">Jalan :</label>
                                            <input type="text" class="form-control" id="jalan_ktp" name="jalan_ktp" value="{{old('jalan_ktp', $userData->jalan_ktp ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="no_rumah_ktp">No :</label>
                                            <input type="text" class="form-control" id="no_rumah_ktp" name="no_rumah_ktp" value="{{ old('no_rumah_ktp', $userData->no_rumah_ktp ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="rt_ktp">RT:</label>
                                            <input type="text" class="form-control" id="rt_ktp" name="rt_ktp" value="{{ old('rt_ktp', $userData->rt_ktp ?? '') }}" required maxlength="3">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="rw_ktp">RW:</label>
                                            <input type="text" class="form-control" id="rw_ktp" name="rw_ktp" value="{{ old('rw_ktp', $userData->rw_ktp ?? '') }}" required maxlength="3">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kel_ktp">Kelurahan:</label>
                                            <input type="text" class="form-control" id="kel_ktp" name="kel_ktp" value="{{ old('kel_ktp', $userData->kel_ktp ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kec_ktp">Kecamatan:</label>
                                            <input type="text" class="form-control" id="kec_ktp" name="kec_ktp" value="{{ old('kec_ktp', $userData->kec_ktp ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="kota_ktp">Kota:</label>
                                            <input type="text" class="form-control" id="kota_ktp" name="kota_ktp" value="{{ old('kota_ktp', $userData->kota_ktp ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="prov_ktp">Provinsi:</label>
                                            <input type="text" class="form-control" id="prov_ktp" name="prov_ktp" value="{{ old('prov_ktp', $userData->prov_ktp ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="kode_pos_ktp">Kode Pos:</label>
                                            <input type="text" class="form-control" id="kode_pos_ktp" name="kode_pos_ktp" value="{{ old('kode_pos_ktp', $userData->kode_pos_ktp ?? '') }}" required maxlength="5">
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat Domisili -->
                                <div class="card card-body" style="background-color: #f8f9fa">
                                    <div class="form-group mt-4 text-center">
                                        <label><strong>Alamat Domisili</strong></label>
                                    </div>
                                    <input type="hidden" name="sama_dengan_ktp" value="no">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sama_dengan_ktp" name="sama_dengan_ktp" value="yes" {{ old('sama_dengan_ktp', $userData->sama_dengan_ktp ?? 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sama_dengan_ktp">Sama dengan alamat KTP</label>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <label for="jalan_domisili">Jalan:</label>
                                            <input type="text" class="form-control" id="jalan_domisili" name="jalan_domisili" value="{{ old('jalan_domisili', $userData->jalan_domisili ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="no_rumah_domisili">No:</label>
                                            <input type="text" class="form-control" id="no_rumah_domisili" name="no_rumah_domisili" value="{{ old('no_rumah_domisili', $userData->no_rumah_domisili ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="rt_domisili">RT:</label>
                                            <input type="text" class="form-control" id="rt_domisili" name="rt_domisili" value="{{ old('rt_domisili', $userData->rt_domisili ?? '') }}" required maxlength="3">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="rw_domisili">RW:</label>
                                            <input type="text" class="form-control" id="rw_domisili" name="rw_domisili" value="{{ old('rw_domisili', $userData->rw_domisili ?? '') }}" required maxlength="3">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kel_domisili">Kelurahan:</label>
                                            <input type="text" class="form-control" id="kel_domisili" name="kel_domisili" value="{{ old('kel_domisili', $userData->kel_domisili ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kec_domisili">Kecamatan:</label>
                                            <input type="text" class="form-control" id="kec_domisili" name="kec_domisili" value="{{ old('kec_domisili', $userData->kec_domisili ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="kota_domisili">Kota:</label>
                                            <input type="text" class="form-control" id="kota_domisili" name="kota_domisili" value="{{ old('kota_domisili', $userData->kota_domisili ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="prov_domisili">Provinsi:</label>
                                            <input type="text" class="form-control" id="prov_domisili" name="prov_domisili" value="{{ old('prov_domisili', $userData->prov_domisili ?? '') }}" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="kode_pos_domisili">Kode Pos:</label>
                                            <input type="text" class="form-control" id="kode_pos_domisili" name="kode_pos_domisili" value="{{ old('kode_pos_domisili', $userData->kode_pos_domisili ?? '') }}" required maxlength="5">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="kemampuan_english">Kemampuan Bahasa Inggris:</label>
                                        <select class="form-control" id="kemampuan_english" name="kemampuan_english" required>
                                            <option value="" disabled {{ old('kemampuan_english', $userData->kemampuan_english) == '' ? 'selected' : ''}}>-- Pilih --</option>
                                            <option value="Sangat Baik" {{ $userData->kemampuan_english == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                            <option value="Baik" {{ old('kemampuan_english', $userData->kemampuan_english) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                            <option value="Cukup" {{ old('kemampuan_english', $userData->kemampuan_english) == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                            <option value="Kurang" {{ old('kemampuan_english', $userData->kemampuan_english) == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="kemampuan_komputer">Kemampuan Komputer:</label>
                                        <textarea class="form-control" id="kemampuan_komputer" name="kemampuan_komputer" rows="3" placeholder="e.g. Microsoft Office, Pemrograman etc">{{ old('kemampuan_komputer', $userData->kemampuan_komputer) }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kemampuan_khusus">Kemampuan Khusus:</label>
                                        <textarea class="form-control" id="kemampuan_khusus" name="kemampuan_khusus" rows="3" placeholder="e.g. Hitung cepat">{{ old('kemampuan_khusus', $userData->kemampuan_khusus) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hobi">Kegiatan di waktu luang / Hobi:</label>
                                    <input type="text" class="form-control" id="hobi" name="hobi" value="{{ old('hobi', $userData->hobi) }}">
                                </div>
                                <div class="form-group">
                                    <label for="aktifitas_sosial">Aktifitas Sosial:</label>
                                    <input type="text" class="form-control" id="aktifitas_sosial" name="aktifitas_sosial" value="{{ old('aktifitas_sosial', $userData->aktifitas_sosial) }}">
                                </div>
                                <div class="form-group">
                                    <label for="riwayat_sakit">Sakit / Kecelakaan yang pernah dialami:</label>
                                    <input type="text" class="form-control" id="riwayat_sakit" name="riwayat_sakit" value="{{ old('riwayat_sakit', $userData->riwayat_sakit) }}">
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next-step" id="next-step" class="next-step" value="Next" />
                        <input type="hidden" id="userID" value="{{ $userData->user_id }}">
                    </fieldset>

                    <fieldset id="next-step-2" style="display: none;">
                        <div class="form-section card">
                            <div class="card-body">
                                <h5 class="card-header text-center mb-3"><strong>DATA KELUARGA</strong></h5>
                                <div id="family-data-container">
                                    @foreach($userDataFamilies as $index => $userDataFamily)
                                    <div class="card family-data-card" data-index="{{ $index }}">
                                        <div class="card-body">
                                            <h4 class="card-title">Data Keluarga {{ $index + 1 }}</h4>
                                            <div class="row">
                                                <button type="button" class="btn btn-danger btn-sm delete-family-data" data-index="{{ $index }}" style="position: absolute; top: 5px; right: 5px;">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="hubungan_{{ $index }}">Hubungan Keluarga</label>
                                                        <select class="form-control @error('hubungan.' . $index) is-invalid @enderror" id="hubungan_{{ $index }}" name="hubungan[{{ $index }}]">
                                                            <option value="" disabled selected>-- Pilih --</option>
                                                            <option value="Ayah" {{ $userDataFamily->hubungan == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                                            <option value="Ibu" {{ $userDataFamily->hubungan == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                                            <option value="Kakak" {{ $userDataFamily->hubungan == 'Kakak' ? 'selected' : '' }}>Kakak</option>
                                                            <option value="Adik" {{ $userDataFamily->hubungan == 'Adik' ? 'selected' : '' }}>Adik</option>
                                                            <option value="Suami" {{ $userDataFamily->hubungan == 'Suami' ? 'selected' : '' }}>Suami</option>
                                                            <option value="Istri" {{ $userDataFamily->hubungan == 'Istri' ? 'selected' : '' }}>Istri</option>
                                                            <option value="Anak" {{ $userDataFamily->hubungan == 'Anak' ? 'selected' : '' }}>Anak</option>
                                                            <option value="Kerabat" {{ $userDataFamily->hubungan == 'Kerabat' ? 'selected' : '' }}>Kerabat</option>
                                                        </select>
                                                        @error('hubungan.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_{{ $index }}">Nama</label>
                                                        <input type="text" class="form-control @error('nama.' . $index) is-invalid @enderror" id="nama_{{ $index }}" name="nama[{{ $index }}]" value="{{ $userDataFamily->nama }}" placeholder="">
                                                        @error('nama.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usia_{{ $index }}">Usia</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control @error('usia.' . $index) is-invalid @enderror" id="usia_{{ $index }}" name="usia[{{ $index }}]" value="{{ $userDataFamily->usia }}" placeholder="">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">tahun</span>
                                                            </div>
                                                        </div>
                                                        @error('usia.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="jenis_kelamin_{{ $index }}">Jenis Kelamin</label>
                                                        <select class="form-control @error('jenis_kelamin.' . $index) is-invalid @enderror" id="jenis_kelamin_{{ $index }}" name="jenis_kelamin[{{ $index }}]">
                                                            <option value="" disabled {{ old('jenis_kelamin.' . $index, $userDataFamily->jenis_kelamin) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                                            <option value="L" {{ old('jenis_kelamin.' . $index, $userDataFamily->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="P" {{ old('jenis_kelamin.' . $index, $userDataFamily->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                        @error('jenis_kelamin.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pendidikan_terakhir_{{ $index }}">Pendidikan Terakhir</label>
                                                        <select class="form-control @error('pendidikan_terakhir.' . $index) is-invalid @enderror" id="pendidikan_terakhir_{{ $index }}" name="pendidikan_terakhir[{{ $index }}]">
                                                            <option value="" disabled {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                                            <option value="SD" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                                                            <option value="SMP" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                                            <option value="SMA" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA/Sederajat</option>
                                                            <option value="D3" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                                                            <option value="D4" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'D4' ? 'selected' : '' }}>D4</option>
                                                            <option value="S1" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                                                            <option value="S2" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                                                            <option value="S3" {{ old('pendidikan_terakhir.' . $index, $userDataFamily->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                                                        </select>
                                                        @error('pendidikan_terakhir.' . $index)
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
                                                        <label for="pekerjaan_{{ $index }}">Pekerjaan</label>
                                                        <input type="text" class="form-control @error('pekerjaan.' . $index) is-invalid @enderror" id="pekerjaan_{{ $index }}" name="pekerjaan[{{ $index }}]" value="{{ $userDataFamily->pekerjaan }}" placeholder="">
                                                        @error('pekerjaan.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="perusahaan_tempat_kerja_{{ $index }}">Perusahaan Tempat Kerja</label>
                                                        <input type="text" class="form-control @error('perusahaan_tempat_kerja.' . $index) is-invalid @enderror" id="perusahaan_tempat_kerja_{{ $index }}" name="perusahaan_tempat_kerja[{{ $index }}]" value="{{ $userDataFamily->perusahaan_tempat_kerja }}" placeholder="">
                                                        @error('perusahaan_tempat_kerja.' . $index)
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
                                                        <label for="alamat_{{ $index }}">Alamat</label>
                                                        <textarea class="form-control @error('alamat.' . $index) is-invalid @enderror" id="alamat_{{ $index }}" name="alamat[{{ $index }}]" rows="3">{{ $userDataFamily->alamat }}</textarea>
                                                        @error('alamat.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="family_ids[{{ $index }}]" value="{{ $userDataFamily->id }}">

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="text-center">
                                    <button type="button" id="add-family-data" class="btn btn-primary mt-3 mb-3"><i class="fas fa-plus"></i> Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-section card">
                            <div class="card-body">
                                <h5 class="card-header text-center mb-3"><strong>EMERGENCY CONTACT</strong></h5>
                                <div id="family-data-container">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="nama_emergency">Nama</label>
                                            <input type="text" class="form-control" id="nama_emergency" name="nama_emergency" value="{{ old('nama_emergency', $userData->nama_emergency) }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="no_hp_emergency">Nomor HP</label>
                                            <input type="text" class="form-control" id="no_hp_emergency" name="no_hp_emergency" value="{{ old('no_hp_emergency', $userData->no_hp_emergency) }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="hubungan_emergency">Hubungan</label>
                                            <select class="form-control" id="hubungan_emergency" name="hubungan_emergency" required>
                                                <option value="" disabled {{ old('hubungan_emergency', $userData->hubungan_emergency) == '' ? 'selected' : '' }}>-- Pilih --</option>
                                                <option value="Ayah" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                                <option value="Ibu" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                                <option value="Kakak" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Kakak' ? 'selected' : '' }}>Kakak</option>
                                                <option value="Adik" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Adik' ? 'selected' : '' }}>Adik</option>
                                                <option value="Suami" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Suami' ? 'selected' : '' }}>Suami</option>
                                                <option value="Istri" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                                <option value="Anak" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                                <option value="Kerabat" {{ old('hubungan_emergency', $userData->hubungan_emergency) == 'Kerabat' ? 'selected' : '' }}>Kerabat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next-step" class="next-step" value="Next" />
                        <input type="hidden" id="userID" value="{{ $userData->user_id }}">
                        <input type="button" name="pre-step" class="pre-step" value="Back" />
                    </fieldset>

                    <fieldset id="next-step-3" style="display: none;">
                        <div class="form-section card">
                            <div class="card-body">
                                <h5 class="card-header text-center mb-3"><strong>RIWAYAT PENDIDIKAN</strong></h5>

                                <h5 class="text-center mt-5 mb-3">Isilah data dibawah ini sesuai dengan riwayat pendidikan anda.</h5>

                                <div class="card">
                                    <div class="card-header" id="headingSD" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Sekolah Dasar</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSD" aria-expanded="false" aria-controls="collapseSD">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseSD" class="collapse" aria-labelledby="headingSD">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_sd">Nama Sekolah</label>
                                                    <input type="text" class="form-control" id="instansi_sd" name="instansi_sd" value="{{ old('instansi_sd', $userDataEducation->instansi_sd ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_sd">Kota</label>
                                                    <input type="text" class="form-control" id="kota_sd" name="kota_sd" value="{{ old('kota_sd', $userDataEducation->kota_sd ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="tahun_mulai_sd">Tahun Mulai</label>
                                                    <input type="text" class="form-control yearpicker" id="tahun_mulai_sd" name="tahun_mulai_sd" value="{{ old('tahun_mulai_sd', $userDataEducation->tahun_mulai_sd ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tahun_selesai_sd">Tahun Selesai</label>
                                                    <input type="text" class="form-control yearpicker" id="tahun_selesai_sd" name="tahun_selesai_sd" value="{{ old('tahun_selesai_sd', $userDataEducation->tahun_selesai_sd ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingSMP" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Sekolah Menengah Pertama</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSMP" aria-expanded="false" aria-controls="collapseSMP">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseSMP" class="collapse" aria-labelledby="headingSMP">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_smp">Nama Sekolah</label>
                                                    <input type="text" class="form-control" id="instansi_smp" name="instansi_smp" value="{{ old('instansi_smp', $userDataEducation->instansi_smp ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_smp">Kota</label>
                                                    <input type="text" class="form-control" id="kota_smp" name="kota_smp" value="{{ old('kota_smp', $userDataEducation->kota_smp ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="tahun_mulai_smp">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_smp" name="tahun_mulai_smp" value="{{ old('tahun_mulai_smp', $userDataEducation->tahun_mulai_smp ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tahun_selesai_smp">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_smp" name="tahun_selesai_smp" value="{{ old('tahun_selesai_smp', $userDataEducation->tahun_selesai_smp ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingSMA" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Sekolah Menengah Atas</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSMA" aria-expanded="false" aria-controls="collapseSMA">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseSMA" class="collapse" aria-labelledby="headingSMA">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_sma">Nama Sekolah</label>
                                                    <input type="text" class="form-control" id="instansi_sma" name="instansi_sma" value="{{ old('instansi_sma', $userDataEducation->instansi_sma ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_sma">Kota</label>
                                                    <input type="text" class="form-control" id="kota_sma" name="kota_sma" value="{{ old('kota_sma', $userDataEducation->kota_sma ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="jurusan_sma">Jurusan</label>
                                                    <input type="text" class="form-control" id="jurusan_sma" name="jurusan_sma" value="{{ old('jurusan_sma', $userDataEducation->jurusan_sma ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_mulai_sma">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_sma" name="tahun_mulai_sma" value="{{ old('tahun_mulai_sma', $userDataEducation->tahun_mulai_sma ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_selesai_sma">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_sma" name="tahun_selesai_sma" value="{{ old('tahun_selesai_sma', $userDataEducation->tahun_selesai_sma ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingD3" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Pendidikan D3</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseD3" aria-expanded="false" aria-controls="collapseD3">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseD3" class="collapse" aria-labelledby="headingD3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_d3">Nama Instansi</label>
                                                    <input type="text" class="form-control" id="instansi_d3" name="instansi_d3" value="{{ old('instansi_d3', $userDataEducation->instansi_d3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_d3">Kota</label>
                                                    <input type="text" class="form-control" id="kota_d3" name="kota_d3" value="{{ old('kota_d3', $userDataEducation->kota_d3 ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="jurusan_d3">Jurusan</label>
                                                    <input type="text" class="form-control" id="jurusan_d3" name="jurusan_d3" value="{{ old('jurusan_d3', $userDataEducation->jurusan_d3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_mulai_d3">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_d3" name="tahun_mulai_d3" value="{{ old('tahun_mulai_d3', $userDataEducation->tahun_mulai_d3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_selesai_d3">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_d3" name="tahun_selesai_d3" value="{{ old('tahun_selesai_d3', $userDataEducation->tahun_selesai_d3 ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingS1" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Pendidikan S1</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseS1" aria-expanded="false" aria-controls="collapseS1">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseS1" class="collapse" aria-labelledby="headingS1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_s1">Nama Instansi</label>
                                                    <input type="text" class="form-control" id="instansi_s1" name="instansi_s1" value="{{ old('instansi_s1', $userDataEducation->instansi_s1 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_s1">Kota</label>
                                                    <input type="text" class="form-control" id="kota_s1" name="kota_s1" value="{{ old('kota_s1', $userDataEducation->kota_s1 ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="jurusan_s1">Jurusan</label>
                                                    <input type="text" class="form-control" id="jurusan_s1" name="jurusan_s1" value="{{ old('jurusan_s1', $userDataEducation->jurusan_s1 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_mulai_s1">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_s1" name="tahun_mulai_s1" value="{{ old('tahun_mulai_s1', $userDataEducation->tahun_mulai_s1 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_selesai_s1">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_s1" name="tahun_selesai_s1" value="{{ old('tahun_selesai_s1', $userDataEducation->tahun_selesai_s1 ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingS2" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Pendidikan S2</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseS2" aria-expanded="false" aria-controls="collapseS2">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseS2" class="collapse" aria-labelledby="headingS2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_s2">Nama Instansi</label>
                                                    <input type="text" class="form-control" id="instansi_s2" name="instansi_s2" value="{{ old('instansi_s2', $userDataEducation->instansi_s2 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_s2">Kota</label>
                                                    <input type="text" class="form-control" id="kota_s2" name="kota_s2" value="{{ old('kota_s2', $userDataEducation->kota_s2 ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="jurusan_s2">Jurusan</label>
                                                    <input type="text" class="form-control" id="jurusan_s2" name="jurusan_s2" value="{{ old('jurusan_s2', $userDataEducation->jurusan_s2 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_mulai_s2">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_s2" name="tahun_mulai_s2" value="{{ old('tahun_mulai_s2', $userDataEducation->tahun_mulai_s2 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_selesai_s2">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_s2" name="tahun_selesai_s2" value="{{ old('tahun_selesai_s2', $userDataEducation->tahun_selesai_s2 ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingS3" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Pendidikan S3</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseS3" aria-expanded="false" aria-controls="collapseS3">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>

                                    <div id="collapseS3" class="collapse" aria-labelledby="headingS3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="instansi_s3">Nama Instansi</label>
                                                    <input type="text" class="form-control" id="instansi_s3" name="instansi_s3" value="{{ old('instansi_s3', $userDataEducation->instansi_s3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_s3">Kota</label>
                                                    <input type="text" class="form-control" id="kota_s3" name="kota_s3" value="{{ old('kota_s3', $userDataEducation->kota_s3 ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="jurusan_s3">Jurusan</label>
                                                    <input type="text" class="form-control" id="jurusan_s3" name="jurusan_s3" value="{{ old('jurusan_s3', $userDataEducation->jurusan_s3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_mulai_s3">Tahun Mulai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_mulai_s3" name="tahun_mulai_s3" value="{{ old('tahun_mulai_s3', $userDataEducation->tahun_mulai_s3 ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tahun_selesai_s3">Tahun Selesai</label>
                                                    <input type="number" class="form-control yearpicker" id="tahun_selesai_s3" name="tahun_selesai_s3" value="{{ old('tahun_selesai_s3', $userDataEducation->tahun_selesai_s3 ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingInformal" style="border-radius: 18px;">
                                        <h5 class=" mb-0 pl-3 float-left"><strong>Pendidikan Informal</strong></h5>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseInformal" aria-expanded="false" aria-controls="collapseInformal">
                                            <i class="fas fa-plus float-right"></i>
                                        </button>
                                    </div>
                                    <div id="collapseInformal" class="collapse" aria-labelledby="headingInformal">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jenis_informal">Jenis Pendidikan</label>
                                                <input type="text" class="form-control" id="jenis_informal" name="jenis_informal" value="{{ old('jenis_informal', $userDataEducation->jenis_informal ?? '') }}" placeholder="Kursus/Loka-karya/Seminar/Pelatihan,dll">
                                            </div>
                                            <div class="form-group">
                                                <label for="judul_informal">Bidang/Judul/Topik</label>
                                                <input type="text" class="form-control" id="judul_informal" name="judul_informal" value="{{ old('judul_informal', $userDataEducation->judul_informal ?? '') }}">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="penyelenggara_informal">Penyelenggara</label>
                                                    <input type="text" class="form-control" id="penyelenggara_informal" name="penyelenggara_informal" value="{{ old('penyelenggara_informal', $userDataEducation->penyelenggara_informal ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="kota_informal">Kota</label>
                                                    <input type="text" class="form-control" id="kota_informal" name="kota_informal" value="{{ old('kota_informal', $userDataEducation->kota_informal ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="durasi_informal">Durasi</label>
                                                    <input type="text" class="form-control" id="durasi_informal" name="durasi_informal" value="{{ old('durasi_informal', $userDataEducation->durasi_informal ?? '') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tahun_informal">Tahun Ikut Serta</label>
                                                    <input type="text" class="form-control yearpicker" id="tahun_informal" name="tahun_informal" value="{{ old('tahun_informal', $userDataEducation->tahun_informal ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="informal_dibiayai_oleh">Dibiayai Oleh</label>
                                                <input type="text" class="form-control" id="informal_dibiayai_oleh" name="informal_dibiayai_oleh" value="{{ old('informal_dibiayai_oleh', $userDataEducation->informal_dibiayai_oleh ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next-step" class="next-step" value="Next" />
                        <input type="hidden" id="userID" value="{{ $userData->user_id }}">
                        <input type="button" name="pre-step" class="pre-step" value="Back" />
                    </fieldset>

                    <fieldset id="next-step-4" style="display: none;">
                        <div class="form-section card">
                            <div class="card-body">
                                <h5 class="card-header text-center mb-3"><strong>RIWAYAT PEKERJAAN</strong></h5>
                                <div id="employment-history-data-container">
                                    @foreach($userDataEmploymentHistories as $index => $userDataEmploymentHistory)
                                    <div class="card employment-history-data-card" data-index="{{ $index }}">
                                        <div class="card-body">
                                            <h4 class="card-title">Data Pekerjaan {{ $index + 1 }}</h4>
                                            <div class="row">
                                                <button type="button" class="btn btn-danger btn-sm delete-employment-history-data" data-index="{{ $index }}" style="position: absolute; top: 5px; right: 5px;">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nama_perusahaan_{{ $index }}">Nama Perusahaan</label>
                                                        <input type="text" class="form-control @error('nama_perusahaan.' . $index) is-invalid @enderror" id="nama_perusahaan_{{ $index }}" name="nama_perusahaan[{{ $index }}]" value="{{ $userDataEmploymentHistory->nama_perusahaan }}" placeholder="">
                                                        @error('nama_perusahaan.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="divisi_{{ $index }}">Divisi</label>
                                                        <input type="text" class="form-control @error('divisi.' . $index) is-invalid @enderror" id="divisi_{{ $index }}" name="divisi[{{ $index }}]" value="{{ $userDataEmploymentHistory->divisi }}" placeholder="">
                                                        @error('divisi.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="jabatan_{{ $index }}">Jabatan</label>
                                                        <input type="text" class="form-control @error('jabatan.' . $index) is-invalid @enderror" id="jabatan_{{ $index }}" name="jabatan[{{ $index }}]" value="{{ $userDataEmploymentHistory->jabatan }}" placeholder="">
                                                        @error('jabatan.' . $index)
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
                                                        <label for="nama_atasan_{{ $index }}">Nama Atasan</label>
                                                        <input type="text" class="form-control @error('nama_atasan.' . $index) is-invalid @enderror" id="nama_atasan_{{ $index }}" name="nama_atasan[{{ $index }}]" value="{{ $userDataEmploymentHistory->nama_atasan }}" placeholder="">
                                                        @error('nama_atasan.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jabatan_atasan_{{ $index }}">Jabatan Atasan</label>
                                                        <input type="text" class="form-control @error('jabatan_atasan.' . $index) is-invalid @enderror" id="jabatan_atasan_{{ $index }}" name="jabatan_atasan[{{ $index }}]" value="{{ $userDataEmploymentHistory->jabatan_atasan }}" placeholder="">
                                                        @error('jabatan_atasan.' . $index)
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
                                                        <label for="tanggal_masuk_{{ $index }}">Tanggal Masuk</label>
                                                        <input type="text" class="form-control yearpicker @error('tanggal_masuk.' . $index) is-invalid @enderror" id="tanggal_masuk_{{ $index }}" name="tanggal_masuk[{{ $index }}]" value="{{ $userDataEmploymentHistory->tanggal_masuk }}" placeholder="">
                                                        @error('tanggal_masuk.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tanggal_keluar_{{ $index }}">Tanggal Keluar</label>
                                                        <input type="text" class="form-control yearpicker @error('tanggal_keluar.' . $index) is-invalid @enderror" id="tanggal_keluar_{{ $index }}" name="tanggal_keluar[{{ $index }}]" value="{{ $userDataEmploymentHistory->tanggal_keluar }}" placeholder="">
                                                        @error('tanggal_keluar.' . $index)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="employment_history_ids[{{ $index }}]" value="{{ $userDataEmploymentHistory->id }}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="text-center">
                                    <button type="button" id="add-employment-history-data" class="btn btn-primary mt-3 mb-3"><i class="fas fa-plus"></i> Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next-step" class="next-step" value="Next" />
                        <input type="hidden" id="userID" value="{{ $userData->user_id }}">
                        <input type="button" name="pre-step" class="pre-step" value="Back" />
                    </fieldset>

                    <fieldset id="next-step-5" style="display: none;">
                        <div class="form-section card">
                            <div class="card-body">
                                <h5 class="card-header text-center mb-3"><strong>PERTANYAAN SINGKAT</strong></h5>
                                @foreach ($questions as $question)
                                <div class="mb-4">
                                    <label class="mb-3" for="answer_{{ $question->id }}">
                                        <strong>{{ $question->id }}. {{ $question->question }}</strong>
                                    </label>
                                    <div class="row">
                                        @if($question->question_type == 'YesNo')
                                        <div class="form-group col-md-4">
                                            <select class="form-control @error('answer.' . $question->id) is-invalid @enderror" id="answer_{{ $question->id }}" name="answer[{{ $question->id }}]" required>
                                                <option value="" disabled selected>Jawaban</option>
                                                <option value="Ya" {{ old('answer.' . $question->id, $userDataAnswers[$question->id]->answer ?? '') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="Tidak" {{ old('answer.' . $question->id, $userDataAnswers[$question->id]->answer ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('answer.' . $question->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        @else
                                        <input type="hidden" name="answer[{{ $question->id }}]" value="-">
                                        @endif
                                        <div class="form-group col-md-9">
                                            <textarea class="form-control @error('explain.' . $question->id) is-invalid @enderror" id="explain_{{ $question->id }}" name="explain[{{ $question->id }}]" rows="3" placeholder="Penjelasan..." @if($question->question_type == 'Explain') required @endif></textarea>
                                            @error('explain.' . $question->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                                <div class="mb-4">
                                    <p class="text-justify" style="color: red">Semua keterangan diatas adalah benar adanya sampai dengan tanggal dibuatnya keterangan tersebut. Apabila di kemudian hari ternyata terdapat atau ditemukan hal-hal yang tidak benar mengenai keterangan saya diatas, maka saya bersedia diberhentikan tanpa syarat apapun.</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="disclaimerCheckbox">
                                        <label class="form-check-label" for="disclaimerCheckbox">
                                            Saya setuju
                                        </label>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <input type="button" name="next-step" class="next-step" value="Submit Form" />
                        <input type="hidden" id="userID" value="{{ $userData->user_id }}">
                        <input type="button" name="pre-step" class="pre-step" value="Back" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- Submit Confirmation Modal -->
    <div class="modal fade" id="submitConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="submitConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitConfirmationModalLabel">Submit Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Apakah data yang Anda masukkan sudah sesuai?
                    <br>Form interview anda akan disubmit dan tidak dapat diubah kembali.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="errorModalBody" style="color:red;">
                    <!-- Errors will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="successModalBody" style="color:green;">
                    <!-- Success message will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
</body>

@endsection

@section('scripts')
<script type="text/javascript">
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

    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Set up global AJAX settings to include the CSRF token in every request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        var currentGfgStep, nextGfgStep, preGfgStep;
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;
        setProgressBar(current);

        $("fieldset").not(':first').hide();

        $(".next-step").click(function() {
            var form = $('#form-interview'); // Get the form by ID
            var currentFieldset = $(this).closest('fieldset'); // Get the current fieldset
            var progressBar = $("#progressbar");

            if (currentFieldset.attr('id') === "next-step-1") {
                var userID = $('#userID').val();
                // Submit the form data via AJAX for step 1
                $.ajax({
                    type: 'POST',
                    url: '{{ route("UserIdentity.update", ":id") }}'.replace(':id', userID),
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log the response to inspect it
                        if (response.success) {
                            moveToNextStep(currentFieldset, progressBar);
                            showSuccessModal('Data saved successfully');
                            window.scrollTo(0, 0); // Scroll to the top of the page                            
                        } else if (response.skip) {
                            moveToNextStep(currentFieldset, progressBar);
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else {
                            showErrorModal(response.message || 'An error occurred');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            markInvalidFields(xhr.responseJSON.errors);
                            showErrorModal(formatErrors(xhr.responseJSON.errors));
                        } else {
                            console.error(xhr.responseText);
                        }
                    }
                });
            } else if (currentFieldset.attr('id') === "next-step-2") {
                var userID = $('#userID').val();

                // Validate that at least one family data entry is filled
                var familyDataFilled = false;
                var errorMessages = [];

                $('#family-data-container .family-data-card').each(function(index) {
                    var cardIndex = index + 1;
                    var missingFields = [];

                    var hubungan = $(this).find('select[name^="hubungan"]').val();
                    var nama = $(this).find('input[name^="nama"]').val();
                    var usia = $(this).find('input[name^="usia"]').val();
                    var jenis_kelamin = $(this).find('select[name^="jenis_kelamin"]').val();
                    var pendidikan_terakhir = $(this).find('select[name^="pendidikan_terakhir"]').val();
                    var pekerjaan = $(this).find('input[name^="pekerjaan"]').val();
                    var perusahaan_tempat_kerja = $(this).find('input[name^="perusahaan_tempat_kerja"]').val();
                    var alamat = $(this).find('textarea[name^="alamat"]').val();

                    if (!hubungan) missingFields.push("Hubungan Keluarga");
                    if (!nama) missingFields.push("Nama");
                    if (!usia) missingFields.push("Usia");
                    if (!jenis_kelamin) missingFields.push("Jenis Kelamin");
                    if (!pendidikan_terakhir) missingFields.push("Pendidikan Terakhir");
                    if (!pekerjaan) missingFields.push("Pekerjaan");
                    if (!perusahaan_tempat_kerja) missingFields.push("Perusahaan Tempat Kerja");
                    if (!alamat) missingFields.push("Alamat");

                    if (missingFields.length > 0) {
                        errorMessages.push("Data Keluarga " + cardIndex + ": " + missingFields.join(", "));
                    } else {
                        familyDataFilled = true;
                        return false; // Break out of the loop if at least one card is completely filled
                    }
                });

                if (errorMessages.length > 0) {
                    showErrorModal("Mohon lengkapi data berikut: \n" + errorMessages.join("\n"));
                    window.scrollTo(0, 0); // Scroll to the top of the page     
                    return;
                }

                if (!familyDataFilled) {
                    showErrorModal('Mohon input data keluarga terlebih dahulu');
                    window.scrollTo(0, 0); // Scroll to the top of the page     
                    return;
                }

                // Submit the form data via AJAX for step 1
                $.ajax({
                    type: 'POST',
                    url: '{{ route("UserFamily.update", ":id") }}'.replace(':id', userID),
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log the response to inspect it
                        if (response.success) {
                            moveToNextStep(currentFieldset, progressBar);
                            showSuccessModal('Data saved successfully');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else if (response.skip) {
                            moveToNextStep(currentFieldset, progressBar);
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else {
                            showErrorModal(response.errors || 'An error occurred');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            markInvalidFields(xhr.responseJSON.errors);
                            showErrorModal(formatErrors(xhr.responseJSON.errors));
                        } else {
                            console.error(xhr.responseText);
                        }
                    }
                });

            } else if (currentFieldset.attr('id') === "next-step-3") {
                var userID = $('#userID').val();
                // Submit the form data via AJAX for step 1
                $.ajax({
                    type: 'POST',
                    url: '{{ route("UserEducation.update", ":id") }}'.replace(':id', userID),
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log the response to inspect it
                        if (response.success) {
                            moveToNextStep(currentFieldset, progressBar);
                            showSuccessModal('Data saved successfully');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else if (response.skip) {
                            moveToNextStep(currentFieldset, progressBar);
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else {
                            showErrorModal(response.errors || 'An error occurred');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            markInvalidFields(xhr.responseJSON.errors);
                            showErrorModal(formatErrors(xhr.responseJSON.errors));
                        } else {
                            console.error(xhr.responseText);
                        }
                    }
                });
            } else if (currentFieldset.attr('id') === "next-step-4") {
                var userID = $('#userID').val();
                // Submit the form data via AJAX for step 1
                $.ajax({
                    type: 'POST',
                    url: '{{ route("UserEmploymentHistory.update", ":id") }}'.replace(':id', userID),
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log the response to inspect it
                        if (response.success) {
                            moveToNextStep(currentFieldset, progressBar);
                            showSuccessModal('Data saved successfully');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else if (response.skip) {
                            moveToNextStep(currentFieldset, progressBar);
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        } else {
                            showErrorModal(response.errors || 'An error occurred');
                            window.scrollTo(0, 0); // Scroll to the top of the page     
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            markInvalidFields(xhr.responseJSON.errors);
                            showErrorModal(formatErrors(xhr.responseJSON.errors));
                        } else {
                            console.error(xhr.responseText);
                        }
                    }
                });
            } else if (currentFieldset.attr('id') === "next-step-5") {
                if (!$('#disclaimerCheckbox').is(':checked')) {
                    Swal.fire({
                        title: 'Persetujuan Ketentuan',
                        text: "Mohon klik 'Saya setuju' untuk melanjutkan",
                        icon: 'warning',
                    });
                    return;
                }
                errors = form[0].checkValidity();
                if (!errors) {
                    form[0].reportValidity();
                    return;
                }
                $('#submitConfirmationModal').modal('show');
            }
        });

        $("#confirmSubmit").click(function() {
            var userID = $('#userID').val();
            var form = $('#form-interview');
            $.ajax({
                type: 'POST',
                url: '{{ route("UserAnswer.update", ":id") }}'.replace(':id', userID),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#submitConfirmationModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Form berhasil disubmit!',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/detail-profile';
                        });
                    } else {
                        showErrorModal(response.errors || 'An error occurred');
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        markInvalidFields(xhr.responseJSON.errors);
                        showErrorModal(formatErrors(xhr.responseJSON.errors));
                    } else {
                        console.error(xhr.responseText);
                    }
                }
            });
        });

        $(".pre-step").click(function() {
            var currentGfgStep = $(this).parent();
            var preGfgStep = $(this).parent().prev();
            $("#progressbar li").eq($("fieldset").index(currentGfgStep)).removeClass("active");
            preGfgStep.show();
            currentGfgStep.animate({
                opacity: 0
            }, {
                step: function(now) {
                    var opacity = 1 - now;
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
            var currentGfgStep = currentFieldset;
            var nextGfgStep = currentFieldset.next();
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

        function showErrorModal(errors) {
            var errorBody = $('#errorModalBody');
            errorBody.empty(); // Clear any existing errors

            if (typeof errors === 'string') {
                errorBody.append('<p>' + errors + '</p>');
            } else {
                $.each(errors, function(key, value) {
                    errorBody.append('<p>' + value + '</p>');
                });
            }

            $('#errorModal').modal('show');
        }

        function formatErrors(errors) {
            var formattedErrors = '';
            $.each(errors, function(key, value) {
                formattedErrors += value + '<br>';
            });
            return formattedErrors;
        }

        function markInvalidFields(errors) {
            // Remove previous invalid marks
            $('.is-invalid').removeClass('is-invalid');

            $.each(errors, function(key, value) {
                var field = $('[name="' + key + '"]');
                if (field.length > 0) {
                    field.addClass('is-invalid');
                }
            });
        }

        function showSuccessModal(message) {
            $('#successModalBody').html(message);
            $('#successModal').modal('show');
        }


        var familyIndex = $('.family-data-card').length;

        var EmploymentHistoryIndex = $('.employment-history-data-card').length;


        // console.log(familyIndex);

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
                            <label for="hubungan_${familyIndex}">Hubungan Keluarga</label>
                            <select class="form-control" id="hubungan_${familyIndex}" name="hubungan[${familyIndex}]">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="Ayah">Ayah</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Suami">Suami</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Kerabat">Kerabat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_${familyIndex}">Nama</label>
                            <input type="text" class="form-control" id="nama_${familyIndex}" name="nama[${familyIndex}]" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usia_${familyIndex}">Usia</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usia_${familyIndex}" name="usia[${familyIndex}]" placeholder="">
                                <div class="input-group-append">
                                    <span class="input-group-text">tahun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis_kelamin_${familyIndex}">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin_${familyIndex}" name="jenis_kelamin[${familyIndex}]">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_terakhir_${familyIndex}">Pendidikan Terakhir</label>
                            <select class="form-control" id="pendidikan_terakhir_${familyIndex}" name="pendidikan_terakhir[${familyIndex}]">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA/sederajat</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pekerjaan_${familyIndex}">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan_${familyIndex}" name="pekerjaan[${familyIndex}]" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="perusahaan_tempat_kerja_${familyIndex}">Perusahaan Tempat Kerja</label>
                            <input type="text" class="form-control" id="perusahaan_tempat_kerja_${familyIndex}" name="perusahaan_tempat_kerja[${familyIndex}]" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat_${familyIndex}">Alamat</label>
                            <textarea class="form-control" id="alamat_${familyIndex}" name="alamat[${familyIndex}]"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="family_ids[${familyIndex}]" value="">
            </div>
        </div>`;

            $('#family-data-container').append(newFamilyData);
            familyIndex++;
        });

        // Delete family data form
        $('#family-data-container').on('click', '.delete-family-data', function() {
            var index = $(this).data('index');
            var familyId = $(`.family-data-card[data-index="${index}"] input[name="family_ids[${index}]"]`).val();

            if (familyId) {
                // Show confirmation dialog using SweetAlert
                Swal.fire({
                    title: 'Warning',
                    text: "Do you really want to delete this family data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Check if the familyId is undefined or null

                        // Make an AJAX request to delete the family data from the database
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("UserFamily.delete", ":id") }}'.replace(':id', familyId),
                            data: {
                                id: familyId
                            },
                            success: function(response) {
                                if (response.success) {
                                    reIndexFamilyData();
                                    $(`.family-data-card[data-index="${index}"]`).remove();
                                    familyIndex--;
                                    $('#add-family-data').prop('disabled', false); // Enable the add button after deletion
                                    Swal.fire(
                                        'Deleted!',
                                        'Family data has been deleted.',
                                        'success'
                                    );
                                    console.log('Family data deleted successfully');
                                } else {
                                    console.error('Failed to delete family data');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error deleting family data:', xhr.responseText);
                            }
                        });
                    }
                });
            } else {
                // Remove the card directly if familyId is undefined or null
                $(`.family-data-card[data-index="${index}"]`).remove();
                familyIndex--;
                $('#add-family-data').prop('disabled', false); // Enable the add button after deletion
                reIndexFamilyData(); // Re-index the family data cards
            }
        });

        function reIndexFamilyData() {
            $('#family-data-container .family-data-card').each(function(i) {
                $(this).attr('data-index', i);
                $(this).find('.card-title').text('Data Keluarga ' + (i + 1));
                $(this).find('[id^=hubungan_]').attr('id', 'hubungan_' + i).attr('name', 'hubungan[' + i + ']');
                $(this).find('[id^=usia_]').attr('id', 'usia_' + i).attr('name', 'usia[' + i + ']');
                $(this).find('[id^=nama_]').attr('id', 'nama_' + i).attr('name', 'nama[' + i + ']');
                $(this).find('[id^=jenis_kelamin_]').attr('id', 'jenis_kelamin_' + i).attr('name', 'jenis_kelamin[' + i + ']');
                $(this).find('[id^=pekerjaan_]').attr('id', 'pekerjaan_' + i).attr('name', 'pekerjaan[' + i + ']');
                $(this).find('[id^=perusahaan_tempat_kerja_]').attr('id', 'perusahaan_tempat_kerja_' + i).attr('name', 'perusahaan_tempat_kerja[' + i + ']');
                $(this).find('[name^=family_ids]').attr('name', 'family_ids[' + i + ']');
                $(this).find('.delete-family-data').attr('data-index', i);
            });
        }


        $('#add-employment-history-data').click(function() {
            var newEmploymentHistoryData = `
            <div class="card employment-history-data-card" data-index="${EmploymentHistoryIndex}">
            <div class="card-body">
                <h4 class="card-title">Data Pekerjaan ${EmploymentHistoryIndex + 1}</h4>
                <div class="row">
                    <button type="button" class="btn btn-danger btn-sm delete-employment-history-data" data-index="${EmploymentHistoryIndex}" style="position: absolute; top: 5px; right: 5px;">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_perusahaan_${EmploymentHistoryIndex}">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan_${EmploymentHistoryIndex}" name="nama_perusahaan[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="divisi_${EmploymentHistoryIndex}">Divisi</label>
                            <input type="text" class="form-control" id="divisi_${EmploymentHistoryIndex}" name="divisi[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jabatan_${EmploymentHistoryIndex}">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan_${EmploymentHistoryIndex}" name="jabatan[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_atasan_${EmploymentHistoryIndex}">Nama Atasan</label>
                            <input type="text" class="form-control" id="nama_atasan_${EmploymentHistoryIndex}" name="nama_atasan[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan_atasan_${EmploymentHistoryIndex}">Jabatan Atasan</label>
                            <input type="text" class="form-control" id="jabatan_atasan_${EmploymentHistoryIndex}" name="jabatan_atasan[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_masuk_${EmploymentHistoryIndex}">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk_${EmploymentHistoryIndex}" name="tanggal_masuk[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_keluar_${EmploymentHistoryIndex}">Tanggal Keluar</label>
                            <input type="date" class="form-control" id="tanggal_keluar_${EmploymentHistoryIndex}" name="tanggal_keluar[${EmploymentHistoryIndex}]" placeholder="">
                        </div>
                    </div>
                </div>
                


                <input type="hidden" name="employment_history_ids[${EmploymentHistoryIndex}]" value="">
            </div>
        </div>`;

            $('#employment-history-data-container').append(newEmploymentHistoryData);
            EmploymentHistoryIndex++;
        });

        // Delete Employment History data form
        $('#employment-history-data-container').on('click', '.delete-employment-history-data', function() {
            var index = $(this).data('index');
            var employmentHistoryId = $(`.employment-history-data-card[data-index="${index}"] input[name="employment_history_ids[${index}]"]`).val();
            $(`.employment-history-data-card[data-index="${index}"]`).remove();
            EmploymentHistoryIndex--;
            $('#add-employment-history-data').prop('disabled', false); // Enable the add button after deletion
            // Show confirmation dialog
            if (confirm('Are you sure you want to delete this employment history data?')) {
                // Make an AJAX request to delete the family data from the database
                $.ajax({
                    type: 'POST',
                    url: '{{ route("UserEmploymentHistory.delete", ":id") }}'.replace(':id', employmentHistoryId),
                    data: {
                        id: employmentHistoryId
                    },
                    success: function(response) {
                        if (response.success) {
                            reIndexEmploymentHistoryData();
                            console.log('Employment history data deleted successfully');
                        } else {
                            console.error('Failed to delete employment history data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting employment history data:', xhr.responseText);
                    }
                });
            }
        });

        function reIndexEmploymentHistoryData() {
            $('#employment-history-data-container .employment-history-data-card').each(function(i) {
                $(this).attr('data-index', i);
                $(this).find('.card-title').text('Data Pekerjaan ' + (i + 1));
                $(this).find('[id^=nama_perusahaan_]').attr('id', 'nama_perusahaan_' + i).attr('name', 'nama_perusahaan[' + i + ']');
                $(this).find('[id^=divisi_]').attr('id', 'divisi_' + i).attr('name', 'divisi[' + i + ']');
                $(this).find('[id^=jabatan_]').attr('id', 'jabatan_' + i).attr('name', 'jabatan[' + i + ']');
                $(this).find('[id^=nama_atasan_]').attr('id', 'nama_atasan_' + i).attr('name', 'nama_atasan[' + i + ']');
                $(this).find('[id^=jabatan_atasan_]').attr('id', 'jabatan_atasan_' + i).attr('name', 'jabatan_atasan[' + i + ']');
                $(this).find('[id^=tanggal_masuk_]').attr('id', 'tanggal_masuk_' + i).attr('name', 'tanggal_masuk[' + i + ']');
                $(this).find('[id^=tanggal_keluar_]').attr('id', 'tanggal_keluar_' + i).attr('name', 'tanggal_keluar[' + i + ']');
                $(this).find('[name^=employment_history_ids]').attr('name', 'employment_history_ids[' + i + ']');
                $(this).find('.delete-employment-history-data').attr('data-index', i);
            });
        }


        // Toggle icon on collapse
        $('.collapse').on('show.bs.collapse', function() {
            $(this).prev('.card-header').find('.fas').removeClass('fa-plus').addClass('fa-minus');
        }).on('hide.bs.collapse', function() {
            $(this).prev('.card-header').find('.fas').removeClass('fa-minus').addClass('fa-plus');
        });



    });
</script>
@endsection