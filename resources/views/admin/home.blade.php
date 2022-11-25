
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
use App\Models\User;
$admin = User::where('email',Auth::user()->email)->get();
@endphp

<!--
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>

                    <div class="user">
                        <h4>{{ $admin[0]->name }}</h4>
                    </div>
                </div>
            </div>
        </div>
-->
<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="container">
    <!--
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">

                       <h4> <span class="title">Attendance System</span></h4>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/admin/student') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/student') }}">
                        <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></ion-icon></span>
                        <span class="title">Student Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/subject') }}">
                        <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                        <span class="title">Subject Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/faculty') }}">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></ion-icon></span>
                        <span class="title">Faculty Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/timetable') }}">
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
        <span onclick="openNav()">open</span>

-->
<div class="main-content">
<header>
            <h2>

                Dashboard
            </h2>
            <div class="user-wrapper">
                <label for="touch">
                    <div>
                        {{ $admin[0]->name }}
                    </div>
                </label>
                <input type="checkbox" id="touch">


                <ul class="slide">

                    <li><h4> {{ $admin[0]->name }}</h4></li>

                    <li><a href="{{ url('/main/logout') }}">Logout</a></li>
                </ul>

            </div>
        </header>

        <main>
           <div class="cards">
                <a href="{{ url('/admin/faculty') }}" style="background:#eaddff;">
                    <div class="cards-single" >

                        <div >
                            <h1>Faculty Information</h1>
                            <span>View and update faculty information</span>
                        </div>

                        <div>
                            <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                        </div>
                    </div>
                </a>
 <!--               <a  href="{{ url('/admin/timetable') }}" style="background:#fff6db;">
                    <div class="cards-single">

                        <div>
                            <h1>Time Table</h1>
                            <span>View and edit class time table</span>
                        </div>
                        <div>
                            <span class="icon"><ion-icon name="checkmark-outline"></ion-icon></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="cards">
            -->
                <a href="{{ url('/admin/student') }}" style="background:#c2e2cb;">
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
                <a href="{{ url('/admin/subject') }}" style="background:#DCE9FF;">
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
        Let list=document.querySelectorAll('.navigation li');
        function activeLink(){
            list.forEach((item)  =>
            item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item)=>
        item.addEventListener('mouseover', activeLink));
    </script>
    <!--
    <div class="container">
        <a href="{{ url('/student') }}">Student Information</a>
        <a href="{{ url('/subject') }}">Subject Information</a>
        <a href="{{ url('/profile') }}">Faculty Information</a>
        <a href="{{ url('/camera') }}">Time Table</a>
        <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
-->
@endsection
