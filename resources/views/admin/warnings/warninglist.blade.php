@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-exclamation-triangle me-2 text-danger"></i> Issued Warning Letters
            </h5>
            <a href="{{ route('warnings.create') }}" class="btn btn-sm btn-danger px-3 rounded-pill shadow-sm">
                <i class="fas fa-plus me-1"></i> Issue New Warning
            </a>
        </div>
        
        <!-- ✨ FIX 1: Padding bottom diya taaki table ke peeche dropdown na chhupe -->
        <div class="card-body p-3 pb-5">
            <!-- ✨ FIX 2: overflow visible rakha taaki dropdown drop down ho sake -->
            <div class="table-responsive" style="overflow: visible !important;"> 
                <table id="adminWarningsTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-secondary text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4">Student Name</th>
                            <th>Warning Type</th>
                            <th class="text-center">Severity</th>
                            <th>Issue Date</th>
                            <th>Issued By</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warnings as $warning)
                            <tr>
                                <!-- Student Name -->
                                <td class="ps-4 fw-semibold text-dark text-capitalize">
                                    {{ $warning->student->user->name ?? 'Unknown Student' }}
                                </td>
                                
                                <!-- Warning Type -->
                                <td>
                                    <span class="text-capitalize fw-medium small text-secondary">
                                        {{ str_replace('_', ' ', $warning->warning_type) }}
                                    </span>
                                </td>
                                
                                <!-- Severity Level -->
                                <td class="text-center">
                                    @if(strtolower($warning->severity_level) == 'critical')
                                        <span class="badge bg-danger text-white px-2 py-1 rounded small" style="font-size: 10px;">CRITICAL</span>
                                    @elseif(strtolower($warning->severity_level) == 'medium')
                                        <span class="badge bg-warning text-dark px-2 py-1 rounded small" style="font-size: 10px;">MEDIUM</span>
                                    @else
                                        <span class="badge bg-info text-dark px-2 py-1 rounded small" style="font-size: 10px;">LOW</span>
                                    @endif
                                </td>
                                
                                <!-- Issue Date -->
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($warning->issue_date)->format('d M, Y') }}
                                </td>
                                
                                <!-- Issued By -->
                                <td class="text-muted fw-medium small">
                                    {{ $warning->issuer->name ?? 'Admin' }}
                                </td>
                                
                                <!-- Status -->
                                <td class="text-center">
                                    @if($warning->status == 'active')
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px;">Active</span>
                                    @elseif($warning->status == 'acknowledged')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px;">Acknowledged</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px;">Resolved</span>
                                    @endif
                                </td>
                                
                                <!-- Actions -->
                                <td class="text-center">
                                   
                                    <div class="dropdown position-static">
                                        <button class="btn btn-sm btn-light border dropdown-toggle rounded-pill px-3" 
                                                type="button" 
                                                id="dropdownMenuStatus{{ $warning->id }}"
                                                data-bs-toggle="dropdown" 
                                                data-bs-boundary="viewport"
                                                aria-expanded="false" 
                                                style="font-size: 12px; font-weight: 500;">
                                            Change Status
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border border-light p-2 rounded-3" aria-labelledby="dropdownMenuStatus{{ $warning->id }}" style="z-index: 1050 !important;">
                                            <li>
                                                <a class="dropdown-item rounded-2 text-warning small my-1 px-3 py-1 fw-medium" href="{{ route('warnings.updateStatus', [$warning->id, 'acknowledged']) }}">
                                                    <i class="fas fa-eye me-2"></i> Mark Acknowledged
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item rounded-2 text-success small my-1 px-3 py-1 fw-medium" href="{{ route('warnings.updateStatus', [$warning->id, 'resolved']) }}">
                                                    <i class="fas fa-check-double me-2"></i> Mark Resolved
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider opacity-50"></li>
                                            <li>
                                                <a class="dropdown-item rounded-2 text-danger small my-1 px-3 py-1 fw-medium" href="{{ route('warnings.updateStatus', [$warning->id, 'active']) }}">
                                                    <i class="fas fa-rotate-left me-2"></i> Revert to Active
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Bundle for JavaScript Component Triggers -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection