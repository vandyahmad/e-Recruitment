@extends('user.profile-pelamar')

@section('user-content')
<div class="container-fluid" id="grad1">
    <div class="card user-details-card">
        <div class="card-body">
            <div class="row justify-content-center mt-3 mb-3">
                <h3><strong>Job Application Status</strong></h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 text-center border-right">
                                    <h5 class="card-title">Job Applied</h5>
                                </div>
                                <div class="col-md-1 text-center">
                                </div>
                                <div class="col-md-5 text-center">
                                    <h5 class="card-title">Status</h5>
                                </div>
                            </div>

                            @if ($appliedJobs->count() > 0)
                            <div>
                                @foreach ($appliedJobs as $appliedJob)
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <h6><a href="{{ route('job-applied.status', $appliedJob->id) }}">
                                                {{ $appliedJob->job_vacancy->job_title }}
                                            </a>
                                        </h6>
                                    </div>
                                    <div class="col-md-1 text-center">
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <a href="{{ route('job-applied.status', $appliedJob->id) }}">
                                            <button type="button" class="btn {{ $appliedJob->status == 'Accepted' ? 'btn-outline-success btn-sm' : ($appliedJob->status == 'Declined' ? 'btn-outline-danger btn-sm' : ($appliedJob->status == 'On Hold' ? 'btn-outline-warning btn-sm' : 'btn-outline-primary btn-sm')) }}"><b>{{ $appliedJob->status }}</b></button>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            @else
                            <p class="text-center mt-3" style="border-top: 1px solid grey radius-5;">Anda belum mengajukan lamaran untuk lowongan manapun</p>
                            <div class="mt-3 text-center">
                                <a href="/#kategori-lowongan" class="btn btn-success">Lihat lowongan</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')

@if(session('info'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Terimakasih',
        text: "{{ session('info') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif


@endsection