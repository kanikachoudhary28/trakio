<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Batch;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * 1. Display all batches as cards for Subject Management
     */
    public function index()
    {
        $batches = Batch::withCount('subjects')->latest()->get();
        return view('admin.subjects.listsubject', compact('batches'));
    }

    /**
     * 2. Show the form for creating a new subject
     */
    public function create()
    {
        $batches = Batch::all(); 
        return view('admin.subjects.subjectform', compact('batches'));
    }

    /**
     * 3. Store a newly created subject in database
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects',
            'batch_id'     => 'required|exists:batches,id',
        ]);

        Subject::create([
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'batch_id'     => $request->batch_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }
  
    /**
     * 4. Show the form for editing the specified subject
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $batches = Batch::all(); 
        return view('admin.subjects.subjectedit', compact('subject', 'batches'));
    }

    /**
     * 5. Update the specified subject in database
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code,' . $subject->id,
            'batch_id'     => 'required|exists:batches,id',
        ]);

        $subject->update([
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'batch_id'     => $request->batch_id,
        ]);

     
        return redirect()->route('subjects.by_batch', $subject->batch_id)->with('success', 'Subject updated successfully!');
    }

    /**
     * 6. Remove the specified subject from database
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $batch_id = $subject->batch_id;
        $subject->delete();

       
        return redirect()->route('subjects.by_batch', $batch_id)->with('success', 'Subject deleted successfully!');
    }

    /**
     * 7. View subjects belongs to a specific batch
     */
    public function viewByBatch($batch_id)
    {
        $batch = Batch::findOrFail($batch_id);
        $subjects = Subject::where('batch_id', $batch_id)->latest()->get();
        
        
        return view('admin.subjects.batch_subjects_list', compact('batch', 'subjects'));
    }
}