<div class="modal fade" id="addSubjectModal_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">

    @php

    if($i!=-1){
        $values = [$subject->class_id,$subject->class_name,$subject->professor];
        $url = url('/admin/subject/update/'.$values[0]);
    }
    else{
        $values = ['','',''];
        $url = url('/admin/subject/add');
    }

    use App\Models\Faculty;
    $faculties = Faculty::pluck('email');
    $entities = array("Select desired faculty");
    foreach($faculties as $faculty){
        $entities["$faculty"] = $faculty;
    }
@endphp

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addSubjectLabel">@if(strcmp($values[0],'')==0) Add @else Edit @endif Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open([
                'url' => $url,
                'method' => 'get',
                'role' => 'form'
            ]) !!}
            <div class="container">
                @if (strcmp($values[0],'')==0)
                    {!! Form::text('class_id', $values[0], [
                        'id' => 'class_id',
                        'placeholder' => 'Class Id'
                    ]) !!}
                    @error('class_id')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                @endif
                {!! Form::text('class_name', $values[1], [
                    'id' => 'class_name',
                    'placeholder' => 'Class Name'
                ]) !!}
                @error('class_name')
                <small><br>&ensp;{{$message}}<br></small>
                @enderror<br>
                {!! Form::select('professor', $entities, ['id'=>'professor']) !!}
                {{-- {!! Form::text('professor', $values[2], [
                    'id' => 'professor',
                    'placeholder' => 'Professor'
                ]) !!} --}}
                @error('professor')
                <small><br>&ensp;{{$message}}<br></small>
                @enderror<br>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Submit') !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

</div>
