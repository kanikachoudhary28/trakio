<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        if (!$teacher) return redirect()->route('login');

        $batches = Batch::where('teacher_id', $teacher->id)->get();
        return view('teacher.performance.index', compact('batches'));
    }

    public function viewBatch($batchId)
    {
        $selectedBatch = Batch::findOrFail($batchId);
        $students = Student::with('user')->where('batch_id', $batchId)->get();

        foreach ($students as $student) {
            // 1. Calculate Attendance Percentage
            $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
            $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
            
            $student->attendance_percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 100;

            // 2. Calculate Average Marks Percentage
            $marksData = DB::table('marks')->where('student_id', $student->id)->get();
            if ($marksData->count() > 0) {
                $totalObtained = $marksData->sum('marks_obtained');
                $totalMax = $marksData->sum('max_marks');
                $student->marks_percentage = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : 0;
            } else {
                $student->marks_percentage = null; // No exams given yet
            }
        }

        return view('teacher.performance.view', compact('students', 'selectedBatch'));
    }
}
