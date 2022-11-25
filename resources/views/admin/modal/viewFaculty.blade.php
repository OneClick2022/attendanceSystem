<div class="modal fade" id="viewFacultyModal_{{ $i }}" tabindex="-1" aria-labelledby="viewFacultyLabel" role="dialog" area-hidden="true">
    @php
        use App\Models\Subjects;
        $subjects = Subjects::where('professor', $faculty->email)->get();
        $i=1;
    @endphp

<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewFacultyLabel">Faculty Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <img src="{{ url('storage/'.$faculty->image) }}" width="100"/>
              </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('Name') }}:</strong>
                {{ $faculty->name }} {{ $faculty->surname }}
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>{{ __('Email') }}:</strong>
              {{ $faculty->email }}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>{{ __('Subjects') }}:</strong>
              @foreach ($subjects as $subject)
                {{ $subject->class_id }}
                @php
                $i++;
                @endphp
              @endforeach
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>{{ __('Phone Number') }}:</strong>
              {{ $faculty->ph_no }}
          </div>
        </div>


        {{-- now starts calender --}}



      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
