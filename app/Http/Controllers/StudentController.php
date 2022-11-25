<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use App\Models\Subjects;

class StudentController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => 'required|unique:App\Models\Student,student_id',//\d\d[a-zA-Z][a-zA-Z]\d\d\d
            'batch' => 'required',
            'phone' => 'required|integer|max:9999999999|min:1000000000',
            'image' => 'required',
            'division' => 'required'
        ]);
        $fileName = time()."-student_image.".$request->file('image')->getClientOriginalExtension();
        $path = 'uploads/student/image';
        $store = $request->file('image')->storeAs('public/'.$path, $fileName);
        $student = new Student;
        $student->name = $request['first_name'];
        $student->surname = $request['last_name'];
        $student->ph_no = $request['phone'];
        $student->student_id = $request['student_id'];
        $student->division = $request['division'];
        $student->batch = $request['batch'];
        $student->image = $path."/".$fileName;
        $student->subjects = '2it01,2it11';
        $student->save();
        return redirect('admin/student')->with('alert', 'Student has been added');
    }

    public function update($id, Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'batch' => 'required',
            'phone' => 'required|integer|max:9999999999|min:1000000000',
            'division' => 'required'
        ]);

        $student = Student::find($id);
        if(isset($request->image)){
            unlink('storage/'.$student->image);
            $image = time()."_Service_image.".$request->file('image')->getClientOriginalExtension();
            $path = 'uploads/student/image';
            $store = $request->file('image')->storeAs('public/'.$path, $image);
            $student->image = $path."/".$image;
        }
        $student->name = $request['first_name'];
        $student->surname = $request['last_name'];
        $student->ph_no = $request['phone'];
        $student->division = $request['division'];
        $student->batch = $request['batch'];
        $student->subjects = '2it01,2it11';
        $student->save();
        return redirect('admin/student')->with('alert', 'Student has been updated');
    }

    public function editSub($id, Request $request){
        $subjects = Subjects::all();
        $student = Student::find($id);
        $addSubs = '';
        foreach($subjects as $subject){
            if(isset($_GET['subject_'.$subject->class_id])){
                $addSubs.= $subject->class_id.",";
            }
        }
        $student->subjects = $addSubs;
        $student->save();
        return redirect('admin/student')->with('alert', 'Subjects are editted');
    }

    public function delete($id){
        $student = Student::find($id);
        if(!is_null($student)){
            $student->delete();
        }
        return redirect('admin/student')->with('alert', 'Student with Id'.$id.'has been deleted');
    }

    public function studentInfo($id){
        return view('studentInfo', ['id'=>$id]);
    }
}
