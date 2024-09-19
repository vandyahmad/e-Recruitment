@extends('template_admin.home') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
  <h4>Edit Job Vacancy</h4>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error) <!-- Assuming you have a layout file -->
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('vacancies.update', ['vacancies' => $vacancies->id]) }}" method="post">
    @csrf
    <!-- @method('PUT') -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Job Title</label>
          <input type="text" name="job_title" value="{{ $vacancies->job_title }}" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Job Location</label>
          <?php $selectedLocations = explode(',', $vacancies->job_location); ?>
          <select name="job_location[]" class="form-control select2-tags" multiple="multiple" data-placeholder="Choose Location">
            <!-- <option value="Bandung" {{ in_array('Bandung', $selectedLocations) ? 'selected' : '' }}>Bandung</option> -->
            @foreach($cities as $city)
            <option value="{{$city->name}}" {{ in_array($city->name, $selectedLocations) ? 'selected' : '' }}>{{$city->name}}</option>
            <!-- <option value="{{ $city->name }}" {{ in_array($city->name, $selectedLocations) ? 'selected' : '' }}>{{ $city->name }}</option> -->
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Job Company</label>
          <select name="job_company" class="form-control">
            <option value="" disabled>Choose Company</option>
            <option value="ecoCare" {{ $vacancies->job_company === 'ecoCare' ? 'selected' : '' }}>ecoCare</option>
            <option value="TukangBersih" {{ $vacancies->job_company === 'TukangBersih' ? 'selected' : '' }}>TukangBersih</option>
            <option value="pestCare" {{ $vacancies->job_company === 'pestCare' ? 'selected' : '' }}>pestCare</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Departement</label>
          <select name="job_functional" class="form-control">
            <option value="" disabled>Choose Departement</option>
            <option value="Sales" {{ $vacancies->job_functional === 'Sales' ? 'selected' : '' }}>Sales</option>
            <option value="Business Development" {{ $vacancies->job_functional === 'Business Development' ? 'selected' : '' }}>Business Development</option>
            <option value="Marketing Communication" {{ $vacancies->job_functional === 'Marketing Communication' ? 'selected' : '' }}>Marketing Communication</option>
            <option value="Human Resources & General Affair" {{ $vacancies->job_functional === 'Human Resources & General Affair' ? 'selected' : '' }}>Human Resources & General Affair</option>
            <option value="Finance & Accounting" {{ $vacancies->job_functional === 'Finance & Accounting' ? 'selected' : '' }}>Finance & Accounting</option>
            <option value="Operation" {{ $vacancies->job_functional === 'Operation' ? 'selected' : '' }}>Operation</option>
            <option value="Administrative" {{ $vacancies->job_functional === 'Administrative' ? 'selected' : '' }}>Administrative</option>
            <option value="Information Technology" {{ $vacancies->job_functional === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Job Type</label>
          <select name="job_type" class="form-control">
            <option value="" disabled>Choose Type</option>
            <option value="Fulltime" {{ $vacancies->job_type === 'Fulltime' ? 'selected' : '' }}>Fulltime</option>
            <option value="Magang" {{ $vacancies->job_type === 'Magang' ? 'selected' : '' }}>Magang</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Job Category</label>
          <select name="job_level" class="form-control">
            <option value="" disabled>Choose Category</option>
            <option value="Fresh Graduate" {{ $vacancies->job_level === 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
            <option value="Professional" {{ $vacancies->job_level === 'Professional' ? 'selected' : '' }}>Professional</option>
            <option value="Cabang Operasional" {{ $vacancies->job_level === 'Cabang Operasional' ? 'selected' : '' }}>Cabang Operasional</option>
            <option value="Internship" {{ $vacancies->job_level === 'Internship' ? 'selected' : '' }}>Internship</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="job_start_date">Job Start Date</label>
          <input type="date" class="form-control @error('job_start_date') is-invalid @enderror" id="job_start_date" name="job_start_date" value="{{ old('job_start_date', $vacancies->job_start_date) }}" placeholder="Job start date">
          @error('job_start_date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="job_end_date">Job End Date</label>
          <input type="date" class="form-control @error('job_end_date') is-invalid @enderror" id="job_end_date" name="job_end_date" value="{{ old('job_end_date', $vacancies->job_end_date) }}" placeholder="Job end date">
          @error('job_end_date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Responsibilities</label>
      <textarea name="job_description" id="job_description" class="form-control">{{ $vacancies->job_description }}</textarea>
    </div>
    <div class="form-group">
      <label>Job Requirement</label>
      <textarea name="job_requirement" id="job_requirement" class="form-control">{{ $vacancies->job_requirement }}</textarea>
    </div>


    <div class="form-group text-right pb-5 mt-2">
      <button type="submit" class="btn btn-primary">Next <i class="fa fa-arrow-circle-right"></i></button>
    </div>
  </form>
</div>
@endsection