<footer class="main-footer">
  <strong>Copyright &copy; <script>
      document.write(new Date().getFullYear());
    </script> </strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script> -->
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<!-- datepicker -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $('#datatableJobVacancy').DataTable({
    'pageLength': 25,
    'order': [
      [5, 'desc']
    ]
  });

  $('#job_description').summernote({
    placeholder: 'Input job responsibilities',
    tabsize: 2,
    onChange: function(contents, $editable) {
      // Set the height of the Summernote editor to auto
      $(this).summernote('option', 'height', 'auto');
      // Set the height of the Summernote editor based on its scroll height
      $(this).height($(this).prop('scrollHeight'));
    }
  });


  $('#job_requirement').summernote({
    placeholder: 'Input job requirements',
    tabsize: 2,
    onChange: function(contents, $editable) {
      // Set the height of the Summernote editor to auto
      $(this).summernote('option', 'height', 'auto');
      // Set the height of the Summernote editor based on its scroll height
      $(this).height($(this).prop('scrollHeight'));
    }
  });


  $('.select2-tags').select2({
    tags: true,
    // theme: 'bootstrap4',
  });




  let stepCount = 1;
  // alert(stepCount)

  // Add Step button click event
  $("#btn_add_step").click(function() {
    stepCount++; // Increment the step count

    // alert("add" + stepCount);

    // Clone the template
    const newStep = $(".step_activity:first").clone();

    // console.log(newStep)

    // Update the "Urutan" value
    newStep.find("input[type='number']").val(stepCount);

    // newStep.find("select[type='number']").val(stepCount);

    // Append the new step to the step container
    $("#area_activity").append(newStep);
  });



  $(document).on("click", ".btn_delete_step", function() {
    if ($(".step_activity").length > 1) {
      stepCount--;
      $(this).closest(".step_activity").remove();
      updateStepNumbers();
    }
  });



  function updateStepNumbers() {
    $(".step_activity").each(function(index) {
      $(this).find("input[name='application_step_no[]']").val(index + 1);
    });
  }
  // });

</script>

<!-- <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
</script> -->

@stack('scripts')
</body>

</html>