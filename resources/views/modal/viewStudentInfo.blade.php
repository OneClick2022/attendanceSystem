<div class="modal fade exclude" id="viewStudentModal_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="viewStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewStudentLabel">Student Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <img src="{{ url('storage/'.$student->image) }}" width="100"/>
                </div>
              </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>{{ __('Name') }}:</strong>
                  {{ $student->name }} {{ $student->surname }}
          </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('Division') }}:</strong>
                {{ $student->division }}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('Batch') }}:</strong>
                {{ $student->batch }}
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('Phone Number') }}:</strong>
                {{ $student->ph_no }}
            </div>
          </div>


          {{-- now starts calender --}}



        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


