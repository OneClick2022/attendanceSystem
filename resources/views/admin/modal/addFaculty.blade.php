<div class="modal fade" id="addFacultyModal_{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="addFacultyLabel" aria-hidden="true">

    @php

        if($i>-1){
            $values = [$faculty->faculty_id,$faculty->name,$faculty->surname,$faculty->ph_no,$faculty->email,$faculty->image];
            $url = url('/admin/faculty/update/'.$values[0]);
        }
        else{
            $values = ['','','','','',''];
            var_dump($i);
            $url = url('/admin/faculty/add');
        }

    @endphp

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultyLabel">@if(strcmp($values[0],'')==0) Add @else Edit @endif Student</h5>
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
                    {{-- @if(strcmp($values[0],'')==0)
                    {!! Form::text('id', $values[0], [
                        'id' => 'id',
                        'placeholder' => 'Id number'
                    ]) !!}
                    @error('id')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    @endif --}}
                    {!! Form::text('name', $values[1], [
                        'id' => 'name',
                        'placeholder' => 'First Name'
                    ]) !!}
                    @error('name')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::text('surname', $values[2], [
                        'id' => 'surname',
                        'placeholder' => 'Last Name'
                    ]) !!}
                    @error('surname')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    {!! Form::text('email', $values[4], [
                        'id' => 'email',
                        'placeholder' => 'Email'
                    ]) !!}
                    @error('email')
                    <small><br>&ensp;{{$message}}<br></small>
                    @enderror<br>
                    @if(strcmp($values[0],'')==0)
                        {!! Form::password('password', [
                            'id' => 'password',
                            'placeholder' => 'Password'
                        ]) !!}
                        @error('password')
                        <small><br>&ensp;{{$message}}<br></small>
                        @enderror<br>
                        {!! Form::password('confirm_password', [
                                'id' => 'confirm_password',
                                'placeholder' => 'Confirm Password'
                            ]) !!}
                        @error('confirm_password')
                        <small><br>&ensp;{{$message}}<br></small>
                        @enderror<br>
                    @endif
                    {!! Form::text('ph_no', $values[3], [
                        'id' => 'ph_no',
                        'placeholder' => 'Phone Number'
                    ]) !!}
                    @error('ph_no')
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
                    @if (strcmp($values[5],'')!=0)
                    {!! Form::label('image', 'Choose an image if you want to replace', []) !!}
                    <img src = "{{ url('storage/'.$values[5]) }}" style="height:10vh"/>
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
