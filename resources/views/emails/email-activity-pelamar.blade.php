<!DOCTYPE html>
<html>

<head>
    <title>Update Job Application Anda ({{ $minat }})</title>
</head>
@if($status == 'Accepted')

<body>
    <h1>Application Status Update : <a href="{{route('job-applied.status',['id' => $id_pelamar])}}">{{ $status }}.</a></b></h1>
    <p>Halo {{ $nama }} ! ,</p>
    <p>
        Kami dengan senang hati ingin memberitahu bahwa Anda telah berhasil lolos dalam proses seleksi penerimaan pekerjaan di <strong>ecoCare Group</strong>. Selamat atas pencapaian ini!
    </p>
    <p>
        Setelah melalui evaluasi yang cermat, kami yakin bahwa Anda memiliki kualifikasi, keterampilan, dan dedikasi yang kami cari untuk posisi <strong>{{ $minat }}</strong>. Kami percaya bahwa kontribusi Anda akan membawa nilai tambah bagi tim kami.
    </p>
    <p>
        Terima kasih atas komitmen dan dedikasi Anda selama proses seleksi ini. Kami berharap dapat bekerja sama dengan Anda di ecoCare Group.
    </p>
    <p>
        Selamat kembali dan selamat bergabung dengan tim kami!
    </p>
    <p>Kami harapkan kehadiran anda pada detail berikut : <b></p>
    <p>Jadwal : <b>{{ $jadwal }}.</b></p>
    <p>Lokasi : <b>{{ $lokasi }}.</b></p>
    <p>Note : <b>{{ $keterangan }}.</b></p>
</body>
@elseif($status == 'Declined')

<body>
    <h1>Application Status Update : <a href="{{route('job-applied.status',['id' => $id_pelamar])}}">{{ $status }}.</a></b></h1>
    <h2 class="fs-title">Terimakasih !</h2>
    <div style="text-align: justify;">
        <p>
            Kami ingin menyampaikan terima kasih atas partisipasi Anda dalam proses seleksi lamaran pekerjaan di ecoCare Group. Kami menghargai waktu dan usaha yang Anda investasikan dalam mengajukan lamaran.
        </p>

        <p>
            Setelah melalui proses evaluasi yang cermat, kami ingin memberitahukan bahwa saat ini kami telah menyelesaikan proses seleksi, dan sayangnya, lamaran Anda <strong>belum memenuhi kriteria</strong> yang kami cari untuk posisi <strong>{{ $minat }}</strong>.
        </p>

        <p>
            Meskipun Anda tidak lolos pada tahap ini, kami tetap menghargai minat dan dedikasi Anda untuk bergabung dengan <strong>ecoCare Group</strong>. Terima kasih sekali lagi atas partisipasi Anda. Kami senang Anda tertarik untuk bergabung dengan tim kami dan berharap Anda dapat mencapai sukses besar di masa mendatang.
        </p>
    </div>
</body>
@else

<body>
    <h1>Application Status Update</h1>
    <p>Halo {{ $nama }} ! ,</p>
    <p>Job application kamu untuk posisi <b>{{$minat}}</b> sudah kami terima dan dapat mengikuti tahap selanjutnya yaitu <b><a href="{{route('job-applied.status',['id' => $id_pelamar])}}">{{ $status }}.</a></b></p>
    <p>Berikut jadwal untuk tahap selanjutnya :</p>
    <p>Tahap : <b>{{ $this_activity }}.</b></p>
    <p>Jadwal : <b>{{ $jadwal }}.</b></p>
    <p>Lokasi : <b>{{ $lokasi }}.</b></p>
    <p>Note : <b>{{ $keterangan }}.</b></p>
    <!-- Add more content as needed -->
    <br>
    <p>Mohon dapat hadir tepat waktu sesuai dengan jadwal yang sudah diberikan.</p>
</body>
@endif

</html>