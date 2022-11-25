@extends('layouts.main')
@push('title', 'Upload')

@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif
@php
    use App\Models\Faculty;
    $faculty = Faculty::where('email',Auth::user()->email)->get();
    $faculty_subjects = array('select a subject');
    $faculty_subjects = array_merge($faculty_subjects,Faculty::join('class', 'class.professor','=','faculty.email')->where('faculty.email', Auth::user()->email)->pluck('class.class_id')->toArray());
    $faculty_subjects = array_combine($faculty_subjects,$faculty_subjects);
@endphp
<script>
  Myfunction() {
    $('#loading').hide();
  }
</script>
<style>
.container .navigation{

border-left:10px solid #eaddff;
}
.container .navigation ul li:hover
{

   background: #eaddff;
}

.upload{
    width=100%;
    justify-content:space-between;
    display: flex;
    margin: 10px;
    padding: 10px;
    position: relative;
   }

#loading {
  position: fixed;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
}

#loading-image {
  z-index: 100;
}
 main .attendance table td:first-child {
  border-right: 1px solid rgba(0,0,0,0.1);
}
    main .attendance table{
        text-align:center;
        width:100%;
        margin-left:auto;
        margin-right:auto;
        border-top:  1px solid rgba(0,0,0,0.1);
        border-left:  1px solid rgba(0,0,0,0.1);
        border-right:  1px solid rgba(0,0,0,0.1);
    }
    main .attendance table thead td{
    font-weight:600;

    }
    main .attendance table tr{
    color:var(--black1);
    border-bottom: 1px solid rgba(0,0,0,0.1);

    }
    main .attendance  table tbody tr:hover{
    color:var(--white);
    background: #eaddff;
    }
    main h1{
        text-align:center;
        font-size:2em;
        padding:10px;
    }
    main form input[type=submit]
    {
        background:#cdaeff;
        border: #cdaeff;
        padding-left: 12px;
        padding-right: 12px;
        padding-bottom: 6px;
        border-radius: 2px;
        padding-top: 6px;
        font-weight: 400;
        width: 100px;
        color: #fff;

    }
    main form input[type=submit]:hover
    {
        background:#9a83be;
        border: #9a83be;
        color: #fff;

    }
    main form input::file-selector-button
    {
        background:#cdaeff;
        border: #cdaeff;
        padding-left: 12px;
        padding-right: 12px;
        padding-bottom: 6px;
        border-radius: 2px;
        padding-top: 6px;
        font-weight: 400;
        color: #fff;

    }
    main form input::file-selector-button:hover
    {
        background:#9a83be;
        border: #9a83be;
        color: #fff;

    }
    main form .upload{
        grid-template-columns: 1fr 1fr 1fr;
    }

</style>

@section('main_content')

<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="container">
        <div class="navigation" >
            <ul>
                <li>
                    <a href="#">

                       <img src="{{url('images\oneclick.png')}}"/>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('http://127.0.0.1:8000/') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student') }}">
                        <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></ion-icon></span>
                        <span class="title">Student Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/subject') }}">
                        <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                        <span class="title">Subject Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/upload') }}">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <span class="title">Upload photo</span>
                    </a>
                </li>

            </ul>
        </div>
<!--

-->
    <div class="main-content" style="left:300px; width:calc(100% - 300px);">
            <header style="width:calc(100% - 300px);">
                <h2>

                    Upload photo
                </h2>

                <div class="user-wrapper">
                    <label for="touch">
                        <div>
                            <img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='55' height='55'/>
                        </div>
                    </label>
                    <input type="checkbox" id="touch">


                    <ul class="slide">
                        <li><img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='55' height='55'/></li>
                        <li><h4> {{ $faculty[0]->name }} {{ $faculty[0]->surname }} </h4></li>
                        <li><a href="{{ url('/profile') }}">Profile</a></li>
                        <li><a href="{{ url('/main/logout') }}">Logout</a></li>
                    </ul>

                </div>
            </header>

        <main onload="Myfunction()">

            <h1>Upload the image for attendance</h1>
            <br/>
            {!! Form::open([
                'url' => url('/upload/add'),
                'method' => 'post',
                'role' => 'form',
                'enctype' => 'multipart/form-data'
            ]) !!}

            <div class="upload">


                {!! Form::file('image[]', [
                    'id' => 'image',
                    'multiple'
                ]) !!}

                {!! Form::date('date', "2022-06-01", [
                    'id' => "ttFrom"
                ]) !!}

                {!! Form::select('subject', $faculty_subjects,[
                    'id' => 'subject'
                ]) !!}


                {{-- <input type='date'  name="ttFrom" value="2017-06-01"> --}}
                {{-- @error('image')
                <small><br>&ensp;{{$message}}<br></small>
                @enderror<br> --}}
                {!! Form::submit('Upload') !!}
            </div>
            {!! Form::close() !!}
            <div class="attendance">

                @php
                if(session()->has('alert'))
                    // p(session()->get('alert'));
                {   echo "<table><thead><tr><td>Present</td><td>Absent</td></tr></thead>";
                    $string = session()->get('alert');
                    //echo $string;
                    //echo "<br>";
                    $str_arr = explode ("are present", $string);

                    $str_arr1 = explode(",",$str_arr[0]);
                    //echo count($str_arr1);
                    //echo "<br>";
                    $str_arr2 = explode(",",$str_arr[1]);
                    //echo count($str_arr2);
                    //echo "<br>";
                 /* echo "<br>";
                    echo count($str_arr1);
                    echo "<br>";
                    echo count($str_arr2);
                    echo "<br>";
                    */


                    if(count($str_arr1)>=count($str_arr2))
                    {
                        $n=count($str_arr2);
                    }
                    else
                        $n=count($str_arr1);
                    /*
                    echo $n;
                    echo"<br>";
                    */
                    for($i=0;$i<$n;$i++)
                    {
                        echo "<tr>";
                        echo"<td>".$str_arr1[$i]."</td>";
                        echo"<td>". $str_arr2[$i]."</td>";
                        echo"</tr>";
                    }
                    //echo $i;
                    //echo"<br>";
                    if(array_key_exists($i,$str_arr1))
                    {
                        for(;$i<count($str_arr1);$i++){
                            echo "<tr>";
                            echo"<td>".$str_arr1[$i]."</td>";
                            echo"<td>"."</td>";
                            echo"</tr>";
                        }
                    }
                    else if(array_key_exists($i,$str_arr2))
                    {
                        for(;$i<count($str_arr2);$i++){

                            echo "<tr>";
                            echo"<td>"."</td>";
                            echo"<td>".$str_arr2[$i]."</td>";
                            echo"</tr>";
                        }

                    }
                    else;
                }

                @endphp
                </table>
            </div>
        </main>
    </div>
</div>

@endsection
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
