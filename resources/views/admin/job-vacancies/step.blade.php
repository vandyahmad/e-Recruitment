@extends('template_admin.home') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
  <h3 class='text-center'>Add Job Vacancy Steps</h3>

  <div><P>Job Vacancy : <strong>{{$job_vacancies->job_title}}</strong></P></div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error) <!-- Assuming you have a layout file -->
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  
  <form action="{{ route('vacancies.step_store') }}" method="post" class="mt-2">
    @csrf
    <input type="hidden" name="job_vacancy_id" value="{{$id}}" />

    <!-- <div class="col-md-12"></div> -->
    <div id="area_activity">
      <div class="row mt-5">
        <div class="col-md-1">
          <div class="form-group">
            <label>Urutan</label>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Application Step</label>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" id="btn_add_step" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add Step</button>
          </div>
        </div>
      </div>
      <div class="row step_activity">

        <div class="col-md-1">
          <div class="form-group">

            <input type="number" class="form-control" name="application_step_no[]" value="1" readonly />
          </div>
        </div>

        <div class="col-md-9">
          <div class="form-group">

            <select name="application_step[]" class="form-control">
              <option value="" disabled selected>Select Application Step</option>
              @foreach($activity_steps as $step)
              <option value="{{ $step->id }}">{{ $step->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-danger btn-sm btn_delete_step"><i class="fa fa-trash"></i> Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10">
        <div class="form-group text-right pb-5 mt-2">
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection