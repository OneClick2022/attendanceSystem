<div class="modal fade" id="studentSubjectModal_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="studentSubjectLabel" aria-hidden="true">

    @php
        use App\Models\Subjects;
        $subjects = Subjects::all();
    @endphp

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentSubjectLabel">Edit Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'url' => url('admin/student/editSub/'.$student->student_id),
                    'role' => 'form',
                    'method' => 'get'
                ]) !!}
                @foreach ($subjects as $subject)
                    {!! Form::checkbox('subject_'.$subject->class_id, $subject->class_id, false, [
                        'id' => 'subject'
                    ]) !!}
                    {!! Form::label('subject', $subject->class_name, ['id'=>'subject']) !!} <br>
                @endforeach
            </div>
            <div class="modal-footer">
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
