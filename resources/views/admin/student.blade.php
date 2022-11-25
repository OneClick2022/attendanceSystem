@extends('layouts.main')
@push('title', 'Student')
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
    use App\Models\Student;
    $students = Student::all();
    $i = -1;
@endphp

<a href="{{ url('/admin') }}">back</a>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<style>
main button{
    background: #32ce5f !important;
    border:#32ce5f!important;
}
main button:hover{
    background: #3b9f57;
}
</style>

@include('admin.modal.addStudent')
<div class="container">
    <div class="navigation" style="border-left:10px solid #c2e2cb;">
            <ul>
                <li>
                    <a href="#">
                        
                       <img src="{{url('images\oneclick.png')}}"/>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/admin') }}">
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
                
            </ul>
    </div>
    <span onclick="openNav()">open</span>

    <div class="main-content" style="left:300px; width:calc(100% - 300px);">
        <header style="width:calc(100% - 300px);">
            <h2>
                
                Student Information
            </h2>
            <div class="user-wrapper">
                <label for="touch">
                    <div>
                        {{ $admin[0]->name }}        
                    </div>
                </label>               
                <input type="checkbox" id="touch"> 
                
                
                <ul class="slide1">
                   
                    <li><h4> {{ $admin[0]->name }}</h4></li>
                    
                    <li><a href="{{ url('/main/logout') }}">Logout</a></li>
                </ul>

            </div>
        </header>

        <main>

            <button href=# class="btn btn-success" data-toggle="modal" data-target="#addStudentModal_{{ $i }}" id="view">Add</button>
            <div class="table">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Id no.</td>
                            <td>Name</td>
                            <td>Information</td>
                            <td>Subjects</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        @php
                            $i++;
                        @endphp
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->name}} {{ $student->surname }}</td>
                                <td>{{ $student->subjects }}</td>
                                <td><button href=# class="btn btn-primary" data-toggle="modal" data-target="#viewStudentModal_{{ $i }}" id="view">View</button>
                                    @include('modal.viewStudentInfo')</td>
                                <td><button href=# class="btn btn-success" data-toggle="modal" data-target="#addStudentModal_{{ $i }}" id="view">Edit</button>
                                    @include('admin.modal.addStudent')</td>
                                <td><button href=# class="btn btn-success" data-toggle="modal" data-target="#studentSubjectModal_{{ $i }}" id="view">Edit Subjects</button>
                                    @include('admin.modal.studentSubject')</td>
                                <td><a href="{{ route('admin.student.delete', ['id' => $student->student_id]) }}"><button>Delete</button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@if(session()->has('alert'))
<script>alert('{{ session()->get('alert') }}');</script>
@endif
@endsection
