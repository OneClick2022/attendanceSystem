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
    
   
    use App\Models\User;
    $admin = User::where('email',Auth::user()->email)->get();

    use App\Models\Faculty;
    $faculties = Faculty::all();
    $i=-1;
@endphp
<link rel="stylesheet" type="text/css" href="/css/style.css">


<style>
main button{
    background: #d1b4ff !important;
    border:#d1b4ff !important;
}
main button:hover{
    background: #9b86bc !important;
}
    main .table table tbody tr:hover{
        color:var(--white) ;
        background: #eaddff !important;
    }
    main .table table tbody tr button:hover{
        background: #9b86bc !important;
    }
    main .table table tbody tr button{
        
        background: #d1b4ff !important;
        border:#d1b4ff !important;
    }

    main .table table tbody tr a button{
        color: #fff;
        background: #d1b4ff !important;
        border:#d1b4ff !important;
        padding-left:12px;
        padding-right:12px;
        padding-bottom: 6px;
        border-radius: 2px;
        padding-top:6px;
    }
    .container .navigation{

border-left:10px solid #eaddff;
}
.container .navigation ul li:hover
{
    
   background: #eaddff;
}
</style>

@include('admin.modal.addFaculty')

<div class="container">
    <div class="navigation" style="border-left:10px solid #eaddff;">
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
                
                Faculty Information
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
            <button href=# class="btn btn-success" data-toggle="modal" data-target="#addFacultyModal_{{ $i }}" id="view">Add</button>
            <div class="table">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Phone Number</td>
                            <td>Email</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faculties as $faculty)
                        @php
                            $i++;
                        @endphp
                            <tr>
                                <td>{{ $faculty->name }} {{ $faculty->surname }}</td>
                                <td>{{ $faculty->ph_no }}</td>
                                <td>{{ $faculty->email }}</td>
                                <td><button href=# class="btn btn-success" data-toggle="modal" data-target="#viewFacultyModal_{{ $i }}" id="view">View</button>
                                    @include('admin.modal.viewFaculty')</td>
                                <td><button href=# class="btn btn-success" data-toggle="modal" data-target="#addFacultyModal_{{ $i }}" id="view">Edit</button>
                                    @include('admin.modal.addFaculty')</td>
                                <td><a href="{{ route('admin.faculty.delete', ['id' => $faculty->faculty_id]) }}"><button>Delete</button></a></td>

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
