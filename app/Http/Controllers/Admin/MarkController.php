<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mark;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Auth;
use DB;

class MarkController extends Controller
{
    // 1. Marks Summary List Page (Admin/Teacher Dashboard)
    public function index()
    {
        
        $marksGroups = Mark::select('subject_id', 'assessment_type', 'max_marks', 'entered_by', DB::raw('count(*) as total_students'))
            ->with(['subject', 'teacher'])
            ->groupBy('subject_id', 'assessment_type', 'max_marks', 'entered_by')
            ->latest()
            ->get();

        return view('admin.marks.markslist', compact('marksGroups'));
    }

    // 2. Open Add Marks Form
    public function create()
    {
        $batches = Batch::all();
        $subjects = Subject::all();
        return view('admin.marks.marksform', compact('batches', 'subjects'));
    }

    // 3. Save Marks Entry Sheet
    public function store(Request $request)
    {
        $request->validate([
            'subject_id'      => 'required|exists:subjects,id',
            'assessment_type' => 'required|string',
            'max_marks'       => 'required|numeric|min:1',
            'marks'           => 'required|array',
        ]);

        $entered_by = Auth::id() ?? 1;

        foreach ($request->marks as $student_id => $obtained) {
           
            if ($obtained === null || $obtained === '') continue;

            Mark::updateOrCreate(
                [
                    'student_id'      => $student_id,
                    'subject_id'      => $request->subject_id,
                    'assessment_type' => $request->assessment_type,
                ],
                [
                    'marks_obtained' => $obtained,
                    'max_marks'      => $request->max_marks,
                    'entered_by'     => $entered_by
                ]
            );
        }

        return redirect()->route('marks.index')->with('success', 'Marks saved successfully!');
    }

    // 4. AJAX View Marks Details Modal Popup
    public function viewMarksSheet(Request $request)
    {
        $sheet = Mark::with('student.user')
            ->where('subject_id', $request->subject_id)
            ->where('assessment_type', $request->assessment_type)
            ->get();

        return response()->json($sheet);
    }
}
