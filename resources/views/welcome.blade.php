@extends('layouts.app')


@section('content')
<style>
    .plus-jakarta-sans {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-optical-sizing: auto;
        /* font-weight: 400; */
        font-style: normal;
    }

    /*Background color*/
    #grad1 {
        background-color: #9C27B0;
        background-image: linear-gradient(100deg, #90EE90, #81D4FA);
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 0 10px 10px #fff;
        /* Ensure the gradient doesn't overflow #FF4081*/
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgb(237 255 239 / 30%);
        border-radius: 6.25rem;
        /* border-bottom: 1px solid rgba(0, 0, 0, .125); */
    }

    .cardNew {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: rgb(156 255 223 / 5%);
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 2.25rem;
    }

    .filterCard {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: rgb(5 142 0 / 60%);
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 1.25rem;
    }

    .sliderCard {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 1.25rem;
    }

    .big-card {
        height: 300px;
        /* Adjust card height as needed */
        background-size: cover;
        background-position: center;
        transition: transform 0.3s;
    }

    .big-card:hover {
        transform: scale(1.1);
    }
</style>

<!-- SLIDE 1 -->
<section class="home-slider owl-carousel">
    <div class="slider-item sliderCard" style="background-image: url('{{ asset('assets/images/eco1.jpg') }}');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-7 text-center col-sm-12 element-animate">
                    <!-- <div class="btn-play-wrap mx-auto">
                            <p class="mb-4"><a href="https://www.youtube.com/watch?v=9j5f00-qiF8" data-fancybox
                                    data-ratio="2" class="btn-play"><span class="ion ion-ios-play"></span></a></p>
                        </div> -->
                    <h2 style="font-family: monospace; color: rgba(255, 255, 255, 0.8);">Welcome Future ecoFam</h2>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h2 style="font-family: monospace; color: rgba(255, 255, 255, 0.8);">E - R E C R U I T M E N T</h2>
                    <!-- <h2 class="text-white">PT . ECOCARE INDO PASIFIK</h2> -->
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 2 -->
    <div class="slider-item sliderCard" style="background-image: url('{{ asset('assets/images/eco5.jpeg') }}');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-7 text-center col-sm-12 element-animate">
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 3 -->
    <div class="slider-item sliderCard" style="background-image: url('{{ asset('assets/images/eco4.jpg') }}');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-7 text-center col-sm-12 element-animate">
                </div>
            </div>
        </div>
    </div>


</section>
<!-- END slider -->
<!-- </div> -->

<section>
    <div class="text-center justify-content-center mt-5 mb-3" id="kategori-lowongan">
        <h1>Gabungkan Kekuatan, Capai Tujuan Bersama</h1>
        <h4>Kembangkan Karir Anda Bersama Dengan Visi dan Misi Kami</h4>
        <br>
    </div>


    <!-- <section class="section"> -->

</section>

<section>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Categories</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container border-top mb-5">
            <div class="text-center mt-5 mb-5"">
                <h2>Kategori Lowongan</h2>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card big-card" style="cursor: pointer; background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/fresh-graduate.jpg') }}')" onclick="navigateToJobVacancies('Fresh Graduate')">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h3 class="card-title text-white mb-0" style="font-size: 50px; font-family: 'Trebuchet MS', sans-serif; line-height: 1;">Fresh Graduate</h3>
                                <p class="card-text text-white mt-2">Click to view</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="mb-3 mt-5 text-justify">
                                Terkadang, langkah pertama menuju kesuksesan adalah melangkah keluar dari zona nyaman dan mengejar peluang baru. Di perusahaan kami, kami mengundang para calon pelamar fresh graduate untuk mengembangkan diri dan mengeksplorasi potensi mereka. Bersama-sama, mari kita bangun masa depan yang cerah dan berdaya saing tinggi. Bergabunglah dengan kami dan jadilah bagian dari perjalanan menuju kesuksesan!
                            </p>
                        </div>
                        <div>
                            <button class="btn-sm btn-outline-success" onclick="navigateToJobVacancies('Fresh Graduate')">Lihat lowongan</button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="mb-3 mt-5 text-justify">
                                Dalam mengejar kesuksesan, seringkali kita harus memutuskan untuk menantang diri sendiri di lingkungan profesional yang baru. Di perusahaan kami, kami mengajak para calon pelamar yang memiliki pengalaman untuk merintis langkah baru dan mencapai puncak prestasi bersama-sama. Gabunglah dengan kami dalam membangun masa depan yang cemerlang dan penuh prestasi!
                            </p>
                        </div>
                        <div>
                            <button class="btn-sm btn-outline-success" onclick="navigateToJobVacancies('Professional')">Lihat lowongan</button>
                        </div>
                    </div> -->
                    <div class="col-md-6 mb-4">
                        <div class="card big-card" style="cursor: pointer; background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/professional.jpg') }}')" onclick="navigateToJobVacancies('Professional')">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h3 class="card-title text-white mb-0" style="font-size: 50px; font-family: 'Trebuchet MS', sans-serif; line-height: 1;">Professional</h3>
                                <p class="card-text text-white mt-2">Click to view</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card big-card" style="cursor: pointer; background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/operasional.jpg') }}')" onclick="navigateToJobVacancies('Cabang Operasional')">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h3 class="card-title text-white mb-0" style="font-size: 50px; font-family: 'Trebuchet MS', sans-serif; line-height: 1;">Cabang Operasional</h3>
                                <p class="card-text text-white mt-2">Click to view</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="mb-3 mt-5 text-justify">
                                Ketika kita mencari jalan menuju kesuksesan, seringkali kita menemukan bahwa peran di cabang operasional merupakan langkah yang penting dan strategis. Di perusahaan kami, kami membutuhkan individu yang penuh semangat dan berbakat untuk mengelola operasional kami dengan efisien. Mari bersama-sama kita ciptakan masa depan yang sukses dan dinamis!
                            </p>
                        </div>
                        <div>
                            <button class="btn-sm btn-outline-success" onclick="navigateToJobVacancies('Cabang Operasional')">Lihat lowongan</button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="mb-3 mt-5 text-justify">
                                Dalam menjelajahi dunia profesional, seringkali kesempatan pertama yang diberikan melalui magang adalah langkah awal yang penting. Di perusahaan kami, kami menyambut para calon pelamar magang yang ingin memperoleh pengalaman berharga dan memperluas pengetahuan mereka di berbagai bidang. Bergabunglah dengan kami dan mari bersama-sama membangun pondasi yang kuat untuk karier yang gemilang!
                            </p>
                        </div>
                        <div>
                            <button class="btn-sm btn-outline-success" onclick="navigateToJobVacancies('Internship')">Lihat lowongan</button>
                        </div>
                    </div> -->
                    <div class="col-md-6 mb-4">
                        <div class="card big-card" style="cursor: pointer; background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/internship.jpg') }}')" onclick="navigateToJobVacancies('Internship')">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h3 class="card-title text-white mb-0" style="font-size: 50px; font-family: 'Trebuchet MS', sans-serif; line-height: 1;">Internship</h3>
                                <p class="card-text text-white mt-2">Click to view</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function navigateToJobVacancies(jobLevel) {
                // Build the URL with the job_level parameter
                var url = '{{ route("filter.index") }}';
                if (jobLevel) {
                    url += '?job_level=' + encodeURIComponent(jobLevel);
                }
                // Redirect to the job-filter page with the job_level parameter set
                window.location.href = url;
            }
        </script>

        <div class="container border-top mb-5">
            <div class="text-center mt-5 mb-5">
                <h3>Why Join Us?</h3>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 element-animate ">
                    <div class="media block-6 d-block text-center">
                        <div class="icon mb-3"><span class="ion-android-globe text-primary"></span></div>
                        <div class="media-body">
                            <h3 class="heading">Berdiri sejak 2007</h3>
                            <p> ecoCare telah memberikan layanan kepada Pelanggannya Pertama sejak 7 Juli 2007</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 element-animate ">
                    <div class="media block-6 d-block text-center">
                        <div class="icon mb-3"><span class="ion-flash text-primary"></span></div>
                        <div class="media-body">
                            <h3 class="heading">Berkembang Pesat</h3>
                            <p>ecoCare Group Company tersebar di lebih dari 27 cabang seluruh Indonesia </p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-4 element-animate ">
                    <div class="media block-6 d-block text-center">
                        <div class="icon mb-3"><span class="ion-arrow-graph-up-right text-primary"></span></div>
                        <div class="media-body">
                            <h3 class="heading"> Jenjang Karir </h3>
                            <p>Peningkatan jenjang karir sangat terbuka lebar bagi seluruh ecoFam berprestasi</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</section>

<!-- END section -->

@include('sweetalert::alert')
@endsection