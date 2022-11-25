@extends('layouts.main')
@push('title', 'Student')
@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif
@php
    use App\Models\Student;
    use App\Models\Faculty;
    use App\Models\Subjects;
    $students = Student::all();
    
    // $stu_subjects = array();
    // foreach($students as $student){
    //     array_push($stu_subjects,explode(',',$student->subjects));
    // }
    // $subjects = Subjects::where('professor',Auth::user()->email)->get();
     $faculty = Faculty::where('email',Auth::user()->email)->get();
    // $final_subjects = array();
    // $flag = 0;
    // foreach($stu_subjects as $stu_subject){
    //     foreach($stu_subject as $subject_stu){
    //         foreach($subjects as $subject){
    //             if(strcmp($subject->class_id,$subject_stu)==0){
    //             array_push($final_subjects,array(array_keys($stu_subjects)[$flag]=>$subject_stu));
    //         }
    //         }
    //     }
    //     $flag++;
    // }

//     for($j=count($final_subjects)-1;$j--;$j>=0){
//     foreach ($final_subjects as $final_subject) {
//         if(isset($final_subject[$j]))
//         p($final_subject[$j]);
//     }
// }
$faculty_subjects = Faculty::join('class','class.professor','=','faculty.email')->where('faculty.email',Auth::user()->email)->pluck('class.class_id')->toArray();

    $i=0;
    // $j=0;
@endphp

@section('main_content')

<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="container">
        <div class="navigation" style="border-left:10px solid #c2e2cb">
            <ul>
                <li>
                    <a href="#">
                        
                       <img src="{{url('images\oneclick.png')}}"/>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/') }}">
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
                
                Student Information
            </h2>

            <div class="user-wrapper">
                <label for="touch">
                    <div>
                        <img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='55' height='55'/>        
                    </div>
                </label>               
                <input type="checkbox" id="touch"> 
                
                
                <ul class="slide">
                    <li><img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='55'/></li>
                    <li><h4> {{ $faculty[0]->name }} {{ $faculty[0]->surname }} </h4></li>
                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                    <li><a href="{{ url('/main/logout') }}">Logout</a></li>
                </ul>

            </div>
        </header>

    <main>
        <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <td>Id no.</td>
                    <td>Name</td>
                    <td>Information and Attendance</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->name}} {{ $student->surname }}</td>
                        <td>
                        <a href="{{ route('student.studentInfo',['id'=>$student->student_id]) }}"><button type="button" class="btn btn-success"> Information </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- 
        <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
            headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
        });
            var calender = $('#calender').fullCalender();
        })
        </script>
        <div class="container">
            <div id="calender">Hello</div>
        </div> --}}
        <!-- Button trigger modal -->


        <!-- Modal -->


        @endsection
        
    </main>
</div>

            <!--
           <div class="cards" >
                <div class="cards-single" >
                    <div>
                        <h1>Upload Photo</h1>
                        <span>Upload class photo to take attendance</span>
                    </div>
                    <div>
                        <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                    </div>
                </div>
                <div class="cards-single">
                    <div>
                        <h1>Attendance</h1>
                        <span>View attendance</span>
                    </div>
                    <div>
                        <span class="icon"><ion-icon name="checkmark-outline"></ion-icon></span>
                    </div>
                </div>
                
                <div class="cards-single">
                    <div>
                        <h1>Graphs</h1>
                        <span>fbefjs</span>
                    </div>
                    <div>
                        <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></span>
                    </div>
                </div>

            </div>
-->
        </main>
    </div>
    
    
<script>
        function openNav() {
            document.getElementByClassName("navigation").style.width = "250px";
            document.getElementByClassName("main-content").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementByClassName("navigation").style.width = "0";
            document.getElementByClassName("main-content").style.marginLeft= "0";
            document.body.style.backgroundColor = "white";
        }
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


