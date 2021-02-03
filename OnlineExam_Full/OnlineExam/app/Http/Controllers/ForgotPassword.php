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

/**
 * Class ForgotPassword
 * @package App\Http\Controllers
 */
class ForgotPassword extends Controller
{

    //Displays forgot_password HTML page which is in "security" folder.
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forgot_password(Request $request){
        if($request->session()->get('id')!=""){
            return redirect('/');
        }else{
            return view('security.forgot_password');
        }

    }

    /*Checks whether entered email exists in database or not. If exists, prints success message
      about sending password reset link. If does not exist, prints error message.*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


    //Sends link to user's email to reset password.

    /**
     * @param $user
     * @param $code
     */
    public function sendEmail($user, $code){
        Mail::send(
            'email.reset_mail',
            ['user'=>$user,'code'=>$code],
            function($message) use ($user){
                $message->subject("Reset your password.")->to("$user->email");
            }
        );
    }


    /*Checks the token and email and redirects user to reset_password HTML page which is in "security" folder.
      If token is invalid, returns bad_request HTML page. If the password reset process done before and
      user tried to do this process again with same password reset link, this method returns
      request_done_before HTML page.*/
    /**
     * @param $email
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function reset($email, $code){
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


    /*Performs the password change process by checking new password and checking confirmation of it.
      It is provided that the password rules are followed by user. If rules does not obeyed and
      password and its confirmation does not match, this method returns error message. Otherwise,
      returns success message and redirects user to login page.
      */
    /**
     * @param Request $request
     * @param $email
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reset_password(Request $request, $email, $code){
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
