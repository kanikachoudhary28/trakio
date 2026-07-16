<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 1. Batches List Page
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('login');
        }

        $batches = Batch::where('teacher_id', $teacher->id)->withCount('students')->get();

        return view('teacher.students.index', compact('batches'));
    }

   
    public function viewByBatch($batchId)
    {
        $selectedBatch = Batch::findOrFail($batchId);
        
        
        $students = Student::with('user')->where('batch_id', $batchId)->get();

        return view('teacher.students.view', compact('students', 'selectedBatch'));
    }
}