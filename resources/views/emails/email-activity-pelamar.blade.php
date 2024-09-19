<!DOCTYPE html>
<html>

<head>
    <title>Update Job Application Anda ({{ $minat }})</title>
</head>

@if($this_activity == 'Accepted')

<body>
    <h3>Selamat Datang di ecoCare Group Company</h3>
    <p>Halo {{ $nama }} ! ,</p>
    <p>
        Selamat! <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong> dengan senang hati memberikan selamat datang kepada Anda sebagai <b>{{$minat}}</b> penempatan <b>{{$minat_lokasi}}</b>.
    </p>
    <p>
        Latar belakang, keterampilan, dan pengalaman Anda telah membuat kami terkesan sepanjang proses rekrutmen. Kami yakin bahwa Anda akan menjadi tambahan yang berharga bagi tim serta menjunjung visi-misi kami.
    </p>
    <p>
        Hari pertama Anda dijadwalkan pada<br>
        <br>
        &emsp;Tanggal&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->translatedFormat('d-F-Y') }}</b><br>
        &emsp;Waktu&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->format('H:i') }} WIB</b><br>
        &emsp;Tempat&nbsp;: <b>{!! ($lokasi) !!}</b>
        <br>
        <br>
        pada hari tersebut juga Anda akan menandatangani Perjanjian Kerja. Mohon maksimal 1x24 jam sebelumnya, Anda dapat :
    <ul>
        <li><a href=" {{route('pelamar.detail-login-user')}}">Melengkapi data karyawan baru</a> pada profile Anda di website <a href="https://recruitment.ecocare.co.id/detail-profile">recruitment.ecocare.co.id</a>"</li>
        <li>Membawa Materai Rp 10.000,-</li>
    </ul>
    </p>
    <p>
        Jika Anda memiliki pertanyaan sebelum tanggal mulai Anda, jangan ragu untuk menghubungi miracle@ecocare.co.id.
    </p>
    <p>
        Kami akan mempersiapkan diri untuk menyambut Anda. Sekali lagi, selamat datang di keluarga <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong>!<br>
        Let’s accomplish millions of achievements together!
    </p>
    <p>Best regards,</p>
    <br>
    <p><b>Recruitment</b><br>
        <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong><br>
        <b>#ECGHiring</b><br>
        <br>
        Grand Slipi Tower Lt.37<br>
        Jl. S. Parman kav. 22-24<br>
        Palmerah, Slipi, Jakarta Barat<br>
        <a href="https://www.ecocare.id/"> www.ecocare.co.id</a>
    </p>
</body>

@elseif($this_activity == 'Declined')

<body>
    <h3>Hasil Rekrutmen ecoCare Group Company</h3>
    <p>Kepada {{ $nama }},</p>
    <p>
        Salam bersih dan sehat dari <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong>.
    </p>
    <p>
        Kami berterima kasih atas keinginan, usaha, serta waktu yang telah Anda berikan untuk menjalani proses rekrutmen sebagai <b>{{$minat}}</b> dengan kami.
    </p>
    <p>
        Lamaran dan wawancara Anda bersama kami telah meninggalkan kesan yang positif. Kami terkesan dengan kualifikasi, pencapaian, dan antusiasme Anda terhadap keahlian Anda.
    </p>
    <p>
        Namun, dengan berat hati kami belum dapat menawarkan Anda posisi tersebut. Meskipun begitu, kami yakin keterampilan dan pengalaman Anda akan menjadi kontribusi yang berarti di dalam tim kami suatu hari nanti.
    </p>
    <p>
        <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong> selalu mencari individu berbakat seperti Anda, dan kami percaya mungkin ada peran lain untuk Anda yang sejalan dengan visi kami di masa depan.
    </p>
    <p>
        Terima kasih sekali lagi atas keinginan Anda untuk bergabung dengan <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong>.<br> Semoga sukses dan bahagia selalu!
    </p>
    <p>Best regards,</p>
    <br>
    <p><b>Recruitment</b><br>
        <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong><br>
        <b>#ECGHiring</b><br>
        <br>
        Grand Slipi Tower Lt.37<br>
        Jl. S. Parman kav. 22-24<br>
        Palmerah, Slipi, Jakarta Barat<br>
        <a href="https://www.ecocare.id/"> www.ecocare.co.id</a>
    </p>
</body>

<!-- @elseif($this_activity == 'Apply')

<body>
    <h2 class="fs-title">Halo {{ $nama }} ! ,</h2>
    <div style="text-align: justify;">
        <p>Terimaksih sudah melamar pekerjaan di <b>ecoCare Group Company</b></p>
        <p>Lamaran anda untuk posisi <b>{{$minat}}</b> sudah kami terima.</p>
        <p>Kami akan melakukan proses screening terlebih dahulu untuk melihat apakah sesuai dengan requirement yang kami butuhkan untuk posisi tersebut.</p>
        <p>Mohon berkenan menunggu email lanjutan dari kami terkait status lamaran pekerjaan anda.</p>
    </div>
    <p>Salam hangat,</p>
    <br>
    <br>
    <h4><b>ecoCare Group Company</b></h4>
</body> -->


@elseif($isFirstInterview)

<body>
    <h3>Halo {{ $nama }} ,</h3>
    <p>Salam bersih dan sehat!</p>

    <p>Terimakasih atas keinginan Anda untuk bergabung dengan <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong> penempatan <b>{{$minat_lokasi}}</b> sebagai <b>{{$minat}}.</b></p>
    
    <p>Silahkan lengkapi profil Anda di website rekrutmen kami sebagai persyaratan rekrutmen, dengan meng-klik link berikut ini: <a href="{{url('form-interview')}}"><b>Formulir Interview</b></a></p>
    
    <p>Selanjutnya Kami mengundang Anda untuk hadir pada<br>
        <br>
        &emsp;Tahap&nbsp;: <b><a href=" {{route('job-applied.status',['id' => $id_pelamar])}}">{{ $this_activity }}</a></b><br>
        &emsp;Tanggal&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->translatedFormat('d-F-Y') }}</b><br>
        &emsp;Waktu&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->format('H:i') }} WIB</b><br>
        &emsp;Tempat&nbsp;: <b>{!! ($lokasi) !!}</b>
    </p>
    <p>Mohon kehadiran Anda minimal pada 15 menit sebelumnya.</p>
    <p>Kunjungi website kami: <span style="color:#6aa84f;"> ecoCare (<a href="https://www.ecocare.id/">ecocare.id</span>), <span style="color:#6fa8dc;"> Tukang Bersih Indonesia (<a href="https://tukangbersih.com/">tukangbersih.com)</span>, dan <span style="color:#cc0000;"> ecoCare Pest Control (<a href="https://pestcare.id/">pestcare.id)</span>.</p>
    <p>Note : Proses rekrutmen ini tidak membutuhkan biaya apapun. Jika ada pertanyaan, hubungi hr@ecocare.id.</p>
    <br>
    <p>Persiapkan diri Anda dan semoga berhasil!</p>
    <br>
    <p>Best regards,</p>
    <br>
    <p><b>Recruitment</b><br>
        <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong><br>
        <b>#ECGHiring</b><br>
        <br>

        Grand Slipi Tower Lt.37<br>
        Jl. S. Parman kav. 22-24<br>
        Palmerah, Slipi, Jakarta Barat<br>
        <a href="https://www.ecocare.id/"> www.ecocare.co.id</a>
    </p>
</body>
@else

<body>
    <h3>Halo {{ $nama }} ,</h3>
    <p>Salam bersih dan sehat!</p>

    <p>Terimakasih atas keinginan Anda untuk bergabung dengan <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong> penempatan <b>{{$minat_lokasi}}</b> sebagai <b>{{$minat}}.</b>
    <p>
        <!-- <a href=" {{route('job-applied.status',['id' => $id_pelamar])}}">{{ $this_activity }}.</a></b></p> -->
    <p>Kami mengundang Anda untuk hadir pada<br>
        <br>
        &emsp;Tahap&nbsp;: <b><a href=" {{route('job-applied.status',['id' => $id_pelamar])}}">{{ $this_activity }}</a></b><br>
        &emsp;Tanggal&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->translatedFormat('d-F-Y') }}</b><br>
        &emsp;Waktu&nbsp;: <b>{{ \Carbon\Carbon::parse($jadwal)->format('H:i') }} WIB</b><br>
        &emsp;Tempat&nbsp;: <b>{!! ($lokasi) !!}</b>
    </p>
    <p>Mohon kehadiran Anda minimal pada 15 menit sebelumnya.</p>
    <p>Kunjungi website kami: <span style="color:#6aa84f;"> ecoCare (<a href="https://www.ecocare.id/">ecocare.id</span>), <span style="color:#6fa8dc;"> Tukang Bersih Indonesia (<a href="https://tukangbersih.com/">tukangbersih.com)</span>, dan <span style="color:#cc0000;"> ecoCare Pest Control (<a href="https://pestcare.id/">pestcare.id)</span>.</p>
    <p>Note : Proses rekrutmen ini tidak membutuhkan biaya apapun. Jika ada pertanyaan, hubungi hr@ecocare.id.</p>
    <br>
    <p>Persiapkan diri Anda dan semoga berhasil!</p>
    <br>
    <p>Best regards,</p>
    <br>
    <p><b>Recruitment</b><br>
        <span style="color:#6aa84f;">eco</span><span style="color:#6fa8dc;">Care</span> <strong>Group Company</strong><br>
        <b>#ECGHiring</b><br>
        <br>
        Grand Slipi Tower Lt.37<br>
        Jl. S. Parman kav. 22-24<br>
        Palmerah, Slipi, Jakarta Barat<br>
        <a href="https://www.ecocare.id/"> www.ecocare.co.id</a>
    </p>
</body>

@endif

</html>