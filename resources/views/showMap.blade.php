<!-- Show Graph Data -->
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<div class="map_canvas">

            <canvas id="myChart" width="auto" height="100"></canvas>
</div>

@php
    use App\Models\Attendance;
    use App\Models\Lecture;
    use App\Models\Student;
    $subject = '3it04';
    $lectures = Attendance::where('present', 1)->get();
    $total_lectures = Attendance::join('lecture','lecture.lecture_id','=','present.lecture_id')->where('lecture.class_id',$subject)->get()->count();
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
        $size = 0;
        foreach($subjects as $subject_sub){
            if($student == $subject_sub){
                $size++;
                $percentage = ($size*100)/$total_lectures;
                $graph = array_replace($graph, [$student=>$percentage]);
            }
        }
    }
    for($i=0;$i<sizeOf($students);$i++){
        $students[$i] = "$students[$i]";
    }

@endphp

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($students) !!},
        datasets: [{
            label: '',
            data: {!! json_encode($graph) !!},
            backgroundColor: [
                'rgba(31, 58, 147, 1)'
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
