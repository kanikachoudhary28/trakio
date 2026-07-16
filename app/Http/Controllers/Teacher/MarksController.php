<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{
    // 1. Index Method (Dropdown page)
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        if (!$teacher) { return redirect()->route('login'); }

        $batches = Batch::where('teacher_id', $teacher->id)->get();
        return view('teacher.marks.index', compact('batches'));
    }

    // 2. Manage Method 
    public function manage(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id', 
            'assessment_type' => 'required|string',
            'max_marks' => 'required|numeric|min:1'
        ]);

        $batchId = $request->batch_id;
        $subjectId = $request->subject_id;
        $assessmentType = $request->assessment_type;
        $maxMarks = $request->max_marks;

        $selectedBatch = Batch::findOrFail($batchId);
        $selectedSubject = \App\Models\Subject::findOrFail($subjectId); 
        $students = Student::with('user')->where('batch_id', $batchId)->get();

     
        $existingMarks = DB::table('marks')
            ->where('subject_id', $subjectId)
            ->where('assessment_type', $assessmentType)
            ->pluck('marks_obtained', 'student_id')
            ->toArray();

        return view('teacher.marks.manage', compact('students', 'selectedBatch', 'selectedSubject', 'assessmentType', 'maxMarks', 'existingMarks'));
    }

    // 3. Store Method 
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id', 
            'assessment_type' => 'required|string',
            'max_marks' => 'required|numeric',
            'marks' => 'required|array'
        ]);

        $subjectId = $request->subject_id;
        $assessmentType = $request->assessment_type;
        $maxMarks = $request->max_marks;
        $enteredBy = Auth::id();

        foreach ($request->marks as $studentId => $marksObtained) {
            $marksObtained = $marksObtained ?? 0;

            DB::table('marks')->updateOrInsert(
                [
                    'student_id' => $studentId,
                    'subject_id' => $subjectId, 
                    'assessment_type' => $assessmentType
                ],
                [
                    'marks_obtained' => $marksObtained,
                    'max_marks' => $maxMarks,
                    'entered_by' => $enteredBy,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        return redirect()->route('teacher.marks.select')->with('success', 'Marks updated successfully!');
    }
}
