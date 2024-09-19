<!DOCTYPE html>
<html>

<head>
    <title>Informasi Data Diri Calon Pekerja</title>

    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 13pt;
        }

        .address {
            font-size: 14px;
            color: #6c757d;
        }


    </style>
</head>

<body>
    <!-- Header -->
    <h1>
        <center>
            <font size="6" face="arial">ecoCare Group Company</font>
        </center>
    </h1>
    <center><small>Grand Slipi Tower Suite F-I 37th floor Jl. S. Parman Kav. 22-24 Jakarta 11480</small></center><br>
    <hr>
    <width="100" height="75">
        </hr>

        <h3 style="text-align: center;">Daftar Identitas Kandidat</h3>
        <br>
        <br>
        @if(env('APP_URL') == 'http://localhost')
        <img src="https://images.freeimages.com/fic/images/icons/2526/bloggers/256/admin.png" class="img-fluid" style=" height: 150px; background-size: contain;">
        @else
        <img src="{{ asset('uploads/images/' . $result->userData->upload_foto) }}" class="img-fluid" style=" height: 150px; background-size: contain;">
        @endif

        <!-- Content -->

        <table class='table table-bordered'>

            <tbody>


                <tr>
                    <td width="25%" valign="top" class="text">NIK</td>
                    <td width="2%">:</td>
                    <td style="color: rgb(118, 157, 29); font-weight:bold">{{$result->userData->nik}} </td>
                </tr>

                <tr>
                    <td class="text">Nama Lengkap</td>
                    <td>:</td>
                    <td>{{$result->userData->nama_lengkap}} </td>
                </tr>

                <tr>
                    <td class="text">Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$result->userData->jenis_kelamin =='P' ? 'Perempuan' : 'Laki-laki' }} </td>
                </tr>

                <tr>
                    <td class="text">Tempat Lahir</td>
                    <td>:</td>
                    <td>{{$result->userData->tempat_lahir}} </td>
                </tr>

                <tr>
                    <td class="text">Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{$result->userData->tanggal_lahir}} </td>
                </tr>

                <tr>
                    <td class="text">Alamat</td>
                    <td>:</td>
                    <td>{{$result->userData->alamat}}</td>
                </tr>

                <tr>
                    <td class="text">Email</td>
                    <td>:</td>
                    <td>{{$result->userData->email}}</td>
                </tr>

                <tr>
                    <td class="text">No. Telepon</td>
                    <td>:</td>
                    <td>{{$result->userData->no_hp}}</td>
                </tr>

                <tr>
                    <td class="text">Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>{{$result->userData->pendidikan_terakhir}} {{$result->userData->jurusan}}, {{$result->userData->institusi}}</td>
                </tr>

                <tr>
                    <td class="text">Minat Karir</td>
                    <td>:</td>
                    <td>{{$result->job_vacancy->job_title}}</td>
                </tr>

                <tr>
                    <td class="text">Preferensi Lokasi</td>
                    <td>:</td>
                    <td>{{$result->userData->pref_location}}</td>
                </tr>

            </tbody>

        </table>

</body>

</html>