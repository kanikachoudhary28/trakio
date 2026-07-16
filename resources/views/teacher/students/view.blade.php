@extends('layouts.teacher')

@section('title', 'Student Directory')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm mt-4">
        
        <!-- Header Section -->
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1 text-primary">
                    <i class="fas fa-user-graduate me-2"></i> Student Directory
                </h5>
                <p class="text-muted small mb-0">
                    <strong>Batch / Class:</strong> {{ $selectedBatch->batch_name }} | 
                    <strong>Total Strength:</strong> <span class="badge bg-secondary">{{ $students->count() }} Students</span>
                </p>
            </div>
            <a href="{{ route('teacher.students.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Batches
            </a>
        </div>

        <!-- Table Section -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;" class="ps-4">S.No</th>
                            <th style="width: 100px;">Photo</th> <!-- 🔥 Naya Photo Column -->
                            <th style="width: 150px;">Roll Number</th>
                            <th>Student Name</th>
                            <th>Email Address</th>
                            <th>Phone / Contact</th>
                            <th>Gender</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            <tr>
                                <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                
                                <!-- 1. 🔥 DYNAMIC STUDENT PHOTO -->
                                <td>
                                    @if($student->photo && file_exists(public_path('storage/' . $student->photo)))
                                        <!-- Agar student ne photo upload ki hai -->
                                        <img src="{{ asset('storage/' . $student->photo) }}" 
                                             alt="Student Photo" 
                                             class="rounded-circle border shadow-sm" 
                                             style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <!-- Default Avatar (Agar photo nahi hai) -->
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->user->name ?? 'Student') }}&background=4e73df&color=fff&bold=true" 
                                             alt="Default Avatar" 
                                             class="rounded-circle border shadow-sm" 
                                             style="width: 45px; height: 45px;">
                                    @endif
                                </td>

                                <!-- 2. Roll Number -->
                                <td>
                                    <span class="badge bg-light text-dark border p-2 fs-6 fw-bold">
                                        {{ $student->roll_number ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- 3. Student Name -->
                                <td>
                                    <h6 class="fw-bold mb-0 text-dark">
                                        {{ $student->user->name ?? 'No Name Found' }}
                                    </h6>
                                    <small class="text-muted">User ID: {{ $student->user_id }}</small>
                                </td>

                                <!-- 4. Email Address -->
                                <td class="text-secondary small">
                                    {{ $student->user->email ?? '---' }}
                                </td>

                                <!-- 5. Phone Number (Self-filled field notification) -->
                                <td>
                                    @if($student->phone)
                                        <a href="tel:{{ $student->phone }}" class="text-decoration-none text-secondary">
                                            <i class="fas fa-phone-alt text-success me-1 small"></i> {{ $student->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted small italic" title="Awaiting student update"><i class="fas fa-clock text-warning me-1"></i> Not Filled</span>
                                    @endif
                                </td>

                                <!-- 6. Gender -->
                                <td>
                                    @if($student->gender && strtolower($student->gender) == 'male')
                                        <span class="badge bg-sm bg-rgba-primary text-primary px-2 py-1"><i class="fas fa-mars me-1"></i> Male</span>
                                    @elseif($student->gender && strtolower($student->gender) == 'female')
                                        <span class="badge bg-sm bg-rgba-danger text-danger px-2 py-1"><i class="fas fa-venus me-1"></i> Female</span>
                                    @else
                                        <span class="badge bg-sm bg-light text-muted px-2 py-1">Not Set</span>
                                    @endif
                                </td>

                                <!-- 7. Address -->
                                <td>
                                    <span class="text-secondary small text-truncate d-inline-block" style="max-width: 150px;" title="{{ $student->address ?? 'Not Provided Yet' }}">
                                        {{ $student->address ?? 'Not Filled' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-5 text-muted">
                                    <i class="fas fa-users-slash fa-2x mb-3 d-block text-warning"></i>
                                    No records found for this batch.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
    .bg-rgba-primary { background-color: rgba(78, 115, 223, 0.1); }
    .bg-rgba-danger { background-color: rgba(231, 74, 59, 0.1); }
    .italic { font-style: italic; }
</style>
@endsection