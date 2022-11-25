@extends('layouts.main')
@push('title', 'Subject')
@section('main_content')
@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif


<a href="{{ url('/admin') }}">back</a>


@php
    use App\Models\User;
    $admin = User::where('email',Auth::user()->email)->get();
    use App\Models\Subjects;
    $subjects = Subjects::all();
    $i = -1;
@endphp
<link rel="stylesheet" type="text/css" href="/css/style.css">
<style>
    main button{
        background: #a9c8ff !important;
        border:#a9c8ff !important;
    }
    main button:hover{
         background: #849cc6 !important;
    }
    main .table table tbody tr:hover{
        color:var(--white) ;
        background: #DCE9FF !important;
    }
    main .table table tbody tr button:hover{
        background: #849cc6 !important;
    }
    main .table table tbody tr button{
        
        background: #a9c8ff !important;
        border:#a9c8ff !important;
    }

    main .table table tbody tr a button{
        color: #fff;
        background: #a9c8ff !important;
        border:#a9c8ff !important;
        padding-left:12px;
        padding-right:12px;
        padding-bottom: 6px;
        border-radius: 2px;
        padding-top:6px;
    }
    .container .navigation{

border-left:10px solid #DCE9FF;
}
.container .navigation ul li:hover
{
    
   background: #DCE9FF;
}
</style>
<div class="container">
    <div class="navigation" style="border-left:10px solid #DCE9FF;">
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
                
                Subject Information
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
            <button href=# class="btn btn-success" data-toggle="modal" data-target="#addSubjectModal_{{ $i }}" id="view">Add</button>
            @include('admin.modal.addSubject')
            <br>

            <div class="table">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Subject Id</td>
                            <td>Subject Name</td>
                            <td>Faculty Id</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subjects as $subject)
                        @php
                            $i++;
                        @endphp
                        <tr>
                                <td>{{ $subject->class_id }}</td>
                                <td>{{ $subject->class_name }}</td>
                                <td>{{ $subject->professor }}</td>
                                <td><button href=# class="btn btn-success" data-toggle="modal" data-target="#addSubjectModal_{{ $i }}" id="view">Edit</button>
                                    @include('admin.modal.addSubject')</td>
                                <td><a href="{{ route('admin.subject.delete', ['id' => $subject->class_id]) }}"><button>Delete</button></a></td>
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
