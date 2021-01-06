<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|alpha_num'
        ]);

        $data = array_merge($data, ['is_logged' => false]);

        if (Auth::attempt($data)) {

            $request->session()->regenerate();

            auth()->user()->update(['is_logged' => true]);

            return redirect()->intended();
        }

        return redirect()->back()->withErrors(['error' => 'Credentials are not matched']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|alpha',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|alpha_dash|min:8|confirmed',
            'password_confirmation' => 'same:password|required_if:password,""'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return redirect('/login')->with(['message' => 'Account Created Successfully']);
    }

    public function logout(Request $request)
    {
        auth()->user()->update(['is_logged' => false]);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('auth.login');
    }
}
