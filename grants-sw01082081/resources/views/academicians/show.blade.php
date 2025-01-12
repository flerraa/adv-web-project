@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Academician Details</h2>
        <div>
            <a href="{{ route('academicians.edit', $academician->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('academicians.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        
        <!-- Personal Information -->
<div class="col-md-4">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Personal Information</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold">Name:</label>
                <p>{{ $academician->name }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Staff Number:</label>
                <p>{{ $academician->staff_number }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Email:</label>
                <p>{{ $academician->email }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Position:</label>
                <p>{{ $academician->position }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">College:</label>
                <p>{{ $academician->college }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Department:</label>
                <p>{{ $academician->department }}</p>
            </div>
        </div>
    </div>
</div>

        <!-- Grants as Leader -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Research Grants (as Leader)</h5>
                </div>
                <div class="card-body">
                    @if($academician->ledGrants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Provider</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($academician->ledGrants as $grant)
                                    <tr>
                                        <td>{{ $grant->title }}</td>
                                        <td>${{ number_format($grant->amount, 2) }}</td>
                                        <td>{{ $grant->provider }}</td>
                                        <td>{{ $grant->duration_months }} months</td>
                                        <td>
                                            @php
                                                $endDate = \Carbon\Carbon::parse($grant->start_date)->addMonths($grant->duration_months);
                                                $status = now()->lt($endDate) ? 'Active' : 'Completed';
                                            @endphp
                                            <span class="badge bg-{{ $status == 'Active' ? 'success' : 'secondary' }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No grants as leader.</p>
                    @endif
                </div>
            </div>

            <!-- Grants as Member -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Research Grants (as Member)</h5>
                </div>
                <div class="card-body">
                    @if($academician->memberGrants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Provider</th>
                                        <th>Project Leader</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($academician->memberGrants as $grant)
                                    <tr>
                                        <td>{{ $grant->title }}</td>
                                        <td>${{ number_format($grant->amount, 2) }}</td>
                                        <td>{{ $grant->provider }}</td>
                                        <td>{{ $grant->projectLeader->name }}</td>
                                        <td>{{ $grant->duration_months }} months</td>
                                        <td>
                                            @php
                                                $endDate = \Carbon\Carbon::parse($grant->start_date)->addMonths($grant->duration_months);
                                                $status = now()->lt($endDate) ? 'Active' : 'Completed';
                                            @endphp
                                            <span class="badge bg-{{ $status == 'Active' ? 'success' : 'secondary' }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No grants as member.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection