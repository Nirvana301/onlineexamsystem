<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;
use Auth;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Hash;
use Mail;
use Reminder;

class ForgotPassword extends Controller
{
    public function forgot_password($value=''){
        return view('security.forgot_password');
    }


    public function check_email(Request $request){
        $user=DB::table('users')->whereEmail($request->email)->first();

        if($user==null){
            return redirect()->back()->with(['error'=>'Email Not Exists.']);

        }

        $user=Sentinel::findById($user->id);
        $reminder=Reminder::create($user);
        $this->sendEmail($user,$reminder->code);

        return redirect()->back()->with(['success'=>'Password reset link has been sent to your email.']);
    }


    public function sendEmail($user,$code){
        Mail::send(
            'email.reset_mail',
            ['user'=>$user,'code'=>$code],
            function($message) use ($user){
                $message->subject("Reset your password.")->to("$user->email");
            }
        );
    }


    public function reset($email,$code){
        $user=DB::table('users')->whereEmail($email)->first();

        if($user==null){
            echo 'Email Not Exists.';
        }

        $user=Sentinel::findById($user->id);
        if(Reminder::exists($user)){
            if(Reminder::exists($user,$code)){
                return view('security.reset_password')->with(['user'=>$user,'code'=>$code]);
            }else{
                return view('security.bad_request');
            }
        }else{
            return view('security.request_done_before');  
        } 
    }


    public function reset_password(Request $request,$email,$code){

        $request->validate([
            'password'=>'required|min:7|max:16',
            'confirm_password'=>'required|same:password'
        ]);

        $user=DB::table('users')->whereEmail($email)->first();

        if($user==null){
            echo 'Email Not Exists.';
        }

        $user=Sentinel::findById($user->id);

        if(Reminder::exists($user)){
            if(Reminder::exists($user,$code)){
                $user->fill([
                    'password'=>Hash::make($request->password)
                ])->save();
                DB::table('reminders')->where('code',$code)->delete();
                return redirect('/login')->with('success','Password Changed Successfully.');   
            }else{
                return view('security.bad_request');
            }
        }else{
            return view('security.request_done_before'); 
        }
    }
}