@extends('layouts.main')
@push('title', 'Camera')

@if (!isset(Auth::user()->email))
    <script>window.location = "/main";</script>
    @php
        die;
    @endphp
@endif
@section('main_content')

    <div class="container">
        <div id="my_camera">

        </div>
        <div id="results" style="visibility: hidden; position: absolute;">

        </div>

        <br>
        <button type="button" onclick="saveSnap();window.location.reload();">Save</button> <br>
        <a href="{{ url('/') }}">Back</a>
    </div>

    <script type="text/javascript" src="{{ url('camera_assets/webcam.min.js') }}"></script>
    <script type="text/javascript">
        function configure(){
            Webcam.set({
                width: 480,
                height: 360,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');
        }

        function saveSnap(){
            Webcam.snap(function(data_uri){
                document.getElementById('results').innerHTML = '<img id = "webcam" src = "'+data_uri+'">';
            });

            Webcam.reset();

            var base64image = document.getElementById("webcam").src;
            Webcam.upload(base64image, "{{ url('php/function.php') }}", function(code,text){
                alert('save successfully');
            });
        }
    </script>
@endsection
