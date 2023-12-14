@extends('user.profile-pelamar')

@section('user-content')
<div class="container-fluid" id="grad1">
    <div class="card user-details-card">
        <div class="card-body">
            <div class="row justify-content-center mt-3 mb-3">
                <h2><strong>Job Application Status</strong></h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Job Applied</h3>

                            @if ($appliedJobs->count() > 0)
                            <div>
                                @foreach ($appliedJobs as $appliedJob)
                                <hr>
                                <a href="{{ route('job-applied.status', $appliedJob->id) }}">
                                    {{ $appliedJob->job_vacancy->job_title }}
                                </a>
                                @endforeach
                            </div>


                            @else
                            <h5 class="text-center">Anda belum mengajukan lamaran untuk lowongan manapun</h5>
                            <div class="mt-5 text-center">
                                <a href="/" class="btn btn-success">Lihat lowongan</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection