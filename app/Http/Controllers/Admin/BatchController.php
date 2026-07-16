<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * 1. Display all batches on Admin Dashboard
     */
    public function index()
    {
        $batches = Batch::latest()->get();
        return view('admin.batches.batchlist', compact('batches'));
    }

    /**
     * 2. Show the form for creating a new batch
     */
    public function create()
    {
        return view('admin.batches.batchform');
    }

    /**
     * 3. Store a newly created batch in database
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_name'    => 'required|string|max:255|unique:batches,batch_name',
            'academic_year' => 'required|string|max:255',
        ]);

        Batch::create([
            'batch_name'    => $request->batch_name,
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('batches.index')->with('success', 'New Batch created successfully!');
    }

    /**
     * 4. Show the form for editing the specified batch
     */
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        return view('admin.batches.batchedit', compact('batch'));
    }

    /**
     * 5. Update the specified batch in database
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'batch_name'    => 'required|string|max:255|unique:batches,batch_name,' . $batch->id,
            'academic_year' => 'required|string|max:255',
        ]);

        $batch->update([
            'batch_name'    => $request->batch_name,
            'academic_year' => $request->academic_year,
        ]);

        
        return redirect()->route('batches.index')->with('success', 'Batch details updated successfully!');
    }

    /**
     * 6. Remove the specified batch from database
     */
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

     
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully!');
    }
}