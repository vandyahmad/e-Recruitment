@extends('template_admin.home') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
  <h1>Add Job Vacancy</h1>

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
      <input type="text" name="job_location" class="form-control">
    </div>
    <!-- <div class="form-group">
      <label>Job Company</label>
      <input type="text" name="job_company" class="form-control">
    </div> -->
    <div class="form-group">
      <label>Job Company</label>
      <select name="job_company" class="form-control">
        <option value="" disabled selected>Pilih Company</option>
        <option value="ecoCare">ecoCare</option>
        <option value="TBI">TBI</option>
        <option value="pestCare">pestCare</option>
      </select>
    </div>

    <div class="form-group">
      <label>Job Branch</label>
      <input type="text" name="job_branch" class="form-control">
    </div>
    <div class="form-group text-right pb-5">
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Job</button>
    </div>
  </form>
</div>
@endsection