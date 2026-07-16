<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // 1. Profile Page View
    public function index()
    {
        $user = Auth::user();
       
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher profile not found.');
        }

        return view('teacher.profile.index', compact('user', 'teacher'));
    }

    // 2. Profile Update Logic
    public function update(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        // Validation Rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'designation' => 'required|string|max:100',
            'password' => 'nullable|string|min:6|confirmed', // Optional Password Change
        ]);

        // A. Users Table Update (Name, Email)
        $user->name = $request->name;
        $user->email = $request->email;
        
       
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        
        if ($teacher) {
            $teacher->phone = $request->phone;
            $teacher->designation = $request->designation;
            $teacher->save();
        }

        return redirect()->route('teacher.profile.index')->with('success', 'Profile updated successfully!');
    }
}
