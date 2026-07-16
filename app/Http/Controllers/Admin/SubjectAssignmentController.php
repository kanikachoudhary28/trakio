<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\SubjectAssignment;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = SubjectAssignment::with(['teacher.user', 'batch', 'subject'])->latest()->get();
        // ✅ Aapka actual view listassignment hai toh wahi rakha hai
        return view('admin.assignments.listassignment', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        $batches = Batch::all();
        return view('admin.assignments.assignmentform', compact('teachers', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'batch_id'   => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $exists = SubjectAssignment::where('batch_id', $request->batch_id)
                                    ->where('subject_id', $request->subject_id)
                                    ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['subject_id' => 'This subject is already assigned to this batch.']);
        }

        SubjectAssignment::create($request->all());
    
        return redirect()->route('assignments.index')->with('success', 'Subject assigned to teacher successfully!');
    }

    /**
    
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assignment = SubjectAssignment::findOrFail($id);
        $teachers = Teacher::with('user')->get();
        $batches = Batch::all();
        
    
        $subjects = Subject::where('batch_id', $assignment->batch_id)->get();

        return view('admin.assignments.assignmentedit', compact('assignment', 'teachers', 'batches', 'subjects'));
    }

    /**
    
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $assignment = SubjectAssignment::findOrFail($id);

        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'batch_id'   => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Validation check for duplicates excluding current assignment
        $exists = SubjectAssignment::where('batch_id', $request->batch_id)
                                    ->where('subject_id', $request->subject_id)
                                    ->where('id', '!=', $id)
                                    ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['subject_id' => 'This subject is already assigned to this batch.']);
        }

        $assignment->update($request->all());

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully!');
    }

    // --- JAVASCRIPT AJAX METHOD ---
    public function getSubjects($batch_id)
    {
        $subjects = Subject::where('batch_id', $batch_id)->get(['id', 'subject_name', 'subject_code']);
        return response()->json($subjects);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignment = SubjectAssignment::findOrFail($id);
        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Assignment removed successfully!');
    }
}