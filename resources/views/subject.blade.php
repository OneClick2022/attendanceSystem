@extends('layouts.main')
@push('title', 'Subject')
@section('main_content')

@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif

@php
    use App\Models\Faculty;
    use App\Models\Subjects;
    use App\Models\Attendance;
    use App\Models\Lecture;
    use App\Models\Student;
    $faculty = Faculty::where('email',Auth::user()->email)->get();
    $mainsubjects = Subjects::where('professor', $faculty[0]->email)->get();
    $i = 0;
@endphp
<style>
.container .navigation{

border-left:10px solid #DCE9FF;
}
.container .navigation ul li:hover
{
    
   background: #DCE9FF;
}
.att

main  #btn_graph{
    background: #a9c8ff !important;
    border:#a9c8ff !important;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 6px;
    border-radius: 2px;
    padding-top: 6px;
    font-weight: 400;
    color: #fff;
}
#btn_graph:hover{
    background: #849cc6 !important;
    border:#849cc6 ;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 6px;
    border-radius: 2px;
    padding-top: 6px;
    font-weight: 400;
    color: #fff;
}
</style>
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
                
                Subject Information
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
        <br>

            @foreach ($mainsubjects as $mainsubject)
                <button class="btn btn-primary" onclick="showGraph('{{ $mainsubject->class_id }}')" id="btn_graph">{{ $mainsubject->class_id }}</button>

        @endforeach
        <div class="map_canvas">
            <canvas id="myChart" width="auto" height="100"></canvas>
        </div>

        @php
        if(isset($_GET['subject']))
            $subject = $_GET['subject'];
        else
            $subject = $mainsubjects[0]->class_id;
        $lectures = Attendance::where('present', 1)->get();
        // $total_lectures = Attendance::join('lecture','lecture.lecture_id','=','present.lecture_id')->where('lecture.class_id',$subject)->get()->count();
        $student_subjects = Student::all();
        $students = array();
        $subjects = array();
        foreach($student_subjects as $student_subject){
            $temps = explode(',',$student_subject->subjects);
            array_pop($temps);
            foreach($temps as $temp){
                if(strcmp($temp,$subject)==0){
                    array_push($students, $student_subject->student_id);
                }
            }
        }
        $percentageAttendance = array();
        foreach($lectures as $lecture){
        $tempSubject = Lecture::where('lecture_id', $lecture->lecture_id)->pluck('class_id')->toArray();
        $tempSubject = implode($tempSubject);
        // p($tempStudent);
        if(strcmp($tempSubject,$subject)==0){
            array_push($subjects,$lecture->student_id);
        }
        // array_push($students)
        }
        //now final array for the process
        $graph = array();
        foreach($students as $student)
        {
            $size = Lecture::join("present", "lecture.lecture_id", "=", "present.lecture_id")
                        ->select("lecture.lecture_date")->distinct()
                        ->where("present.student_id", "=", $student)
                        ->where("lecture.class_id", "=", $subject)
                        ->where("present.present",1)->get()->count();
            $total_lectures = Lecture::join("present", "lecture.lecture_id", "=", "present.lecture_id")
                        ->select("lecture.lecture_date")->distinct()
                        ->where("present.student_id", "=", $student)
                        ->where("lecture.class_id", "=", $subject)->get()->count();
            // foreach($subjects as $subject_sub){
            //     if($student == $subject_sub){
            //         $size++;
            //     }
            // }
            // p($total_lectures);
            // die;
            if($total_lectures==0)
                continue;
            $percentage = ($size*100)/$total_lectures;
            // else
            // //     $percentage = 0;
            // p($percentage);
            $graph = array_replace($graph, [$student=>$percentage]);
        }
        for($i=0;$i<sizeOf($students);$i++){
        $students[$i] = "$students[$i]";
        }
        @endphp

        <script>
            function showGraph(subject){
                // var subject = document.getElementById('btn_graph').innerHTML;
                window.location.replace('?subject='+subject);
            }
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: {!! json_encode($students) !!},
            datasets: [{
                label: '',
                data: {!! json_encode($graph) !!},

                backgroundColor: [
                    'rgb(220,233,255)'
                ],
                borderColor: [
                    'rgba(31, 58, 147, 1)'
                ],
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                    max: 100,
                    min: 0,
                    ticks: {
                        stepSize: 10
                    }
                }
            },
            plugins: {
                title: {
                    display: false,
                    text: 'Custom Chart Title'
                },
                legend: {
                    display: false,
                }
            }
            }
            });

        </script>
    @endsection
    </main>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
