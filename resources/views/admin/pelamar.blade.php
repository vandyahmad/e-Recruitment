@extends('template_admin.home')
@section('title', 'Daftar Pelamar')

@section('content')

<style>
  /* .dataTables_filter {
    margin-top: -8em;
  }

  .dataTables_length {
    margin-top: -8em;
  } */

  .filter_label {
    font-size: small;
  }

  .bootstrap-datetimepicker-widget {
    font-size: 14px;
    /* Adjust the font size as needed */
    width: 300px;
    /* Adjust the width as needed */
    max-width: 100%;
    /* Ensure it doesn't overflow */
  }

  .card-body.bg-light {
    border-left: 5px solid #007bff;
  }

  .card-body p {
    margin-bottom: 0;
  }
</style>

<!-- Other HTML content -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Include jQuery library (if not already included) -->

<!-- Include jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {

    $('#datatablePelamar').DataTable().destroy();

    // Initialize DataTable
    var table = $('#datatablePelamar').DataTable({
      "pageLength": 25,
      "columnDefs": [{
          "orderable": false,
          "targets": 0
        } // Disable ordering for column 0
      ],
      "searching": false,
      "order": [
        [1, 'desc'] // Default order by column 1 (second column) in ascending order
      ],
      "dom": '<"top"lf>rt<"bottom"ip><"clear">' // Customize table controls layout
      // Other DataTables options...
    });

    // Add event listeners for input fields
    // $('#name, #nik').on('keyup', function() {
    // Filter the DataTable based on input values
    //   table.columns($(this).attr('data-column')).search(this.value).draw();
    // });


    var params = getQueryParams();

    if (params['pendidikan_terakhir']) {
      $('#pendidikan_terakhir').val(params['pendidikan_terakhir']);
    }
    if (params['pref_location']) {
      $('#pref_location').val(params['pref_location']);
    }
    if (params['minat_karir']) {
      $('#minat_karir').val(params['minat_karir']);
    }
    if (params['status']) {
      $('#status').val(params['status']);
    }
    if (params['limit']) {
      $('#limit').val(params['limit']);
    }
    if (params['nama']) {
      $('#nama').val(params['nama']);
    }

    // Function to apply filters by reloading the page with the selected filters as query string
    function applyFilters() {
      var pendidikan = $('#pendidikan_terakhir').val();
      var location = $('#pref_location').val();
      var karir = $('#minat_karir').val();
      var status = $('#status').val();
      var limit = $('#limit').val() || 25; // Default to 25 if no limit is set
      var nama = $('#nama').val();

      // Build query string based on selected filter values
      var queryString = '?limit=' + limit +
        '&pendidikan_terakhir=' + pendidikan +
        '&pref_location=' + location +
        '&minat_karir=' + karir +
        '&status=' + status +
        '&nama=' + nama;

      // Reload the page with the new query string to apply filters
      window.location.href = "{{ route('admin.index_pelamar') }}" + queryString;
    }

    // Event listener for the Search button
    $('#searchButton').on('click', function() {
      applyFilters();
    });

    // Function to get query parameters from the URL
    function getQueryParams() {
      var params = {};
      var queryString = window.location.search.substring(1);
      var queries = queryString.split('&');
      for (var i = 0; i < queries.length; i++) {
        var pair = queries[i].split('=');
        params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
      }
      return params;
    }

  });
</script>

<!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->

<div class="container mt-4 mb-3">
  <div class="row">
    <div class="col-md-12">
      <h5 class="mb-3">Application Summary</h5>
      <div class="row text-center">
        <div class="col-md-2">
          <div class="card border-primary shadow-sm">
            <div class="card-body">
              <h2 class="text-primary">{{ $totalApplications }}</h2>
              <p class="mb-0"><strong>Applications</strong></p>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card border-warning shadow-sm">
            <div class="card-body">
              <h2 class="text-warning">{{ $statusCounts['Apply'] ?? 0 }}</h2>
              <p class="mb-0"><strong>Applied</strong></p>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card border-info shadow-sm">
            <div class="card-body">
              <h2 class="text-info">{{ $onProcessCount }}</h2>
              <p class="mb-0"><strong>On Process</strong></p>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card border-success shadow-sm">
            <div class="card-body">
              <h2 class="text-success">{{ $statusCounts['Accepted'] ?? 0 }}</h2>
              <p class="mb-0"><strong>Accepted</strong></p>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card border-secondary shadow-sm">
            <div class="card-body">
              <h2 class="text-secondary">{{ $statusCounts['On Hold'] ?? 0 }}</h2>
              <p class="mb-0"><strong>On Hold</strong></p>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="card border-danger shadow-sm">
            <div class="card-body">
              <h2 class="text-danger">{{ $statusCounts['Declined'] ?? 0 }}</h2>
              <p class="mb-0"><strong>Declined</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="d-flex justify-content-center">
  <div class="row col-md-12 ">
    <h5>Filter Data</h5>
    <div class="card card-body border-success" style="width: 100% !important;">
      <div class="row mb-3">
        <div class="col-sm-2">
          <label class="filter_label">Jumlah Data</label>
          <select id="limit" class="form-control" style="border-color: green">
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="500">500</option>
          </select>
        </div>
        <div class="col-sm-2">
          <label class="filter_label">Pendidikan Terakhir</label>
          <select id="pendidikan_terakhir" class="form-control" style="border-color: green">
            <option value="">All</option>
            <option value="SMA/sederajat">SMA/sederajat</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>
        </div>
        <div class="col-sm-2">
          <label class="filter_label">Lokasi Pekerjaan</label>
          <select id="pref_location" class="form-control" style="border-color: green">
            <option value="">All</option>
            @foreach ($cities as $city)
            <option value="{{ $city->name }}">{{ $city->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-2">
          <label class="filter_label">Job Vacancy</label>
          <select id="minat_karir" class="form-control" style="border-color: green; ">
            <option value="">All</option>
            @foreach ($jobs as $minat)
            <option value="{{ $minat->job_title }}">{{ $minat->job_title }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-2">
          <label class="filter_label">Status</label>
          <select id="status" class="form-control" style="border-color: green">
            <option value="">All</option>
            <option value="Apply">Apply</option>
            @foreach ($statuses as $status)
            <option value="{{ $status->name }}">{{ $status->name }}</option>
            @endforeach
            <option value="On Hold">On Hold</option>
            <option value="Declined">Declined</option>
            <option value="Accepted">Accepted</option>
          </select>
        </div>
        <div class="col-sm-2">
          <label class="filter_label">Search</label>
          <input type="text" id="nama" class="form-control" placeholder="Nama/Jurusan.." style="border-color: green">
        </div>
        <div class="col-sm-2 offset-sm-10 mt-3 text-right">
          <btn id="searchButton" class="btn btn-primary btn-xs">Search</btn>
        </div>
      </div>
    </div>
    <div class="container-fluid" id="grad1">
      <div class="card user-details-card mt-2">
        <div class="card-body">
          <div class="card-body table-responsive-sm p-0">
            <div class="row justify-content-center">
              <h3><strong>Daftar Pelamar</strong></h3>
            </div>
            <table class="table table-bordered table-hover" id="datatablePelamar">
              <thead class="thead-light text-center">
                <tr>
                  <th>Aksi</th>
                  <th>ID</th>
                  <th>User ID</th>
                  <th>Nama Lengkap</th>
                  <th>Pendidikan Terakhir</th>
                  <th>Minat Karir</th>
                  <th>Company</th>
                  <th>Preferensi Lokasi</th>
                  <th>Status</th>
                  <th>Form Interview</th>
                  <th>Tanggal Apply</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pelamars as $pelamar)
                <tr class="clickable-row">
                  <td>
                    <div class="btn-group d-inline">
                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: x-small;">
                        Tools
                      </button>
                      <div class="dropdown-menu dropdown-menu-open position-absolute">
                        @if (!in_array($pelamar->status, ['Accepted', 'Declined']))
                        <button class="btn btn-success btn-proceed btn-sm dropdown-item" data-id="{{ $pelamar->id }}" data-toggle="modal" data-target="#ProceedModal-{{ $pelamar->id }}"><i class="fa fa-cogs"></i> Proses</button>
                        @endif
                        <a href="https://wa.me/62{{$pelamar->UserData->no_hp}}" class="dropdown-item" target="_blank"><i class="fa fa-phone-alt"></i> Contact/WA</a>
                        <a href="{{ route('admin.activity_pelamar', $pelamar->id) }}" class="dropdown-item"><i class="fa fa-paper-plane"></i> Activity</a>
                        <a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id] ) }}" class="dropdown-item"><i class="fa fa-file" target="_blank"></i> Detail</a>
                        <button class="btn btn-danger btn-hapus btn-sm dropdown-item" data-id="{{ $pelamar->id }}" data-toggle="modal" data-target="#DeleteModal-{{ $pelamar->id }}"><i class="fa fa-user-times"></i> Hapus</button>
                      </div>
                    </div>
                  </td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->id }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->UserData->user_id }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->UserData->nama_lengkap }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->UserData->pendidikan_terakhir }} {{ $pelamar->UserData->jurusan }}, {{ $pelamar->UserData->institusi }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->job_vacancy['job_title'] }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->job_vacancy['job_company'] }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->minat_lokasi }}</a></td>
                  <td><a href="{{ route('admin.activity_pelamar', $pelamar->id) }}">{{ $pelamar->status }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->UserData->form_interview }}</a></td>
                  <td><a href="{{ route("admin.show_pelamar", ['pelamar' => $pelamar->id]) }}" target="_blank">{{ $pelamar->created_at }}</a></td>
                </tr>

                {{-- modal untuk konfirmasi --}}

                <div id="DeleteModal-{{ $pelamar->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    {{-- Content / Isi Modal --}}
                    <form action="{{ route("admin.destroy_pelamar", ['pelamar' => $pelamar->id]) }}" method="POST">
                      @csrf
                      @method('delete')
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-center">Konfirmasi</h4>
                          <button type="button" class="close" data-dismiss="modal">
                            &times;</button>
                        </div>
                        <div class="modal-body">
                          <p class="text-center"> Anda yakin akan menghapus data ini ? </p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal">
                            Batalkan
                          </button>
                          <button type="submit" class="btn btn-danger" onclick="this.form.submit()" data-dismiss="modal">
                            Ya, Hapus</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Modal Proceed Pelamar -->
                <div class="modal fade" id="ProceedModal-{{ $pelamar->id }}" tabindex="-1" role="dialog" aria-labelledby="ProceedModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ProceedModalLabel">Proses Pelamar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">


                        <?php
                        $disable = array();
                        foreach ($pelamar->activities as $value) {
                          // echo "<pre>";
                          // print_r($value->activity);
                          array_push($disable, $value->activity);
                        }
                        ?>

                        <form id="proceedForm-{{ $pelamar->id }}">
                          @csrf
                          <input type="hidden" id="pelamarID" name="pelamarID" value='{{ $pelamar->id }}'>
                          <div class="form-group">
                            <label for="activity">Pilih Activity</label>
                            <select class="form-control" id="activity{{$pelamar->id}}" name="activity" required>
                              <option value="" disabled selected>Select an option</option>
                              @foreach($activitySteps as $step)
                              @if($pelamar->minat_karir == $step->id )
                              <option value="{{ $step->name }}" {{ in_array($step->name, $disable) ? 'disabled' : '' }}>{{ $step->name }}</option>
                              @endif
                              @endforeach
                              <option value="On Hold" style="color: #F39C12;" {{ in_array('On Hold', $disable) ? 'disabled' : '' }}>On Hold</option>
                              <option value="Declined" style="color: #E74C3C;" {{ in_array('Declined', $disable) ? 'disabled' : '' }}>Declined</option>
                              <option value="Accepted" style="color: #2ECC71;" {{ in_array('Accepted', $disable) ? 'disabled' : '' }}>Accepted</option>
                            </select>
                          </div>
                          <!-- <div class="form-group">
                            <label for="jadwal_activity">Jadwal Activity</label>
                            <input type="datetime-local" class="form-control datetimepicker" id="jadwal_activity{{$pelamar->id}}" name="jadwal_activity" required>
                          </div> -->
                          <div class="form-group">
                            <label for="jadwal_activity">Jadwal Activity</label>
                            <div class="input-group date datetimepicker" id="datetimepicker2-{{$pelamar->id}}" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" style="font-size: 14px; width: auto !important; max-width: 100%; z-index: 1060" data-target="#datetimepicker2-{{$pelamar->id}}" id="jadwal_activity{{$pelamar->id}}" name="jadwal_activity" required />
                              <div class="input-group-append" data-target="#datetimepicker2-{{$pelamar->id}}" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                          <script type="text/javascript">
                            $(function() {
                              $('#datetimepicker2-{{$pelamar->id}}').datetimepicker({
                                icons: {
                                  time: 'fa fa-clock',
                                  date: 'fa fa-calendar',
                                  up: 'fa fa-chevron-up',
                                  down: 'fa fa-chevron-down',
                                  previous: 'fa fa-chevron-left',
                                  next: 'fa fa-chevron-right',
                                  today: 'fa fa-calendar-check-o',
                                  clear: 'fa fa-trash',
                                  close: 'fa fa-times'
                                },
                                format: 'DD/MM/YYYY HH:mm',
                                defaultDate: moment(), // Set default date and time
                                useCurrent: true,
                                showTodayButton: true,
                                showClear: true,
                                minDate: moment(), // Limit the datetime cannot pick past datetime
                                tooltips: {
                                  today: 'Go to today',
                                  clear: 'Clear selection',
                                  close: 'Close picker',
                                  selectTime: 'Select time',
                                  selectDate: 'Select date'
                                }
                              });
                            });
                          </script>

                          <div class="form-group">
                            <label for="lokasi_activity">Branch Activity</label>
                            <select class="lokasi_activity form-control" id="lokasi_activity{{$pelamar->id}}" name="lokasi_activity" required>
                              <option value="" disabled selected>Select Branch</option>
                              <option value="VIRTUAL MEETING">VIRTUAL MEETING</option>
                              @foreach($branches as $branch)
                              <option value="{!! nl2br($branch->address) !!}">{{ $branch->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="alamat_activity">Alamat Activity</label>
                            <p class="info-box form-control" id="alamat_activity_placeholder{{$pelamar->id}}" style="height :auto"></p>
                          </div>
                          <div class="form-group" id="status_karyawan_group{{$pelamar->id}}" style="display: none;">
                            <label for="status_karyawan">Status Karyawan</label>
                            <select class="form-control" id="status_karyawan{{$pelamar->id}}" name="status_karyawan">
                              <option value="" disabled selected>Select Status</option>
                              <option value="PKWT">PKWT</option>
                              <option value="PKWTT">PKWTT</option>
                              <option value="DW">DW</option>
                            </select>
                          </div>
                          <div class="form-group" id="tanggal_mulai_kerja_group{{$pelamar->id}}" style="display: none;">
                            <label for="tanggal_mulai_kerja">Tanggal Mulai Bekerja</label>
                            <input type="date" class="form-control" id="tanggal_mulai_kerja{{$pelamar->id}}" name="tanggal_mulai_kerja">
                          </div>
                          <div class="form-group" id="tanggal_selesai_kerja_group{{$pelamar->id}}" style="display: none;">
                            <label for="tanggal_selesai_kerja">Tanggal Selesai Bekerja</label>
                            <input type="date" class="form-control" id="tanggal_selesai_kerja{{$pelamar->id}}" name="tanggal_selesai_kerja">
                          </div>
                          <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan{{$pelamar->id}}" name="keterangan" required></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary submit-button" id="submitForm-{{ $pelamar->id }}">Submit</button>

                      </div>
                    </div>
                  </div>
                </div>


                <script>
                  $(document).ready(function() {
                    $('#activity{{$pelamar->id}}').change(function() {
                      var selectedActivity = $(this).val();
                      if (selectedActivity === 'Declined' || selectedActivity === 'Screening' || selectedActivity === 'On Hold') {
                        // Disable all form fields
                        $('#jadwal_activity{{$pelamar->id}}').prop('readonly', true);
                        $('#lokasi_activity{{$pelamar->id}}').prop('disabled', true);
                        $('#alamat_activity_placeholder{{$pelamar->id}}').prop('disabled', true);
                        $('#keterangan{{$pelamar->id}}').prop('disabled', true);
                      } else if (selectedActivity === 'Psikotes (with Talenta)') {
                        // Disable all form fields
                        $('#lokasi_activity{{$pelamar->id}}').prop('disabled', true);
                        $('#alamat_activity_placeholder{{$pelamar->id}}').prop('disabled', true);
                        $('#keterangan{{$pelamar->id}}').prop('disabled', true);
                      } else {
                        // Enable all form fields
                        $('#jadwal_activity{{$pelamar->id}}').prop('disabled', false);
                        $('#lokasi_activity{{$pelamar->id}}').prop('disabled', false);
                        $('#alamat_activity_placeholder{{$pelamar->id}}').prop('disabled', false);
                        $('#keterangan{{$pelamar->id}}').prop('disabled', false);
                        // Show or hide the additional fields based on the selected activity

                      }
                      if (selectedActivity === 'Accepted') {
                        $('#status_karyawan_group{{$pelamar->id}}').show();
                        $('#tanggal_mulai_kerja_group{{$pelamar->id}}').show();
                        $('#tanggal_selesai_kerja_group{{$pelamar->id}}').show();
                      } else {
                        $('#status_karyawan_group{{$pelamar->id}}').hide();
                        $('#tanggal_mulai_kerja_group{{$pelamar->id}}').hide();
                        $('#tanggal_selesai_kerja_group{{$pelamar->id}}').hide();
                      }

                    });


                    $('#lokasi_activity{{$pelamar->id}}').change(function() {
                      // Get the selected option value
                      var selectedAddress = $(this).val();

                      if (selectedAddress === 'VIRTUAL MEETING') {
                        // Make the "Alamat Activity" field editable and create an input field for the link
                        $('#alamat_activity_placeholder{{$pelamar->id}}').html('Link : <input id="link_activity{{$pelamar->id}}" type="text" class="form-control" placeholder="Masukkan link Virtual Meeting">').attr('contenteditable', 'false');

                        // Listen to changes in the input field
                        $('#link_activity{{$pelamar->id}}').on('input', function() {
                          var linkValue = $(this).val();
                          // Update the value of the 'VIRTUAL MEETING' option in the select dropdown
                          $('#lokasi_activity{{$pelamar->id}} option[value="VIRTUAL MEETING"]').val('Virtual Meeting (link : ' + linkValue + ')');
                          // Update the "Alamat Activity" field to show the link entered
                          $('#alamat_activity_placeholder{{$pelamar->id}}').html('Link : ' + linkValue).attr('contenteditable', 'false');
                        });
                      } else {
                        // Update the "Alamat Activity" field with the selected branch address
                        $('#alamat_activity_placeholder{{$pelamar->id}}').html(selectedAddress.replace(/<br>/, '<br>')).attr('contenteditable', 'false');
                      }
                    });


                    // Initialize Select2
                    $('#lokasi_activity{{ $pelamar->id }}').select2({
                      theme: 'bootstrap4',
                    });

                    $('#submitForm-{{ $pelamar->id }}').on('click', function(event) {
                      event.preventDefault();

                      // Disable the button and show loading text
                      var submitButton = $(this);
                      submitButton.prop('disabled', true);
                      submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');

                      var formData = $('#proceedForm-{{ $pelamar->id }}').serialize();
                      $.ajax({
                        type: "POST",
                        url: "{{ route('admin.process_pelamar') }}",
                        data: formData,
                        success: function(response) {
                          console.log(response);
                          if (response.success) {
                            location.reload();
                          } else {
                            alert(response.message);
                            location.reload();
                          }
                          // $('#ProceedModal-{{ $pelamar->id }}').modal('hide');
                          // toast(response,'success');
                          // Enable the button and reset text on success or error
                          submitButton.prop('disabled', false);
                          submitButton.html('Submit');
                        },
                        error: function(error) {
                          console.log(error);
                          // Enable the button and reset text on error
                          submitButton.prop('disabled', false);
                          submitButton.html('Submit');
                        }
                      });
                    });
                  });
                </script>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll(".clickable-row");

    rows.forEach(row => {
      row.addEventListener("click", function() {
        const href = row.getAttribute("data-href");
        if (href) {
          window.location.href = href;
        }
      });
    });
  });
</script>

@endsection