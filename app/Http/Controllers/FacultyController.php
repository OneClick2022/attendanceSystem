<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', //
            'confirm_password' => 'same:password',
            'ph_no' => 'required',
            'image' => 'required'
        ]);
        $user = new User;
        $user->name = $request->name." ".$request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'faculty';
        $user->remember_token = str_random(10);
        $user->save();

        $filename = time().'-faculty_image.'.$request->file('image')->getClientOriginalExtension();
        $path = 'uploads/faculty/image';
        $store = $request->file('image')->storeAs('public/'.$path,$filename);
        $faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->surname = $request->surname;
        $faculty->email = $request->email;
        $faculty->ph_no = $request->ph_no;
        $faculty->image = $path."/".$filename;
        $faculty->save();


        return redirect('admin/faculty')->with('alert', 'faculty has been added');
    }
    public function update($id, Request $request){
        $faculty_id = Faculty::find($id);
        $user_id = User::where('email',$faculty_id->email)->pluck('id');
        $user = User::find($user_id[0]);
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:App\Models\User,email,'.strval($user_id[0]),
            'ph_no' => 'required'
        ]);
        
        $user->name = $request->name." ".$request->surname;
        $user->email = $request->email;
        $user->save();

        $faculty = Faculty::find($id);
        if(isset($request->image)){
            // unlink('storage/'.$faculty->image);
            $filename = time().'-faculty_image.'.$request->file('image')->getClientOriginalExtension();
            $path = 'uploads/faculty/image';
            $store = $request->file('image')->storeAs('public/'.$path,$filename);
            $faculty->image = $path."/".$filename;
        }
        $faculty->name = $request->name;
        $faculty->surname = $request->surname;
        $faculty->email = $request->email;
        $faculty->ph_no = $request->ph_no;
        $faculty->save();

        return redirect('admin/faculty')->with('alert', 'faculty has been updated');
    }

    public function delete($id){
        $faculty = Faculty::find($id);
        $user = User::where('email', $faculty->email)->get();
        $name = $user[0]->name;
        if(!is_null($faculty)){
            $faculty->delete();
            $user[0]->delete();
        }
        return redirect('admin/faculty')->with('alert', 'faculty '.$name.' has been deleted');
    }
}
