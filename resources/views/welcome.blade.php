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
    <div class="slider-item" style="background-image: url('{{ asset('assets/images/eco1.jpg') }}');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-7 text-center col-sm-12 element-animate">
                    <!-- <div class="btn-play-wrap mx-auto">
                            <p class="mb-4"><a href="https://www.youtube.com/watch?v=9j5f00-qiF8" data-fancybox
                                    data-ratio="2" class="btn-play"><span class="ion ion-ios-play"></span></a></p>
                        </div> -->
                    <h2 class="text-white">Welcome Future ecoFam</h2>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1><strong>E - R E C R U I T M E N T</strong></h1>
                    <!-- <h2 class="text-white">PT . ECOCARE INDO PASIFIK</h2> -->
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 2 -->
    <div class="slider-item" style="background-image: url('{{ asset('assets/images/eco3.jpg') }}');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-7 text-center col-sm-12 element-animate">
                </div>
            </div>
        </div>
    </div>

    <!-- SLIDE 3 -->
    <div class="slider-item" style="background-image: url('{{ asset('assets/images/eco2.jpg') }}');">
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
    <div class="text-center justify-content-center mt-5 mb-5">
        <h2>Gabungkan Kekuatan, Capai Tujuan Bersama</h2>
        <h5>Kembangkan Karir Anda Bersama Dengan Visi-misi Kami</h5>
        <br>
    </div>

    <!-- Filter Section -->
    <!-- <div class="container"> -->

    <p style="margin-left: 9%; margin-bottom: 10px;">Cari Lowongan :</p>
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div class="card filter-card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="searchInput" placeholder="Apa pekerjaan impian anda ?">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="job_company" name="job_company" placeholder="Company">
                                <option value="">--All Company--</option>
                                <option value="ecoCare">ecoCare</option>
                                <option value="TBI">tukangBersih</option>
                                <option value="pestCare">pestCare</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="job-location form-control" id="job_location" name="job_location" placeholder="Lokasi" style="width: 100%;">
                                <option value="">--All Location--</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-control" id="job_type" name="job_type" placeholder="Type">
                                <option value="">--All Type--</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="job_functional" name="job_functional" placeholder="Functional">
                                <option value="">--All Functional--</option>
                                <option value="Sales">Sales</option>
                                <option value="Administrative">Administrative</option>
                                <option value="Operation">Operation</option>
                                <option value="Human Resources & General Affair">Human Resources & General Affair</option>
                                <option value="Finance & Accounting">Finance & Accounting</option>
                                <option value="Marketing Communication">Marketing Communication</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Business Development">Business Development</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button id="searchButton" class="btn btn-success btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->



    <h4 style="margin-left: 9%; margin-bottom: 5px;">Lowongan Pekerjaan</h4>>
    <div id="job-vacancies-section">
        @foreach ($jobvacancies as $jobvacancy)
        @if (strtotime($jobvacancy->job_end_date) >= strtotime(now()))
        <div id="accordion" class="d-flex justify-content-center">
            <div class="card mb-1 col-md-10 border-success">
                <div class="card-header mb-2" id="headingOne">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $jobvacancy->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <h6>{{ $jobvacancy->job_title }} <i class="fas fa-angle-down"></i></h6>
                                </button>
                            </h5>
                        </div>
                        <div class="col-md-1,2" style="border-left: solid 1px grey;">
                            <p style="margin-left: 10px;">Type : </p>
                        </div>
                        <div class="font-weight-bold col-md-2 font-italic">
                            <p>{{ $jobvacancy->job_type }}</p>
                        </div>
                        <div class="col-md-1,2" style="border-left: solid 1px grey;">
                            <p style="margin-left: 10px;">Company : </p>
                        </div>
                        <div class="font-weight-bold col-md-2 font-italic">
                            <p>{{ $jobvacancy->job_company }}</p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="grad1">
                    <div id="collapseOne{{ $jobvacancy->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion{{ $jobvacancy->id }}">
                        <div class="card user-details-card">
                            <div class="card-body" style="margin-left: 5%; margin-top: 2%; margin-bottom: 1%;">
                                <h7><strong>Responsibilities :</strong></h7>
                                <p>{!! $jobvacancy->job_description !!}</p>
                                <h7><strong>Requirements:</strong></h7>
                                <p>{!! $jobvacancy->job_requirement !!}</p>
                                <p><strong>Preferred Location:</strong>
                                    @foreach(explode(',', $jobvacancy->job_location) as $location)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="location" id="{{ $location }}" value="{{ $location }}">
                                    <label class="form-check-label" for="{{ $location }}">
                                        {{ $location }}
                                    </label>
                                </div>
                                @endforeach
                                </p>
                                <p><strong>Date Opened:</strong> {{ $jobvacancy->job_start_date }}</p>
                                <p><strong>Date Closed:</strong> {{ $jobvacancy->job_end_date }}</p>
                                <div class="text-center">
                                    <button class="btn btn-primary" data-id="{{ $jobvacancy->id }}" onclick="validateLocation('{{ $jobvacancy->id }}')">
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

        <div id="ConfirmModal-{{ $jobvacancy->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                {{-- Content / Isi Modal --}}
                <form id='applyForm{{ $jobvacancy->id }}' action="{{ route('pelamars.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title justify-content-center">Konfirmasi</h4>
                            <input type="hidden" name="minat_karir" id="minat_karir" value="{{ $jobvacancy->id }}">
                            <input type="hidden" name="minat_lokasi" id="minat_lokasi_{{ $jobvacancy->id }}" value="">
                            <button type="button" class="close" data-dismiss="modal">
                                &times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center"> Apakah anda yakin sudah memenuhi kriteria yang tertera dan ingin
                                submit lamaran untuk posisi <b>{{ $jobvacancy->job_title }}</b> ? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm" onclick="confirmApply('{{ $jobvacancy->id }}')">
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
    </div>
    <script>
        function validateLocation(JobVacancyID) {
            // Get the selected location
            var selectedLocation = document.querySelector('input[name="location"]:checked');

            // Check if a location is selected
            if (!selectedLocation) {
                alert('Please select preferred location.');
                return; // Prevent further actions
            }

            // Assign the selected location to the hidden input field
            document.getElementById("minat_lokasi_" + JobVacancyID).value = selectedLocation.value;

            // Show the confirmation modal
            $('#ConfirmModal-' + JobVacancyID).modal('show');
        }

        function confirmApply(JobVacancyID) {
            // Submit the form
            document.getElementById("applyForm" + JobVacancyID).submit();
        }

        $(document).ready(function() {
            $('#searchButton').click(function() {
                filterJobVacancies();
            });
        });

        function filterJobVacancies() {
            var searchQuery = $('#searchInput').val().toLowerCase();
            var job_location = $('#job_location').val();
            var job_type = $('#job_type').val();
            var job_company = $('#job_company').val();
            var job_functional = $('#job_functional').val();

            $('#job-vacancies-section').html('');
            $('#job-vacancies-section').html(`
                <div id="job-vacancies-section" class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
                    <p>Loading...</p>
                </div>`);
            $.ajax({
                url: '{{ route("welcome.filter") }}',
                type: 'GET',
                data: {
                    searchQuery: searchQuery,
                    job_location: job_location,
                    job_company: job_company,
                    job_type: job_type,
                    job_functional: job_functional
                },
                success: function(response) {
                    if (response.length > 0) {
                        $('#job-vacancies-section').html('');
                        for (let i = 0; i < response.length; i++) {
                            let dataJb = ''; // Initialize empty string for location inputs
                            if (response[i].job_location) {
                                let locations = response[i].job_location.split(",");
                                for (let j = 0; j < locations.length; j++) {
                                    dataJb += `
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="location" id="${locations[j]}" value="${locations[j]}">
                                        <label class="form-check-label" for="${locations[j]}">${locations[j]}</label>
                                    </div>
                            `;
                                }
                            }

                            $('#job-vacancies-section').append(`
                        <div id="accordion" class="d-flex justify-content-center">
                            <div class="card mb-1 col-md-10 border-success">
                                <div class="card-header mb-2" id="headingOne">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne${response[i].id}" aria-expanded="true" aria-controls="collapseOne">
                                                <h6>${response[i].job_title} <i class="fas fa-angle-down"></i></h6>
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="col-md-1,2" style="border-left: solid 1px grey;">
                                        <p style="margin-left: 10px;">Type : </p>
                                    </div>
                                    <div class="font-weight-bold col-md-2 font-italic">
                                        <p>${response[i].job_type}</p>
                                    </div>
                                    <div class="col-md-1,2" style="border-left: solid 1px grey;">
                                        <p style="margin-left: 10px;">Company : </p>
                                    </div>
                                    <div class="font-weight-bold col-md-2 font-italic">
                                        <p>${response[i].job_company}</p>
                                    </div>
                                </div>
                                </div>
                                <div class="container-fluid" id="grad1">
                                    <div id="collapseOne${response[i].id}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion${response[i].id}">
                                        <div class="card user-details-card">
                                            <div class="card-body" style="margin-left: 5%; margin-top: 2%; margin-bottom: 1%;">
                                                <h7><strong>Job Description :</strong></h7>
                                                <p>${response[i].job_description}</p>
                                                <h7><strong>Requirements:</strong></h7>
                                                <p>${response[i].job_requirement}</p>
                                                <p><strong>Preferred Location:</strong>
                                                <div class="form-check">
                                                    ${dataJb}
                                                </div>
                                                </p>
                                                <p><strong>Date Opened:</strong> ${response[i].job_start_date}</p>
                                                <p><strong>Date Closed:</strong> ${response[i].job_end_date}</p>
                                                <div class="text-center">
                                                <button class="btn btn-primary apply-btn" data-id="${response[i].id}">
                                                    <i class="fa fa-bolt"></i> Apply This
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="ConfirmModal-${response[i].id}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            {{-- Content / Isi Modal --}}
                            <form id='applyForm${response[i].id}' action="{{ route('pelamars.store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title justify-content-center">Konfirmasi</h4>
                                        <input type="hidden" name="minat_karir" id="minat_karir" value="${response[i].id}">
                                        <input type="hidden" name="minat_lokasi" id="minat_lokasi_${response[i].id}" value="">
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center"> Apakah anda yakin sudah memenuhi kriteria yang tertera dan ingin
                                            submit lamaran untuk posisi <b>${response[i].job_title}</b> ? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success btn-sm" onclick="confirmApply('${response[i].id}')">
                                            Ya, Submit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                            Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    `);
                        }
                    } else {
                        $('#job-vacancies-section').html(`
                        <div id="job-vacancies-section" class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
                            <p>Lowongan Tidak Tersedia</p>
                        </div>`);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(document).on('click', '.apply-btn', function() {
            var jobId = $(this).data('id');
            console.log(jobId);
            validateLocation(jobId);
        });

        $(document).ready(function() {
            $('.job-location').select2({
                theme: 'bootstrap4',
            });
        });
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
        <div class="text-center mb-5">
            <h1>Why Join Us ?</h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 element-animate ">
                <div class="media block-6 d-block text-center">
                    <div class="icon mb-3"><span class="ion-android-globe text-primary"></span></div>
                    <div class="media-body">
                        <h3 class="heading">Telah Ada Sejak 2007</h3>
                        <p> ecoCare telah memberikan layanan kepada Pelanggannya Pertama sejak 7 Juli 2007</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-4 element-animate ">
                <div class="media block-6 d-block text-center">
                    <div class="icon mb-3"><span class="ion-flash text-primary"></span></div>
                    <div class="media-body">
                        <h3 class="heading">Berkembang Pesat</h3>
                        <p>ecoCare Group Company merupakan perusahaan yang saat ini sedang berkembang pesat</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-4 element-animate ">
                <div class="media block-6 d-block text-center">
                    <div class="icon mb-3"><span class="ion-arrow-graph-up-right text-primary"></span></div>
                    <div class="media-body">
                        <h3 class="heading"> Jenjang Karir </h3>
                        <p>Peningkatan jenjang karir sangat terbuka lebar bagi semua ecoFam yang memiliki kinerja yang baik</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END section -->

@include('sweetalert::alert')
@endsection