@extends('template_admin.home') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
  <h4>Add Job Vacancy</h4>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error) <!-- Assuming you have a layout file -->
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('vacancies.store') }}" method="post">
    @csrf
    <div class="form-group">
      <label>Job Title</label>
      <input type="text" name="job_title" class="form-control">
    </div>
    <div class="form-group">
      <label>Job Description</label>
      <textarea name="job_description" id="job_description" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label>Job Requirement</label>
      <textarea name="job_requirement" id="job_requirement" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label>Job Location</label>
      <select name="job_location[]" class="form-control js-example-tags" multiple="multiple" data-placeholder="Choose Location">
        <option value="Jakarta">Jakarta</option>
        <option value="Bandung">Bandung</option>
        <option value="Surabaya">Surabaya</option>
      </select>
    </div>

    <div class="form-group">
      <label>Job Branch</label>
      <select name="job_branch[]" class="form-control js-example-tags" multiple="multiple" data-placeholder="Choose Branch">
        <option value="Jakarta 1">Jakarta 1</option>
        <option value="Jakarta 2">Jakarta 2</option>
        <option value="Jakarta 3">Jakarta 3</option>
      </select>
    </div>

    <div class="form-group">
      <label>Job Company</label>
      <select name="job_company" class="form-control">
        <option value="" disabled selected>Choose Company</option>
        <option value="ecoCare">ecoCare</option>
        <option value="TBI">TBI</option>
        <option value="pestCare">pestCare</option>
      </select>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label for="job_start_date">Job Start Date</label>
          <input type="date" class="form-control @error('job_start_date') is-invalid @enderror " id="job_start_date" name="job_start_date" value="{{ old('job_start_date')}}" placeholder="Job start date">
          @error('job_start_date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label for="job_end_date">Job End Date</label>
          <input type="date" class="form-control @error('job_end_date') is-invalid @enderror " id="job_end_date" name="job_end_date" value="{{ old('job_end_date')}}" placeholder="Job end date">
          @error('job_end_date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>
    <div></div>
    <!-- <div class="form-group text-center pb-5 mt-2">
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Job</button>
    </div> -->
    <div class="form-group text-right pb-5 mt-2">
      <button type="submit" class="btn btn-primary">Next <i class="fa fa-arrow-circle-right"></i></button>
    </div>
  </form>
</div>
@endsection