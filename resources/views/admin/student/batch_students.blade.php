@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-3">
        <a href="{{ route('students.index') }}" class="btn btn-light btn-sm font-weight-bold text-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Semesters
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #4e73df, #224abe); color: white;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-weight-bold mb-1">{{ $batch->batch_name }}</h3>
                <p class="mb-0 opacity-75">Academic Session: {{ $batch->academic_year }} | Total Registered: {{ count($students) }} Students</p>
            </div>
            <i class="fas fa-users fa-3x opacity-25"></i>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-items-center">
                    <thead class="bg-light text-secondary font-weight-bold">
                        <tr>
                            <th class="pl-4">Roll Number</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary">{{ $student->roll_number }}</td>
                                <td class="font-weight-bold text-dark">{{ $student->user->name ?? 'N/A' }}</td>
                                <td>{{ $student->user->email ?? 'N/A' }}</td>
                                <td>{{ $student->phone ?? '—' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-info mr-1" title="Edit Student">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-2 d-block"></i>
                                    No students registered under this semester yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection