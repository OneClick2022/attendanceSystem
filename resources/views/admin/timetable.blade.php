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

@endsection
