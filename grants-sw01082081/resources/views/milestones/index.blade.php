@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Project Milestones</h2>
        <a href="{{ route('milestones.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Milestone
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Grant Title</th>
                            <th>Milestone Name</th>
                            <th>Target Date</th>
                            <th>Deliverable</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($milestones as $milestone)
                            <tr>
                                <td>{{ $milestone->grant->title }}</td>
                                <td>{{ $milestone->name }}</td>
                                <td>{{ $milestone->target_date->format('d M Y') }}</td>
                                <td>{{ Str::limit($milestone->deliverable, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $milestone->status == 'Completed' ? 'success' : ($milestone->status == 'In Progress' ? 'warning' : 'secondary') }}">
                                        {{ $milestone->status }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#updateStatusModal{{ $milestone->id }}">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Are you sure you want to delete this milestone?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Status Update Modal -->
                            <div class="modal fade" id="updateStatusModal{{ $milestone->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Milestone Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('milestones.update-status', $milestone->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status{{ $milestone->id }}" class="form-label">Status</label>
                                                    <select name="status" id="status{{ $milestone->id }}" class="form-control" required>
                                                        <option value="Pending" {{ $milestone->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="In Progress" {{ $milestone->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Completed" {{ $milestone->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No milestones found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection