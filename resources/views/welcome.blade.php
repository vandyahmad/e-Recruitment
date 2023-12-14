@extends('layouts.app')


@section('content')

<style>
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
    /* border-bottom: 1px solid rgba(0, 0, 0, .125); */
  }
</style>

<!-- SLIDE 1 -->
<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url('assets/images/eco1.jpg');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center">
        <div class="col-lg-7 text-center col-sm-12 element-animate">
          <div class="btn-play-wrap mx-auto">
            <p class="mb-4"><a href="https://www.youtube.com/watch?v=9j5f00-qiF8" data-fancybox data-ratio="2" class="btn-play"><span class="ion ion-ios-play"></span></a></p>
          </div>
          <h2 class="text-white">SELAMAT DATANG</h2>
          <h1><strong>E - R E C R U I T M E N T</strong></h1>
          <!-- <h2 class="text-white">PT . ECOCARE INDO PASIFIK</h2> -->
        </div>
      </div>
    </div>
  </div>

  <!-- SLIDE 2 -->
  <div class="slider-item" style="background-image: url('assets/images/eco2.jpg');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center">
        <div class="col-lg-7 text-center col-sm-12 element-animate">
        </div>
      </div>
    </div>
  </div>
  <!-- SLIDE 3 -->
  <div class="slider-item" style="background-image: url('assets/images/eco3.jpg');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center">
        <div class="col-lg-7 text-center col-sm-12 element-animate">
        </div>
      </div>
    </div>
  </div>


</section>
<!-- END slider -->
</div>

<section>
  <!-- <div class="d-flex justify-content-center"> -->
  <!-- <div class="row col-md-12 "> -->
  <!-- <div class="container-fluid"> -->
  <!-- <div class="card user-details-card"> -->
  <!-- <div class="card-body"> -->
  <div class="row justify-content-center mt-5 mb-5">
    <h2>Lowongan Yang Kami Buka Untuk Anda</h2>
  </div>
  <!-- </div> -->

  @foreach ($jobvacancies as $jobvacancy)
  @if (strtotime($jobvacancy->job_end_date) >= strtotime(now()))
  <div id="accordion" class="d-flex justify-content-center">
    <div class="card mb-1 col-md-10 border-success">
      <div class="card-header mb-2" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $jobvacancy->id }}" aria-expanded="true" aria-controls="collapseOne">
            <h6>{{ $jobvacancy->job_title }} <i class="fas fa-angle-down"></i></h6>
          </button>
        </h5>
      </div>
      <div class="container-fluid" id="grad1">
        <div id="collapseOne{{ $jobvacancy->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion{{ $jobvacancy->id }}">
          <div class="card user-details-card">
            <div class="card-body">
              <h7><strong>Job Description :</strong></h7>
              <p>{!! $jobvacancy->job_description !!}</p>
              <h7><strong>Requirements:</strong></h7>
              <p>{!! $jobvacancy->job_requirement !!}</p>
              <p><strong>Location:</strong> {{ $jobvacancy->job_location }}</p>
              <p><strong>Date Opened:</strong> {{ $jobvacancy->job_start_date }}</p>
              <p><strong>Date Closed:</strong> {{ $jobvacancy->job_end_date }}</p>
              <div class="text-center">
                <button class="btn btn-primary" data-id="{{ $jobvacancy->id }}" data-toggle="modal" data-target="#ConfirmModal-{{ $jobvacancy->id }}">
                  <i class="fa fa-bolt"></i> Apply This
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div id="ConfirmModal-{{ $jobvacancy->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      {{-- Content / Isi Modal --}}
      <form id='applyForm{{ $jobvacancy->id}}' action="{{ route('pelamars.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title justify-content-center">Konfirmasi</h4>
            <input type="hidden" name="minat_karir" id="minat_karir" value="{{ $jobvacancy->id }}">
            <button type="button" class="close" data-dismiss="modal">
              &times;</button>
          </div>
          <div class="modal-body">
            <p class="text-center"> Apakah anda yakin sudah memenuhi kriteria yang tertera dan ingin submit lamaran untuk posisi <b>{{ $jobvacancy->job_title}}</b> ? </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-sm" onclick="confirmApply('{{$jobvacancy->id}}')">
              Ya, Submit
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
              Batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @endforeach

  <script>
    function confirmApply(JobVacancyID) {
      // If the user clicks "OK", submit the form
      document.getElementById("applyForm" + JobVacancyID).submit();
    }
  </script>
  <br>
  <br>
  <!-- </div> -->
  <br>
  <!-- </div>
    </div>
  </div> -->
</section>
<section class="section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 element-animate ">
        <div class="media block-6 d-block text-center">
          <div class="icon mb-3"><span class="ion-clock text-primary"></span></div>
          <div class="media-body">
            <h3 class="heading">Telah Ada Sejak 2007</h3>
            <p> ecoCare telah memberikan layanan kepada Pelanggannya Pertama sejak 7 Juli 2007</p>
          </div>
        </div>

      </div>
      <div class="col-md-6 col-lg-4 element-animate ">
        <div class="media block-6 d-block text-center">
          <div class="icon mb-3"><span class="ion-android-cloud text-primary"></span></div>
          <div class="media-body">
            <h3 class="heading">Didukung oleh Indo Internet</h3>
            <p>Penyedia Layanan Internet Pertama di Indonesia</p>
          </div>
        </div>

      </div>
      <div class="col-md-6 col-lg-4 element-animate ">
        <div class="media block-6 d-block text-center">
          <div class="icon mb-3"><span class="ion-connection-bars text-primary"></span></div>
          <div class="media-body">
            <h3 class="heading"> Melayani lebih dari 2000 Pelanggan </h3>
            <p>BONET melayani lebih dari 200 Pelanggan yang terhubung melalui teknologi Dial Up, Nirkabel, Kabel, dan Serat Optik sekarang </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- END section -->


<section class="section element-animate">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-7 order-md-2">
        <div class="">
          <div class="frame"><img src="assets/images/image3.jpg" alt="Image" class="img-fluid"></div>
        </div>
      </div>
      <div class="col-md-5 pr-md-5 mb-5">
        <div class="block-41">
          <h2 class="block-41-heading mb-5">Tentang Kami</h2>
          <div class="block-41-text">
            <p>PT Bonet Utama yang juga di kenal sebagai BONET (Internet Bogor) didirikan di Bogor Oleh Sudjaja Wira dan Michael Sunggjardi</p>
            <p>Didukung oleh Indo Internet. Penyedia Layanan Internet pertama di Indonesia - BONET memberikan layanannya kepada pelanggan pertama sejak 1 Juli 1995 dengan menggunakan teknologi Dial Up. </p>
            <p>BONET melayani lebih dari 2000 Pelanggan yang terhubung melalui teknologi Dial Up, Nirkabel, Kabel, dan Serat Optik sekarang. Dan menyediakan Teknologi Broadband dan Kecepatan Tinggi untuk memenuhi Kebutuhan Anda.</p>
            <p><a href="/" class="readmore">Lihat Tentang Kami <span class="ion-android-arrow-dropright-circle"></span></a></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@include('sweetalert::alert')
@endsection