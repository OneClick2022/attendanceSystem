<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class MainController extends Controller
{
    function index(){
        return view('login');
    }

    function checklogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|min:3',
            'user_type' => 'required'
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'user_type' => $request->get('user_type')
        );

        if(Auth::attempt($user_data)) {
            if(Auth::user()->user_type == "faculty")
                return redirect('/');
            else if(Auth::user()->user_type == "admin" )
                return redirect('/admin');
        }
        // else if(Auth::attempt($user_data)){
        //     if($request->get('user_type') == 'faculty')
        //         return redirect('/');
        //     else if($request->get('user_type') == 'admin')
        //         return redirect('/admin');
        // }
        else{
            return back()->with('error', 'Wrong login details');
        }
    }

    function successlogin(){
        if(Auth::user()->user_type == "faculty")
            return view('home');
        else
            return view('admin.home');
    }

    function logout(){
        Auth::logout();
        return redirect('main');
    }
}
