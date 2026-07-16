<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->get();
        return view('admin.teachers.listteacher', compact('teachers'));
    }

   
    public function create()
    {
        return view('admin.teachers.teacherform');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:15',
            'designation' => 'nullable|string|max:255',
        ]);

    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'is_first_login'=>1,
            'email_verfied_at'=>Carbon::now(),
        ]);

        
        Teacher::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'designation' => $request->designation,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher registered successfully!');
    }

public function edit($id)
{
   
    $teacher = Teacher::with('user')->findOrFail($id);
    return view('admin.teachers.teacheredit', compact('teacher'));
}


public function update(Request $request, $id)
{
    $teacher = Teacher::findOrFail($id);
    $user = $teacher->user;

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6', // Password optional
        'phone' => 'nullable|string|max:15',
        'designation' => 'nullable|string|max:255',
    ]);

  
    $userData = [
        'name' => $request->name,
        'email' => $request->email,
    ];
    if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->password);
    }
    $user->update($userData);

 
    $teacher->update([
        'phone' => $request->phone,
        'designation' => $request->designation,
    ]);

    return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
}


public function destroy($id)
{
    $teacher = Teacher::findOrFail($id);
    
   
    if($teacher->user) {
        $teacher->user->delete();
    } else {
        $teacher->delete();
    }

    return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
}

}