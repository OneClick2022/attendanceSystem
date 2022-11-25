<!DOCTYPE html>
<html>
<head>
  <title>Student Information</title>
  <script src="{{ url('https://code.jquery.com/jquery-1.12.4.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/github_contribution.js') }}"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link href="{{ url('css/github_contribution_graph.css') }}" media="all" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="/css/style3.css">
@if (!isset(Auth::user()->email))
  <script>window.location = "/main";</script>
  @php
      die;
  @endphp
@endif
@php
    use App\Models\Lecture;
    use App\Models\Student;
    use App\Models\Faculty;
 
$faculty = Faculty::where('email',Auth::user()->email)->get();
    $faculty = Faculty::where('email',Auth::user()->email)->get();
    $student_info = Student::find($id);;
    $student = $student_info->student_id;
    $student_subjects = explode(',',$student_info->subjects);
    array_pop($student_subjects);
    $faculty_subjects = Faculty::join('class','class.professor','=','faculty.email')->where('faculty.email',Auth::user()->email)->pluck('class.class_id')->toArray();
    $subjects = array();
    foreach($student_subjects as $stu_sub){
        foreach ($faculty_subjects as $fac_sub) {
            if(strcmp($stu_sub,$fac_sub)==0){
                array_push($subjects,$stu_sub);
            }
        }
    }
    if(isset($_GET['subject']))
        $subject = $_GET['subject'];
    else if(isset($subjects[0]))
        $subject = $subjects[0];
    else{
        echo "<script>alert('This is not your student');</script>";
        echo "<script>window.location.pathname = 'student';</script>";
        die;
    }
    
    $raw_data = Lecture::join('present','lecture.lecture_id','=','present.lecture_id')->where('lecture.class_id',$subject)->where('present.student_id',$student)->get()->toArray();
   
@endphp
<style>
.days li:nth-child(odd) {
  visibility: visible;
}
</style>

<body>
<div class="container">
        <div class="navigation" style="border-left:10px solid #c2e2cb">
            <ul>
                <li>
                    <a href="#">
                        
                       <img src="{{url('images\oneclick.png')}}">
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
                        <img alt="person" src="{{ url('storage/'.$faculty[0]->image )}}" width='55' height='55'/>        
                    </div>
                </label>               
                <input type="checkbox" id="touch"> 
                
                
                <ul class="slide">
                    <li><img alt="person" src="{{ url('storage/'.$faculty[0]->image )}}" width='55'/></li>
                    <li><h4> {{ $faculty[0]->name }} {{ $faculty[0]->surname }} </h4></li>
                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                    <li><a href="{{ url('/main/logout') }}">Logout</a></li>
                </ul>

            </div>
        </header>

    <main>

    <div class="col-xs-12-col-sm-12-col-md-12">
        <div class="form-group">
            <img src="{{ url('storage/'.$student_info->image) }}" width="100"/>
        </div>
      </div>
    <br>
<table class="table">
<tbody>
<tr>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
      <td>
          <strong>{{ __('Name') }}:</strong>
          </td>
          <td>
          {{ $student_info->name }} {{ $student_info->surname }}
          </td>
    </div>
  </div>
</tr>
<tr>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <td>
        <strong>{{ __('Division') }}:</strong>
        </td>
          <td>
        {{ $student_info->division }}
        </td>
    </div>
  </div>
  </tr>
  <tr>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <td>
        <strong>{{ __('Batch') }}:</strong>
    </td>
    <td>
        {{ $student_info->batch }}
    </td>
    </div>
  </div>
  </tr>
  <tr>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <td>
        <strong>{{ __('Phone Number') }}:</strong>
    </td>
    <td>
        {{ $student_info->ph_no }}
    </td>
    </div>
  </div>
  </tr>
  </tbody>
  </table>
<br>
    @foreach($subjects as $subject_temp)
    <button onclick='changeId("{{ $subject_temp }}")'>{{ $subject_temp }}</button>
    @endforeach
<br>
   <div id="github_chart_3"></div>
   </main>
   </div>
   </div>
</body>

<script type="text/javascript">

    function changeId(subject){
        window.location.replace('?subject='+subject);
    }

    function randomInt(min,max)
    {
      return Math.floor(Math.random()*(max-min+1)+min);
    }

    function getRandomTimeStamps( min, max, fromDate, isObject ){ //
      var return_list = [];
      var unique_data = {};
      var raw_data = {!! json_encode($raw_data) !!}
      var entries = raw_data.length
    for(let i = 0; i<entries; i++)
    {
        let entry = new Date(raw_data[i].lecture_date).toString();
        if(unique_data[entry] === 2) continue;

        unique_data[entry] = raw_data[i].present+1;
    }
    for (var key in unique_data) {
        let temp = {
            timestamp : new Date(key),
            count : unique_data[key],
        }
        return_list.push(temp);
    }

    return return_list;
    }


    $(document).ready(function(){

        var start_from_2022 = new Date(2022,00,01,0,0,0);

        $('#github_chart_3').github_graph( {
          start_date: start_from_2022,
          data: getRandomTimeStamps(5,100, start_from_2022, true), //
          texts: ['category','categories'],
          border:{
            radius: 10,
            hover_color: "red"
          },

          colors:[
            {count:0,color:'gray'},
            {count:1,color:'red'},
            {count:2,color:'green'},
          ],
          click: function(date, count) {
            if(count==0) alert("It is not a working day.");
            else{
                if(confirm("Are you sure you want to change the presence status?"))
                {
                 //   console.log('{{$subject}}');
                    window.location.replace("/student/changePresence/"+date+","+count+",{{ $id }},{{ $subject }}");
                }
            }
          },
        });
    });
  </script>

</head>

<style type="text/css">
  .seperate{
    height: 20px;
  }
  body{
    padding: 50px;
  }
</style>

</html>