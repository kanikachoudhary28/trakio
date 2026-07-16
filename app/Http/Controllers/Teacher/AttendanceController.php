<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * 1. Attendance Form Page (Dropdown selection)
     */
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('login')->withErrors(['email' => 'Teacher profile not found.']);
        }
    
        $batches = Batch::whereIn('id', function($query) use ($teacher) {
            $query->select('batch_id')
                  ->from('subject_assignments')
                  ->where('teacher_id', $teacher->id);
        })->get();

        return view('teacher.attendance.attendanceform', compact('batches'));
    }

    /**
     * 2. Load Students list for marking attendance
     */
    public function manage(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'date' => 'required|date'
        ]);

        $batchId = $request->batch_id;
        $date = $request->date;

        $selectedBatch = Batch::findOrFail($batchId);
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();


        $assignment = DB::table('subject_assignments')
            ->where('batch_id', $batchId)
            ->where('teacher_id', $teacher->id)
            ->first();

       
        $subjectId = $assignment ? $assignment->subject_id : 1; 
        
        $students = Student::with('user')->where('batch_id', $batchId)->get();

        $existingAttendance = DB::table('attendances')
            ->where('subject_id', $subjectId) 
            ->where('date', $date)
            ->pluck('status', 'student_id') 
            ->toArray();

        return view('teacher.attendance.manage', compact('students', 'selectedBatch', 'date', 'existingAttendance', 'subjectId'));
    }

    /**
     * 3. Save or Update Attendance Engine
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_id'   => 'required|exists:batches,id',
            'date'       => 'required|date',
            'attendance' => 'required|array',
        ]);

        $batchId = $request->batch_id;
        $date = $request->date;
        $markedBy = Auth::id(); 

        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

       
        $assignment = DB::table('subject_assignments')
            ->where('batch_id', $batchId)
            ->where('teacher_id', $teacher->id)
            ->first();

        $subjectId = $assignment ? $assignment->subject_id : 1; 

       
        foreach ($request->attendance as $studentId => $status) {
            
            DB::table('attendances')->updateOrInsert(
                [
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'date'       => $date
                ],
                [
                    'status'     => $status,
                    'marked_by'  => $markedBy,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->route('teacher.attendance.select')->with('success', 'Attendance marked successfully with correct Subject mapping!');
    }
}