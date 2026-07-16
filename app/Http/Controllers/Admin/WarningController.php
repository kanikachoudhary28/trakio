<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warning;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Auth;

class WarningController extends Controller
{
    // 1. Warnings List Dashboard
    public function index()
    {
        $warnings = Warning::with(['student.user', 'issuer'])->latest()->get();
        return view('admin.warnings.warninglist', compact('warnings'));
    }

    // 2. Open Create Warning Form
    public function create()
    {
        $batches = Batch::all();
        return view('admin.warnings.warningform', compact('batches'));
    }

    // 3. Save Warning Notice
    public function store(Request $request)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,id',
            'warning_type'   => 'required|string',
            'severity_level' => 'required|string',
            'reason'         => 'required|string',
            'issue_date'     => 'required|date',
        ]);

        Warning::create([
            'student_id'     => $request->student_id,
            'warning_type'   => $request->warning_type,
            'severity_level' => $request->severity_level,
            'reason'         => $request->reason,
            'issue_date'     => $request->issue_date,
            'issued_by'      => Auth::id() ?? 1,
            'status'         => 'active'
        ]);

        return redirect()->route('warnings.index')->with('success', 'Warning letter issued successfully!');
    }

    // 4. Update Status (e.g. Acknowledged or Resolved)
    public function updateStatus($id, $status)
    {
        $warning = Warning::findOrFail($id);
        $warning->update(['status' => $status]);

        return redirect()->back()->with('success', 'Warning status updated to ' . ucfirst($status));
    }
}
