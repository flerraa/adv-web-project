@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Research Grants</h2>
        <a href="{{ route('grants.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Grant
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Provider</th>
                            <th>Start Date</th>
                            <th>Duration</th>
                            <th>Project Leader</th>
                            <th>Members</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grants as $grant)
                        <tr>
                            <td>{{ $grant->title }}</td>
                            <td>${{ number_format($grant->amount, 2) }}</td>
                            <td>{{ $grant->provider }}</td>
                            <td>{{ $grant->start_date->format('d M Y') }}</td>
                            <td>{{ $grant->duration_months }} months</td>
                            <td>
                                {{ $grant->projectLeader->name }}
                                <small class="text-muted d-block">{{ $grant->projectLeader->staff_number }}</small>
                            </td>
                            <td>{{ $grant->members->count() }}</td>
                            <td>
                                @php
                                    $endDate = $grant->start_date->addMonths($grant->duration_months);
                                    $status = now()->lt($endDate) ? 'Active' : 'Completed';
                                @endphp
                                <span class="badge bg-{{ $status == 'Active' ? 'success' : 'secondary' }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-warning btn-sm" title="Edit Grant">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this grant?')"
                                        title="Delete Grant">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection