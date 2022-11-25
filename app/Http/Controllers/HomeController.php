<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function student(){
        return view('student');
    }

    public function subject(){
        return view('subject');
    }

    public function profile(){
        return view('profile');
    }

    public function upload(){
        return view('upload');
    }

    public function admin(){
        return view('admin.home');
    }

    public function studentAdmin(){
        return view('admin.student');
    }

    public function facultyAdmin(){
        return view('admin.faculty');
    }

    public function subjectAdmin(){
        return view('admin.subject');
    }

    public function timeTable(){
        return view('admin.timetable');
    }


}
