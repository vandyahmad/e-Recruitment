@extends('user.profile-pelamar')

@section('user-content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to set progress bar based on activity status
        // function setProgressBar() {
        //     $("#progressbar li").removeClass("active");
        //     @foreach($activities as $activity)
        //     @if($activity->activity == 'Interview User HR')
        //     $("#account").addClass("active");
        //     @elseif($activity->activity == 'Interview User')
        //     $("#personal").addClass("active");
        //     @elseif($activity->activity == 'test')
        //     $("#payment").addClass("active");
        //     @elseif($activity->activity == 'sign')
        //     $("#confirm").addClass("active");
        //     @endif
        //     @endforeach
        // }

        // Initial setup of progress bar
        // setProgressBar();

        // Additional script to show/hide fieldsets if needed
        // @foreach($activities as $activity)
        // $("fieldset").hide();
        // @if($activity->activity == 'Interview User HR')
        // $("#fieldset1").show();
        // @elseif($activity->activity == 'Interview User')
        // $("#fieldset2").show();
        // @elseif($activity->activity == 'test')
        // $("#fieldset3").show();
        // @elseif($activity->activity == 'sign')
        // $("#fieldset4").show();
        // @endif
        // @endforeach

        // Hide all fieldsets initially


        @foreach($activities as $index => $activity)
        $("fieldset").hide();
        // Show the fieldset with an index that corresponds to the current activity step
        $("#fieldset{{ $index + 1 }}").show();
        @endforeach

        var activities = @json($activities);
        // console.log(activities)

        // Get the progress bar elements
        var progressBar = document.getElementById("progressbar");
        var steps = progressBar.getElementsByTagName("li");
        let datatemp = []
        // Loop through the steps and update the class based on the activities
        for (var i = 0; i < steps.length; i++) {
            var step = steps[i];
            var stepName = step.getAttribute("id"); // Get the id attribute of the step
            // console.log(stepName)
            // Check if the step activity is in the activities list
            // let dataTemp = []
            var activityExists = activities.find(function(activity) {
                // console.log(activityExists)    
                // if(activity.activity.toLowerCase() != stepName.toLowerCase()){
                // console.log(stepName)
                // dataTemp.push(stepName);
                // }
                // return
                // if(activity.activity.toLowerCase() === stepName.toLowerCase()){
                // console.log(activity.activity.toLowerCase(), stepName.toLowerCase());
                // dataTemp.push(stepName);
                return activity.activity.toLowerCase() === stepName;
                // console.log("stepName", stepName.toLowerCase());
                // }
                // console.log(activity.activity.toLowerCase());

            });

            // for (var x = 0; x < activities.length; x++) {

            //     if(activities[x].activity.toLowerCase() != stepName.toLowerCase()){
            //         datatemp.push(stepName.toLowerCase());
            //        // break;
            //     }
            // }

            // console.log(datatemp);
            // Update the class based on the activity existence
            // console.log(activityExists)
            if (activityExists) {
                // Update the class to indicate completion (you can customize this based on your styling)
                step.classList.add("active");
            } else {
                // Remove the class if the activity is not present
                step.classList.remove("active");
            }
        }
    });
</script>
<div class="container-fluid" id="grad1">
    <div class="card user-details-card">
        <div class="card-body">
            <div class="row justify-content-center mt-3">
                <h3><b>"{{$minat_karir->job_vacancy->job_title}}"</b></h3>
            </div>
            <div class="row justify-content-center mb-4">
                <h2><b>Application Status</b></h2>
            </div>
            <div class="row justify-content-center mt-0">

                <div class="row">
                    <div class="col-md-12 mx-0">
                        @if($minat_karir->status == 'Accepted')
                        <ul id="progressbar">
                            @foreach($jobActivities as $index => $jobActivity)
                            <li id="{{strtolower($jobActivity->name)}}" class="account">
                                <strong>{{ $jobActivity->name }}</strong>
                                <!-- <i class="fas fa-check"></i> -->
                            </li>
                            @endforeach
                            <li id="Accepted" class="accepted">
                                <strong>Accepted</strong>
                                <!-- <i class="fas fa-check"></i> -->
                            </li>
                        </ul>
                        @elseif($minat_karir->status == 'Declined')
                        <ul id="progressbar">
                            @foreach($activities as $index => $activity)

                            <li id="{{strtolower($activity->activity)}}" class="<?= $activity->activity == 'Declined' ? 'declined' : 'account' ?>">
                                <strong>{{ $activity->activity }}</strong>
                                <!-- <i class="fas fa-check"></i> -->
                            </li>
                            @endforeach
                            <!-- <li id="Declined" class="declined">
                                <strong>Declined</strong>
                            </li> -->
                        </ul>
                        @else
                        <ul id="progressbar">
                            @foreach($jobActivities as $index => $jobActivity)
                            <li id="{{strtolower($jobActivity->name)}}" class="account">
                                <strong>{{ $jobActivity->name }}</strong>
                                <!-- <i class="fas fa-check"></i> -->
                            </li>
                            @endforeach
                        </ul>
                        @endif



                        @if(count($activities) > 0)

                        @foreach($activities as $index => $activity)

                        @if($activity->activity == 'Accepted')
                        <fieldset id="fieldset{{ $index + 1 }}">
                            <div class="form-card">
                                <h2 class="fs-title">Selamat !</h2>
                                <div style="text-align: justify;">
                                    <p>
                                        Kami dengan senang hati ingin memberitahu bahwa Anda telah berhasil lolos dalam proses seleksi penerimaan pekerjaan di ecoCare Group. Selamat atas pencapaian ini!
                                    </p>
                                    <p>
                                        Setelah melalui evaluasi yang cermat, kami yakin bahwa Anda memiliki kualifikasi, keterampilan, dan dedikasi yang kami cari untuk posisi <strong>{{ $minat_karir->job_vacancy->job_title }}</strong>. Kami percaya bahwa kontribusi Anda akan membawa nilai tambah bagi tim kami.
                                    </p>
                                    <p>
                                        Terima kasih atas komitmen dan dedikasi Anda selama proses seleksi ini. Kami berharap dapat bekerja sama dengan Anda di ecoCare Group.
                                    </p>
                                    <p>
                                        Selamat kembali dan selamat bergabung dengan tim kami!
                                    </p>

                                </div>
                            </div>
                        </fieldset>

                        @elseif($activity->activity == 'Declined')
                        <fieldset id="fieldset{{ $index + 1 }}">
                            <div class="form-card">
                                <h2 class="fs-title">Terimakasih !</h2>
                                <div style="text-align: justify;">
                                    <p>
                                        Kami ingin menyampaikan terima kasih atas partisipasi Anda dalam proses seleksi lamaran pekerjaan di ecoCare Group. Kami menghargai waktu dan usaha yang Anda investasikan dalam mengajukan lamaran.
                                    </p>

                                    <p>
                                        Setelah melalui proses evaluasi yang cermat, kami ingin memberitahukan bahwa saat ini kami telah menyelesaikan proses seleksi, dan sayangnya, lamaran Anda <strong>belum memenuhi kriteria</strong> yang kami cari untuk posisi <strong>{{ $minat_karir->job_vacancy->job_title }}</strong>.
                                    </p>

                                    <p>
                                        Meskipun Anda tidak lolos pada tahap ini, kami tetap menghargai minat dan dedikasi Anda untuk bergabung dengan ecoCare Group. Terima kasih sekali lagi atas partisipasi Anda. Kami senang Anda tertarik untuk bergabung dengan tim kami dan berharap Anda dapat mencapai sukses besar di masa mendatang.
                                    </p>
                                </div>
                            </div>
                        </fieldset>

                        @else
                        <fieldset id="fieldset{{ $index + 1 }}">
                            <div class="form-card">
                                <h2 class="fs-title">Selamat !</h2>
                                <p>Anda lolos ke tahap selanjutnya.</p>
                                <p>Selanjutnya anda dapat mengikuti proses <b>{{ $activity->activity }}</b> berdasarkan detail di bawah ini :</p>
                                <div class="my-5">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><u><b>"{{ $activity->activity }} Details"</b></u></h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Tahap: <strong>{{ $activity->activity }}</strong></li>
                                                <li class="list-group-item">Jadwal: <strong>{{ $activity->jadwal_activity }}</strong></li>
                                                <li class="list-group-item">Lokasi: <strong>{{ $activity->lokasi_activity }}</strong></li>
                                                <li class="list-group-item">Note: <strong>{{ $activity->keterangan }}</strong></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                        @endif
                        @endforeach

                        @else

                        <fieldset id="Apply">
                            <div class="form-card">
                                <h2 class="fs-title">Terimakasih !</h2>
                                <p>Job application anda sudah kami terima</p>
                                <p>Selanjutnya akan kami lakukan proses screening terlebih dahulu sesuai dengan requirement yang kami butuhkan </p>
                                <div class="my-5">
                                </div>
                            </div>
                        </fieldset>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
@endsection