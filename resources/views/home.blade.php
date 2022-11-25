@extends('layouts.main')
@push('title', 'Home')
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

$mainsubjects = Subjects::where('professor', $faculty[0]->email)->get();
$faculty = Faculty::where('email',Auth::user()->email)->get();
@endphp
<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="container">
    {{-- <!--
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        
                       <h4> <span class="title">Attendance System</span></h4>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/student') }}">
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
                    <a href="{{ url('/profile') }}">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></ion-icon></span>
                        <span class="title">Faculty Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/camera') }}">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <span class="title">Time Table</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/main/logout') }}">
                        <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        
--> --}}
<div class="main-content">
        <header>
            <h2>
               
                Dashboard  
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
           <div class="cards">
                <a href="{{ url('/upload') }}" style="background:#eaddff;">
                    <div class="cards-single" >
                    
                        <div >
                            <h1>Upload Photo</h1>
                            <span>Upload class photo</span>
                        </div>
                    
                        <div>
                            <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                        </div>  
                    </div>
                </a>
                <!--
                <a style="background:#fff6db;">
                    <div class="cards-single">
                    
                        <div>
                            <h1>Attendance</h1>
                            <span>View Student attendance</span>
                        </div>
                        <div>
                            <span class="icon"><ion-icon name="checkmark-outline"></ion-icon></span>
                        </div>
                    </div>
                </a>
-->
            
                <a href="{{ url('/student') }}" style="background:#c2e2cb;">
                    <div class="cards-single">
                            <div>
                                <h1>Student information</h1>
                                <span>View and edit student information</span>
                            </div>
                        <div>
                            <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></ion-icon></span>
                        </div>
                    </div>
                </a>
                <a href="{{ url('/subject') }}" style="background:#DCE9FF;">
                    <div class="cards-single">
                    
                        <div>
                            <h1>Subject information</h1>
                            <span>View subject-wise attendance report</span>
                        </div>
                        <div>
                            <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                        </div>
                    </div>
                </a>
            </div>
        </main>
    </div>
</div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
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

{{-- <!--
    
    <script>
        Let list=document.querySelectorAll('.navigation li');
        function activeLink(){
            list.forEach((item)  =>
            item.classList.remove('hovered'));  
            this.classList.add('hovered');
        }
        list.forEach((item)=>
        item.addEventListener('mouseover', activeLink));
    </script>
    -->
    <!--
    <div class="container">
        <a href="{{ url('/student') }}">Student Information</a>
        <a href="{{ url('/subject') }}">Subject Information</a>
        <a href="{{ url('/profile') }}">Faculty Information</a>
        <a href="{{ url('/camera') }}">Time Table</a>
        <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
--> --}}
@endsection
{{-- <!--
    <div class="container">
        <img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='200'/>
        <h2>Welcome, {{ $faculty[0]->name }} {{ $faculty[0]->surname }}</h2>
    </div>

    <div class="container">
        <a href="{{ url('/student') }}">Student Information</a>
        <a href="{{ url('/subject') }}">Subject Information</a>
        <a href="{{ url('/profile') }}">Profile</a>
        <a href="{{ url('/upload') }}">Upload</a>
        <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
    --> --}}
