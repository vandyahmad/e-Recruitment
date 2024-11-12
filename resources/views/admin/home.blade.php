@extends('template_admin.home')
@section('title', 'Dashboard')
@section('sub-judul', 'Welcome to Dashboard')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <!-- Application Summary Section -->
    <!-- <div class="container mb-5"> -->
    <!-- <div class="card card-body mb-5"> -->
    <div class="row">
      <div class="col-md-12 mb-5">
        <h5 class="mb-3">Application Summary</h5>
        <div class="row text-center">
          <div class="col-md-2 mb-3">
            <div class="card border-primary shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-primary">{{ $totalApplications }}</h2>
                <p class="mb-0"><strong>Applications</strong></p>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="card border-warning shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-warning">{{ $statusCounts['Apply'] ?? 0 }}</h2>
                <p class="mb-0"><strong>Applied</strong></p>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="card border-info shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-info">{{ $onProcessCount }}</h2>
                <p class="mb-0"><strong>On Process</strong></p>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="card border-success shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-success">{{ $statusCounts['Accepted'] ?? 0 }}</h2>
                <p class="mb-0"><strong>Accepted</strong></p>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="card border-secondary shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-secondary">{{ $statusCounts['On Hold'] ?? 0 }}</h2>
                <p class="mb-0"><strong>On Hold</strong></p>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="card border-danger shadow-lg h-100">
              <div class="card-body">
                <h2 class="text-danger">{{ $statusCounts['Declined'] ?? 0 }}</h2>
                <p class="mb-0"><strong>Declined</strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-5">
      <h5 class="mb-3">Application Sources</h5>
      <div class='row'>
        <div class="col-md-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <canvas id="infoLowonganChart" width="300" height="300" style="min-height: 200px;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Quick Access Menu Section -->
    <div class="mb-5">
      <h5 class="mb-3">Applicant Shortcuts</h5>
      <div class="row">
        <div class="col-md-3">
          <div class="small-box bg-info shadow-lg">
            <div class="inner text-center">
              <h4>Data Pelamar</h4>
              <p>Manage applicant data efficiently.</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.index_pelamar') }}" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="small-box bg-danger shadow-lg">
            <div class="inner text-center">
              <h4>Kontak Pelamar</h4>
              <p>Reach out to applicants directly.</p>
            </div>
            <div class="icon">
              <i class="ion ion-monitor"></i>
            </div>
            <a href="{{ route('admin.contact_pelamar') }}" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<script>
  // Define PHP data as JavaScript variables
  const infoLowonganLabels = <?php echo json_encode(array_keys($infoLowonganCounts)); ?>;
  const infoLowonganData = <?php echo json_encode(array_values($infoLowonganCounts)); ?>;

  window.onload = function() {
    const ctx = document.getElementById('infoLowonganChart').getContext('2d');

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: infoLowonganLabels,
        datasets: [{
          label: 'Number of Applications by Source',
          data: infoLowonganData,
          backgroundColor: [
            '#3498db', '#2ecc71', '#e74c3c', '#f39c12', '#9b59b6', '#34495e', '#95a5a6'
          ],
          hoverBackgroundColor: [
            '#5dade2', '#58d68d', '#ec7063', '#f5b041', '#af7ac5', '#566573', '#b2babb'
          ],
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            labels: {
              font: {
                size: 14,
                family: 'Arial'
              },
              color: '#333',
              padding: 15
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                if (label) {
                  label += ': ';
                }
                if (context.raw !== null) {
                  const total = context.dataset.data.reduce((acc, value) => acc + value, 0);
                  const percentage = ((context.raw / total) * 100).toFixed(1);
                  label += `${context.raw} applications (${percentage}%)`;
                }
                return label;
              }
            },
            bodyFont: {
              family: 'Arial',
              size: 14
            }
          }
        }
      }
    });
  };
</script>

@endsection