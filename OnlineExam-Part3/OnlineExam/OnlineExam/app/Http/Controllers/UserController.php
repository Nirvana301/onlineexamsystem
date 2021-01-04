<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;
use Auth;
use Image;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Courses;
use App\Models\Courses_Students;



class UserController extends Controller
{
    public function login(Request $r){
        if($r->session()->get('id')==""){
            return view('login');
        }
        else{
            return redirect("/");
        }
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
            $id =$r->session()->get('id');
            $full_name=$r->session()->get('full_name');
            $courseid =Courses_Students::where(["student_id"=>$id])->get("course_id")->count();
            $coursesStu=Courses::where(["id"=> $courseid])->get();
            $capsule=array('full_name'=>$full_name,'coursesStu'=> $coursesStu);
            return view('panels.homepage_student')->with($capsule);
        
        }
    }


    public function homepage_teacher(Request $r){
         

        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Teacher"){
            return view('security.access_not_granted');

        }else{
            $id =$r->session()->get('id');
            $full_name=$r->session()->get('full_name');
            $courses =Courses::where(["given_by"=>$id])->get();
            $capsule=array('full_name'=>$full_name,'courses'=>$courses);
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


    public function homepage_ifLogin(Request $r){
        if($r->session()->get('id')==""){
            return view('welcome');
        }else{
            $role=$r->session()->get('role');
            $capsule=array('role'=>$role);
            return view('welcome_after_login')->with($capsule);
        }
    }


    public function logout(Request $r){
        $r->session()->forget('id');
        $r->session()->forget('full_name'); 
        return redirect('/');
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
        DB::update('update users set user_name=?,full_name=?,email=?,locality=?,department=?,role=? where id=?',[$user_name,$full_name,$email,$locality,$department,$role,$id]);

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


    public function show_profile(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        else{         
            $role=$request->session()->get('role');
            $full_name=$request->session()->get('full_name');
            $capsule=array('role'=>$role);
            $capsule3=array('full_name'=>$full_name);
        return view('user_profile', array('user'=>Auth::user()))->with($capsule)->with($capsule3);
        }
    }


    public function arrange_profile_photo(Request $request){ 
        $role=$request->session()->get('role');
        $full_name=$request->session()->get('full_name');
        $capsule=array('role'=>$role);
        $capsule3=array('full_name'=>$full_name); 

        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename=time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/profile_photos/' . $filename));
            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
          }
          
          return view('user_profile', array('user'=>Auth::user()))->with($capsule)->with($capsule3);
    }


    public function show_profile_info(Request $request) {
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        else{
            $role=$request->session()->get('role');
            $capsule=array('role'=>$role);
            $id=$request->session()->get('id');
            $users = DB::select('select * from users where id = ?',[$id]);
        return view('personal_information',['users'=>$users])->with($capsule);
        }
        
    }


    public function arrange_profile_info(Request $request) {
        $id=$request->session()->get('id');
        $user_name = $request->input('user_name');
        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $locality = $request->input('locality');
        DB::update('update users set user_name=?,full_name=?,email=?,locality=? where id=?',[$user_name,$full_name,$email,$locality,$id]);

        return redirect()->back()->with(['success'=>'Personal Information Has Been Saved.']);
        }
        

    public function change_password_view(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        else{
            $role=$request->session()->get('role');
            $capsule=array('role'=>$role);
            return view('security.change_password')->with($capsule);
        }

    }


    public function change_password(Request $request){
        $request->validate([
            'old_password'=>'required|min:7|max:45',
            'new_password'=>'required|min:7|max:45',
            'confirm_new_password'=>'required|same:new_password'
        ]);

        $current_user=auth()->user();

        if(Hash::check($request->old_password,$current_user->password)){
            $current_user->update([
                'password'=>Hash::make($request->new_password)
            ]);
            return redirect()->back()->with('success', 'Password Has Been Changed Successfully.');
        }else{
            return redirect()->back()->with('error', 'Old Password Does Not Matched.');
        }

    }
    
}
