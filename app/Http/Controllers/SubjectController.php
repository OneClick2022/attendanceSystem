<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;

class SubjectController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'class_id' => 'required|unique:App\Models\Subjects,class_id|regex:/\d[a-zA-Z][a-zA-Z]\d\d/',
            'class_name' => 'required',
            'professor' => 'required|email'
        ]);

        $subject = new Subjects;
        $subject->class_id = $request->class_id;
        $subject->class_name = $request->class_name;
        $subject->professor = $request->professor;
        $subject->save();
        return redirect('admin/subject')->with('alert', 'Subject has been added');
    }

    public function update($id, Request $request){
        $request->validate([
            'class_name' => 'required',
            'professor' => 'required|not_in:0'
        ]);

        $subject = Subjects::find($id);
        $subject->class_name = $request->class_name;
        $subject->professor = $request->professor;
        $subject->save();
        return redirect('admin/subject')->with('alert', 'Subject has been updated');
    }

    public function delete($id){
        $subject = Subjects::find($id);
        if(!is_null($subject)){
            $subject->delete();
        }
        return redirect('admin/subject')->with('alert', 'Subject with code'.$id.'has been deleted');
    }
}
