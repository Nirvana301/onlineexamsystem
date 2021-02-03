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
use App\Models\Message;


/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $r){
        if($r->session()->get('id')==""){
            return view('login');
        }
        else{
            return redirect("/");
        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


    /**
     * @param Request $r
     * @param Courses $courses
     * @param Courses_Students $courses_Students
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function homepage_student(Request $r, Courses $courses, Courses_Students $courses_Students){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Student" ){
            return view('security.access_not_granted');

        }else{
            $users = DB::select('select * from users where id=?',[$r->session()->get('id')]);
            $id =$r->session()->get('id');
            $full_name=$r->session()->get('full_name');
            $coursesStu=Courses_Students::all()->where('student_id', auth()->user()->id);
            $courses =Courses::all();
            $capsule=array('full_name'=>$full_name,'coursesStu'=> $coursesStu,'courses'=>$courses);
            return view('panels.homepage_student',['users'=>$users])->with($capsule);

        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function homepage_teacher(Request $r){


        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Teacher"){
            return view('security.access_not_granted');

        }else{
            $users = DB::select('select * from users where id=?',[$r->session()->get('id')]);
            $id =$r->session()->get('id');
            $full_name=$r->session()->get('full_name');
            $courses =Courses::where(["given_by"=>$id])->get();
            $capsule=array('full_name'=>$full_name,'courses'=>$courses);
            return view('panels.homepage_teacher',['users'=>$users])->with($capsule);

        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function homepage_assistant(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Assistant"){
            return view('security.access_not_granted');

        }else{
            $users = DB::select('select * from users where id=?',[$r->session()->get('id')]);
            $full_name=$r->session()->get('full_name');
            $courses =Courses::where(["assistant_id"=>auth()->user()->id])->get();
            $capsule=array('full_name'=>$full_name,'courses'=>$courses);
            return view('panels.homepage_assistant',['users'=>$users])->with($capsule);

        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function homepage_admin(Request $r){
        if($r->session()->get('id')==""){
            return redirect('/login');

        }elseif($r->session()->get('role')!="Admin"){
            return view('security.access_not_granted');

        }else{
            $users = DB::select('select * from users where id=?',[$r->session()->get('id')]);
            $full_name=$r->session()->get('full_name');
            $capsule=array('full_name'=>$full_name);
            return view('panels.homepage_admin',['users'=>$users])->with($capsule);
        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homepage_ifLogin(Request $r){
        if($r->session()->get('id')==""){
            return view('welcome');
        }else{
            $role=$r->session()->get('role');
            $capsule=array('role'=>$role);
            return view('welcome_after_login')->with($capsule);
        }
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $r){
        $r->session()->forget('id');
        $r->session()->forget('full_name');
        return redirect('/');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show_details(Request $request, $id) {
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


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit_user(Request $request, $id) {
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


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete_user(Request $request, $id){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        elseif($request->session()->get('role')=="Admin"){

            DB::delete('delete from users where id=?',[$id]);
            return redirect()->back();


        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function arrange_profile_info(Request $request) {
        $id=$request->session()->get('id');
        $user_name = $request->input('user_name');
        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $locality = $request->input('locality');
        DB::update('update users set user_name=?,full_name=?,email=?,locality=? where id=?',[$user_name,$full_name,$email,$locality,$id]);

        return redirect()->back()->with(['success'=>'Personal Information Has Been Saved.']);
        }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function message(Request $request){
        if($request->session()->get('id')==""){
            return redirect('/login');
        }
        else{
            $users=DB::select('select * from users');
            $messages = DB::select('select * from messages order by id desc');
            $id=$request->session()->get('id');
            $user_name=$request->session()->get('user_name');
            $role=$request->session()->get('role');
            $capsule=array('id'=>$id, 'user_name'=>$user_name, 'role'=>$role);
            return view('message',['messages'=>$messages],['users'=>$users])->with($capsule);



        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send_message(Request $request, Message $message){

        $receiver_exist=DB::table('users')->where('user_name',$request->receiver)->first();
        if($receiver_exist!=null){
            $receiver_id=DB::table('users')->where('user_name', $request->receiver)->first()->id;

            $data=array_merge($request->all(),[
            'sender'=>Auth::user()->id,
            'receiver'=>$receiver_id,
            'message'=>$request->message,
            'subject'=>$request->subject]);

            $message=Message::create($data);
            return redirect()->back()->with(['success'=>'Message Sent Successfully.']);
        }else{
            return redirect()->back()->with(['error'=>'User Does Not Exist.']);
        }

    }



    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_message(Request $request, $id){
        DB::delete('delete from messages where id=?',[$id]);
        return redirect()->back();
    }

}


