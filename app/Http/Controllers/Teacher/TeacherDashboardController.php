<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            abort(403, 'Your User account exists, but no corresponding Teacher profile was found in the database. Please contact the Admin.');
        }

        $batches = Batch::where('teacher_id', $teacher->id)->get();
        $batchIds = $batches->pluck('id')->toArray();
        $totalStudents = Student::whereIn('batch_id', $batchIds)->count();
        $assignedBatchesCount = $batches->count();

        $atRiskCount = 0;
        $allStudents = Student::whereIn('batch_id', $batchIds)->get();

        foreach ($allStudents as $student) {
            $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
            $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
            $attendancePercentage = $totalDays > 0 ? ($presentDays / $totalDays) * 100 : 100;

            $marksData = DB::table('marks')->where('student_id', $student->id)->get();
            $marksPercentage = null;
            
            if ($marksData->count() > 0) {
                $totalObtained = $marksData->sum('marks_obtained');
                $totalMax = $marksData->sum('max_marks');
                $marksPercentage = $totalMax > 0 ? ($totalObtained / $totalMax) * 100 : 0;
            }

            if ($attendancePercentage < 75 || ($marksPercentage !== null && $marksPercentage < 40)) {
                $atRiskCount++;
            }
        }
        
       
        $totalExpectedEntries = $assignedBatchesCount * 10; 
        $actualEntries = DB::table('marks')->whereIn('subject_id', $batchIds)->count();
        $pendingMarks = $totalExpectedEntries > $actualEntries ? ($totalExpectedEntries - $actualEntries) : 0;

        return view('teacher.dashboard', compact(
            'batches', 
            'totalStudents', 
            'assignedBatchesCount', 
            'atRiskCount', 
            'pendingMarks'
        ));
    }
}