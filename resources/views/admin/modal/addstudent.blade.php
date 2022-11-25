<div class="modal fade" id="addStudentModal_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel" aria-hidden="true">

    @php

        if($i!=-1){
            $values = [$student->name,$student->surname,$student->student_id,$student->batch,$student->division,$student->ph_no,$student->image];
            $url = url('/admin/student/update/'.$values[2]);
        }
        else{
            $values = ['','','','','','',''];
            var_dump($i);
            $url = url('/admin/student/add');
        }
    @endphp

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentLabel">@if(strcmp($values[0],'')==0) Add @else Edit @endif Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'url' => $url,
                    'method' => 'post',
                    'role' => 'form',
                    'enctype' => 'multipart/form-data'
                ]) !!}
                <div class="container">
                    {!! Form::text('first_name', $values[0], [
                        'id' => 'first_name',
                        'placeholder' => 'First Name'
                    ]) !!}
                    @error('first_name')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::text('last_name', $values[1], [
                        'id' => 'last_name',
                        'placeholder' => 'Last Name'
                    ]) !!}
                    @error('last_name')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    @if(strcmp($values[6],'')==0)
                    {!! Form::text('student_id', $values[2], [
                        'id' => 'student_id',
                        'placeholder' => 'Id number'
                    ]) !!}
                    @error('student_id')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    @endif
                    {!! Form::text('division', $values[4], [
                        'id' => 'division',
                        'placeholder' => 'Division'
                    ]) !!}
                    @error('division')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::text('batch', $values[3], [
                        'id' => 'batch',
                        'placeholder' => 'Batch'
                    ]) !!}
                    @error('batch')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::text('phone', $values[5], [
                        'id' => 'phone',
                        'placeholder' => 'Phone'
                    ]) !!}
                    @error('phone')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::label('Image', 'Image',[
                        'for' => 'Image'
                    ]) !!}
                    {!! Form::file('image', [
                        'id' => 'image'
                    ]) !!}
                    @error('image')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    @if (strcmp($values[6],'')!=0)
                    {!! Form::label('image', 'Choose an image if you want to replace', []) !!}
                    <img src = "{{ url('storage/'.$values[6]) }}" style="height:10vh"/>
                @endif
                </div>

            </div>
            <div class="modal-footer">
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>



