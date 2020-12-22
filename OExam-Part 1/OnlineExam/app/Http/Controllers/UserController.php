<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login($value=''){
        return view('login');
    }


    public function check_user(Request $r){
        $user_name=$r->user_name;
        $password=$r->password;

        if(Auth::attempt(['user_name'=>$user_name,'password'=>$password])){
            
            $session=DB::table('users')->where('user_name',$user_name)->get();

            $r->session()->put('id',$session[0]->id);
            $r->session()->put('full_name',$session[0]->full_name);
            $r->session()->put('role',$session[0]->role);

            $session=DB::table('users')->select('role')->get();
            
            if($r->session()->get('role')=="Student"){
                return redirect('/homepage_student');
            }elseif ($r->session()->get('role')=="Teacher") {
                return redirect('/homepage_teacher');
            }elseif ($r->session()->get('role')=="Admin") {
                return redirect('/homepage_admin');
            }elseif ($r->session()->get('role')=="Assistant") {
                return redirect('/homepage_assistant');
            }
        }else{
            return redirect('/login')->with('msg','Incorrect Username or Password.');
        }

    }


    public function homepage_student(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Student"){
            return view('security.access_not_granted');

        }else{
            $full_name=$r->session()->get('full_name');
            $capsule=array('full_name'=>$full_name);
            return view('panels.homepage_student')->with($capsule);
        
        }
    }


    public function homepage_teacher(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Teacher"){
            return view('security.access_not_granted');

        }else{
            $full_name=$r->session()->get('full_name');
            $capsule=array('full_name'=>$full_name);
            return view('panels.homepage_teacher')->with($capsule);
            
        }
    }


    public function homepage_assistant(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Assistant"){
            return view('security.access_not_granted');

        }else{
            $full_name=$r->session()->get('full_name');
            $capsule=array('full_name'=>$full_name);
            return view('panels.homepage_assistant')->with($capsule);
            
        }
    }


    public function homepage_admin(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Admin"){
            return view('security.access_not_granted');

        }else{
            $full_name=$r->session()->get('full_name');
            $capsule=array('full_name'=>$full_name);
            return view('panels.homepage_admin')->with($capsule);
            
        }
    }


    public function logout(Request $r){
        $r->session()->forget('id');
        $r->session()->forget('full_name');

        return redirect('/login');
    }


    public function register(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
            return view('adminFunctions.add_user'); 
        }
        else{
            return view('security.access_not_granted');
        }
         
    } 
    

    public function registerUser(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
            $this->validate(request(), [
            'password'=>'required|min:7|max:16',
            'confirm_password'=>'required|same:password'
            ]);

            DB::table("users")->insert([
                'id'=>$request->id,
                'user_name'=>$request->user_name,
                'password'=>Hash::make($request->password),
                'full_name'=>$request->full_name,
                'email'=>$request->email,
                'locality'=>$request->locality,
                'department'=>$request->department,
                'role'=>$request->role
                ]);

            return redirect()->back()->with(['success'=>'User Has Been Added Successfully.']);
        }else{
            return view('security.access_not_granted');
        }
   
    }


    public function show_users(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
            $users = DB::select('select * from users');
        return view('adminFunctions.manage_user',['users'=>$users]);
        }
        else{
            return view('security.access_not_granted');
        }
        
    }


    public function show_details(Request $request,$id) {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
            $users = DB::select('select * from users where id = ?',[$id]);
        return view('adminFunctions.update_user',['users'=>$users]);
        }
        else{
            return view('security.access_not_granted');
        }
        
    }


    public function edit_user(Request $request,$id) {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
        $user_name = $request->input('user_name');
        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $locality = $request->input('locality');
        $department = $request->input('department');
        $role = $request->input('role');
        DB::update('update users set user_name = ?,full_name=?,email=?,locality=?,department=?,role=? where id = ?',[$user_name,$full_name,$email,$locality,$department,$role,$id]);

        return redirect()->back()->with(['success'=>'User Has Been Updated Successfully.']);
        }
        else{
            return view('security.access_not_granted');
        }
        
    }


    public function delete_user(Request $request, $id){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){
            
            DB::delete('delete from users where id=?',[$id]);
            return redirect()->back();
            
            
        }
    }
}
