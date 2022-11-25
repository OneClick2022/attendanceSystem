<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Upload;
use App\Models\Lecture;
use Illuminate\Support\Str;
use App\Models\Student;

class GraphController extends Controller
{
    public function show(){
        $label = ['Shirts', 'T-shirt', 'Pants', 'Coat', 'Kurta', 'Pajama'];
        $price = ['10','5','100','90','50','30'];
        return view("showMap",['labels'=>$label, 'prices'=>$price]);
    }

    public function change($date){
        $date = explode(',',$date);
        $present_ids = Attendance::join('lecture','lecture.lecture_id','=','present.lecture_id')->where('lecture.lecture_date', $date[0])->where('present.student_id',$date[2])->pluck('present.present_id')->toArray();
        foreach($present_ids as $present_id){
            $present = Attendance::find($present_id);
            if($date[1] == 1) $present->present = 1;
            else $present->present = 0;
            $present->save();
        }
        return redirect(route('student.studentInfo',['id'=>$date[2]]))->with('alert','presence status changed');
    }

    public function uploadAdd(Request $request){
        set_time_limit(300);
        $request->validate([
            'image' => 'required',
            'date' => 'required',
            'subject' => 'required|not_in:select a subject'
        ]);


        //save lecture
        $lecture = new Lecture;
        $uuid = Str::uuid()->toString();
        $lecture->lecture_id = $uuid;
        $lecture->class_id = $request->subject;
        $lecture->lecture_date = $request->date;
        $lecture->save();

        //python integration

        $student_subjects = Student::all()->pluck('subjects')->toArray();
        $students = Student::all()->pluck('student_id')->toArray();
        $students = array_combine($students,$student_subjects);
        foreach($students as $student){
            $student_key = array_search($student,$students);
            $student = explode(',',$student);
            foreach($student as $sub){
                if($sub != $request->subject){
                    $key = array_search($sub,$student);
                    unset($student[$key]);
                    // p($key);
                }
            }
            $student = implode($student);
            $students[$student_key] = $student;
        }
        foreach (array_keys($students, '') as $key) {
            unset($students[$key]);
        }
        $students = array_keys($students);

        $result = '';
        //save upload
        foreach($request->image as $image){
            $fileName = time()."-upload_image.".$image->getClientOriginalExtension();
            $filePath = 'uploads/upload/image';
            $save = $image->storeAs('public/'.$filePath, $fileName);
            $upload = new Upload;
            $upload->image = $filePath."/".$fileName;
            $upload->save();

            $public_path = public_path("python\\");
            $result .= shell_exec("python ".
            $public_path."recognize.py --embedding_model ".
            $public_path."openface_nn4.small2.v1.t7  --recognizer ".
            $public_path."output\\recognizer.pickle --le ".
            $public_path."output\\le.pickle --image ".
            public_path('storage\\'.$filePath).'\\'.$fileName);// . escapeshellarg()
            // p("python ".
            // $public_path."recognize.py --embedding_model ".
            // $public_path."openface_nn4.small2.v1.t7    --recognizer ".
            // $public_path."output\\recognizer.pickle --le ".
            // $public_path."output\\le.pickle --image ".
            // public_path('storage\\'.$filePath).'\\'.$fileName);
            sleep(1);
        }
        // $result = shell_exec('python '.$app_path.'pythonTest.py');
        // echo $result;

        $result = explode(",",$result);
        array_pop($result);
        $results = array_unique($result);

        $students = array_diff($students, $results);
        //attendance
        foreach (array_keys($results, '0') as $key) {
            // p($key);
            unset($results[$key]);
        }
        $return_msg_pos = '';
        $return_msg_neg = '';
        foreach($results as $result){
            $attendance = new Attendance;
            $attendance->lecture_id = $lecture->lecture_id;
            $attendance->present = '1';
            $attendance->student_id = $result;
            $attendance->save();
            $return_msg_pos.=$result.",";
        }
        foreach($students as $student){
            $attendance = new Attendance;
            $attendance->lecture_id = $lecture->lecture_id;
            $attendance->present = '0';
            $attendance->student_id = $student;
            $attendance->save();
            $return_msg_neg.=$student.",";
        }

        return redirect('upload')->with('alert', $return_msg_pos." are present ".$return_msg_neg);

        // die;
    }
}
