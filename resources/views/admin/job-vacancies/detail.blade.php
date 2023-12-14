@extends('template_admin.home')
@section('title', 'Vacancy Detail')

@section('content')
<!-- CARD ID -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- <div class="col-md-3"></div> -->


      <!-- Kolom Detail Vacancy -->
      <div class="col-md-12">
        <div class="card card-solid">
          <div class="card-body pb-0">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><b>Informasi Job Vacancy</b></li>
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Title</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_title}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Description :</label>
                    <div class="col-sm-10">
                      <!-- <label>:</label> -->
                      <label>{!!$vacancies->job_description!!}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Requirement :</label>
                    <div class="col-sm-10">
                      <!-- <label>:</label> -->
                      <label>{!!$vacancies->job_requirement!!}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Location</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_location}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Company</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_company}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Branch</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_branch}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Start Date</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_start_date}}</label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class=" col-sm-2">Job Exp Date</label>
                    <div class="col-sm-10">
                      <label>:</label>
                      <label>{{$vacancies->job_end_date}}</label>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection