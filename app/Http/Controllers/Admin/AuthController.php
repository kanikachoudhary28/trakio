<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'student') {
                return redirect()->route('student.dashboard'); 
            } elseif ($user->role == 'teacher') {
                return redirect()->route('teacher.dashboard');
            }
        }

        return view('auth.login');
    } 

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'student') {
                return redirect()->route('student.dashboard'); 
            } elseif ($user->role == 'teacher') {
               
                return redirect()->route('teacher.dashboard');
            }
            
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput($request->only('email'));
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}