<div id="ProceedModal-{{ $pelamar->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ProceedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProceedModalLabel">Proses Pelamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <option value="On Hold" {{ in_array('On Hold', $disable) ? 'disabled' : '' }}>On Hold</option>
                            <option value="Declined" {{ in_array('Declined', $disable) ? 'disabled' : '' }}>Declined</option>
                            <option value="Accepted" {{ in_array('Accepted', $disable) ? 'disabled' : '' }}>Accepted</option>
                        </select>
                    </div>
                    <!-- Other form fields -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary submit-button" id="submitForm-{{ $pelamar->id }}">Submit</button>
            </div>
        </div>
    </div>
</div>