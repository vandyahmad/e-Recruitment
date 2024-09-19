<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Interview Form</title>

    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }

        .header img {
            position: absolute;
            left: 20px;
            top: 20px;
            height: 80px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header h2 {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #555;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            /* background-color: #f4f4f4; */
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        .section-sub-title {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .info-group {
            display: table;
            width: 100%;
            margin-bottom: 0px;
        }

        .info-group .question,
        .info-group .answer {
            display: table-cell;
            padding: 5px;
            font-size: x-small;
        }

        .info-group .question {
            font-weight: bold;
            color: #555;
            width: 200px;
        }

        .info-group .answer {
            color: black;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: xx-small;
        }

        table th {
            background-color: #f2f2f2;
            text-align: left;

        }

        .pertanyaan {
            font-weight: bold;
            font-size: xx-small;
            color: #333;
            margin-bottom: 5px;
        }

        .jawaban {
            color: black;
            font-size: xx-small;
            margin-bottom: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>


    @if(app()->environment('local'))
    <img src="{{ public_path('assets/images/ecocare-group-logo.jpg')}}" alt="company logo" style="position: absolute; left: 0px; top: 20px; height: 50px;">
    @else
    <img src="{{ asset('assets/images/ecocare-group-logo.jpg')}}" alt="company logo" style="position: absolute; left: 0px; top: 20px; height: 50px;">
    @endif


</head>

<body>
    <div class="header">
        <h1>ecoCare Group Company</h1>
        <h2>Interview Form</h2>
    </div>

    <div style="width: 30%; float: left; margin-left: 40px; margin-top: 20px;">
        @if(app()->environment('local'))
        <img src="{{ public_path('public/uploads/images/' . $userData->upload_foto) }}" alt="User profile picture" style="width: 140px; height: 175px; border-radius: 50%; border: 1px solid #333">
        @else
        <img src="{{ asset('uploads/images/' . $userData->upload_foto) }}" alt="User profile picture" style="width: 140px; height: 175px; border-radius: 50%; border: 1px solid #333">
        @endif
    </div>
    <div style="width: 65%; float: right;">
        <div class="header" style="margin-right: 40px; margin-bottom: 0px">
            <h2>{{ $userData->nama_lengkap }}</h2>
            <small style="font-size: xx-small;">{{ $userData->pendidikan_terakhir }} {{ $userData->jurusan }}, {{ $userData->institusi }}</small>
        </div>
        <div class="info-group">
            <div class="question">Pekerjaan yang dilamar</div>
            <div class="answer">: {{ $pelamar->job_vacancy->job_title }}</div>
        </div>
        <div class="info-group">
            <div class="question">ecoCare Group Company</div>
            <div class="answer">: {{ $pelamar->job_vacancy->job_company }}</div>
        </div>
        <div class="info-group">
            <div class="question">Sumber Info Lowongan</div>
            <div class="answer">: {{ $userData->info_lowongan }}</div>
        </div>
    </div>

    <br style="clear: both;">

    <div class="container">
        <!-- <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/public/uploads/images/'.$userData->upload_foto)}}" alt="User profile picture">
        </div> -->
        <!-- <h3>{{ $userData->nama_lengkap }}</h3> -->
        <div class="section">
            <div class="section-title">A. Identitas Diri</div>
            <div class="info-group">
                <div class="question">Nama Lengkap</div>
                <div class="answer">: {{ $userData->nama_lengkap }}</div>
            </div>
            <div class="info-group">
                <div class="question">Nama Panggilan</div>
                <div class="answer">: {{ $userData->nama_panggilan }}</div>
            </div>
            <div class="info-group">
                <div class="question">Tempat, Tanggal Lahir</div>
                <div class="answer">: {{ $userData->tempat_lahir }}, {{ \Carbon\Carbon::parse($userData->tanggal_lahir)->format('d/m/Y') }}</div>
            </div>
            <div class="info-group">
                <div class="question">Jenis Kelamin</div>
                <div class="answer">: {{ $userData->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</div>
            </div>
            <div class="info-group">
                <div class="question">Agama</div>
                <div class="answer">: {{ $userData->agama }}</div>
            </div>
            <div class="info-group">
                <div class="question">Status Perkawinan</div>
                <div class="answer">: {{ $userData->status_kawin }}</div>
            </div>
            <div class="info-group">
                <div class="question">Tinggi Badan</div>
                <div class="answer">: {{ $userData->tinggi_badan }} cm</div>
            </div>
            <div class="info-group">
                <div class="question">Berat Badan</div>
                <div class="answer">: {{ $userData->berat_badan }} kg</div>
            </div>
            <div class="info-group">
                <div class="question">Email</div>
                <div class="answer">: {{ $userData->email }}</div>
            </div>
            <div class="info-group">
                <div class="question">No. Hp</div>
                <div class="answer">: +62{{ $userData->no_hp }}</div>
            </div>
            <div class="info-group">
                <div class="question">Warga Negara</div>
                <div class="answer">: {{ $userData->warga_negara }}</div>
            </div>
            <div class="info-group">
                <div class="question">Alamat KTP</div>
                <div class="answer">:
                    {{ $userData->jalan_ktp }} No. {{ $userData->no_rumah_ktp }},
                    RT {{ $userData->rt_ktp }}/RW {{ $userData->rw_ktp }},
                    Kel. {{ $userData->kel_ktp }},
                    Kec. {{ $userData->kec_ktp }},
                    {{ $userData->kota_ktp }},
                    {{ $userData->prov_ktp }} - {{ $userData->kode_pos_ktp }}
                </div>
            </div>
            <div class="info-group">
                <div class="question">Alamat Domisili</div>
                <div class="answer">:
                    {{ $userData->jalan_domisili }} No. {{ $userData->no_rumah_domisili }},
                    RT {{ $userData->rt_domisili }}/RW {{ $userData->rw_domisili }},
                    Kel. {{ $userData->kel_domisili }},
                    Kec. {{ $userData->kec_domisili }},
                    {{ $userData->kota_domisili }},
                    {{ $userData->prov_domisili }} - {{ $userData->kode_pos_domisili }}
                </div>
            </div>
            <div class="info-group">
                <div class="question">Rumah yang Ditinggali</div>
                <div class="answer">: {{ $userData->tempat_tinggal }}</div>
            </div>
            <div class="info-group">
                <div class="question">Kendaraan yang Dimiliki</div>
                <div class="answer">: {{ $userData->kendaraan }}</div>
            </div>
            <div class="info-group">
                <div class="question">SIM A</div>
                <div class="answer">: {{ $userData->sim_a }}</div>
            </div>
            <div class="info-group">
                <div class="question">SIM B</div>
                <div class="answer">: {{ $userData->sim_b }}</div>
            </div>
            <div class="info-group">
                <div class="question">SIM C</div>
                <div class="answer">: {{ $userData->sim_c }}</div>
            </div>
            <div class="info-group">
                <div class="question">Hobi</div>
                <div class="answer">: {{ $userData->hobi }}</div>
            </div>
            <div class="info-group">
                <div class="question">Kemampuan Bahasa Inggris</div>
                <div class="answer">: {{ $userData->kemampuan_english }}</div>
            </div>
            <div class="info-group">
                <div class="question">Kemampuan Komputer</div>
                <div class="answer">: {{ $userData->kemampuan_komputer }}</div>
            </div>
            <div class="info-group">
                <div class="question">Kemampuan Khusus</div>
                <div class="answer">: {{ $userData->kemampuan_khusus }}</div>
            </div>
            <div class="info-group">
                <div class="question">Aktifitas Sosial</div>
                <div class="answer">: {{ $userData->aktifitas_sosial }}</div>
            </div>
            <div class="info-group">
                <div class="question">Riwayat Sakit</div>
                <div class="answer">: {{ $userData->riwayat_sakit }}</div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">B. Data Keluarga</div>
            <table>
                <thead>
                    <tr>
                        <th>Data Keluarga</th>
                        <th>Hubungan Keluarga</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Pekerjaan</th>
                        <th>Perusahaan Tempat Bekerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDataFamilies as $index => $family)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $family->hubungan }}</td>
                        <td>{{ $family->nama }}</td>
                        <td>@switch($family->jenis_kelamin)
                            @case('L')
                            Laki-laki
                            @break
                            @case('P')
                            Perempuan
                            @break
                            @endswitch
                        </td>
                        <td>{{ $family->usia }} th</td>
                        <td>{{ $family->pekerjaan }}</td>
                        <td>{{ $family->perusahaan_tempat_kerja }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">C. Riwayat Pendidikan</div>
            <div class="section-sub-title">Pendidikan Formal</div>
            <table>
                <thead>
                    <tr>
                        <th>Tingkat</th>
                        <th>Nama Sekolah</th>
                        <th>Kota</th>
                        <th>Tahun Mulai</th>
                        <th>Tahun Selesai</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    @if($userDataEducation->instansi_sd)
                    <tr>
                        <td>SD</td>
                        <td>{{ $userDataEducation->instansi_sd }}</td>
                        <td>{{ $userDataEducation->kota_sd }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_sd }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_sd }}</td>
                        <td>-</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_smp)
                    <tr>
                        <td>SMP</td>
                        <td>{{ $userDataEducation->instansi_smp }}</td>
                        <td>{{ $userDataEducation->kota_smp }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_smp }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_smp }}</td>
                        <td>-</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_sma)
                    <tr>
                        <td>SMA</td>
                        <td>{{ $userDataEducation->instansi_sma }}</td>
                        <td>{{ $userDataEducation->kota_sma }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_sma }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_sma }}</td>
                        <td>{{ $userDataEducation->jurusan_sma }}</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_d3)
                    <tr>
                        <td>Diploma 3</td>
                        <td>{{ $userDataEducation->instansi_d3 }}</td>
                        <td>{{ $userDataEducation->kota_d3 }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_d3 }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_d3 }}</td>
                        <td>{{ $userDataEducation->jurusan_d3 }}</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_s1)
                    <tr>
                        <td>Sarjana</td>
                        <td>{{ $userDataEducation->instansi_s1 }}</td>
                        <td>{{ $userDataEducation->kota_s1 }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_s1 }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_s1 }}</td>
                        <td>{{ $userDataEducation->jurusan_s1 }}</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_s2)
                    <tr>
                        <td>Magister</td>
                        <td>{{ $userDataEducation->instansi_s2 }}</td>
                        <td>{{ $userDataEducation->kota_s2 }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_s2 }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_s2 }}</td>
                        <td>{{ $userDataEducation->jurusan_s2 }}</td>
                    </tr>
                    @endif
                    @if($userDataEducation->instansi_s3)
                    <tr>
                        <td>Doktor</td>
                        <td>{{ $userDataEducation->instansi_s3 }}</td>
                        <td>{{ $userDataEducation->kota_s3 }}</td>
                        <td>{{ $userDataEducation->tahun_mulai_s3 }}</td>
                        <td>{{ $userDataEducation->tahun_selesai_s3 }}</td>
                        <td>{{ $userDataEducation->jurusan_s3 }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <div class="section-sub-title">Pendidikan Non Formal</div>
            <table>
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Bidang/Judul</th>
                        <th>Penyelenggara</th>
                        <th>Kota</th>
                        <th>Lama Pendidikan</th>
                        <th>Tahun Ikut Serta</th>
                        <th>Dibiayai Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $userDataEducation->jenis_informal }}</td>
                        <td>{{ $userDataEducation->judul_informal }}</td>
                        <td>{{ $userDataEducation->penyelenggara_informal }}</td>
                        <td>{{ $userDataEducation->kota_informal }}</td>
                        <td>{{ $userDataEducation->durasi_informal }}</td>
                        <td>{{ $userDataEducation->tahun_informal }}</td>
                        <td>{{ $userDataEducation->informal_dibiayai_oleh }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="section-title">D. Riwayat Pekerjaan</div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Nama Atasan</th>
                        <th>Jabatan Atasan</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDataEmployments as $index => $employ)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employ->nama_perusahaan }}</td>
                        <td>{{ $employ->divisi }}</td>
                        <td>{{ $employ->jabatan }}</td>
                        <td>{{ $employ->nama_atasan }}</td>
                        <td>{{ $employ->jabatan_atasan }}</td>
                        <td>{{ $employ->tanggal_masuk }}</td>
                        <td>{{ $employ->tanggal_keluar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="section page-break">
            <div class="section-title">E. Pertanyaan</div>
            @foreach($questions as $question)
            <div class="pertanyaan">{{ $question->id }}. {{ $question->question }}</div>
            <div class="jawaban">
                @if($question->question_type == 'YesNo')
                <span>Jawaban: <b>{{ $userDataAnswers->where('question_id', $question->id)->first()->answer ?? '-' }}</b></span>
                <span style="margin-left: 20px;">Penjelasan: <b>{{ $userDataAnswers->where('question_id', $question->id)->first()->explain ?? '-' }}</b></span>
                @elseif($question->question_type == 'Explain')
                Jawaban : <b>{{ $userDataAnswers->where('question_id', $question->id)->first()->explain ?? '-' }}</b>
                @endif
            </div>
            <hr style="width: 100%; border: 1px solid gray">
            @endforeach
        </div>

        <!-- <p class="info" style="color: red; font-size: smaller; text-align: justify">Semua keterangan diatas adalah benar adanya sampai dengan tanggal dibuatnya keterangan tersebut. Apabila di kemudian hari ternyata terdapat atau ditemukan hal-hal yang tidak benar mengenai keterangan saya diatas, maka saya bersedia diberhentikan tanpa syarat apapun.</p> -->
    </div>
</body>

</html>