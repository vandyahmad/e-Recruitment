@extends('template_admin.home')

@section('content')
<div class="container-fluid" id="grad1">
    <div class="card user-details-card">
        <div class="card-body">
            <div class="row justify-content-center mb-5">
                <h2><strong>Activity Pelamar</strong></h2>
            </div>
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-4">
                    <h5><strong>Nama:</strong> {{ $nama }}</h5>
                </div>
                <div class="col-md-4">
                    <h5><strong>Nik:</strong> {{ $nik }}</h5>
                </div>
                <div class="col-md-4">
                    <h5><strong>Job Applied:</strong> {{ $minat_karir }}</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Activity</th>
                            <th>Jadwal Activity</th>
                            <th>Lokasi Activity</th>
                            <th>Keterangan</th>
                            <th>Email Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->activity }}</td>
                            <td>{{ $activity->jadwal_activity }}</td>
                            <td>{{ $activity->lokasi_activity }}</td>
                            <td>{{ $activity->keterangan }}</td>
                            <td>{{ $activity->email_sent_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection