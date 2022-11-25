@extends('layouts.main')
@push('title', 'Profile')
@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif
@php
use App\Models\Faculty;
use App\Models\Subjects;
$faculty = Faculty::where('email',Auth::user()->email)->get();
$subjects = Subjects::where('professor', $faculty[0]->email)->get();
$i = 0;
@endphp

@section('main_content')
<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="container">
        <div class="navigation">
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
                    <a href="{{ url('/camera') }}">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <span class="title">Upload photo</span>
                    </a>
                </li>
                
            </ul>
        </div>
<!--
        
-->
<div class="main-content" style="left:300px;width:calc(100% - 300px);">
        <header style="width:calc(100% - 300px);">
            <h2>
                
                Profile
            </h2>

            <div class="user-wrapper">
                <label for="touch">
                    <div>
                        <img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='55'/>        
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

        <img alt="person" src="{{ 'storage/'.$faculty[0]->image }}" width='200'/>
    
        <table class="table">
            <tbody>
                <tr>
                    <td> name: </td>
                    <td> {{ $faculty[0]->name }} </td>
                </tr>
                <tr>
                    <td> surname: </td>
                    <td> {{ $faculty[0]->surname }} </td>
                </tr>
                <tr>
                    <td> phone number: </td>
                    <td> {{ $faculty[0]->ph_no }} </td>
                </tr>
                <tr>
                    <td> Alloted Subjects: </td>
                    <td> @foreach ($subjects as $subject)
                        {{ $subject->class_id }}
                        @php
                        $i++;
                        @endphp
                    @endforeach </td>
                </tr>
                
            </tbody>
        </table>
    </main>
</div>

@endsection
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
