<!DOCTYPE html>
<html>

<head>
    <title>Update Job Application Anda ({{ $minat }})</title>
</head>
@if($status == 'Accepted')

<body>
    <h1>Application Status Update : <a href="{{route('job-applied.status',['id' => $id_pelamar])}}">{{ $status }}.</a></b></h1>
    <p>Halo {{ $nama }} ! ,</p>
    <p>Selamat ! anda diterima untuk posisi <b>{{$minat}}</b> Selanjutnya anda dapat datang kembali dengan detail sebagai berikut <b></p>
    <p>Jadwal : <b>{{ $jadwal }}.</b></p>
    <p>Lokasi : <b>{{ $lokasi }}.</b></p>
    <p>Note : <b>{{ $keterangan }}.</b></p>
</body>
@elseif($status == 'Declined')

<body>
    <h1>Application Status Update : <a href="{{route('job-applied.status',['id' => $id_pelamar])}}">{{ $status }}.</a></b></h1>
    <p>Mohon maaf untuk saat ini anda belum memenuhi kriteria yang kami inginkan untuk mengisi posisi .</p>
    <p>Terimakasih atas partisipasinya.</p>
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