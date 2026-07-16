<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Auth;
use DB;

class AttendanceController extends Controller
{
    /**
     * 1. Display all batches as cards for Attendance Monitoring
     */
    public function index()
    {
        
        $batches = Batch::latest()->get();
        return view('admin.attendance.attendancelist', compact('batches'));
    }
    public function adminIndex()
    {
        return $this->index();
    }

    /**
     * 2. AJAX View Sheet Modal Popup Data
     */
    public function adminViewSheet(Request $request)
    {
        $sheet = Attendance::with('student.user')
            ->where('date', $request->date)
            ->where('subject_id', $request->subject_id)
            ->get();

        return response()->json($sheet);
    }

    /**
     * 3. Open Attendance Form
     */
    public function teacherCreate()
    {
        $batches = Batch::all();
        return view('admin.attendance.attendanceform', compact('batches'));
    }

    /**
     * 4. Save/Update Attendance Sheet
     */
    public function teacherStore(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date'       => 'required|date|before_or_equal:today',
            'status'     => 'required|array',
        ]);

        $marked_by = Auth::id() ?? 1;

        foreach ($request->status as $student_id => $status_value) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'subject_id' => $request->subject_id,
                    'date'       => $request->date
                ],
                [
                    'status'    => strtolower($status_value),
                    'marked_by' => $marked_by
                ]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully!');
    }

    /**
     * 5. AJAX Get Students For Form
     */
    public function getStudents($batch_id)
    {
        $students = Student::with('user:id,name')->where('batch_id', $batch_id)->get();
        return response()->json($students);
    }

    /**
     * 6. View attendance logs for a specific batch (With GroupBy Fix)
     */
    public function viewByBatch(Request $request, $batch_id)
    {
        $batch = \App\Models\Batch::findOrFail($batch_id);
        $subjects = \App\Models\Subject::where('batch_id', $batch_id)->get();
        
        // Eloquent query building with raw selections to aggregate student logs
        $query = \App\Models\Attendance::select(
                'date', 
                'subject_id', 
                'marked_by',
                \DB::raw('count(student_id) as total_strength'),
                \DB::raw("SUM(CASE WHEN LOWER(status) = 'present' THEN 1 ELSE 0 END) as total_present")
            )
            ->whereHas('subject', function($q) use ($batch_id) {
                $q->where('batch_id', $batch_id);
            });

        // Apply Subject Filter
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        // Apply Date Filter
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date); 
        }

    
        $logs = $query->with(['subject', 'marker'])
            ->groupBy('date', 'subject_id', 'marked_by')
            ->latest('date')
            ->get();

        return view('admin.attendance.batch_logs', compact('batch', 'subjects', 'logs'));
    }

    /**
     * 7. Show detailed student attendance sheet for a specific date and subject
     */
    public function showSheet(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $date = $request->date;
        $subject = Subject::with('batch')->findOrFail($request->subject_id);

        $attendanceRecords = Attendance::with(['student.user'])
            ->where('subject_id', $request->subject_id)
            ->whereDate('date', $date)
            ->get();

        // Count for stats summary
        $totalStudents = $attendanceRecords->count();
        $presentCount = $attendanceRecords->where('status', 'present')->count();
        $absentCount = $totalStudents - $presentCount;

        return view('admin.attendance.show_sheet', compact('attendanceRecords', 'date', 'subject', 'totalStudents', 'presentCount', 'absentCount'));
    }
}