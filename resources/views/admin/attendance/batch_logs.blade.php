@extends('layouts.admin')

@section('content')
<div class="container py-4">
    
    <!-- Top Section -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-light border mb-2"><i class="fas fa-arrow-left me-1"></i> Back to Batches</a>
            <h3 class="text-dark fw-bold mb-0">Attendance Logs: {{ $batch->batch_name }}</h3>
        </div>
    </div>

    <!--Dynamic Filter Bar Card -->
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-light">
        <div class="card-body p-3">
            <form action="{{ url()->current() }}" method="GET" class="row g-3 align-items-end">
                <!-- Subject Filter -->
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold text-secondary">Filter by Subject</label>
                    <select name="subject_id" class="form-select bg-white">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subj)
                            <option value="{{ $subj->id }}" {{ request('subject_id') == $subj->id ? 'selected' : '' }}>
                                {{ $subj->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Date Filter -->
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold text-secondary">Filter by Date</label>
                    <input type="date" name="date" class="form-control bg-white" value="{{ request('date') }}">
                </div>
                <!-- Action Buttons -->
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1"><i class="fas fa-filter me-1"></i> Apply Filter</button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i></a>
                </div>
            </form>
        </div>
    </div>

    <!-- Filtered Data Output Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small fw-bold text-secondary text-uppercase">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Subject / Class</th>
                        <th>Marked By (Faculty)</th>
                        <th>Status / Strength</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
         <tbody>
    @forelse($logs as $log)
        <tr>
            <!-- Date -->
            <td class="ps-4 fw-semibold text-dark">
                {{ \Carbon\Carbon::parse($log->date)->format('d M, Y') }}
            </td>
            
            <!-- Subject Name -->
            <td class="fw-semibold text-dark">{{ $log->subject->subject_name ?? 'N/A' }}</td>
            
            <!-- Marked By Faculty -->
            <td>{{ $log->marker->name ?? 'System/Unknown' }}</td>
            
            <!-- Clean Metrics Status/Strength (e.g., 5 / 7 Present) -->
            <td>
                <span class="badge bg-light text-dark border px-2 py-1">
                    <strong class="text-success">{{ $log->total_present }}</strong> / {{ $log->total_strength }} Present
                </span>
            </td>
            
            <!--  Action Button -->
            <td class="text-center">
                <a href="{{ route('attendance.show_sheet', ['date' => $log->date, 'subject_id' => $log->subject_id]) }}" class="btn btn-sm btn-light text-primary border shadow-sm">
                    <i class="fas fa-eye me-1"></i> View Sheet
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-5 text-muted">No matching attendance sheets found for this selection.</td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>
@endsection