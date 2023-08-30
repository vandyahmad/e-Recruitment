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

    <div class="form-group text-right pb-5">
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Job</button>
    </div>
  </form>
</div>
@endsection