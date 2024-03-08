@extends('template_admin.home')

@section('content')
<div class="container">
  <h3 class='text-center mb-5'>Edit Job Vacancy Steps</h3>
  @if ($vacancies->isNotEmpty() && $vacancies->first())
  <h5>Job Vacancy: <b><i>{{ $vacancies->first()->job_title }}</i></b></h5>
  @else
  <h5>Silahkan isi Job Vacancy Step</h5>
  @endif
  <hr class="mb-5">
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('vacancies.step_update', ['id' => $id]) }}" method="post" class="mt-2">
    @csrf
    @method('PUT') <!-- Add this line to specify that you are making a PUT request for updating -->

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
            <button type="button" onclick="btn_edit_step()" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add Step</button>
          </div>
        </div>
      </div>

      <!-- Loop through existing steps for editing -->
      @if(count($vacancies) > 0)
      @foreach($vacancies as $index => $vacancy)
      <div class="row step_activity_edit">
        <div class="col-md-1">
          <div class="form-group">
            <input type="number" class="form-control" name="application_step_no[]" value="{{ $index + 1 }}" readonly />
          </div>
        </div>
        <div class="col-md-9">
          <div class="form-group">
            <select name="application_step[]" class="form-control">
              <option value="" disabled selected>Select Application Step</option>
              @foreach($activity_steps as $step)
              <option value="{{ $step->id }}" @if($vacancy->activity_step_id == $step->id) selected @endif>{{ $step->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" onclick="btn_delete_step_edit(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="row step_activity_edit">
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
            <button type="button" onclick="btn_delete_step_edit(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
          </div>
        </div>
      </div>
      @endif
    </div>

    <div class="row">
      <div class="col-md-10">
        <div class="form-group text-right pb-5 mt-2">
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
<script>
  let stepCountExist = '{{count($vacancies)}}';

  let stepCount = stepCountExist > 0 ? stepCountExist : 1;
  // alert(stepCount)
  function btn_edit_step() {
    // alert("kesii")
    stepCount++;
    // const newStep = $(".step_activity_edit:first").clone().css({
    //   'display': 'flex'
    // });
    const newStep = $(".step_activity_edit:first").clone();
    // Find the select element within the cloned step
    const selectElement = newStep.find("select");

    // Remove the 'selected' attribute from all options
    selectElement.find("option").removeAttr("selected");
    // console.log(selectElement)
    // Set the desired option as selected based on its value
    selectElement.find(`option[value='']`).attr("selected", "selected");
    newStep.find("input[type='number']").val(stepCount);
    $("#area_activity").append(newStep);
  }


  function btn_delete_step_edit(button) {

    var stepContainer = $(button).closest(".step_activity_edit");

    if ($(".step_activity_edit").length > 1) {
      stepContainer.remove();

      updateStepNumbersEdit();
      stepCount = $(".step_activity_edit").length;
    }
  }


  function updateStepNumbersEdit() {
    $(".step_activity_edit").each(function(index) {
      $(this).find("input[name='application_step_no[]']").val(index + 1);
    });
  }
</script>